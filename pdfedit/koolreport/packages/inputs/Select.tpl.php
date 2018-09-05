<select name="<?php echo $this->name; ?>" <?php
foreach($this->attributes as $name=>$value)
{
    echo "$name='$value'";
}
?> >
<?php
foreach($this->data as $value=>$text)
{
?>
    <option value="<?php echo $value; ?>" <?php echo ((string)$this->value==(string)$value)?"selected":""; ?>><?php echo $text; ?></option>
<?php
}
?>
</select>