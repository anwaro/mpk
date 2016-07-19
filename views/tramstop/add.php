<?php 
    if(count($this->status[1])>0){
        echo '<h2>'.$this->status[1].'</h2>';
    }
?>

<div class="form-search">
    <form  action="{%url%}tramstop/add" name="add-tramstop" method="post">
        <div class="form-row">
            <span class="input-before">Numer:</span>
            <input autocomplete="off" id="from-station" class="input-sample" name="numer"  type="text">
            </ul>
        </div>
        <div class="form-row">
            <span class="input-before">Nazwa:</span>
            <input autocomplete="off" id="from-station" class="input-sample" name="nazwa"  type="text">
            </ul>
        </div>
        <div class="form-row">
            <span class="input-before">Współ. x:</span>
            <input autocomplete="off" id="from-station" class="input-sample" name="x"  type="text">
            </ul>
        </div>
        <div class="form-row">
            <span class="input-before">Współ. y:</span>
            <input autocomplete="off" id="from-station" class="input-sample" name="y"  type="text">
            </ul>
        </div>       
        <div class="form-row">
            <input type="submit" name='addtramstop' class="button" value="DODAJ PRZYSTANEK">
        </div>

    </form>
    
</div>