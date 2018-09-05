<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array ();
  $validator->setRulesValidateArrayEcho($rules, $_POST);
	include_once "dbcon.php";
  include_once "getIdSede.php";

			$respuesta['Ingresos'] = select_query($con,
			"SELECT i.idIngresos, 'Ingreso' as tipo, i.cantidad, i.concepto, f.formaPago as formaPago, c.nombre as cuenta, i.fecha, it.nombre as movimiento,
                i.beneficiario, CONCAT(b.nombre, ' (Origen)') as beneficiarioCuenta, i.referencia, i.comentario FROM ingresos as i
                LEFT JOIN forma_pago as f ON f.idFormaPago = i.idFormaPago
                LEFT JOIN cuentas as c ON c.idCuenta = i.idCuenta
                LEFT JOIN ingresos_tipo as it ON it.idTipoIngreso = i.idTipoIngreso
                LEFT JOIN cuentas as b ON b.idCuenta = i.beneficiario
                WHERE i.aprobar = 0 AND i.idSede = ?",'i',[$idSede]);
      $respuesta['Egresos'] = select_query($con,
			"SELECT i.idEgreso, 'Egreso' as tipo, i.cantidad, i.concepto, f.formaPago as formaPago, c.nombre as cuenta, i.fecha, it.nombre as movimiento,
                i.beneficiario, CONCAT(b.nombre, ' (Destino)') beneficiarioCuenta, i.referencia, i.comentario, pc.nombreProfesor FROM egresos as i
                LEFT JOIN forma_pago as f ON f.idFormaPago = i.idFormaPago
                LEFT JOIN cuentas as c ON c.idCuenta = i.idCuenta
                LEFT JOIN egresos_tipo as it ON it.idTipoEgreso = i.idTipoEgreso
                LEFT JOIN cuentas as b ON b.idCuenta = i.beneficiario
								LEFT JOIN egresos_personal as ep ON ep.idEgreso = i.idEgreso
								LEFT JOIN profesorcompleto as pc ON pc.idPersonal = ep.idPersonal
                WHERE i.aprobar = 0 AND i.idSede = ?",'i',[$idSede]);
       json_echo($respuesta);
?>
