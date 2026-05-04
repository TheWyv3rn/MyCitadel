<?php 
// 1. DYNAMIC SEO CONFIGURATION
$pageTitle = "VDP & Hall of Fame";
$pageDescription = "Official Vulnerability Disclosure Policy for MyCitadel. Report bugs, earn reputation, and join the Hall of Fame.";
$pageKeywords = "Bug Bounty, VDP, HackerOne, MyCitadel Security, IT Ninja, Cyber-Viking Security";

// 2. INJECT HEADER
include 'includes/header.php'; 
?>

<!-- HERO SECTION -->
<section class="row mb-5 mt-4">
    <div class="col-12 text-center">
        <h1 class="display-4"><span class="glowing-rune"><i class="fas fa-bug"></i></span> VDP OPERATIONS <span class="glowing-rune"><i class="fas fa-bug"></i></span></h1>
        <p class="text-terminal">> SCANNING FOR VULNERABILITIES... STANDBY FOR RULES OF ENGAGEMENT...</p>
    </div>
</section>

<!-- SECTION 1: SHARED SERVER WARNING (CRITICAL) -->
<section class="row mb-5">
    <div class="col-12">
        <div class="cyber-panel" style="border-left-color: var(--blood-red); background: rgba(138, 3, 3, 0.05);">
            <h3 class="text-danger"><i class="fas fa-exclamation-triangle"></i> OPERATIONAL NOTICE: SHARED ENVIRONMENT</h3>
            <p class="small">
                MyCitadel is currently in <b>Phase 1 (Staging)</b> and is hosted on a <b>Shared Namecheap Server</b>. 
                Researchers must exercise extreme caution. Aggressive automated scanning (Brute-forcing, Directory Busting, or heavy Fuzzing) will likely result in an IP ban from the hosting provider and potentially impact other users on this node.
            </p>
            <p class="small text-warning">
                <strong>Please limit your request rate to 1 request per second (1rps).</strong>
            </p>
        </div>
    </div>
</section>

<!-- SECTION 2: RULES OF ENGAGEMENT -->
<section class="row mb-5">
    <div class="col-md-6 mb-4">
        <div class="cyber-panel h-100">
            <h4><i class="fas fa-check-circle text-success"></i> Allowed (In-Scope)</h4>
            <p class="small">Scope: `*.mycitadel.lol` & `mycitadel.lol`</p>
            <ul class="small text-terminal" style="list-style: none; padding-left: 0;">
                <li>> Cross-Site Scripting (XSS)</li>
                <li>> SQL Injection (SQLi)</li>
                <li>> Insecure Direct Object References (IDOR)</li>
                <li>> Authentication Bypass / Broken Session Mgmt</li>
                <li>> Cryptographic Failures (XChaCha20/Argon2 Implementation)</li>
            </ul>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="cyber-panel h-100" style="border-left-color: var(--blood-red);">
            <h4><i class="fas fa-times-circle text-danger"></i> Prohibited (Out-of-Scope)</h4>
            <ul class="small" style="list-style: none; padding-left: 0; color: #a0b0c0;">
                <li><i class="fas fa-ban text-danger"></i> Distributed Denial of Service (DDoS)</li>
                <li><i class="fas fa-ban text-danger"></i> Social Engineering / Phishing of Citizens</li>
                <li><i class="fas fa-ban text-danger"></i> Physical Attacks against Server Hardware</li>
                <li><i class="fas fa-ban text-danger"></i> Spamming or Automated Mail Bombing</li>
                <li><i class="fas fa-ban text-danger"></i> Public disclosure without a verified patch</li>
            </ul>
        </div>
    </div>
</section>

<!-- SECTION 3: THE HALL OF FAME -->
<section class="row mb-5">
    <div class="col-12">
        <div class="ancient-scroll text-center">
            <h2 class="mb-4"><i class="fas fa-trophy"></i> The Hall of Fame</h2>
            <p>The following elite researchers have successfully breached the Citadel's defenses and acted with honor to help us secure the gates.</p>
            
            <div class="table-responsive mt-4">
                <table class="table" style="color: var(--ancient-ink); border-color: rgba(43, 24, 16, 0.2);">
                    <thead>
                        <tr style="font-family: var(--font-runic); border-bottom: 2px solid var(--ancient-ink);">
                            <th>Citizen Alias</th>
                            <th>Reputation Points</th>
                            <th>Class of Breach</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody style="font-family: var(--font-body); font-weight: bold;">
                        <tr>
                            <td><i class="fas fa-user-ninja me-2"></i> IT Ninja</td>
                            <td>350 PTS</td>
                            <td>SQLi, RSS, XSS, IDOR</td>
                            <td><span class="badge bg-dark">ELITE VETERAN</span></td>
                        </tr>
                        <!-- Future slots -->
                        <tr style="opacity: 0.5;">
                            <td>[EMPTY SLOT]</td>
                            <td>0 PTS</td>
                            <td>---</td>
                            <td>WAITING...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 4: PLATFORMS & CONTACT -->
<section class="row mb-5">
    <div class="col-12">
        <div class="cyber-panel text-center">
            <h3><i class="fas fa-project-diagram"></i> Reporting Platforms</h3>
            <p class="mb-4">We are currently integrating with the following networks. Choose your preferred uplink:</p>
            
            <div class="row justify-content-center">
                <div class="col-6 col-md-3 mb-3">
                    <a href="https://hackerone.com" target="_blank" class="btn-viking-tech w-100">HackerOne</a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <a href="https://bugcrowd.com" target="_blank" class="btn-viking-tech w-100">BugCrowd</a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <a href="https://intigriti.com" target="_blank" class="btn-viking-tech w-100">Intigriti</a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <a href="https://yeswehack.com" target="_blank" class="btn-viking-tech w-100">YesWeHack</a>
                </div>
            </div>

            <div class="mt-4">
                <p class="text-terminal">Private Direct Report:</p>
                <a href="mailto:security@mycitadel.lol" class="text-warning" style="font-size: 1.2rem; font-family: var(--font-hud);">
                    <i class="fas fa-envelope-open-text me-2"></i> security@mycitadel.lol
                </a>
            </div>
        </div>
    </div>
</section>

<?php 
// 3. INJECT FOOTER
include 'includes/footer.php'; 
?>