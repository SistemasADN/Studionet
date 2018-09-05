<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	//$_POST['fechaSelectText'] = date('Y-d-m', strtotime(str_replace('-', '/', $_POST['fechaSelectText'])));
	$rules = array ();
    //var_dump($_POST);exit;
    $rules["nombre"] = 		        ['r' => true,  't' => "alphnum"];
    $rules["fechaSelect"] =     ['r' => true, 't' => "date"];
		$rules['horaInicio'] = 	     ['r' => true, 't' => "time"];
		$rules['horaFinal'] =      ['r' => true, 't' => "time"];

		$rules2['idEquipo'] =      ['r' => true, 't' => "num"];

		if(isset($_POST['listaEquipos'])){
			$sizeList = $_POST['listaEquipos'];
		}else{
			$sizeList = [];
		}

	unset($_POST['listaEquipos']);

	$validator->setRulesValidateArrayEcho($rules, $_POST);

	foreach($sizeList as $numericKey=>$row){
		$validator->setRulesValidateArrayEcho($rules2, $row);
	}

	if (date('H:i', strtotime($_POST['horaInicio'])) > date('H:i', strtotime($_POST['horaFinal']))) {
		echo "e|Agregar Evento|La hora de inicio no puede ser mayor a la hora final.";exit;
	}


	include "dbcon.php";
	include_once "getIdSede.php";
	$_POST['idSede'] = $idSede;

	$idAgenda = insert_id_query($con, "INSERT INTO agenda
		(nombreEvento, fecha, tiempoInicial, tiempoFinal, idSede)
		VALUES (?,?,?,?,?)", 'ssssi',
		reorder_array($_POST, ['nombre', 'fechaSelect', 'horaInicio', 'horaFinal', 'idSede']));

		foreach($sizeList as $k=>$v){
				execute_query($con, "INSERT INTO agenda_equipos (idAgenda, idEquipo) VALUES (?,?)", 'ii', [$idAgenda, $v["idEquipo"]]) or die ("e|Agregar evento|No se pudo agregar la lista de equipos.");
		}
		mysqli_commit($con);
		echo "s|Agregar Evento|Evento agregado correctamente.";
		mysqli_commit($con);
	//	execute_query($con, "INSERT INTO agenda_equipos (idAgenda, idEquipo), VALUES()", 'ii'
?>
