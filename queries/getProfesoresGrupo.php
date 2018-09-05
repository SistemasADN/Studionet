<?php
	//$_POST['idCliente'] = 12;
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
  $rules['idGrupo'] = ['t'=>'num', 'r'=>true];
  //$validator->enableEchos();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(select_query($con,
	'SELECT g.idProfesor, g.idGrupo, pc.nombre as profesor, g.principal
   FROM grupo_profesor as g
      LEFT JOIN personal as p ON p.idPersonal = g.idProfesor
      LEFT JOIN personacompleta as pc ON p.idPersona = pc.idPersona
      LEFT JOIN tipo_personal as tp ON tp.idTipoPersonal = p.idTipoPersonal
    WHERE tp.tipo = "Profesor" AND p.activo = 1 AND g.idGrupo = ? AND g.fechaBaja IS NULL', 'i', $_POST));//
?>
