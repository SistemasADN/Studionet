<?php
  include "../validation/classValidator.php";
  $validator = new Validator();
  //Reglas
  $rules = array ();
  //$_POST['idCliente'] = 1;
  $rules['idCliente'] = ['t' => 'num', 'r' => true];
  $validator->setRulesValidateArrayEcho($rules, $_POST);
  include "dbcon.php";
  $respuesta['Pagos'] = select_query($con,
            "SELECT
                pr.fecha,
                pr.cantidad as cantidadCosto,
                fp.formaPago,
                pr.referencia,
                pr.concepto,
                pr.comentario,
                pr.folio,
                c.nombre as cuenta,
                s.nombreSede as sede,
                'Pago de Cliente' AS tipo
              FROM pagos_recibidos AS pr
              LEFT JOIN forma_pago AS fp
                ON pr.idFormaPago = fp.idFormaPago
              LEFT JOIN cuentas as c
                ON c.idCuenta = pr.idCuenta
              LEFT JOIN sedes as s
                ON s.idSede = pr.idSede
              WHERE pr.idCliente = ? AND pr.aprobado = 1",'i', $_POST);
  $respuesta['Movimientos'] = select_query($con,
            "SELECT
              rp.fecha,
              rp.folio,
              '' as cuenta,
              '' as formaPago,
              ROUND(SUM(rpl.cantidad * rpl.precioActual * (1-(rpl.descuento/100))) * (1-(rp.descuento/100)),2) AS cantidadCosto,
              'Carta de cobro' AS tipo
            FROM recibo_pago AS rp
              LEFT JOIN recibo_pago_lista AS rpl
                ON rp.idReciboPago = rpl.idReciboPago
            WHERE rp.idCliente = ? AND rp.folio IS NOT NULL
            GROUP BY rp.idReciboPago
            ",'i', $_POST);

  $respuesta = array_merge($respuesta['Pagos'], $respuesta['Movimientos']);
  json_echo($respuesta);
