<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
		$data = select_query($con,
					"SELECT
            c.idCliente as id,
            CONCAT(p.nombre, ' ', p.apellidoPaterno, ' ', p.apellidoMaterno) AS value
          FROM clientes AS c
            LEFT JOIN personas AS p
              ON c.idPersona = p.idPersona
          WHERE c.activo = 1
          ORDER BY value ASC");

					foreach($data as $k=>$v){
						$temp = select_query($con,
						"SELECT IFNULL(SUM(tr.totalRecibo),0) as totalPorPagar, IFNULL(pr.totalPagado, 0) as totalPagado
						FROM recibo_pago as rp
						LEFT JOIN totalrecibopago as tr ON tr.idReciboPago = rp.idReciboPago
						LEFT JOIN (SELECT pr.idCliente, SUM(pr.cantidad) as totalPagado FROM pagos_recibidos as pr WHERE aprobado = 1 GROUP BY (pr.idCliente)) as pr
						 ON pr.idCliente = rp.idCliente
						  WHERE rp.idCliente = ? AND rp.folio IS NOT NULL", 'i', [$v['id']]);
						$data[$k]['totalPorPagar'] = $temp[0]['totalPorPagar'];
						$data[$k]['totalPagado'] = $temp[0]['totalPagado'];
						$data[$k]['balance'] = $data[$k]['totalPorPagar'] - $data[$k]['totalPagado'];
					}
				/*

			*/
			json_echo(format_respuesta_select($data));
?>
