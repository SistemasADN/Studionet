<?php
	include "../validation/classValidator.php";
  $rules = array();
  $rules['nombreTabla'] =   ['t'=>'servs', 'r'=>true];
  $rules['nombreColumna'] = ['t'=>'servs', 'r'=>false];

  $validator = new Validator();
  $validator->enableEchos();
  $validator->setRulesValidateArrayEcho($rules, $_POST);
  $con = mysqli_connect('localhost', 'root', 'polloman', $db_comparar);

	$data = compareDatabases($db_origen, $db_comparar);
	$respuesta = [];
	foreach($data as $k=>$v){
		$respuesta[] = ['table'=>$k, 'data'=>$v];
	}

  foreach($respuesta as $k=>$info){
    if($info['table']==$_POST['nombreTabla']){
      if($info['data']['existe']){
        if($_POST['nombreColumna']==""){
          echo "No existe nombreColumna";
        }else{
          if(isset($info['data']['columns'][$_POST['nombreColumna']])){
            if($info['data']['columns'][$_POST['nombreColumna']]['modifyScript']===false){
              echo "e|Modificar Tabla|Esta columna no necesita ser modificada.";exit;
            }else if(execute_query($con, $info['data']['columns'][$_POST['nombreColumna']]['modifyScript'], "", [], false)){
              echo "s|Modificar Tabla|Tabla modificada exitosamente.";exit;
            }else{
              echo "s|Modificar Tabla|No se pudo modificar la tabla porque ".mysqli_error($con);
            }
          }else{
              echo "e|Modificar Tabla|No existe la columna.";exit;
          }
        }
      }else{//La tabla no existe, hay que crearla
        $queries = explode(";", $info['data']['create']);
        foreach($queries as $query){
          if($query==''){ continue; }
          if(!execute_query($con, $query, "", [], false)){
              echo "e|Agregar Tabla| No se pudo agregar ".$_POST['nombreTabla']." a ".$db_comparar." porque [".$query."]: ".mysqli_error($con);exit;
          }
        }
        echo "s|Agregar Tabla|".$_POST['nombreTabla']." creada correctamente en ".$db_comparar;exit;
      }
    }
  }

	//json_echo($respuesta);
?>
