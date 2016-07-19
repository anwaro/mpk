
<div class="form-search">
    
<?php 
    if(count($this->status[1])>0){
        echo '<h2>'.$this->status[1].'</h2>';
    }
    echo '<br> <h2>';
    echo $this->status[2][2] .' '. $this->status[2][3] ;
?>

    </h2>
    <br>
    <form   name="remove-driver" method="post">     
        <div class="form-row">
            <input type="submit" name='removedriver' class="button"
                   value="USUN KIEROWCE Z BAZY DANYCH">
        </div>

    </form>
    
    <br>
    <a href="{%url%}driver/replace/<?php echo  $this->status[2][0] ; ?>"><span class="icon iconcolor icon-repeat"> ZNAJDŹ ZASTĘPSTWO</span></a>
    
</div>