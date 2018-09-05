
<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	include_once "getIdSede.php";
	if($idSede==-1){
		echo "No hay sede";
		exit;
	}
	/*
	$calculo = select_query($con, "SELECT formaCalculo FROM forma_calculos WHERE enUso = 1");
	$calculo = $calculo[0]['formaCalculo'];
	*/
	//var_dump($calculo);exit;
	$r = select_query($con,
      "SELECT g.idGrupo, COUNT(ag.idAlumno) as alumnosInscritos, g.idAsignatura, g.idNivel, g.numMaxAlumnos, g.precio, g.nombreGrupo, IFNULL(h.horas, 0) as horas,
			CONCAT(a.nombreAsignatura, ' - ', n.nombreNivel) as nombreClase, d.nombreDisciplina, pc.nombreProfesor as profesorPrincipal
			FROM grupos as g
			LEFT JOIN asignaturas as a ON a.idAsignatura = g.idAsignatura
			LEFT JOIN disciplinas as d ON a.idDisciplina = d.idDisciplina
			LEFT JOIN niveles as n ON n.idNivel = g.idNivel
			LEFT JOIN grupohoras as h ON h.idGrupo = g.idGrupo
	    LEFT JOIN alumnos_grupos as ag ON ag.idGrupo = g.idGrupo AND ag.fechaBaja IS NULL
			LEFT JOIN grupo_profesor as gp ON gp.idGrupo = g.idGrupo AND gp.fechaBaja IS NULL AND principal = 1
			LEFT JOIN profesorcompleto as pc ON pc.idPersonal = gp.idProfesor
			WHERE g.fechaBaja IS NULL AND g.idSede = ?
			GROUP BY (g.idGrupo)", 'i', [$idSede]);
			//AND h.horas>0 AND h.horas IS NOT NULL

		foreach($r as $k=>$v){
			//var_dump($v);
			//$r[$k]['precioHoras'] = setPrecioHora($v, $calculo);
			$r[$k]['listaHorario'] = select_query($con, "
			SELECT h.dia, h.horaInicio, h.duracion FROM salon_grupo as sg
			LEFT JOIN horario as h ON h.idSalonGrupo = sg.idSalonGrupo WHERE sg.idGrupo = ? AND h.idHorario IS NOT NULL ORDER BY h.dia ASC, h.horaInicio ASC", 'i', [$v['idGrupo']]);
			//var_dump($r[$k]);
			$dias = [];
			foreach($r[$k]['listaHorario'] as $kk=>$vv){
				if(!in_array($vv['dia'], $dias)){
					$dias[] = $vv['dia'];
				}
			}
			$r[$k]['dias'] = count($dias);
			if(isset($r[$k]['listaHorario'])){
				$r[$k]['veces'] = count($r[$k]['listaHorario']);
			}else{
				$r[$k]['veces'] = 0;
			}
			//var_dump($v);
		}
		//var_dump($r);exit;
		json_echo($r);
?>
