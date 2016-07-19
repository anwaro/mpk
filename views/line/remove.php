
<div class="form-search">
    
<?php 

    if(count($this->status[1])>0){
        echo '<h2>'.$this->status[1].'</h2><br>';
    }
    
    echo '<span class="titlecolor">'. $this->status[2][1] .' </span><h2>( '. $this->status[2][2] 
            .' ---> '.$this->status[2][3].')<h2>' ;
?>
    <hr>
    <br>
    <form   name="usun-line" method="post">     
        <div class="form-row">
            <input type="submit" name='removeline' class="button"
                   value="USUN LINIĘ">
        </div>

    </form>
    
</div>