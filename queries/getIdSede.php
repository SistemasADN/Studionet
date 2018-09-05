<?php
	if(!isset($idSede)){
		if(!isset($_SESSION)){
      session_start();
    }
		if(!isset($_SESSION['idSede'])){
				$idSede = null;
		}else{
				$idSede = $_SESSION['idSede'];
		}
	}
?>
