<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array();
	$rules['idReciboCobro'] = ["r"=>true, "t"=>"num"];
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	if(execute_query($con, "
                      DELETE
                      FROM recibo_pago_lista
                      WHERE idReciboPago = ?", 'i', $_POST, true)){
      if(execute_query($con, "
                      DELETE
                      FROM recibo_pago
                      WHERE idReciboPago = ?", 'i', $_POST, true)){
        echo "s|Borrar Carta de cobro|El Carta de cobro ha sido borrado con exito.";
      } else{
        echo "e|Borrar Carta de cobro|No se ha podido borrar el recibo de cobro.1";
      }
    } else{
      echo "e|Borrar Carta de cobro|No se ha podido borrar el recibo de cobro.2";
    } 
?>