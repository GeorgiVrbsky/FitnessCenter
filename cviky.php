<?php
session_start();
include "db_conn.php";
include "cviky_algo.php";


$CVIKY_PLAN = [];

// Ověření přihlášení
$user_id = $_SESSION["user_id"] ?? null;
if (!$user_id) {
    header("Location: login.php");
    exit();
}
$stmt = "
    SELECT r.zamereni, r.misto
    FROM USER u
    JOIN ROLE r ON u.role_idRole = r.id
    WHERE u.id = ?";

$ROLEZAMERENI = $db->query($stmt, [$user_id]);

if ($roleRow = $ROLEZAMERENI->fetch_assoc()) {
    $zamereni = $roleRow["zamereni"];
    $misto = $roleRow["misto"];
} else {
    echo "Nelze načíst zaměření nebo místo.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset( $_POST["pocetDni"]) && isset( $_POST["cvicebniPlan"])) {
    $POCET_DNI = $_POST["pocetDni"];
    $CVICEBNI_PLAN = $_POST["cvicebniPlan"];

    
    switch ($CVICEBNI_PLAN) {
        case "PPL":
            {
                $CVIKY_PLAN = PPL();
                break;
            }
        case "fullBody":
            {
                $CVIKY_PLAN = FullBody();
                break;
            }
        case "broSplit":
            {
                $CVIKY_PLAN = BroSplit();
                break;
            }
        default:
            {
                echo "Neco se pokazilo";
            }              
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cviky</title>
</head>
<body>

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

    <label>Jaky cvicebni plan chces nasledovat?</label><br>
    <select name="cvicebniPlan" required>
        <option value="fullBody">Full Body</option>
        <option value="PPL">Push Pull Legs</option>
        <option value="broSplit">Bro Split</option>
    </select><br><br>

    <button type="submit">Dej mi plan</button>

</form>

<?php

ShowPlan($CVIKY_PLAN);
?>
    
</body>
</html>