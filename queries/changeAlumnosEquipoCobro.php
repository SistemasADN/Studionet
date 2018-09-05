<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
  $rules['idEquipo'] = ['t'=>'num', 'r'=>true];
  $rules['idAlumno'] = ['t'=>'num', 'r'=>true];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
  $uC = select_query_one($con, "SELECT usarCobro FROM alumnos_equipos
     WHERE idAlumno = ? AND idEquipo = ? AND fechaBaja IS NULL", 'ii', [$_POST['idAlumno'], $_POST['idEquipo']]);

  execute_query($con, "UPDATE alumnos_equipos SET usarCobro = 0 WHERE idAlumno = ?", 'i', [$_POST['idAlumno']], false)
  or die ("e|Cambiar Equipo|No se pudo cambiar el equipo de cobro.");

  if($uC['usarCobro']===1) {
    $message = "s|Cambiar Equipo|Se ha desactivado el cobro de este equipo para el alumno seleccionado.";
  }else{
    execute_query($con, "UPDATE alumnos_equipos SET usarCobro = 1
    WHERE idAlumno = ? AND idEquipo = ? AND fechaBaja IS NULL", 'ii', [$_POST['idAlumno'], $_POST['idEquipo']])
    or die ("e|Cambiar Equipo|No se pudo cambiar el equipo de cobro.");
    $message = "s|Cambiar Equipo|Se ha activado el cobro de este equipo para el alumno seleccionado.";
  }
  echo $message;
  mysqli_commit($con);
?>
