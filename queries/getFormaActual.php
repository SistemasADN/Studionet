<?php
	
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	$r1['forma'] = select_query($con, "
      SELECT 
        idCalculoPagos,
        formaCalculo
      FROM forma_calculos
      WHERE activo = 1");
    //var_dump($r1);exit;
    $r2['formaDetalle'] = array();
    if($r1['forma'][0]['idCalculoPagos']==3){
      $r2['formaDetalle'] = select_query($con, "
            SELECT 
              idFormaCalculoDetalle,
              nombre,
              valor
            FROM forma_calculos_detalle");
      json_echo(array_merge($r1['forma'], $r2['formaDetalle']));
    } else {
      json_echo($r1['forma']);  
    }
    

?>