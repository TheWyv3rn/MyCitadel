<?php
/**
 * MYCITADEL: REGISTRATION PROCESSOR v1.1
 * Handles the secure storage of NZK hashes with double-blind encryption.
 */

// Initialize session to track registration state
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Sanitize Inputs
    $alias = isset($_POST['alias_name']) ? trim($_POST['alias_name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $client_hash = isset($_POST['nzk_hash']) ? $_POST['nzk_hash'] : '';

    // 2. Initial Validation
    if (empty($alias) || empty($email) || empty($client_hash)) {
        $_SESSION['reg_error'] = "INCOMPLETE HANDSHAKE DATA.";
        header("Location: ../register.php?error=incomplete");
        exit();
    }

    // 3. Algorithm Check
    // Argon2id is the gold standard but requires the Sodium extension in PHP 7.2+.
    // If your server build lacks it, we fallback to PASSWORD_DEFAULT to prevent a 500 error.
    $algo = defined('PASSWORD_ARGON2ID') ? PASSWORD_ARGON2ID : PASSWORD_DEFAULT;

    // 4. Double-Blind Hashing
    // We hash the client's hash. This means even if the DB is compromised, 
    // the attacker only has a "hash of a hash," making cracking nearly impossible.
    $final_server_hash = password_hash($client_hash, $algo);

    try {
        // 5. Prepare and Execute Transaction
        $stmt = $db->prepare("INSERT INTO citizens (alias_name, email, password_hash) VALUES (:alias, :email, :pass)");
        
        $success = $stmt->execute([
            ':alias' => $alias,
            ':email' => $email,
            ':pass'  => $final_server_hash
        ]);

        if ($success) {
            // Log successful initialization for the session
            $_SESSION['new_citizen'] = $alias;
            
            // Registration Successful - Redirect to Login
            header("Location: ../login.php?registered=success");
            exit();
        } else {
            throw new Exception("NODE_REJECTION: Database refused the write operation.");
        }

    } catch (PDOException $e) {
        // Handle Duplicate Entry (Alias or Email)
        if ($e->getCode() == 23000) {
            header("Location: ../register.php?error=exists");
            exit();
        }
        
        // Log deep error for the architect and show generic failure
        error_log("CITADEL_REG_FAILURE: " . $e->getMessage());
        header("Location: ../register.php?error=db_failure");
        exit();
        
    } catch (Exception $e) {
        header("Location: ../register.php?error=system");
        exit();
    }
} else {
    // Redirect unauthorized GET requests back to the gates
    header("Location: ../register.php");
    exit();
}