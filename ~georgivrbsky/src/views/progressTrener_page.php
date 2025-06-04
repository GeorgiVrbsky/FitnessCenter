<?php
include __DIR__ . '/../../src/database/db_conn.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: /~georgivrbsky/src/views/login_page.php");
    exit();
}

if ($_SESSION["role"] !== "Trener") {
    echo "Nemáte oprávnění k této stránce.";
    exit();
}

if (!isset($_GET['user_id'])) {
    echo "Nezvolen žádný klient.";
    exit();
}

$klient_id = intval($_GET['user_id']);

$klient = $db->query("SELECT jmeno, prijmeni FROM USER WHERE id = ? AND user_idUser = ?", [$klient_id, $_SESSION["user_id"]])->fetch_assoc();
if (!$klient) {
    echo "Klient nenalezen nebo nemáte oprávnění.";
    exit();
}

$parametry = $db->query("SELECT * FROM PARAMETRY WHERE user_idUSER = ? ORDER BY cislo_tydne ASC", [$klient_id]);
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Progress klienta <?= htmlspecialchars($klient['jmeno'] . ' ' . $klient['prijmeni']) ?></title>
    <link rel="stylesheet" href="/~georgivrbsky/public/stylesheet.css" />
</head>
<body class="dashboard-body">
    <header>
        <?php include __DIR__ . '/../../public/components/navbar.php'; ?>
    </header>
    <main class="centered-content">
        <div class="kontejner">
            <h1>Progress klienta <?= htmlspecialchars($klient['jmeno'] . ' ' . $klient['prijmeni']) ?></h1>
            <a href="/~georgivrbsky/src/views/dashboardTrener_page.php">← Zpět na seznam cvičenců</a>

            <?php
            if ($parametry->num_rows === 0) {
                echo "<p>Klient nemá zadané žádné parametry.</p>";
            } else {
                while ($p = $parametry->fetch_assoc()) {
                    echo "<div class='klient'>";
                    echo "<h2>Týden {$p['cislo_tydne']}</h2>";
                    echo "<ul>";
                    echo "<li>Váha: {$p['hmotnost']} kg</li>";
                    echo "<li>Výška: {$p['vyska']} cm</li>";
                    echo "<li>Obvod pasu: {$p['obvod_pasu']} cm</li>";
                    echo "<li>Obvod hrudníku: {$p['obvod_hrudniku']} cm</li>";
                    echo "</ul>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </main>
</body>
</html>