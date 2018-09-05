<?php
  include "../validation/classValidator.php";
  $validator = new Validator();
  //Reglas
//var_dump($_POST);exit;
  $rules = array ();
  $rules['idClase'] =                 ['r' => true , 	't' => "num"];
  $rules['estatus'] =                 ['r' => true , 	't' => "bool"];
  $rules['asignaturaSearch'] =        ['r' => true , 	't' => "num"];
  $rules['nivelSearch'] =             ['r' => true , 	't' => "num"];
  $rules['precioEstandard'] =              ['r' => true , 	't' => "coin"];

  $validator->setRulesValidateArrayEcho($rules, $_POST);
  include "dbcon.php";
  if(execute_query($con, "UPDATE clases SET idAsignatura = ?, idNivel = ?, precioEstandard = ?, activo = ? WHERE idClase = ?", 'iiidi',
  reorder_array_keys($_POST, ['asignaturaSearch','nivelSearch','precioEstandard', 'estatus','idClase']))){
      echo "s|Editar Clase|Clase editada correctamente. ";
  }else{
      echo "e|Editar Clase|No se pudo editar la clase. ";
  }
?>
