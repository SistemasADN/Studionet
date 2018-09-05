<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array ();
	$rules["fechaInicial"] = 		['r' => true , 	't' => "date"];
	$rules["fechaFinal"] = 			['r' => true , 	't' => "date"];
	$rules["tipo"] = 			['r' => true , 	't' => "alphnum"];
	//vde();
  $validator->setRulesValidateArrayEcho($rules, $_POST);
	include_once "dbcon.php";
      $respuesta = array();
			switch($_POST['tipo']){
        case 'clase':
	          $query =
							"SELECT g.nombreGrupo  as concepto, IFNULL(SUM(rpl.cantidad*rpl.precioActual*(1-(rpl.descuento/100))),0) as total
							 FROM grupos as g
							 LEFT JOIN alumnos_grupos as ag ON g.idGrupo = ag.idGrupo
							 LEFT JOIN recibo_pago_lista as rpl ON rpl.idAlumnoGrupo = ag.idAlumnoGrupo
							 LEFT JOIN recibo_pago as rp ON rp.idReciboPago = rpl.idReciboPago
							 WHERE  rp.fecha BETWEEN ? AND ? AND rp.folio IS NOT NULL
							 	GROUP BY (g.idGrupo)  ORDER BY total DESC";
        break;

				case 'asignatura':
				$query =
					"SELECT a.nombreAsignatura as concepto, IFNULL(SUM(rpl.cantidad*rpl.precioActual*(1-(rpl.descuento/100))),0) as total
					 FROM grupos as g
					 LEFT JOIN asignaturas as a ON g.idAsignatura = a.idAsignatura
					 LEFT JOIN alumnos_grupos as ag ON g.idGrupo = ag.idGrupo
					 LEFT JOIN recibo_pago_lista as rpl ON rpl.idAlumnoGrupo = ag.idAlumnoGrupo
					 LEFT JOIN recibo_pago as rp ON rp.idReciboPago = rpl.idReciboPago
					 WHERE  rp.fecha BETWEEN ? AND ? AND rp.folio IS NOT NULL
						GROUP BY (a.idAsignatura)  ORDER BY total DESC";
				break;
				case 'disciplina':
				$query =
					"SELECT d.nombreDisciplina as concepto, IFNULL(SUM(rpl.cantidad*rpl.precioActual*(1-(rpl.descuento/100))),0) as total
					 FROM grupos as g
					 LEFT JOIN asignaturas as a ON g.idAsignatura = a.idAsignatura
					 LEFT JOIN disciplinas as d ON d.idDisciplina = a.idDisciplina
					 LEFT JOIN alumnos_grupos as ag ON g.idGrupo = ag.idGrupo
					 LEFT JOIN recibo_pago_lista as rpl ON rpl.idAlumnoGrupo = ag.idAlumnoGrupo
					 LEFT JOIN recibo_pago as rp ON rp.idReciboPago = rpl.idReciboPago
					 WHERE  rp.fecha BETWEEN ? AND ? AND rp.folio IS NOT NULL
						GROUP BY (d.idDisciplina)  ORDER BY total DESC";

				break;
        case 'alumnos':
	          $query =
							"SELECT pc.nombre as concepto, SUM(rpl.cantidad*rpl.precioActual*(1-(rpl.descuento/100))) as total
							 FROM alumnos as a
							 LEFT JOIN recibo_pago_lista as rpl ON rpl.idAlumno = a.idAlumno
							 LEFT JOIN recibo_pago as rp ON rp.idReciboPago = rpl.idReciboPago
							 LEFT JOIN personacompleta as pc ON pc.idPersona = a.idPersona
							 WHERE  rp.fecha BETWEEN ? AND ? AND rp.folio IS NOT NULL
							 	GROUP BY (a.idAlumno)  ORDER BY total DESC";
        break;
				case 'cliente':
				$query = "SELECT pc.nombre as concepto, SUM(rpl.cantidad*rpl.precioActual*(1-(rpl.descuento/100))) as total
				FROM clientes as c
				 LEFT JOIN alumnos as a ON c.idCliente = a.idTutor
				 LEFT JOIN recibo_pago_lista as rpl ON rpl.idAlumno = a.idAlumno
					LEFT JOIN recibo_pago as rp ON rp.idReciboPago = rpl.idReciboPago
				 LEFT JOIN personacompleta as pc ON pc.idPersona = c.idPersona
				 WHERE  rp.fecha BETWEEN ? AND ? AND rp.folio IS NOT NULL
					GROUP BY (c.idCliente)  ORDER BY total DESC";
				break;
				case 'conceptos':
				$query = "SELECT c.nombreConcepto as concepto, SUM(rpl.cantidad*rpl.precioActual*(1-(rpl.descuento/100))) as total
				FROM conceptos as c
				 LEFT JOIN recibo_pago_lista as rpl ON rpl.idConcepto = c.idConcepto
					LEFT JOIN recibo_pago as rp ON rp.idReciboPago = rpl.idReciboPago
				 WHERE  rp.fecha BETWEEN ? AND ? AND rp.folio IS NOT NULL
					GROUP BY (c.idConcepto)  ORDER BY total DESC";
				break;
				case 'clientePagos':
				$query = "SELECT pc.nombre as concepto, SUM(pr.cantidad) as total
				FROM pagos_recibidos as pr
				 LEFT JOIN clientes as c ON c.idCliente = pr.idCliente
				 LEFT JOIN personacompleta as pc ON pc.idPersona = c.idPersona
				 WHERE  pr.fecha BETWEEN ? AND ? AND aprobado = 1
					GROUP BY (c.idCliente)  ORDER BY total DESC";
				break;
      }
			$respuesta = select_query($con, $query, 'ss', reorder_array_keys($_POST, ['fechaInicial', 'fechaFinal']));
       json_echo($respuesta);
?>
