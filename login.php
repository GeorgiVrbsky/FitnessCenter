<?php
include "db_conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Načti přihlašovací údaje
    $EMAIL = trim($_POST["email"] ?? "");
    $HESLO = $_POST["heslo"] ?? "";

    // Validace vstupu
    if (empty($EMAIL) || empty($HESLO)) {
        echo "Zadejte e-mail i heslo.";
        exit();
    }

    // Zjisti, zda existuje uživatel s daným e-mailem
    $query = "SELECT id, jmeno, heslo, role_idRole FROM USER WHERE email = ?";
    $result = $db->query($query, [$EMAIL]);

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Ověření hesla
        if (password_verify($HESLO, $user["heslo"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["jmeno"] = $user["jmeno"];
            $_SESSION["email"] = $EMAIL;

            $roleId = $user["role_idRole"];

            // Získání názvu role podle ID
            $roleQuery = "SELECT nazev FROM ROLE WHERE id = ?";
            $roleResult = $db->query($roleQuery, [$roleId]);

            if ($roleResult && $roleResult->num_rows === 1) {
                $role = $roleResult->fetch_assoc();

                if ($role["nazev"] === "Trener") {
                    header("Location: trener_dashboard.php");
                } else {
                    header("Location: index.php");
                }
                exit();
            } else {
                echo "Nepodařilo se načíst roli uživatele.";
            }
        } else {
            echo "Nesprávné heslo.";
        }
    } else {
        echo "Uživatel s tímto e-mailem nebyl nalezen.";
    }
}
?>
