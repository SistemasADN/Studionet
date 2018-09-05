<?php
	//$_POST['idCliente'] = 12;
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	include "getIdSede.php";
	$data = select_query($con,
	'SELECT pl.idPersonal as id, vp.nombre as value, tp.tipo as subtext,
	f.idFormaPago, m.idModalidadPago, pl.sueldo as cantidad
	from personal as pl
	left join forma_pago as f ON f.idFormaPago = pl.idFormaPago
	left join modalidad_pago as m ON m.idModalidadPago = pl.idModalidadPago
	left join personacompleta as vp ON pl.idPersona = vp.idPersona
	left join tipo_personal as tp ON tp.idTipoPersonal = pl.idTipoPersonal
	where pl.activo = 1');//
	foreach($data as $k=>$value){
		$data[$k]['esProfesor'] = $value['subtext']=="Profesor"?true:false;
	}
	
	json_echo(format_respuesta_select($data));
?>
