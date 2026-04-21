/**
 * MYCITADEL // SOVEREIGN REGISTRATION ENGINE v5.8
 * Path: /4ss37z/js/register_logic.js
 */

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('citadelRegForm');
    const initBtn = document.getElementById('initBtn');
    const aliasIn = document.getElementById('alias');
    const passIn = document.getElementById('raw_password');
    const emailIn = document.getElementById('raw_email');
    const confirmIn = document.getElementById('confirm_password');
    const agreeIn = document.getElementById('agree_laws');

    let validation = { alias: false, upper: false, lower: false, num: false, sym: false, match: false, agree: false };

    aliasIn.addEventListener('input', async (e) => {
        let val = e.target.value.trim().replace(/[^a-zA-Z0-9_]/g, "");
        e.target.value = val;
        const status = document.getElementById('aliasCheck');
        if(val.length < 3) { validation.alias = false; return; }
        const fd = new FormData();
        fd.append('action', 'check_alias');
        fd.append('alias', val);
        const resp = await fetch('register.php', { method: 'POST', body: fd });
        const res = await resp.text();
        status.innerHTML = (res === 'available') ? '<span class="text-success">NODE_FREE</span>' : '<span class="text-danger">ID_TAKEN</span>';
        validation.alias = (res === 'available');
        checkCompliance();
    });

    form.addEventListener('input', () => {
        const p = passIn.value;
        const cp = confirmIn.value;
        validation.upper = (p.match(/[A-Z]/g) || []).length >= 2;
        validation.lower = (p.match(/[a-z]/g) || []).length >= 2;
        validation.num   = (p.match(/[0-9]/g) || []).length >= 2;
        validation.sym   = (p.match(/[^A-Za-z0-9]/g) || []).length >= 2;
        validation.match = (p === cp && p.length > 0);
        validation.agree = agreeIn.checked;
        ['upper', 'lower', 'number', 'symbol'].forEach(k => {
            const el = document.getElementById('m-' + (k === 'number' ? 'number' : k));
            if(el) el.className = `col-6 sentinel-node d-flex align-items-center ${validation[k === 'number' ? 'num' : k] ? 'sentinel-valid' : 'sentinel-invalid'}`;
        });
        checkCompliance();
    });

    function checkCompliance() {
        const passed = Object.values(validation).every(v => v === true);
        initBtn.disabled = !passed;
        initBtn.innerText = passed ? "INITIALIZE SOVEREIGNTY" : "AWAITING COMPLIANCE";
    }

    form.onsubmit = async (e) => {
        e.preventDefault();
        initBtn.disabled = true;
        initBtn.innerText = "EXECUTING_HANDSHAKE...";

        const alias = aliasIn.value.trim();
        const email = emailIn.value.trim().toLowerCase();
        const password = passIn.value;
        const encoder = new TextEncoder();

        try {
            const passBuffer = encoder.encode(password);
            const baseKey = await crypto.subtle.importKey("raw", passBuffer, { name: "PBKDF2" }, false, ["deriveBits", "deriveKey"]);

            // THE UNIFIED SALT (Crucial for Sync)
            const globalSalt = encoder.encode("CITADEL_SOVEREIGN_v5.8_" + email);

            const authBits = await crypto.subtle.deriveBits(
                { name: "PBKDF2", salt: globalSalt, iterations: 400000, hash: "SHA-256" },
                baseKey, 256
            );
            const pass_auth = btoa(String.fromCharCode(...new Uint8Array(authBits)));

            const vaultSalt = crypto.getRandomValues(new Uint8Array(16));
            const vaultKey = await crypto.subtle.deriveKey(
                { name: "PBKDF2", salt: vaultSalt, iterations: 400000, hash: "SHA-256" },
                baseKey, { name: "AES-GCM", length: 256 }, false, ["encrypt"]
            );
            const iv = crypto.getRandomValues(new Uint8Array(12));
            const encEmail = await crypto.subtle.encrypt({ name: "AES-GCM", iv: iv }, vaultKey, encoder.encode(email));

            const email_blob = JSON.stringify({
                iv: btoa(String.fromCharCode(...iv)),
                salt: btoa(String.fromCharCode(...vaultSalt)),
                data: btoa(String.fromCharCode(...new Uint8Array(encEmail)))
            });

            const response = await fetch('/4p1/us3rz/register_uplink.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ alias, email_blob, pass_auth, agree: 1 })
            });

            const result = await response.json();
            if (result.status === 'SUCCESS') {
                window.location.href = "us3rz/dashboard.php?citizen=" + encodeURIComponent(alias);
            } else {
                alert(result.message);
                initBtn.disabled = false;
            }
        } catch (err) { alert("CRYPTO_ERROR"); initBtn.disabled = false; }
    };
});