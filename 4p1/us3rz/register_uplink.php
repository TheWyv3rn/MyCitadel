<?php
/**
 * MYCITADEL // REGISTER UPLINK
 * Path: /4p1/us3rz/register_uplink.php
 */
header('Content-Type: application/json');
session_start();
require_once __DIR__ . '/../../../private/citadel_config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'ERROR', 'message' => 'INVALID_METHOD']);
    exit;
}

$alias = preg_replace("/[^a-zA-Z0-9_]/", "", $_POST['alias'] ?? '');
$emailBlob = $_POST['email_blob'] ?? '';
$passAuth = $_POST['pass_auth'] ?? '';
$agree = $_POST['agree'] ?? 0;

if (!$alias || !$emailBlob || !$passAuth || !$agree) {
    echo json_encode(['status' => 'ERROR', 'message' => 'TELEMETRY_INCOMPLETE']);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT id FROM citizens WHERE alias = ? LIMIT 1");
    $stmt->execute([$alias]);
    if ($stmt->fetch()) {
        echo json_encode(['status' => 'ERROR', 'message' => 'ALIAS_TAKEN']);
        exit;
    }

    // Apply Pepper + Argon2id
    $peppered = hash_hmac('sha256', $passAuth, CITADEL_PEPPER);
    $hashed_auth = password_hash($peppered, PASSWORD_ARGON2ID);

    $unique_id = bin2hex(random_bytes(32));

    $insert = $pdo->prepare("INSERT INTO citizens (alias, unique_id, email_encrypted, auth_key, law_agreement, status, created_at) VALUES (?, ?, ?, ?, 1, 'ACTIVE', NOW())");
    $insert->execute([$alias, $unique_id, $emailBlob, $hashed_auth]);

    session_regenerate_id(true);
    $_SESSION['citizen_id'] = $pdo->lastInsertId();
    $_SESSION['citizen_alias'] = $alias;
    $_SESSION['citizen_unique_id'] = $unique_id;

    echo json_encode(['status' => 'SUCCESS', 'alias' => $alias]);

} catch (PDOException $e) {
    echo json_encode(['status' => 'ERROR', 'message' => 'DATABASE_ERROR']);
}