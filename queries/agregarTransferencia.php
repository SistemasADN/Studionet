<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	if(isset($_POST['idTipoIngreso'])){
  	$rules["idTipoIngreso"] = 			['r' => true , 	't' => "num"];
	}
	if(isset($_POST['idTipoEgreso'])){
	  $rules["idTipoEgreso"] = 			['r' => true , 	't' => "num"];
	}
	$rules["fechaSelect"] =			['r' => true , 	't' => "date"];
	$rules["idFormaPago"] =			['r' => true , 	't' => "num"];
	$rules["idCuentaOrigen"] = 			['r' => true , 	't' => "num"];
  $rules["idCuentaDestino"] = 			['r' => true , 	't' => "num"];
	$rules["cantidad"] =		['r' => true , 	't' => "coin"];
	$rules["concepto"] =		['r' => true , 	't' => "alphnum"];
	$rules["referencia"] =		['r' => false , 	't' => "alphnum"];
	$rules["comentarios"] =		['r' => false , 	't' => "alphnum"];
  $rules["aprobar"] =		['r' => true , 	't' => "bool"];
	$rules["agregarTransferencia"] =		['r' => false , 	't' => "num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include_once "dbcon.php";//Conexion a la BD
	include_once "getIdSede.php";
	$_POST['idSede'] = $idSede;
	//var_dump($_POST);
  if($_POST['aprobar']=="true"){
    $_POST['aprobar'] = true;
  }else{
    $_POST['aprobar'] = false;
  }
//  var_dump($_POST);
//  var_dump(reorder_array(
	//vde();
  if(execute_query($con, "INSERT INTO ingresos  (idTipoIngreso, fecha, idFormaPago, idCuenta, cantidad, beneficiario, concepto, referencia, comentario, aprobar, idSede)VALUES((SELECT idTipoIngreso FROM ingresos_tipo WHERE nombre = 'Transferencia entre cuentas'), ?,?,?,?,?,?,?,?,?,?)", 'siidssssii', reorder_array($_POST, ['fechaSelect', 'idFormaPago',	'idCuentaDestino',   'cantidad', 'idCuentaOrigen', 'concepto', 'referencia','comentarios','aprobar', 'idSede']))){
  if(execute_query($con, "INSERT INTO egresos   (idTipoEgreso, fecha, idFormaPago, idCuenta, cantidad, beneficiario, concepto, referencia, comentario, aprobar, idSede)VALUES((SELECT idTipoEgreso FROM egresos_tipo WHERE nombre = 'Transferencia entre cuentas'),?,?,?,?,?,?,?,?,?,?)", 'siidssssii', reorder_array($_POST, ['fechaSelect', 'idFormaPago',					'idCuentaOrigen',  'cantidad', 'idCuentaDestino',  'concepto', 'referencia','comentarios','aprobar', 'idSede']))){
         echo "s|Transferencia|Transferencia registrada correctamente.";
        }else{
          echo "e|Transferencia|No se pudo registrar la transferencia.";
        }
  }else{
      echo "e|Transferencia|No se pudo registrar la transferencia.";
  }
?>
