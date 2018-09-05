<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array ();
	$rulesL = array ();
	//getDebuggingInfo();
	$listaRecibo = $_POST['listaRecibo'];
	//deleteDebuggingInfo();
	unset($_POST['listaRecibo']);

  $rules['idReciboPago'] = 				["r"=>false, "t"=>"num"];
	$rules['descuentoRecibo'] = 		["r"=>false, "t"=>"num"];

	$rulesL['idAlumno'] = 					["r"=>false, "t"=>"num"];
	$rulesL['idConcepto'] = 				["r"=>false, "t"=>"alphnum"];
	$rulesL['cantidad'] = 					["r"=>true, "t"=>"num"];
	$rulesL['idReciboPagoLista'] = 	["r"=>false, "t"=>"num"];
	$rulesL['descuentoLista'] = 		["r"=>false, "t"=>"coin"];
	$rulesL['fecha'] = 							["r"=>true, "t"=>"date"];

	$validator->setRulesValidateArrayEcho($rules, $_POST);
	$validator->enableEchos();
	foreach($listaRecibo as $k=>$item){
		if(!isset($item['descuentoLista'])){
			$item['descuentoLista'] = 0;
		}
		$validator->setRulesValidateArrayEcho($rulesL, $item);
	}

	$_POST['descuentoRecibo'] = $_POST['descuentoRecibo']==""?0:$_POST['descuentoRecibo'];

  include_once "dbcon.php";
	include_once "getIdSede.php";
  $folio = select_query_one($con,
                  "SELECT
                    nf.folio
                  FROM nextfolio as nf LEFT JOIN recibo_pago as rp ON rp.idSede = nf.idSede WHERE idReciboPago = ?", 'i', [$_POST['idReciboPago']]);
    $_POST['folio'] = $folio['folio'];
    //Sacamos los items actuales del recibo
		$listaIds = select_query($con, "SELECT idReciboPagoLista FROM recibo_pago_lista WHERE idReciboPago = ?", 'i', [$_POST['idReciboPago']]);
		//Si un item actual no está en la nueva lista se borra
		foreach($listaIds as $id){
			$borrar = true;
			foreach($listaRecibo as $item){
				if($item['idReciboPagoLista']==$id['idReciboPagoLista']){
					$borrar = false;
				}
			}
			if($borrar){
				if(!execute_query($con, "DELETE FROM  recibo_pago_lista WHERE idReciboPagoLista = ?", 'i', [$id['idReciboPagoLista']], false)){
						echo "e|Aprobar Recibo|Ha habido un error al actualizar los descuentos del recibo.";exit;
				}
			}
		}
		//Con la nueva lista insertamos si no existe o hacemos update de los descuentos si sí
		foreach($listaRecibo as $k=>$item){
				//var_dump($item);
				if(!isset($item['descuentoLista'])){
						$item['descuentoLista'] = 0;
				}
				if($item['idReciboPagoLista']==""){
					if(!execute_query($con, "INSERT INTO recibo_pago_lista (fecha, idConcepto, idAlumno, cantidad, idReciboPago, precioActual, descuento)
						VALUES (?,?,?,?,?,(SELECT precioUnitario FROM conceptos WHERE idConcepto = ?),?)", 'siiiidi', [$item['fecha'], $item['idConcepto'], $item['idAlumno'], $item['cantidad'], $_POST['idReciboPago'], $item['idConcepto'], $item['descuentoLista']])){
							echo "e|Aprobar Recibo|Ha habido un error al crear nuevos registros del recibo.";exit;
					}
				}else{
					if(!isset($item['descuentoLista'])){
						continue;
					}
					if(!execute_query($con, "UPDATE recibo_pago_lista SET descuento = ? WHERE idReciboPagoLista = ?", 'ii', [$item['descuentoLista'], $item['idReciboPagoLista']], false)){
							echo "e|Aprobar Recibo|Ha habido un error al cambiar los descuentos del recibo.";exit;
					}
				}
		}

	if(!execute_query($con, "UPDATE recibo_pago SET folio = ?, descuento = ? WHERE idReciboPago = ?",
	 'iii', [$_POST['folio'], $_POST['descuentoRecibo'], $_POST['idReciboPago']], false)){
		 		echo "e|Aprobar Recibo|Ha habido un error al actualizar el folio.".mysqli_error($con); exit;
	 }
    	$totalDatosRP = select_query_one($con, "
						SELECT
							IFNULL(SUM(rpl.precioActual*rpl.cantidad * (1-rpl.descuento/100)),0) AS totalRP
						FROM recibo_pago_lista AS rpl
						  LEFT JOIN recibo_pago AS rp
                            ON rp.idReciboPago = rpl.idReciboPago
						WHERE rp.idReciboPago = ?", 'i', [$_POST['idReciboPago']]);
		//2. Saca el total de cc y descuento
		$totalRP = $totalDatosRP['totalRP']*(1-($_POST['descuentoRecibo']/100));

   //3. Sacar id de cliente
		$idCliente = select_query_one($con, "
                        SELECT
                          idCliente
                        FROM recibo_pago
                        WHERE idReciboPago = ?", 'i', [$_POST['idReciboPago']]);
    $idCliente = $idCliente['idCliente'];
		//4. Sacar lista de pagos recibidos
		$listaPagosRecibidos = select_query($con, "
                          SELECT
                            r.idPagoRecibido,
                            r.cantidad,
                            IFNULL(SUM(a.cantidad),0) as cantidadAplicada
                          FROM pagos_recibidos as r
						    LEFT JOIN pagos_aplicados as a
                              ON a.idPagoRecibido = r.idPagoRecibido
                          WHERE r.idCliente = ? AND r.aprobado = 1 GROUP BY (r.idPagoRecibido)", 'i', [$idCliente]);
		$pagosRecibidos = array();
		//5. Filtrar lista con pagos pendientes
		foreach($listaPagosRecibidos as $pagoRecibido){
			$pagoRecibido['cantidad'] -= $pagoRecibido['cantidadAplicada'];
			if($pagoRecibido['cantidad']>0){
				$pagosRecibidos[$pagoRecibido['idPagoRecibido']] = $pagoRecibido['cantidad'];
			}
		}

    $fecha = date('Y-m-d');
    foreach($pagosRecibidos as $idPagoRecibido => $disponible){
			if($disponible<$totalRP){
        $cantidadAplicar = $disponible;
        $totalRP -= $cantidadAplicar;
      }else{
        $cantidadAplicar = $totalRP;
        $totalRP = 0;
      }

			if(!execute_query($con, "INSERT INTO pagos_aplicados (idPagoRecibido, idReciboPago, fecha, cantidad) VALUES (?,?,?,?)",
			'iisd', [$idPagoRecibido, $_POST['idReciboPago'], $fecha, $cantidadAplicar], false)){
				echo "e|Aprobar Recibo|Ha habido un error al crear nuevos registros de los pagos."; exit;
			}
    }
		echo "s|Aprobrar Recibo|Recibo aprobado correctamente.";
		mysqli_commit($con);
?>
