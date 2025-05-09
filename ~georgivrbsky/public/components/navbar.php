<?php
session_start(); 

$JMENO = $_SESSION['jmeno'] ?? 'Host'; // Když není přihlášený, zobrazí "Host"
?>

<nav class="basic-navbar">
    <div class="basic-navbar-brand">
        <span style="font-size: 1.7rem;">Fitness Center</span>
    </div>
    <ul class="basic-nav-links">
        <li class="basic-nav-item"><a href="/~georgivrbsky/src/views/dashboard_page.php" class="basic-nav-link">Dashboard</a></li>
        <li class="basic-nav-item"><a href="/~georgivrbsky/src/views/cviky_page.php" class="basic-nav-link">Cviky</a></li>
        <li class="basic-nav-item"><a href="/~georgivrbsky/src/views/prehled_page.php" class="basic-nav-link">Týdenní postup</a></li>
        <li class="basic-nav-item"><a href="#" class="basic-nav-link">O nás</a></li>
        
        <li class="basic-nav-item">
            <span style="font-size: 1.7rem;color: grey;"><?php echo htmlspecialchars($JMENO); ?></span>
        </li>

        <li class="basic-nav-item">
            <a href="/~georgivrbsky/public/logout.php" class="basic-nav-link basic-nav-logout">Odhlásit se</a>
        </li>
    </ul>
</nav>
