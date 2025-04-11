<?php
include "db_conn.php";
session_start();

echo $_SESSION["jmeno"];

$user_id = $_SESSION["user_id"] ?? null;

if (!$user_id) {
    echo "Nepřihlášený uživatel.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["vybrany_trener"])) {
    $trener_id = $_POST["vybrany_trener"];

    // Uložíme výběr trenéra do user tabulky
    $db->query("UPDATE user SET USER_idUser = ? WHERE id = ?", [$trener_id, $user_id]);
    echo "<p style='color: green;'>Trenér byl úspěšně vybrán!</p>";
    header("Location: dashboard_page.php");
    exit();
}

// 1. Získáme Role_idRole klienta
$role_res = $db->query("SELECT r.Zamereni, r.Misto FROM user u JOIN role r ON u.Role_idRole = r.id WHERE u.id = ?", [$user_id]);

if ($role_res && $row = $role_res->fetch_assoc()) {
    $zamereni = $row["Zamereni"];
    $misto = $row["Misto"];

    // 2. Najdeme trenéry se stejným zaměřením a místem
    $treneri = $db->query("
        SELECT u.id, u.jmeno, u.prijmeni
        FROM user u
        JOIN role r ON u.Role_idRole = r.id
        WHERE r.Zamereni = ? AND r.Misto = ? AND r.Nazev = 'Trener'
    ", [$zamereni, $misto]);

    if ($treneri && $treneri->num_rows > 0) {
        echo "<form method='POST'>";
        echo "<h2>Vyberte si trenéra:</h2>";
        echo "<select name='vybrany_trener' required>";
        while ($t = $treneri->fetch_assoc()) {
            echo "<option value='{$t["id"]}'>{$t["jmeno"]} {$t["prijmeni"]}</option>";
        }
        echo "</select><br><br>";
        echo "<button type='submit'>Potvrdit výběr</button>";
        echo "</form>";
    } else {
        echo "<p>Pro vaši preferenci nebyl nalezen žádný dostupný trenér.</p>";
    }
} else {
    echo "<p>Nemáte přiřazenou roli nebo se nepodařilo získat data.</p>";
}
?>
