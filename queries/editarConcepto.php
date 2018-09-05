<?php
  include "../validation/classValidator.php";
  $validator = new Validator();
  //Reglas
  $rules = array ();
  $rules['nombreConcepto'] =          ['r' => true , 	't' => "alphnum"];
  $rules['estatus'] =                 ['r' => true , 	't' => "bool"];
  $rules['idConcepto'] =              ['r' => true , 	't' => "num"];
  $rules['precioUnitario'] =          ['r' => true , 	't' => "dec"];
  $validator->setRulesValidateArrayEcho($rules, $_POST);
  include "dbcon.php";
  if(execute_query($con, "UPDATE conceptos SET nombreConcepto = ?, precioUnitario = ?, activo = ? WHERE idConcepto = ?", 'ssii', reorder_array_keys($_POST, ['nombreConcepto', 'precioUnitario','estatus', 'idConcepto']))){
      echo "s|Editar Concepto|Concepto editado correctamente. ";
  }else{
      echo "e|Editar Concepto|No se pudo editar el concepto. ";
  }
?>