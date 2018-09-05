<?php
  include "../validation/classValidator.php";
  $validator = new Validator();
  $rules = array ();
  $rules['idCuenta'] =  	      ['r' => true, 	't' =>"num"];
  $rules["nombreCuenta"] = 	    ['r' => true, 	't' =>"alphnum"];
  $rules["nombreBanco"] = 	    ['r' => false, 	't' =>"alphnum"];
  $rules["numeroCuenta"] = 	    ['r' => false, 	't' =>"num"];
  $rules["clabe"] = 	          ['r' => false, 	't' =>"num"];
  $rules["numeroCliente"] = 	  ['r' => false, 	't' =>"num"];
  $rules["montoInicial"] = 	    ['r' => true, 	't' =>"coin"];
  $rules["principal"] = 	       ['r' => true, 	't' =>"bool"];

//  $validator->enableEchos();
  $validator->setRulesValidateArrayEcho($rules, $_POST);
  include "dbcon.php";
  include "getIdSede.php";
  $_POST['principal'] = $_POST['principal']==='true'?1:0;
  if($_POST['principal']==1){
      if(!execute_query($con, "UPDATE cuentas SET principal = 0 WHERE idSede = ?", 'i', [$idSede])){
        echo "e|Cuenta|No se pudo editar la cuenta.";exit;
      }
  }

  if(execute_query($con, 'UPDATE cuentas SET nombre = ?, banco = ?, numeroCuenta = ?, clabe = ?, numeroCliente = ?,  montoInicial = ?, principal = ?
    WHERE idCuenta = ?',
   'sssssdsi',
  [$_POST['nombreCuenta'], $_POST['nombreBanco'], $_POST['numeroCuenta'], $_POST['clabe'], $_POST['numeroCliente'], $_POST['montoInicial'], $_POST['principal'], $_POST['idCuenta']])) {
    echo "s|Cuenta|Cuenta editada exitosamente.";
  }else{
    echo "e|Cuenta|No se pudo editar la cuenta.";
  }
?>
