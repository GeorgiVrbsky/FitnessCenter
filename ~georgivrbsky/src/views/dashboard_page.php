<?php
session_start();
include __DIR__ . '/../../src/database/db_conn.php';

// Zkontroluj přihlášení
$user_id = $_SESSION["user_id"] ?? null;
if (!$user_id) {
    header("Location: /~georgivrbsky/src/views/login_page.php");
    exit();
}

// Získání uživatele
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
//at to jde od konce
$parametry = $db->query("SELECT * FROM PARAMETRY WHERE user_idUser = ? ORDER BY cislo_tydne ASC LIMIT 4", [$user_id]);
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
                $week = 1;
                while ($p = $parametry->fetch_assoc()) {
                    $hmotnost = $p['hmotnost'] ?? 'N/A';
                    $pas = $p['obvod_pasu'] ?? 'N/A';
                    $hrudnik = $p['obvod_hrudniku'] ?? 'N/A';

                    echo "<div class='card'>
                            <h3>Týden $week</h3>
                            <p><strong>Váha:</strong> {$hmotnost} kg</p>
                            <p><strong>Pas:</strong> {$pas} cm</p>
                            <p><strong>Hrudník:</strong> {$hrudnik} cm</p>
                        </div>";
                    $week++;
                }
                ?>
            </div>
            <p><a href="/~georgivrbsky/src/views/prehled_page.php">→ Detailnější informace o postupu</a></p>
        </section>

        <section>
            <h2>Trenér</h2>
            <div class="card">
                <?php
                if ($trener) {
                    echo "<p><strong>{$trener['jmeno']} {$trener['prijmeni']}</strong></p>";
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
                <p><a href="/~georgivrbsky/src/views/cviky_page.php">→ Přejít na detailnější vaše cviky</a></p>
            </div>
        </section>

        <section>
            <p>odstranit number sipecky</p>
            <h2>Kalkulačka kalorií</h2>
            <form id="kalkulacka">
                <label for="hmotnost">Hmotnost (kg):</label>
                <input type="number" id="hmotnost" required>

                <label for="vyska">Výška (cm):</label>
                <input type="number" id="vyska" required>

                <label for="vek">Věk (roky):</label>
                <input type="number" id="vek" required>

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
