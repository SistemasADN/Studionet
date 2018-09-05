<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules['idReciboPago'] = 				        ['r' => true , 	't' => "num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	
	$idCliente = select_query($con, "SELECT idCliente FROM recibo_pago WHERE idReciboPago = ?", 'i', $_POST);
	$idCliente = $idCliente[0]['idCliente'];
	var_dump($idCliente);
	
	
	//echo "e|Aprobar recibo|No se pudo aprobar el recibo de cobro.";
?>