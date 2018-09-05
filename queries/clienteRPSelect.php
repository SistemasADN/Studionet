<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(format_respuesta_select(select_query($con,
  "SELECT c.idCliente as id , p.nombre as value
	 FROM clientes as c
	 LEFT JOIN recibo_pago AS rp ON rp.idCliente = c.idCliente
     LEFT JOIN personacompleta AS p ON p.idPersona = c.idPersona
     GROUP BY c.idCliente ORDER BY p.nombre ASC")));
?>
