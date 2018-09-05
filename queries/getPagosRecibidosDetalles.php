<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas

	$rules = array ();
	$rules["idPagoRecibido"] = ["t"=>'num', "r"=>true];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(select_query($con, "SELECT pa.fecha, pa.cantidad as cantidadAplicadaDetalleCosto, rp.folio
		 FROM pagos_aplicados as pa LEFT JOIN pagos_recibidos as pr ON pr.idPagoRecibido = pa.idPagoRecibido
		  LEFT JOIN recibo_pago as rp ON rp.idReciboPago = pa.idReciboPago WHERE pa.idPagoRecibido = ?", 'i', $_POST));

?>
