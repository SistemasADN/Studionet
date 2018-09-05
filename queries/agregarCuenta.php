<?php
  include "../validation/classValidator.php";
  $validator = new Validator();
  $rules = array ();
  $rules["nombreCuenta"] = 	  ['r' => true, 	't' =>"alphnum"];
  $rules["nombreBanco"] = 	  ['r' => false, 	't' =>"alphnum"];
  $rules["numeroCuenta"] = 	  ['r' => false, 	't' =>"num"];
  $rules["clabe"] = 	         ['r' => false, 	't' =>"num"];
  $rules["numeroCliente"] = 	  ['r' => false, 	't' =>"num"];
  $rules["montoInicial"] = 	  ['r' => true, 	't' =>"coin"];

  $validator->setRulesValidateArrayEcho($rules, $_POST);
  include "dbcon.php";
  include "getIdSede.php";
  $_POST['idSede'] = $idSede;
  if(execute_query($con, "INSERT INTO cuentas(nombre, banco, numeroCuenta, clabe, numeroCliente, montoInicial, idSede) VALUES (?,?,?,?,?,?,?)", "sssssdi", $_POST)){
    echo "s|Cuenta|Cuenta creada exitosamente.";
  }else{
    echo "e|Cuenta|No se pudo crear la cuenta.";
  }
?>
