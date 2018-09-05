<?php
	
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(select_query($con, 
              "SELECT 
                co.idColegio, 
                co.colegio, 
                co.activo,
                co.nombreContacto,
                co.correo,
                co.puesto,
                co.telefono,
                co.telefonoOtro,
                d.calle as calle, 
                d.numExterior as numExt, 
                d.numInterior as numInt, 
                d.cp as postalcodeSum, 
                d.idColonia as areaSum,
                cp.dirCorta,
                c.colonia 
	          FROM colegios as co 
	           LEFT JOIN direccion as d 
                ON d.idDireccion = co.idDireccion 
              LEFT JOIN direccion_cpep as cp 
                ON cp.CP = d.cp 
              LEFT JOIN direccion_colonia as c 
                ON c.idColonia = d.idColonia"));
?>