      <?php
        include "../validation/classValidator.php";
        $validator = new Validator();
        $rules = array ();
        $validator->setRulesValidateArrayEcho($rules, $_POST);
        include "dbcon.php";
        include "getIdSede.php";
        json_echo(select_query($con, "SELECT idCuenta, principal, nombre as nombreCuenta, banco as nombreBanco,  clabe, numeroCliente, numeroCuenta, montoInicial FROM cuentas WHERE idSede = ?", 'i', [$idSede]));
      ?>
