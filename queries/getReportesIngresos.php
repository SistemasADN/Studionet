<?php

	include "../validation/classValidator.php";
	$validator = new Validator();

	//Reglas
	$rules = array ();
	$rules['fechaInicial'] = 		["t"=>"date", "r"=>true];
	$rules['fechaFinal'] = 			["t"=>"date", "r"=>true];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo( select_query($con, "
      SELECT
				fecha,
				idPagoRecibido,
				nombre as concepto,
				formaPago,
				cantidad as cantidadCosto
					FROM
      	veringreso
				WHERE DATE(fecha) BETWEEN ? AND ?
			", 'ss', $_POST)
		);
?>
