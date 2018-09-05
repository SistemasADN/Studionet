<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
    //var_dump($_POST);exit;
	$rules['nombreEquipo'] =      ['r' => true , 	't' => "alphnum"];
    $rules['idEquipo'] =          ['r' => true , 	't' => "num"];
    $rules['idSede'] =     ['r' => true , 	't' => "num"];
    $rules['idProfesor'] =     ['r' => true , 	't' => "num"];
    $rules['estatus'] =           ['r' => true ,    't' => "bool"];
    $rules['nombre'] =            ['r' => false ,    't' => "alphnum"];
    $rules['apellidoPaterno'] =   ['r' => false ,    't' => "alphnum"];
    $rules['apellidoMaterno'] =   ['r' => false ,    't' => "alphnum"];
    $validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
    if(execute_query(
      $con,
      "UPDATE equipos
        SET
          nombreEquipo = ?,
          idSede = ?,
          idProfesor = ?,
          activo = ?
        WHERE idEquipo = ?",
        'siiii',
      reorder_array_keys($_POST, ['nombreEquipo', 'idSede', 'idProfesor', 'estatus', 'idEquipo']))){
      echo "s|Editar Equipo|Equipo editado correctamente. ";
    } else {
      echo "e|Editar Equipo|No se pudo editar el equipo. 1";
    }
?>
