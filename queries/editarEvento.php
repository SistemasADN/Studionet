<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
//vde();
	//$_POST['fechaText'] = date('Y-d-m', strtotime(str_replace('-', '/', $_POST['fechaText'])));
	$rules = array ();
    $rules["idAgenda"] = 		    ['r' => true,  't' => "num"];
		$rules["evento"] = 		        ['r' => true,  't' => "specs"];
    $rules["fecha"] =     			['r' => true, 't' => "date"];
		$rules['tiempoInicial'] = 	['r' => true, 't' => "time"];
		$rules['tiempoFinal'] =     ['r' => true, 't' => "time"];
		if(isset($_POST['listaEquipos'])){
			$listaEquipos = $_POST['listaEquipos'];
			unset($_POST['listaEquipos']);
		}else{
			$listaEquipos = array();
		}
		$validator->enableEchos();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	if (date('H:i', strtotime($_POST['tiempoInicial'])) > date('H:i', strtotime($_POST['tiempoFinal']))) {
		echo "e|Editar Evento|La hora de inicio no puede ser mayor a la hora final.";exit;
	}
	$rules = array ();
  $rules["idEquipo"] = 		    ['r' => true,  't' => "num"];
	foreach($listaEquipos as $k=>$v){
		$validator->setRulesValidateArrayEcho($rules, $v);
	}
	include "dbcon.php";

	execute_query($con, "UPDATE agenda SET nombreEvento = ?, fecha = ?, tiempoInicial = ?, tiempoFinal = ?
		 WHERE idAgenda = ?", 'ssssi', reorder_array_keys($_POST, ['evento', 'fecha', 'tiempoInicial', 'tiempoFinal', 'idAgenda']), false) or die ("e|Editar Evento|No se pudo editar el evento.");
	execute_query($con, "DELETE FROM agenda_equipos WHERE idAgenda = ?", "i", [$_POST['idAgenda']], false) or die ("e|Editar Evento|No se pudo editar la lista de equipos.");
	foreach($listaEquipos as $k=>$v){
		execute_query($con, "INSERT INTO agenda_equipos (idAgenda, idEquipo) VALUES (?,?)", "ii", [$_POST['idAgenda'], $v['idEquipo']], false) or die ("e|Editar Evento|No se pudo crear la lista de equipos.");
	}
	mysqli_commit($con);
	echo "s|Editar Evento|Evento editado correctamente.";
?>
