<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(select_query($con, "SELECT s.idSede, s.nombreSede, d.calle, d.numExterior, d.numInterior, d.colonia, d.dirCorta
		FROM sedes as s LEFT JOIN direccioncompleta as d ON d.idDireccion = s.idDireccion WHERE s.activo = 1 ORDER BY s.nombreSede ASC"));
?>
