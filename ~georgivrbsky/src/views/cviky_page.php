<?php
session_start();
include __DIR__ . '/../../src/database/db_conn.php';
include __DIR__ . '/../../src/controllers/CvikyController.php';

$POCET_DNI = 1;
$ZAMERENI = "";
$MISTO = "";


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
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cviky</title>
    <link rel="stylesheet" href="/~georgivrbsky/public/stylesheet.css">
</head>
<body class="dashboard-body">
<header>
    <?php include __DIR__ . '/../../public/components/navbar.php'; ?>
</header>

<main class="centered-content">
    <div class="container">
            <!-- Levá část: Výpis cviků -->
                <h1 style="text-align: center;">Cviky pro plánování tréninku</h1>
                <p>Naplnit databázi více cviky, dojdou při více dnech!!!</p>

                <?php
                if (isset($_POST["pocetDni"])) { 
                    CvicebniPlan($db, $POCET_DNI, $ZAMERENI, $MISTO);
                }
                ?>

            <!-- Pravá část: Formulář pro výběr počtu dnů -->
                <form method="post" class="plan-form">
                    <label for="pocetDni" style="text-align: center;">Kolikrát týdně chcete cvičit?</label>
                    <select name="pocetDni" id="pocetDni" required>
                        <option value="2">2x týdně</option>
                        <option value="3">3x týdně</option>
                        <option value="4">4x týdně</option>
                        <option value="5">5x týdně</option>
                        <option value="6">6x týdně</option>
                        <option value="7">7x týdně</option>
                    </select>
                    <button type="submit" class="submit-button">Dej mi plán</button>
                </form>

                
            <a href="/~georgivrbsky/src/views/dashboard_page.php" class="back-link">
                    <button class="back-button">Zpět</button>
                </a>
    </div>
</main>

<footer>
    <?php include __DIR__ . '/../../public/components/footer.html'; ?>
</footer>
</body>
</html>