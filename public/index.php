<?php

session_start();

if(!isset($_SESSION["user_id"])){
    header("Location: /User/login_page.php");
    exit();
}else{
    echo "Ahoooj " . $_SESSION["jmeno"];
    header("Location: /Dashboard/dashboard_page.php");
}

?>
