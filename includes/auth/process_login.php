<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: LOGIN PROCESSOR (SESSION BINDING)
 */

declare(strict_types=1);
require_once __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../login.php");
    exit;
}

$alias = trim($_POST['alias'] ?? '');
$email_scrambled = $_POST['scrambled_email'] ?? '';
$pass_scrambled = $_POST['scrambled_pass'] ?? '';

$db = citadel_db();

try {
    // 1. Locate Citizen Alias
    $stmt = $db->prepare("SELECT * FROM citizens WHERE alias = ? LIMIT 1");
    $stmt->execute([$alias]);
    $citizen = $stmt->fetch();

    if (!$citizen) {
        header("Location: ../../login.php?error=auth_failed");
        exit;
    }

    // 2. Verify Scrambled Email (ZKP layer)
    // We must decrypt the stored email_hash to compare it with the submitted scrambled_email
    $decrypted_email = citadel_decrypt($citizen['email_hash']);
    
    if ($decrypted_email !== $email_scrambled) {
        header("Location: ../../login.php?error=auth_failed");
        exit;
    }

    // 3. Verify Argon2id Password
    if (password_verify($pass_scrambled, $citizen['password_hash'])) {
        
        // --- SESSION BINDING PROTOCOL ---
        
        // Regenerate ID to prevent Session Fixation
        session_regenerate_id(true);
        $new_session_id = session_id();
        
        // Generate a fingerprint (Simple version: User Agent + Master Key)
        $fingerprint = hash('sha256', $_SERVER['HTTP_USER_AGENT'] . CITADEL_MASTER_KEY);

        // Update the Vault with the new session binding
        $update = $db->prepare("
            UPDATE citizens SET 
            current_session_id = ?, 
            browser_fingerprint = ?, 
            last_login = NOW() 
            WHERE id = ?
        ");
        $update->execute([$new_session_id, $fingerprint, $citizen['id']]);

        // 4. Initialize Sovereign Session
        $_SESSION['citizen_id']    = $citizen['id'];
        $_SESSION['citizen_alias'] = $citizen['alias'];
        $_SESSION['fingerprint']   = $fingerprint;

        header("Location: ../../citizen/dashboard.php");
        exit;

    } else {
        header("Location: ../../login.php?error=auth_failed");
        exit;
    }

} catch (Exception $e) {
    error_log($e->getMessage());
    die("AUTHENTICATION_CRITICAL_FAILURE");
}