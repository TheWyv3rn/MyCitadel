<?php 
// 1. DYNAMIC SEO CONFIGURATION
$pageTitle = "The Gates Are Open";
$pageDescription = "Welcome to MyCitadel. A privacy-first, near zero-knowledge social network secured by advanced client-side cryptography.";
$pageKeywords = "MyCitadel, zero-knowledge, XChaCha20, Poly1305, privacy, cypherpunk, encrypted social media";

// 2. INJECT HEADER (This automatically loads CSS, Bootstrap, and Navigation)
include 'includes/header.php'; 
?>

<!-- 3. OPTIONAL PARTICLES.JS BACKGROUND WRAPPER -->
<!-- Keeps the animated nodes floating behind the content -->
<div id="particles-js" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; pointer-events: none;"></div>

<!-- ==========================================
     SECTION 1: SYSTEM INITIALIZATION (HERO)
=========================================== -->
<section class="row mb-5 mt-4" data-aos="fade-in">
    <div class="col-12 text-center">
        <div class="cyber-panel" style="padding: 4rem 2rem;">
            <p class="text-terminal mb-3">
                > INITIALIZING SECURE HANDSHAKE... [OK]<br>
                > VERIFYING PEER-TO-PEER ENCRYPTION... [OK]<br>
                > NULLIFYING TRACKERS... [OK]
            </p>
            <h1 class="display-3 mb-4">
                <span class="glowing-rune"><i class="fas fa-bolt"></i></span> Welcome to the Citadel 
                <span class="glowing-rune"><i class="fas fa-bolt"></i></span>
            </h1>
            <p class="lead w-75 mx-auto" style="color: #a0b0c0;">
                You have successfully routed your connection to a secure node. This environment is protected by near zero-knowledge cryptography. Your identity, your communications, and your data are encrypted before they ever leave your device.
            </p>
            <div class="mt-5">
                <a href="login.php" class="btn-viking-tech me-3"><i class="fas fa-shield-alt me-2"></i> Init Node (Login)</a>
                <a href="#manifesto" class="btn-viking-tech" style="border-color: var(--hud-cyan); color: var(--hud-cyan);"><i class="fas fa-scroll me-2"></i> Read the Lore</a>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================
     SECTION 2: WHAT IS MYCITADEL?
=========================================== -->
<section id="manifesto" class="row mb-5 align-items-center">
    <div class="col-lg-6 mb-4 mb-lg-0">
        <div class="ancient-scroll">
            <h2><i class="fas fa-landmark" style="color: var(--blood-red);"></i> What is MyCitadel?</h2>
            <p>
                MyCitadel is not just a social media platform; it is a digital fortress built in response to the aggressive surveillance capitalism that dominates the modern internet. For decades, users have been treated as products—their data mined, sold to advertisers, and surrendered to unauthorized third parties without consent. 
            </p>
            <p>
                We have engineered a sanctuary to reverse this paradigm. MyCitadel is a completely ad-free, anti-tracking communication environment. By moving the burden of encryption entirely to the user's browser, we mathematically guarantee that we cannot read, sell, or leak your private messages. 
            </p>
            <p>
                Whether you are sharing sensitive intelligence, discussing philosophy, or simply talking with friends, the Citadel ensures that your voice remains yours alone.
            </p>
        </div>
    </div>
    <div class="col-lg-6 text-center">
        <!-- Abstract visual representation using FontAwesome -->
        <i class="fas fa-lock fa-10x" style="color: var(--rune-orange); text-shadow: 0 0 40px var(--rune-orange-glow); opacity: 0.8;"></i>
    </div>
</section>

<!-- ==========================================
     SECTION 3: WHO ARE THE CITIZENS?
=========================================== -->
<section class="row mb-5">
    <div class="col-12">
        <div class="cyber-panel">
            <h2 class="text-center mb-5"><i class="fas fa-users-cog"></i> Who Are The Citizens?</h2>
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <i class="fas fa-user-secret fa-3x mb-3" style="color: var(--hud-cyan);"></i>
                    <h4 class="text-warning">The Cypherpunks</h4>
                    <p style="font-size: 0.95rem;">Cryptographers, hackers, and security researchers who understand that true privacy relies on open mathematical algorithms, not corporate promises.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class="fas fa-newspaper fa-3x mb-3" style="color: var(--hud-cyan);"></i>
                    <h4 class="text-warning">The Journalists</h4>
                    <p style="font-size: 0.95rem;">Reporters and whistleblowers who require uncompromising operational security to protect their sources from state and corporate adversaries.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class="fas fa-user-shield fa-3x mb-3" style="color: var(--hud-cyan);"></i>
                    <h4 class="text-warning">The Sovereigns</h4>
                    <p style="font-size: 0.95rem;">Everyday individuals who have simply had enough. People who believe that digital privacy is a fundamental human right, not a luxury.</p>
                </div>
            </div>
            <p class="text-center mt-4 mb-0 text-terminal">
                > STATUS: THE GATES ARE OPEN TO ALL WHO RESPECT THE CODE.
            </p>
        </div>
    </div>
</section>

<!-- ==========================================
     SECTION 4: HOW DOES THIS WORK?
=========================================== -->
<section class="row mb-5">
    <div class="col-12">
        <div class="ancient-scroll">
            <h2><i class="fas fa-cogs" style="color: var(--blood-red);"></i> The Mechanics of the Fortress</h2>
            <p>
                Traditional social media platforms rely on server-side encryption. They hold the keys to the vault, which means if their servers are breached, or if they decide to analyze your data for advertising, your privacy is compromised.
            </p>
            <p>
                MyCitadel flips this architecture. When you type a message or create a post, the JavaScript running locally in your browser encrypts the data *before* it is transmitted over the network. 
            </p>
            <p>
                What reaches our PHP and MySQL servers is nothing but a scrambled, mathematically unsolvable string of ciphertext. We store the ciphertext, and we deliver it to your intended recipients. Their browsers use their private keys to decrypt it locally. We are merely the messengers; we cannot read the message.
            </p>
        </div>
    </div>
</section>

<!-- ==========================================
     SECTION 5: THE CRYPTOGRAPHIC ARSENAL
=========================================== -->
<section class="row mb-5">
    <div class="col-12">
        <div class="cyber-panel">
            <h2><i class="fas fa-microchip"></i> The Cryptographic Arsenal</h2>
            <p class="mb-4">We do not rely on outdated standards. The Citadel is fortified by modern, high-speed cryptographic primitives designed specifically to resist both traditional brute-force attacks and future threats.</p>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="p-3 border" style="border-color: var(--steel-gray) !important; background: rgba(0,0,0,0.3);">
                        <h5 style="color: var(--rune-orange);">1. Argon2id & Cryptographic Salt</h5>
                        <p class="small mb-0">Your master password never leaves your device. It is hashed locally using Argon2id—the winner of the Password Hashing Competition. We combine this with randomly generated, unique "Salts" to ensure that even if two users have the same password, their cryptographic keys remain completely distinct, defeating rainbow table attacks entirely.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border" style="border-color: var(--steel-gray) !important; background: rgba(0,0,0,0.3);">
                        <h5 style="color: var(--rune-orange);">2. XChaCha20</h5>
                        <p class="small mb-0">For symmetric encryption (encrypting your actual messages), we utilize XChaCha20. Unlike AES, which can be vulnerable to cache-timing attacks in software implementations, XChaCha20 is designed to be immune to these side-channel attacks. It is faster on mobile devices and utilizes an extended 192-bit nonce to prevent collision vulnerabilities.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border" style="border-color: var(--steel-gray) !important; background: rgba(0,0,0,0.3);">
                        <h5 style="color: var(--rune-orange);">3. Poly1305 MAC</h5>
                        <p class="small mb-0">Encryption alone only provides confidentiality; it does not prevent tampering. We pair XChaCha20 with Poly1305, a highly secure Message Authentication Code (MAC). This guarantees cryptographic integrity. If a single bit of your encrypted message is altered in transit or at rest, the decryption process will fail, instantly alerting the system to tampering.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================
     SECTION 6: NEAR ZERO-KNOWLEDGE ARCHITECTURE
=========================================== -->
<section class="row mb-5">
    <div class="col-12">
        <div class="ancient-scroll">
            <h2><i class="fas fa-eye-slash" style="color: var(--blood-red);"></i> Operating on "Near" Zero-Knowledge</h2>
            <p>
                Absolute zero-knowledge on a web platform is a myth; basic routing requires some metadata. MyCitadel operates on a strict **Near Zero-Knowledge (NZK)** protocol.
            </p>
            <p>
                What does this mean in practice? We hold absolutely zero knowledge regarding the content of your communications, the plaintext of your passwords, or your true identity. However, to maintain the structural integrity of the Citadel, we must implement active defense mechanisms.
            </p>
            <p>
                **The Security Exception:** We actively monitor your Session ID (`sid`), IP routing, and request frequencies. This is not for marketing; it is our radar system. By tracking these operational metrics, our back-end algorithms can identify brute-force attempts, mitigate Distributed Denial of Service (DDoS) attacks, and ban hostile actors trying to compromise the gates. We track the threat so we don't have to track the user.
            </p>
        </div>
    </div>
</section>

<!-- ==========================================
     SECTION 7: OUR GOALS & THE ROAD AHEAD
=========================================== -->
<section class="row mb-5">
    <div class="col-12 text-center">
        <div class="cyber-panel p-5">
            <h2 class="mb-4"><i class="fas fa-route"></i> The Road Ahead</h2>
            <p class="w-75 mx-auto mb-4">
                We are currently operating in Phase 1: Alpha Testing on secured, high-performance shared infrastructure. But the Citadel must grow. Our primary goal is to migrate all operations to dedicated bare-metal Xeon servers, ensuring complete sovereign control over the hardware stack.
            </p>
            <p class="w-75 mx-auto mb-5">
                Furthermore, we are preparing to integrate with major Bug Bounty platforms (HackerOne, Bugcrowd). We believe that the only way to forge an unbreakable shield is to invite the world's best hackers to strike it. 
            </p>
            
            <a href="about.php" class="btn-viking-tech me-3"><i class="fas fa-book-open"></i> Read the Full History</a>
            <a href="vdp.php" class="btn-viking-tech" style="border-color: var(--blood-red); color: var(--blood-red);"><i class="fas fa-bug"></i> Hack The Citadel</a>
        </div>
    </div>
</section>

<?php 
// 4. INJECT FOOTER (This automatically closes the container and loads JS libraries)
include 'includes/footer.php'; 
?>