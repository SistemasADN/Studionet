<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->enableEchos();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	include_once "getIdSede.php";
	json_echo(select_query($con,
"SELECT ep.idEgreso, e.fecha, ep.folio, pc.nombre, tp.tipo as tipoPersonal, ep.fechaInicio, ep.fechaFin, fp.formaPago, e.cantidad, e.aprobar
FROM egresos_personal as ep
LEFT JOIN egresos as e ON e.idEgreso = ep.idEgreso
LEFT JOIN forma_pago as fp ON fp.idFormaPago = e.idFormaPago
LEFT JOIN personal as p ON p.idPersonal = ep.idPersonal
LEFT JOIN personacompleta as pc ON p.idPersona = pc.idPersona
LEFT JOIN tipo_personal as tp ON tp.idTipoPersonal = p.idTipoPersonal
WHERE e.aprobar = 1 AND ep.folio IS NOT NULL AND e.idSede = ?",'i', [$idSede]));
?>
