
<div class="form-search">
    <form  action="{%url%}result/connection" name="search_connection" method="post">
        <div class="form-row">
            <span class="input-before">Z:</span>
            <input class='l_id' type="hidden" value='' name="tramstopstartID">
            <input autocomplete="off" id="from-station" class="input input-tramstop" name="tramstopstart"  type="text">
            <ul class="prompt" id="podpowiedz-z">
            </ul>
        </div>
        
        <div class="form-row">
            <span class="input-before">Do:</span>
            <input class='l_id' type="hidden"  value='' name="tramstopstopID">
            <input autocomplete="off" id="from-station" class="input input-tramstop" name="tramstopstop"  type="text">
            <ul class="prompt" id="podpowiedz-z">
            </ul>
        </div>
        
        <div class="form-row">
            <span class="input-before long">Godzina:</span>
            <input autocomplete="off" id="time_start" name="timeStart" value='19:12' type="text" class="input short"
                               onclick="this.value = '';"
                               onkeypress="writeTime(event, this); return false;">
        </div>
        
        <div class="form-row">
            <input type="submit" class="button" name="connectionsearch" value="SZUKAJ">
        </div>

    </form>
    
</div>

