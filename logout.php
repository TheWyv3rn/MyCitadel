<?php
require_once __DIR__ . '/includes/config.php';

if (isset($_SESSION['citizen_id'])) {
    $db = citadel_db();
    $stmt = $db->prepare("UPDATE citizens SET current_session_id = NULL, browser_fingerprint = NULL WHERE id = ?");
    $stmt->execute([$_SESSION['citizen_id']]);
}

session_unset();
session_destroy();

header("Location: index.php?status=disconnected");
exit;