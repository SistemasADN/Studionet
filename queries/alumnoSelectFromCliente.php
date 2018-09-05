<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
  $rules['idCliente'] = ['r'=>true, 't'=>'num'];

  $validator->setRulesValidateArrayEcho($rules, $_POST);
  include "dbcon.php";
  json_echo(format_respuesta_select(select_query($con, "SELECT idAlumno as id, CONCAT(p.nombre,' ',p.apellidoPaterno, ' ', p.apellidoMaterno) as value
  FROM alumnos AS a LEFT JOIN personas AS p ON a.idPersona = p.idPersona WHERE a.idTutor = ?", 'i', $_POST)));

?>
