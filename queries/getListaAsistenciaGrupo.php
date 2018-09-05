<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
  //$_POST['fechaInicial'] ='2017-08-01';$_POST['fechaFinal'] = '2017-12-31';
	$rules = array ();
  $rules['fechaInicial'] = 		["t"=>"date", "r"=>true];
  $rules['fechaFinal'] = 			["t"=>"date", "r"=>true];
	$rules['idGrupo'] = 				["t"=>"num", "r"=>true];
	$rules['tipo'] = 						["t"=>"alpha", "r"=>true];
	//getDebuggingInfo(true);
	//$_POST['fechaInicial'] = 	'2018-01-01'; $_POST['fechaFinal'] = 		'2018-01-31'; $_POST['idGrupo'] = 			'4'; $_POST['tipo'] = "alumno";
	$validator->setRulesValidateArrayEcho($rules, $_POST);
  //$_POST['idProfesor'] = 6;
	$data = [];
	include "dbcon.php";
	if($_POST['tipo']=='alumno'){
			for($i=0;$i<=2;$i++){
					$respuesta = select_query($con,
						"SELECT al.idAlumno, pc.nombre as alumno, IFNULL(COUNT(aa.idAsistencia),0) as total, aa.asistencia FROM alumnos as al
						LEFT JOIN personacompleta as pc ON pc.idPersona = al.idPersona
						LEFT JOIN asistencia_alumno as aa ON al.idAlumno = aa.idAlumno
						LEFT JOIN asistencia as a ON aa.idAsistencia = a.idAsistencia
						WHERE aa.asistencia = $i AND a.idGrupo = ? AND a.fecha BETWEEN ? AND ? GROUP BY (al.idAlumno)",
						 'iss', reorder_array($_POST, ['idGrupo', 'fechaInicial', 'fechaFinal']));
						 //var_dump($respuesta);
						 foreach($respuesta as $valor){
							 if(!isset($data[$valor['idAlumno']])){
								 $data[$valor['idAlumno']] = [];
							 }
							 if(!isset($data[$valor['idAlumno']][strval($valor['asistencia'])])){
								 	$data[$valor['idAlumno']][strval($valor['asistencia'])] = $valor['total'];
							 }
							 $data[$valor['idAlumno']]['alumno'] = $valor['alumno'];
						 }
			}
			//var_dump($data);
			$send = [];
			foreach($data as $idAlumno => $datos){
				$datos['idAlumno'] = $idAlumno;
				$send[] = $datos;
			}
	}else if($_POST['tipo']=='profesor'){
			for($i=0;$i<=2;$i++){
					$respuesta = select_query($con,
						"SELECT aa.idProfesor, pc.nombre as profesor, IFNULL(COUNT(aa.idAsistencia),0) as total, aa.asistencia
						FROM asistencia_profesor as aa
						LEFT JOIN personal as p ON p.idPersonal = aa.idProfesor
						LEFT JOIN personacompleta as pc ON pc.idPersona = p.idPersona
						LEFT JOIN asistencia as a ON aa.idAsistencia = a.idAsistencia
						WHERE aa.asistencia = $i AND a.idGrupo = ? AND a.fecha BETWEEN ? AND ? GROUP BY (aa.idProfesor)",
						 'iss', reorder_array($_POST, ['idGrupo', 'fechaInicial', 'fechaFinal']));
						 foreach($respuesta as $valor){
							 if(!isset($data[$valor['idProfesor']])){
								 $data[$valor['idProfesor']] = [];
							 }
							 if(!isset($data[$valor['idProfesor']][$valor['asistencia']])){
									$data[$valor['idProfesor']][$valor['asistencia']] = $valor['total'];
							 }
							 $data[$valor['idProfesor']]['profesor'] = $valor['profesor'];
						 }
			}
			$send = [];
			foreach($data as $idProfesor => $datos){
				$datos['idProfesor'] = $idProfesor;
				$send[] = $datos;
			}
	}
	json_echo($send);
?>
