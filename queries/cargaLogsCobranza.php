<?php
include "dbcon.php";
include "validation/classValidator.php";
$ultimaFecha =  select_query_one($con, "SELECT fecha, mes_generado as mensualidad FROM logs_cobranza WHERE fecha = (SELECT MAX(fecha) FROM logs_cobranza)", '', []);
?>
