<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
    //var_dump($_POST);exit;
    strtolower($_POST['correo']);
	$rules = direccion_rules($rules, "Sum");
	$rules["idColegio"] = 			  ['r' => true, 	't' => "num"];
	$rules["colegio"] = 			  ['r' => true, 	't' => "alphnum"];
    $rules["nombreContacto"] = 		  ['r' => false, 	't' => "alphnum"];
    $rules["correo"] = 				  ['r' => false, 	't' => "email"];
    $rules["puesto"] = 				  ['r' => false, 	't' => "alphnum"];
    $rules["telefono"] = 			  ['r' => false, 	't' => "tel"];
    $rules["telefonoOtro"] = 		  ['r' => false, 	't' => "tel"];
	$rules["estatus"] = 			  ['r' => true, 	't' => "bool"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	if($_POST['areaSum']==""){
		$_POST['areaSum']= 0;
	}
	if($_POST['postalcodeSum']==""){
		$_POST['postalcodeSum']= 0;
	}

	include_once "dbcon.php";//Conexion a la BD
	if(execute_query($con, "
      UPDATE
        colegios AS c,
        direccion AS d
      SET
		c.colegio = ?,
        c.activo = ?,
        c.nombreContacto = ?,
        c.correo = ?,
        c.puesto = ?,
        c.telefono = ?,
        c.telefonoOtro = ?,
		d.calle = ?,
        d.numExterior = ?,
        d.numInterior = ?,
        d.cp = ?,
        d.idColonia = ?
      WHERE
        c.idColegio = ? AND
        c.idDireccion = d.idDireccion",
		'sisssssssssii', reorder_array_keys($_POST, ['colegio', 'estatus','nombreContacto', 'correo', 'puesto', 'telefono', 'telefonoOtro', 'calle', 'numExt', 'numInt', 'postalcodeSum', 'areaSum', 'idColonia', 'idColegio']))){
		echo "s|Editar Colegio|Colegio editado correctamente. ";
	}else{
		echo "e|Editar Colegio|No se pudo editar el colegio. ";
	}
?>
