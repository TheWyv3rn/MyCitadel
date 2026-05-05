<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: SERVER-SIDE IDENTITY PROCESSING
 * DESCRIPTION: Finalizes Near Zero-Knowledge registration and stores high-entropy data.
 */

declare(strict_types=1);

// Path logic: moving up one level to reach /includes/config.php
require_once __DIR__ . '/../config.php';

// Block direct access or non-POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../register.php");
    exit;
}

// 1. Fragment Retrieval
$alias            = trim($_POST['alias'] ?? '');
$email_scrambled  = $_POST['scrambled_email'] ?? '';
$pass_scrambled   = $_POST['scrambled_pass'] ?? '';

// 2. Integrity Check
if (empty($alias) || empty($email_scrambled) || empty($pass_scrambled)) {
    die("DATA_CORRUPTION_DETECTED: Missing required identity fragments.");
}

$db = citadel_db();

// 3. Final Race-Condition Check (Verify Alias availability one last time)
$check = $db->prepare("SELECT id FROM citizens WHERE alias = ?");
$check->execute([$alias]);
if ($check->fetch()) {
    header("Location: ../../register.php?error=alias_taken");
    exit;
}

// 4. Secure Storage Generation
// Wrap the client-side scramble in server-side Argon2id
$final_pass_hash = password_hash($pass_scrambled, PASSWORD_ARGON2ID);

// Encrypt the scrambled email with XChaCha20-Poly1305 for double-layered protection
$encrypted_email = citadel_encrypt($email_scrambled);

try {
    // 5. Commit to Citizens Registry
    $stmt = $db->prepare("
        INSERT INTO citizens (
            alias, 
            email_hash, 
            password_hash, 
            created_at
        ) VALUES (?, ?, ?, NOW())
    ");
    
    $stmt->execute([
        $alias, 
        $encrypted_email, 
        $final_pass_hash
    ]);

    // 6. Redirect to Login Gate
    header("Location: ../../login.php?registration=success");
    exit;
    
} catch (Exception $e) {
    // Log error and terminate
    error_log("DATABASE_REJECTION: " . $e->getMessage());
    die("DATABASE_REJECTION: ARCHIVE_WRITE_FAILURE");
}