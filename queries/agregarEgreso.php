<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//vde();
	//Reglas
	$rules = array ();
		$rules["idTipoEgreso"] =   ['r' => true,  't' => "num"];
		$rules["fechaSelect"] =   ['r' => true,  't' => "date"];
    $rules["idFormaPago"] =   ['r' => true,  't' => "num"];
		$rules["idCuenta"] =   ['r' => true,  't' => "num"];
    $rules["cantidad"] =      ['r' => true,  't' => "coin"];
		$rules["beneficiario"] =		['r' => true , 	't' => "alphnum"];
		$rules["concepto"] =		['r' => true , 	't' => "alphnum"];
		$rules["referencia"] =		['r' => false , 	't' => "alphnum"];
		$rules["comentario"] =		['r' => false , 	't' => "alphnum"];
		$rules["aprobar"] =				['r' => true , 	't' => "bool"];
		$rules["agregarEgreso"] =   ['r' => false,  't' => "num"];
		//vde();
		$validator->setRulesValidateArrayEcho($rules, $_POST);
		include_once "dbcon.php";//Conexion a la BD
		include_once "getIdSede.php";

		  if($_POST['aprobar']=="true"){
		    $_POST['aprobar'] = true;
		  }else{
		    $_POST['aprobar'] = false;
		  }
			$_POST['idSede'] = $idSede;
			unset($_POST['agregarEgreso']);
			//vde();
		  if(execute_query($con, "INSERT INTO egresos
		    (idTipoEgreso, fecha, idFormaPago, idCuenta, cantidad, beneficiario, concepto, referencia, comentario, aprobar, idSede)
		     VALUES(?,?,?,?,?,?,?,?,?,?,?)", 'isiidssssii', $_POST)){
		       echo "s|Agregar egreso|Egreso registrado correctamente.";
		  }else{
		      echo "e|Agregar egreso|No se pudo registrar el egreso.";
			}
	?>
