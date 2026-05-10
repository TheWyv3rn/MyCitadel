<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: CONNECTION HANDLER (RELAY)
 * VERSION: 1.2.2
 */

declare(strict_types=1);
// Check the path: if the file is in includes/api/, config is one level up.
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['citizen_id'])) {
    echo json_encode(['success' => false, 'error' => 'SESSION_EXPIRED']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$my_id = (int)$_SESSION['citizen_id'];
$target_id = (int)($input['target_id'] ?? 0);
$action = $input['action'] ?? '';

if ($target_id === 0 || $target_id === $my_id) {
    echo json_encode(['success' => false, 'error' => 'INVALID_TARGET']);
    exit;
}

$db = citadel_db();

try {
    $db->beginTransaction();

    if ($action === 'establish') {
        // 1. CHECK FOR EXISTING CONNECTION
        $check = $db->prepare("SELECT status FROM connections WHERE (user_id_1 = ? AND user_id_2 = ?) OR (user_id_1 = ? AND user_id_2 = ?)");
        $check->execute([$my_id, $target_id, $target_id, $my_id]);
        
        if ($check->fetch()) {
            throw new Exception("UPLINK_ALREADY_EXISTS_OR_PENDING");
        }

        // 2. CREATE CONNECTION (Pending)
        $conn = $db->prepare("INSERT INTO connections (user_id_1, user_id_2, requester_id, status) VALUES (?, ?, ?, 'pending')");
        $conn->execute([$my_id, $target_id, $my_id]);

        if ($conn->rowCount() === 0) {
            throw new Exception("DB_WRITE_FAILURE_CONNECTION");
        }

        // 3. TRIGGER NOTIFICATION FOR TARGET
        $notif = $db->prepare("INSERT INTO notifications (citizen_id, from_id, notif_type) VALUES (?, ?, 'request')");
        $notif->execute([$target_id, $my_id]);

        if ($notif->rowCount() === 0) {
            throw new Exception("DB_WRITE_FAILURE_NOTIFICATION");
        }

    } 
    
    else if ($action === 'sever') {
        // 1. DELETE CONNECTION
        $del = $db->prepare("DELETE FROM connections WHERE (user_id_1 = ? AND user_id_2 = ?) OR (user_id_1 = ? AND user_id_2 = ?)");
        $del->execute([$my_id, $target_id, $target_id, $my_id]);

        // 2. NOTIFY TARGET OF SEVERANCE
        $notif = $db->prepare("INSERT INTO notifications (citizen_id, from_id, notif_type) VALUES (?, ?, 'severed')");
        $notif->execute([$target_id, $my_id]);
        
        // 3. OPTIONAL: Mark old requests as read
        $db->prepare("UPDATE notifications SET is_read = 1 WHERE (citizen_id = ? AND from_id = ?) OR (citizen_id = ? AND from_id = ?)")
           ->execute([$my_id, $target_id, $target_id, $my_id]);
    }

    $db->commit();
    echo json_encode(['success' => true]);

} catch (Exception $e) {
    if ($db->inTransaction()) $db->rollBack();
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}