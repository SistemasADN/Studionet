<?php
foreach($this->data as $value=>$text)
{
?>
    <div class="<?php echo $this->display=="vertical"?"radio":"radio-inline"; ?>">
        <label>
            <input type="radio" name="<?php echo $this->name; ?>" value="<?php echo $value ?>" <?php echo($this->value==$value)?"checked":""; ?>>
            <?php echo $text; ?>
        </label>
    </div>
<?php
}
?>