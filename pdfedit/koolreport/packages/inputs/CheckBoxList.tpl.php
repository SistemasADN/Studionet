<?php
foreach($this->data as $value=>$text)
{
?>
    <div class="<?php echo $this->display=="horizontal"?"checkbox-inline":"checkbox"; ?>">
        <label>
            <input type="checkbox" name="<?php echo $this->name."[]"; ?>" value="<?php echo $value ?>" <?php echo(in_array($value,$this->value))?"checked":""; ?>>
            <?php echo $text; ?>
        </label>
    </div>
<?php
}
?>