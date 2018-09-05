<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array ();
//	$_POST['fechaInicial'] = '2017-08-01';$_POST['fechaFinal'] = '2018-03-31';

	$rules["fechaInicial"] = 		['r' => true , 	't' => "date"];
	$rules["fechaFinal"] = 			['r' => true , 	't' => "date"];
  $validator->setRulesValidateArrayEcho($rules, $_POST);
	include_once "dbcon.php";
			$respuesta['Ingresos'] = select_query($con,
			"SELECT i.idIngresos, 'Ingreso' as tipo, i.cantidad as cantidadCosto, i.concepto, f.formaPago,
				c.nombre as cuenta, i.fecha, it.nombre as tipoTipo,
        i.beneficiario, CONCAT(b.nombre, ' (Origen)') as beneficiarioCuenta, i.referencia, i.comentario,
				s.nombreSede as sede, i.aprobar
				FROM ingresos as i
                LEFT JOIN forma_pago as f ON f.idFormaPago = i.idFormaPago
								LEFT JOIN sedes as s ON s.idSede = i.idSede
                LEFT JOIN cuentas as c ON c.idCuenta = i.idCuenta
                LEFT JOIN ingresos_tipo as it ON it.idTipoIngreso = i.idTipoIngreso
                LEFT JOIN cuentas as b ON b.idCuenta = i.beneficiario
                WHERE i.fecha BETWEEN ? AND ?",
							'ss', $_POST);

    $egresos = select_query($con,
				"SELECT i.idEgreso, 'Egreso' as tipo, i.cantidad as cantidadCosto, i.concepto, f.formaPago, c.nombre as cuenta,
				i.fecha, it.nombre as tipoTipo, i.beneficiario, CONCAT(b.nombre, ' (Destino)') beneficiarioCuenta,
				i.referencia, i.comentario, s.nombreSede as sede, i.aprobar
				FROM egresos as i
	                LEFT JOIN forma_pago as f ON f.idFormaPago = i.idFormaPago
									LEFT JOIN sedes as s ON s.idSede = i.idSede
	                LEFT JOIN cuentas as c ON c.idCuenta = i.idCuenta
	                LEFT JOIN egresos_tipo as it ON it.idTipoEgreso = i.idTipoEgreso
	                LEFT JOIN cuentas as b ON b.idCuenta = i.beneficiario
									LEFT JOIN egresos_personal as ep ON ep.idEgreso = i.idEgreso
	                WHERE ep.idEgreso IS NULL AND i.fecha BETWEEN ? AND ?",
								'ss', $_POST);

			$egresosSueldo = select_query($con,
					"SELECT i.idEgreso, 'Egreso' as tipo, i.cantidad as cantidadCosto, i.concepto, f.formaPago, c.nombre as cuenta,
					i.fecha, it.nombre as tipoTipo, pc.nombre as beneficiario, CONCAT(b.nombre, ' (Destino)') beneficiarioCuenta,
					i.referencia, i.comentario, s.nombreSede as sede, i.aprobar
					FROM egresos as i
		                LEFT JOIN forma_pago as f ON f.idFormaPago = i.idFormaPago
										LEFT JOIN sedes as s ON s.idSede = i.idSede
		                LEFT JOIN cuentas as c ON c.idCuenta = i.idCuenta
		                LEFT JOIN egresos_tipo as it ON it.idTipoEgreso = i.idTipoEgreso
		                LEFT JOIN cuentas as b ON b.idCuenta = i.beneficiario
										LEFT JOIN egresos_personal as ep ON ep.idEgreso = i.idEgreso
										LEFT JOIN personal as p ON p.idPersonal = ep.idPersonal
										LEFT JOIN personacompleta as pc ON pc.idPersona = p.idPersona
		                WHERE ep.idEgreso IS NOT NULL AND i.fecha BETWEEN ? AND ?",
									'ss', $_POST);

			$respuesta['Egresos'] = array_merge($egresos, $egresosSueldo);

      $respuesta['Cliente'] = select_query($con,
      "SELECT i.idPagoRecibido, 'Ingreso' as tipo, i.cantidad as cantidadCosto, i.concepto,
			 f.formaPago, c.nombre as cuenta, i.fecha, 'Cobro cliente' as tipoTipo, s.nombreSede as sede,
			 pc.nombre as beneficiario, i.referencia, i.comentario, i.aprobado as aprobar
			 FROM pagos_recibidos as i
              LEFT JOIN forma_pago as f ON f.idFormaPago = i.idFormaPago
						  LEFT JOIN sedes as s ON s.idSede = i.idSede
              LEFT JOIN cuentas as c ON c.idCuenta = i.idCuenta
              LEFT JOIN clientes AS cl ON cl.idCliente = i.idCliente
							LEFT JOIN personacompleta as pc ON cl.idPersona = pc.idPersona
              WHERE i.fecha BETWEEN ? AND ?", 'ss', $_POST);

      /*
      $respuesta['Proveedor'] = select_query($con,
              "SELECT i.idInventarioCompraPago, 'Egreso' as tipo, i.cantidad as cantidadCosto, i.concepto, f.formaPago ,
                      c.nombre as cuenta, i.fecha,
                      'Pago Proveedor' as tipoTipo,
                      p.nombre as beneficiario, i.referencia, i.comentario FROM inventario_comprapagos as i
                      LEFT JOIN forma_pago as f ON f.idFormaPago = i.idTipoFormaPago
                      LEFT JOIN cuentas as c ON c.idCuenta = i.idCuenta
                      LEFT JOIN inventario_compra as ic ON ic.idInventarioCompra = i.idInventarioCompra
                      LEFT JOIN proveedor AS p ON p.idProveedor = ic.idProveedor
                      WHERE i.aprobado = 1 AND i.fecha BETWEEN ? AND ?", 'ss', $_POST);
       */
       json_echo(array_merge($respuesta['Ingresos'], $respuesta['Egresos'], $respuesta['Cliente']));
?>
