<?php
  	include "../validation/classValidator.php";
  	$validator = new Validator();
  	//Reglas
  	$rules = array ();
    $rules['idGradoOrigen']   =   ['t'=>'num','r'=>true];
    $rules['idGradoDestino']  =   ['t'=>'num','r'=>true];
    
    if(!isset($_POST['listaGrados'])){
        exit;
    }

    foreach($_POST['listaGrados'] as $value){
        $validator->setRulesValidateArrayEcho($rules, $value);
    }
  	include "dbcon.php";
    mysqli_autocommit($con, FALSE);
    foreach($_POST['listaGrados'] as $lista){
        $alumnos[$lista['idGradoOrigen']] = select_query($con, "SELECT idAlumno FROM alumnos WHERE idGrado = ?", 'i', [$lista['idGradoOrigen']]);
    }
    foreach($_POST['listaGrados'] as $lista){
      foreach($alumnos[$lista['idGradoOrigen']] as $alumno){

        if(!execute_query($con, "UPDATE alumnos SET idGrado = ? WHERE idAlumno = ?", 'ii', [$lista['idGradoDestino'], $alumno['idAlumno']], false)){
            echo "e|Cambiar Alumnos de Grado|No se pudo cambiar los alumnos de grado.";exit;
        }
        /**/
      }
    }
    echo "s|Cambiar Alumnos de Grado|Se han cambiado los alumnos de grado exitosamente.";
    mysqli_commit($con);
?>
