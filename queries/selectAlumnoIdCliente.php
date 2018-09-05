<?php
  //session_start();
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	$data = select_query($con,
	'SELECT a.idTutor as cliente, a.idAlumno as id, ap.nombre as value, pt.nombre as subtext FROM alumnos as a
    LEFT JOIN clientes as c ON c.idCliente = a.idTutor
    LEFT JOIN personacompleta as ap ON ap.idPersona = a.idPersona
    LEFT JOIN personacompleta as pt ON pt.idPersona = c.idPersona
     WHERE a.activo = 1 AND c.activo = 1 ORDER BY value ASC');

     foreach($data as $k=>$v){
        $temp = select_query($con,
        "SELECT IFNULL(SUM(tr.totalRecibo),0) as totalPorPagar, IFNULL(pr.totalPagado, 0) as totalPagado
        FROM recibo_pago as rp
        LEFT JOIN totalrecibopago as tr ON tr.idReciboPago = rp.idReciboPago
        LEFT JOIN (SELECT pr.idCliente, SUM(pr.cantidad) as totalPagado FROM pagos_recibidos
				 as pr WHERE pr.aprobado = 1 GROUP BY (pr.idCliente)) as pr
         ON pr.idCliente = rp.idCliente
          WHERE rp.idCliente = ?", 'i', [$v['id']]);
        $data[$k]['totalPorPagar'] = $temp[0]['totalPorPagar'];
        $data[$k]['totalPagado'] = $temp[0]['totalPagado'];
        $data[$k]['balance'] = $data[$k]['totalPorPagar'] - $data[$k]['totalPagado'];
      }

      json_echo(format_respuesta_select($data));
?>
