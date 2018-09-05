<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->enableEchos();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	include_once "getIdSede.php";
	$respuesta= (select_query($con,
              "SELECT
                pr.idPagoRecibido,
                pr.fecha,
								pr.folio,
                pr.idCliente,
                pr.idFormaPago,
                pr.cantidad,
                pr.aprobado,
                c.idPersona,
                fp.formaPago,
                pc.nombre,
                IFNULL(SUM(pa.cantidad),0) as cantidadAplicadaCosto
              FROM pagos_recibidos AS pr
              LEFT JOIN forma_pago AS fp
                ON pr.idFormaPago = fp.idFormaPago
              LEFT JOIN pagos_aplicados as pa
                ON pa.idPagoRecibido = pr.idPagoRecibido
								LEFT JOIN clientes AS c
	                ON pr.idCliente = c.idCliente
	              LEFT JOIN personacompleta AS pc
	                ON c.idPersona = pc.idPersona
									WHERE pr.idSede = ?
            GROUP BY(pr.idPagoRecibido)
               ",'i', [$idSede]));

               	foreach($respuesta as $k=>$cc){
                  $alumnos = select_query($con,
                  "SELECT nombre FROM personacompleta pc INNER JOIN alumnos al WHERE al.idTutor= '".$cc['idCliente']."' AND pc.idPersona=al.idPersona ORDER BY pc.nombre DESC" );
                  $txt = "";
                  foreach($alumnos as $alumno){
                    $txt .= $alumno['nombre'].", ";
                  }
                  $txt = preg_replace('/\s+/', ' ', $txt);
                  $txt = trim($txt,", ");
                  $respuesta[$k]['nombreAlumnos'] = $txt;
                }
                json_echo($respuesta);
?>
