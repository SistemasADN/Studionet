<?php
	
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(select_query($con, "
      SELECT 
        p.idPersonal, 
        p.idPersona, 
        p.idFacturacion,
        p.idTipoPersonal,
        p.idFormaPago,
        p.idContacto,
        p.idModalidadPago,
        p.sueldo,
        p.activo,
        ps.nombre,
        ps.apellidoPaterno,
        ps.apellidoMaterno,
        ps.fechaNacimiento,
        ps.idGenero,
        ps.alergias,
        ps.enfermedades,
        ps.medicamentos,
        ps.nombreC1 as contacto1,
        ps.telC1,
        ps.nombreC2 as contacto2,
        ps.telC2,         
        g.genero,
        f.idDireccion,
        f.rfc,
        tp.tipo as tipoPersonal,
        fp.formaPago,
        co.email,
        co.telCelular,
        co.telCasa,
        co.telOficina,
        co.telOtro,
        mp.modalidad,
        d.calle as calle, 
        d.numExterior as numExt, 
        d.numInterior as numInt, 
        d.cp as postalcodeSum, 
        d.idColonia as areaSum,
	    cp.dirCorta,
	    col.colonia 
	FROM 
      personal as p 
      LEFT JOIN personas as ps
        ON p.idPersona = ps.idPersona
      LEFT JOIN generos as g
        ON ps.idGenero = g.idGenero
      LEFT JOIN facturacion as f
        ON p.idFacturacion = f.idFacturacion
      LEFT JOIN tipo_personal AS tp
        ON p.idTipoPersonal = tp.idTipoPersonal
      LEFT JOIN forma_pago AS fp
        ON p.idFormaPago = fp.idFormaPago
      LEFT JOIN modalidad_pago AS mp
        ON p.idModalidadPago = mp.idModalidadPago
      LEFT JOIN contacto as co
        ON p.idContacto = co.idContacto
	  LEFT JOIN direccion as d 
        ON d.idDireccion = f.idDireccion 
      LEFT JOIN direccion_cpep as cp 
        ON cp.CP = d.cp 
      LEFT JOIN direccion_colonia as col 
        ON col.idColonia = d.idColonia"));
?>