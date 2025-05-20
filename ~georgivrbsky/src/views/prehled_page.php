<?php
session_start();
include __DIR__ . '/../../src/database/db_conn.php';

$user_id = $_SESSION["user_id"] ?? null;
if (!$user_id) {
    header("Location: /~georgivrbsky/src/views/login_page.php");
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hmotnost = $_POST["hmotnost"] ?? '';
    $vyska = $_POST["vyska"] ?? '';
    $obvod_pasu = $_POST["obvod_pasu"] ?? '';
    $obvod_hrudniku = $_POST["obvod_hrudniku"] ?? '';
    $nextWeek = $maxWeek + 1;

    try {
        $insert = "INSERT INTO PARAMETRY (cislo_tydne, vyska, hmotnost, obvod_pasu, obvod_hrudniku, user_idUser) VALUES (?,?,?,?,?,?)";
        $params = [$nextWeek, $vyska, $hmotnost, $obvod_pasu, $obvod_hrudniku, $user_id];
        $db->query($insert, $params);

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přehled parametrů</title>
    <link rel="stylesheet" href="/~georgivrbsky/public/stylesheet.css">
</head>

<body class="dashboard-body">

    <header>
        <?php include __DIR__ . '/../../public/components/navbar.php'; ?>
    </header>

    <main>

        <section>
            <h2>Týdenní přehled parametrů</h2>
            <div class="dashboard-grid">
                <?php
                $week = 1;
                foreach ($paramData as $p) {
                    $hmotnost = $p['hmotnost'] ?? 'N/A';
                    $pas = $p['obvod_pasu'] ?? 'N/A';
                    $hrudnik = $p['obvod_hrudniku'] ?? 'N/A';
                    $vyska = $p['vyska'] ?? 'N/A';

                    echo "<div class='card'>
                            <h3>Týden $week</h3>
                            <p><strong>Váha:</strong> {$hmotnost} kg</p>
                            <p><strong>Pas:</strong> {$pas} cm</p>
                            <p><strong>Hrudník:</strong> {$hrudnik} cm</p>
                            <p><strong>Výška:</strong> {$vyska} cm</p>
                          </div>";
                    $week++;
                }
                ?>
            </div>
        </section>

        <!-- Formulář pro nový týden -->
        <section>
            <h2>Formulář pro nový týden</h2>
            <form method="POST" action="">
                <div class="input-group">
                    <label for="hmotnost">Váha (kg):</label>
                    <input type="number" name="hmotnost" id="hmotnost" required min="30" max="250" step="0.1" placeholder="např. 75.5">
                </div>

                <div class="input-group">
                    <label for="obvod_pasu">Obvod pasu (cm):</label>
                    <input type="number" name="obvod_pasu" id="obvod_pasu" required min="30" max="200" step="0.1" placeholder="např. 85.0">
                </div>

                <div class="input-group">
                    <label for="obvod_hrudniku">Obvod hrudníku (cm):</label>
                    <input type="number" name="obvod_hrudniku" id="obvod_hrudniku" required min="50" max="200" step="0.1" placeholder="např. 100.0">
                </div>

                <div class="input-group">
                    <label for="vyska">Výška (cm):</label>
                    <input type="number" name="vyska" id="vyska" required min="100" max="250" step="1" placeholder="např. 180">
                </div>

                <button type="submit" class="login-button">Odeslat</button>
            </form>
        </section>


            <a href="/~georgivrbsky/src/views/dashboard_page.php">
                <button class="back-button">Zpět</button>
            </a>
    </main>
</body>
</html>