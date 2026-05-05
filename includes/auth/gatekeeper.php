<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: GATEKEEPER (ACCESS CONTROL)
 */

declare(strict_types=1);

// 1. Check if the session variables exist
if (!isset($_SESSION['citizen_id']) || !isset($_SESSION['fingerprint'])) {
    header("Location: " . SITE_URL . "/login.php?error=unauthorized");
    exit;
}

// 2. Fingerprint Validation (Anti-Hijack)
$current_fingerprint = hash('sha256', $_SERVER['HTTP_USER_AGENT'] . CITADEL_MASTER_KEY);
if ($_SESSION['fingerprint'] !== $current_fingerprint) {
    // Fingerprint mismatch - potentially a session hijacking attempt
    session_destroy();
    header("Location: " . SITE_URL . "/login.php?error=session_compromised");
    exit;
}

// 3. Database Session Binding Check
$db = citadel_db();
$stmt = $db->prepare("SELECT current_session_id FROM citizens WHERE id = ? LIMIT 1");
$stmt->execute([$_SESSION['citizen_id']]);
$record = $stmt->fetch();

if (!$record || $record['current_session_id'] !== session_id()) {
    // Database says this session is no longer valid or has been rotated
    session_destroy();
    header("Location: " . SITE_URL . "/login.php?error=session_expired");
    exit;
}
