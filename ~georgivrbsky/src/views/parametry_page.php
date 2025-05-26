<?php
include __DIR__ . '/../../src/database/db_conn.php';
session_start();

$user_id = $_SESSION["user_id"] ?? null;
if (!$user_id) {
    header("Location: /~georgivrbsky/src/views/login_page.php");
    exit();
}


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

            <div class="input-group">
                <label for="vyska">Vaše výška (cm)</label>
                <input type="number" id="vyska" name="vyska" required min="100" max="250" step="1" placeholder="např. 180">
            </div>

            <div class="input-group">
                <label for="hmotnost">Vaše hmotnost (kg)</label>
                <input type="number" id="hmotnost" name="hmotnost" required min="30" max="250" step="0.1" placeholder="např. 75.5">
            </div>

            <div class="input-group">
                <label for="obvod_pasu">Obvod pasu (cm)</label>
                <input type="number" id="obvod_pasu" name="obvod_pasu" required min="30" max="200" step="0.1" placeholder="např. 85.0">
            </div>

            <div class="input-group">
                <label for="obvod_hrudniku">Obvod hrudníku (cm)</label>
                <input type="number" id="obvod_hrudniku" name="obvod_hrudniku" required min="50" max="200" step="0.1" placeholder="např. 100.0">
            </div>

        <h2>Preference</h2>

            <div class="input-group">
                <label for="zamereni">Zaměření</label>
                <select id="zamereni" name="zamereni" required>
                    <option value="" disabled selected>-- Vyberte zaměření --</option>
                    <option value="Nabirani_Svalu">Nabírání Svalů</option>
                    <option value="Hubnuti">Hubnutí</option>
                    <option value="Kondice">Kondice</option>
                </select>
            </div>

            <div class="input-group">
                <label for="misto">Místo</label>
                <select id="misto" name="misto" required>
                    <option value="" disabled selected>-- Vyberte místo --</option>
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