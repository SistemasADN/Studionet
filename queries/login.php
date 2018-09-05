<?php
	error_reporting(E_ALL);
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array ();
	$rules["email"] = 		    ['r' => true , 	't' => "email"];
	$rules["password"] = 		['r' => true , 	't' => "alphnum"];
	$validator->setRulesValidateArray($rules, $_POST);
  include_once "dbcon.php";//Conexion a la BD
	if($validator->isValid()){
		$cliente = select_query_one($con,
	          "SELECT c.idCliente, c.idPersona, c.idContacto
	          	FROM clientes AS c
	              LEFT JOIN contacto AS co
	                ON c.idContacto = co.idContacto
	            WHERE BINARY c.pollito = ?
	              AND co.email = ?
	              AND c.activo = 1", 'ss', [$_POST['password'], $_POST['email']]);
		if($cliente!==false){ //Es un cliente
			if(!isset($_SESSION)){
				session_destroy();
				header("Location: ../index.php?err=0");
				session_start();
				$_SESSION['idTipoUsuario'] = 6;
				$_SESSION['idUsuario'] = $idCliente;
				$_SESSION['idPersona'] = $idPersona;
				$_SESSION['idContacto'] = $idContacto;
				header("Location: ../homeCliente.php");
			}else{
				session_destroy();
				header("Location: ../index.php?err=1");
			}
		}else{ //No es un cliente
			if(!isset($_SESSION)){
				session_start();
			}
			$usuario = select_query_one($con,
			        "SELECT u.idUsuario, u.idTipoUsuario, u.idPersona, u.idContacto FROM usuarios AS u
							 LEFT JOIN contacto AS co ON u.idContacto = co.idContacto
			         WHERE BINARY u.pollito = ? AND co.email = ? AND u.activo = 1",
							 'ss', [$_POST['password'],$_POST['email']]);
			//var_dump($usuario);
			if($usuario!==false){ //Es un usuario
					$idPersonal = select_query_one($con, "SELECT idPersonal FROM personal_usuario WHERE idUsuario = ?", 'i', [$usuario['idUsuario']]); //var_dump($idPersonal);	var_dump($usuario);
					$esProfesorYPersonal = true;
					if($idPersonal===false){
						$esProfesorYPersonal = false;
					}else if($usuario['idTipoUsuario']===3){
						$esProfesorYPersonal = false;
						$_SESSION['idPersonal'] = $idPersonal['idPersonal'];
					}else{
						$_SESSION['idPersonal'] = $idPersonal['idPersonal'];
					}
					$_SESSION['esProfesorYUsuario'] = $esProfesorYPersonal;
					$_SESSION['idUsuario'] = $usuario['idUsuario'];
					$_SESSION['idTipoUsuario'] = $usuario['idTipoUsuario'];
					$_SESSION['idPersona'] = $usuario['idPersona'];
					$_SESSION['idContacto'] = $usuario['idContacto'];
					//var_dump($_SESSION);exit;
					header("Location: ../home.php");
			}else{
				session_destroy();
				header("Location: ../index.php?err=2");
			}
		}
	}else{
		session_destroy();
		header("Location: ../index.php?err=3");

	}
?>
