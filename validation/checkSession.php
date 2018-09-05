<?php

	if(!isset($_SESSION)){
        session_start();
  }
	//var_dump($_SESSION);exit;
	if(isset($_SESSION['idUsuario'])&&isset($_SESSION['idTipoUsuario'])&&isset($_SESSION['idPersona'])&&isset($_SESSION['idContacto'])){
	//if(isset($_SESSION['idUsuario'])&&isset($_SESSION['username'])&&$_SESSION['timeout'] + 1.5 * 60 >= time()){ echo "R";
		//if(str_replace(".php","",basename($_SERVER['PHP_SELF']))!="checkSession"){
			/*
			if(!isset($_SESSION['nombre'])){
				include_once '../queries/nombreClienteGet.php';
				$nombreClienteFull = '';
				$nombreClienteFull = getNameOfId();
				$nombreClienteFull = $nombreClienteFull[0]['nombre'];
				$_SESSION['nombre'] = $nombreClienteFull;
			}
			*/
		//}

		//$_SESSION['timeout'] = time();
	}else{
		session_unset();
		session_destroy();
		header("Location: index.php?err=ns");
	}

	function onlyAllow($perms, $userType){
		//var_dump($userType);
		if (strpos($perms, (string) $userType) === false) {
			exit;
		}
	}

	function getPerm($perms, $userType){
		//var_dump($userType);
		if (strpos($perms, (string) $userType) === false) {
			return false;
		}
		return true;
	}
?>
