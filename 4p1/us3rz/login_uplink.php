<?php
/**
 * MYCITADEL // LOGIN UPLINK
 * Path: /4p1/us3rz/login_uplink.php
 */
header('Content-Type: application/json');
session_start();
require_once __DIR__ . '/../../../private/citadel_config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'ERROR', 'message' => 'INVALID_METHOD']);
    exit;
}

$alias = preg_replace("/[^a-zA-Z0-9_]/", "", $_POST['alias'] ?? '');
$passAuth = $_POST['pass_auth'] ?? '';

try {
    $stmt = $pdo->prepare("SELECT * FROM citizens WHERE alias = ? LIMIT 1");
    $stmt->execute([$alias]);
    $citizen = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($citizen) {
        $peppered = hash_hmac('sha256', $passAuth, CITADEL_PEPPER);

        if (password_verify($peppered, $citizen['auth_key'])) {
            session_regenerate_id(true);
            $_SESSION['citizen_id'] = $citizen['id'];
            $_SESSION['citizen_alias'] = $citizen['alias'];
            $_SESSION['citizen_unique_id'] = $citizen['unique_id'];
            
            echo json_encode([
                'status' => 'SUCCESS',
                'alias' => $citizen['alias']
            ]);
            exit;
        }
    }

    echo json_encode(['status' => 'ERROR', 'message' => 'AUTHENTICATION_FAILED']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'ERROR', 'message' => 'KERNEL_ERROR']);
}