<?php
	include "../validation/classValidator.php";
  $rules = array();
  $rules['nombreTabla'] =   ['t'=>'servs', 'r'=>true];

  $validator = new Validator();
  $validator->setRulesValidateArrayEcho($rules, $_POST);
  $conO = mysqli_connect('localhost', 'root', 'polloman', $db_origen);
  $conC = mysqli_connect('localhost', 'root', 'polloman', $db_comparar);
  $dataOrigen = getTableData($conO, $_POST['nombreTabla']);
  $dataComparar = getTableData($conC, $_POST['nombreTabla']);
  $send = [];
  $send['dataOrigen'] = $dataOrigen;
  $send['dataComparar'] = $dataComparar;
  //json_echo($dataOrigen);
  json_echo($send);
  //var_dump($dataComparar);
  /*
  json_echo();
  */
?>
