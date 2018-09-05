<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	$rules['idHorario'] = ["r"=>true, "t"=>"num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);

	include "dbcon.php";
	$idSalonGrupo = select_query($con, "SELECT idSalonGrupo FROM horario WHERE idHorario = ?", 'i', $_POST);
	$idSalonGrupo = $idSalonGrupo[0]['idSalonGrupo'];

	if(execute_query($con, "DELETE FROM horario WHERE idHorario = ?", 'i', $_POST, false)){
		//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY
		$count = select_query($con, "SELECT COUNT(*) as total FROM horario WHERE idSalonGrupo = ?", 'i', [$idSalonGrupo]);
		$count = $count[0]['total'];
		if($count==0){
			if(!execute_query($con, "DELETE FROM salon_grupo WHERE idSalonGrupo = ?", 'i', [$idSalonGrupo], false)){
				echo "e|Borrar Registro|No se pudo borrar el registro de horario. ";	exit;
			}
		}
		//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY//DELETE IF EMPTY
		echo "s|Borrar Registro|Registro de horario borrado correctamente.";
		mysqli_commit($con);
	}else{
		echo "e|Borrar Registro|No se pudo borrar el registro de horario. ";
	}
?>
