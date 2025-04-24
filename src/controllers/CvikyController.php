<?php
include __DIR__ . '/~georgivrbsky/src/database/db_conn.php';

function CvicebniPlan($db, $POCET_DNI, $ZAMERENI, $MISTO) {
    // 1. Získání náhodně seřazených cviků podle zaměření a místa
    $STMT = "SELECT * FROM CVIKY WHERE zamereni = ? AND misto = ? ORDER BY RAND()";
    $res = $db->query($STMT, [$ZAMERENI, $MISTO]);

    $DNY = 1;
    $POCET_CVIKU = 0;

    echo "Den " . $DNY . "<br>";
    $DNY++;

    while($row = $res->fetch_assoc()) {
        // Po každých 5 cvicích začni nový den
        if ($POCET_CVIKU == 5) {
            if ($DNY > $POCET_DNI) {
                break; // Pokud už jsme přes počet dnů, ukonči
            }
            echo "<br>Den " . $DNY . "<br>";
            $POCET_CVIKU = 0;
            $DNY++;
        }

        if ($DNY <= $POCET_DNI + 1) { // +1 protože první den se vypíše ještě před cyklem
            echo "ID: " . $row["id"] . " | ";
            echo "Název: " . $row["nazev"] . " | ";
            echo "Sval: " . $row["typ_svalu"] . "<br>";
            $POCET_CVIKU++;
        }
    }
}

?>
