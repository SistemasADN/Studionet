<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules["idGrupo"] =		 		['r' => true,  't' => "num"];
	$rules["idNivel"] =		 		['r' => true,  't' => "num"];
	$rules["idAsignatura"] =		 		['r' => true,  't' => "num"];
	$rules["nombreGrupo"] =		 		['r' => true,  't' => "alphnum"];
	$rules["numMaxAlumnos"] = 		['r' => true,  't' => "num"];
	$rules["precio"] =     			['r' => true,  't' => "coin"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	//HORARIO GRUPO actual
	$horario = select_query($con, "SELECT dia, horaInicio, duracion
		FROM horario as h LEFT JOIN salon_grupo as sg ON sg.idSalonGrupo = h.idSalonGrupo
		WHERE sg.idGrupo = ?", 'i', reorder_array($_POST, ['idGrupo']));
	//HORARIOS PROFESOR PRINCIPAL
	/*
	$gruposProfesor = select_query($con,
		"SELECT idGrupo FROM grupos WHERE idProfesorPrincipal = ? AND idGrupo <> ?", 'ii', reorder_array($_POST, ['idProfesorPrincipal', 'idGrupo']));

		for($i=0;$i<count($gruposProfesor);$i++){
			$insert = array($gruposProfesor[$i]['idGrupo']);
			$horarioGrupo = select_query($con, "SELECT dia, horaInicio, duracion
				FROM horario as h LEFT JOIN salon_grupo as sg ON sg.idSalonGrupo = h.idSalonGrupo
				WHERE sg.idGrupo = ?", 'i', $insert);
				if(empalme_horario($horarioGrupo, $horario)){
				  	echo "e|Editar grupo|No se puede asigar ese profesor principal a este grupo ya que su horario se empalma. ";
						exit;
				}
		}

		if($_POST['idProfesorSecundario']!=""){
			$gruposProfesor = select_query($con,
				"SELECT idGrupo FROM grupos WHERE idProfesorPrincipal = ? AND idGrupo <> ?", 'ii', reorder_array($_POST, ['idProfesorSecundario', 'idGrupo']));
				for($i=0;$i<count($gruposProfesor);$i++){
					$insert = array($gruposProfesor[$i]['idGrupo']);
					$horarioGrupo = select_query($con, "SELECT dia, horaInicio, duracion
						FROM horario as h LEFT JOIN salon_grupo as sg ON sg.idSalonGrupo = h.idSalonGrupo
						WHERE sg.idGrupo = ?", 'i', $insert);
						if(empalme_horario($horarioGrupo, $horario)){
								echo "e|Editar grupo|No se puede asigar ese profesor secundario a este grupo ya que su horario se empalma. ";
								exit;
						}
				}
		}
*/
	if(execute_query($con, "UPDATE grupos SET idAsignatura = ?, idNivel = ?,  numMaxAlumnos = ?, precio = ?, nombreGrupo = ? WHERE idGrupo = ?", 'iiidsi',
	reorder_array($_POST, ['idAsignatura', 'idNivel', 'numMaxAlumnos', 'precio', 'nombreGrupo', 'idGrupo']))){
		echo "s|Editar clase|Clase editada correctamente. ";
	}else{
		echo "e|Editar clase|No se pudo editar la clase. ";
	}
?>
