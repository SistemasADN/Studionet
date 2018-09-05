<?php include 'templates/top.php'; ?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 maintitle-container">
  <div class="mainlogo-container">
    <i class="fa fa-calendar"></i>
  </div>
  <div class="maintext-container">
    AGENDA
  </div>
</div>
<?php
//include "actionbar/functions.php";
if($text!=""){
  echo '$listaUrls = ['.rtrim($text,',').'];';
  //echo "<br>".substr_count($text, ",");
 }
?>
<?php include 'templates/bottom.php'; ?>

<script>
$(document).ready(function(){

});
</script>
