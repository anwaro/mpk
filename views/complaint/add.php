
<?php 
    if(count($this->status[1])>0){
        echo '<h2>'.$this->status[1].'</h2>';
    }
?>

<div class="column9">
    <form  action="{%url%}complaint/add" name="search_connection" method="post" >
        <div class="form-search" style="float:left;">
             <div class="form-row">
                <span class="input-before">Linia</span>
                <select name="lineId" class="input">
                <?php 
                    foreach ($this->allLine as $line) {
                        echo '<option value="'.$line[0].'">'.$line[1].' '.$line[2].' -- > '.$line[3].'</option>';
                    }

                ?>

                </select>
            </div>
            <div class="form-row">
                <span class="input-before">Przystanek:</span>
                <input class='l_id' type="hidden" value='' name="tramstopstartID">
                <input autocomplete="off" id="from-station" class="input input-tramstop" name="tramstopstart"  type="text">
                <ul class="prompt" id="podpowiedz-z">
                </ul>
            </div>

            <div class="form-row">
                <span class="input-before long">Godzina:</span>
                <input autocomplete="off" id="time_start" name="timeStart" value='19:12' type="text" class="input short"
                                   onclick="this.value = '';"
                                   onkeypress="writeTime(event, this); return false;">
            </div>

        </div>
        <div class="form-search" style="float:left;" >
            <div class="form-row">
                <textarea class="text-compl" name="complaint" ></textarea>
            </div>

            <div class="form-row">
                <input type="submit" name='addcomplaint' class="button" value="DODAJ SKARGĘ" style="display:none">
                <span id="captcha"></span>
            </div>
        </div>
    </form>
</div>