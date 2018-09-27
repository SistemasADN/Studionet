<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array ();
  $rules['fechaInicial'] = 		["t"=>"date", "r"=>true];
  $rules['fechaFinal'] = 			["t"=>"date", "r"=>true];

	$validator->setRulesValidateArrayEcho($rules, $_POST, $_SESSION);
	include "dbcon.php";
  session_start();
	$respuesta = [];
	$idProfesor = select_query($con, "SELECT idPersonal FROM profesorcompleto WHERE idUsuario = ?", 'i', [$_SESSION['idUsuario']]);
	$_POST['idProfesor'] = $idProfesor[0]['idPersonal'];
	if($_SESSION['tipoUsuario']=="Soporte"){
		$respuesta = select_query($con,
					"SELECT aa.idAsistencia, g.nombreGrupo, CONCAT(a.nombreAsignatura, '-', n.nombreNivel) as nombreClase, aa.fecha,
					 pc.nombreProfesor
					 FROM asistencia as aa
					 LEFT JOIN grupos as g ON g.idGrupo = aa.idGrupo
					 LEFT JOIN grupo_profesor as gp ON gp.idGrupo = aa.idGrupo AND gp.principal = 1
					 LEFT JOIN profesorcompleto as pc ON pc.idPersonal = aa.idProfesor
					 LEFT JOIN asignaturas AS a ON g.idAsignatura = a.idAsignatura
					 LEFT JOIN niveles AS n ON g.idNivel = n.idNivel
					 WHERE gp.fechaBaja IS NULL AND aa.fecha BETWEEN ? AND ?",
					 'ss', reorder_array($_POST, ['fechaInicial', 'fechaFinal']));
	}else{
	if($_SESSION['esProfesorYUsuario']===false){
		$respuesta = select_query($con,
				"SELECT aa.idAsistencia, g.nombreGrupo, CONCAT(a.nombreAsignatura, '-', n.nombreNivel) as nombreClase, aa.fecha,
				 pc.nombreProfesor
				 FROM asistencia as aa
				 LEFT JOIN grupos as g ON g.idGrupo = aa.idGrupo
				 LEFT JOIN grupo_profesor as gp ON gp.idGrupo = aa.idGrupo AND gp.principal = 1
				 LEFT JOIN profesorcompleto as pc ON pc.idPersonal = aa.idProfesor
				 LEFT JOIN asignaturas AS a ON g.idAsignatura = a.idAsignatura
				 LEFT JOIN niveles AS n ON g.idNivel = n.idNivel
				 WHERE pc.idUsuario = '$_SESSION[idUsuario]' AND gp.fechaBaja IS NULL AND aa.fecha BETWEEN ? AND ?",
				 'ss', reorder_array($_POST, ['fechaInicial', 'fechaFinal']));
		}else{
			$respuesta = select_query($con,
					"SELECT aa.idAsistencia, g.nombreGrupo, CONCAT(a.nombreAsignatura, '-', n.nombreNivel) as nombreClase, aa.fecha,
					 pc.nombreProfesor
					 FROM asistencia as aa
					 LEFT JOIN grupos as g ON g.idGrupo = aa.idGrupo
					 LEFT JOIN grupo_profesor as gp ON gp.idGrupo = aa.idGrupo AND gp.principal = 1
					 LEFT JOIN profesorcompleto as pc ON pc.idPersonal = aa.idProfesor
					 LEFT JOIN asignaturas AS a ON g.idAsignatura = a.idAsignatura
					 LEFT JOIN niveles AS n ON g.idNivel = n.idNivel
					 WHERE gp.fechaBaja IS NULL AND aa.fecha BETWEEN ? AND ?",
					 'ss', reorder_array($_POST, ['fechaInicial', 'fechaFinal']));
		}
	}
		json_echo($respuesta);
?>
