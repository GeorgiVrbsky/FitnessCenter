<?php

session_start();

if(!isset($_SESSION["user_id"])){
    header("Location: /src/views/login_page.php");
    exit();
}else{
    echo "Ahoooj " . $_SESSION["jmeno"];
    header("Location: /src/views/dashboard_page.php");
}

?>
