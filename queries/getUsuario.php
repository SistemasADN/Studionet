<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(select_query($con, "
      SELECT
        u.idUsuario,
        u.idPersona,
        u.idContacto,
        u.idDireccion,
        u.activo,
				u.pollito,
        u.idTipoUsuario,
        tu.nombreTipo as tipoUsuario,
        p.nombre,
        p.apellidoPaterno,
        p.apellidoMaterno,
        p.fechaNacimiento,
        p.idGenero,
        g.genero,
        co.email,
        co.telCelular,
        co.telCasa,
        co.telOficina,
        co.telOtro,
        d.calle as calle,
        d.numExterior as numExt,
        d.numInterior as numInt,
        d.cp as postalcodeSum,
        d.idColonia as areaSum,
	    cp.dirCorta,
	    col.colonia
	FROM
      usuarios as u
      LEFT JOIN tipo_usuario as tu
        ON u.idTipoUsuario = tu.idTipoUsuario
      LEFT JOIN personas as p
        ON u.idPersona = p.idPersona
      LEFT JOIN generos as g
        ON p.idGenero = g.idGenero
      LEFT JOIN contacto as co
        ON u.idContacto = co.idContacto
	  LEFT JOIN direccion as d
        ON d.idDireccion = u.idDireccion
      LEFT JOIN direccion_cpep as cp
        ON cp.CP = d.cp
      LEFT JOIN direccion_colonia as col
        ON col.idColonia = d.idColonia WHERE u.idTipoUsuario <> 5"));
?>
