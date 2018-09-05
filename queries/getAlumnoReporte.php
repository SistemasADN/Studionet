<?php

	include "../validation/classValidator.php";
	
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	include "getIdSede.php";
	$respuesta = select_query($con,
              "SELECT
                a.idAlumno,
                pc.nombre as nombreAlumno,
								tp.nombre as nombreCliente,
								c.idPersona,
                (SELECT idPersona FROM clientesalumnos WHERE idPersona = a.idPersona) AS ca
	          FROM alumnos as a
			  LEFT JOIN personacompleta as pc ON pc.idPersona = a.idPersona
			  LEFT JOIN clientes as c ON c.idCliente = a.idTutor
			  LEFT JOIN personacompleta as tp ON tp.idPersona = c.idPersona
			  WHERE a.activo = 1");

			foreach($respuesta as $k=>$v){
				$respuesta[$k]['grupos'] =
				select_query($con,
				"SELECT
					ag.idGrupo,
					g.idSede,
					g.precio,
					h.horas,
					d.nombreDisciplina,
					pc.nombre as nombreProfesor,
					g.nombreGrupo,
					ag.fechaAlta,
					ag.fechaBaja,
					a.idDisciplina
				FROM alumnos_grupos as ag
				LEFT JOIN grupos as g ON ag.idGrupo = g.idGrupo
				LEFT JOIN asignaturas as a ON a.idAsignatura = g.idAsignatura
				LEFT JOIN disciplinas as d ON d.idDisciplina = a.idDisciplina
				LEFT JOIN grupohoras as h ON h.idGrupo = ag.idGrupo
				LEFT JOIN grupo_profesor as gp ON gp.idGrupo = g.idGrupo AND gp.principal = 1
				LEFT JOIN personal as p ON p.idPersonal = gp.idProfesor
				LEFT JOIN personacompleta as pc ON p.idPersona = pc.idPersona
				WHERE ag.idAlumno = ? AND g.idSede = ? AND ag.fechaBaja IS NULL", 'ii', [$v['idAlumno'], $idSede]);
				foreach($respuesta[$k]['grupos'] as $kk => $grupo){
					$respuesta[$k]['grupos'][$kk]['horario'] = select_query($con, "SELECT h.dia, h.horaInicio, h.duracion FROM salon_grupo as sg LEFT JOIN horario as h ON sg.idSalonGrupo = h.idSalonGrupo WHERE sg.idGrupo = ? AND h.dia IS NOT NULL", 'i', [$grupo['idGrupo']]);
					$dias = [];
					foreach($respuesta[$k]['grupos'][$kk]['horario'] as $kkk => $horario){
						if(!in_array($horario['dia'], $dias)){
							$dias[] = $horario['dia'];
						}
					}
					sort($dias, SORT_NUMERIC);
					$respuesta[$k]['grupos'][$kk]['dias'] = $dias;
				}
			}
			
	json_echo($respuesta);
?>
