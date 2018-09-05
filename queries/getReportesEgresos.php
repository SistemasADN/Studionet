<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	
	//Reglas
	$rules = array ();
	$rules['fechaInicial'] = 		["t"=>"date", "r"=>true];
	$rules['fechaFinal'] = 			["t"=>"date", "r"=>true];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	$respuesta['personal'] = select_query($con, "
      SELECT
				DATE_FORMAT(ep.fecha,'%Y-%m-%d') as fecha,
				ep.idEgresoPersonal as idEgreso,
				CONCAT(vp.nombre,' (', mo.modalidad,')') as concepto,
				fp.formaPago,
				ep.cantidad as cantidadCosto

					FROM
      egresos_personal as ep
			LEFT JOIN forma_pago as fp ON fp.idFormaPago = ep.idFormaPago
			LEFT JOIN personal as pl ON pl.idPersonal = ep.idPersonal
      LEFT JOIN personas as pe ON pe.idPersona = pl.idPersona
			LEFT JOIN personacompleta as vp ON vp.idPersona = pl.idPersona
			LEFT JOIN modalidad_pago as mo ON mo.idModalidadPago = ep.idModalidadPago
				WHERE DATE(ep.fecha) BETWEEN ? AND ?
			", 'ss', $_POST);
		$respuesta['egreso'] = select_query($con, "
		      SELECT
						DATE_FORMAT(ep.fecha,'%Y-%m-%d') as fecha,
						ep.idEgreso,
						ep.concepto,
						fp.formaPago,
						ep.cantidad as cantidadCosto

			FROM
		      egresos as ep
					LEFT JOIN forma_pago as fp ON fp.idFormaPago = ep.idFormaPago
					WHERE DATE(ep.fecha) BETWEEN ? AND ?
			", 'ss', $_POST);

			json_echo(array_merge($respuesta["egreso"], $respuesta["personal"]));
?>
