<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
    session_start();
	//Reglas
	$rules = array ();
    //var_dump($_SESSION);exit;
	$rules['contraActual'] =        ['r' => true , 	't' => "alphnum"];
    $rules['contraNueva'] =         ['r' => true , 	't' => "alphnum"];
    $rules['contraNuevaRepetir'] =  ['r' => true , 	't' => "alphnum"];
    
    $validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
    //If Usuario
    if(isset($_SESSION['idUsuario'])){
      //Get Pass
      $pass = select_query($con, 
                   'SELECT pollito FROM usuarios WHERE idUsuario = ?', 'i', [$_SESSION['idUsuario']]);
      if($_POST['contraActual'] == $pass[0]['pollito']){
        if($_POST['contraNueva'] == $_POST['contraNuevaRepetir']){
          if(execute_query($con, 'UPDATE usuarios SET pollito = ? WHERE idUsuario = ?','si', [$_POST['contraNueva'], $_SESSION['idUsuario']])){
            echo "s|Cambiar Contrasena|Su contrasena ha sido actualizada con exito.";
          } else {
            echo "e|Cambiar Contrasena|No se pudo actualizar la contrasena.";
          }
        } else {
          echo "e|Cambiar Contrasena|Las contrasenas nuevas son incorrectas.";
        }
      } else {
        echo "e|Cambiar Contrasena|La contrasena actual es incorrecta.";
      }
    } else {
      $pass = select_query($con, 
                           'SELECT pollito FROM clientes WHERE idCliente = ?', 'i', [$_SESSION['idCliente']]);
      if($_POST['contraActual'] == $pass[0]['pollito']){
        if($_POST['contraNueva'] == $_POST['contraNuevaRepetir']){
          if(execute_query($con, 'UPDATE clientes SET pollito = ? WHERE idCliente = ?','si', [$_POST['contraNueva'], $_SESSION['idCliente']])){
            echo "s|Cambiar Contrasena|Su contrasena ha sido actualizada con exito.";
          } else {
            echo "e|Cambiar Contrasena|No se pudo actualizar la contrasena.";
          }
        } else {
          echo "e|Cambiar Contrasena|Las contrasenas nuevas son incorrectas.";
        }
      } else {
        echo "e|Cambiar Contrasena|La contrasena actual es incorrecta.";
      }
    }
?>