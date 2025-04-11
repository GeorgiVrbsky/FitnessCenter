<?php
include "db_conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $EMAIL = trim($_POST["email"] ?? "");
    $HESLO = trim($_POST["heslo"] ?? "");

    if (empty($EMAIL) || empty($HESLO)) {
        echo "Zadejte e-mail i heslo.";
        exit();
    }

    // Jeden dotaz – načteme vše, co potřebujeme
    $query = "SELECT id, jmeno, heslo FROM user WHERE email = ?";
    $result = $db->query($query, [$EMAIL]);

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $HASHED_PASS = $row["heslo"];

        if (password_verify($HESLO, $HASHED_PASS)) {
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["jmeno"] = $row["jmeno"];
            $_SESSION["email"] = $EMAIL;

            header("Location: index.php");
            exit();
        } else {
            echo "Nesprávné heslo.";
        }
    } else {
        echo "Uživatel s tímto e-mailem nebyl nalezen.";
    }
}
