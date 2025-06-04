<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$JMENO = $_SESSION['jmeno'] ?? 'Host'; // Když není přihlášený, zobrazí "Host"
$ROLE = $_SESSION['role'] ?? null;

?>

<nav class="basic-navbar">
    <div class="basic-navbar-brand">
        <span style="font-size: 1.7rem;">Fitness Center</span>
    </div>
    <ul class="basic-nav-links" id="nav-links">
        <?php if ($ROLE !== "Trener"): ?>
        <li class="basic-nav-item"><a href="/~georgivrbsky/src/views/dashboard_page.php" class="basic-nav-link">Dashboard</a></li>
        <li class="basic-nav-item"><a href="/~georgivrbsky/src/views/cviky_page.php" class="basic-nav-link">Cviky</a></li>
        <li class="basic-nav-item"><a href="/~georgivrbsky/src/views/prehled_page.php" class="basic-nav-link">Týdenní postup</a></li>
        <li class="basic-nav-item"><a href="/~georgivrbsky/src/views/kalkulacky_page.php" class="basic-nav-link">Kalkulacky</a></li>
        <?php endif; ?>

        <li class="basic-nav-item">
            <span style="font-size: 1.7rem;color: white;"><?php echo htmlspecialchars("Vítejte " . $JMENO); ?></span>
        </li>

        <li class="basic-nav-item">
            <a href="/~georgivrbsky/public/logout.php" class="basic-nav-link basic-nav-logout">Odhlásit se</a>
        </li>
    </ul>
</nav>
