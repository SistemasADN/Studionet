<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	var_dump($_POST);exit;
	//Reglas
	$rules = array ();
    //var_dump($_POST);exit;
    $rules["idPersonal"] = 		        ['r' => true,  't' => "num"];
    $rules["modalidadPagoSearch"] =       ['r' => true,  't' => "num"];
    $rules["formaPagoSearch"] =       ['r' => false,  't' => "num"];
    $rules["sueldo"] =         ['r' => false,  't' => "dec"];

		$validator->setRulesValidateArrayEcho($rules, $_POST);
		include "dbcon.php";
		//$_POST['idPersonal'] = insert_personal($con, $_POST);
		if(insert_query($con, "
	      INSERT INTO egresos_personal (idPersonal, idModalidadPago, idFormaPago, cantidad) VALUES (?,?,?,?)",
				 'iiid', reorder_array_keys($_POST, ['idPersonal', 'modalidadPagoSearch', 'formaPagoSearch', 'sueldo']))){
			echo "s|Agregar Egreso|Egreso agregada correctamente. ";
		}else{
			echo "e|Agregar Egreso|No se pudo agregar el egreso. ";
		}
?>
