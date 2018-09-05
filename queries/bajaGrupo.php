<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules["idGrupo"] =		 		['r' => true,  't' => "num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	$_POST['fechaBaja'] = date("Y-m-d");
	include "dbcon.php";
	if(execute_query($con, "UPDATE grupos SET fechaBaja = ? WHERE idGrupo = ?", 'si', reorder_array($_POST, ['fechaBaja', 'idGrupo']),false)){
		if(execute_query($con, "UPDATE alumnos_grupos SET fechaBaja = ?, transferenciaBaja = 0 WHERE idGrupo = ?", 'si', reorder_array($_POST, ['fechaBaja', 'idGrupo']))){
			echo $_POST['fechaBaja'];
		}
	}else{
		echo "e|Baja Clase|No se pudo dar de baja la clase. ";
	}
?>
