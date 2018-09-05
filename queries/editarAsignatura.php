<?php
  include "../validation/classValidator.php";
  $validator = new Validator();
  //Reglas
  $rules = array ();
  $rules['nombreAsignatura'] =        ['r' => true , 	't' => "alphnum"];
  $rules['estatus'] =                 ['r' => true , 	't' => "bool"];
  $rules['idAsignatura'] =            ['r' => true , 	't' => "num"];
  $rules['disciplinaSearch'] =        ['r' => true , 	't' => "num"];
  $rules['nombreDisciplina'] =        ['r' => true ,    't' => "alphnum"];
  $validator->setRulesValidateArrayEcho($rules, $_POST);
  include "dbcon.php";
  if(execute_query($con, "UPDATE asignaturas SET nombreAsignatura = ?, idDisciplina = ?, activo = ? WHERE idAsignatura = ?", 'siii', reorder_array_keys($_POST, ['nombreAsignatura', 'disciplinaSearch','estatus', 'idAsignatura']))){
    echo "s|Editar Clase|Clase editada correctamente. "; 
}else{
    echo "e|Editar Clase|No se pudo editar la clase. "; 
}
?>