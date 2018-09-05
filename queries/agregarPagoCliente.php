<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
		$rules["idCliente"] =   ['r' => true,  't' => "num"];
		$rules["fechaSelect"] =   ['r' => true,  't' => "date"];
    $rules["idFormaPago"] =   ['r' => true,  't' => "num"];
    $rules["idAlumno"] =   ['r' => false,  't' => "num"];
		$rules["idCuenta"] =   ['r' => true,  't' => "num"];
    $rules["cantidad"] =      ['r' => true,  't' => "dec"];
		$rules["concepto"] =		['r' => true , 	't' => "alphnum"];
		$rules["referencia"] =		['r' => false , 	't' => "alphnum"];
		$rules["comentarios"] =		['r' => false , 	't' => "alphnum"];
		$rules["aprobar"] =				['r' => true , 	't' => "bool"];
		$rules["agregarIngresoCliente"] =   ['r' => false,  't' => "num"];
		$cantidad = $_POST['cantidad'];
		$validator->enableEchos();
    $validator->setRulesValidateArrayEcho($rules, $_POST);
		include_once "dbcon.php";//Conexion a la BD
		include_once "getIdSede.php";
    $_POST['idSede'] = $idSede;
    //Crear pago_recibido
    $idPagoRecibido = insert_id_query($con,
      "INSERT INTO pagos_recibidos (fecha, referencia, concepto, comentario, idCliente, idFormaPago, idCuenta, cantidad, aprobado, idSede, folio) VALUES(?,?,?,?,?,?,?,?,?,?, (SELECT folio FROM nextfoliopagosrecibidos WHERE idSede = ?))",
      'ssssiiidiii',
      [$_POST['fechaSelect'], $_POST['referencia'], $_POST['concepto'], $_POST['comentarios'], $_POST['idCliente'],
			$_POST['idFormaPago'], $_POST['idCuenta'], $_POST['cantidad'], $_POST['aprobar'], $_POST['idSede'], $_POST['idSede']]);
		if($_POST['aprobar']=="false"){
				goto end;
		}
    if($idPagoRecibido!=0){
      //Tomar todas las cartas de cobro del cliente CON folio
      $recibosPago = select_query($con, "SELECT idReciboPago FROm recibo_pago WHERE idCliente = ? AND folio IS NOT NULL", 'i', [$_POST['idCliente']]);
      //Checar si hay Cartas de Cobro no completadas
      for($i=0;$i<count($recibosPago);$i++){
        $idReciboPago = $recibosPago[$i]['idReciboPago'];
        $totalRecibo = select_query($con, "SELECT ta.idReciboPago, IFNULL(ta.totalAplicado, 0) as totalAplicado, tr.totalRecibo FROM totalpagoaplicado as ta LEFT JOIN totalrecibopago as tr ON tr.idReciboPago = ta.idReciboPago WHERE tr.idReciboPago = ?
        HAVING totalAplicado<tr.totalRecibo", 'i', [$idReciboPago]);
        if(count($totalRecibo)==0){
          continue;
        }
        $porAplicar = $totalRecibo[0]['totalRecibo']-$totalRecibo[0]['totalAplicado']; //Lo que le falta por Aplicar

        if($_POST['cantidad']>0){
            if($_POST['cantidad']>=$porAplicar){
              $cantidadAplicada = $porAplicar;
              $_POST['cantidad']-= $porAplicar;
            }else{
              $cantidadAplicada = $_POST['cantidad'];
              $_POST['cantidad'] = 0;
            }
            if(!execute_query($con, "INSERT INTO pagos_aplicados (idPagoRecibido, idReciboPago, fecha, cantidad) VALUES (?,?,?,?)",
             'iisd', [$idPagoRecibido, $totalRecibo[0]['idReciboPago'], $_POST['fechaSelect'], $cantidadAplicada])){
               echo "e|Agregar Pago|No se pudo aplicar el pago.";exit;
             }
        }else{
          break;
        }
      }
			end:
      mysqli_commit($con);
			$_POST['idPagoRecibido'] = $idPagoRecibido;
			$_POST['cantidad'] = $cantidad;
      echo "s|Agregar Pago|Pago creado correctamente.|".json_encode($_POST);
      exit;
    }else{
      echo "e|Agregar Pago|No se pudo crear el pago.";
    }

?>
