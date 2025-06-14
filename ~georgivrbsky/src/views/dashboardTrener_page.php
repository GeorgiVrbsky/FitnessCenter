<?php
include __DIR__ . '/../../src/database/db_conn.php';
session_start();

//kontrola prihlaseni
if (!isset($_SESSION["user_id"])) {
    header("Location: /~georgivrbsky/src/views/login_page.php");
    exit();
}

//kontrola, jestli je uzivatel prihlaseny za trenera
if ($_SESSION["role"] !== "Trener") {
    echo "Nemáte oprávnění k této stránce.";
    exit();
}

//ziskani udaju klientu, kteri maji prihlaseneho trenera
$klienti = $db->query("SELECT id, jmeno, prijmeni FROM USER WHERE user_idUser = ?", [$_SESSION["user_id"]]);
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Trenérský Dashboard | Fitness Center</title>
    <meta name="description" content="Dashboard trenéra, kde jsou všichni uživatelé společně se všemi potřebnými údaji.">
    <meta name="keywords" content="Dashboard, Správa, Trenér, FitnessCenter"> 
    <link rel="stylesheet" href="/~georgivrbsky/public/stylesheet.css">
    <link rel="icon" href="/~georgivrbsky/public/components/balloon-heart-fill.svg" type="image/svg">
</head>
<body>

        <?php include __DIR__ . '/../../public/components/navbar.php'; ?>


        <div class="kontejner">
            <h1>Vaši cvičenci</h1>

            <?php
            if ($klienti->num_rows === 0) {
                echo "<p>Nemáte žádné cvičence přiřazené.</p>";
            } else {
                while ($klient = $klienti->fetch_assoc()) {
                    $klient_id = $klient["id"];

                    echo "<a href='/~georgivrbsky/src/views/progressTrener_page.php?user_id=$klient_id' style='text-decoration:none; color:inherit;'>";
                    echo "<div class='klient'>";
                    echo "<h2>" . htmlspecialchars($klient['jmeno']) . " " . htmlspecialchars($klient['prijmeni']) . "</h2>";

                    $parametry = $db->query(
                        "SELECT * FROM PARAMETRY WHERE user_idUSER = ? ORDER BY cislo_tydne DESC LIMIT 1",
                        [$klient_id]
                    );

                    if ($parametry && $parametry->num_rows > 0) {
                        $p = $parametry->fetch_assoc();
                        echo "<p><strong>Týden {$p['cislo_tydne']}:</strong></p>";
                        echo "<ul>";
                        echo "<li>Váha: {$p['hmotnost']} kg</li>";
                        echo "<li>Výška: {$p['vyska']} cm</li>";
                        echo "<li>Obvod pasu: {$p['obvod_pasu']} cm</li>";
                        echo "<li>Obvod hrudníku: {$p['obvod_hrudniku']} cm</li>";
                        echo "</ul>";
                    } else {
                        echo "<p>Nemá zadané žádné parametry.</p>";
                    }

                    echo "</div>";
                    echo "</a>";
                }
            }
            ?>
        </div>
    
    <?php include __DIR__ . '/../../public/components/footer.html'; ?>
</body>
</html>