<?php
	include "../validation/classValidator.php";
    include '../mailer/randomLib.php';
    include '../mailer/emailFunctions.php';
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules["asignaturaSearch"] =		 		['r' => true,  't' => "num"];
	$rules["nivelSearch"] =		 		['r' => true,  't' => "num"];
	$rules["nombreGrupo"] =		 		['r' => true,  't' => "alphnum"];
  $rules["numMaxAlumno"] = 		['r' => true,  't' => "num"];
  $rules["precio"] =     			['r' => true,  't' => "coin"];

	$listaProfesores = $_POST['listaProfesores'];
	unset($_POST['listaProfesores']);
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	$validator->enableEchos();
	$rules = array ();
	$rules["idProfesor"] =		 		['r' => true,  't' => "num"];
	$rules["principal"] =		 			['r' => true,  't' => "bool"];
	for($i=0;$i<count($listaProfesores);$i++){
		$validator->setRulesValidateArrayEcho($rules, $listaProfesores[$i]);
	}
	//var_dump($listaProfesores);vde();
	include "dbcon.php";
	include_once "getIdSede.php";
	mysqli_autocommit($con, FALSE);
	$_POST['idSede'] = $idSede;
	$_POST['fechaAlta'] = date("Y-m-d");
	$idGrupo = insert_id_query($con, "INSERT INTO grupos (idNivel, idAsignatura, nombreGrupo, numMaxAlumnos, precio, fechaAlta, idSede) VALUES (?,?,?,?,?,?,?)", 'iisidsi', reorder_array($_POST, ['nivelSearch', 'asignaturaSearch', 'nombreGrupo', 'numMaxAlumno', 'precio', 'fechaAlta', 'idSede']));
	for($i=0;$i<count($listaProfesores);$i++){
		if($listaProfesores[$i]['principal']=="true"){
			$listaProfesores[$i]['principal'] = 1;
		}else{
			$listaProfesores[$i]['principal'] = 0;
		}
		$next = [$idGrupo, $listaProfesores[$i]['idProfesor'], $listaProfesores[$i]['principal'],$_POST['fechaAlta']];
		//var_dump($next);exit;
		if(!execute_query($con, "INSERT INTO grupo_profesor (idGrupo, idProfesor, principal, fechaAlta) VALUES (?,?,?,?)", 'iiss', $next, false)){
			echo "e|Crear Clase|No se pudo crear la lista de profesores.";exit;
		}
	}
	echo "s|Crear Clase|Clase creada exitosamente";
	mysqli_commit($con);
?>
