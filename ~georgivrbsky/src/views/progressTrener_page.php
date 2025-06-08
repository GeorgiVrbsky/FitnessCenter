<?php
include __DIR__ . '/../../src/database/db_conn.php';
session_start();

//kontrola session
if (!isset($_SESSION["user_id"])) {
    header("Location: /~georgivrbsky/src/views/login_page.php");
    exit();
}

//kontrola role trenera
if ($_SESSION["role"] !== "Trener") {
    echo "Nemáte oprávnění k této stránce.";
    exit();
}

//pokud byla pouzita metoda get
if (!isset($_GET['user_id'])) {
    echo "Nezvolen žádný klient.";
    exit();
}

//ziskani id klienta z metody GET
$klient_id = intval($_GET['user_id']);

//ziskani jmena a prijmeni klienta
$klient = $db->query("SELECT jmeno, prijmeni, email, telefon FROM USER WHERE id = ? AND user_idUser = ?", [$klient_id, $_SESSION["user_id"]])->fetch_assoc();
if (!$klient) {
    echo "Klient nenalezen nebo nemáte oprávnění.";
    exit();
}

//ziskani vsech parametru zvoleneho klienta
$parametry = $db->query("SELECT * FROM PARAMETRY WHERE user_idUSER = ? ORDER BY cislo_tydne ASC", [$klient_id]);
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Progress klienta | Fitness Center</title>
    <meta name="description" content="Progress page, kde se trenér může podívat na specifické týdny klienta a na jejich progress.">
    <meta name="keywords" content="Dashboard, Správa, Trenér, FitnessCenter"> 
    <link rel="stylesheet" href="/~georgivrbsky/public/stylesheet.css">
    <link rel="icon" href="/~georgivrbsky/public/components/balloon-heart-fill.svg" type="image/svg">
</head>
<body>

        <?php include __DIR__ . '/../../public/components/navbar.php'; ?>


        <div class="kontejner">
            <h1>Progress klienta <?= htmlspecialchars($klient['jmeno'] . ' ' . $klient['prijmeni']) ?></h1>
            <h1 style="border-bottom: none;"><?= htmlspecialchars("email: " . $klient['email'])?></h1>
            <h1 style="border-bottom: none;"><?= htmlspecialchars("Telefon: " . $klient['telefon'])?></h1>
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

        <?php include __DIR__ . '/../../public/components/footer.html'; ?>

</body>
</html>