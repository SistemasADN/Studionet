<?php

	include "../validation/classValidator.php";
  if($_POST['asistenciaOriginal']==$_POST['asistenciaActual']){
      echo "e|Cambiar Asistencia|La asistencia que desea cambiar debe ser diferente a la original.";exit;
  }

	$validator = new Validator();
	$rules = array ();

  if($_POST['idAsistenciaAlumno']==""){
    $rules['idAsistenciaAlumno'] =      ['r' => false , 	't' => "num"];
    $rules['idAsistenciaProfesor'] =    ['r' => true , 	't' => "num"];
  }else if($_POST['idAsistenciaProfesor']==""){
    $rules['idAsistenciaAlumno'] =      ['r' => true , 	't' => "num"];
    $rules['idAsistenciaProfesor'] =    ['r' => false , 	't' => "num"];
  }else{
      echo "e|Cambiar Asistencia|Hubo un error al cambiar la asistencia.";exit;
  }
  $rules['asistenciaOriginal'] =      ['r' => true , 	't' => "num"];
  $rules['asistenciaActual'] =        ['r' => true , 	't' => "num"];
  $rules['motivo'] =                  ['r' => true , 	't' => "alphnum"];
  $validator->setRulesValidateArrayEcho($rules, $_POST);
  include "dbcon.php";

  mysqli_autocommit($con, FALSE);
  if($_POST['idAsistenciaAlumno']==""){
    $table = 'profesor'; $table2 = 'Profesor'; $_POST['idAsistenciaAlumno'] = null;
  }else if($_POST['idAsistenciaProfesor']==""){
    $table = 'alumno'; $table2 = 'Alumno'; $_POST['idAsistenciaProfesor'] = null;
  }

  if(!execute_query($con, "UPDATE asistencia_".$table." SET asistencia = ? WHERE idAsistencia".$table2." = ?",
   'ii', [$_POST['asistenciaActual'], $_POST['idAsistencia'.$table2]], false)){
        echo "e|Cambiar Asistencia|Ha ocurrido un error al cambiar la asistencia.";exit;
  }
  session_start();
  if(execute_query($con, "INSERT INTO asistencia_cambio
    (idAsistenciaAlumno, idAsistenciaProfesor, asistenciaOriginal, asistenciaActual, fecha, motivo, idUsuario)
    VALUES (?,?,?,?,?,?,?)", 'iiiissi',
    [$_POST['idAsistenciaAlumno'], $_POST['idAsistenciaProfesor'], $_POST['asistenciaOriginal'], $_POST['asistenciaActual'],
       date("Y-m-d"), $_POST['motivo'], $_SESSION['idUsuario']], false)){
        echo "s|Cambiar Asistencia|Se ha cambiado la asistencia correctamente.";
        mysqli_commit($con);
    }else{
        echo "e|Cambiar Asistencia|No se ha podido crear el registro de cambio de asistencia.";
    }
?>
