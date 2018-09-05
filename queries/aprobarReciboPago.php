<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array ();
    //vde();
		if(isset($_POST['send'])){
				$dontEcho = true;
				unset($_POST['send']);
		}else{
			$dontEcho = false;
		}

  $rules['idReciboPago'] = ["r"=>true, "t"=>"num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);

    include_once "dbcon.php";
		include_once "getIdSede.php";
    $folio = select_query($con,
                  "SELECT
                    nf.folio
                  FROM nextfolio as nf LEFT JOIN recibo_pago as rp ON rp.idSede = nf.idSede WHERE idReciboPago = ?", 'i', [$_POST['idReciboPago']]);
    $folio = $folio[0];
    $_POST['folio'] = $folio['folio'];
    //vde();
    //mysqli_autocommit($con, FALSE);
	if(execute_query($con, "UPDATE recibo_pago SET folio = ? WHERE idReciboPago = ?", 'ii', reorder_array_keys($_POST, ['folio','idReciboPago']),false)){
      $row = array(
        'folio' => $folio,
		'totalAplicado' => 0
      );
      $stmt = mysqli_prepare($con, "
						SELECT
							IFNULL(SUM(rpl.precioActual*rpl.cantidad * (1-rpl.descuento/100)),0) AS totalRP,
							rp.descuento
						FROM recibo_pago_lista AS rpl
						  LEFT JOIN recibo_pago AS rp
                            ON rp.idReciboPago = rpl.idReciboPago
						WHERE rp.idReciboPago = ?");
      mysqli_stmt_bind_param($stmt, 'i', $_POST['idReciboPago']);
      mysqli_stmt_bind_result($stmt, $totalRP, $descuentoRP);
      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_fetch($stmt);
		//2. Saca el total de cc y descuento
		$totalRP = $totalRP*(1-($descuentoRP/100));
		mysqli_stmt_free_result($stmt);
        //3. Sacar id de cliente
		$stmt = mysqli_prepare($con, "
                        SELECT
                          idCliente
                        FROM recibo_pago
                        WHERE idReciboPago = ?");
		mysqli_stmt_bind_param($stmt, 'i', $_POST['idReciboPago']);
		mysqli_stmt_bind_result($stmt, $idCliente);
		if(mysqli_stmt_execute($stmt)){
		  mysqli_stmt_fetch($stmt);
		  mysqli_stmt_free_result($stmt);
		  //4. Sacar total pagos recibidos
		  $stmt = mysqli_prepare($con, "
                          SELECT
                            r.idPagoRecibido,
                            r.cantidad,
                            IFNULL(SUM(a.cantidad),0) as cantidadAplicada
                          FROM pagos_recibidos as r
						    LEFT JOIN pagos_aplicados as a
                              ON a.idPagoRecibido = r.idPagoRecibido
                          WHERE r.idCliente = ? AND r.aprobado = 1 GROUP BY (r.idPagoRecibido)");
		  mysqli_stmt_bind_param($stmt, 'i', $idCliente);
          mysqli_stmt_bind_result($stmt, $idPagoRecibido, $cantidad, $cantidadAplicada);
          if(mysqli_stmt_execute($stmt)){
            $pagosRecibidos = array();
            while(mysqli_stmt_fetch($stmt)){
              $cantidad -= $cantidadAplicada;
              if($cantidad>0){
                $pagosRecibidos[$idPagoRecibido] = $cantidad;
              }
            }
            //var_dump($pagosRecibidos);
            mysqli_stmt_free_result($stmt);
          }
          $fecha = date('Y-m-d');
          foreach($pagosRecibidos as $idPagoRecibido => $disponible){
            $stmt = mysqli_prepare($con, "INSERT INTO pagos_aplicados (idPagoRecibido, idReciboPago, fecha, cantidad) VALUES (?,?,?,?)");
            mysqli_stmt_bind_param($stmt, 'iisd', $idPagoRecibido, $_POST['idReciboPago'], $fecha, $cantidadAplicar);
            if($disponible<$totalRP){
              $cantidadAplicar = $disponible;
              $totalRP -= $cantidadAplicar;
            }else{
              $cantidadAplicar = $totalRP;
              $totalRP = 0;
            }
            if($cantidadAplicar>0){
              $row['totalAplicado'] += $cantidadAplicar;
              mysqli_stmt_execute($stmt) or die ('{0}');
            }else{
              break;
            }
          }
        }
        mysqli_commit($con);
				if(!$dontEcho){
        	echo json_encode($row);
				}else{
					echo "s|Aprobar Recibo|Recibo aprobado correctamente.";
				}
      }
    }else{
      echo '{0}';
    }
?>
