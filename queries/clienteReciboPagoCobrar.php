<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array ();
	$rules["idCliente"] = 		['r' => true, 	't' =>"coin"];
	$rules["fechaInicial"] = 	['r' => true, 	't' =>"date"];
	$rules["fechaFinal"] = 		['r' => true, 	't' =>"date"];
  $rules['todos'] =         ['r' => true, 	't' =>"bool"];
  $validator->enableEchos();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
		include_once "dbcon.php";
    if($_POST['idCliente']!="-1"){
		$respuesta = select_query($con, "
    SELECT rp.idReciboPago, rp.descuento, rp.fecha, rp.folio, s.nombreSede as sede, pc.nombre as cliente, IFNULL(ta.totalAplicado, 0) as totalPagado, tr.totalRecibo as total
    FROM recibo_pago as rp
    LEFT JOIn sedes as s ON s.idSede = rp.idSede
    LEFT JOIN clientes as c ON c.idCliente = rp.idCliente
    LEFT JOIN personacompleta as pc ON pc.idPersona = c.idPersona
    LEFT JOIN totalpagoaplicado as ta ON ta.idReciboPago = rp.idReciboPago
    LEFT JOIN totalrecibopago as tr ON tr.idReciboPago = rp.idReciboPago
		 WHERE c.idCliente = ? AND rp.folio IS NOT NULL AND IFNULL(ta.totalAplicado,0) <> tr.totalRecibo AND rp.fecha BETWEEN ? AND ?", 'iss', [$_POST['idCliente'], $_POST['fechaInicial'], $_POST['fechaFinal']]);
   }else{
     $respuesta = select_query($con, "
		 SELECT rp.idReciboPago, rp.descuento, rp.fecha, rp.folio, s.nombreSede as sede, pc.nombre as cliente, IFNULL(ta.totalAplicado, 0) as totalPagado, tr.totalRecibo as total
      FROM recibo_pago as rp
      LEFT JOIn sedes as s ON s.idSede = rp.idSede
      LEFT JOIN clientes as c ON c.idCliente = rp.idCliente
      LEFT JOIN personacompleta as pc ON pc.idPersona = c.idPersona
      LEFT JOIN totalpagoaplicado as ta ON ta.idReciboPago = rp.idReciboPago
      LEFT JOIN totalrecibopago as tr ON tr.idReciboPago = rp.idReciboPago
  		WHERE rp.folio IS NOT NULL AND IFNULL(ta.totalAplicado,0) <> tr.totalRecibo AND rp.fecha BETWEEN ? AND ?", 'ss', [$_POST['fechaInicial'], $_POST['fechaFinal']]);
   }
   foreach($respuesta as $k=>$cc){
				$alumnos = select_query($con,
				"SELECT DISTINCT pc.nombre
				FROM recibo_pago_lista as rpl LEFT JOIN alumnos as a ON a.idAlumno = rpl.idAlumno
				LEFT JOIN personacompleta as pc ON pc.idPersona = a.idPersona WHERE rpl.idReciboPago = ? ORDER BY pc.nombre DESC", 'i', [$cc['idReciboPago']]);
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
