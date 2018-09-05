<?php
    include "../validation/classValidator.php";
    $validator = new Validator();
    $rules = array();
    $validator->setRulesValidateArrayEcho($rules, $_POST);
    include "dbcon.php";
    include "getIdSede.php";
    json_echo(select_query($con, "SELECT idCuenta FROM cuentas WHERE idSede = ? AND principal = 1 LIMIT 1", 'i', [$idSede]));
?>
