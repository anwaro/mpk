<?php 
    if(count($this->status[1])>0){
        echo '<h2>'.$this->status[1].'</h2>';
    }
    
    $info = $this->status[2];
?>

<div class="form-search">
    <form   name="edit-tramstop" method="post">
        <div class="form-row">
            <span class="input-before">Numer:</span>
            <input autocomplete="off" id="from-station" class="input-sample" 
                   name="numer"  type="text" value="<?php echo $info[1]; ?>">
            </ul>
        </div>
        <div class="form-row">
            <span class="input-before">Nazwa:</span>
            <input autocomplete="off" id="from-station" class="input-sample"
                   name="nazwa"  type="text" value="<?php echo trim ($info[2]); ?>">
            </ul>
        </div>
        <div class="form-row">
            <span class="input-before">Współ. x:</span>
            <input autocomplete="off" id="from-station" class="input-sample"
                   name="x"  type="text" value="<?php echo $info[3]; ?>">
            </ul>
        </div>
        <div class="form-row">
            <span class="input-before">Współ. y:</span>
            <input autocomplete="off" id="from-station" class="input-sample"
                   name="y"  type="text" value="<?php echo $info[4]; ?>">
            </ul>
        </div>       
        <div class="form-row">
            <input type="submit" name='edittramstop' class="button"
                   value="EDYTUJ PRZYSTANEK">
        </div>

    </form>
    
</div>