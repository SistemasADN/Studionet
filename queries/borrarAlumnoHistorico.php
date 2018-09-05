<?php

	include "../validation/classValidator.php";
  //getDebuggingInfo(true);
	$validator = new Validator();
	//Reglas
	$rules = array ();
  $rules['idAlumnoGrupo'] = ['t'=>'num', 'r'=>true];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
  execute_query($con, "DELETE FROM alumnos_grupos WHERE idAlumnoGrupo = ?", 'i', [$_POST['idAlumnoGrupo']])
   or die ("e|Borrar Clase|No se pudo borrar el registro de la clase.");
   echo "s|Borrar Clase|Se borró el registro de la clase.";
?>
