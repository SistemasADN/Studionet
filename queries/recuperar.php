<?php
	include "../validation/classValidator.php";
    include "../mailer/emailFunctions.php";
	$validator = new Validator();
	$rules = array ();
	$rules["email"] = 		    ['r' => true , 	't' => "email"];
	$validator->setRules($rules);
	$validator->validateArray($_POST);
    $fetch; $fetch2;
	if($validator->isValid()){
      include_once "dbcon.php";//Conexion a la BD
		$stmt = mysqli_prepare(
          $con, 
          "SELECT cl.idCliente, cl.idContacto FROM clientes AS cl
          LEFT JOIN contacto AS c
          ON cl.idContacto = c.idContacto
          WHERE c.email = ?
          AND activo = 1")
          or die (mysqli_error($con));
		mysqli_stmt_bind_param($stmt, 's', $_POST['email'])  or die (mysqli_error($con));
		mysqli_stmt_bind_result($stmt, $idCliente, $idContacto);
		if(mysqli_stmt_execute($stmt)){
          $fetch = mysqli_stmt_fetch($stmt);
          //If fetch regreso algo.
          if($fetch===true){
            $mailer = new emailFunctions();
            if($mailer->sendRecoveryPass($_POST['email'], 'c', $idContacto)){
              header("Location: ../correoEnviado.php");
            } else {
              header("Location: ../index.php?err=1b");
            }
          } else if($fetch===false) {
            //fetch failed error.
            header("Location: ../index.php?err=2b");
          } else if($fetch===null) {
            //No ocurrencies from fetch. Check user table.
            mysqli_stmt_free_result($stmt);
            $stmt2 = mysqli_prepare(
              $con,
              "SELECT u.idUsuario, u.idContacto FROM usuarios AS u
              LEFT JOIN contacto AS c
              ON u.idContacto = c.idContacto
              WHERE c.email = ?
              AND ACTIVO = 1") 
              or die (mysqli_error($con));
            mysqli_stmt_bind_param($stmt2, 's', $_POST['email'])  or die (mysqli_error($con));
		    mysqli_stmt_bind_result($stmt2, $idUsuario, $idContacto);
            if(mysqli_stmt_execute($stmt2)){
              $fetch2 = mysqli_stmt_fetch($stmt2);
              //If fetch regreso algo.
              if($fetch2===true){
                $mailer = new emailFunctions();
                if($mailer->sendRecoveryPass($_POST['email'],'u', $idContacto)){
                  header("Location: ../correoEnviado.php");
                } else {
                  header("Location: ../index.php?err=3b");
                }
              } else {
                //fetch error o no trajo nada
                session_destroy();
                header("Location: ../index.php?err=4b");
              }
            } else {
              //stmt2 execute failed.
              session_destroy();
              header("Location: ../index.php?err=5b");
            }
          } else {
            //fetch es otra cosa
            session_destroy();
            header("Location: ../index.php?err=6b");
          }
        } else {
          //stmt execeute failed.
          session_destroy();
          header("Location: ../index.php?err=7b");
        }
      } else {
        //Not valid.
        session_destroy();
        header("Location: ../index.php?err=8b");
      }
?>