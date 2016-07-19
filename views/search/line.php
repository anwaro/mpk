
<div class="form-search">
    <form  action="{%url%}result/line" name="search_connection" method="post">
        <div class="form-row">
            <span class="input-before">Linia</span>
            <select name="line-number" class="input">
            <?php 
                foreach ($this->allLine as $line) {
                    echo '<option value="'.$line[0].'">'.$line[1].' '.$line[2].' -- > '.$line[3].'</option>';
                }

            ?>
                
            </select>
        </div>
        
        <div class="form-row">
            <input type="submit" name="tramline" class="button" value="POKAZ LINIE">
        </div>

    </form>
    
</div>