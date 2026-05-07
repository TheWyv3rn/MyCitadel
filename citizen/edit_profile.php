<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: DOSSIER ARCHIVE EDITOR (CORE v12.0)
 * FIXES: Password/Email Scrambler Sync, 100% Field Coverage, Decryption Visibility.
 */
include_once '../includes/config.php';
include_once '../includes/auth/gatekeeper.php';

$db = citadel_db(); 
$cit_id = (int)$_SESSION['citizen_id'];

// --- 1. FIELD REGISTRY ---
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

$sov_key = $_SESSION['sovereign_key'] ?? hash('sha256', 'Mustang_Sprint_2024_' . $cit_id, true);

// Unified Decryption for UI
function reveal($data, $key) {
    if (empty($data) || !$key) return '';
    try {
        $decoded = base64_decode((string)$data);
        if (!$decoded || strlen($decoded) < 32) return $data;
        $nonce = substr($decoded, 0, 24);
        $ciphertext = substr($decoded, 24);
        $p = sodium_crypto_secretbox_open($ciphertext, $nonce, $key);
        return ($p === false) ? $data : $p;
    } catch (Exception $e) { return $data; }
}

$stmt = $db->prepare("SELECT * FROM citizens WHERE id = ? LIMIT 1");
$stmt->execute([$cit_id]);
$me = $stmt->fetch();

// Create decrypted set for form values
$dec = $me;
foreach ($enc_targets as $f) { $dec[$f] = reveal($me[$f], $sov_key); }
?>

<?php include_once '../includes/header.php'; ?>
<?php include_once '../includes/nav.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12">
            <h2 class="stencil-text text-neon-blue mb-4">DOSSIER_SYNCHRONIZER_v12.0</h2>
            
            <?php if(isset($_GET['success'])): ?><div class="alert bg-alien-green text-black border-0">ARCHIVE_SYNC_SUCCESS: Rep Points & Badges updated.</div><?php endif; ?>
            <?php if(isset($_GET['error'])): ?><div class="alert bg-danger text-white border-0">PROTOCOL_FAILURE: <?php echo htmlspecialchars($_GET['error']); ?></div><?php endif; ?>

            <form id="editForm" action="../includes/auth/process_edit.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="scrambled_email" name="scrambled_email">
                <input type="hidden" id="scrambled_pass" name="scrambled_pass">

                <div class="row">
                    <div class="col-lg-3">
                        <div class="nav flex-column nav-pills border border-neon-blue bg-black p-3 rounded mb-4 shadow-neon" role="tablist">
                            <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#t1" type="button">1. ACCESS_LINK</button>
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#t2" type="button">2. IDENTITY</button>
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#t3" type="button">3. RESIDENCE</button>
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#t4" type="button">4. SOCIAL_HANDLES</button>
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#t5" type="button">5. GAMING_IDS</button>
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#t6" type="button">6. PROFESSIONAL</button>
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#t7" type="button">7. ACADEMIC</button>
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#t8" type="button">8. NARRATIVE</button>
                        </div>
                        <button type="submit" class="btn-cyber w-100 py-3 shadow-neon">COMMIT TO DATABASE</button>
                    </div>

                    <div class="col-lg-9">
                        <div class="tab-content bg-void-surface border border-neon-blue p-4 rounded shadow-lg">
                            
                            <div class="tab-pane fade show active" id="t1">
                                <h5 class="text-neon-blue stencil-text small mb-4">Airlock_Credentials</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="label-cyber">New Email (Syncs to Login)</label>
                                        <input type="email" id="email_raw" class="form-control bg-black text-light border-neon-blue">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="label-cyber">New Password (Syncs to Login)</label>
                                        <input type="password" id="password_raw" class="form-control bg-black text-light border-neon-blue" placeholder="Leave blank to keep old">
                                    </div>
                                    <div class="col-12">
                                        <label class="label-cyber">GPG Public Key Block</label>
                                        <textarea name="public_key" class="form-control bg-black text-light border-neon-blue font-monospace small" rows="8"><?php echo htmlspecialchars($dec['public_key'] ?? ''); ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="t2">
                                <h5 class="text-neon-blue stencil-text small mb-4">Biometric_Metric_Data</h5>
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
                                    <div class="col-md-12 mb-3"><label class="label-cyber">Full Name</label><input type="text" name="full_name" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($dec['full_name'] ?? ''); ?>"></div>
                                    <div class="col-md-6 mb-3"><label class="label-cyber">Status</label><select name="relationship_status" class="form-select bg-black text-light border-secondary"><?php foreach(['Single','Dating','Married','Widow'] as $o) echo "<option ".($me['relationship_status']==$o?'selected':'').">$o</option>"; ?></select></div>
                                    <div class="col-md-6 mb-3"><label class="label-cyber">Kids?</label><select name="has_kids" class="form-select bg-black text-light border-secondary"><option value="no" <?php echo $me['has_kids']=='no'?'selected':''; ?>>No</option><option value="yes" <?php echo $me['has_kids']=='yes'?'selected':''; ?>>Yes</option></select></div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="t3">
                                <h5 class="text-neon-blue stencil-text small mb-4">Geographic_Lock</h5>
                                <div class="row">
                                    <div class="col-12 mb-3"><label class="label-cyber">Address 1</label><input type="text" name="address_1" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($dec['address_1'] ?? ''); ?>"></div>
                                    <div class="col-12 mb-3"><label class="label-cyber">Address 2</label><input type="text" name="address_2" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($dec['address_2'] ?? ''); ?>"></div>
                                    <div class="col-md-4 mb-3"><label class="label-cyber">City</label><input type="text" name="city" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($dec['city'] ?? ''); ?>"></div>
                                    <div class="col-md-4 mb-3"><label class="label-cyber">State</label><input type="text" name="state" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($dec['state'] ?? ''); ?>"></div>
                                    <div class="col-md-4 mb-3"><label class="label-cyber">Zip</label><input type="text" name="zip" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($dec['zip'] ?? ''); ?>"></div>
                                    <div class="col-md-6 mb-3"><label class="label-cyber">Country</label><input type="text" name="country" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($dec['country'] ?? ''); ?>"></div>
                                    <div class="col-md-6 mb-3"><label class="label-cyber">Phone</label><input type="text" name="phone" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($dec['phone'] ?? ''); ?>"></div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="t4">
                                <h5 class="text-neon-blue stencil-text small mb-4">Neural_Grid_Handles</h5>
                                <div class="row">
                                    <?php $socs = ['fb_handle'=>'Facebook','x_handle'=>'X (Twitter)','ig_handle'=>'Instagram','li_handle'=>'LinkedIn','gh_handle'=>'GitHub','h1_handle'=>'HackerOne','bc_handle'=>'BugCrowd','it_handle'=>'Intigriti','ywh_handle'=>'YesWeHack','so_handle'=>'StackOverflow','medium_handle'=>'Medium','yt_handle'=>'YouTube','twitch_handle'=>'Twitch','kick_handle'=>'Kick']; 
                                    foreach($socs as $k => $l): ?>
                                        <div class="col-md-4 mb-3"><label class="label-cyber"><?php echo $l; ?></label><input type="text" name="<?php echo $k; ?>" class="form-control bg-black text-light border-secondary form-control-sm" value="<?php echo htmlspecialchars($dec[$k] ?? ''); ?>"></div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="t5">
                                <h5 class="text-neon-blue stencil-text small mb-4">Sim_Link_Coordinates</h5>
                                <div class="row">
                                    <?php $games = ['xbox_handle'=>'Xbox','ps_handle'=>'PSN','steam_handle'=>'Steam','blizzard_handle'=>'BattleNet','nintendo_handle'=>'Nintendo']; 
                                    foreach($games as $k => $l): ?>
                                        <div class="col-md-4 mb-3"><label class="label-cyber"><?php echo $l; ?></label><input type="text" name="<?php echo $k; ?>" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($dec[$k] ?? ''); ?>"></div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="t6">
                                <h5 class="text-neon-blue stencil-text small mb-4">Corporate_Dossier</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3"><label class="label-cyber">Corporation</label><input type="text" name="job_company" class="form-control bg-black text-light border-neon-blue" value="<?php echo htmlspecialchars($dec['job_company'] ?? ''); ?>"></div>
                                    <div class="col-md-6 mb-3"><label class="label-cyber">Designation</label><input type="text" name="job_title" class="form-control bg-black text-light border-neon-blue" value="<?php echo htmlspecialchars($dec['job_title'] ?? ''); ?>"></div>
                                    <div class="col-12 mb-3"><label class="label-cyber">Professional Biography</label><textarea name="job_description" class="form-control bg-black text-light border-secondary" rows="4"><?php echo htmlspecialchars($dec['job_description'] ?? ''); ?></textarea></div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="t7">
                                <h5 class="text-neon-blue stencil-text small mb-4">Intellectual_Archives</h5>
                                <div class="row">
                                    <div class="col-12 mb-3"><label class="label-cyber">High School</label><input type="text" name="highschool" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($dec['highschool'] ?? ''); ?>"></div>
                                    <?php for($i=1;$i<=3;$i++): ?>
                                        <div class="col-md-6 mb-3"><label class="label-cyber">College [<?php echo $i; ?>]</label><input type="text" name="college_<?php echo $i; ?>" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($dec['college_'.$i] ?? ''); ?>"></div>
                                        <div class="col-md-6 mb-3"><label class="label-cyber">Diploma [<?php echo $i; ?>]</label><input type="text" name="diploma_<?php echo $i; ?>" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($dec['diploma_'.$i] ?? ''); ?>"></div>
                                    <?php endfor; ?>
                                    <?php for($i=1;$i<=4;$i++): ?>
                                        <div class="col-md-3 mb-3"><label class="label-cyber">Cert [<?php echo $i; ?>]</label><input type="text" name="cert_<?php echo $i; ?>" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($dec['cert_'.$i] ?? ''); ?>"></div>
                                    <?php endfor; ?>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="t8">
                                <h5 class="text-neon-blue mb-4 stencil-text small">Global_Identity_Narrative</h5>
                                <div class="mb-3"><label class="label-cyber">Snippet (Short Bio)</label><input type="text" name="short_bio" class="form-control bg-black text-light border-neon-blue" value="<?php echo htmlspecialchars($dec['short_bio'] ?? ''); ?>"></div>
                                <div class="mb-3"><label class="label-cyber">Full Narrative (Markdown Supported)</label><textarea name="bio" class="form-control bg-black text-light border-neon-blue font-monospace" rows="10"><?php echo htmlspecialchars($dec['bio'] ?? ''); ?></textarea></div>
                                <div class="row">
                                    <?php $ints = ['fav_books'=>'Grimoires','fav_shows'=>'Sims','fav_movies'=>'Holovids','fav_songs'=>'Waves','fav_activities'=>'Ops']; 
                                    foreach($ints as $k => $l): ?>
                                        <div class="col-md-4 mb-3"><label class="label-cyber"><?php echo $l; ?></label><input type="text" name="<?php echo $k; ?>" class="form-control bg-black text-light border-secondary" value="<?php echo htmlspecialchars($dec[$k] ?? ''); ?>"></div>
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

<script>
/**
 * CITADEL AIRLOCK SYNC (v12.0)
 * Scrambles Email and Password using the precise 2056 SALT.
 */
document.getElementById('editForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const emailInput = document.getElementById('email_raw');
    const passInput = document.getElementById('password_raw');

    async function scramble(text) {
        const msgUint8 = new TextEncoder().encode(text + "CITADEL_SALT_2056");
        const hashBuffer = await crypto.subtle.digest('SHA-256', msgUint8);
        return Array.from(new Uint8Array(hashBuffer)).map(b => b.toString(16).padStart(2, '0')).join('');
    }

    if (emailInput.value.trim() !== "") {
        document.getElementById('scrambled_email').value = await scramble(emailInput.value);
    }
    if (passInput.value.trim() !== "") {
        document.getElementById('scrambled_pass').value = await scramble(passInput.value);
    }

    this.submit();
});
</script>

<style>
.label-cyber { font-size: 0.65rem; color: var(--neon-blue); letter-spacing: 1px; margin-bottom: 3px; text-transform: uppercase; font-weight: bold; display: block; }
.nav-pills .nav-link { color: #fff; border: 1px solid var(--neon-blue); border-radius: 0; margin-bottom: 5px; font-size: 0.75rem; text-align: left; opacity: 0.6; }
.nav-pills .nav-link.active { background: var(--neon-blue) !important; color: #000 !important; font-weight: bold; box-shadow: 0 0 15px var(--neon-blue); opacity: 1; }
</style>

<?php include_once '../includes/footer.php'; ?>