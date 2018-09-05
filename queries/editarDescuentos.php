<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
    //  $validator->enableEchos();
	//Reglas
	$rules1 = array ();
    $rules1['idReciboPagoLista'] =          ['r' => true , 	't' => "num"];
    $rules1['descuento'] =                  ['r' => true , 	't' => "dec"];

		$rules2 = array ();
    $rules2['descuentoReciboDesc'] =                 ['r' => true ,  't' => "dec"];
		$rules2['idReciboPagoDesc'] =                 	 ['r' => true ,  't' => "num"];
    //var_dump($_POST);
    if(!isset($_POST['detallesReciboDescuentos'])){
			exit;
		}
		$listaDetalles = $_POST['detallesReciboDescuentos'];
		unset($_POST['detallesReciboDescuentos']);
    //var_dump($data);exit;
	$validator->setRulesValidateArrayEcho($rules2, $_POST);
	foreach($listaDetalles as $detalle){
      $validator->setRulesValidateArrayEcho($rules1, $detalle);
	}
	include "dbcon.php";
	if(!execute_query($con, "
                      UPDATE recibo_pago
                        SET
                          descuento = ?
                        WHERE idReciboPago = ?", 'ii',
												 [$_POST['descuentoReciboDesc'], $_POST['idReciboPagoDesc']], false)){
													 echo "e|Actualizar descuentos|No se pudo actualizar el descuento de la carta de cobro.";exit;
												 }
	foreach($listaDetalles as $detalle){
		if(!execute_query($con, "
											UPDATE recibo_pago_lista
												SET
													descuento = ?
												WHERE idReciboPagoLista = ?", 'di', [$detalle['descuento'], $detalle['idReciboPagoLista']], false)){
													echo "e|Actualizar descuentos|No se pudo actualizar el descuento de los conceptos de la carta de cobro.";
												}
	}

  echo "s|Editar Descuentos|Descuentos editados correctamente. ";
	mysqli_commit($con);
?>
