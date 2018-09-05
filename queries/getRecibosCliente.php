<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array ();
  $rules['idCliente'] = ['t'=>'num', 'r'=>true];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
    include_once "dbcon.php";
    json_echo(select_query($con, "
                  SELECT
                    rp.idReciboPago,
										rp.fecha,
										s.nombreSede as sede,
                    rp.folio,
										pc.nombre as nombreCliente,
                    rp.descuento,
										tr.totalRecibo,
										tr.subTotal,
										tr.descuento,
										COALESCE(pa.totalAplicado,0) as totalAplicado
                  FROM recibo_pago AS rp
									LEFT JOIN sedes as s ON rp.idSede = s.idSede
					LEFT JOIN clientes as c ON c.idCliente = rp.idCliente
                    LEFT JOIN personacompleta as pc ON pc.idPersona = c.idPersona
				    LEFT JOIN totalrecibopago as tr ON tr.idReciboPago = rp.idReciboPago
					LEFT JOIN totalpagoaplicado as pa ON pa.idReciboPago = rp.idReciboPago
                WHERE rp.idCliente = ? AND rp.folio IS NULL
					", 'i', $_POST));

?>
