<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: DOSSIER BACKEND PROCESSOR
 * VERSION: 1.0.2
 * DESCRIPTION: Secure encryption, Reputation Logic, and Zero-Lockout Password protection.
 */
declare(strict_types=1);
require_once __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['citizen_id'])) {
    header("Location: ../../index.php"); exit;
}

$db = citadel_db();
$cit_id = (int)$_SESSION['citizen_id'];
$sov_key = $_SESSION['sovereign_key'] ?? hash('sha256', 'Mustang_Sprint_2024_' . $cit_id, true);

// TARGET REGISTRY
$enc_targets = [
    'full_name', 'bio', 'short_bio', 'address_1', 'address_2', 'city', 'state', 'zip', 'country', 'phone',
    'fb_handle', 'x_handle', 'ig_handle', 'li_handle', 'gh_handle', 'h1_handle', 'bc_handle', 'it_handle', 
    'ywh_handle', 'so_handle', 'medium_handle', 'yt_handle', 'twitch_handle', 'kick_handle', 'TikTok',
    'xbox_handle', 'ps_handle', 'steam_handle', 'blizzard_handle', 'nintendo_handle',
    'fav_books', 'fav_shows', 'fav_movies', 'fav_songs', 'fav_activities',
    'job_company', 'job_title', 'job_description', 'highschool', 
    'college_1', 'college_2', 'college_3', 'diploma_1', 'diploma_2', 'diploma_3',
    'cert_1', 'cert_2', 'cert_3', 'cert_4', 'public_key'
];

function shield($data, $key) {
    if (empty($data) || !$key) return null;
    $nonce = random_bytes(24);
    return base64_encode($nonce . sodium_crypto_secretbox((string)$data, $nonce, $key));
}

function reveal($data, $key) {
    if (empty($data) || !$key) return '';
    try {
        $decoded = base64_decode((string)$data);
        if (!$decoded || strlen($decoded) < 32) return $data;
        $nonce = substr($decoded, 0, 24);
        $ciphertext = substr($decoded, 24);
        $p = sodium_crypto_secretbox_open($ciphertext, $nonce, $key);
        return ($p === false) ? $data : $p;
    } catch (Exception $e) { return ''; }
}

function award_badge($db, $cit_id, $badge_id_str) {
    $stmt = $db->prepare("SELECT id, points FROM badges WHERE badge_id = ? LIMIT 1");
    $stmt->execute([$badge_id_str]);
    $badge = $stmt->fetch();
    if ($badge) {
        $check = $db->prepare("SELECT 1 FROM citizen_badges WHERE citizen_id = ? AND badge_db_id = ?");
        $check->execute([$cit_id, $badge['id']]);
        if (!$check->fetch()) {
            $db->prepare("INSERT INTO citizen_badges (citizen_id, badge_db_id) VALUES (?, ?)")->execute([$cit_id, $badge['id']]);
            $db->prepare("UPDATE citizens SET reputation = reputation + ? WHERE id = ?")->execute([$badge['points'], $cit_id]);
        }
    }
}

try {
    $db->beginTransaction();
    $stmt = $db->prepare("SELECT * FROM citizens WHERE id = ? LIMIT 1");
    $stmt->execute([$cit_id]);
    $old = $stmt->fetch();

    $rep_gain = 0; $updates = []; $params = [];

    // LOOP THROUGH 50+ TEXT FIELDS
    foreach ($enc_targets as $f) {
        if (!isset($_POST[$f])) continue;
        $new_val = $_POST[$f];
        $old_dec = reveal($old[$f], $sov_key);
        if (empty($old_dec) && !empty($new_val)) { $rep_gain += 20; }
        $updates[] = "$f = ?";
        $params[] = shield($new_val, $sov_key);
    }

    // META
    foreach (['relationship_status', 'has_kids'] as $f) {
        if (isset($_POST[$f])) {
            $updates[] = "$f = ?"; $params[] = $_POST[$f];
        }
    }

    // 🔑 THE ACCESS PROTECTION LOGIC
    if (!empty($_POST['scrambled_email'])) {
        $updates[] = "email_hash = ?";
        $params[] = citadel_encrypt($_POST['scrambled_email']);
    }
    if (!empty($_POST['scrambled_pass'])) {
        $updates[] = "password_hash = ?";
        $params[] = password_hash($_POST['scrambled_pass'], PASSWORD_ARGON2ID);
        award_badge($db, $cit_id, 'BADGE_PROF_SECURITY');
    }

    // MEDIA
    $safe_alias = preg_replace('/[^a-zA-Z0-9]/', '', $old['alias']);
    $media = ['avatar' => ['col'=>'avatar_path','sfx'=>'_avatar','dir'=>'../../citizen/media/avatars/','badge'=>'BADGE_PROF_AVATAR'],
              'banner' => ['col'=>'banner_path','sfx'=>'_banner','dir'=>'../../citizen/media/banners/','badge'=>'BADGE_PROF_BANNER']];
    foreach ($media as $k => $c) {
        if (isset($_FILES[$k]) && $_FILES[$k]['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES[$k]['name'], PATHINFO_EXTENSION));
            $fname = $safe_alias . $c['sfx'] . '.' . $ext;
            if (move_uploaded_file($_FILES[$k]['tmp_name'], $c['dir'] . $fname)) {
                $updates[] = "{$c['col']} = ?"; 
                $params[] = "citizen/media/" . ($k === 'avatar' ? 'avatars/' : 'banners/') . $fname;
                award_badge($db, $cit_id, $c['badge']);
            }
        }
    }

    // FINAL COMMIT
    $updates[] = "reputation = reputation + ?"; $params[] = $rep_gain;
    $params[] = $cit_id;
    $sql = "UPDATE citizens SET " . implode(', ', $updates) . " WHERE id = ?";
    $db->prepare($sql)->execute($params);

    $db->commit();
    header("Location: ../../citizen/edit_profile.php?success=1");
} catch (Exception $e) {
    $db->rollBack();
    header("Location: ../../citizen/edit_profile.php?error=" . urlencode($e->getMessage()));
}