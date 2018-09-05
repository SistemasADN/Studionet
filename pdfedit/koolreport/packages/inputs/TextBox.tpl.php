<input name="<?php echo $this->name; ?>" value="<?php echo $this->value; ?>" type="textbox" <?php
    foreach($this->attributes as $name=>$value)
    {
        echo "$name='$value' ";
    }
?> />