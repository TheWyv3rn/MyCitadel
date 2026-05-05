<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: LOGIN PROCESSOR (MULTI-DEVICE BINDING)
 * VERSION: 1.2.0
 */

declare(strict_types=1);
require_once __DIR__ . '/../config.php';

// 1. Lockdown: Only POST allowed
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../login.php");
    exit;
}

// 2. Capture and Sanitize
// Note: We trim the Alias, but we MUST NOT touch the scrambled hashes 
// because they are high-entropy hex strings from the JS.
$alias = trim((string)($_POST['alias'] ?? ''));
$email_scrambled = (string)($_POST['scrambled_email'] ?? '');
$pass_scrambled = (string)($_POST['scrambled_pass'] ?? '');

// Defensive: If JS failed to send the hashes, don't even hit the DB
if (empty($email_scrambled) || empty($pass_scrambled)) {
    header("Location: ../../login.php?error=js_failure");
    exit;
}

$db = citadel_db();

try {
    // 3. Locate Citizen Archive
    $stmt = $db->prepare("SELECT * FROM citizens WHERE alias = ? LIMIT 1");
    $stmt->execute([$alias]);
    $citizen = $stmt->fetch();

    if (!$citizen) {
        // Alias doesn't exist
        header("Location: ../../login.php?error=auth_failed");
        exit;
    }

    // 4. Near-ZK Verification Layer
    // Decrypt the vault's stored email hash and compare to the submitted one
    $stored_email_scramble = citadel_decrypt($citizen['email_hash']);
    
    // MATHEMATICAL TRUTH CHECK
    if ($stored_email_scramble !== $email_scrambled) {
        // This is usually where mobile logins fail due to capitalization/spaces in JS
        header("Location: ../../login.php?error=auth_failed");
        exit;
    }

    // 5. Argon2id Password Verification
    if (password_verify($pass_scrambled, $citizen['password_hash'])) {
        
        /**
         * --- AIRLOCK RE-BINDING PROTOCOL ---
         * This section handles the "Handover" between devices.
         */
        
        // Destroy old session on THIS device and start fresh
        session_regenerate_id(true);
        $new_session_id = session_id();
        
        // Generate a new fingerprint unique to the NEW device (Phone/Laptop/etc)
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown_Node';
        $fingerprint = hash('sha256', $user_agent . CITADEL_MASTER_KEY);

        // Update the Vault: This OVERWRITES the previous device's binding.
        // Once this executes, the previous device's Gatekeeper will fail.
        $update = $db->prepare("
            UPDATE citizens SET 
            current_session_id = ?, 
            browser_fingerprint = ?, 
            last_login = NOW() 
            WHERE id = ?
        ");
        $update->execute([$new_session_id, $fingerprint, $citizen['id']]);

        // 6. Establish Sovereign Session State
        $_SESSION['citizen_id']    = $citizen['id'];
        $_SESSION['citizen_alias'] = $citizen['alias'];
        $_SESSION['fingerprint']   = $fingerprint;

        // Redirect to internal citizen sector
        header("Location: ../../citizen/dashboard.php");
        exit;

    } else {
        // Password hash mismatch
        header("Location: ../../login.php?error=auth_failed");
        exit;
    }

} catch (Exception $e) {
    // Log the error for the architect, show a generic failure to the user
    error_log("[CITADEL_AUTH_ERROR]: " . $e->getMessage());
    header("Location: ../../login.php?error=system_failure");
    exit;
}