<?php
	include "../validation/classValidator.php";

	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules["idGrupo"] =		 		['r' => true,  't' => "num"];
	$rules["idEquipo"] =		 		['r' => true,  't' => "num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	//Sacar lista de alumnos en equipo
	$equipo = makeAnswerArray(select_query($con, 'SELECT idAlumno FROM alumnos_equipos WHERE idEquipo = ? AND fechaBaja IS NULL', 'i', reorder_array($_POST, ['idEquipo'])));
	//Sacar lista de alumnos en grupo
	$grupo = makeAnswerArray(select_query($con, 'SELECT idAlumno FROM alumnos_grupos WHERE fechaBaja IS NULL AND idGrupo = ?', 'i', reorder_array($_POST, ['idGrupo'])));
	//Restar lista de grupo de lista de equipo
	$restantes = array_diff($equipo, $grupo);
	if(count($restantes)==0){
		//echo "e|Inscribir equipo|No quedan alumnos que inscribir de este equipo a este grupo. ";
		//exit;
	}
	$horarios = array();
	foreach($equipo as $k=>$v){
		$insert = array($v);
		$horarios[] = select_query($con, "SELECT dia, horaInicio, duracion
		FROM horario as h
		LEFT JOIN salon_grupo as sg ON sg.idSalonGrupo = h.idSalonGrupo
		LEFT JOIN alumnos_grupos as ag ON ag.idGrupo = sg.idGrupo
		WHERE ag.idAlumno= ? AND ag.fechaBaja IS NULL", 'i', $insert);
	}
	$horarioGrupo = select_query($con, "SELECT dia, horaInicio, duracion
	FROM horario as h LEFT JOIN salon_grupo as sg ON sg.idSalonGrupo = h.idSalonGrupo
	WHERE sg.idGrupo = ?", 'i', reorder_array($_POST, ['idGrupo']));

	foreach($horarios as $k=>$v){
		if(empalme_horario($horarioGrupo, $v)){
			echo "e|Inscribir equipo|No se puede inscribir el equipo ya que hay un empalme con uno o más alumnos en su horario. ";
			exit;
		}
	}

	//Sacar maximo de alumnos en un grupo
	$numAlumnosGrupo = select_query($con, 'SELECT numMaxAlumnos FROM grupos WHERE idGrupo = ?', 'i', reorder_array($_POST, ['idGrupo']));
	//Si la lista restante es menor o igual a numMaxAlumnos continuar
	$numAlumnosGrupo = $numAlumnosGrupo[0]['numMaxAlumnos'];
	if(count($restantes)<=$numAlumnosGrupo){
		foreach($restantes as $k=>$v){
			$insert = array($v, $_POST['idGrupo'], date("Y-m-d"));
			if(!execute_query($con, "INSERT INTO alumnos_grupos (idAlumno, idGrupo, fechaAlta) VALUES (?,?,?)", 'iis', $insert, false)){
				echo "e|Inscribir equipo|Hubo un error al inscribir los alumnos a la clase. ";
				exit;
			}
		}
		mysqli_commit($con);
		echo "s|Inscribir equipo|Se ha inscrito el equipo a la clase correctamente. ";
	}else{
		echo "e|Inscribir equipo|No se inscribió la clase ya que el tamaño del equipo es más grande que el cupo de la clase. ";
	}
?>
