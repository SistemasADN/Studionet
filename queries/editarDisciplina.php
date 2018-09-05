<?php

	include "../validation/classValidator.php";
	include "getFormaCalculo.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
    //print_r($_POST); exit;
	$rules['nombreDisciplina'] =      ['r' => true , 	't' => "alphnum"];
	$rules['estatus'] =               ['r' => true , 	't' => "bool"];
    $rules['idDisciplina'] =          ['r' => true , 	't' => "num"];
    if($_POST['estatus']=='true'){
		$activo=1;
	} else{
		$activo=0;
	}
	//print_r($activo); exit;
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	
	if(execute_query($con, "UPDATE disciplinas SET nombreDisciplina = ?, activo = ? WHERE idDisciplina = ?", "sii", [$_POST['nombreDisciplina'], $activo, $_POST['idDisciplina']])){
		echo "s|Editar Disciplina|Disciplina editada correctamente. ";
	}else{
		echo "e|Editar Disciplina|No se pudo editar la disciplina. ";
	}
?>
