<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	$rules['idSalonGrupo'] = ["r"=>true, "t"=>"num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);

	include "dbcon.php";
	if(execute_query($con, "DELETE FROM horario WHERE idSalonGrupo = ?", 'i', $_POST, false)){
		if(execute_query($con, "DELETE FROM salon_grupo WHERE idSalonGrupo = ?", 'i', $_POST, false)){
			echo "s|Borrar Todos Registros|Registro de horario y clase borrados correctamente. ";
      mysqli_commit($con);
      exit;
	   }
	}

	echo "e|Borrar Todos Registros|No se pudo borrar todos los registro de horario. ";
?>
