<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
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
                p.alergias,
                p.enfermedades,
                p.medicamentos,
                p.nombreC1 as contacto1,
                p.telC1,
                p.nombreC2 as contacto2,
                p.telC2,
                ge.genero,
                CONCAT(cc.nombre, ' ', cc.apellidoPaterno, ' ', cc.apellidoMaterno) AS tutor,
                co.idColegio,
                co.colegio,
                g.idGrado,
                g.nombreGrado,
                (SELECT idPersona FROM clientesalumnos WHERE idPersona = a.idPersona) AS ca,
								s.idSede,
								s.nombreSede as sede
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
								LEFT JOIN sedes as s
								ON s.idSede = a.idSede"));
?>
