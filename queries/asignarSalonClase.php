<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules['idGrupo'] = 	['r' => true , 	't' => "num"];
	$rules['idSalon'] = 	['r' => true , 	't' => "num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	$data = array();
	$selected = select_query($con, "SELECT COUNT(*) as tot FROM salon_grupo WHERE idGrupo = ? AND idSalon = ?", 'ii', reorder_array($_POST, ['idGrupo', 'idSalon']));
	$selected = $selected[0]['tot'];
	if($selected==0){
		$data['idSalonGrupo'] = insert_id_query($con, "INSERT INTO salon_grupo (idGrupo, idSalon) VALUES (?,?)", 'ii', reorder_array($_POST, ['idGrupo', 'idSalon']));
		mysqli_commit($con);
	}else{
		$data = 0;
	}
	json_echo($data);
?>
