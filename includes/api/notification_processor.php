<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: NEURAL NOTIFICATION PROCESSOR
 * VERSION: 1.2.1
 * DESCRIPTION: Hardened logic for resolving connection handshakes and generating receipts.
 */

declare(strict_types=1);
require_once __DIR__ . '/../config.php';

// 1. GATEKEEPER: Ensure the session is active
if (!isset($_SESSION['citizen_id'])) {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['success' => false, 'error' => 'ACCESS_DENIED']);
    exit;
}

header('Content-Type: application/json');

// 2. DATA INGESTION
$input = json_decode(file_get_contents('php://input'), true);
$my_id = (int)$_SESSION['citizen_id'];
$action = $input['action'] ?? '';
$notif_id = (int)($input['notif_id'] ?? 0);

$db = citadel_db();

try {
    $db->beginTransaction();

    // ACTION: PURGE - Mark all as read
    if ($action === 'purge') {
        $stmt = $db->prepare("UPDATE notifications SET is_read = 1 WHERE citizen_id = ?");
        $stmt->execute([$my_id]);
    } 
    
    // ACTION: RESOLVE SPECIFIC TRANSMISSION
    else if ($notif_id > 0) {
        // Verify notification ownership and get sender ID
        $stmt = $db->prepare("SELECT from_id, notif_type FROM notifications WHERE id = ? AND citizen_id = ? LIMIT 1");
        $stmt->execute([$notif_id, $my_id]);
        $notif = $stmt->fetch();

        if (!$notif) throw new Exception("TRANSMISSION_NOT_FOUND");
        if ($notif['notif_type'] !== 'request') throw new Exception("INVALID_TRANSMISSION_TYPE");

        $sender_id = (int)$notif['from_id'];

        if ($action === 'accept') {
            /**
             * LOGIC: ACCEPT CONNECTION
             * 1. Update the 'connections' table status.
             * 2. Create an 'accepted' receipt for the original sender.
             */
            $upd = $db->prepare("
                UPDATE connections 
                SET status = 'accepted' 
                WHERE (user_id_1 = ? AND user_id_2 = ?) OR (user_id_1 = ? AND user_id_2 = ?)
            ");
            $upd->execute([$my_id, $sender_id, $sender_id, $my_id]);

            // Create notification for the requester (The one who sent the invite)
            $receipt = $db->prepare("
                INSERT INTO notifications (citizen_id, from_id, notif_type) 
                VALUES (?, ?, 'accepted')
            ");
            $receipt->execute([$sender_id, $my_id]);
        } 
        
        else if ($action === 'deny') {
            /**
             * LOGIC: DENY CONNECTION
             * 1. Delete the entry from 'connections'.
             * 2. Create a 'declined' receipt for the original sender.
             */
            $del = $db->prepare("
                DELETE FROM connections 
                WHERE (user_id_1 = ? AND user_id_2 = ?) OR (user_id_1 = ? AND user_id_2 = ?)
            ");
            $del->execute([$my_id, $sender_id, $sender_id, $my_id]);

            // Create notification for the requester
            $receipt = $db->prepare("
                INSERT INTO notifications (citizen_id, from_id, notif_type) 
                VALUES (?, ?, 'declined')
            ");
            $receipt->execute([$sender_id, $my_id]);
        }

        // Mark the current notification as read so it stops showing buttons
        $mark = $db->prepare("UPDATE notifications SET is_read = 1 WHERE id = ?");
        $mark->execute([$notif_id]);
    }

    $db->commit();
    echo json_encode(['success' => true]);

} catch (Exception $e) {
    if ($db->inTransaction()) {
        $db->rollBack();
    }
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}