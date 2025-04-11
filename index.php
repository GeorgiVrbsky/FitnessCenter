<?php

session_start();

if(!isset($_SESSION["user_id"])){
    header("Location: login_page.php");
    exit();
}else{
    echo "Ahoooj " . $_SESSION["jmeno"];
    header("Location: dashboard_page.php");
}

?>
