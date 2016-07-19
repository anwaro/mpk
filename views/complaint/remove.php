
<div class="form-search">
    
<?php 

    if(strlen($this->status[1])>0){
        echo '<h2>'.$this->status[1].'</h2><br>';
    }
    
    echo '<span class="titlecolor">'. $this->status[3][2]. ' '. $this->status[3][3]
            .' </span><h2>( '. $this->status[3][1] .')<h2>' ;
    echo '<span> Treść skargi: ' . $this->status[2][2] . '</span>';
?>
    <hr>
    <br>
    <form   name="usun-line" method="post">     
        <div class="form-row">
            <input type="submit" name='removecomplaint' class="button"
                   value="USUN SKARGĘ">
        </div>

    </form>
    
</div>