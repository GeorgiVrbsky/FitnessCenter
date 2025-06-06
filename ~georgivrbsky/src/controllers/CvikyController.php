<?php
include __DIR__ . '/../../src/database/db_conn.php';

//funkce na ziskani cvicebniho planu pro uzivatele
function CvicebniPlan($db, $POCET_DNI, $ZAMERENI, $MISTO) {

    //select z databaze ze cviku podle preferenci a serazeno random
    $STMT = "SELECT * FROM CVIKY WHERE zamereni = ? AND misto = ? ORDER BY RAND()";
    $res = $db->query($STMT, [$ZAMERENI, $MISTO]);

    $DNY = 1;
    $POCET_CVIKU = 0;

    echo '<div class="cviky-grid">'; 

    echo '<div class="denni-blok">';
    echo "<h2>Den " . $DNY . "</h2>";
    $DNY++;

    //vypsani dennich bloku
    while($row = $res->fetch_assoc()) {
        if ($POCET_CVIKU == 5) {
            if ($DNY > $POCET_DNI) {
                break;
            }
            echo '</div>'; 
            echo '<div class="denni-blok">'; 
            echo "<h2>Den " . $DNY . "</h2>";
            $POCET_CVIKU = 0;
            $DNY++;
        }

        //vypsani jednotlivych cviku
        if ($DNY <= $POCET_DNI + 1) {
            echo '<div class="cvik">';
            echo "<p><strong>Cvik </strong>" . ($POCET_CVIKU + 1) . "</p>";
            echo "<p><strong>Název:</strong> " . $row["nazev"] . "</p>";
            echo "<p><strong>Sval:</strong> " . $row["typ_svalu"] . "</p>";
            echo '</div>';
            $POCET_CVIKU++;
        }
    }

    echo '</div>'; 
    echo '</div>'; 
}

?>
