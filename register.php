<?php 
/**
 * MYCITADEL: REGISTER GATEWAY
 * Built for Near Zero-Knowledge (NZK) operations.
 */
$pageTitle = "Initialize Citizen Node";
include 'includes/header.php'; 
?>

<!-- 
    RELIABILITY NOTICE: 
    The "modules" build fails in browsers because it lacks a global 'window' export.
    Use this VERIFIED command to get the Browser build (Sumo) for version 0.7.15:
    
    wget -O assets/vendor/libsodium-wrappers.min.js https://cdn.jsdelivr.net/npm/libsodium-wrappers@0.7.15/dist/browsers/libsodium-wrappers.js
-->
<script src="assets/vendor/libsodium-wrappers.min.js"></script>

<section class="row justify-content-center mt-5">
    <div class="col-lg-6 col-md-8">
        <div class="cyber-panel">
            <h2 class="text-center mb-4"><i class="fas fa-user-plus"></i> Citizen Registration</h2>
            <p class="text-terminal text-center small mb-4">> PROTOCOL: NEAR ZERO-KNOWLEDGE ACTIVE</p>

            <form id="registerForm" action="auth/register_action.php" method="POST">
                <div class="mb-3">
                    <label class="form-label text-hud">Alias (Public Name)</label>
                    <input type="text" name="alias_name" id="alias_name" class="form-control cyber-input" required placeholder="e.g. IT_Ninja">
                </div>

                <div class="mb-3">
                    <label class="form-label text-hud">Email (Uplink)</label>
                    <input type="email" name="email" id="email" class="form-control cyber-input" required placeholder="guardian@citadel.lol">
                </div>

                <div class="mb-3">
                    <label class="form-label text-hud">Password</label>
                    <input type="password" id="plain_password" class="form-control cyber-input" required placeholder="••••••••••••">
                    <div class="progress mt-2" style="height: 5px; background: #111;">
                        <div id="password-strength-bar" class="progress-bar" style="width: 0%"></div>
                    </div>
                </div>

                <!-- HIDDEN: The cryptographic hash sent to the server -->
                <input type="hidden" name="nzk_hash" id="nzk_hash">

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" required id="policyCheck">
                    <label class="form-check-label small" for="policyCheck">
                        I have read and swear an oath to the <a href="policies.php">High Laws</a>.
                    </label>
                </div>

                <button type="submit" id="submitBtn" class="btn-viking-tech w-100">
                    <i class="fas fa-shield-alt"></i> Initialize Node
                </button>
            </form>
            
            <p class="text-center mt-4 small">
                Already have a node? <a href="login.php">Authenticate Here</a>
            </p>
        </div>
    </div>
</section>

<script>

</script>

<style>
.cyber-input {
    background: rgba(0, 0, 0, 0.4) !important;
    border: 1px solid var(--steel-gray) !important;
    color: var(--hud-cyan) !important;
    border-radius: 0;
}
.cyber-input:focus {
    border-color: var(--hud-cyan) !important;
    box-shadow: 0 0 10px var(--hud-cyan-glow);
}
.progress-bar { transition: width 0.3s ease, background-color 0.3s ease; }
</style>

<?php include 'includes/footer.php'; ?>