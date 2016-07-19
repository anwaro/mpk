<?php 
    if(count($this->status[1])>0){
        echo '<h2>'.$this->status[1].'</h2><br>';
    }
    
    
    $info = $this->status[2];
?>
<br>
<div class="form-search">
    <form   name="edit-tramstop" method="post">
        <div class="form-row">
            <span class="input-before">Numer:</span>
            <input autocomplete="off" id="from-station" class="input-sample" 
                   name="numer"  type="text" value="<?php echo $info[1]; ?>">
            </ul>
        </div>
        <div class="form-row">
            <span class="input-before">Imię:</span>
            <input autocomplete="off" id="from-station" class="input-sample"
                   name="name"  type="text" value="<?php echo $info[2]; ?>">
            </ul>
        </div>
        <div class="form-row">
            <span class="input-before">Nazwisko:</span>
            <input autocomplete="off" id="from-station" class="input-sample"
                   name="surname"  type="text" value="<?php echo $info[3]; ?>">
            </ul>
        </div>
        <div class="form-row">
            <span class="input-before">Rok zatr.:</span>
            <input autocomplete="off" id="from-station" class="input-sample"
                   name="year"  type="text" value="<?php echo $info[4]; ?>">
            </ul>
        </div>       
        <div class="form-row">
            <input type="submit" name='edittramstop' class="button"
                   value="EDYTUJ DANE KIEROWCY">
        </div>

    </form>
    
</div>