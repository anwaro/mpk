
<div class="form-search">
    <form  action="{%url%}result/tramstop" name="search_connection" method="post">
        <div class="form-row">
            <span class="input-before">Z:</span>
            <input class='l_id' type="hidden" value='' name="tramstopstartID">
            <input autocomplete="off" id="from-station" class="input input-tramstop" name="tramstopstart"  type="text">
            <ul class="prompt" id="podpowiedz-z">
            </ul>
        </div>
        
        
        <div class="form-row">
            <input type="submit" name='tramstop' class="button" value="POKAŻ ROZKŁAD">
        </div>

    </form>
    
</div>