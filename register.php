<?php
/**
 * MYCITADEL // CITIZEN REGISTRATION GATE v5.0
 * Sector: Sovereignty Initialization (Front-End)
 * Identity: Near Zero-Knowledge Handshake
 */

require_once __DIR__ . '/../private/citadel_config.php';

// 1. SET PAGE TITLE (Dynamic Multilingual)
$page_title = __t('nav', 'register');

// 2. AJAX ALIAS INTEGRITY CHECK (Server-side check before submission)
if (isset($_POST['action']) && $_POST['action'] === 'check_alias') {
    $alias = preg_replace("/[^a-zA-Z0-9_]/", "", $_POST['alias']);
    $stmt = $pdo->prepare("SELECT id FROM citizens WHERE alias = ? LIMIT 1");
    $stmt->execute([$alias]);
    echo $stmt->fetch() ? 'taken' : 'available';
    exit;
}

require_once __DIR__ . '/1nclud3z/h34d3r.php'; 
?>

<style>
    /* 1. SOVEREIGN TYPOGRAPHY */
    @font-face { font-family: 'Orbitron'; src: url('/4ss37z/f0n7z/Orbitron/Orbitron-Bold.ttf') format('truetype'); font-weight: bold; }
    @font-face { font-family: 'SourceCodePro'; src: url('/4ss37z/f0n7z/SourceCodePro/SourceCodePro-Regular.ttf') format('truetype'); }

    /* 2. HUD LAYERING & AESTHETICS */
    #particles-js { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; pointer-events: none; opacity: 0.5; }
    .registration-ui-layer { position: relative; z-index: 10; font-family: 'SourceCodePro', monospace; }

    .hud-panel {
        background: rgba(0, 0, 0, 0.95) !important;
        border: 2px solid #bc13fe !important; /* Sovereign Purple */
        box-shadow: 0 0 35px rgba(188, 19, 254, 0.4), inset 0 0 15px rgba(188, 19, 254, 0.1);
        border-radius: 2px;
    }

    .input-terminal {
        background-color: #000 !important;
        color: #39ff14 !important; /* Terminal Green */
        border: 1px solid #bc13fe !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .input-terminal:focus {
        border-color: #39ff14 !important;
        box-shadow: 0 0 20px rgba(57, 255, 20, 0.4);
        outline: none;
    }

    .label-fancy {
        font-family: 'Orbitron', sans-serif;
        font-size: 0.65rem;
        letter-spacing: 0.25em;
        color: #bc13fe;
        text-transform: uppercase;
        font-weight: bold;
    }

    /* 3. SENTINEL STATE INDICATORS */
    .sentinel-node { font-size: 0.6rem; font-weight: bold; transition: 0.4s; }
    .sentinel-valid { color: #39ff14; text-shadow: 0 0 8px rgba(57, 255, 20, 0.5); }
    .sentinel-invalid { color: #ff3131; opacity: 0.3; }

    /* 4. ACTION BUTTON */
    .btn-sovereign {
        font-family: 'Orbitron', sans-serif;
        background: #000;
        color: #bc13fe;
        border: 2px solid #bc13fe;
        letter-spacing: 0.4em;
        text-transform: uppercase;
        transition: all 0.4s ease;
    }

    .btn-sovereign:hover:not(:disabled) {
        background: #bc13fe;
        color: #000;
        box-shadow: 0 0 40px #bc13fe;
        transform: translateY(-2px);
    }

    .btn-sovereign:disabled { border-color: #222; color: #444; cursor: not-allowed; }

    .form-check-input { background-color: #000; border-color: #bc13fe; cursor: pointer; }
    .form-check-input:checked { background-color: #bc13fe; border-color: #bc13fe; }

    /* Mobile Scaling */
    @media (max-width: 768px) {
        .display-4 { font-size: 2.2rem; }
        .hud-panel { padding: 1.5rem !important; }
    }
</style>

<!-- BACKGROUND TELEMETRY -->
<div id="particles-js"></div>

<div class="registration-ui-layer container-fluid px-3 py-5 min-vh-100 d-flex flex-column justify-content-center align-items-center">
    
    <!-- HEADER -->
    <div class="text-center mb-5 animate__animated animate__fadeInDown">
        <div class="d-inline-flex align-items-center mb-3 px-3 py-1 border border-primary/20 bg-primary/5 rounded-pill">
            <span class="text-[0.55rem] font-bold tracking-[0.5em] uppercase text-primary">
                <?php echo __t('index', 'pre_flight'); ?>
            </span>
        </div>
        <h1 class="display-4 font-black uppercase italic mb-0 text-white" style="font-family: 'Orbitron'; letter-spacing: -2px;">
            <?php echo __t('common', 'btn_register'); ?>
        </h1>
        <p class="text-[0.6rem] text-primary/40 uppercase tracking-[0.5em] font-mono mt-2">
            // <?php echo __t('register', 'initializing'); ?>
        </p>
    </div>

    <!-- MAIN FORM TERMINAL -->
    <div class="w-100" style="max-width: 550px;">
        <form id="citadelRegForm" class="hud-panel p-4 p-md-5 animate__animated animate__fadeInUp">
            
            <!-- FEEDBACK HUB -->
            <div id="form-feedback" class="mb-4 d-none p-3 border font-mono small uppercase"></div>

            <div class="row g-4">
                <!-- ALIAS BLOCK (Case Sensitive, Unique) -->
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-end mb-2">
                        <label class="label-fancy"><?php echo __t('register', 'alias'); ?></label>
                        <span id="aliasCheck" class="text-[0.5rem] font-mono tracking-tighter"></span>
                    </div>
                    <input type="text" id="alias" required maxlength="20"
                           class="input-terminal form-control p-3 rounded-0"
                           placeholder="Citizen001">
                </div>

                <!-- EMAIL BLOCK -->
                <div class="col-12">
                    <label class="label-fancy mb-2"><?php echo __t('register', 'email'); ?></label>
                    <input type="email" id="raw_email" required 
                           class="input-terminal form-control p-3 rounded-0"
                           placeholder="noreply@mycitadel.lol">
                </div>

                <!-- MASTER KEY SENTINEL -->
                <div class="col-12">
                    <label class="label-fancy mb-2"><?php echo __t('register', 'password'); ?></label>
                    <input type="password" id="raw_password" required 
                           class="input-terminal form-control p-3 rounded-0"
                           placeholder="••••••••••••••••">
                    
                    <!-- REAL-TIME SENTINEL MATRIX -->
                    <div class="row g-2 p-3 bg-black rounded border border-white/5 mt-3 mx-0">
                        <p style="text-align: center; margin: 0 auto; color: #0F0;">
                            <?php echo __t('register', 'password_strength'); ?>
                        </p>
                        <div id="m-upper" class="col-6 sentinel-node sentinel-invalid d-flex align-items-center">
                            <i class="fas fa-microchip me-2"></i> <?php echo __t('register', 'upper'); ?>
                        </div>
                        <div id="m-lower" class="col-6 sentinel-node sentinel-invalid d-flex align-items-center">
                            <i class="fas fa-microchip me-2"></i> <?php echo __t('register', 'lower'); ?>
                        </div>
                        <div id="m-number" class="col-6 sentinel-node sentinel-invalid d-flex align-items-center">
                            <i class="fas fa-microchip me-2"></i> <?php echo __t('register', 'nums'); ?>
                        </div>
                        <div id="m-symbol" class="col-6 sentinel-node sentinel-invalid d-flex align-items-center">
                            <i class="fas fa-microchip me-2"></i> <?php echo __t('register', 'syms'); ?>
                        </div>
                    </div>
                </div>

                <!-- CONFIRM KEY -->
                <div class="col-12">
                    <label class="label-fancy mb-2"><?php echo __t('register', 'verify_password'); ?></label>
                    <input type="password" id="confirm_password" required 
                           class="input-terminal form-control p-3 rounded-0"
                           placeholder="••••••••••••••••">
                </div>

                <!-- SOVEREIGN AGREEMENT -->
                <div class="col-12 mt-4">
                    <div class="p-3 bg-black border border-primary/10 rounded-0">
                        <div class="form-check d-flex align-items-center">
                            <input type="checkbox" id="agree_laws" required
                                   class="form-check-input">
                            <label for="agree_laws" class="form-check-label font-mono text-[0.6rem] text-primary ms-3 cursor-pointer uppercase">
                                <?php echo __t('register', 'swear'); ?> <a href="laws.php" class="text-white underline"><?php echo __t('register', 'laws'); ?></a>.
                            </label>
                        </div>
                    </div>
                </div>

                <!-- SUBMIT ACTION -->
                <div class="col-12 pt-2">
                    <button type="submit" id="initBtn" disabled
                            class="btn btn-sovereign w-100 py-4 font-black rounded-0 shadow-lg">
                        <?php echo __t('register', 'establish_citizenship'); ?>
                    </button>
                </div>
            </div>
        </form>

        <div class="mt-5 text-center animate__animated animate__fadeIn">
            <a href="login.php" class="label-fancy opacity-40 hover:opacity-100 transition-all text-decoration-none">
                // <?php echo __t('register', 'login_text'); ?>
            </a>
        </div>
    </div>
</div>

<!-- EXTERNAL CRYPTO LOGIC ENGINE -->
<script src="/4ss37z/js/register_logic.js"></script>

<?php 
$load_assets = ['particles'];
require_once __DIR__ . '/1nclud3z/f0073r.php'; 
?>