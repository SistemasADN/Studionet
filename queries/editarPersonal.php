<?php
	include "../validation/classValidator.php";
    //include '../mailer/randomLib.php';
	$validator = new Validator();
	//Reglas
	$rules = array ();
    //var_dump($_POST);exit;
    $rules["idPersonal"] = 		    ['r' => true,  't' => "num"];
    $rules["idContacto"] =  	    ['r' => true,  't' => "num"];
    $rules["idDireccion"] =  	    ['r' => true,  't' => "num"];
    $rules["idFacturacion"] =  	    ['r' => true,  't' => "num"];
    $rules["idPersona"] =  	        ['r' => true,  't' => "num"];

    $rules["nombre"] = 		        ['r' => true,  't' => "alphnum"];
    $rules["apellidoPaterno"] =     ['r' => true,  't' => "alphnum"];
    $rules["apellidoMaterno"] =     ['r' => false, 't' => "alphnum"];
    $rules["generoSearch"] = 		['r' => true,  't' => "num"];
    $rules["fechaSelect"] =     ['r' => false, 't' => "date"];

    $rules["email"] =               ['r' => false, 't' => "email"];
    $rules["telCelular"] =          ['r' => true,  't' => "tel"];
    $rules["telCasa"] =             ['r' => false, 't' => "tel"];
    $rules["telOficina"] =          ['r' => false, 't' => "tel"];
    $rules["telOtro"] =             ['r' => false, 't' => "tel"];
    $rules["rfc"] =                 ['r' => false, 't' => "rfc"];

    $rules["tipoPersonalSearch"] =	['r' => true,  't' => "num"];
    $rules["modalidadPagoSearch"] =	['r' => true,  't' => "num"];
    $rules["formaPagoSearch"] =	    ['r' => true,  't' => "num"];

    $rules["sueldo"] =	            ['r' => true,  't' => "dec"];

    $rules["estatus"] =             ['r' => true, 't' => "bool"];

    $rules["alergias"] =            ['r' => false,  't' => "alphnum"];
    $rules["enfermedades"] =        ['r' => false,  't' => "alphnum"];
    $rules["medicamentos"] =        ['r' => false,  't' => "alphnum"];
    $rules["contacto1"] =           ['r' => false,  't' => "alphnum"];
    $rules["telC1"] =               ['r' => false,  't' => "tel"];
    $rules["contacto2"] =           ['r' => false,  't' => "alphnum"];
    $rules["telC2"] =               ['r' => false,  't' => "tel"];
	//Direccion
	$rules = setDireccionRules($rules, "Sum");
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
    if(execute_query($con, "UPDATE personas SET nombre = ?, apellidoPaterno = ?, apellidoMaterno = ?, fechaNacimiento = ?, idGenero = ?, alergias = ?, enfermedades = ?, medicamentos = ?, nombreC1 = ?, telC1 = ?, nombreC2 = ?, telC2 = ? WHERE idPersona = ?", "ssssisssssssi", reorder_array_keys($_POST, ['nombre', 'apellidoPaterno','apellidoMaterno', 'fechaSelect', 'generoSearch', 'alergias', 'enfermedades', 'medicamentos', 'contacto1', 'telC1', 'contacto2', 'telC2', 'idPersona']))){
      if(execute_query($con, "UPDATE direccion SET calle = ?, numExterior = ?, numInterior = ?, cp = ?, idColonia = ? WHERE idDireccion = ?", "sssiii", reorder_array_keys($_POST, ['calle', 'numExt','numInt', 'numInt', 'postalcodeSum', 'areaSum', 'idDireccion']))){
        if(execute_query($con, "UPDATE contacto SET email = ?, telCelular = ?, telCasa = ?, telOficina = ?, telOtro = ? WHERE idContacto = ?", "sssssi", reorder_array_keys($_POST, ['email', 'telCelular', 'telCasa', 'telOficina', 'telOtro', 'idContacto']))){
          if(execute_query($con, "UPDATE facturacion SET RFC = ? WHERE idFacturacion = ?", "si", reorder_array_keys($_POST, ['rfc', 'idFacturacion']))){
            if(execute_query($con, "UPDATE personal SET idTipoPersonal = ?, idFormaPago = ?, idModalidadPago = ?, sueldo = ?, activo = ? WHERE idPersonal = ?", "iiisii", reorder_array_keys($_POST, ['tipoPersonalSearch', 'formaPagoSearch', 'modalidadPagoSearch', 'sueldo', 'estatus', 'idPersonal']))){
              echo "s|Editar Personal|Personal editado correctamente.";
            } else {
              echo "e|Editar Personal|No se pudo editar el personal. 1";
            }
          } else {
            echo "e|Editar Personal|No se pudo editar el personal. 2";
          }
        } else {
          echo "e|Editar Personal|No se pudo editar el personal. 3";
        }
      } else {
        echo "e|Editar Personal|No se pudo editar el personal. 4";
      }
    } else {
      echo "e|Editar Personal|No se pudo editar el personal. 5";
    }
?>
