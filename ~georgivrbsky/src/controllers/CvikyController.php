<?php
include __DIR__ . '/../../src/database/db_conn.php';

function CvicebniPlan($db, $POCET_DNI, $ZAMERENI, $MISTO) {
    $STMT = "SELECT * FROM CVIKY WHERE zamereni = ? AND misto = ? ORDER BY RAND()";
    $res = $db->query($STMT, [$ZAMERENI, $MISTO]);

    $DNY = 1;
    $POCET_CVIKU = 0;

    echo '<div class="plan-grid">'; 

    echo '<div class="day-block">';
    echo "<h2>Den " . $DNY . "</h2>";
    $DNY++;

    while($row = $res->fetch_assoc()) {
        if ($POCET_CVIKU == 5) {
            if ($DNY > $POCET_DNI) {
                break;
            }
            echo '</div>'; 
            echo '<div class="day-block">'; 
            echo "<h2>Den " . $DNY . "</h2>";
            $POCET_CVIKU = 0;
            $DNY++;
        }

        if ($DNY <= $POCET_DNI + 1) {
            echo '<div class="exercise">';
            echo "<p><strong>ID:</strong> " . $row["id"] . "</p>";
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
