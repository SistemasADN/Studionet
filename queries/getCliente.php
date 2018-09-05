<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(select_query($con, "
      SELECT
        c.idCliente,
        c.idPersona,
        c.idFacturacion,
	    c.idPrefijo,
        c.idContacto,
        c.activo as estatus,
        p.nombre,
        p.apellidoPaterno,
        p.apellidoMaterno,
        p.fechaNacimiento,
        p.idGenero,
        g.genero,
        f.idDireccion,
        f.rfc,
        pr.prefijo,
        co.email,
        co.telCelular,
        co.telCasa,
        co.telOficina,
        co.telOtro,
        (SELECT COUNT(idAlumno) FROM alumnos AS a WHERE a.idTutor = c.idCliente GROUP BY c.idCliente) AS numAlumnos,
        d.calle as calle,
        d.numExterior as numExt,
        d.numInterior as numInt,
        d.cp as postalcodeSum,
        d.idColonia as areaSum,
	    cp.dirCorta,
	    col.colonia,
			s.idSede,
			s.nombreSede as sede
	FROM
      clientes as c
      LEFT JOIN personas as p
        ON c.idPersona = p.idPersona
      LEFT JOIN generos as g
        ON p.idGenero = g.idGenero
      LEFT JOIN facturacion as f
        ON c.idFacturacion = f.idFacturacion
      LEFT JOIN prefijos as pr
        ON c.idPrefijo = pr.idPrefijo
      LEFT JOIN contacto as co
        ON c.idContacto = co.idContacto
	  LEFT JOIN direccion as d
        ON d.idDireccion = f.idDireccion
      LEFT JOIN direccion_cpep as cp
        ON cp.CP = d.cp
      LEFT JOIN direccion_colonia as col
        ON col.idColonia = d.idColonia
			LEFT JOIN sedes as s ON s.idSede = c.idSede"));
?>
