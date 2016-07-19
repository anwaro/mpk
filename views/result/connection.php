


<?php

foreach ($this->connectionInfo as $conn) {
    $t1 = explode(':', $conn[4])[0] . ":" . explode(':', $conn[4])[1];
    $t2 = explode(':', $conn[6])[0] . ":" . explode(':', $conn[6])[1];
    
    echo '<div class="column9">';
        echo "<span class='numer'>".$conn[1]."</span>";
        echo "<span class='station'>".$conn[2]." ...</span>";
        echo "<span class='station2'>".$conn[3]."</span>";
        echo "<span class='time'>$t1</span>";
        echo "<span class='arrow icons iconcolor icon-arrow-right'></span>";
        echo "<span class='station2'>".$conn[5]."</span>";
        echo "<span class='time'>$t2</span>";
        echo "<span class='station'>... ".$conn[7]."</span>";
    echo '</div><hr>';
}