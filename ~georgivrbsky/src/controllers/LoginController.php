<?php
include __DIR__ . '/../../src/database/db_conn.php';
session_start();//zacatek session

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //ziskani parametru z formulare
    $EMAIL = trim($_POST["email"] ?? "");
    $HESLO = $_POST["heslo"] ?? "";

    //kontrola prazdnych udaju
    if (empty($EMAIL) || empty($HESLO)) {
        echo "Zadejte e-mail i heslo.";
        exit();
    }

    //query v databazi pro email uzivatele
    $query = "SELECT id, jmeno, heslo, role_idRole FROM USER WHERE email = ?";
    $result = $db->query($query, [$EMAIL]);

    //pokud se nasel uzivatel
    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        //verifikace zahashovaneho hesla
        if (password_verify($HESLO, $user["heslo"])) {
            //nastaveni session promennych
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["jmeno"] = $user["jmeno"];
            $_SESSION["email"] = $EMAIL;
            
            //id ROLE
            $roleId = $user["role_idRole"];

            //ziskani nazvu role
            $roleQuery = "SELECT nazev FROM ROLE WHERE id = ?";
            $roleResult = $db->query($roleQuery, [$roleId]);

            if ($roleResult && $roleResult->num_rows === 1) {
                $role = $roleResult->fetch_assoc();
                
                //lokace je presunuta podle vysledku role
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
