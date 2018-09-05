<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
  $usuarios = array();

  $res = select_query($con, "
  SELECT u.idUsuario as idAdmin, vp.nombre as nombreAdmin, tu.nombreTipo
  FROM usuarios as u
  LEFT JOIN personas AS p ON p.idPersona = u.idPersona
  LEFT JOIN personacompleta AS vp ON vp.idPersona = p.idPersona
  LEFT JOIN tipo_usuario as tu ON tu.idTipoUsuario = u.idTipoUsuario
  WHERE  (tu.nombreTipo = 'Administrador' OR tu.nombreTipo = 'Administrador Senior') AND u.activo = 1
  GROUP BY u.idUsuario");

  foreach($res as $k=>$v){
    $idAdmin = $v['idAdmin'];
    $res[$k]['sedes'] = format_respuesta_checkbox(select_query($con, "SELECT idSede FROM admin_sede WHERE idUsuario = ?", 'i', [$idAdmin]));
  }

  json_echo($res);


?>
