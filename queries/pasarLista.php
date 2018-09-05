<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules['idGrupo'] = ['r' => true , 	't' => "num"];
  $rules['fechaSelect'] = ['r' => true , 	't' => "date"];
  $listaAsistencia = $_POST['listaAsistencia'];
  unset($_POST['listaAsistencia']);
	$listaAsistenciaProfesor = $_POST['listaAsistenciaProfesor'];
	unset($_POST['listaAsistenciaProfesor']);
  $validator->setRulesValidateArrayEcho($rules, $_POST);
  $rules = array ();
	$rules['idAlumno'] =     ['r' => true , 	't' => "num"];
  $rules['asistencia'] =   ['r' => true , 	't' => "num"];
	foreach($listaAsistencia as $k=>$lista){
    $validator->setRulesValidateArrayEcho($rules, $lista);
  }

	$rules = array ();
	$rules['idProfesor'] =     ['r' => true , 	't' => "num"];
  $rules['asistencia'] =   ['r' => true , 	't' => "num"];
	foreach($listaAsistenciaProfesor as $k=>$lista){
    $validator->setRulesValidateArrayEcho($rules, $lista);
  }
	include "dbcon.php";
	session_start();
	$idProfesor = select_query($con, "SELECT idPersonal FROM profesorcompleto WHERE idUsuario = ?", 'i', [$_SESSION['idUsuario']]);
  $_POST['idProfesor'] = $idProfesor[0]['idPersonal'];

	$idAsistencia = insert_id_query($con, "INSERT INTO asistencia (idGrupo, fecha, idProfesor) VALUE (?,?,?)", 'isi', reorder_array($_POST, ['idGrupo', 'fechaSelect', 'idProfesor']));

  if($idAsistencia>0){
    foreach($listaAsistencia as $k=>$lista){
        $lista['idAsistencia'] = $idAsistencia;
        if(!execute_query($con, "INSERT INTO asistencia_alumno (idAsistencia, idAlumno, asistencia) VALUES (?,?,?)", 'iii', reorder_array($lista, ['idAsistencia', 'idAlumno', 'asistencia']), false)){
            echo "e|Pasar lista|No se pudo crear la lista de asistencia.";exit;
        }
    }
		foreach($listaAsistenciaProfesor as $k=>$lista){
        $lista['idAsistencia'] = $idAsistencia;
        if(!execute_query($con, "INSERT INTO asistencia_profesor (idAsistencia, idProfesor, asistencia) VALUES (?,?,?)", 'iii', reorder_array($lista, ['idAsistencia', 'idProfesor', 'asistencia']), false)){
            echo "e|Pasar lista|No se pudo crear la lista de asistencia de profesores.";exit;
        }
    }

      mysqli_commit($con);
      echo "s|Pasar lista|Registro de asistencias creado exitosamente.";
  }else{
      echo "e|Pasar lista|No se pudo crear el registro de asistencia.";
  }
?>
