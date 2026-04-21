<?php
/**
 * MYCITADEL // CITADEL ACCESS PORTAL v5.5 [ZK_HARDENED]
 * Sector: Security Perimeter
 * Logic: Triple-Factor Challenge-Response (Alias + Email + Key)
 */

require_once __DIR__ . '/../private/citadel_config.php';

// 1. DYNAMIC PAGE TITLE
$page_title = __t('login', 'login') ?? 'ENTER_CITADEL';

require_once __DIR__ . '/1nclud3z/h34d3r.php'; 
?>

<style>
    /* 1. FONT ARCHITECTURE */
    @font-face { font-family: 'Orbitron'; src: url('/4ss37z/f0n7z/Orbitron/Orbitron-Bold.ttf') format('truetype'); font-weight: bold; }
    @font-face { font-family: 'SourceCodePro'; src: url('/4ss37z/f0n7z/SourceCodePro/SourceCodePro-Regular.ttf') format('truetype'); }

    /* 2. LAYER ISOLATION */
    #particles-js {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        z-index: 1 !important;
        pointer-events: none;
        opacity: 0.6;
    }

    .login-ui-layer {
        position: relative;
        z-index: 100 !important;
    }

    /* 3. THEME: MATRIX-NOIR (Black/Green/Purple) */
    .hud-panel {
        background: rgba(0, 0, 0, 0.95) !important;
        border: 2px solid #bc13fe !important; /* Sovereign Purple */
        box-shadow: 0 0 40px rgba(188, 19, 254, 0.3), inset 0 0 20px rgba(188, 19, 254, 0.1);
        border-radius: 2px;
    }

    .input-terminal {
        background-color: #000 !important;
        color: #39ff14 !important; /* Terminal Green */
        font-family: 'SourceCodePro', monospace !important;
        border: 1px solid #bc13fe !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 0.95rem;
    }

    .input-terminal:focus {
        border-color: #39ff14 !important;
        box-shadow: 0 0 20px rgba(57, 255, 20, 0.4);
        background-color: #020202 !important;
        outline: none;
    }

    .input-terminal::placeholder {
        color: rgba(57, 255, 20, 0.2);
        text-transform: uppercase;
        font-size: 0.7rem;
    }

    .label-fancy {
        font-family: 'Orbitron', sans-serif;
        font-size: 0.6rem;
        letter-spacing: 0.3em;
        color: #bc13fe;
        text-transform: uppercase;
        font-weight: bold;
    }

    /* 4. THE AUTH BUTTON */
    .btn-sovereign {
        font-family: 'Orbitron', sans-serif;
        background: #000;
        color: #bc13fe;
        border: 2px solid #bc13fe;
        letter-spacing: 0.4em;
        text-transform: uppercase;
        transition: all 0.4s ease;
        position: relative;
    }

    .btn-sovereign:hover:not(:disabled) {
        background: #bc13fe;
        color: #000;
        box-shadow: 0 0 35px #bc13fe;
        transform: translateY(-2px);
    }

    .btn-sovereign:disabled {
        border-color: #222;
        color: #444;
        cursor: not-allowed;
    }

    /* 5. TELEMETRY OUTPUT */
    #auth-status {
        font-family: 'SourceCodePro', monospace;
        font-size: 0.65rem;
        border-left: 2px solid #39ff14;
        background: rgba(57, 255, 20, 0.05);
    }

    /* 6. RESPONSIVE ADJUSTMENTS */
    @media (max-width: 768px) {
        .display-3 { font-size: 2.2rem; }
        .hud-panel { padding: 1.5rem !important; }
    }
</style>

<!-- BACKGROUND ANIMATION NODE -->
<div id="particles-js"></div>

<div class="login-ui-layer container-fluid px-3 py-5 min-vh-100 d-flex flex-column justify-content-center align-items-center">
    
    <!-- HEADER HUB -->
    <div class="text-center mb-5 animate__animated animate__fadeInDown">
        <div class="d-inline-flex align-items-center mb-3 px-3 py-1 border border-primary/20 bg-primary/5 rounded-pill">
            <span class="text-[0.55rem] font-bold tracking-[0.5em] uppercase text-primary">
                <?php echo __t('login', 'status'); ?> <?php echo __t('login', 'status1'); ?>
            </span>
        </div>
        <h1 class="display-3 font-black uppercase italic mb-0 text-white" style="font-family: 'Orbitron'; letter-spacing: -3px; text-shadow: 0 0 20px rgba(188,19,254,0.5);">
            <?php echo __t('login', 'banner'); ?>
        </h1>
        <p class="text-[0.6rem] text-primary/40 uppercase tracking-[0.5em] font-mono mt-2">
            // <?php echo __t('login', 'sub_title'); ?>
        </p>
    </div>

    <!-- MAIN TERMINAL -->
    <div class="w-100" style="max-width: 480px;">
        <form id="citadelLoginForm" class="hud-panel p-4 p-md-5 animate__animated animate__fadeInUp">
            
            <!-- FEEDBACK HUB -->
            <div id="auth-status" class="mb-4 d-none p-3 text-terminal uppercase">
                <span class="d-block mb-1">> <?php echo __t('login', 'status2'); ?></span>
                <span id="status-text"><?php echo __t('login', 'status3'); ?></span>
            </div>

            <div class="row g-4">
                <!-- ALIAS BLOCK -->
                <div class="col-12">
                    <label class="label-fancy mb-2"><?php echo __t('login', 'alias'); ?></label>
                    <input type="text" id="alias" required maxlength="20"
                           class="input-terminal form-control p-3 rounded-0"
                           placeholder="Citizen001">
                </div>

                <!-- EMAIL BLOCK (The added requirement for Triple-Factor Access) -->
                <div class="col-12">
                    <label class="label-fancy mb-2"><?php echo __t('login', 'email'); ?></label>
                    <input type="email" id="raw_email" required 
                           class="input-terminal form-control p-3 rounded-0"
                           placeholder="noreply@mycitadel.lol">
                </div>

                <!-- PASSWORD BLOCK -->
                <div class="col-12">
                    <label class="label-fancy mb-2"><?php echo __t('login', 'password'); ?></label>
                    <input type="password" id="raw_password" required 
                           class="input-terminal form-control p-3 rounded-0"
                           placeholder="••••••••••••••••">
                </div>

                <!-- SUBMIT ACTION -->
                <div class="col-12 pt-3">
                    <button type="submit" id="loginBtn"
                            class="btn btn-sovereign w-100 py-4 font-black rounded-0 shadow-lg">
                        <?php echo __t('login', 'lg_btn'); ?>
                    </button>
                </div>
            </div>

        </form>

        <!-- FOOTER LINKS -->
        <div class="mt-5 text-center animate__animated animate__fadeIn">
            <div class="d-flex justify-content-center gap-4">
                <a href="register.php" class="label-fancy opacity-40 hover:opacity-100 transition-all text-decoration-none small">
                    // <?php echo __t('login', 'create_accout'); ?>
                </a>
                <a href="laws.php" class="label-fancy opacity-40 hover:opacity-100 transition-all text-decoration-none small">
                    // <?php echo __t('login', 'laws'); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- EXTERNAL SOVEREIGN AUTH LOGIC -->
<script src="/4ss37z/js/process_login.js"></script>

<?php 
$load_assets = ['particles'];
require_once __DIR__ . '/1nclud3z/f0073r.php'; 
?>