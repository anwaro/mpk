
<a href="{%url%}line/addroute"><span class="icon iconcolor icon-plus-sign"> DODAJ NOWĄ LINIE</span></a>
<hr>
<br>

<div class="column7">
    <div class="row current">
        <div class="cell5">Numer</div>
        <div class="cell1">Start</div>
        <div class="cell1">Koniec</div>
        <div class="cell4">-</div>
        <div class="cell4">-</div>
    </div>

<?php
    
    foreach ($this->lines as $line) {
        echo '<div class="row">'
                . '<div class="cell5">'
                . $line[1]
                . '</div><div class="cell1">'
                . $line[2]
                . '</div><div class="cell1">'
                . $line[3]
                . '</div><div class="cell4"><a href="{%url%}line/info/'
                . $line[0]
                . '">INFO</a></div><div class="cell4"><a href="{%url%}line/remove/'
                . $line[0]
                . '">USUŃ LINIE</a></div></div>' . "\n";
        
    }


?>

</div>