<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules['idCliente'] =                   ['r' => true ,  't' => "num"];
	$rules['fechaSelect'] = 						['r' => true , 	't' => "date"];
  $rules['descuentoTabla'] = 				   		['r' => false , 	't' => "num"];
	$rules['conFolio'] = 				   					['r' => true , 	't' => "bool"];

	$rules2 = array ();
	$rules2['cantidad'] = 				        	['r' => true , 	't' => "num"];
	$rules2['idConcepto'] = 				        ['r' => true , 	't' => "num"];
	$rules2['precioUnitario'] = 				    ['r' => true , 	't' => "coin"];
  $rules2['descuento'] = 				        	['r' => true , 	't' => "num"];
	$rules2['idAlumno'] = 				        	['r' => true , 	't' => "num"];

	$cobro = $_POST['reciboCobro'];
	unset($_POST['reciboCobro']);

	$validator->setRulesValidateArrayEcho($rules, $_POST);
	foreach($cobro as $k=>$v){
		$validator->setRulesValidateArrayEcho($rules2, $v);
	}

	include "dbcon.php";
	include "getIdSede.php";
	$_POST['idSede'] = $idSede;
    mysqli_commit($con, false);
		if($_POST['conFolio']=='true'){
			$folio = select_query($con, "SELECT folio FROM nextfolio WHERE idSede = ?", 'i', [$idSede]);
			$_POST['folio'] = $folio[0]['folio'];
			$idReciboPago = insert_id_query($con, "INSERT INTO recibo_pago (idCliente, fecha, descuento, idSede, folio) VALUES (?,?,?,?,?)", 'isdii',
			 reorder_array($_POST, ['idCliente', 'fechaSelect', 'descuentoTabla', 'idSede', 'folio']));
			 //APLICAR PAGOS

			 $totalAplicar = 0;
			 foreach($cobro as $row){
						$totalAplicar = $row['cantidad']*$row['precioUnitario']*(1-$row['descuento']/100);
				}
				if($_POST['descuentoTabla']==""){
					$_POST['descuentoTabla'] = 0;
				}
				$totalRP = $totalAplicar*(1-$_POST['descuentoTabla']/100);
			 //4. Sacar total pagos recibidos
			 $pagosRecibidos = select_query($con, "
			 SELECT r.idPagoRecibido, r.cantidad-IFNULL(SUM(a.cantidad),0) as cantidadAplicar
			 FROM pagos_recibidos as r LEFT JOIN pagos_aplicados as a ON a.idPagoRecibido = r.idPagoRecibido
			 WHERE r.idCliente = ? AND r.aprobado = 1
			 GROUP BY (r.idPagoRecibido)", 'i', [$_POST['idCliente']]);
			 $pagosRecibidosAplicar = array();
			 foreach($pagosRecibidos as $pago){
				 if($pago['cantidadAplicar']>0){
					 $pagosRecibidosAplicar[$pago['idPagoRecibido']] = $pago['cantidadAplicar'];
				 }
			 }

			$fecha = $_POST['fechaSelect'];
			foreach($pagosRecibidosAplicar as $idPagoRecibido => $disponible){
	 			$stmt = mysqli_prepare($con, "INSERT INTO pagos_aplicados (idPagoRecibido, idReciboPago, fecha, cantidad)
				 VALUES (?,?,?,?)");
	 			mysqli_stmt_bind_param($stmt, 'iisd', $idPagoRecibido, $idReciboPago, $fecha, $cantidadAplicar);

	 			if($disponible<$totalRP){
	 				$cantidadAplicar = $disponible;
	 				$totalRP -= $cantidadAplicar;
	 			}else{
	 				$cantidadAplicar = $totalRP;
	 				$totalRP = 0;
	 			}

	 			if($cantidadAplicar>0){
	 				mysqli_stmt_execute($stmt) or die ('{0}');
	 			}else{
	 				break;
	 			}
	 		}
				/**/
		}else{
			$idReciboPago = insert_id_query($con, "INSERT INTO recibo_pago (idCliente, fecha, descuento, idSede) VALUES (?,?,?,?)", 'isdi',
			 reorder_array($_POST, ['idCliente', 'fechaSelect', 'descuentoTabla', 'idSede']));
		}

    if($idReciboPago!=0){
      foreach($cobro as $row){
		$row['idReciboPago'] = $idReciboPago;
		$row['fechaSelect'] = $_POST['fechaSelect'];
        if(!insert_query($con, "INSERT INTO recibo_pago_lista (fecha, idConcepto, cantidad, idReciboPago, precioActual, descuento, idAlumno) VALUES (?,?,?,?,?,?,?)", "siiidii",
				 reorder_array_keys($row, ['fechaSelect', 'idConcepto','cantidad', 'idReciboPago','precioUnitario', 'descuento', 'idAlumno']))){
          echo "e|Generar Carta de cobro|No se pudo generar el recibo de cobro.";
		  exit;
        }
      }
      mysqli_commit($con, true);
      echo "s|Generar Carta de cobro|Carta de cobro Generada con exito.";
    }else{
      echo "e|Generar Carta de cobro|No se pudo generar el recibo de cobro. 2";
    }
?>
