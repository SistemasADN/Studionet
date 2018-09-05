<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
    include_once "dbcon.php";
		$respuesta = select_query($con, "
									SELECT
									  c.idCliente,
                    rp.idReciboPago,
										rp.fecha,
										s.nombreSede as sede,
                    rp.folio,
										pc.nombre as nombreCliente,
                    rp.descuento,
										tr.totalRecibo,
										tr.subTotal,
										COALESCE(pa.totalAplicado,0) as totalAplicado
                  FROM recibo_pago AS rp
									LEFT JOIN sedes as s ON rp.idSede = s.idSede
					LEFT JOIN clientes as c ON c.idCliente = rp.idCliente
                    LEFT JOIN personacompleta as pc ON pc.idPersona = c.idPersona
				    LEFT JOIN totalrecibopago as tr ON tr.idReciboPago = rp.idReciboPago
					LEFT JOIN totalpagoaplicado as pa ON pa.idReciboPago = rp.idReciboPago");
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
	//		print_r($respuesta); exit;
			json_echo($respuesta);
?>
