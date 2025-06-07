<?php
include __DIR__ . '/../../src/database/db_conn.php';
session_start();


//funkce na odstraneni diakritiky pro ziskani obrazku na zaklade jmena
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

//kontrola session
$user_id = $_SESSION["user_id"] ?? null;
if (!$user_id) {
    header("Location: /~georgivrbsky/src/views/login_page.php");
    exit();
}

// Odeslání výběru
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["trener_id"])) {
    $trener_id = $_POST["trener_id"];
    $db->query("UPDATE USER SET user_idUser = ? WHERE id = ?", [$trener_id, $user_id]);
    header("Location: /~georgivrbsky/src/views/dashboard_page.php");
    exit();
}

// Získání zaměření a místa uživatele
$role_res = $db->query("SELECT r.zamereni, r.misto FROM USER u JOIN ROLE r ON u.role_idRole = r.id WHERE u.id = ?", [$user_id]);
$treneri = [];

if ($role_res && $row = $role_res->fetch_assoc()) {
    $zamereni = $row["zamereni"];
    $misto = $row["misto"];

    $treneri_res = $db->query("
        SELECT u.id, u.jmeno, u.prijmeni
        FROM USER u
        JOIN ROLE r ON u.role_idRole = r.id
        WHERE r.zamereni = ? AND r.misto = ? AND r.nazev = 'Trener'
    ", [$zamereni, $misto]);

    while ($t = $treneri_res->fetch_assoc()) {
        $treneri[] = $t;
    }
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Výběr trenéra | Fitness Center</title>
    <meta name="description" content="Výběr trenéra podle vašich zvolených preferencí, jednodušše a rychle.">
    <meta name="keywords" content="trenér, výběr, FitnessCenter"> 
    <link rel="stylesheet" href="/~georgivrbsky/public/stylesheet.css">
    <link rel="icon" href="/~georgivrbsky/public/components/balloon-heart-fill.svg" type="image/svg">
</head>
<body>
    <div class="kontejner">
        <h1>Vyberte si trenéra:</h1>

        <?php if (count($treneri) === 0): ?>
            <p>Pro vaši preferenci nebyl nalezen žádný dostupný trenér.</p>
        <?php else: ?>
            <form method="POST" id="trener-form">
                <input type="hidden" name="trener_id" id="trener_id" value="">
                <div class="grid-treneri">
                    <?php foreach ($treneri as $trener): 
                        $id = htmlspecialchars($trener["id"]);
                        $jmeno = htmlspecialchars($trener["jmeno"]);
                        $prijmeni = htmlspecialchars($trener["prijmeni"]);
                        $nazev_souboru = strtolower(odstranitDiakritiku("{$jmeno}_{$prijmeni}.jpg"));
                        $src = "/~georgivrbsky/src/photos/" . $nazev_souboru;
                    ?>
                        <div class="trener-card" data-id="<?= $id ?>">
                            <p><strong><?= $jmeno ?> <?= $prijmeni ?></strong></p>
                            <img src="<?= htmlspecialchars($src) ?>" alt="Foto trenéra">
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <button type="submit" class="submit-tlacitko">Potvrdit výběr</button>

            </form>
        <?php endif; ?>
    </div>

<script>
    // Získání formuláře a skrytého inputu, do kterého se uloží ID vybraného trenéra
    const form = document.getElementById('trener-form');
    const hiddenInput = document.getElementById('trener_id');

    // Při kliknutí do oblasti s trenéry kontrolujeme, zda bylo kliknuto na kartu trenéra
    document.querySelector('.grid-treneri').addEventListener('click', e => {
        const card = e.target.closest('.trener-card'); // Najde nejbližší element s třídou .trener-card
        if (!card) return; // Pokud nebyla kliknuta karta, nic nedělej

        // Odstraníme třídu 'selected' ze všech karet, aby nebylo více označených zároveň
        document.querySelectorAll('.trener-card').forEach(c => c.classList.remove('selected'));

        // Označíme kliknutou kartu jako vybranou
        card.classList.add('selected');

        // Do skrytého inputu uložíme ID vybraného trenéra (z data atributu)
        hiddenInput.value = card.dataset.id;
    });

    // Pokud nebyl zvolen trenér po zmáčknutí submit, ukáže se upozornění
    form.addEventListener('submit', e => {
        if (!hiddenInput.value) {
            e.preventDefault(); // Zamezí odeslání formuláře
            alert('Vyberte prosím trenéra kliknutím na jeho fotku.');
        }
    });
</script>
</body>
</html>