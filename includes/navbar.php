<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$ingelogd = isset($_SESSION['gebruiker_id']);
$is_admin = !empty($_SESSION['is_admin']);
$huidige_pagina = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar" id="navbar">
    <div class="nav-container">
        <a href="index.php" class="nav-logo">
            <img src="images/logo_zwart.png" alt="Zonne Vallei">
        </a>
        <ul class="nav-links" id="navLinks">
            <!-- De klasse 'active' zet de huidige pagina in het goud. 'active' wordt alleen ingevoegd als $huidige_pagina overeenkomt. -->
            <li><a href="index.php" class="<?php echo $huidige_pagina == 'index.php' ? 'active' : ''; ?>">Home</a></li>
            <li><a href="kamers.php" class="<?php echo $huidige_pagina == 'kamers.php' ? 'active' : ''; ?>">Kamers</a></li>
            <li><a href="restaurant.php" class="<?php echo $huidige_pagina == 'restaurant.php' ? 'active' : ''; ?>">Restaurant</a></li>
            <li><a href="ons.php" class="<?php echo $huidige_pagina == 'ons.php' ? 'active' : ''; ?>">Over Ons</a></li>
            <li><a href="contact.php" class="<?php echo $huidige_pagina == 'contact.php' ? 'active' : ''; ?>">Contact</a></li>
            <?php if ($is_admin): ?>
                <li><a href="admin_kamers.php" class="<?php echo $huidige_pagina == 'admin_kamers.php' ? 'active' : ''; ?>">Kamers beheren</a></li>
            <?php endif; ?>
            <li>
                <?php if ($ingelogd): ?>
                    <a href="uitloggen.php" class="btn-reserveer">Uitloggen</a>
                <?php else: ?>
                    <a href="login.php" class="btn-reserveer">Inloggen</a>
                <?php endif; ?>
            </li>
        </ul>
        <div class="hamburger" id="hamburger" onclick="document.getElementById('navLinks').classList.toggle('active')">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</nav>

<script>
window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});
</script>
