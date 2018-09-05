<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules = direccion_rules($rules, "Sum");
	$rules["idSede"] = 					['r' => true, 	't' => "num"];
	$rules["nombreSede"] = 				['r' => true, 	't' => "alphnum"];
	$rules["estatus"] = 					['r' => true, 	't' => "bool"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);	
	if($_POST['areaSum']==""){
		$_POST['areaSum'] = 0;
	}
	if($_POST['postalcodeSum']==""){
		$_POST['postalcodeSum'] = 0;
	}
	include_once "dbcon.php";//Conexion a la BD
	if(execute_query($con, "
      UPDATE
        sedes AS e,
        direccion AS d
      SET
		e.nombreSede = ?,
        e.activo = ?,
		d.calle = ?,
        d.numExterior = ?,
        d.numInterior = ?,
        d.cp = ?,
        d.idColonia = ?
      WHERE
        e.idSede = ? AND
        e.idDireccion = d.idDireccion",
		'sisssssi', reorder_array_keys($_POST, ['nombreSede', 'estatus', 'calle', 'numExt', 'numInt', 'postalcodeSum', 'areaSum', 'idSede']))){
		echo "s|Editar Sede|Sede editado correctamente. ";
	}else{
		echo "e|Editar Sede|No se pudo editar el sede. ";
	}
?>
