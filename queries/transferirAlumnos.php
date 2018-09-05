<?php
	include "../validation/classValidator.php";

	$validator = new Validator();
	//Reglas
	//$validator->enableEchos();
	$rules = array ();
	$rules["idGrupo"] =			 				['r' => true,  't' => "num"];
	$rules["idGrupoTransferir"] =		['r' => true,  't' => "num"];
	$alumnos = $_POST['alumnos'];
	unset($_POST['alumnos']);
	//vde();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	$rules = array ();
	$rules["idAlumno"] =		 		['r' => true,  't' => "num"];
	foreach($alumnos as $k=>$alumno){
		$validator->setRulesValidateArrayEcho($rules, $alumno);
	}
	include "dbcon.php";
	//CHECAR QUE EL NUMERO DE ALUMNOS A TRANSFERIR QUEPA EN EL GRUPO
	$alumnosAInscribir = array();
	foreach($alumnos as $k=>$v){
		$alumnosAInscribir[] = $v['idAlumno'];
	}
	$r = select_query($con, "SELECT idAlumno FROM alumnos_grupos WHERE idGrupo = ? AND fechaBaja IS NULL", 'i', [$_POST['idGrupoTransferir']]);
	$alumnosInscritos = array();
	foreach($r as $k=>$v){
		$alumnosInscritos[] = $v['idAlumno'];
	}
	$restante = array_diff($alumnosAInscribir, $alumnosInscritos);

	$maxAlumnos = select_query($con, "SELECT numMaxAlumnos FROM grupos WHERE idGrupo = ?", 'i', [$_POST['idGrupoTransferir']]);
	$maxAlumnos = $maxAlumnos[0]['numMaxAlumnos'];
	$maxAlumnos -= count($alumnosInscritos);
	if(count($restante)>$maxAlumnos){
		echo "e|Transferir alumnos|No se pueden transferir los alumnos seleccionados ya que sobrepasan el cupo del grupo a transferir. ";exit;
	}

	//SELECCIONAR EL HORARIO DEL GRUPO
	$horarioGrupo = select_query($con, "SELECT dia, horaInicio, duracion
	FROM horario as h LEFT JOIN salon_grupo as sg ON sg.idSalonGrupo = h.idSalonGrupo
	WHERE sg.idGrupo = ?", 'i', reorder_array($_POST, ['idGrupoTransferir']));
	//SELECCIONAR EL HORARIO DEL ALUMNO
		foreach($restante as $k=>$idAlumno){
			$horarioAlumno = select_query($con, "SELECT dia, horaInicio, duracion
			FROM horario as h
			LEFT JOIN salon_grupo as sg ON sg.idSalonGrupo = h.idSalonGrupo
			LEFT JOIN alumnos_grupos as ag ON ag.idGrupo = sg.idGrupo
			WHERE ag.idAlumno= ? AND ag.fechaBaja IS NULL", 'i', [$idAlumno]);

			if(empalme_horario($horarioGrupo, $horarioAlumno)){
					echo "e|Transferir alumnos|No se pueden transferir estos alumnos ya que al menos uno de ellos tiene un empalme en su horario. ";
				exit;
			}
		}


	$fecha = date("Y-m-d");
	foreach($alumnos as $k=>$alumno){
			$alumno = $alumno['idAlumno'];
			if(!execute_query($con, "UPDATE alumnos_grupos SET fechaBaja = ?, transferenciaBaja = 1 WHERE idAlumno = ? AND idGrupo = ?", 'sii', [$fecha, $alumno, $_POST['idGrupo']], false)){
					echo "e|Transferir alumnos|No se pudo dar de baja los alumnos del grupo. ";exit;
			}
	}
	foreach($restante as $k=>$alumno){
			if(!execute_query($con, "INSERT INTO alumnos_grupos (fechaAlta, idAlumno, idGrupo, transferenciaAlta) VALUES (?,?,?, 1)", 'sii', [$fecha, $alumno, $_POST['idGrupoTransferir']], false)){
					echo "e|Transferir alumnos|No se pudo inscribir los alumnos al grupo. ";exit;
			}
	}
	echo "s|Transferir alumnos|Alumnos transferidos correctamente.";
	mysqli_commit($con);
?>
