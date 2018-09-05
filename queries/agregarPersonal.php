<?php
	include "../validation/classValidator.php";
    include '../mailer/randomLib.php';
	$validator = new Validator();
	//Reglas
	$rules = array ();
    //var_dump($_POST);exit;
    $rules["nombre"] = 		        ['r' => true,  't' => "alphnum"];
    $rules["apellidoPaterno"] =     ['r' => true,  't' => "alphnum"];
    $rules["apellidoMaterno"] =     ['r' => false, 't' => "alphnum"];
    $rules["generoSearch"] = 		['r' => true,  't' => "num"];
    $rules["fechaSelect"] =     ['r' => true, 't' => "date"];

    $rules["email"] =               ['r' => true, 't' => "email"];
    $rules["telCelular"] =          ['r' => true,  't' => "tel"];
    $rules["telCasa"] =             ['r' => false, 't' => "tel"];
    $rules["telOficina"] =          ['r' => false, 't' => "tel"];
    $rules["telOtro"] =             ['r' => false, 't' => "tel"];

    $rules["tipoPersonalSearch"] =  ['r' => true,  't' => "num"];
    $rules["modalidadPagoSearch"] = ['r' => true,  't' => "num"];
    $rules["formaPagoSearch"] =     ['r' => true,  't' => "num"];
    $rules["sueldo"] =              ['r' => true,  't' => "dec"];
	$rules["rfc"] =                 ['r' => false, 't' => "rfc"];
	
	$rules["alergias"] =            ['r' => false,  't' => "alphnum"];
    $rules["enfermedades"] =        ['r' => false,  't' => "alphnum"];
    $rules["medicamentos"] =        ['r' => false,  't' => "alphnum"];
    $rules["contacto1"] =           ['r' => false,  't' => "alphnum"];
    $rules["telC1"] =               ['r' => false,  't' => "tel"];
    $rules["contacto2"] =           ['r' => false,  't' => "alphnum"];
    $rules["telC2"] =               ['r' => false,  't' => "tel"];
	//Direccion
	$rules = setDireccionRules($rules, "Sum");
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
	include "getIdSede.php";
	$_POST['idSede'] = $idSede;
	$_POST['idDireccion'] = insert_direccion($con, $_POST);
    $_POST['idFacturacion'] = insert_id_query($con, "INSERT INTO facturacion (idDireccion, RFC) VALUES (?,?)", 'is', reorder_array($_POST, ['idDireccion', 'rfc']));
    if($_POST['idFacturacion']!=0){
      $_POST['idContacto'] = insert_id_query($con, "INSERT INTO contacto (email, telCelular, telCasa, telOficina, telOtro) VALUES (?,?,?,?,?)", 'sssss', reorder_array($_POST, ['email', 'telCelular', 'telCasa', 'telOficina', 'telOtro']));
      if($_POST['idContacto']!=0){
        $_POST['idPersona'] = insert_id_query($con, "INSERT INTO personas (nombre, apellidoPaterno, apellidoMaterno, fechaNacimiento, idGenero, alergias, enfermedades, medicamentos, nombreC1, telC1, nombreC2, telC2)
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?)", 'ssssisssssss', [$_POST['nombre'], $_POST['apellidoPaterno'], $_POST['apellidoMaterno'], $_POST['fechaSelect'], $_POST['generoSearch'], $_POST['alergias'], $_POST['enfermedades'], $_POST['medicamentos'], $_POST['contacto1'], $_POST['telC1'], $_POST['contacto2'], $_POST['telC2']]);
        if($_POST['idPersona']!=0){
					$esProfesor = select_query($con, "SELECT COUNT(*) as esProfesor FROM tipo_personal as u WHERE u.tipo = 'Profesor' AND idTipoPersonal = ?", 'i', [$_POST['tipoPersonalSearch']]);
					$esProfesor = $esProfesor[0]['esProfesor'];
					if($esProfesor==1){
						//$randomLib = new randomLib();
						//$randomLib->add_allow_alphnum();
						function rand_string( $length ) { $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; return substr(str_shuffle($chars),0,$length); }
						$_POST['pollito'] = rand_string(10);
						$_POST['idDireccion'] = insert_id_direccion_vacia($con);
						$_POST['idUsuario'] = insert_id_query($con, "INSERT INTO usuarios (idPersona, idTipoUsuario, idContacto, idDireccion, pollito) VALUES (?,(SELECT idTipoUsuario FROM tipo_usuario WHERE nombreTipo = 'Profesor'),?,?,?)", "iiis", reorder_array($_POST, ['idPersona', 'idContacto', 'idDireccion', 'pollito']));
						$_POST['idPersonal'] = insert_id_query($con, "INSERT INTO personal (idPersona, idFacturacion, idTipoPersonal, idFormaPago, idContacto, idModalidadPago, sueldo,idSede) VALUES (?,?,?,?,?,?,?,?)", "iiiiiisi", reorder_array($_POST, ['idPersona', 'idFacturacion', 'tipoPersonalSearch', 'formaPagoSearch', 'idContacto', 'modalidadPagoSearch', 'sueldo', 'idSede']));
						if($_POST['idUsuario']>0&&$_POST['idPersonal']>0){
							if(execute_query($con, "INSERT INTO personal_usuario (idPersonal, idUsuario) VALUES (?,?)", 'ii', [$_POST['idPersonal'], $_POST['idUsuario']], false)){
								//if($mailer->sendNewUserEmail($_POST['email'], $_POST['pollito'])){
								if(true){
								echo "s|Agregar Personal|Profesor agregado correctamente.";
								mysqli_commit($con);
								}else{
									echo "e|Agregar Personal|No se pudo enviar el correo al profesor.";
								}
							}else{
								echo "e|Agregar Personal|No se pudo agregar personal. 6 ";
							}
						}else{
							echo "e|Agregar Personal|No se pudo agregar personal. 5 ";
						}
					}else{
						$_POST['idPersonal'] = insert_id_query($con, "INSERT INTO personal (idPersona, idFacturacion, idTipoPersonal, idFormaPago, idContacto, idModalidadPago, sueldo,idSede) VALUES (?,?,?,?,?,?,?,?)", "iiiiiisi", reorder_array($_POST, ['idPersona', 'idFacturacion', 'tipoPersonalSearch', 'formaPagoSearch', 'idContacto', 'modalidadPagoSearch', 'sueldo', 'idSede']));
						if($_POST['idPersonal']>0){
							echo "s|Agregar Personal|Personal agregado correctamente.";
							mysqli_commit($con);
						}else{
							echo "e|Agregar Personal|No se pudo agregar personal. 6 ";
						}
					}
          } else {
              echo "e|Agregar Personal|No se pudo agregar personal. 4 ";
          }
        } else {
            echo "e|Agregar Personal|No se pudo agregar personal. 3";
        }
      } else {
          echo "e|Agregar Personal|No se pudo agregar personal. 2";
      }
?>
