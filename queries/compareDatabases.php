<?php
	include "../validation/classValidator.php";

	$data = compareDatabases($db_origen, $db_comparar);
	$respuesta = [];
	foreach($data as $k=>$v){
		$respuesta[] = ['table'=>$k, 'data'=>$v];
	}
	//var_dump($respuesta);
	json_echo($respuesta);
?>
