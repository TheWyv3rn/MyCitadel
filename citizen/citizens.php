<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: CITIZEN DIRECTORY
 * VERSION: 1.2.0
 * DESCRIPTION: High-fidelity grid with Toastify integration and path-fixed assets.
 */

declare(strict_types=1);
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth/gatekeeper.php'; 
require_once __DIR__ . '/../includes/header.php';

$db = citadel_db();
$my_id = (int)$_SESSION['citizen_id'];

/**
 * 1. SECURE DATA FETCH
 * Joins connections to determine the relationship state between the viewer and the target.
 */
$sql = "
    SELECT c.id, c.alias, c.avatar_path, c.banner_path, c.reputation, c.created_at,
           conn.status as connection_status,
           conn.requester_id
    FROM citizens c
    LEFT JOIN connections conn ON 
        ((conn.user_id_1 = ? AND conn.user_id_2 = c.id) OR (conn.user_id_1 = c.id AND conn.user_id_2 = ?))
    WHERE c.id != ?
    ORDER BY c.reputation DESC
";

$stmt = $db->prepare($sql);
$stmt->execute([$my_id, $my_id, $my_id]);
$citizens = $stmt->fetchAll();

// Define Absolute Path Defaults
$def_avatar = SITE_URL . '/citizen/media/avatars/default_avatar.png';
$def_banner = SITE_URL . '/citizen/media/banners/default_banner.png';
?>

<style>
    .directory-header {
        background: linear-gradient(to bottom, rgba(0,0,0,0.6), transparent);
        padding: 60px 0;
        margin-bottom: 40px;
        border-bottom: 1px solid var(--void-border);
    }
    
    .scan-input {
        background: rgba(0,0,0,0.8);
        border: 1px solid var(--neon-blue);
        color: var(--neon-blue);
        font-family: var(--font-mono);
        text-transform: uppercase;
        letter-spacing: 2px;
        box-shadow: inset 0 0 10px rgba(0, 242, 255, 0.1);
    }

    .citizen-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 50px 30px;
        padding-bottom: 100px;
    }

    /* The Card Architecture */
    .citizen-card {
        background: var(--void-surface);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        position: relative;
        transition: var(--transition-smooth);
        backdrop-filter: var(--glass-blur);
    }

    .citizen-card:hover {
        transform: translateY(-10px) scale(1.02);
        border-color: var(--neon-blue);
        box-shadow: 0 20px 40px rgba(0,0,0,0.6), 0 0 20px rgba(0, 242, 255, 0.1);
    }

    .card-banner {
        height: 140px;
        width: 100%;
        background-size: cover;
        background-position: center;
        border-radius: 20px 20px 0 0;
        border-bottom: 1px solid rgba(0, 242, 255, 0.2);
    }

    /* Hexagon Avatar Geometry */
    .hex-wrapper {
        position: absolute;
        top: 85px; /* Offset to overlap 50% */
        left: 50%;
        transform: translateX(-50%);
        width: 110px;
        height: 120px;
        z-index: 10;
        filter: drop-shadow(0 10px 15px rgba(0,0,0,0.8));
    }

    .hex-outer {
        width: 100%;
        height: 100%;
        background: var(--neon-blue);
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hex-inner {
        width: 94%;
        height: 94%;
        background: var(--deep-void);
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        overflow: hidden;
    }

    .hex-inner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Content Styling */
    .card-content {
        padding: 80px 20px 30px;
        text-align: center;
    }

    .alias-text {
        font-family: 'Orbitron', sans-serif;
        font-weight: 900;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 5px;
        animation: neonBreathing 4s infinite ease-in-out;
    }

    @keyframes neonBreathing {
        0%, 100% { text-shadow: 0 0 5px var(--neon-blue); }
        50% { text-shadow: 0 0 15px var(--neon-blue), 0 0 25px var(--space-purple); }
    }

    .rep-counter {
        font-family: var(--font-mono);
        font-size: 0.7rem;
        color: var(--alien-green);
        background: rgba(57, 255, 20, 0.05);
        padding: 2px 10px;
        border-radius: 50px;
        display: inline-block;
        border: 1px solid rgba(57, 255, 20, 0.2);
    }

    .btn-establishing {
        pointer-events: none;
        opacity: 0.6;
    }
</style>

<div class="directory-header">
    <div class="container">
        <h1 class="stencil-text text-white text-center mb-4"><?php echo __t('notif', 'site_search') ?: 'CITIZEN_ARCHIVE_SCAN'; ?></h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-black border-neon-blue text-neon-blue"><i class="fas fa-search"></i></span>
                    <input type="text" id="directorySearch" class="form-control scan-input text-center" placeholder="[ <?php echo __t('notif', 'search_placeholder') ?: 'ENTER ALIAS TO RESOLVE'; ?> ]">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="citizen-grid">
        <?php foreach ($citizens as $cit): 
            // FIXED PATH LOGIC
            $cit_banner = (!empty($cit['banner_path']) && strpos($cit['banner_path'], 'default.png') === false) 
                        ? SITE_URL . '/' . ltrim($cit['banner_path'], '/') 
                        : $def_banner;
                        
            $cit_avatar = (!empty($cit['avatar_path']) && strpos($cit['avatar_path'], 'default.png') === false) 
                        ? SITE_URL . '/' . ltrim($cit['avatar_path'], '/') 
                        : $def_avatar;
            
            $status = $cit['connection_status'];
        ?>
            <div class="citizen-card animate__animated animate__fadeIn" data-alias="<?php echo strtolower($cit['alias']); ?>">
                <div class="card-banner" style="background-image: url('<?php echo $cit_banner; ?>');"></div>
                
                <div class="hex-wrapper">
                    <div class="hex-outer">
                        <div class="hex-inner">
                            <img src="<?php echo $cit_avatar; ?>" alt="CID-<?php echo $cit['id']; ?>">
                        </div>
                    </div>
                </div>

                <div class="card-content">
                    <h3 class="alias-text"><?php echo htmlspecialchars($cit['alias']); ?></h3>
                    <div class="rep-counter mb-3">REP_STANDING: <?php echo number_format((int)$cit['reputation']); ?></div>
                    
                    <p class="x-small text-muted font-mono mb-4">
                        ESTABLISHED: <?php echo date('Y.m.d', strtotime($cit['created_at'])); ?>
                    </p>

                    <div class="action-gate d-grid gap-2">
                        <?php if ($status === 'accepted'): ?>
                            <a href="view_profile.php?id=<?php echo $cit['id']; ?>" class="btn-cyber py-2">
                                <i class="fas fa-id-badge"></i> <?php echo __t('notif', 'btn_view') ?: 'VIEW_DOSSIER'; ?>
                            </a>
                            <button class="btn btn-sm btn-outline-danger border-0 font-mono" onclick="initiateUplink(<?php echo $cit['id']; ?>, 'sever', this)">
                                <?php echo __t('notif', 'btn_sever') ?: 'SEVER_LINK'; ?>
                            </button>
                        <?php elseif ($status === 'pending'): ?>
                            <button class="btn btn-dark border-secondary text-muted py-2 disabled font-mono">
                                <i class="fas fa-satellite-dish fa-spin"></i> <?php echo __t('notif', 'btn_pending') ?: 'UPLINK_PENDING'; ?>
                            </button>
                        <?php else: ?>
                            <button class="btn-cyber py-2" onclick="initiateUplink(<?php echo $cit['id']; ?>, 'establish', this)">
                                <i class="fas fa-link"></i> <?php echo __t('notif', 'btn_establish') ?: 'ESTABLISH_UPLINK'; ?>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
/**
 * Global Uplink Handler
 * Integrates Toastify for tactical feedback and UI lockdown.
 */
function initiateUplink(targetId, action, btn) {
    // Localization constants for JS
    const msgTransmitting = "<?php echo __t('notif', 'js_transmitting') ?: 'TRANSMITTING...'; ?>";
    const msgSuccess = (action === 'sever') 
        ? "<?php echo __t('notif', 'toast_severed') ?: 'LINK_SEVERED: Connection Purged.'; ?>"
        : "<?php echo __t('notif', 'toast_request_sent') ?: 'HANDSHAKE_COMPLETE: Request Transmitted.'; ?>";

    // Immediate UI Feedback
    const originalContent = btn.innerHTML;
    btn.classList.add('btn-establishing');
    btn.innerHTML = `<i class="fas fa-spinner fa-spin"></i> ${msgTransmitting}`;

    fetch('<?php echo SITE_URL; ?>/includes/api/connection_handler.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ target_id: targetId, action: action })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            Toastify({
                text: msgSuccess,
                duration: 4000,
                gravity: "bottom",
                position: "right",
                style: {
                    background: action === 'sever' ? "#ff003c" : "linear-gradient(to right, #00f2ff, #7b2ff7)",
                    fontFamily: "Orbitron",
                    fontSize: "0.8rem",
                    border: "1px solid #00f2ff"
                }
            }).showToast();
            
            // Reload after toast to show state change
            setTimeout(() => location.reload(), 2000);
        } else {
            btn.innerHTML = originalContent;
            btn.classList.remove('btn-establishing');
            alert("UPLINK_FAILURE: " + data.error);
        }
    })
    .catch(err => {
        btn.innerHTML = originalContent;
        btn.classList.remove('btn-establishing');
        console.error("CRITICAL_UPLINK_ERR:", err);
    });
}

// Neural Search Filter
document.getElementById('directorySearch').addEventListener('input', function(e) {
    const term = e.target.value.toLowerCase();
    document.querySelectorAll('.citizen-card').forEach(card => {
        card.style.display = card.dataset.alias.includes(term) ? 'block' : 'none';
    });
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>