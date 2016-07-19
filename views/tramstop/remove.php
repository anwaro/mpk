
<div class="form-search">
    
<?php 
    if(count($this->status[1])>0){
        echo '<h2>'.$this->status[1].'</h2><br>';
    }
    
    echo '<span class="titlecolor">'. $this->status[2][2] .' ( '. $this->status[2][1] .')</span>' ;
?>
    <hr>
    <br>
    <form   name="usun-tramstop" method="post">     
        <div class="form-row">
            <input type="submit" name='removetramstop' class="button"
                   value="USUN PRZYSTANEK">
        </div>

    </form>
    
</div>