<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules['idGrupo'] =['r' => true , 	't' => "num"];
	$rules['idSalon'] =['r' => true , 	't' => "num"];

	$rules['dia'] = 		['r' => true , 	't' => "num"];
	$rules['duracion'] = 	['r' => true , 	't' => "num"];
	$rules['horaInicio'] = 	['r' => true , 	't' => "num"];
	
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	$horario = array();
	$horario[] = $_POST;
	unset($horario[0]['idSalonGrupo']);

	$idGrupo = select_query($con, "SELECT idGrupo FROM salon_grupo WHERE idSalonGrupo = ?", 'i', [$_POST['idSalonGrupo']]);
	$idGrupo = $idGrupo[0]['idGrupo'];

	$profesores = select_query($con, "SELECT idProfesor FROM grupo_profesor as g LEFT JOIN salon_grupo as sg ON sg.idGrupo = g.idGrupo
		 WHERE sg.idSalonGrupo = ?", 'i', reorder_array($_POST, ['idSalonGrupo']));
	//Grupos de profesor principal
	for($i=0;$i<count($profesores);$i++){
			$profesores[$i]['grupos'] = select_query($con, "SELECT idGrupo FROM grupo_profesor WHERE idProfesor = ? AND fechaBaja IS NULL", 'i', [$profesores[$i]['idProfesor']]);
			for($j=0;$j<count($profesores[$i]['grupos']);$j++){
				$insert = array($profesores[$i]['grupos'][$j]['idGrupo']);
				//var_dump($insert);
				$horarioGrupo = select_query($con, "SELECT dia, horaInicio, duracion
				FROM horario as h LEFT JOIN salon_grupo as sg ON sg.idSalonGrupo = h.idSalonGrupo
				WHERE sg.idGrupo = ?", 'i', $insert);
				if(empalme_horario($horarioGrupo, $horario)){
					//var_dump($horarioGrupo);
					//var_dump($horario);
					echo "e|Asignar horario|No se puede asignar el grupo a este horario ya que se empalma con otro grupo de un profesor. ";
					exit;
				}
			}
	}

	$idHorario = insert_id_query($con, "INSERT INTO horario (idSalonGrupo, dia, horaInicio, duracion) VALUES (?,?,?,?)", 'iiii', reorder_array($_POST, ['idSalonGrupo', 'dia', 'horaInicio', 'duracion']));

	if($idHorario>0){
		mysqli_commit($con);
		echo "s|Asignar Horario|Horario asignado correctamente.|".$idHorario;
	}else{
		echo "s|Asignar Horario|No se pudo asignar el horario. ";
	}
?>
