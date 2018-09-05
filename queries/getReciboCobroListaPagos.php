<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array ();
    //vde();
    $rules['idReciboPago'] = ["r"=>true, "t"=>"num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
    include_once "dbcon.php";
    json_echo(select_query($con, "
                  SELECT
                    pa.fecha AS fechaAplicada,
                    pa.cantidad AS cantidadAplicada,
                    pr.fecha AS fechaRecibido,
                    pr.cantidad AS cantidadRecibida,
                    fp.formaPago
                  FROM pagos_aplicados AS pa
                    LEFT JOIN pagos_recibidos AS pr
                      ON pa.idPagoRecibido = pr.idPagoRecibido
                    LEFT JOIN forma_pago AS fp
                      ON pr.idFormaPago = fp.idFormaPago
                  WHERE pr.aprobado = 1 AND pa.idReciboPago = ?
					", 'i', $_POST));
	
?>