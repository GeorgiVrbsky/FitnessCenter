<?php
session_start();
session_unset(); // Smaže všechny proměnné
session_destroy(); // Zničí celou session
header("Location: /~georgivrbsky/src/views/login_page.php"); // Přesměruje na login
exit();
?>