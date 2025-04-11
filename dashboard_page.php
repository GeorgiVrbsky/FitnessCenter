<?php
session_start();
include "db_conn.php";

// Zkontroluj přihlášení
$user_id = $_SESSION["user_id"] ?? null;
if (!$user_id) {
    header("Location: login.php");
    exit();
}

// Získání uživatele
$user_stmt = $db->query("SELECT * FROM user WHERE id = ?", [$user_id]);
$user = $user_stmt->fetch_assoc();

// Získání trenéra
$trener = null;
if (!empty($user["USER_idUSER"])) {
    $trener_stmt = $db->query("SELECT jmeno, prijmeni FROM user WHERE id = ?", [$user["USER_idUSER"]]);
    $trener = $trener_stmt->fetch_assoc();
}

// Získání cviků podle Role
$cviky = $db->query("SELECT Nazev FROM cviky WHERE Role_idRole = ?", [$user["Role_idRole"]]);

// Získání týdenních parametrů
$parametry = $db->query("SELECT * FROM parametry_uzivatele WHERE USER_idUSER = ? ORDER BY cislo_tydne ASC LIMIT 4", [$user_id]);
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Týdenní přehled</title>
</head>
<body>

<h1>Týdenní postup</h1>

<!-- Týdenní přehled -->
<div class="grid">
    <?php
    $week = 1;
    while ($p = $parametry->fetch_assoc()) {
        $hmotnost = $p['hmotnost'] ?? 'N/A';
        $pas = $p['obvod_pasu'] ?? 'N/A';
        $hrudnik = $p['obvod_hrudniku'] ?? 'N/A';

        echo "<div class='card'><h3>Týden $week</h3>";
        echo "Váha: {$hmotnost} kg<br>";
        echo "Pas: {$pas} cm<br>";
        echo "Hrudník: {$hrudnik} cm<br>";
        echo "</div>";
        $week++;
    }
    ?>
</div>

<p><a href="prehled_detail.php">Detailnější informace o postupu</a></p>

<!-- Trenér -->
<h2>Trenér</h2>
<?php
if ($trener) {
    echo "<p>{$trener['jmeno']} {$trener['prijmeni']}</p>";
} else {
    echo "<p>Nemáte přiděleného trenéra.</p>";
}
?>

<!-- Cviky -->
<h2>Týdenní cviky</h2>
<ul>
<?php
while ($cvik = $cviky->fetch_assoc()) {
    echo "<li>" . htmlspecialchars($cvik["Nazev"]) . "</li>";
}
?>
</ul>
<p><a href="cviky.php">Přejít na detailnější vaše cviky</a></p>

<!-- Kalkulačka kalorií -->
<h2>Kalkulačka kalorií</h2>
<form id="kalkulacka">
    <label>Hmotnost (kg):</label><br>
    <input type="number" id="hmotnost" required><br>
    <label>Výška (cm):</label><br>
    <input type="number" id="vyska" required><br>
    <label>Věk (roky):</label><br>
    <input type="number" id="vek" required><br>
    <button type="button" onclick="vypocitejKalorie()">Vypočítej</button>
</form>
<div id="vysledek"></div>

<p><a href="kalkulacky.php">Přejít na více kalkulaček</a></p>

<script>
function vypocitejKalorie() {
    const hmotnost = parseFloat(document.getElementById('hmotnost').value);
    const vyska = parseFloat(document.getElementById('vyska').value);
    const vek = parseFloat(document.getElementById('vek').value);

    if (!hmotnost || !vyska || !vek) {
        document.getElementById('vysledek').innerText = "Vyplňte všechna pole.";
        return;
    }

    const BMR = 10 * hmotnost + 6.25 * vyska - 5 * vek + 5;
    document.getElementById('vysledek').innerText = `Odhadovaný denní kalorický příjem: ${Math.round(BMR)} kcal`;
}
</script>

</body>
</html>
