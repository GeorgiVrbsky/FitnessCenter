<?php
include __DIR__ . '/../../src/database/db_conn.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Trim & sanitize vstupy
    $JMENO = trim($_POST["jmeno"] ?? '');
    $PRIJMENI = trim($_POST["prijmeni"] ?? '');
    $EMAIL = trim($_POST["email"] ?? '');
    $TELEFON = trim($_POST["telefon"] ?? '');
    $DATUM_NAROZENI = trim($_POST["datum_narozeni"] ?? '');
    $POHLAVI = trim($_POST["pohlavi"] ?? '');
    $HESLO_RAW = $_POST["heslo"] ?? '';
    $CONFIRM_HESLO = $_POST["confirm_heslo"] ??'';

    // Validace prázdných hodnot
    if (empty($JMENO) || empty($PRIJMENI) || empty($EMAIL) || empty($HESLO_RAW) || empty($CONFIRM_HESLO)) {
        echo "Vyplňte prosím všechna povinná pole.";
        exit();
    }

    //validace hesla
    if ($HESLO_RAW !== $CONFIRM_HESLO) {
        echo "Hesla se neshodují.";
        exit();
    }

    $HESLO = password_hash($HESLO_RAW, PASSWORD_DEFAULT);

    try {
        $query = "
            INSERT INTO USER (
                jmeno, prijmeni, heslo, email, telefon, datum_narozeni, pohlavi, role_idRole, user_idUser
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";

        $params = [
            $JMENO,
            $PRIJMENI,
            $HESLO,
            $EMAIL,
            $TELEFON,
            $DATUM_NAROZENI,
            $POHLAVI,
            null,
            null
        ];

        $result = $db->query($query, $params);

        if ($result) {
            $_SESSION["user_id"] = $db->lastInsertId();
            $_SESSION["jmeno"] = $JMENO;
            header("Location: /../../src/views/parametry_page.php");
            exit();
        } else {
            echo "Chyba při ukládání do databáze.";
        }

    } catch (Exception $e) {
        echo "Chyba: " . $e->getMessage();
    }
}
