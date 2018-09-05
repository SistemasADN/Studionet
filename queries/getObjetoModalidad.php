<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
  $rules["idPersonal"] = 		          ['r' => true,  't' => "num"];
  $rules["idModalidadPago"] = 		    ['r' => true,  't' => "num"];
  $rules["fechaInicial"] =            ['r' => false, 't' => "date"];
  $rules["fechaFinal"] =              ['r' => false, 't' => "date"];
	$rules["esProfesor"] =              ['r' => false, 't' => "bool"];
	//getDebuggingInfo();
	//deleteDebuggingInfo();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	//$_POST['fechaInicial'] = "2017-11-03";$_POST['fechaFinal'] = "2017-11-03";
	if($_POST['esProfesor']=="true"){
		$data = select_query_one($con, "SELECT modalidad FROM modalidad_pago WHERE idModalidadPago = ?", 'i', [$_POST['idModalidadPago']]);
		//Considerar agrupar por fecha?
		$data['asistencias'] = select_query($con, "SELECT ap.asistencia, a.idGrupo, a.fecha FROM asistencia_profesor as ap
			LEFT JOIN asistencia as a ON
			 a.idAsistencia = ap.idAsistencia WHERE ap.idProfesor = ? AND a.fecha BETWEEN ? AND ?",
			 'iss', [$_POST['idPersonal'], $_POST['fechaInicial'], $_POST['fechaFinal']]);

		switch($data['modalidad']){
			case 'Grupo':
				$grupos = array();
				//Count el número de grupos
				foreach($data['asistencias'] as $asistencia){
					if($asistencia['asistencia']==2){
						continue;
					}
					if(!in_array($asistencia['idGrupo'], $grupos)){
			 			$grupos[]=$asistencia['idGrupo'];
			 		}
				}
				$data['veces'] = count($grupos);
			break;
			case 'Dia':
				//Count el número de fechas
				$fechas = array();
				//Count el número de grupos
				foreach($data['asistencias'] as $asistencia){
					if($asistencia['asistencia']==2){
						continue;
					}
					if(!in_array($asistencia['fecha'], $fechas)){
			 			$fechas[]=$asistencia['fecha'];
			 		}
				}
				$data['veces'] = count($fechas);
			break;
			case 'Por Hora':
			$grupos = array();
			//Count el número de grupos
			foreach($data['asistencias'] as $asistencia){
				if($asistencia['asistencia']==2||isset($grupos[$asistencia['idGrupo']])){
					continue;
				}
				$grupos[$asistencia['idGrupo']] = select_query($con, "SELECT SUM(h.duracion) as horas, h.dia
				 FROM horario as h LEFT JOIN salon_grupo as sg ON sg.idSalonGrupo = h.idSalonGrupo
				  WHERE sg.idGrupo =  ? GROUP BY h.dia", 'i', [$asistencia['idGrupo']]);
			}
			//Asistencias es la lista de asistencias entre las dos fechas, Ya se tomó el horario de cada grupo en la asistencia
			$data['veces'] = 0;
			foreach($data['asistencias'] as $asistencia){
					$weekDay = getWeekDayMonday($asistencia['fecha']); //Se toma el día de la semana de esa asistencia
					foreach($grupos as $grupo){ //Se busca en cada grupo
						foreach($grupo as $horario){ //Cada horario de ese grupo
							if($weekDay==$horario['dia']){ //Para ver si tiene un horario que coincida con el día marcado en la asistencia
								$data['veces'] += $horario['horas']/2; //Si coincide se suma
							}
						}
					}
			}
			break;
			default:
				unset($data['asistencias']);
				$data['veces'] = 1;
			break;
		}
		unset($data['modalidad']);
		unset($data['asistencias']);
	}else{
			$data['veces'] = 1;
	}
	//var_dump($data);
	json_echo($data);
?>
