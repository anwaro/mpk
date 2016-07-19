<script> var alltramstrop =[];</script>
<?php 

foreach ($this->schedule as $data) {
    

    //var_dump($data);
    $inf = $data[2];
    $de  = $data[1];
    $st  = $data[0];
    $h = explode(':',$de[0][4])[0];
    $class = '';
    $id = trim ($data[3][0]) . trim ($inf[1]);
    ?>

    <div class="column8">

        <form method="POST" id="showTramStop<?php echo $inf[0]; ?>" action="{%url%}result/line/">
            <input id="lineNumber" type="hidden" name="line-number" value="<?php echo $inf[0]; ?>">
            <input id="tramStop<?php echo $inf[0]; ?>" type="hidden" name="tramstop-number" 
                   value="<?php echo $data[3][0]; ?>">
            <input  type="hidden" name="tramline" value="1">
        </form>
        <h2> 
            <?php echo $data[3][2] . ' </h2> Numer przystanku: ' . $data[3][1] ; ?>
        
    </div>
    <div class="column9">
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
                            if($stop[0] == $data[3][0]){
                                $class = 'tram current';
                            }else{
                                $class = 'tram';
                            }
                            echo '<h2 id = '.$stop[0]." class='$class' data-line='". $inf[0] ."'>" . $stop[2] . '</h2>';
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
    </div>
<script> 
    alltramstrop.push([ <?php echo "'mapa". $id ."', ". $data[3][3].", ". $data[3][4]; ?>]);
</script>
<?php
}
?>

<script>
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
