<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
    //var_dump($_POST);exit;
	$rules['nombreEquipo'] =      ['r' => true , 	't' => "alphnum"];
    $rules['sedeSearch'] =     ['r' => true , 	't' => "num"];
    $rules['profesorSearch'] =     ['r' => true , 	't' => "num"];

    $validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";

    $_POST['idEquipo'] = insert_id_query($con, "INSERT INTO equipos (nombreEquipo, idSede, idProfesor) VALUES (?,?,?)", 'sii', reorder_array($_POST, ['nombreEquipo', 'sedeSearch', 'profesorSearch']));
    if($_POST['idEquipo']!=0){
      if(insert_query($con, "INSERT INTO equipos_historico (idEquipo, nombreEquipo, idProfesor, fecha) VALUES (?,?,?,CURDATE())", 'isi', reorder_array_keys($_POST, ['idEquipo', 'nombreEquipo', 'profesorSearch']))){
        echo "s|Agregar Equipo|Equipo agregado correctamente. ";
      } else {
        echo "e|Agregar Equipo|No se pudo agregar el equipo. 1";
      }
    } else{
		echo "e|Agregar Equipo|No se pudo agregar el equipo. 2";
	}
?>
