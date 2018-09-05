<?php
	include "../validation/classValidator.php";
    //include '../mailer/randomLib.php';
	$validator = new Validator();
	//Reglas
    $_POST['fechaSelectText'] = date('Y-m-d', strtotime(str_replace("/", "-",$_POST['fechaSelectText'])));
	$rules = array ();
  //print_r($_POST);exit;16
	  $rules["idUsuario"] = 		      ['r' => true,  't' => "num"];
    $rules["idContacto"] =  	      ['r' => true,  't' => "num"];
    $rules["idDireccion"] =  	      ['r' => true,  't' => "num"];
    $rules["idPersona"] =  	        ['r' => true,  't' => "num"];
    $rules["nombre"] =              ['r' => true,  't' => "alphnum"];
    $rules["apellidoPaterno"] =     ['r' => true,  't' => "alphnum"];
    $rules["apellidoMaterno"] =     ['r' => false, 't' => "alphnum"];
    $rules["generoSearch"] =        ['r' => true,  't' => "num"];
    $rules["tipousuarioSearch"] =   ['r' => true,  't' => "num"];
    $rules["fechaSelectText"] =     ['r' => false, 't' => "date"];
    $rules["email"] =               ['r' => true,  't' => "email"];
    $rules["telCelular"] =          ['r' => true,  't' => "tel"];
    $rules["telCasa"] =             ['r' => false, 't' => "tel"];
    $rules["telOficina"] =          ['r' => false, 't' => "tel"];
    $rules["telOtro"] =             ['r' => false, 't' => "tel"];
    $rules["estatus"] =             ['r' => true,  't' => "bool"]; 
	//Direccion
  //print_r($rules); exit;
  //$rules = setDireccionRules($rules,$_POST);
	$validator->setRules($rules);
	include "dbcon.php";
    if(execute_query($con, "UPDATE personas SET nombre = ?, apellidoPaterno = ?, apellidoMaterno = ?, fechaNacimiento = ?, idGenero = ? WHERE idPersona = ?", "ssssii", reorder_array_keys($_POST, ['nombre', 'apellidoPaterno','apellidoMaterno', 'fechaSelectText', 'generoSearch', 'idPersona']))){
      if(execute_query($con, "UPDATE direccion SET calle = ?, numExterior = ?, numInterior = ?, cp = ?, idColonia = ? WHERE idDireccion = ?", "sssiii", reorder_array_keys($_POST, ['street', 'numExt','numInt', 'numInt', 'postalcodeSum', 'areaSum', 'idDireccion']))){
        if(execute_query($con, "UPDATE contacto SET email = ?, telCelular = ?, telCasa = ?, telOficina = ?, telOtro = ? WHERE idContacto = ?", "sssssi", reorder_array_keys($_POST, ['email', 'telCelular', 'telCasa', 'telOficina', 'telOtro', 'idContacto']))){
          if(execute_query($con, "UPDATE usuarios SET idTipoUsuario = ?, activo = ? WHERE idUsuario = ?", "iii", reorder_array_keys($_POST, ['tipousuarioSearch', 'estatus', 'idUsuario']))){
            echo "s|Editar Usuario|Usuario editado correctamente.";
          } else {
            echo "e|Editar Usuario|No se pudo editar el usuario. 1";
          }
        } else {
          echo "e|Editar Usuario|No se pudo editar el usuario. 2";
        }
      } else {
        echo "e|Editar Usuario|No se pudo editar el usuario. 3";
      }
    } else {
      echo "e|Editar Usuario|No se pudo editar el usuario. 4";
    }
?>