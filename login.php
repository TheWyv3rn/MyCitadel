<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: LOGIN GATE
 */

declare(strict_types=1);
require_once __DIR__ . '/includes/config.php';
set_security_headers();
require_once __DIR__ . '/includes/header.php';
?>

<div class="container py-5 d-flex justify-content-center">
    <div class="citadel-card mt-5 animate__animated animate__fadeInDown" style="max-width: 450px; width: 100%;">
        <div class="text-center mb-4">
            <h1 class="stencil-text text-neon-blue h2"><?php echo __t('auth', 'login_title'); ?></h1>
            <p class="text-secondary x-small font-mono"><?php echo __t('auth', 'login_sub'); ?></p>
        </div>

        <?php if (isset($_GET['registration']) && $_GET['registration'] === 'success'): ?>
            <div class="alert bg-black border-alien-green text-alien-green x-small font-mono mb-4 text-center">
                <i class="fas fa-check-circle"></i> IDENTITY_ESTABLISHED_SUCCESSFULLY
            </div>
        <?php endif; ?>

        <form id="loginForm" action="includes/auth/process_login.php" method="POST" novalidate>
            <div class="mb-4">
                <label class="form-label text-white small font-mono"><?php echo __t('auth', 'alias'); ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-black border-neon-blue text-neon-blue"><i class="fas fa-id-badge"></i></span>
                    <input type="text" name="alias" class="form-control bg-black text-white border-neon-blue" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label text-white small font-mono"><?php echo __t('auth', 'email'); ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-black border-neon-blue text-neon-blue"><i class="fas fa-envelope"></i></span>
                    <input type="email" id="email" class="form-control bg-black text-white border-neon-blue" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label text-white small font-mono"><?php echo __t('auth', 'pass'); ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-black border-neon-blue text-neon-blue"><i class="fas fa-key"></i></span>
                    <input type="password" id="password" class="form-control bg-black text-white border-neon-blue" required>
                </div>
            </div>

            <input type="hidden" id="scrambled_email" name="scrambled_email">
            <input type="hidden" id="scrambled_pass" name="scrambled_pass">

            <button type="submit" class="btn-cyber w-100 py-3 stencil-text mt-2">
                <i class="fas fa-sign-in-alt"></i> <?php echo __t('auth', 'login_btn'); ?>
            </button>
            
            <div class="mt-4 d-flex justify-content-between">
                <a href="register.php" class="text-secondary x-small text-decoration-none font-mono"><?php echo __t('auth', 'no_account'); ?></a>
            </div>
        </form>
    </div>
</div>

<script>
/**
 * Using the same logic as Register to ensure hashes match.
 */
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const email = document.getElementById('email').value;
    const pass = document.getElementById('password').value;

    async function scramble(text) {
        const msgUint8 = new TextEncoder().encode(text + "CITADEL_SALT_2056");
        const hashBuffer = await crypto.subtle.digest('SHA-256', msgUint8);
        const hashArray = Array.from(new Uint8Array(hashBuffer));
        return hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
    }

    document.getElementById('scrambled_email').value = await scramble(email.toLowerCase());
    document.getElementById('scrambled_pass').value = await scramble(pass);

    // Purge plaintext from form
    document.getElementById('email').value = "hidden@citadel.void";
    document.getElementById('password').value = "********";

    this.submit();
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>