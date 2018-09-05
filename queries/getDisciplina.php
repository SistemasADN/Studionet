<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	$data = select_query($con, "SELECT idDisciplina, nombreDisciplina, activo FROM disciplinas");
	foreach($data as $k=>$v){
		$data[$k]['listaCalculos'] = select_query($con, "SELECT veceshorasdias, cuota FROM forma_calculos_detalle WHERE idDisciplina = ?", 'i', [$v['idDisciplina']]);
	}
	json_echo($data);
?>
