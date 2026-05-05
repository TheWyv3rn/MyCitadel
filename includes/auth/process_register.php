<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: SERVER-SIDE IDENTITY PROCESSING
 * VERSION: 1.3.0
 * DESCRIPTION: Finalizes Near Zero-Knowledge registration and stores high-entropy data.
 */

declare(strict_types=1);

// 1. Core Handshake
require_once __DIR__ . '/../config.php';

// Block direct access or non-POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../register.php");
    exit;
}

/**
 * 2. Fragment Retrieval & Sanitization
 * Note: We trim the Alias, but we MUST NOT trim the hashes.
 * Mobile devices often send these as strings; we cast them to ensure type safety.
 */
$alias            = trim((string)($_POST['alias'] ?? ''));
$email_scrambled  = (string)($_POST['scrambled_email'] ?? '');
$pass_scrambled   = (string)($_POST['scrambled_pass'] ?? '');

// 3. Integrity Check
// If any fragment is missing, the "Handshake" failed at the JS layer.
if (empty($alias) || empty($email_scrambled) || empty($pass_scrambled)) {
    header("Location: ../../register.php?error=data_corruption");
    exit;
}

// 4. Input Validation (Sanity Check)
// Ensure hashes look like valid hex strings (64 chars for SHA-256)
if (!preg_match('/^[a-f0-9]{64}$/i', $email_scrambled)) {
    header("Location: ../../register.php?error=invalid_handshake");
    exit;
}

$db = citadel_db();

try {
    // 5. Duplicate Alias Check (The "Sovereign Name" Check)
    $check = $db->prepare("SELECT id FROM citizens WHERE alias = ? LIMIT 1");
    $check->execute([$alias]);
    if ($check->fetch()) {
        header("Location: ../../register.php?error=alias_taken");
        exit;
    }

    /**
     * 6. Secure Storage Generation
     * Layer 1: Argon2id - The industry standard for side-channel resistant hashing.
     * Layer 2: XChaCha20-Poly1305 - Encrypting the scrambled email so the DB never 
     * stores even a searchable hash of the user's communication address.
     */
    $final_pass_hash = password_hash($pass_scrambled, PASSWORD_ARGON2ID);
    $encrypted_email = citadel_encrypt($email_scrambled);

    /**
     * 7. Commit to Citizens Registry
     * We only insert the core identity fields. 
     * All other columns (badges, profile, etc.) will use their DEFAULT values 
     * defined in our recent SQL migration.
     */
    $stmt = $db->prepare("
        INSERT INTO citizens (
            alias, 
            email_hash, 
            password_hash, 
            created_at,
            reputation,
            influence
        ) VALUES (?, ?, ?, NOW(), 0, 10)
    ");
    
    // We give new citizens 10 influence to start their journey
    $stmt->execute([
        $alias, 
        $encrypted_email, 
        $final_pass_hash
    ]);

    // 8. Redirect to Login Gate
    header("Location: ../../login.php?registration=success");
    exit;
    
} catch (Exception $e) {
    // Log the error for the system architect
    error_log("[CITADEL_REG_ERROR]: " . $e->getMessage());
    
    // Don't leak DB errors to the public, just a generic rejection
    header("Location: ../../register.php?error=archive_failure");
    exit;
}