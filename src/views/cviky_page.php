<?php
session_start();
include __DIR__ . '/../../src/database/db_conn.php';

include __DIR__ . '/../../src/controllers/CvikyController.php';


$POCET_DNI = 1;
$ZAMERENI = "";
$MISTO = "";

// Ověření přihlášení
$user_id = $_SESSION["user_id"] ?? null;
if (!$user_id) {
    header("Location: /~georgivrbsky/src/views/login_page.php");
    exit();
}
$stmt = "
    SELECT r.zamereni, r.misto
    FROM USER u
    JOIN ROLE r ON u.role_idRole = r.id
    WHERE u.id = ?";

$ROLEZAMERENI = $db->query($stmt, [$user_id]);

if ($roleRow = $ROLEZAMERENI->fetch_assoc()) {
    $ZAMERENI = $roleRow["zamereni"];
    $MISTO = $roleRow["misto"];
} else {
    echo "Nelze načíst zaměření nebo místo.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset( $_POST["pocetDni"])) {
    $POCET_DNI = $_POST["pocetDni"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cviky</title>
    <link rel="stylesheet" href="/~georgivrbsky/public/stylesheet.css">
</head>
<body>
<p>Naplnit databazi vice cviky, dojdou pri vice dnech !!!</p>
<form method="post">
    <label>Kolikrat tydne chcete cvicit?</label><br>
    <select name="pocetDni" required>
        <option value="2">2x tydne</option>
        <option value="3">3x tydne</option>
        <option value="4">4x tydne</option>
        <option value="5">5x tydne</option>
        <option value="6">6x tydne</option>
        <option value="7">7x tydne</option>
    </select><br>

    <button type="submit">Dej mi plan</button>

</form>

<?php

if(isset($_POST["pocetDni"])){ 
CvicebniPlan($db,$POCET_DNI, $ZAMERENI, $MISTO);
}
?>

<a href="/~georgivrbsky/src/views/dashboard_page.php"><button>ZPET</button></a>
    
</body>
</html>