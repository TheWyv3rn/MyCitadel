<?php
// Retrieve the current filename (e.g., 'index.php', 'about.php')
$current_page = basename($_SERVER['PHP_SELF']);

// Helper function to inject the glowing CSS if the button matches the current page
function set_active_glow($page, $current_page) {
    if ($page === $current_page) {
        return 'background: var(--rune-orange); color: var(--void-black); box-shadow: 0 0 25px var(--rune-orange-glow);';
    }
    return '';
}
?>

<header class="container" style="margin-top: 1rem; margin-bottom: 2rem;">
    <!-- We merge Bootstrap's 'navbar' class with our custom 'cyber-panel' -->
    <nav class="navbar navbar-expand-lg cyber-panel" style="padding: 1rem 2rem;">
        <div class="container-fluid p-0">
             
            <!-- Brand / Logo -->
            <a class="navbar-brand d-flex align-items-center" href="index.php" style="color: var(--rune-orange); text-decoration: none;">
                <span class="glowing-rune me-2" style="font-size: 2rem;"><i class="fas fa-bolt"></i></span>
                <h2 style="margin: 0; font-size: 1.8rem; letter-spacing: 3px; font-family: var(--font-runic); padding-top: 5px;">CITADEL</h2>
            </a>

            <!-- Mobile Hamburger Toggle (Customized for the Cyber-Viking aesthetic) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#citadelNavbar" aria-controls="citadelNavbar" aria-expanded="false" aria-label="Toggle navigation" style="border: 1px solid var(--rune-orange); border-radius: 0; background: rgba(255, 102, 0, 0.1);">
                <i class="fas fa-bars" style="color: var(--rune-orange);"></i>
            </button>

            <!-- Collapsible Navigation Links -->
            <div class="collapse navbar-collapse" id="citadelNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 mt-3 mt-lg-0" style="gap: 1rem; align-items: center;">
                    
                    <li class="nav-item w-100 text-center">
                        <a href="index.php" class="btn-viking-tech w-100" style="<?php echo set_active_glow('index.php', $current_page); ?>">Home</a>
                    </li>
                    
                    <li class="nav-item w-100 text-center">
                        <a href="about.php" class="btn-viking-tech w-100" style="<?php echo set_active_glow('about.php', $current_page); ?>">About</a>
                    </li>
                    
                    <li class="nav-item w-100 text-center">
                        <a href="how_to.php" class="btn-viking-tech w-100" style="<?php echo set_active_glow('how_to.php', $current_page); ?>">How-To</a>
                    </li>
                    
                    <li class="nav-item w-100 text-center">
                        <a href="policies.php" class="btn-viking-tech w-100" style="<?php echo set_active_glow('policies.php', $current_page); ?>">Policies</a>
                    </li>
                    
                    <!-- Pre-staged Login/Node Initialization Button -->
                    <li class="nav-item w-100 text-center ms-lg-4 mt-3 mt-lg-0">
                        <a href="login.php" class="btn-viking-tech w-100" style="border-color: var(--hud-cyan); color: var(--hud-cyan); text-shadow: none;">
                            Init Node <i class="fas fa-network-wired ms-2"></i>
                        </a>
                    </li>
                </ul>
            </div>
            
        </div>
    </nav>
</header>