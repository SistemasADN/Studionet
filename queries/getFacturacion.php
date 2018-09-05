<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
  $rules['idCliente'] = ['r'=>true, 't'=>'coin'];
  $rules['fechaInicial'] = ['r'=>true, 't'=>'date'];
	$rules['fechaFinal'] = ['r'=>true, 't'=>'date'];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
  if($_POST['idCliente']==-1){
		$respuesta = select_query(
			$con,
			"SELECT rp.fecha, rp.folio, p.nombre as cliente, tr.totalRecibo as total
			 FROM recibo_pago as rp
			 LEFT JOIN clientes as c ON c.idCliente = rp.idCliente
			 LEFT JOIN personacompleta as p ON p.idPersona = c.idPersona
			 LEFT JOIN totalrecibopago as tr ON tr.idReciboPago = rp.idReciboPago
			 WHERE rp.fecha BETWEEN ? AND ?", 'ss', [$_POST['fechaInicial'], $_POST['fechaFinal']]
		 );
  }else{
    $respuesta = select_query($con,"SELECT rp.fecha, rp.folio, p.nombre as cliente, tr.totalRecibo as total
			 FROM recibo_pago as rp
			 LEFT JOIN clientes as c ON c.idCliente = rp.idCliente
			 LEFT JOIN personacompleta as p ON p.idPersona = c.idPersona
			 LEFT JOIN totalrecibopago as tr ON tr.idReciboPago = rp.idReciboPago
			 WHERE c.idCliente = ? AND rp.fecha BETWEEN ? AND ?", 'iss',$_POST);
  }
	json_echo($respuesta);
?>
