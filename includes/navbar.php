<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$ingelogd = isset($_SESSION['gebruiker_id']);
?>

<nav class="navbar" id="navbar">
    <div class="nav-container">
        <a href="index.php" class="nav-logo">
            <span class="logo-naam">Zonne Vallei</span>
            <span class="logo-sub">Hotel & Restaurant</span>
        </a>
        <ul class="nav-links" id="navLinks">
            <li><a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Home</a></li>
            <li><a href="kamers.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'kamers.php' ? 'active' : ''; ?>">Kamers</a></li>
            <li><a href="restaurant.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'restaurant.php' ? 'active' : ''; ?>">Restaurant</a></li>
            <li><a href="ons.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'ons.php' ? 'active' : ''; ?>">Over Ons</a></li>
            <li><a href="contact.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">Contact</a></li>
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
