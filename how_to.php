<?php 
// 1. DYNAMIC SEO CONFIGURATION
$pageTitle = "The Operator's Manual";
$pageDescription = "A complete guide to navigating MyCitadel, understanding our NZK protocols, and mastering your digital sovereignty.";
$pageKeywords = "MyCitadel guide, how to use MyCitadel, zero-knowledge help, reputation system, encryption guide";

// 2. INJECT HEADER
include 'includes/header.php'; 
?>

<!-- HERO SECTION -->
<section class="row mb-5 mt-4">
    <div class="col-12 text-center">
        <h1 class="display-4"><span class="glowing-rune"><i class="fas fa-bolt"></i></span> THE OPERATOR'S MANUAL <span class="glowing-rune"><i class="fas fa-bolt"></i></span></h1>
        <p class="text-terminal">> LOADING PROTOCOLS... SYNCING USER HANDBOOK... [OK]</p>
    </div>
</section>

<!-- SECTION 1: ACCESSING THE NODE -->
<section class="row mb-5">
    <div class="col-12">
        <div class="cyber-panel">
            <h2><i class="fas fa-key"></i> 01. Accessing the Node</h2>
            <div class="row mt-4">
                <div class="col-md-6">
                    <h4 class="text-warning">Registration</h4>
                    <p class="small">To join the Citadel, you must provide an <strong>Alias</strong> (your public identifier), a valid <strong>Email</strong>, and a <strong>Password</strong>. Your password is hashed locally via Argon2id. You must also agree to the High Laws (Policies).</p>
                </div>
                <div class="col-md-6">
                    <h4 class="text-warning">Authentication</h4>
                    <p class="small">Login requires your Alias and Email and Password. Upon successful entry, a secure session is established via a unique <strong>SID</strong>. This session is your tether to the network.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 2: THE COMMAND CENTER (DASHBOARD) -->
<section class="row mb-5">
    <div class="col-12">
        <div class="ancient-scroll">
            <h2><i class="fas fa-th-large"></i> 02. The Command Center (Dashboard)</h2>
            <p>Your Dashboard is a live readout of your standing within the Citadel. It is divided into two primary metrics:</p>
            <ul>
                <li><strong>Reputation (The Badge System):</strong> These are permanent honors earned through objective contributions. Submitting valid security bugs, filling out your profile, or creating helpful content earns you badges that verify your technical and ethical standing.</li>
                <li><strong>Influence (The Fluid Metric):</strong> This is your social weight. It fluctuates based on how other Citizens interact with your posts. Positive engagement raises your influence; silence or negative reactions lower it.</li>
            </ul>
            <p>You can also track your <strong>Presence Stats</strong>—a breakdown of every like, dislike, comment, and post you have ever made, compared directly against the Citadel global average.</p>
        </div>
    </div>
</section>

<!-- SECTION 3: THE FEED & CITIZENS -->
<section class="row mb-5">
    <div class="col-md-6 mb-4">
        <div class="cyber-panel h-100">
            <h4><i class="fas fa-rss"></i> The Citadel Feed</h4>
            <p class="small">The Feed is where you see the thoughts of your connections. You can create posts, comment, and react. <strong>Premium Users</strong> gain access to full <strong>Markdown Support</strong> for advanced formatting.</p>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="cyber-panel h-100">
            <h4><i class="fas fa-users"></i> Discovering Citizens</h4>
            <p class="small">The 'Citizens' directory lists every registered user. You can see their Alias and Avatar, but you cannot enter their profile until you send a <strong>Connection Request</strong> and they accept. We value the "Handshake" over the "Follow."</p>
        </div>
    </div>
</section>

<!-- SECTION 4: COMMUNICATIONS & VISIBILITY -->
<section class="row mb-5">
    <div class="col-12">
        <div class="ancient-scroll">
            <h2><i class="fas fa-eye-slash"></i> 03. Privacy & Visibility Protocol</h2>
            <p><strong>Who can see me?</strong> Only those you have shook hands with. If a user is not a "Connection," your profile is a blank wall to them. They cannot message you, and they cannot see your activity.</p>
            <p><strong>The Connection Exception:</strong> On the public Feed, you may see comments on your friend's posts from people you aren't connected with. You can see their name and comment, but their profile remains locked. This allows for open conversation while maintaining individual sovereignty.</p>
            <p><strong>Comms:</strong> Private messaging is end-to-end encrypted. Group messaging is an advanced protocol reserved for <strong>Premium Citizens</strong>.</p>
        </div>
    </div>
</section>

<!-- SECTION 5: THE SENTINEL (AI & TRACKING) -->
<section class="row mb-5">
    <div class="col-12">
        <div class="cyber-panel" style="border-left-color: var(--blood-red);">
            <h2 class="text-warning"><i class="fas fa-brain"></i> 04. The Sentinel AI & Operational Tracking</h2>
            <p>To keep the Citadel safe while maintaining <strong>Near Zero-Knowledge</strong>, we utilize two guardian systems:</p>
            <div class="row">
                <div class="col-md-6">
                    <h5>Pre-Encryption AI Analysis</h5>
                    <p class="small">Before your text is encrypted and sent to the database, a local AI scanner checks for violations: hate speech, threats of violence, or illicit content. If the AI detects a violation, you receive an <strong>Infraction</strong>. <strong>3 Infractions = Permanent Account Sharding (Deletion).</strong></p>
                </div>
                <div class="col-md-6">
                    <h5>Operational Metadata (SID)</h5>
                    <p class="small">We track the "how" and "where," not the "who." We log session duration, button clicks, and page transitions. This data is used exclusively to assist our VDP hunters in identifying attack vectors and system bugs.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 6: SOVEREIGNTY TOOLS -->
<section class="row mb-5">
    <div class="col-12">
        <div class="ancient-scroll">
            <h2><i class="fas fa-user-shield"></i> 05. Sovereignty & Exit Strategy</h2>
            <p>You own your data. We provide the tools to manage or destroy it at will:</p>
            <div class="row">
                <div class="col-md-4">
                    <strong>Request Data</strong>
                    <p class="small">Generate a professional PDF of every data point we have on your account. (Requires Active Login).</p>
                </div>
                <div class="col-md-4">
                    <strong>Logout</strong>
                    <p class="small">Sever your connection instantly. Your SID is invalidated, and you are removed from the active node.</p>
                </div>
                <div class="col-md-4">
                    <strong>Destroy Account</strong>
                    <p class="small text-danger">The Nuclear Option. This wipes your posts, likes, comments, and identity from the MariaDB server permanently. There is no recovery.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 7: VDP & CODING -->
<section class="row mb-5">
    <div class="col-12 text-center">
        <div class="cyber-panel p-5">
            <h2><i class="fas fa-code-branch"></i> Join the Architecture</h2>
            <p class="w-75 mx-auto mb-4">
                The Citadel is a community effort. Whether you are a master of PHP or an ethical hacker looking for your next challenge, the gates are open for collaboration.
            </p>
            <div class="row">
                <div class="col-md-6">
                    <h4>The Coders Block</h4>
                    <p class="small">Help us optimize the stack or suggest a new feature. We build in the open.</p>
                </div>
                <div class="col-md-6">
                    <h4>VDP Operations</h4>
                    <p class="small">Find a bug, earn a badge. Secure the Citadel on your favorite bug bounty platform.</p>
                </div>
            </div>
            <a href="https://github.com/TheWyv3rn/MyCitadel" target="_blank" class="btn-viking-tech mt-3">Access GitHub Repo</a>
        </div>
    </div>
</section>

<?php 
// 3. INJECT FOOTER
include 'includes/footer.php'; 
?>