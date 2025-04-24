<?php
session_start();
include __DIR__ . '/../../src/database/db_conn.php';

$user_id = $_SESSION["user_id"] ?? null;
if (!$user_id) {
    header("Location: /../../src/views/login_page.php");
    exit();
}

$week = 1;
echo $_SESSION["jmeno"]; //DEV

$parametry = $db->query("SELECT * FROM PARAMETRY WHERE user_idUser = ? ORDER BY cislo_tydne ASC", [$user_id]);

$paramData = [];
$maxWeek = 0;

while ($row = $parametry->fetch_assoc()) {
    $paramData[] = $row;
    if ((int)$row['cislo_tydne'] > $maxWeek) {
        $maxWeek = (int)$row['cislo_tydne'];
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $hmotnost = $_POST["hmotnost"] ?? '';
    $vyska = $_POST["vyska"] ?? '';
    $obvod_pasu = $_POST["obvod_pasu"] ?? '';
    $obvod_hrudniku = $_POST["obvod_hrudniku"] ?? '';
    $nextWeek = $maxWeek + 1;

    try {
        $insert = "INSERT INTO PARAMETRY (cislo_tydne, vyska, hmotnost, obvod_pasu, obvod_hrudniku, user_idUser) VALUES (?,?,?,?,?,?)";
        $params = [$nextWeek, $vyska , $hmotnost, $obvod_pasu, $obvod_hrudniku, $user_id];
        $db->query($insert, $params);

        header("Location: ".$_SERVER['PHP_SELF']);
        exit();


    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přehled parametrů</title>
    <link rel="stylesheet" href="stylesheet.css">

</head>

<body>

<!-- Týdenní přehled -->
<div class="grid">
    <?php
    $week = 1;
    foreach ($paramData as $p) {
        $hmotnost = $p['hmotnost'] ?? 'N/A';
        $pas = $p['obvod_pasu'] ?? 'N/A';
        $hrudnik = $p['obvod_hrudniku'] ?? 'N/A';
        $vyska = $p['vyska'] ?? 'N/A';
    
        echo "<div class='card'><h3>Týden $week</h3>";
        echo "Váha: {$hmotnost} kg<br>";
        echo "Pas: {$pas} cm<br>";
        echo "Hrudník: {$hrudnik} cm<br>";
        echo "Výška: {$vyska} cm<br>";
        echo "</div>";
        $week++;
    }
    ?>
</div>

<form method="POST" action="">
    <p>Zadejte sve parametry pro dalsi tyden</p>

    <label>Vase hmotnost: </label>
    <input type="number" name="hmotnost" required><br>

    <label>Vas obvod pasu: </label>
    <input type="number" name="obvod_pasu" required><br>

    <label>Vas obvod hrudniku: </label>
    <input type="number" name="obvod_hrudniku" required><br>

    <label>Vase vyska: </label>
    <input type="number" name="vyska" required><br>

    <button type="submit">Submit</button>



</form>

<a href="/src/views/dashboard_page.php"><button>Back</button></a>

</body>

</html>


