<?php

    $driver = $this->data[0];
    $id = str_replace(" ", "", $driver[0]);
    $status = $this->data[1];

    if($status){
        $info ="Kierowca wykonuje przejazdy na lini " .$status;
    }
     else {
         $info ="Kierowca nie wykonuje zadnych przejazdow ";
    }
    
    ?>

<div class="column7">
    <div class="row current">
        <div class="cell1">Numer</div>
        <div class="cell1">Imię</div>
        <div class="cell1">Nazwisko</div>
        <div class="cell1">Pracuje od</div>
    </div>
    <div class="row">
        <div class="cell1"><?php echo $driver[1]; ?></div>
        <div class="cell1"><?php echo $driver[2]; ?></div>
        <div class="cell1"><?php echo $driver[3]; ?></div>
        <div class="cell1"><?php echo $driver[4]; ?></div>
    </div>
</div>

<div class="form-search">
    
    <h2><?php echo $info ; ?></h2><br>
    
</div>
<h2>SKARGI</h2>
<hr>


<?php
if(count($this->comp) > 0 ){
    echo '<div class="column8"><div class="row current">
        <div class="cell7">Treść</div>
        <div class="cell1">-</div>
    </div>';
    foreach ($this->comp as $value) {
        $id = $value[0];
        $content = $value[2];
        echo "<div class='row'><div class='cell7'>$content</div>"
        . "<div class='cell1'><a href='{%url%}complaint/remove/$id'>USUŃ SKARGĘ</a></div></div>";
        
    }
    echo '</div>';
}else{
    echo 'Kierowca nie posiada żadnych skarg :)';
}



?>

<div class="column8">
    <div class="column1"> 
        <a href="{%url%}driver/replace/<?php echo $id; ?>">
        <span class="icon icon-repeat"></span>
        <div class="title">
          <h2>ZNAJDŹ ZASTĘPSTWO</h2>
        </div>
        </a>
    </div>
    <div class="column1"> 
        <a href="{%url%}driver/remove/<?php echo $id; ?>">
        <span class="icon icon-trash"></span>
        <div class="title">
          <h2>USUŃ DANE KIEROWCY</h2>
        </div>
        </a>
    </div>
    <div class="column1"> 
        <a href="{%url%}driver/edit/<?php echo $id; ?>">
        <span class="icon icon-edit"></span>
        <div class="title">
          <h2>EDYTUJ DANE KIEROWCY</h2>
        </div>
        </a>
    </div>
    
    
</div>