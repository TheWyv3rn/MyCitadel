<?php
/**
 * MYCITADEL // SESSION TERMINATION PROTOCOL v5.7
 * Sector: Security Perimeter
 * Action: Total Session Liquidation & Handshake Severance
 */

require_once __DIR__ . '/../private/citadel_config.php';

// 1. INITIALIZE TERMINATION
//session_start();

// 2. CAPTURE ALIAS FOR TERMINAL LOG (Optional)
$alias = $_SESSION['citizen_alias'] ?? 'UNKNOWN_NODE';

// 3. WIPE SESSION ARRAYS
$_SESSION = array();

// 4. INCINERATE SESSION COOKIE
// This ensures the browser physically deletes the link to the kernel.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 5. DESTROY KERNEL SESSION
session_destroy();

// 6. UI TERMINATION HUD
$page_title = "TERMINATING_CONNECTION";
require_once __DIR__ . '/1nclud3z/h34d3r.php'; 
?>

<style>
    @font-face { font-family: 'Orbitron'; src: url('/4ss37z/f0n7z/Orbitron/Orbitron-Bold.ttf') format('truetype'); font-weight: bold; }
    @font-face { font-family: 'SourceCodePro'; src: url('/4ss37z/f0n7z/SourceCodePro/SourceCodePro-Regular.ttf') format('truetype'); }

    body { 
        background-color: #000; 
        color: #39ff14; 
        font-family: 'SourceCodePro', monospace; 
        height: 100vh; 
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .termination-hub {
        width: 100%;
        max-width: 500px;
        text-align: center;
        border: 2px solid #bc13fe;
        background: rgba(0, 0, 0, 0.95);
        padding: 40px;
        box-shadow: 0 0 50px rgba(188, 19, 254, 0.25);
    }

    .terminal-line {
        margin-bottom: 8px;
        opacity: 0;
        font-size: 0.75rem;
        text-transform: uppercase;
    }

    .text-purple { color: #bc13fe; }
    .text-danger { color: #ff3131; }

    .glitch-text {
        font-family: 'Orbitron', sans-serif;
        font-size: 1.4rem;
        letter-spacing: 4px;
        color: #fff;
        text-shadow: 2px 0 #bc13fe, -2px 0 #39ff14;
    }

    .progress-bar-container {
        width: 100%;
        height: 1px;
        background: #111;
        margin-top: 30px;
        position: relative;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: #39ff14;
        width: 0%;
        transition: width 2s ease-in;
    }

    #particles-js { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; pointer-events: none; filter: grayscale(1) brightness(0.3); }
</style>

<div id="particles-js"></div>

<div class="termination-hub animate__animated animate__zoomIn">
    <div class="glitch-text mb-4">CONNECTION_SEVERED</div>
    
    <div class="terminal-output text-start">
        <div id="line-1" class="terminal-line">> INITIATING_EXIT_SEQUENCE... [OK]</div>
        <div id="line-2" class="terminal-line">> FLUSHING_LOCAL_SESSION_STORE... [CLEAN]</div>
        <div id="line-3" class="terminal-line">> INCINERATING_HANDSHAKE_COOKIES... [DONE]</div>
        <div id="line-4" class="terminal-line text-purple">> SEVERING_CITIZEN_LINK: <?php echo htmlspecialchars($alias); ?></div>
        <div id="line-5" class="terminal-line text-danger">> STATUS: OFFLINE</div>
    </div>

    <div class="progress-bar-container">
        <div class="progress-fill" id="exit-bar"></div>
    </div>
    
    <div class="mt-4 small opacity-40 uppercase tracking-widest">
        Redirecting to Login Gate...
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. HARD WIPE LOCAL RAM ASSETS
    localStorage.clear();
    sessionStorage.clear();

    // 2. RUN TERMINATION TELEMETRY
    const lines = document.querySelectorAll('.terminal-line');
    const bar = document.getElementById('exit-bar');

    lines.forEach((line, index) => {
        setTimeout(() => {
            line.style.opacity = '1';
            line.classList.add('animate__animated', 'animate__fadeInLeft');
        }, index * 300);
    });

    setTimeout(() => {
        bar.style.width = '100%';
    }, 400);

    // 3. FINAL HANDOVER TO LOGIN GATE
    setTimeout(() => {
        window.location.href = "login.php?status=HANDSHAKE_TERMINATED";
    }, 2800);
});
</script>

<?php 
$load_assets = ['particles'];
require_once __DIR__ . '/1nclud3z/f0073r.php'; 
?>