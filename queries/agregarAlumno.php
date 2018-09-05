<?php
	include "../validation/classValidator.php";
    include '../mailer/randomLib.php';
	$validator = new Validator();
	//Reglas
	$rules = array ();
    //var_dump($_POST);exit;
    $rules["nombre"] = 		          ['r' => true,  't' => "alphnum"];
    $rules["apellidoPaterno"] =     ['r' => true,  't' => "alphnum"];
    $rules["apellidoMaterno"] =     ['r' => false, 't' => "alphnum"];
    $rules["generoSearch"] = 		    ['r' => true,  't' => "num"];
    $rules["fechaSelect"] =         ['r' => false, 't' => "date"];
    $rules["email"] =               ['r' => false, 't' => "email"];
    $rules["clienteSearch"] =       ['r' => true,  't' => "num"];
    $rules["colegioSearch"] =       ['r' => false,  't' => "num"];
    $rules["gradoSearch"] =         ['r' => false,  't' => "num"];
    $rules["alergias"] =            ['r' => false,  't' => "alphnum"];
    $rules["enfermedades"] =        ['r' => false,  't' => "alphnum"];
    $rules["medicamentos"] =        ['r' => false,  't' => "alphnum"];
    $rules["contacto1"] =           ['r' => false,  't' => "alphnum"];
    $rules["telC1"] =               ['r' => false,  't' => "tel"];
    $rules["contacto2"] =           ['r' => false,  't' => "alphnum"];
    $rules["telC2"] =               ['r' => false,  't' => "tel"];
  $validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	include "getIdSede.php";
	if($idSede==-1){
		$idSede = null;
	}
    $_POST['idPersona'] = insert_id_query($con, "INSERT INTO personas (nombre, apellidoPaterno, apellidoMaterno, fechaNacimiento, idGenero, alergias, enfermedades, medicamentos, nombreC1, telC1, nombreC2, telC2)
                           VALUES (?,?,?,?,?,?,?,?,?,?,?,?)", 'ssssisssssss', reorder_array($_POST, ['nombre', 'apellidoPaterno', 'apellidoMaterno', 'fechaSelect', 'generoSearch','alergias','enfermedades','medicamentos','contacto1','telC1','contacto2','telC2']));
    if($_POST['idPersona']!=0) {
      if(execute_query($con, "INSERT INTO alumnos (email, idPersona, idTutor, idColegio, idGrado, idSede) VALUES (?,?,?,?,?,?)", "siiiii", [$_POST['email'], $_POST['idPersona'], $_POST['clienteSearch'], $_POST['colegioSearch'], $_POST['gradoSearch'], $idSede])) {
        echo "s|Agregar Alumno|Alumno agregado correctamente.";
				mysqli_commit($con);
      } else {
        echo "e|Agregar Alumno|No se pudo agregar el alumno. 1";
      }
    } else {
      echo "e|Agregar Alumno|No se pudo agregar el alumno. 2";
    }
?>
