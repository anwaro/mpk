

<a href="{%url%}driver/add"><span class="icon iconcolor icon-plus-sign"> DODAJ NOWEGO KIEROWCE</span></a>
<hr>
<br>
<div class="column7">
    <div class="row current">
        <div class="cell6">Numer</div>
        <div class="cell3">Imię</div>
        <div class="cell2">Nazwisko</div>
        <div class="cell5">Pracuje od</div>
        <div class="cell5">-</div>
        <div class="cell5">-</div>
        <div class="cell5">-</div>
    </div>

<?php
    
    foreach ($this->drivers as $driver) {
        $id = str_replace(" ", "", $driver[0]);
        echo '<div class="row">'
                . '<div class="cell6">'
                    . $driver[1]
                . '</div>'
                . '<div class="cell3">'
                    . $driver[2]
                . '</div>'
                . '<div class="cell2">'
                    . $driver[3]
                . '</div>'
                . '<div class="cell5">'
                    . $driver[4]
                . '</div>'
                . '<div class="cell5">'
                    . ' <a href="{%url%}driver/info/'. $id  . '">INFO</a>'
                . '</div>'
                . '<div class="cell5">'
                . ' <a href="{%url%}driver/edit/'. $id  . '">EDYTUJ DANE</a>'
                . '</div>'
                . '<div class="cell5">'
                    . '<a href="{%url%}driver/remove/' . $id . '">USUŃ KIEROWCE</a>'
                . '</div>'
            . '</div>' ."\n ";
    }


?>

</div>

