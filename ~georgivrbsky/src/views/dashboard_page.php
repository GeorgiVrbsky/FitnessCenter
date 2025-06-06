<?php
session_start();
include __DIR__ . '/../../src/database/db_conn.php';

//kontrola session
$user_id = $_SESSION["user_id"] ?? null;
if (!$user_id) {
    header("Location: /~georgivrbsky/src/views/login_page.php");
    exit();
}

//Ziskani vsech informaci o prihlasenem uzivateli
$user_stmt = $db->query("SELECT * FROM USER WHERE id = ?", [$user_id]);
$user = $user_stmt->fetch_assoc();

// Získání trenéra
$trener = null;
if (!empty($user["user_idUser"])) {
    $trener_stmt = $db->query("SELECT jmeno, prijmeni FROM USER WHERE id = ?", [$user["user_idUser"]]);
    $trener = $trener_stmt->fetch_assoc();
}

// Získání cviků podle Role
$cviky = $db->query("SELECT nazev FROM CVIKY WHERE role_idRole = ? ORDER BY RAND() LIMIT 7", [$user["role_idRole"]]);

// Získání týdenních parametrů
$parametry = $db->query("SELECT * FROM PARAMETRY WHERE user_idUser = ? ORDER BY cislo_tydne DESC LIMIT 4", [$user_id]);

//funkce na odstranovani diakritiky pro ziskani obrazku treneru
function odstranitDiakritiku($text) {
    $znaky = [
        'á'=>'a', 'č'=>'c', 'ď'=>'d', 'é'=>'e', 'ě'=>'e', 'í'=>'i',
        'ň'=>'n', 'ó'=>'o', 'ř'=>'r', 'š'=>'s', 'ť'=>'t', 'ú'=>'u',
        'ů'=>'u', 'ý'=>'y', 'ž'=>'z',
        'Á'=>'A', 'Č'=>'C', 'Ď'=>'D', 'É'=>'E', 'Ě'=>'E', 'Í'=>'I',
        'Ň'=>'N', 'Ó'=>'O', 'Ř'=>'R', 'Š'=>'S', 'Ť'=>'T', 'Ú'=>'U',
        'Ů'=>'U', 'Ý'=>'Y', 'Ž'=>'Z',
    ];
    return strtr($text, $znaky);
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Fitness Center</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dashboard, kde máte všechny potřebné informace pro získání těch nejlepších výsledku pro vaše cíle.">
    <meta name="keywords" content="Dashboard, Správa, FitnessCenter"> 
    <link rel="stylesheet" href="/~georgivrbsky/public/stylesheet.css">
    <link rel="icon" href="/~georgivrbsky/public/components/balloon-heart-fill.svg" type="image/svg">
    
</head>
<body>

    <?php include __DIR__ . '/../../public/components/navbar.php'; ?>

    <div class="dashboard">

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
                    //$PATH = "/~georgivrbsky/src/photos/" . $trener['jmeno'] . "_" . $trener['prijmeni'] . ".jpg";
                    $PATH = strtolower(odstranitDiakritiku("/~georgivrbsky/src/photos/" . $trener['jmeno'] . "_" . $trener['prijmeni'] . ".jpg"));
                    //$PATH = odstranitDiakritiku($PATH);
                    echo "<p><strong>{$trener['jmeno']} {$trener['prijmeni']}</strong></p>";
                    echo "<img src=\"" . htmlspecialchars($PATH) . "\" alt=\"Trener fotka\" style=\"max-width: 50%; height: auto; border-radius: 8px;\">";
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
            <form>
                <div class="input-skupina" style="margin-bottom: 5px ;">
                <label for="hmotnost">Hmotnost (kg):</label>
                <input type="number" id="hmotnost" name="hmotnost" required min="30" max="250" step="0.1" placeholder="např. 75.5">
                </div>

                <div class="input-skupina" style="margin-bottom: 10px;">
                <label for="vyska">Výška (cm):</label>
                <input type="number" id="vyska" name="vyska" required min="100" max="250" step="1" placeholder="např. 180">
                </div>

                <div class="input-skupina">
                <label for="vek">Věk (roky):</label>
                <input type="number" id="vek" name="vek" required min="10" max="100" step="1" placeholder="např. 25">
                </div>

                <button type="button" class="submit-tlacitko" onclick="vypocitejKalorie()">Vypočítej</button>
                <div id="vysledek-kalkulacka-grid"></div>
            </form>
            <p><a href="/~georgivrbsky/src/views/kalkulacky_page.php">→ Přejít na více kalkulaček</a></p>
        </section>
    </div>


    <?php include __DIR__ . '/../../public/components/footer.html'; ?>


<script>
function vypocitejKalorie() {
    const hmotnost = parseFloat(document.getElementById('hmotnost').value);
    const vyska = parseFloat(document.getElementById('vyska').value);
    const vek = parseFloat(document.getElementById('vek').value);

    if (!hmotnost || !vyska || !vek) {
        document.getElementById('vysledek-kalkulacka-grid').innerText = "Vyplňte všechna pole.";
        return;
    }

    const BMR = 10 * hmotnost + 6.25 * vyska - 5 * vek + 5;
    document.getElementById('vysledek-kalkulacka-grid').innerText = `Odhadovaný denní kalorický příjem: ${Math.round(BMR)} kcal`;
}
</script>

</body>
</html>
