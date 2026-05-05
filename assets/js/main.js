/**
 * MYCITADEL: NZK CORE CRYPTOGRAPHY ENGINE
 * Handles client-side Argon2id hashing to ensure Near Zero-Knowledge.
 */
(function() {
    window.addEventListener('load', function() {
        
        const regForm = document.getElementById('registerForm');
        const passInput = document.getElementById('plain_password');
        const strengthBar = document.getElementById('password-strength-bar');
        const submitBtn = document.getElementById('submitBtn');

        // 1. Password Strength Visualizer
        if (passInput && strengthBar) {
            passInput.addEventListener('input', function() {
                let strength = 0;
                const val = this.value;
                if (val.length > 7) strength += 25;
                if (/[A-Z]/.test(val)) strength += 25;
                if (/[0-9]/.test(val)) strength += 25;
                if (/[^A-Za-z0-9]/.test(val)) strength += 25;

                strengthBar.style.width = strength + '%';
                strengthBar.style.backgroundColor = strength < 50 ? 'var(--blood-red)' : (strength < 100 ? 'var(--rune-orange)' : '#00ff00');
            });
        }

        // 2. Form Submission & Client-Side Hashing
        if (regForm) {
            regForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> GENERATING PROOF-OF-WORK...';
                submitBtn.disabled = true;

                try {
                    /**
                     * ENGINE DETECTION
                     * We search for the sodium object. If using the 'sumo' browser build,
                     * it will be attached to window.sodium.
                     */
                    const cryptoEngine = window.sodium || window._sodium;
                    
                    if (!cryptoEngine) {
                        throw new Error("Cryptography engine (Sodium) not detected. Ensure your local file is the 'browsers' build, not the 'modules' build.");
                    }

                    // Wait for WebAssembly/ASM.js initialization (The "Handshake")
                    await cryptoEngine.ready;
                    
                    const alias = document.getElementById('alias_name').value;
                    const password = passInput.value;

                    // Create a deterministic client-side salt to prevent pre-computation attacks
                    // We use a static string appended to the alias for consistent NZK behavior.
                    const salt = cryptoEngine.crypto_generichash(16, alias + "citadel_v1_salt");
                    
                    // Compute Argon2id hash in the browser
                    // This is the "Proof of Work" that keeps the plaintext password away from the server.
                    const hashBuffer = cryptoEngine.crypto_pwhash(
                        32,
                        password,
                        salt,
                        cryptoEngine.crypto_pwhash_OPSLIMIT_INTERACTIVE,
                        cryptoEngine.crypto_pwhash_MEMLIMIT_INTERACTIVE,
                        cryptoEngine.crypto_pwhash_ALG_ARGON2ID13
                    );

                    // Convert to hex for standard POST transmission
                    const finalHash = cryptoEngine.to_hex(hashBuffer);
                    document.getElementById('nzk_hash').value = finalHash;
                    
                    // Clear the plain password from memory immediately
                    passInput.value = "";
                    
                    // Final submission to the backend (auth/register_action.php)
                    regForm.submit();

                } catch (err) {
                    console.error("NZK_FATAL:", err);
                    submitBtn.innerHTML = '<i class="fas fa-exclamation-triangle"></i> HANDSHAKE FAILED';
                    submitBtn.disabled = false;
                    
                    if (typeof Toastify !== 'undefined') {
                        Toastify({
                            text: "> " + err.message,
                            style: { background: "var(--blood-red)" },
                            duration: 10000
                        }).showToast();
                    }
                }
            });
        }
    });
})();