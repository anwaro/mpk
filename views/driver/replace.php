<?php

$dr = $this->status[0];

if($this->status[1]){
    $driver1 = 'olddriver';
    $driver2 = 'newdriver';
    $info = "Kierowca posiada przypisane przejazdy na lini <span style='color:#197D62;'>" . $this->status[1]
            ."</span>, możesz zastąpić go następującymi osobami";

}else{
    $driver2 = 'olddriver';
    $driver1 = 'newdriver';
    $info = "Kierowca nie posiada przypisanych przejazdów, możesz zastąpić go za";   
}

?>
<div class="form-search">
    <span class="titlecolor"><?php echo $dr[2] . ' ' . $dr[3] . ' ('.$dr[1].')';  ?></span><hr><br>
    <h2><?php echo $info;  ?></h2><br>
    <form  action="{%url%}driver/replace/<?php echo $dr[0];  ?>" name="search_connection" method="post">
        <div class="form-row">
            <input type="hidden" value="<?php echo $dr[0];  ?>" name="<?php echo $driver1;  ?>" >
            <select name="<?php echo $driver2;  ?>" class="input">
            <?php 
                foreach ($this->data as $pers) {
                    echo '<option value="'.$pers[0].'">'.$pers[1].' -- '.$pers[2].' '.$pers[3].'</option>';
                }

            ?>

            </select>
        </div>

        <div class="form-row">
            <input type="submit" name="replace" class="button" value="ZAMIEŃ">
        </div>

    </form>

</div>