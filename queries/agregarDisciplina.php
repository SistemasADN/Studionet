<?php

	include "../validation/classValidator.php";
	include "getFormaCalculo.php";
	$validator = new Validator();
	//$validator->enableEchos();
	//Reglas
	$rules = array ();
	$rules['nombreDisciplina'] = 				['r' => true , 	't' => "alpha"];
	//getDebuggingInfo(true);
	$validator->setRulesValidateArrayEcho($rules, $_POST);
    //echo "BIEN";
	//exit;
	include "dbcon.php";
if(insert_query($con, "INSERT INTO disciplinas (nombreDisciplina) VALUES (?)", 's',$_POST)){
		echo "s|Agregar Disciplina|Disciplina agregada correctamente. ";
	}else{
		echo "e|Agregar Disciplina|No se pudo agregar la disciplina. ";
	}
?>
