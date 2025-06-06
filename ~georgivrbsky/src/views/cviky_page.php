<?php
session_start();
include __DIR__ . '/../../src/database/db_conn.php';
include __DIR__ . '/../../src/controllers/CvikyController.php';

$POCET_DNI = 1;
$ZAMERENI = "";
$MISTO = "";


//kontrola session
$user_id = $_SESSION["user_id"] ?? null;
if (!$user_id) {
    header("Location: /~georgivrbsky/src/views/login_page.php");
    exit();
}

//query, kde ziskame misto a zamereni podle role uzivatele
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

//Pokud dame submit pomoci metody post a je zaroven setnuto pocetDni, tak se nam nastavi php promenna
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset( $_POST["pocetDni"])) {
    $POCET_DNI = $_POST["pocetDni"];
}

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cviky | Fitness Centrala</title>
    <meta name="description" content="Na této stránce si můžete udělat personalizovaný cvičební plán podle vašich dříve zvolených preferencí.">
    <meta name="keywords" content="Cviky, plán, svaly, FitnessCenter"> 
    <link rel="stylesheet" href="/~georgivrbsky/public/stylesheet.css">
    <link rel="icon" href="/~georgivrbsky/public/components/balloon-heart-fill.svg" type="image/svg">
</head>
<body>

    <?php include __DIR__ . '/../../public/components/navbar.php'; ?>

    <div class="kontejner">
            <!-- Levá část: Výpis cviků -->
                <h1 style="text-align: center;">Cviky pro plánování tréninku</h1>

                <?php
                if (isset($_POST["pocetDni"])) { 
                    CvicebniPlan($db, $POCET_DNI, $ZAMERENI, $MISTO);
                }
                ?>

            <!-- Pravá část: Formulář pro výběr počtu dnů -->
                <form method="post" class="cviky-formular">
                    <label for="pocetDni" style="text-align: center;">Kolikrát týdně chcete cvičit?</label>
                    <select name="pocetDni" id="pocetDni" required>
                        <option value="2">2x týdně</option>
                        <option value="3">3x týdně</option>
                        <option value="4">4x týdně</option>
                        <option value="5">5x týdně</option>
                        <option value="6">6x týdně</option>
                        <option value="7">7x týdně</option>
                    </select>
                    <button type="submit" class="submit-tlacitko">Dej mi plán</button>
                </form>

                
            <a href="/~georgivrbsky/src/views/dashboard_page.php" class="back-link">
                    <button class="back-button">Zpět</button>
                </a>
    </div>

    <?php include __DIR__ . '/../../public/components/footer.html'; ?>

</body>
</html>