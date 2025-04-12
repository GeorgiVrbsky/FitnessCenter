<?php
include "db_conn.php";
    function CvicebniPlan($db, $POCET_DNI, $ZAMERENI, $MISTO){
        $STMT = "SELECT * FROM CVIKY WHERE zamereni = ? AND misto = ? ORDER BY RAND()";
        $res = $db->query($STMT, [$ZAMERENI, $MISTO]);

        $k = 0;
        $ALREADY_USED = [];
        while($row = $res->fetch_assoc()){
            echo $row["id"];
            echo $row["nazev"];
            echo $row["typ_svalu"];
            echo "<br>";
        }



    }

