<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	session_start();
	if($_SESSION['idTipoUsuario']==2||$_SESSION['idTipoUsuario']==4){
		json_echo(select_query($con,
		"SELECT s.idSede, s.nombreSede, d.calle, d.numExterior, d.numInterior, d.colonia, d.dirCorta
			FROM admin_sede as ads
			LEFT JOIN sedes as s ON s.idSede = ads.idSede
			 LEFT JOIN direccioncompleta as d ON d.idDireccion = s.idDireccion
			 WHERE s.activo = 1 AND ads.idUsuario = ? ORDER BY s.nombreSede ASC", 'i', [$_SESSION['idUsuario']]));
	}else{
		json_echo(select_query($con,
		"SELECT s.idSede, s.nombreSede, d.calle, d.numExterior, d.numInterior, d.colonia, d.dirCorta
			FROM sedes as s
			 LEFT JOIN direccioncompleta as d ON d.idDireccion = s.idDireccion
			 WHERE s.activo = 1 ORDER BY s.nombreSede ASC"));
	}
?>
