<?php

	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
  $lista = $_POST['adminSedes'];


	$rules = array ();
  $rules['idAdmin'] = ["t"=>"num", "r"=>true];
  //$rules2 = array ();
  //$rules2['idSede'] = ["t"=>"num", "r"=>true];
  //$validator->enableEchos();
	//vde();
  for($i=0;$i<count($lista);$i++){
    $save = "";
     if(isset($lista[$i]['sedes'])){
       $save = $lista[$i]['sedes'];
       unset($lista[$i]['sedes']);
     }
	   $validator->setRulesValidateArrayEcho($rules, $lista[$i]);
     if($save==""){
       $lista[$i]['sedes'] = array();
     }else{
       for($j=0;$j<count($save);$j++){
         //$validator->setRulesValidateArrayEcho($rules2, $save);
       }
       $lista[$i]['sedes'] = $save;
     }
  }

	include "dbcon.php";
  execute_query($con, "DELETE FROM admin_sede", '', [], false) or die ("e|Cambiar permisos|No se pudieron cambiar los permisos de administración.");
	for($i=0;$i<count($lista);$i++){
      $idAdmin = $lista[$i]['idAdmin'];
      $save = $lista[$i]['sedes'];
      for($j=0;$j<count($save);$j++){
        $idSede = $save[$j];
        execute_query($con, "INSERT INTO admin_sede (idUsuario, idSede) VALUES (?,?)", 'ii', [$idAdmin, $idSede], false) or die ("e|Cambiar permisos|No se pudo cambiar los permisos de administracion.");
      }
  }
	mysqli_commit($con);
  echo "s|Cambiar permisos|Permisos de administración cambiados exitosamente.";
?>
