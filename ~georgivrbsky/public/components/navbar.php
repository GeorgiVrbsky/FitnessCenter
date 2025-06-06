<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$JMENO = $_SESSION['jmeno'] ?? 'Host'; // Když není přihlášený, zobrazí "Host"
$ROLE = $_SESSION['role'] ?? null;

?>

<nav class="navbar">
    <div class="navbar-nazev">
        <span style="font-size: 1.7rem;">Fitness Center</span>
    </div>
    <ul class="navbar-linky">
        <?php if ($ROLE !== "Trener"): ?>
        <li ><a href="/~georgivrbsky/src/views/dashboard_page.php" class="navbar-link">Dashboard</a></li>
        <li ><a href="/~georgivrbsky/src/views/prehled_page.php" class="navbar-link">Týdenní postup</a></li>
        <li ><a href="/~georgivrbsky/src/views/cviky_page.php" class="navbar-link">Cviky</a></li>
        <li ><a href="/~georgivrbsky/src/views/kalkulacky_page.php" class="navbar-link">Kalkulacky</a></li>
        <?php endif; ?>

        <li >
            <span style="font-size: 1.7rem;color: white;"><?php echo htmlspecialchars("Vítejte " . $JMENO); ?></span>
        </li>

        <li >
            <a href="/~georgivrbsky/public/logout.php" class="navbar-link navbar-logout">Odhlásit se</a>
        </li>
    </ul>
</nav>
