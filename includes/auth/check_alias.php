<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: AJAX ALIAS VERIFICATION
 * DESCRIPTION: Checks availability of Citizen Alias in real-time.
 */

declare(strict_types=1);

// Path logic: moving up one level to reach /includes/config.php
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');

// Retrieve alias from GET request
$alias = trim($_GET['alias'] ?? '');

if (empty($alias) || strlen($alias) < 3) {
    echo json_encode(['taken' => false]);
    exit;
}

try {
    $db = citadel_db();
    
    // Check for existing alias in the citizens table
    $stmt = $db->prepare("SELECT id FROM citizens WHERE alias = ? LIMIT 1");
    $stmt->execute([$alias]);
    
    // Return true if alias is found (taken), false if available
    echo json_encode(['taken' => (bool)$stmt->fetch()]);
} catch (Exception $e) {
    // Fail silently to the user, but return error status for debugging if needed
    http_response_code(500);
    echo json_encode(['error' => 'DATABASE_OFFLINE']);
}