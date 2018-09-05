<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
    //var_dump($_POST);exit;
		$rules["fechaSelect"] =   ['r' => true,  't' => "date"];
		$rules["fechaInicio"] =   ['r' => true,  't' => "date"];
		$rules["fechaFinal"] =   ['r' => true,  't' => "date"];

		$rules["idPersonal"] =   			['r' => true,  't' => "num"];
		$rules["idCuenta"] =  			 	['r' => true,  't' => "num"];
		$rules["idModalidadPago"] =   		['r' => true,  't' => "num"];
		$rules["idFormaPago"] =   		['r' => true,  't' => "num"];
    $rules["cantidad"] =      		['r' => true,  't' => "coin"];
		$rules["concepto"] =					['r' => true , 	't' => "alphnum"];
		$rules["referencia"] =				['r' => false , 	't' => "alphnum"];
		$rules["comentarios"] =				['r' => false , 	't' => "alphnum"];
		$rules["aprobar"] =						['r' => true , 	't' => "bool"];
		$rules["agregarEgresoPersonal"] =   	['r' => false,  't' => "num"];
		$rules["unidadCalculoStatic"] =      		['r' => true,  't' => "coin"];
		$rules["montoCalculoStatic"] =      		['r' => true,  't' => "coin"];

		$validator->setRulesValidateArrayEcho($rules, $_POST);
		include_once "dbcon.php";//Conexion a la BD
		include_once "getIdSede.php";

		  if($_POST['aprobar']=="true"){
		    $_POST['aprobar'] = true;
		  }else{
		    $_POST['aprobar'] = false;
		  }
			$_POST['idSede'] = $idSede;
			//vde();
		  $_POST['idEgreso'] = insert_id_query($con, "INSERT INTO egresos
		    (idTipoEgreso, fecha, idFormaPago, idCuenta, cantidad, concepto, referencia, comentario, aprobar, idSede,beneficiario)
		     VALUES((SELECT idTipoEgreso FROM egresos_tipo WHERE nombre = 'Sueldos y Salarios'),?,?,?,?,?,?,?,?,?,'')", 'siidsssii',
				  reorder_array($_POST, ['fechaSelect', 'idFormaPago','idCuenta','cantidad','concepto','referencia','comentarios','aprobar','idSede']));
			if($_POST['idEgreso']!=0){
				if($_POST['aprobar']){
				$_POST['folio'] = select_query_one($con, "SELECT folio FROM nextfolioegresospersonal WHERE idSede = ?", 'i', [$_POST['idSede']]);
				$_POST['folio'] = $_POST['folio']['folio'];
			}else{
				$_POST['folio'] = '';
			}
				if(execute_query($con, 'INSERT INTO egresos_personal (idPersonal,idModalidadPago,idEgreso, fechaInicio, fechaFin, folio,
					 cantidadCalculo, montoCalculado) VALUES(?,?,?,?,?,?,?,?)',
				'iiissidd',reorder_array($_POST,['idPersonal','idModalidadPago','idEgreso', 'fechaInicio', 'fechaFinal', 'folio', 'unidadCalculoStatic', 'montoCalculoStatic']))){
		        echo "s|Agregar egreso|Egreso registrado correctamente.";
				 }else{
						echo "e|Agregar egreso|No se pudo registrar el egreso.";
				 }
		  }else{
		      echo "e|Agregar egreso|No se pudo registrar el egreso.";
			}
	?>
