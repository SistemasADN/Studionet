<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$validator->setRulesValidateArrayEcho(array(), $_POST);
	include "dbcon.php";
/*	json_echo(format_respuesta_select(select_query($con,
	'SELECT c.idCuenta as id, c.nombre as value, FROM cuentas as c
	 LEFT JOIN totalescuentas as tc ON tc.idCuenta = c.idCuenta
	')));
	*/
	json_echo(format_respuesta_select(select_query($con,
		'SELECT tc.idCuenta as id, c.nombre as value, (tc.montoInicial+tc.totalRecibido+tc.totalIngresos-tc.totalEgresos) as saldo
		 FROM totalescuentas as tc LEFT JOIN cuentas as c ON c.idCuenta = tc.idCuenta ORDER BY c.nombre ASC
		')));
?>
