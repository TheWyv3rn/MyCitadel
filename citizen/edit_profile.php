<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: DOSSIER ARCHIVE EDITOR (SUPREME PEAK v8.0)
 * FEATURES: 100% Schema Coverage, Libsodium Decryption Fix, +20 Rep Point Engine, Milestone Badges.
 */
include_once '../includes/config.php';
include_once '../includes/auth/gatekeeper.php';

$db = citadel_db(); 
$citizen_id = (int)$_SESSION['citizen_id'];
$status_msg = "";
$error_msg = "";

// --- 1. THE COMPLETE ARCHIVE MAP (EVERY COLUMN FROM SCHEMA) ---
$enc_targets = [
    'full_name', 'bio', 'short_bio', 'address_1', 'address_2', 'city', 'state', 'zip', 'country', 'phone',
    'fb_handle', 'x_handle', 'ig_handle', 'li_handle', 'gh_handle', 'h1_handle', 'bc_handle', 'it_handle', 
    'ywh_handle', 'so_handle', 'medium_handle', 'yt_handle', 'twitch_handle', 'kick_handle',
    'xbox_handle', 'ps_handle', 'steam_handle', 'blizzard_handle', 'nintendo_handle',
    'fav_books', 'fav_shows', 'fav_movies', 'fav_songs', 'fav_activities',
    'job_company', 'job_title', 'job_description', 'highschool', 
    'college_1', 'college_2', 'college_3', 'diploma_1', 'diploma_2', 'diploma_3',
    'cert_1', 'cert_2', 'cert_3', 'cert_4', 'public_key'
];

$meta_targets = ['relationship_status', 'has_kids'];

// Sovereign Key derivation
$sov_key = $_SESSION['sovereign_key'] ?? hash('sha256', 'Mustang_Sprint_2024_' . $citizen_id, true);

/**
 * NZK CORE ENGINE (DECRYPTION FIXED)
 */
function shield($data, $key) {
    if (empty($data) || !$key) return null;
    $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
    return base64_encode($nonce . sodium_crypto_secretbox((string)$data, $nonce, $key));
}

function reveal($data, $key) {
    if (empty($data) || !$key) return $data;
    try {
        $decoded = base64_decode((string)$data);
        if (!$decoded || strlen($decoded) < SODIUM_CRYPTO_SECRETBOX_NONCEBYTES) return $data;
        $nonce = substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
        $ciphertext = substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
        $p = sodium_crypto_secretbox_open($ciphertext, $nonce, $key);
        return ($p === false) ? $data : $p;
    } catch (Exception $e) { return $data; }
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

// 2. FETCH DATA (PRE-DECRYPTION)
$stmt = $db->prepare("SELECT * FROM citizens WHERE id = ? LIMIT 1");
$stmt->execute([$citizen_id]);
$me = $stmt->fetch();

// Decrypt for viewing in the form
foreach ($enc_targets as $f) { $me[$f] = reveal($me[$f], $sov_key); }

// --- 3. PROCESS UPDATES ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db->beginTransaction();
        $rep_bonus = 0; $updates = []; $params = [];

        foreach ($enc_targets as $f) {
            $val = $_POST[$f] ?? null;
            // +20 Rep per field if previously empty
            if (empty($me[$f]) && !empty($val)) $rep_bonus += 20;
            $updates[] = "$f = ?";
            $params[] = shield($val, $sov_key);
        }
        foreach ($meta_targets as $f) {
            $val = $_POST[$f] ?? $me[$f];
            $updates[] = "$f = ?";
            $params[] = $val;
        }

        // Sensitive: Email/Password
        if (!empty($_POST['new_email'])) { $updates[] = "email_hash = ?"; $params[] = hash('sha512', $_POST['new_email']); }
        if (!empty($_POST['new_password'])) {
            $updates[] = "password_hash = ?"; $params[] = password_hash($_POST['new_password'], PASSWORD_ARGON2ID);
            award_badge($db, $citizen_id, 'BADGE_PROF_SECURITY');
        }

        // Aliased Media
        $safe_alias = preg_replace('/[^a-zA-Z0-9]/', '', $me['alias']);
        $media = ['avatar' => ['col'=>'avatar_path','sfx'=>'_avatar','dir'=>'media/avatars/','badge'=>'BADGE_PROF_AVATAR'],
                  'banner' => ['col'=>'banner_path','sfx'=>'_banner','dir'=>'media/banners/','badge'=>'BADGE_PROF_BANNER']];
        foreach ($media as $k => $c) {
            if (isset($_FILES[$k]) && $_FILES[$k]['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES[$k]['name'], PATHINFO_EXTENSION));
                $fname = $safe_alias . $c['sfx'] . '.' . $ext;
                if (move_uploaded_file($_FILES[$k]['tmp_name'], $c['dir'] . $fname)) {
                    $updates[] = "{$c['col']} = ?"; $params[] = "citizen/" . $c['dir'] . $fname;
                    award_badge($db, $citizen_id, $c['badge']);
                }
            }
        }

        // Milestone Badges
        if (!empty($_POST['bio'])) award_badge($db, $citizen_id, 'BADGE_PROF_BIO');
        if (!empty($_POST['gh_handle']) || !empty($_POST['li_handle'])) award_badge($db, $citizen_id, 'BADGE_PROF_SOCIALS');
        if (!empty($_POST['job_title'])) award_badge($db, $citizen_id, 'BADGE_PROF_JOB');
        if (!empty($_POST['college_1'])) award_badge($db, $citizen_id, 'BADGE_PROF_EDUCATION');

        $updates[] = "reputation = reputation + ?"; $params[] = $rep_bonus;
        $params[] = $citizen_id;
        $sql = "UPDATE citizens SET " . implode(', ', $updates) . " WHERE id = ?";
        $db->prepare($sql)->execute($params);
        $db->commit();
        header("Location: edit_profile.php?success=1"); exit;
    } catch (Exception $e) { $db->rollBack(); $error_msg = $e->getMessage(); }
}
?>

<?php include_once '../includes/header.php'; ?>
<?php include_once '../includes/nav.php'; ?>

<div class="container mt-5 mb-5 animate__animated animate__fadeIn">
    <div class="row">
        <div class="col-12">
            <h2 class="stencil-text text-neon-blue mb-4"><i class="fas fa-database me-2"></i> ARCHIVE_DOSSIER_v8.0</h2>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="nav flex-column nav-pills border border-neon-blue bg-black p-3 rounded mb-4 shadow-neon" id="v-pills-tab" role="tablist">
                            <button class="nav-link active mb-2" data-bs-toggle="pill" data-bs-target="#sec" type="button">1. SECURITY</button>
                            <button class="nav-link mb-2" data-bs-toggle="pill" data-bs-target="#pers" type="button">2. IDENTITY</button>
                            <button class="nav-link mb-2" data-bs-toggle="pill" data-bs-target="#loc" type="button">3. GEOLOCATION</button>
                            <button class="nav-link mb-2" data-bs-toggle="pill" data-bs-target="#soc" type="button">4. SOCIAL_GRID</button>
                            <button class="nav-link mb-2" data-bs-toggle="pill" data-bs-target="#game" type="button">5. GAMING_LINKS</button>
                            <button class="nav-link mb-2" data-bs-toggle="pill" data-bs-target="#work" type="button">6. CORPORATE</button>
                            <button class="nav-link mb-2" data-bs-toggle="pill" data-bs-target="#edu" type="button">7. ACADEMIC</button>
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#int" type="button">8. NARRATIVE</button>
                        </div>
                        <button type="submit" class="btn-cyber w-100 py-3 shadow-neon"><i class="fas fa-save me-2"></i> COMMIT CHANGES</button>
                    </div>

                    <div class="col-lg-9">
                        <div class="tab-content bg-void-surface border border-neon-blue p-4 rounded shadow-lg min-vh-70">
                            
                            <div class="tab-pane fade show active" id="sec">
                                <h5 class="text-neon-blue mb-4 stencil-text small">Auth_Protocols</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3"><label class="label-cyber">Neural Link (Email)</label><input type="email" name="new_email" class="form-control bg-black text-light border-neon-blue"></div>
                                    <div class="col-md-6 mb-3"><label class="label-cyber">New Access Code (Password)</label><input type="password" name="new_password" class="form-control bg-black text-light border-neon-blue"></div>
                                    <div class="col-12"><label class="label-cyber">Public GPG Block (ENCRYPTED)</label><textarea name="public_key" class="form-control bg-black text-light border-neon-blue font-monospace small" rows="8"><?php echo htmlspecialchars($me['public_key'] ?? ''); ?></textarea></div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pers">
                                <h5 class="text-neon-blue mb-4 stencil-text small">Biometric_Metrics</h5>
                                <div class="row align-items-center mb-4">
                                    <div class="col-md-3 text-center">
                                        <img src="<?php echo SITE_URL.'/'.$me['avatar_path']; ?>" class="rounded border border-neon-blue mb-2 shadow-neon" style="width:100px;height:100px;object-fit:cover;">
                                        <input type="file" name="avatar" class="form-control form-control-sm bg-black text-light border-neon-blue">
                                    </div>
                                    <div class="col-md-9">
                                        <label class="label-cyber">Banner_Resolution</label>
                                        <img src="<?php echo SITE_URL.'/'.$me['banner_path']; ?>" class="w-100 rounded border border-neon-blue mb-2" style="height:80px;object-fit:cover;">
                                        <input type="file" name="banner" class="form-control form-control-sm bg-black text-light border-neon-blue">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3"><label class="label-cyber">Encrypted Legal Name</label><input type="text" name="full_name" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($me['full_name'] ?? ''); ?>"></div>
                                    <div class="col-md-6 mb-3"><label class="label-cyber">Status</label><select name="relationship_status" class="form-select bg-black text-light border-secondary"><?php foreach(['Single','Dating','Married','Widow'] as $o) echo "<option ".($me['relationship_status']==$o?'selected':'').">$o</option>"; ?></select></div>
                                    <div class="col-md-6 mb-3"><label class="label-cyber">Progeny (Kids)</label><select name="has_kids" class="form-select bg-black text-light border-secondary"><option value="no" <?php echo $me['has_kids']=='no'?'selected':''; ?>>No</option><option value="yes" <?php echo $me['has_kids']=='yes'?'selected':''; ?>>Yes</option></select></div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="loc">
                                <h5 class="text-neon-blue mb-4 stencil-text small">Physical_Location_Data</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3"><label class="label-cyber">Address 1</label><input type="text" name="address_1" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($me['address_1'] ?? ''); ?>"></div>
                                    <div class="col-md-6 mb-3"><label class="label-cyber">Address 2</label><input type="text" name="address_2" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($me['address_2'] ?? ''); ?>"></div>
                                    <div class="col-md-4 mb-3"><label class="label-cyber">City</label><input type="text" name="city" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($me['city'] ?? ''); ?>"></div>
                                    <div class="col-md-4 mb-3"><label class="label-cyber">State</label><input type="text" name="state" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($me['state'] ?? ''); ?>"></div>
                                    <div class="col-md-4 mb-3"><label class="label-cyber">Zip</label><input type="text" name="zip" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($me['zip'] ?? ''); ?>"></div>
                                    <div class="col-md-6 mb-3"><label class="label-cyber">Country</label><input type="text" name="country" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($me['country'] ?? ''); ?>"></div>
                                    <div class="col-md-6 mb-3"><label class="label-cyber">Phone</label><input type="text" name="phone" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($me['phone'] ?? ''); ?>"></div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="soc">
                                <h5 class="text-neon-blue mb-4 stencil-text small">Neural_Grid_Inbound</h5>
                                <div class="row">
                                    <?php $s = ['fb_handle'=>'Facebook','x_handle'=>'X','ig_handle'=>'Insta','li_handle'=>'LinkedIn','gh_handle'=>'GitHub','h1_handle'=>'HackerOne','bc_handle'=>'BugCrowd','it_handle'=>'Intigriti','ywh_handle'=>'YesWeHack','so_handle'=>'StackOverflow','medium_handle'=>'Medium','yt_handle'=>'YouTube','twitch_handle'=>'Twitch','kick_handle'=>'Kick']; 
                                    foreach($s as $k => $l): ?>
                                        <div class="col-md-4 mb-3"><label class="label-cyber"><?php echo $l; ?></label><input type="text" name="<?php echo $k; ?>" class="form-control bg-black text-light border-secondary form-control-sm" value="<?php echo htmlspecialchars($me[$k] ?? ''); ?>"></div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="game">
                                <h5 class="text-neon-blue mb-4 stencil-text small">Sim_Link_Coordinates</h5>
                                <div class="row">
                                    <?php $g = ['xbox_handle'=>'Xbox','ps_handle'=>'PSN','steam_handle'=>'Steam','blizzard_handle'=>'BattleNet','nintendo_handle'=>'Nintendo']; 
                                    foreach($g as $k => $l): ?>
                                        <div class="col-md-4 mb-3"><label class="label-cyber"><?php echo $l; ?></label><input type="text" name="<?php echo $k; ?>" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($me[$k] ?? ''); ?>"></div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="work">
                                <h5 class="text-neon-blue mb-4 stencil-text small">Professional_Intel</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3"><label class="label-cyber">Corporation</label><input type="text" name="job_company" class="form-control bg-black text-light border-neon-blue" value="<?php echo htmlspecialchars($me['job_company'] ?? ''); ?>"></div>
                                    <div class="col-md-6 mb-3"><label class="label-cyber">Designation</label><input type="text" name="job_title" class="form-control bg-black text-light border-neon-blue" value="<?php echo htmlspecialchars($me['job_title'] ?? ''); ?>"></div>
                                    <div class="col-12 mb-3"><label class="label-cyber">Job Description</label><textarea name="job_description" class="form-control bg-black text-light border-secondary" rows="4"><?php echo htmlspecialchars($me['job_description'] ?? ''); ?></textarea></div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="edu">
                                <h5 class="text-neon-blue mb-4 stencil-text small">Intellectual_Vault</h5>
                                <div class="row">
                                    <div class="col-12 mb-3"><label class="label-cyber">High School</label><input type="text" name="highschool" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($me['highschool'] ?? ''); ?>"></div>
                                    <?php for($i=1;$i<=3;$i++): ?>
                                        <div class="col-md-6 mb-3"><label class="label-cyber">College [<?php echo $i; ?>]</label><input type="text" name="college_<?php echo $i; ?>" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($me['college_'.$i] ?? ''); ?>"></div>
                                        <div class="col-md-6 mb-3"><label class="label-cyber">Diploma [<?php echo $i; ?>]</label><input type="text" name="diploma_<?php echo $i; ?>" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($me['diploma_'.$i] ?? ''); ?>"></div>
                                    <?php endfor; ?>
                                    <?php for($i=1;$i<=4;$i++): ?>
                                        <div class="col-md-3 mb-3"><label class="label-cyber">Cert [<?php echo $i; ?>]</label><input type="text" name="cert_<?php echo $i; ?>" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($me['cert_'.$i] ?? ''); ?>"></div>
                                    <?php endfor; ?>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="int">
                                <h5 class="text-neon-blue mb-4 stencil-text small">Global_Identity_Narrative</h5>
                                <div class="mb-3"><label class="label-cyber">Snippet (Short Bio)</label><input type="text" name="short_bio" class="form-control bg-black text-light border-neon-blue" value="<?php echo htmlspecialchars($me['short_bio'] ?? ''); ?>"></div>
                                <div class="mb-3"><label class="label-cyber">Full Global Bio (MARKDOWN)</label><textarea name="bio" class="form-control bg-black text-light border-neon-blue font-monospace" rows="10"><?php echo htmlspecialchars($me['bio'] ?? ''); ?></textarea></div>
                                <div class="row">
                                    <?php $i = ['fav_books'=>'Grimoires','fav_shows'=>'Sims','fav_movies'=>'Holovids','fav_songs'=>'Waves','fav_activities'=>'Ops']; 
                                    foreach($i as $k => $l): ?>
                                        <div class="col-md-4 mb-3"><label class="label-cyber"><?php echo $l; ?></label><input type="text" name="<?php echo $k; ?>" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($me[$k] ?? ''); ?>"></div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.label-cyber { font-size: 0.65rem; color: var(--neon-blue); letter-spacing: 1px; margin-bottom: 3px; text-transform: uppercase; font-weight: bold; display: block; }
.nav-pills .nav-link { color: #fff; border: 1px solid var(--neon-blue); border-radius: 0; margin-bottom: 5px; font-size: 0.75rem; text-align: left; opacity: 0.6; }
.nav-pills .nav-link.active { background: var(--neon-blue) !important; color: #000 !important; font-weight: bold; box-shadow: 0 0 15px var(--neon-blue); opacity: 1; }
.shadow-neon { box-shadow: 0 0 15px rgba(0, 242, 255, 0.4); }
.min-vh-70 { min-height: 70vh; }
</style>

<?php include_once '../includes/footer.php'; ?>