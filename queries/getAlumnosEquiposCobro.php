<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
  include 'getIdSede.php';
  $respuesta = select_query($con,
		"SELECT ae.idAlumno, pc.nombre as alumno FROM alumnos_equipos as ae
    LEFT JOIN alumnos as a ON a.idAlumno = ae.idAlumno
    LEFT JOIN personacompleta as pc ON pc.idPersona = a.idPersona
		LEFT JOIN forma_calculos_detalle as fd ON fd.idEquipo = ae.idEquipo
    WHERE ae.fechaBaja IS NULL AND fd.idEquipo IS NOT NULL GROUP BY (ae.idAlumno)");
  foreach($respuesta as $k=>$alumno){
      $respuesta[$k]['equipos'] = select_query($con,
      "SELECT ae.idEquipo, ae.usarCobro, e.nombreEquipo FROM alumnos_equipos as ae
      LEFT JOIN equipos as e ON e.idEquipo = ae.idEquipo
			LEFT JOIN forma_calculos_detalle as fd ON fd.idEquipo = ae.idEquipo
			WHERE ae.idAlumno = ? AND ae.fechaBaja IS NULL AND fd.idEquipo IS NOT NULL", 'i', [$alumno['idAlumno']]);
  }
  json_echo($respuesta);
?>
