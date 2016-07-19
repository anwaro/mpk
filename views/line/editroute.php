
<?php 
    if(count($this->status[1])>0){
        echo '<h2>'.$this->status[1].'</h2><hr>';
    }
    if(strlen($this->status[2][0])>0){
        echo '<span class="titlecolor">'. $this->status[2][1] .' </span><h2>( '. $this->status[2][2] 
            .' ---> '.$this->status[2][3].')</h2>' ;
        echo '<a class="fontcolor" href="{%url%}line/info/'.$this->status[2][0] . '">INFO</a><hr>';
    }
    
    $idStart = $this->tramstopsInLine[0][0];
    $idStop = $this->tramstopsInLine[count($this->tramstopsInLine)-1][0];

    
?>
<div class="column9">
    <form method="POST" action="{%url%}line/editroute/<?php echo str_replace(" ", "", $this->line[0]) ;?>">

        <div class="form-search" style="float:left;">
            <hr>  
            <div class="form-row">
                <span class="input-before">Numer Lini:</span>
                <input autocomplete="off" id="from-station" class="input input-tramstop" 
                       name="linenumber"  type="text" pattern="[0-9]{1,3}" 
                       value = "<?php echo str_replace(" ", "",$this->line[1]) ;?>" readonly required>

            </div>
            <div class="form-row">
                <span class="button settime">UZUPEŁNIJ CZASY</span>
            </div>
            <div class="form-row">
                <input type="submit" class="button" name="editlineroute" 
                       value="ZAPISZ NOWE DANE" disabled style="display: none">
                <span id="captcha"></span>
            </div>
        </div>
        <div class="form-search" style="float:left;">

            <div class="form-row1">
                <span class="input-before">Pętla start</span>
                <select  name="tramstopStart" class="input">
                <?php
                foreach ($this->tramstops as $trstop) {
                    echo "<option value='" . $trstop[0] . ($trstop[0] == $idStart?"' selected='selected":"")
                             . "'>" . $trstop[2] . " (" . $trstop[1] . ")</option>\n";
                }
                ?>
                </select>
            </div>
            <div id="tramStop" class="">

                <div>
                    <div class="form-row1">
                        <span class="input-before1">
                            <span class="icons icon-time"></span>
                        </span>
                        <input class="input1 short input-tramstop" name="time[]" 
                               type="text" pattern="[0-9]{1,2}:[0-9]{1,2}" disabled required>
                        <span class="icons iconp icon-plus-sign"></span>
                    </div>
                </div>
                <?php
                    for($i=1;$i<count($this->tramstopsInLine)-1; $i++) {
                        $id = $this->tramstopsInLine[$i][0];
                        echo "<div>
                            <div class='form-row1'>
                                <span class='input-before'>Przystankek
                                <span class='icons iconm icon-minus-sign'></span></span>
                                <select name='tramstop[]' class='input'>";
                            foreach ($this->tramstops as $trstop) {
                                echo "<option value='" . $trstop[0] . ($trstop[0] == $id?"' selected='selected":"")
                                         . "'>" . $trstop[2] . " (" . $trstop[1] . ")</option>\n";
                            }
                        echo "</select>
                            </div>
                            <div class='form-row1'>
                                <span class='input-before1'>
                                    <span class='icons icon-time'></span>
                                </span>
                                <input class='input1 short input-tramstop' name='time[]'  
                                       type='text' disabled  pattern='[0-9]{1,2}:[0-9]{1,2}' required>
                                <span class='icons iconp icon-plus-sign'></span>

                            </div>
                        </div>";
                    }
                
                ?>

            </div>  

            <div class="form-row1">
                <span class="input-before">Pętla koniec</span>
                <select name="tramstopStop" class="input">
                <?php
                foreach ($this->tramstops as $trstop) {
                    echo "<option value='" . $trstop[0] . ($trstop[0] == $idStop?"' selected='selected":"")
                             . "'>" . $trstop[2] . " (" . $trstop[1] . ")</option>\n";
                }
                ?>
                </select>
            </div>
        </div>
    </form>
    <div id="example">
        <div class="form-row1">
            <span class="input-before">Przystankek
            <span class="icons iconm icon-minus-sign"></span></span>
            <select name="tramstop[]" class="input">
                <?php
                foreach ($this->tramstops as $trstop) {
                    echo '<option value="' . $trstop[0] . '">' . $trstop[2] . ' (' . $trstop[1] . ')</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-row1">
            <span class="input-before1">
                <span class="icons icon-time"></span>
            </span>
            <input class="input1 short input-tramstop" name="time[]"  
                   type="text" disabled  pattern="[0-9]{1,2}:[0-9]{1,2}" required>
            <span class="icons iconp icon-plus-sign"></span>

        </div>
    </div>
    <script> setTime(); </script>
</div>