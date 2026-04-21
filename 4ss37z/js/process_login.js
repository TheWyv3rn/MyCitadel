/**
 * MYCITADEL // SOVEREIGN LOGIN ENGINE v5.8
 * Path: /4ss37z/js/process_login.js
 */

document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('citadelLoginForm');
    const loginBtn = document.getElementById('loginBtn');

    loginForm.onsubmit = async (e) => {
        e.preventDefault();
        loginBtn.disabled = true;

        const alias = document.getElementById('alias').value.trim();
        const email = document.getElementById('raw_email').value.trim().toLowerCase();
        const password = document.getElementById('raw_password').value;
        const encoder = new TextEncoder();

        try {
            const passBuffer = encoder.encode(password);
            const baseKey = await crypto.subtle.importKey("raw", passBuffer, { name: "PBKDF2" }, false, ["deriveBits"]);

            // UNIFIED SALT (Matches register_logic.js)
            const globalSalt = encoder.encode("CITADEL_SOVEREIGN_v5.8_" + email);

            const authBits = await crypto.subtle.deriveBits(
                { name: "PBKDF2", salt: globalSalt, iterations: 400000, hash: "SHA-256" },
                baseKey, 256
            );
            const pass_auth = btoa(String.fromCharCode(...new Uint8Array(authBits)));

            const response = await fetch('/4p1/us3rz/login_uplink.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ alias, pass_auth })
            });

            const result = await response.json();
            if (result.status === 'SUCCESS') {
                window.location.href = "/us3rz/dashboard.php?citizen=" + encodeURIComponent(result.alias);
            } else {
                alert("AUTHENTICATION_FAILED: CHECK_CREDENTIALS");
                loginBtn.disabled = false;
            }
        } catch (err) { alert("CRYPTO_ERROR"); loginBtn.disabled = false; }
    };
});