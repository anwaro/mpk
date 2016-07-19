
<?php 
//var_dump($this->data);
$inf = $this->data[2];
$de  = $this->data[1];
$st  = $this->data[0];
@$h = explode(':',$de[0][4])[0];
$class = '';
?>

<div class="column8">
    <div class="column1"> 
        <a href="{%url%}line/editroute/<?php echo $inf[0]; ?>">
        <span class="icon icon-edit"></span>
        <div class="title">
          <h2>EDYTUJ TRASĘ</h2>
        </div>
        </a>
    </div>
    <div class="column1"> 
        <a href="{%url%}line/editschedule/<?php echo $inf[0]; ?>">
        <span class="icon icon-time"></span>
        <div class="title">
          <h2>EDYTUJ WYJAZDY</h2>
        </div>
        </a>
    </div>
    <div class="column1"> 
        <a href="{%url%}line/remove/<?php echo $inf[0]; ?>">
        <span class="icon icon-trash"></span>
        <div class="title">
          <h2>USUŃ LINIĘ</h2>
        </div>
        </a>
    </div>
    
    
</div>

<hr>
<br>


<form method="POST" id="showTramStop" action="{%url%}result/line/">
    <input id="lineNumber" type="hidden" name="line-number" value="<?php echo $inf[0]; ?>">
    <input id="tramStop" type="hidden" name="tramstop-number" value="<?php echo $this->data[3]; ?>">
    <input  type="hidden" name="tramline" value="1">
</form>

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
                    echo '<h2 id = '.$stop[0]." class='$class' data-line=''>". $stop[2]. ' -'.$stop[0] . '</h2>';
                }
            ?>
        </div>
    </div>
    <div class="column6">
        <div class="row">
            <div class="row-hour"> <?php echo $h;?></div>
            <div class="row-mins">
                <?php 
                    foreach ($de as $dep) {
                        $time = explode(':',$dep[4]);
                        if($time[0] == $h){
                            echo "<span class='cell-min'>".$time[1] . '</span> ';
                        }
                        else {
                            $h = $time[0];
                            echo '</div></div><div class="row">'
                            . "<div class='row-hour'>$h </div>"
                            . '<div class="row-mins">';
                            echo "<span class='cell-min'>".$time[1] . '</span> ';
                            
                        }
                    }
                ?>
                
            
            
            </div>
        </div>
    </div>
</div>