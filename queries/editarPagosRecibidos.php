<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules["idPagoRecibido"] =		 		['r' => true,  't' => "num"];
	//vde();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	include_once "getIdSede.php";
	$_POST['idSede'] = $idSede;
	mysqli_autocommit($con, FALSE);
	if(execute_query($con, "UPDATE pagos_recibidos SET aprobado = 1  WHERE idPagoRecibido = ?", 'i', [$_POST['idPagoRecibido']],false)){
		$_POST['idCliente'] = select_query($con, "SELECT idCliente,cantidad FROM pagos_recibidos WHERE idPagoRecibido = ?", 'i', [$_POST['idPagoRecibido']]);
		$_POST['cantidad'] = $_POST['idCliente'][0]['cantidad'];
		$_POST['idCliente'] = $_POST['idCliente'][0]['idCliente'];
		$_POST['fechaSelectText'] = date("Y-m-d");

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
             'iisd', [$_POST['idPagoRecibido'], $totalRecibo[0]['idReciboPago'], $_POST['fechaSelectText'], $cantidadAplicada])){
               echo "e|Aprobar Pago|No se pudo aprobar el pago.";exit;
             }
        }else{
          break;
        }
      }
      mysqli_commit($con);
      echo "s|Aprobar Pago|Pago aprobado correctamente.";
      exit;
    }else{
      echo "e|Aprobar Pago|No se pudo aprobar el pago.";
    }
?>
