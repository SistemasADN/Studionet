<?php
	if(!isset($con)){
		if($_SERVER['DOCUMENT_ROOT']=="C:/AppServ/www") {
			$dbpass = '@abc123.';
		}else{
			$dbpass = 'r34kt0Rnuvet';   //   acaRoNet321!@#
		}
		$dbuser = 'root';
		$dbhost = 'localhost';
		$dbname = 'studionet_demo_data';  //studionet_demo  academias
		$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
		mysqli_set_charset ($con, "utf8");
	}
?>
