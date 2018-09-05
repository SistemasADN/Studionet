<?php
   if(basename(getcwd())=="queries"){
      include_once "../validation/classValidator.php";
      include_once "dbcon.php";
    }else{
      include_once "validation/classValidator.php";
      include_once "queries/dbcon.php";
    }
    $formaCalculoGot = select_query_one($con, "SELECT idCalculoPagos FROM forma_calculos WHERE idCalculoPagos = 1");
    $formaCalculoGot = $formaCalculoGot['idCalculoPagos'];
?>
