<?php
	include "../validation/classValidator.php";
    include '../mailer/randomLib.php';
    include '../mailer/emailFunctions.php';
	$validator = new Validator();
	//Reglas
	$rules = array ();
    //var_dump($_POST);exit;
    $rules["nombre"] = 		        ['r' => true,  't' => "alphnum"];
    $rules["apellidoPaterno"] =     ['r' => true,  't' => "alphnum"];
    $rules["apellidoMaterno"] =     ['r' => false, 't' => "alphnum"];
    $rules["generoSearch"] = 		['r' => true,  't' => "num"];
    $rules["fechaSelect"] =     ['r' => true, 't' => "date"];
    $rules["tipousuarioSearch"] =   ['r' => true, 't' => "num"];
    $rules["email"] =               ['r' => true, 't' => "email"];
    $rules["telCelular"] =          ['r' => true,  't' => "tel"];
    $rules["telCasa"] =             ['r' => false, 't' => "tel"];
    $rules["telOficina"] =          ['r' => false, 't' => "tel"];
    $rules["telOtro"] =             ['r' => false, 't' => "tel"];
	//Direccion
	$rules = setDireccionRules($rules, "Sum");
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
    $_POST['idDireccion'] = insert_direccion($con, $_POST);
    if($_POST['idDireccion']!=0){
      $_POST['idPersona'] = insert_id_query($con, "INSERT INTO personas (nombre, apellidoPaterno, apellidoMaterno, fechaNacimiento, idGenero) VALUES (?,?,?,?,?)", 'ssssi', reorder_array($_POST, ['nombre', 'apellidoPaterno', 'apellidoMaterno', 'fechaSelect', 'generoSearch']));
      if($_POST['idPersona']!=0){
        $_POST['idContacto'] = insert_id_query($con, "INSERT INTO contacto (email, telCelular, telCasa, telOficina, telOtro) VALUES (?,?,?,?,?)", 'sssss', reorder_array($_POST, ['email', 'telCelular', 'telCasa', 'telOficina', 'telOtro']));
        if($_POST['idContacto']!=0){
          $randomLib = new randomLib();
          $randomLib->add_allow_alphnum();
          $_POST['pollito'] = $randomLib->generateString(10);
          if(insert_query($con, "INSERT INTO usuarios (idPersona, idTipoUsuario, idContacto, idDireccion, pollito) VALUES (?,?,?,?,?)", "iiiis", reorder_array_keys($_POST, ['idPersona','tipousuarioSearch', 'idContacto', 'idDireccion', 'pollito']))){
            $mailer = new emailFunctions();
            //if($mailer->sendNewUserEmail($_POST['email'], $_POST['pollito'])){
						if(true){
              echo "s|Agregar Usuario|Usuario agregado correctamente.";//" Se le ha enviado un correo con su contraseña al usuario.";
            } else {
            	echo "e|Agregar Usuario|No se pudo agregar cliente. 5 ";
            }
        } else {
            echo "e|Agregar Usuario|No se pudo agregar el usuario. 4";
          }
      } else {
          echo "e|Agregar Usuario|No se pudo agregar el usuario. 3";
        }
    } else {
        echo "e|Agregar Usuario|No se pudo agregar el usuario. 2";
      }
    } else {
      echo "e|Agregar Usuario|No se pudo agregar el usuario. 1";
    }
?>
