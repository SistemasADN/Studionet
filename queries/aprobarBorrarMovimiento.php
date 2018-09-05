<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules["act"] = ["r"=>true, "t"=>"alpha"];
	$rules["id"] = ["r"=>true, "t"=>"num"];
  $rules["tipo"] = ["r"=>true, "t"=>"alpha"];
	$validator->enableEchos();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
  include "dbcon.php";
  mysqli_autocommit($con, FALSE);
  if($_POST['tipo']=="egreso"){
      if($_POST['act']=='borrar'){
        $r = execute_query($con, "DELETE FROM egresos WHERE idEgreso = ?", 'i', reorder_array_keys($_POST, ['id']), false);
      }else if($_POST['act']=='aprobar'){
				$personal = select_query($con, "SELECT idEgresoPersonal FROM egresos_personal WHERE idEgreso = ?",
				 'i', reorder_array_keys($_POST, ['id']));
				 if(isset($personal[0])){
					 	$personal = $personal[0]['idEgresoPersonal'];
						$folio = select_query_one($con, "SELECT nf.folio FROM nextfolioegresospersonal as nf
							 LEFT JOIN egresos as e ON e.idSede = nf.idSede
							 LEFT JOIN egresos_personal as ep ON ep.idEgreso = e.idEgreso
							 WHERE ep.idEgresoPersonal = ?", 'i', [$personal]);
						$folio = $folio['folio'];
						if(!execute_query($con, "UPDATE egresos_personal SET folio = ? WHERE idEgresoPersonal = ?", 'ii', [$folio, $personal], false)){
							echo "e|Movimiendo|No se pudo aprobar el pago de personal.";exit;
						}
				 }
        $r = execute_query($con, "UPDATE egresos SET aprobar = 1 WHERE idEgreso = ?", 'i', reorder_array_keys($_POST, ['id']), false);
      }
  }else if($_POST['tipo']=="ingreso"){
    if($_POST['act']=='borrar'){
      $r = execute_query($con, "DELETE FROM ingresos WHERE idIngresos = ?", 'i', reorder_array_keys($_POST, ['id']), false);
    }else if($_POST['act']=='aprobar'){
      $r = execute_query($con, "UPDATE ingresos SET aprobar = 1 WHERE idIngresos = ?", 'i', reorder_array_keys($_POST, ['id']), false);
    }
  }

  if($r){
    echo "s|Movimiento|Se pudo ".$_POST['act']." el ".$_POST['tipo'];
    mysqli_commit($con);
  }else{
    echo "e|Movimiento|Se pudo ".$_POST['act']." el ".$_POST['tipo'];
  }
?>
