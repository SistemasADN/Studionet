<?php
	include "../validation/classValidator.php";
    //include '../mailer/randomLib.php';
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules["idCliente"] = 		    ['r' => true,  't' => "num"];
    $rules["idContacto"] =  	    ['r' => true,  't' => "num"];
    $rules["idDireccion"] =  	    ['r' => true,  't' => "num"];
    $rules["idFacturacion"] =  	    ['r' => true,  't' => "num"];
    $rules["idPersona"] =  	        ['r' => true,  't' => "num"];
    $rules["idPrefijo"] =  	        ['r' => true,  't' => "num"];
    $rules["numAlumnos"] = 	        ['r' => true,  't' => "num"];
    $rules["nombre"] = 		        ['r' => true,  't' => "alphnum"];
    $rules["apellidoPaterno"] =     ['r' => true,  't' => "alphnum"];
    $rules["apellidoMaterno"] =     ['r' => false, 't' => "alphnum"];
    $rules["idGenero"] = 		    ['r' => true,  't' => "num"];
    $rules["fechaSelect"] =     ['r' => false, 't' => "date"];
    $rules["email"] =               ['r' => false, 't' => "email"];
    $rules["telCelular"] =          ['r' => true,  't' => "tel"];
    $rules["telCasa"] =             ['r' => false, 't' => "tel"];
    $rules["telOficina"] =          ['r' => false, 't' => "tel"];
    $rules["telOtro"] =             ['r' => false, 't' => "tel"];
    $rules["rfc"] =                 ['r' => false, 't' => "rfc"];
    $rules["estatus"] =             ['r' => true, 't' => "bool"];
		$rules["idSede"] =             ['r' => true, 't' => "num"];

	//Direccion
	$rules = setDireccionRules($rules, "Sum");
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
    if(execute_query($con, "UPDATE personas SET nombre = ?, apellidoPaterno = ?, apellidoMaterno = ?, fechaNacimiento = ?, idGenero = ? WHERE idPersona = ?", "ssssii", reorder_array_keys($_POST, ['nombre', 'apellidoPaterno','apellidoMaterno', 'fechaSelect', 'idGenero', 'idPersona']))){
      if(execute_query($con, "UPDATE direccion SET calle = ?, numExterior = ?, numInterior = ?, cp = ?, idColonia = ? WHERE idDireccion = ?", "sssiii", reorder_array_keys($_POST, ['calle', 'numExt','numInt', 'numInt', 'postalcodeSum', 'areaSum', 'idDireccion']))){
        if(execute_query($con, "UPDATE clientes SET idPrefijo = ?, activo = ?, idSede = ? WHERE idCliente = ?", "iiii", reorder_array_keys($_POST, ['idPrefijo', 'estatus', 'idSede', 'idCliente']))){
          if(execute_query($con, "UPDATE contacto SET email = ?, telCelular = ?, telCasa = ?, telOficina = ?, telOtro = ? WHERE idContacto = ?", "sssssi", reorder_array_keys($_POST, ['email', 'telCelular', 'telCasa', 'telOficina', 'telOtro', 'idContacto']))){
            if(execute_query($con, "UPDATE facturacion SET RFC = ? WHERE idFacturacion = ?", "si", reorder_array_keys($_POST, ['rfc', 'idFacturacion']))){
              echo "s|Editar Cliente|Cliente editado correctamente.";
            } else {
              echo "e|Editar Cliente|No se pudo editar cliente. 1";
            }
          } else {
            echo "e|Editar Cliente|No se pudo editar cliente. 2";
          }
        } else {
          echo "e|Editar Cliente|No se pudo editar cliente. 3";
        }
      } else {
        echo "e|Editar Cliente|No se pudo editar cliente. 4";
      }
    } else {
      echo "e|Editar Cliente|No se pudo editar cliente. 5";
    }
?>
