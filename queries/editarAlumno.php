<?php
	include "../validation/classValidator.php";
    //include '../mailer/randomLib.php';
	$validator = new Validator();
	//Regla
	$rules = array ();
    //var_dump($_POST);exit;
	$validator->enableEchos();
	$rules["idAlumno"] = 		          ['r' => true,  't' => "num"];
    $rules["idPersona"] =  	        ['r' => true,  't' => "num"];
    $rules["nombre"] = 		          ['r' => true,  't' => "alphnum"];
    $rules["apellidoPaterno"] =     ['r' => true,  't' => "alphnum"];
    $rules["apellidoMaterno"] =     ['r' => false, 't' => "alphnum"];
    $rules["generoSearch"] =	      ['r' => true,  't' => "num"];
    $rules["fechaSelect"] =         ['r' => true,  't' => "date"];
    $rules["email"] =               ['r' => false, 't' => "email"];
    $rules["clienteSearch"] =	      ['r' => true,  't' => "num"];
    $rules["colegioSearch"] =	      ['r' => false, 't' => "num"];
    $rules["gradoSearch"] =	        ['r' => false, 't' => "num"];
    $rules["estatus"] =             ['r' => true,  't' => "bool"];
    $rules["ca"] =                  ['r' => false,  't' => "num"];
    $rules["idSede"] =              ['r' => false,  't' => "num"];
    $rules["alergias"] =            ['r' => false,  't' => "alphnum"];
    $rules["enfermedades"] =        ['r' => false,  't' => "alphnum"];
    $rules["medicamentos"] =        ['r' => false,  't' => "alphnum"];
    $rules["contacto1"] =           ['r' => false,  't' => "alphnum"];
    $rules["telC1"] =               ['r' => false,  't' => "tel"];
    $rules["contacto2"] =           ['r' => false,  't' => "alphnum"];
    $rules["telC2"] =               ['r' => false,  't' => "tel"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
    if(execute_query($con, "UPDATE personas SET nombre = ?, apellidoPaterno = ?, apellidoMaterno = ?, fechaNacimiento = ?, idGenero = ?, alergias = ?, enfermedades = ?, medicamentos = ?, nombreC1 = ?, telC1 = ?, nombreC2 = ?, telC2 = ? WHERE idPersona = ?",
    "ssssisssssssi", reorder_array_keys($_POST, ['nombre', 'apellidoPaterno','apellidoMaterno', 'fechaSelect', 'generoSearch', 'alergias','enfermedades','medicamentos','contacto1','telC1','contacto2','telC2','idPersona']))){
      if(execute_query($con, "UPDATE alumnos SET email = ?, idPersona = ?, idTutor = ?, idColegio = ?, idGrado = ?, activo = ?, idSede = ? WHERE idAlumno = ?", "siiiiiii", reorder_array_keys($_POST, ['email', 'idPersona','clienteSearch', 'colegioSearch', 'gradoSearch', 'estatus', 'idSede', 'idAlumno']))){
        echo "s|Editar Alumno|Alumno editado correctamente. ";
      } else {
        echo "e|Editar Alumno|No se pudo editar el alumno. 1";
      }
    } else {
        echo "e|Editar Alumno|No se pudo editar el alumno. 2";
      }

?>
