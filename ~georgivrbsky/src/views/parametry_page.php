<?php
include __DIR__ . '/../../src/database/db_conn.php';
session_start();

$user_id = $_SESSION["user_id"] ?? null;
if (!$user_id) {
    header("Location: /~georgivrbsky/src/views/login_page.php");
    exit();
}

// Ochrana před neautorizovaným přístupem
echo $_SESSION["jmeno"]; // pro DEV, později odstranit

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $vyska = $_POST["vyska"] ?? '';
    $hmotnost = $_POST["hmotnost"] ?? '';
    $obvod_pasu = $_POST["obvod_pasu"] ?? '';
    $obvod_hrudniku = $_POST["obvod_hrudniku"] ?? '';
    $zamereni = $_POST["zamereni"] ?? '';
    $misto = $_POST["misto"] ?? '';
    $nazev = $_POST["nazev"] ?? '';

    $user_id = $_SESSION["user_id"] ?? null;

    if (!$user_id) {
        echo "Uživatel není přihlášen.";
        exit();
    }

    try {
        // Najdeme roli podle preferencí
        $select = "SELECT id FROM ROLE WHERE nazev = ? AND zamereni = ? AND misto = ?";
        $role_result = $db->query($select, ["Klient", $zamereni, $misto]);
    } catch(Exception $e) {
        echo $e->getMessage();
    }

    if ($role = $role_result->fetch_assoc()) {
        $role_id = $role["id"];
        $db->query("UPDATE USER SET role_idRole = ? WHERE id = ?", [$role_id, $user_id]);
        echo "<p style='color: green;'>Úspěšně uloženo!</p>";

        try {
            // Uložíme parametry
            $params = [1, $vyska, $hmotnost, $obvod_pasu, $obvod_hrudniku, $user_id];
            $insert = "INSERT INTO PARAMETRY (cislo_tydne, vyska, hmotnost, obvod_pasu, obvod_hrudniku, user_idUser) VALUES (?, ?, ?, ?, ?, ?)";
            $db->query($insert, $params);
        
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        header("Location: /~georgivrbsky/src/views/trenerVyber_page.php");
        exit();
    } else {
        echo "<p style='color: red;'>Nebyla nalezena odpovídající role.</p>";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parametry</title>
    <link rel="stylesheet" href="/~georgivrbsky/public/stylesheet.css">
</head>
<body>

<div class="container" style="max-width: 600px;">
    <div class="form-container">
        <h1>1. Týden</h1>
        <h2>Parametry</h2>
        
        <form method="POST" action="" class="parametry-form">
            <!-- Parametry -->
            <div class="input-group">
                <label for="vyska">Vaše výška (cm)</label>
                <input type="number" name="vyska" required>
            </div>

            <div class="input-group">
                <label for="hmotnost">Vaše hmotnost (kg)</label>
                <input type="number" name="hmotnost" required>
            </div>

            <div class="input-group">
                <label for="obvod_pasu">Obvod pasu (cm)</label>
                <input type="number" name="obvod_pasu" required>
            </div>

            <div class="input-group">
                <label for="obvod_hrudniku">Obvod hrudníku (cm)</label>
                <input type="number" name="obvod_hrudniku" required>
            </div>

            <h2>Preference</h2>

            <div class="input-group">
                <label for="zamereni">Zaměření</label>
                <select name="zamereni" required>
                    <option value="Nabirani_Svalu">Nabírání Svalů</option>
                    <option value="Hubnuti">Hubnutí</option>
                    <option value="Kondice">Kondice</option>
                </select>
            </div>

            <div class="input-group">
                <label for="misto">Místo</label>
                <select name="misto" required>
                    <option value="Posilovna">Posilovna</option>
                    <option value="Doma">Doma</option>
                </select>
            </div>

            <button type="submit" class="submit-button">Uložit</button>
        </form>
    </div>
</div>

</body>
</html>