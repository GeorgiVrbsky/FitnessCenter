<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: /~georgivrbsky/src/views/login_page.php");
    exit();
} else {
    echo "Ahoooj " . $_SESSION["jmeno"];
    header("Location: /~georgivrbsky/src/views/dashboard_page.php");
    exit();
}
?>