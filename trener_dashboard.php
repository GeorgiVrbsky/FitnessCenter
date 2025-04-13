<?php
include "db_conn.php";
session_start();

// Zkontroluj přihlášení a roli
if (!isset($_SESSION["user_id"])) {
    header("Location: login_page.php");
    exit();
}

$trener_id = $_SESSION["user_id"];

// Zjisti, zda je uživatel trenér
$checkRole = $db->query("SELECT r.nazev FROM USER u JOIN ROLE r ON u.role_idRole = r.id WHERE u.id = ?", params: [$trener_id]);
$roleRow = $checkRole->fetch_assoc();

if (!$roleRow || $roleRow["nazev"] !== "Trener") {
    echo "Nemáte oprávnění pro přístup k této stránce.";
    exit();
}

// Získej všechny klienty přiřazené tomuto trenérovi
$klienti = $db->query("SELECT id, jmeno, prijmeni FROM USER WHERE user_idUser = ?", [$trener_id]);
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Trenérský Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #2c3e50; }
        .klient { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-radius: 8px; }
    </style>
</head>
<body>

<p style="text-align: right;">
    <a href="logout.php" style="color: red; font-weight: bold;">Odhlásit se</a>
</p>

<h1>Vaši cvičenci</h1>

<?php
if ($klienti->num_rows === 0) {
    echo "<p>Nemáte žádné cvičence přiřazené.</p>";
} else {
    while ($klient = $klienti->fetch_assoc()) {
        $klient_id = $klient["id"];
        echo "<div class='klient'>";
        echo "<h2>{$klient['jmeno']} {$klient['prijmeni']}</h2>";

        // Získej poslední týdenní záznam pro tohoto klienta
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
    }
}
?>

</body>
</html>
