<?php
	
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
    $rules['idCliente'] = ['r' => true,  't' => "num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	json_echo(select_query($con, 
              "SELECT 
                a.idAlumno,
                a.email,
                a.idPersona,
                a.idTutor,
                a.idColegio,
                a.idGrado,
                a.activo,
                p.nombre,
                p.apellidoPaterno,
                p.apellidoMaterno,
                p.fechaNacimiento,
                p.idGenero,
                ge.genero,
                CONCAT(cc.nombre, ' ', cc.apellidoPaterno, ' ', cc.apellidoMaterno) AS tutor,
                co.idColegio, 
                co.colegio,
                g.idGrado,
                g.nombreGrado,
                (SELECT idPersona FROM clientesalumnos WHERE idPersona = a.idPersona) AS ca
	          FROM alumnos as a 
	           LEFT JOIN personas AS p
                ON a.idPersona = p.idPersona
                LEFT JOIN clientescompleto AS cc
                ON a.idTutor = cc.idCliente
                LEFT JOIN colegios AS co
                ON a.idColegio = co.idColegio
                LEFT JOIN grados AS g
                ON a.idGrado = g.idGrado
                LEFT JOIN generos AS ge
                ON p.idGenero = ge.idGenero
              WHERE a.idTutor = ?", 'i', reorder_array($_POST, ['idCliente'])));
?>