<?php
session_start();
include __DIR__ . '/../../src/database/db_conn.php';

$user_id = $_SESSION["user_id"] ?? null;
if (!$user_id) {
    header("Location: /~georgivrbsky/src/views/login_page.php");
    exit();
}
echo $user_id;


$user_stmt = $db->query("SELECT * FROM USER WHERE id = ?", [$user_id]);
$user = $user_stmt->fetch_assoc();

// Získání trenéra
$trener = null;
if (!empty($user["user_idUser"])) {
    $trener_stmt = $db->query("SELECT jmeno, prijmeni FROM USER WHERE id = ?", [$user["user_idUser"]]);
    $trener = $trener_stmt->fetch_assoc();
}

// Získání cviků podle Role
$cviky = $db->query("SELECT nazev FROM CVIKY WHERE role_idRole = ?", [$user["role_idRole"]]);

// Získání týdenních parametrů
$parametry = $db->query("SELECT * FROM PARAMETRY WHERE user_idUser = ? ORDER BY cislo_tydne DESC LIMIT 4", [$user_id]);
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/~georgivrbsky/public/stylesheet.css">
</head>
<body class="dashboard-body">

<div class="wrapper">

    <header>
        <?php include __DIR__ . '/../../public/components/navbar.php'; ?>
    </header>

    <main class="content">

        <section>
            <h2>Týdenní postup</h2>
            <div class="dashboard-grid">
                <?php
                while ($p = $parametry->fetch_assoc()) {
                    $week = $p['cislo_tydne'] ?? 'N/A';
                    $hmotnost = $p['hmotnost'] ?? 'N/A';
                    $pas = $p['obvod_pasu'] ?? 'N/A';
                    $hrudnik = $p['obvod_hrudniku'] ?? 'N/A';

                    echo "<div class='card'>
                            <h3>Týden $week</h3>
                            <p><strong>Váha:</strong> {$hmotnost} kg</p>
                            <p><strong>Pas:</strong> {$pas} cm</p>
                            <p><strong>Hrudník:</strong> {$hrudnik} cm</p>
                        </div>";
                }
                ?>
            </div>
            <p><a href="/~georgivrbsky/src/views/prehled_page.php">→ Detailnější informace o postupu</a></p>
        </section>

        <section>
            <h2>Trenér</h2>
            <div class="card" style="text-align: center">
                <?php
                if ($trener) {
                    $PATH = transliterator_transliterate('Any-Latin; Latin-ASCII', "/~georgivrbsky/src/photos/" . strtolower($trener['jmeno']) . "_" . strtolower($trener['prijmeni']) . ".jpg");
                    echo "<p><strong>{$trener['jmeno']} {$trener['prijmeni']}</strong></p>";
                    //echo "<img src=\"" . htmlspecialchars($src_obrazku) . "\" alt=\"Profilová fotografie " . htmlspecialchars($trener['jmeno'] . ' ' . $trener['prijmeni']) . "\">";
                    //echo "<img src=\"" . htmlspecialchars($PATH) . "\" alt=\"Trener fotka" . "\">";
                    echo "<img src=\"" . htmlspecialchars($PATH) . "\" alt=\"Trener fotka\" style=\"max-width: 40%; height: auto; border-radius: 8px;\">";
                } else {
                    echo "<p>Nemáte přiděleného trenéra.</p>";
                }
                ?>
            </div>
        </section>

        <section>
            <h2>Týdenní cviky</h2>
            <div class="card">
                <ul>
                    <?php
                    while ($cvik = $cviky->fetch_assoc()) {
                        echo "<li>" . htmlspecialchars($cvik["nazev"]) . "</li>";
                    }
                    ?>
                </ul>
            </div>
            <p><a href="/~georgivrbsky/src/views/cviky_page.php">→ Přejít na detailnější vaše cviky</a></p>
        </section>

        <section>
            <h2>Kalkulačka kalorií</h2>
            <form id="kalkulacka">
                <label for="hmotnost">Hmotnost (kg):</label>
                <input type="number" id="hmotnost" name="hmotnost" required min="30" max="250" step="0.1" placeholder="např. 75.5">

                <label for="vyska">Výška (cm):</label>
                <input type="number" id="vyska" name="vyska" required min="100" max="250" step="1" placeholder="např. 180">

                <label for="vek">Věk (roky):</label>
                <input type="number" id="vek" name="vek" required min="10" max="100" step="1" placeholder="např. 25">

                <button type="button" onclick="vypocitejKalorie()">Vypočítej</button>
                <div id="vysledek"></div>
            </form>
            <p><a href="/~georgivrbsky/src/views/kalkulacky_page.php">→ Přejít na více kalkulaček</a></p>
        </section>

    </main>

    <footer class="site-footer">
        <?php include __DIR__ . '/../../public/components/footer.html'; ?>
    </footer>

</div> <!-- konec wrapper -->

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
