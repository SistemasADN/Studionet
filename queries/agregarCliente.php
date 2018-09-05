<?php
	include "../validation/classValidator.php";
    include '../mailer/randomLib.php';
    include '../mailer/emailFunctions.php';
	$validator = new Validator();
  $_POST['rfc'] = strtoupper($_POST['rfc']);
	$rules = array ();
	$rules["prefijoSearch"] = 		['r' => true,  't' => "num"];
  $rules["nombre"] = 		        ['r' => true,  't' => "alphnum"];
  $rules["apellidoPaterno"] =     ['r' => true,  't' => "alphnum"];
  $rules["apellidoMaterno"] =     ['r' => false, 't' => "alphnum"];
  $rules["generoSearch"] = 		['r' => true,  't' => "num"];
  $rules["fechaSelect"] =     ['r' => false, 't' => "date"];
  $rules["email"] =               ['r' => false, 't' => "email"];
  $rules["telCelular"] =          ['r' => true,  't' => "tel"];
  $rules["telCasa"] =             ['r' => false, 't' => "tel"];
  $rules["telOficina"] =          ['r' => false, 't' => "tel"];
  $rules["telOtro"] =             ['r' => false, 't' => "tel"];
  $rules["rfc"] =                 ['r' => false, 't' => "rfc"];
  $rules["checkAlumno"] =         ['r' => true,  't' => "bool"];
	$rules = setDireccionRules($rules, "Sum");
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	$_POST['checkAlumno'] = $_POST['checkAlumno']=='true'?true:false;
	include "dbcon.php";
	include "getIdSede.php";
	$idSede = $idSede=='-1'?null:$idSede;
	$idDireccion = 		insert_direccion($con, $_POST) or die ("e|Agregar Cliente|No se pudo agregar cliente.");
	$idFacturacion = 	insert_id_query($con, "INSERT INTO facturacion (idDireccion, RFC) VALUES (?,?)", 'is', [$idDireccion, $_POST['rfc']]) or die ("e|Agregar Cliente|No se pudo agregar cliente.");
  $idContacto = 		insert_id_query($con, "INSERT INTO contacto (email, telCelular, telCasa, telOficina, telOtro) VALUES (?,?,?,?,?)", 'sssss', [$_POST['email'], $_POST['telCelular'], $_POST['telCasa'], $_POST['telOficina'], $_POST['telOtro']])  or die ("e|Agregar Cliente|No se pudo agregar cliente.");
  $idPersona = 			insert_id_query($con, "INSERT INTO personas (nombre, apellidoPaterno, apellidoMaterno, fechaNacimiento, idGenero) VALUES (?,?,?,?,?)", 'ssssi', [$_POST['nombre'], $_POST['apellidoPaterno'], $_POST['apellidoMaterno'], $_POST['fechaSelect'], $_POST['generoSearch']])  or die ("e|Agregar Cliente|No se pudo agregar cliente.");
  function rand_string($length) { $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; return substr(str_shuffle($chars),0,$length); }
  $_POST['pollito'] = rand_string(10);
  $idCliente = insert_id_query($con, "INSERT INTO clientes (idPersona, idFacturacion, idPrefijo, idContacto, pollito, idSede) VALUES (?,?,?,?,?,?)", "iiiisi", [$idPersona, $idFacturacion, $_POST['prefijoSearch'], $idContacto, $_POST['pollito'], $idSede]);
  if($_POST["checkAlumno"]=='1'){
		if(!execute_query($con, "INSERT INTO alumnos (email, idPersona, idTutor,idSede) VALUES (?,?,?,?)", "siii", [$_POST['email'], $idPersona, $idCliente, $idSede])) {
    	echo "e|Agregar Cliente|No se pudo agregar cliente.";exit;
    }
  }
	mysqli_commit($con);
  echo "s|Agregar Cliente|Cliente agregado correctamente.";
?>
