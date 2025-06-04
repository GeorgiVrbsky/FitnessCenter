<?php
include __DIR__ . '/../../src/database/db_conn.php';
session_start();

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
    <title>Výběr trenéra</title>
    <link rel="stylesheet" href="/~georgivrbsky/public/stylesheet.css">
    <style>
        .grid-treneri {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        .trener-card {
            text-align: center;
            border: 2px solid transparent;
            border-radius: 12px;
            padding: 10px;
            transition: 0.3s;
            cursor: pointer;
        }
        .trener-card img {
            width: 100%;
            border-radius: 8px;
        }
        .trener-card.selected {
            border-color: green;
            background-color: #eaffea;
        }
        .submit-button {
            margin-top: 20px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="kontejner">
        <h2>Vyberte si trenéra:</h2>

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
                <button type="submit" class="submit-button">Potvrdit výběr</button>
            </form>
        <?php endif; ?>
    </div>

    <script>
        const cards = document.querySelectorAll('.trener-card');
        const hiddenInput = document.getElementById('trener_id');

        cards.forEach(card => {
            card.addEventListener('click', () => {
                cards.forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
                hiddenInput.value = card.dataset.id;
            });
        });

        document.getElementById('trener-form').addEventListener('submit', function (e) {
            if (!hiddenInput.value) {
                e.preventDefault();
                alert('Vyberte prosím trenéra kliknutím na jeho fotku.');
            }
        });
    </script>
</body>
</html>