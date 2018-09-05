<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	include "getIdSede.php";
	if($idSede==-1){
		$respuesta = select_query($con, "SELECT s.idSalon as id, s.nombreSalon as value,
			e.nombreSede as subtext FROM salones as s
			LEFT JOIN sedes as e ON s.idSede = e.idSede WHERE s.activo = 1 ORDER BY value ASC");
	}else{
		$respuesta = select_query($con, "SELECT s.idSalon as id, s.nombreSalon as value,
			e.nombreSede as subtext FROM salones as s
			LEFT JOIN sedes as e ON s.idSede = e.idSede
			WHERE s.activo = 1 AND e.idSede = ? ORDER BY value ASC", "i", [$idSede]);
	}
	json_echo(format_respuesta_select($respuesta));
?>
