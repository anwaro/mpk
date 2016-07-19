<?php 
    if(count($this->status[1])>0){
        echo '<h2>'.$this->status[1].'</h2>';
    }
?>
<br>
<div class="form-search">
    <form  action="{%url%}driver/add" name="add-driver" method="post">
        <div class="form-row">
            <span class="input-before">Numer:</span>
            <input autocomplete="off" id="from-station" class="input-sample" name="numer"  type="text">
            </ul>
        </div>
        <div class="form-row">
            <span class="input-before">Imię:</span>
            <input autocomplete="off" id="from-station" class="input-sample" name="name"  type="text">
            </ul>
        </div>
        <div class="form-row">
            <span class="input-before">Nazwisko:</span>
            <input autocomplete="off" id="from-station" class="input-sample" name="surname"  type="text">
            </ul>
        </div>
        <div class="form-row">
            <span class="input-before">Rok zatrud.:</span>
            <input autocomplete="off" id="from-station" class="input-sample" name="year"  type="text">
            </ul>
        </div>       
        <div class="form-row">
            <input type="submit" name='adddriver' class="button" value="DODAJ KIEROWCĘ DO BAZY">
        </div>

    </form>
    
</div>