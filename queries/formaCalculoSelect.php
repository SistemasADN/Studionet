<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(format_respuesta_select(select_query($con,
			"SELECT
              idCalculoPagos as id,
              formaCalculo as value
            FROM forma_calculos where idCalculoPagos=1")));
?>
