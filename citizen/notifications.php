<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: NOTIFICATION HUB (MASTER v2.0)
 * VERSION: 2.0.0
 * DESCRIPTION: Tactical data-log for all neural handshakes and system alerts.
 * FEATURES: 100% Responsive, i18n Integrated, Action-Aware.
 */

declare(strict_types=1);
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth/gatekeeper.php'; 
require_once __DIR__ . '/../includes/header.php';

$db = citadel_db();
$my_id = (int)$_SESSION['citizen_id'];

/**
 * 1. FETCH ACTIVE TRANSMISSIONS
 * Joins with citizens to get the identity data of the sender.
 */
$sql = "
    SELECT n.*, c.alias, c.avatar_path 
    FROM notifications n
    JOIN citizens c ON n.from_id = c.id
    WHERE n.citizen_id = ?
    ORDER BY n.is_read ASC, n.created_at DESC
";
$stmt = $db->prepare($sql);
$stmt->execute([$my_id]);
$alerts = $stmt->fetchAll();

$def_avatar = SITE_URL . '/citizen/media/avatars/default_avatar.png';
?>

<style>
    .notif-wrapper {
        background: var(--void-surface);
        border: 1px solid var(--void-border);
        border-radius: 20px;
        backdrop-filter: var(--glass-blur);
        overflow: hidden;
        margin-bottom: 100px;
    }

    /* Terminal Row Styling */
    .notif-item {
        border-bottom: 1px solid rgba(255, 255, 255, 0.03);
        transition: var(--transition-smooth);
        position: relative;
    }

    .notif-item:hover {
        background: rgba(0, 242, 255, 0.02);
    }

    .unread-indicator {
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--neon-blue);
        box-shadow: 0 0 10px var(--neon-blue);
    }

    /* Identity Hexagon (Mini) */
    .mini-hex-wrapper {
        width: 50px;
        height: 55px;
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        background: var(--neon-blue);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .mini-hex-inner {
        width: 90%;
        height: 90%;
        background: var(--deep-void);
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        overflow: hidden;
    }

    .mini-hex-inner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Action Buttons */
    .btn-notif {
        font-family: var(--font-mono);
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 1px;
        padding: 8px 15px;
        transition: all 0.3s;
    }

    .btn-accept-link {
        color: var(--alien-green);
        border: 1px solid var(--alien-green);
        background: transparent;
    }

    .btn-accept-link:hover {
        background: var(--alien-green);
        color: #000;
        box-shadow: 0 0 15px var(--alien-green);
    }

    .btn-deny-link {
        color: var(--glitch-red);
        border: 1px solid var(--glitch-red);
        background: transparent;
    }

    .btn-deny-link:hover {
        background: var(--glitch-red);
        color: #fff;
    }

    @media (max-width: 768px) {
        .notif-content { flex-direction: column; align-items: flex-start !important; }
        .notif-actions { width: 100%; margin-top: 15px; display: flex; gap: 10px; }
        .btn-notif { flex-grow: 1; text-align: center; }
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-10">
            
            <header class="d-flex justify-content-between align-items-center mb-5 animate__animated animate__fadeIn">
                <div>
                    <h1 class="stencil-text text-white mb-1"><?php echo __t('nav', 'notif_h'); ?></h1>
                    <p class="text-secondary font-mono small mb-0">// <?php echo __t('notif', 'subtitle') ?: 'MONITORING_NEURAL_TRAFFIC'; ?></p>
                </div>
                <button class="btn btn-sm btn-outline-secondary font-mono" onclick="purgeAlerts()">
                    <i class="fas fa-trash-alt me-2"></i> <?php echo __t('notif', 'mark_read') ?: 'PURGE_READ'; ?>
                </button>
            </header>

            <div class="notif-wrapper shadow-lg animate__animated animate__fadeInUp">
                <?php if (empty($alerts)): ?>
                    <div class="text-center py-5">
                        <i class="fas fa-satellite fa-3x text-muted mb-3 d-block"></i>
                        <span class="text-muted font-mono"><?php echo __t('notif', 'empty') ?: 'NO_ACTIVE_TRANSMISSIONS_IN_QUEUE'; ?></span>
                    </div>
                <?php endif; ?>

                <?php foreach ($alerts as $a): 
                    $is_unread = !$a['is_read'];
                    $avatar = (!empty($a['avatar_path']) && strpos($a['avatar_path'], 'default.png') === false) 
                              ? SITE_URL . '/' . ltrim($a['avatar_path'], '/') 
                              : $def_avatar;
                ?>
                    <div class="notif-item p-4 d-flex align-items-center justify-content-between notif-content <?php echo $is_unread ? 'notif-unread' : ''; ?>">
                        <?php if ($is_unread): ?><div class="unread-indicator"></div><?php endif; ?>

                        <div class="d-flex align-items-center">
                            <div class="mini-hex-wrapper me-4">
                                <div class="mini-hex-inner">
                                    <img src="<?php echo $avatar; ?>" alt="Node Origin">
                                </div>
                            </div>
                            
                            <div>
                                <div class="text-white small mb-1">
                                    <?php 
                                        switch($a['notif_type']) {
                                            case 'request': 
                                                echo "<strong>" . htmlspecialchars($a['alias']) . "</strong> " . (__t('notif', 'type_request') ?: 'wishes to establish a connection with you!'); 
                                                break;
                                            case 'accepted': 
                                                echo (__t('notif', 'type_accepted') ?: 'CONNECTION ESTABLISHED WITH') . " <strong>" . htmlspecialchars($a['alias']) . "</strong>"; 
                                                break;
                                            case 'declined': 
                                                echo "<strong>" . htmlspecialchars($a['alias']) . "</strong> " . (__t('notif', 'type_declined') ?: 'DID NOT ACCEPT CONNECTION REQUEST'); 
                                                break;
                                            case 'severed': 
                                                echo "<strong>" . htmlspecialchars($a['alias']) . "</strong> " . (__t('notif', 'type_severed') ?: 'HAS SEVERED THE CONNECTION WITH YOU.'); 
                                                break;
                                        }
                                    ?>
                                </div>
                                <div class="x-small text-muted font-mono"><?php echo date('Y.m.d H:i:s', strtotime($a['created_at'])); ?></div>
                            </div>
                        </div>

                        <div class="notif-actions">
                            <?php if ($a['notif_type'] === 'request' && $is_unread): ?>
                                <button class="btn btn-notif btn-accept-link me-2" onclick="handleHandshake(<?php echo $a['id']; ?>, 'accept', this)">
                                    <i class="fas fa-link"></i> <?php echo __t('notif', 'btn_accept') ?: 'ACCEPT'; ?>
                                </button>
                                <button class="btn btn-notif btn-deny-link" onclick="handleHandshake(<?php echo $a['id']; ?>, 'deny', this)">
                                    <i class="fas fa-times"></i>
                                </button>
                            <?php else: ?>
                                <span class="badge bg-dark border border-secondary text-secondary font-mono x-small p-2">
                                    <i class="fas fa-check-double me-1"></i> RESOLVED
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>

<script>
/**
 * Handle Handshake (Accept/Deny)
 */
function handleHandshake(notifId, action, btn) {
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

    fetch('<?php echo SITE_URL; ?>/includes/api/notification_processor.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ notif_id: notifId, action: action })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            Toastify({
                text: action === 'accept' ? "UPLINK_ESTABLISHED" : "HANDSHAKE_REFUSED",
                duration: 3000,
                gravity: "bottom",
                position: "right",
                style: { background: action === 'accept' ? "#39ff14" : "#ff003c", color: "#000", fontFamily: "Orbitron" }
            }).showToast();
            setTimeout(() => location.reload(), 1500);
        } else {
            btn.disabled = false;
            btn.innerHTML = originalText;
            alert("UPLINK_ERROR: " + data.error);
        }
    });
}

/**
 * Purge Alerts (Mark all as read)
 */
function purgeAlerts() {
    fetch('<?php echo SITE_URL; ?>/includes/api/notification_processor.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'purge' })
    }).then(() => location.reload());
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>