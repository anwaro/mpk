
<?php 
    if(count($this->status[1])>0){
        echo '<h2>'.$this->status[1].'</h2><hr>';
    }
?>

    <h2>Zaloguj</h2>
    <form method='POST' action='{%url%}admin/login'>
        
        <div class="form-row slim">
            <span class="input-before">Login:</span>
            
            <input autocomplete="off" id="from-station" class="input" name='username'  type="text">
            </ul>
        </div>
        
        <div class="form-row slim">
            <span class="input-before">Login:</span>
            
            <input autocomplete="off" id="from-station" class="input" name='userpass'  type='password'>
            </ul>
        </div>
        
        
        <div class="form-row slim">
            <input type="submit" class="button" name="login" value="Zaloguj">
        </div>
    </form>
