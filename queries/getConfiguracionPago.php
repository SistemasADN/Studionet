<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
  $rules = array();
	//Reglas
  $validator->setRulesValidateArrayEcho($rules, $_POST);
?>
