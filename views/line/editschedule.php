
<?php 
//var_dump($this->data[1]);
$inf = $this->data[2];
$de  = $this->data[1];
$st  = $this->data[0];
$h = 0;
if(!empty($de)){
    $h = explode(':',$de[0][4])[0];
}
$class = '';


function span($h, $m, $info){
    echo "<span class='cell-min'>"
            . " <input class='tra' type='hidden' name='tramid[]' value='".$info[2]."'>"
            . " <input class='dri' type='hidden' name='driverid[]' value='".$info[3]."'>"
            . " <input class='tim' type='hidden' name='schedule[]' value='$h:$m'>$m"
            . "<span class='icons iconh icon-minus-sign'></span>"
            . "<span class='icons icone icon-edit'></span>"
        . "</span> ";
}

?>
<form method="POST">
<div class="column7">
    <div class="form-row">
        <span class="input-before1 short">Godzina odjazdu</span>
        <input class='valhidden' name="git" type='hidden'  value=''>
        <input id="newtime" autocomplete="off"  class="input1 short" type="text"
               onkeypress="writeTime(event, this); return false;" onclick="this.value = '';">
        <select  id="tram" class="input1 short">
            <?php
            foreach ($this->tramlist as $tram) {
                echo '<option value="' . $tram[0] . '">' . $tram[2] . ' (' . $tram[3] . ')</option>';
            }
            ?>
        </select>
        <select  id="driver" class="input1 short">
            <?php
            foreach ($this->driverlist as $driver) {
                echo '<option value="' . $driver[0] . '">' . $driver[2] . ' '. $driver[3] . ' (' . $driver[1] . ')</option>';
            }
            ?>
        </select>
        <span class='icons iconhp icon-plus-sign'></span>
        <span style="display:none" class='icons iconhe icon-edit'></span>
    </div>
    <hr>
    <div class="form-row">        
        <input type="submit" class="button" name="editschedule" value="WYŚLIJ NOWY ROZKŁAD" >
    </div>
    
</div>
<hr>

<div class="column1">  
<div class="title">
  <h2><?php  echo $inf[1]?></h2>
</div>
<p><?php  echo $inf[2]?></p>
<p><?php  echo $inf[3]?></p>
</div>

<div class="column5">
    <div class="column3"> 
        <div class="title">
            <?php
                foreach($st as $stop){
                    if($stop[0] == $this->data[3]){
                        $class = 'tram current';
                    }else{
                        $class = 'tram';
                    }
                    echo '<h2 id = '.$stop[0]." class='$class' data-line=''>". $stop[2] . '</h2>';
                }
            ?>
        </div>
    </div>
    <div class="column6">
        <?php if($h) : ?>
        <div data-h="<?php echo $h;?>" class="row">
            <div class="row-hour"> <?php echo $h;?></div>
            <div class="row-mins">
                <?php 
                    foreach ($de as $dep) {
                        $time = explode(':',$dep[4]);
                        if($time[0] == $h){
                            echo span($h,$time[1], $dep);
                        }
                        else {
                            $h = $time[0];
                            echo "</div></div><div data-h='$h' class='row'>"
                            . "<div class='row-hour'>$h </div>"
                            . '<div class="row-mins">';
                            echo span($h,$time[1], $dep);
                            
                        }
                    }
                ?>
                
            
            
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>  
</form>