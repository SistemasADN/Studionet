<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
    //var_dump($_POST);exit;
    $rules["idUsuario"] = 		        ['r' => true,  't' => "num"];
    $rules["rfc"] =                   ['r' => false,  't' => "rfc"];
    $rules["modalidadPagoSearch"] =   ['r' => true, 't' => "num"];
    $rules["formaPagoSearch"] = 		  ['r' => true,  't' => "num"];
    $rules["sueldo"] =                ['r' => true, 't' => "coin"];

	//Direccion
	$rules = setDireccionRules($rules, "Sum");
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
  include "getIdSede.php";

  mysqli_autocommit($con, FALSE);
  $select = select_query($con, "SELECT idPersona, idContacto FROM usuarios WHERE idUsuario = ?", 'i', [$_POST['idUsuario']]);
  $select = $select[0];
  $_POST['idPersona'] = $select['idPersona'];
  $_POST['idContacto'] = $select['idContacto'];
  $_POST['idSede'] = $idSede;
  $_POST['idDireccion'] = insert_direccion($con, $_POST);
  $_POST['idFacturacion'] = insert_id_query($con, "INSERT INTO facturacion (idDireccion, RFC) VALUES (?,?)", 'is', reorder_array($_POST, ['idDireccion', 'rfc']));
  if($_POST['idFacturacion']!=0){
    $_POST['idPersonal'] = insert_id_query($con, "INSERT INTO personal (idPersona, idFacturacion, idTipoPersonal,
       idFormaPago, idContacto, idModalidadPago, sueldo,idSede) VALUES (?,?,(SELECT idTipoPersonal FROM tipo_personal WHERE tipo = 'Profesor'),?,?,?,?,?)", "iiiiisi",
       reorder_array($_POST, ['idPersona', 'idFacturacion', 'formaPagoSearch', 'idContacto', 'modalidadPagoSearch', 'sueldo', 'idSede']));
    if($_POST['idUsuario']>0&&$_POST['idPersonal']>0){
      if(execute_query($con, "INSERT INTO personal_usuario (idPersonal, idUsuario) VALUES (?,?)", 'ii', [$_POST['idPersonal'], $_POST['idUsuario']], false)){
        echo "s|Fusionar Usuario|Este usuario ahora puede ser usado como profesor.";
        mysqli_commit($con);
        exit;
        //mysqli_commit($con);
      }
    }
  }
  echo "e|Fusionar Usuario|Error al fusionar usuario para ser usado como profesor.";
?>
