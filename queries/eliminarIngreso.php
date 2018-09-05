<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	//vde();
	$rules["idPagoRecibido"] =		 		['r' => true,  't' => "num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);

	include "dbcon.php";
	if(execute_query($con, "UPDATE pagos_recibidos SET aprobado = -1 WHERE idPagoRecibido = ?", 'i', $_POST)){
		echo "s|Baja ingreso|Ingreso cancelado correctamente. ";
	}else{
		echo "e|Baja ingreso|No se pudo cancelar el ingreso. ";
	}
?>
