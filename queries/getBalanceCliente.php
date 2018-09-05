<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
  $rules['idCliente'] = ['t'=>'num', 'r'=>true];
	$validator->setRulesValidateArrayEcho($rules, $_POST);

	include "dbcon.php";
	$temp = select_query($con,
						"SELECT IFNULL(SUM(tr.totalRecibo),0) as totalPorPagar, IFNULL(pr.totalPagado, 0) as totalPagado
						FROM recibo_pago as rp
						LEFT JOIN totalrecibopago as tr ON tr.idReciboPago = rp.idReciboPago
						LEFT JOIN (SELECT pr.idCliente, SUM(pr.cantidad) as totalPagado FROM pagos_recibidos as pr WHERE pr.aprobado = 1
             GROUP BY (pr.idCliente)) as pr
						 ON pr.idCliente = rp.idCliente
						  WHERE rp.idCliente = ? AND rp.folio IS NOT NULL", 'i', $_POST);
	$totalPorPagar = $temp[0]['totalPorPagar'];
	$totalPagado = $temp[0]['totalPagado'];
	$balance = $totalPorPagar-$totalPagado;
	json_echo($balance);
?>
