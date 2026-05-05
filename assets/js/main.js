/**
 * PROJECT: MY CITADEL
 * MODULE: SENTRY BEHAVIORAL TRACKER
 * DESCRIPTION: Detects tampering, F12, Right-clicks, and UI interactions.
 */

const CitadelSentry = {
    init() {
        this.trackRightClick();
        this.trackDevTools();
        this.trackInteraction();
        console.log("%c CITADEL SENTRY ACTIVE ", "background: #00f2ff; color: #000; font-weight: bold;");
    },

    // Detect Right Click
    trackRightClick() {
        document.addEventListener('contextmenu', (e) => {
            // Log this behavior to the server later
            console.warn("Security Alert: Context menu suppressed.");
            // e.preventDefault(); // Uncomment to disable right-click entirely
        });
    },

    // Detect F12 / DevTools
    trackDevTools() {
        let threshold = 160;
        setInterval(() => {
            if (window.outerWidth - window.innerWidth > threshold || 
                window.outerHeight - window.innerHeight > threshold) {
                // Potential tampering detected
                document.body.classList.add('tamper-detected');
            }
        }, 1000);

        document.addEventListener('keydown', (e) => {
            if (e.keyCode == 123) { // F12
                this.logEvent('f12_pressed');
            }
        });
    },

    // Track interactions for session profiling
    trackInteraction() {
        let lastActivity = Date.now();

        document.addEventListener('scroll', () => {
            lastActivity = Date.now();
        });

        document.addEventListener('keypress', (e) => {
            this.logEvent('input_activity', { target: e.target.name });
        });
    },

    logEvent(type, data = {}) {
        // Here we would use fetch() to send data to a log_action.php
        console.log(`[CITADEL LOG]: ${type}`, data);
    }
};

CitadelSentry.init();

/**
 * MY CITADEL - CLIENT SIDE CRYPTOGRAPHY
 * Scrambles data before transmission to ensure Near Zero-Knowledge.
 */

document.addEventListener('DOMContentLoaded', () => {
    const regForm = document.getElementById('regForm');
    const aliasInput = document.getElementById('alias');
    const aliasFeedback = document.getElementById('aliasFeedback');

    /**
     * ASYNC ALIAS AVAILABILITY CHECK
     */
    if (aliasInput) {
        aliasInput.addEventListener('blur', async () => {
            const alias = aliasInput.value.trim();
            if (alias.length < 3) return;

            try {
                const response = await fetch(`includes/auth/check_alias.php?alias=${encodeURIComponent(alias)}`);
                const result = await response.json();

                if (result.taken) {
                    aliasFeedback.innerText = "!! ALIAS_RESERVED";
                    aliasFeedback.className = "x-small mt-1 invalid-alias";
                    aliasInput.classList.add('border-danger');
                } else {
                    aliasFeedback.innerText = ">> ALIAS_AVAILABLE";
                    aliasFeedback.className = "x-small mt-1 valid-alias";
                    aliasInput.classList.remove('border-danger');
                }
            } catch (e) {
                console.error("TELEMETRY_FAILURE: Alias check unreachable");
            }
        });
    }

    /**
     * MATHEMATICAL SCRAMBLING (SHA-256)
     */
    async function scramble(text) {
        const msgUint8 = new TextEncoder().encode(text + "CITADEL_SALT_2056"); // Static client-side salt
        const hashBuffer = await crypto.subtle.digest('SHA-256', msgUint8);
        const hashArray = Array.from(new Uint8Array(hashBuffer));
        return hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
    }

    /**
     * VALIDATION LOGIC
     */
    function validatePassword(pass) {
        const regex = /^(?=(.*[a-z]){2,})(?=(.*[A-Z]){2,})(?=(.*[0-9]){2,})(?=(.*[!@#$%^&*()\-__+.]){2,}).{8,}$/;
        return regex.test(pass);
    }

    if (regForm) {
        regForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const pass = document.getElementById('password').value;
            const confirm = document.getElementById('password_confirm').value;
            const email = document.getElementById('email').value;

            // 1. Basic Validation
            if (pass !== confirm) {
                alert("CRITICAL_ERROR: Access Keys do not match.");
                return;
            }

            if (!validatePassword(pass)) {
                alert("CRITICAL_ERROR: Password entropy too low.");
                return;
            }

            // 2. Scramble before sending
            document.getElementById('scrambled_email').value = await scramble(email.toLowerCase());
            document.getElementById('scrambled_pass').value = await scramble(pass);

            // 3. Purge plaintext from DOM before send
            document.getElementById('password').value = "********";
            document.getElementById('password_confirm').value = "********";
            document.getElementById('email').value = "scrambled@citadel.void";

            regForm.submit();
        });
    }
});