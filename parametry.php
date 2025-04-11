<?php
include "db_conn.php";
session_start();
//!!ochrana, aby se sem nedostal nikdo jinak nez z registrace
//!!zabranit, aby uzivatel nemohl dat, ze vazi 0kg nebo ze ma obvody 0cm
echo $_SESSION["jmeno"];//tohle potom odstranit, tohle je pro DEV


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

    try{
    // Najdeme roli podle preferencí
    $select = "SELECT id FROM ROLE WHERE nazev = ? AND zamereni = ? AND misto = ?";
    $role_result = $db->query($select, ["Klient", $zamereni, $misto]);
    }catch(Exception $e){
        echo $e->getMessage();
    }

    if ($role = $role_result->fetch_assoc()) {
        $role_id = $role["id"];
        $db->query("UPDATE USER SET role_idRole = ? WHERE id = ?", [$role_id, $user_id]);
        echo "<p style='color: green;'>Úspěšně uloženo!</p>";
        
        try{
            // Uložíme parametry
            $params = [1, $vyska, $hmotnost, $obvod_pasu, $obvod_hrudniku, $user_id];
            $insert = "INSERT INTO PARAMETRY (cislo_tydne, vyska, hmotnost, obvod_pasu, obvod_hrudniku, user_idUser) VALUES (?, ?, ?, ?, ?, ?)";
            $db->query($insert, $params);
        
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        header("Location: trener.php");
        exit();
    } else {
        echo "<p style='color: red;'>Nebyla nalezena odpovídající role.</p>";
    }

    
}
?>

<!-- HTML Formulář -->
<form method="POST" action="">
    <h1>1. Tyden</h1>
    <h2>Parametry</h2>
    <label>Vaše výška (cm)</label><br>
    <input type="number" name="vyska" required><br><br>

    <label>Vaše hmotnost (kg)</label><br>
    <input type="number" name="hmotnost" required><br><br>

    <label>Obvod pasu (cm)</label><br>
    <input type="number" name="obvod_pasu" required><br><br>

    <label>Obvod hrudniku (cm)</label><br>
    <input type="number" name="obvod_hrudniku" required><br><br>

    <h2>Preference</h2>

    <label>Zaměření</label><br>
    <select name="zamereni" required>
        <option value="Nabirani_Svalu">Nabírání Svalů</option>
        <option value="Hubnuti">Hubnutí</option>
        <option value="Kondice">Kondice</option>
    </select><br><br>

    <label>Místo</label><br>
    <select name="misto" required>
        <option value="Posilovna">Posilovna</option>
        <option value="Doma">Doma</option>
    </select><br><br>

    <button type="submit">Submit</button>
</form>
