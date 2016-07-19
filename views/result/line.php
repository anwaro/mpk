<script> var alltramstrop =[];</script>
<?php 
//var_dump($this->data);
$inf = $this->data[2];
$de  = $this->data[1];
$st  = $this->data[0];
$h = count($de)?explode(':',$de[0][4])[0]:"";
$class = '';
$id = trim ($this->data[3]) . trim ($inf[1]);
$cStop = '';
?>


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
<div id="mapa<?php echo $id; ?>" class="mapka"></div>
</div>

<div class="column5">
    <div class="column3"> 
        <div class="title">
            <?php
                foreach($st as $stop){
                    if($stop[0] == $this->data[3]){
                        $cStop = $stop;
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
<script>
    alltramstrop.push([ <?php echo "'mapa". $id ."', ". $cStop[3].", ". $cStop[4]; ?>]);
    function initMaps(){   
        for(var i in alltramstrop){
           var wspolrzedne = new google.maps.LatLng(alltramstrop[i][1], alltramstrop[i][2]); 
           var opcjeMapy = {
                zoom: 17,
                center: wspolrzedne,
                mapTypeId: google.maps.MapTypeId.SATELLITE
            };
            var mapa = new google.maps.Map(document.getElementById(alltramstrop[i][0]), opcjeMapy); 
            
            var opcjeMarkera ={
                    position: wspolrzedne,
                    map: mapa,
                    title: "przystanek"
            };
            var marker = new google.maps.Marker(opcjeMarkera);
        }
    }   
</script> 
<script onload="initMaps()" src="http://maps.google.com/maps/api/js" type="text/javascript"></script>
