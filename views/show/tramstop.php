

<a href="{%url%}tramstop/add"><span class="icon iconcolor icon-plus-sign"> DODAJ NOWY PRZYSTANEK</span></a>
    <hr>
    <br>
<div class="column7">
    <div class="row current">
        <div class="cell5">Numer</div>
        <div class="cell1">Nazwa</div>
        <div class="cell5">x</div>
        <div class="cell5">y</div>
        <div class="cell4">-</div>
        <div class="cell4">-</div>
    </div>

<?php
    
    foreach ($this->tramstops as $tramstop) {
        echo '<div class="row">'
                . '<div class="cell5">'
                . $tramstop[1]
                . '</div><div class="cell1">'
                . $tramstop[2]
                . '</div><div class="cell5">'
                . $tramstop[3]
                . '</div><div class="cell5">'
                . $tramstop[4]
                . '</div><div class="cell4"><a href="{%url%}tramstop/edit/'
                . $tramstop[0]
                . '">EDYTUJ DANE</a></div><div class="cell4"><a href="{%url%}tramstop/remove/'
                . $tramstop[0]
                . '">USUŃ PRZYSTANEK</a></div></div>';
    }


?>

</div>