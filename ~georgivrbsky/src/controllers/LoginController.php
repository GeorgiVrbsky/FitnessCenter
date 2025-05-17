<?php
include __DIR__ . '/../../src/database/db_conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $EMAIL = trim($_POST["email"] ?? "");
    $HESLO = $_POST["heslo"] ?? "";


    if (empty($EMAIL) || empty($HESLO)) {
        echo "Zadejte e-mail i heslo.";
        exit();
    }


    $query = "SELECT id, jmeno, heslo, role_idRole FROM USER WHERE email = ?";
    $result = $db->query($query, [$EMAIL]);

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();


        if (password_verify($HESLO, $user["heslo"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["jmeno"] = $user["jmeno"];
            $_SESSION["email"] = $EMAIL;

            $roleId = $user["role_idRole"];


            $roleQuery = "SELECT nazev FROM ROLE WHERE id = ?";
            $roleResult = $db->query($roleQuery, [$roleId]);

            if ($roleResult && $roleResult->num_rows === 1) {
                $role = $roleResult->fetch_assoc();

                if ($role["nazev"] === "Trener") {
                    $_SESSION["role"] = "Trener";
                    header("Location: /~georgivrbsky/src/views/dashboardTrener_page.php");
                } else if($role["nazev"] === "Klient"){
                    header("Location: /~georgivrbsky/public/index.php");
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
