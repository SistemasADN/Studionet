<?php
  date_default_timezone_set('America/Mexico_City');
  class emailFunctions{  
    /*Send email to a new created client*/
    function sendNewClientEmail($email, $token){
      include 'class.phpmailer.php';
      if(isset($token) && isset($email)){
        /*Body of e-mail.*/
        $link = explode('/', $_SERVER['REQUEST_URI']);
        array_pop($link);
        array_pop($link);
        $l='';
        for($i=0; $i<sizeof($link); $i++){
          $l = $l.$link[$i].'/';
        }
        $message = 
        '<p align=center style=font-weight:bold>Creacion de Cliente Nuevo</p>'.
        '<br><br><br>'.
        '<p>Estimado cliente,</p>'.
        '<br><br>'.
        'Se ha creado una nueva cuenta de cliente en Macarena con este correo.'.
        '<br><br>'.
        'Su contrase&nacute;a es la siguiente: '.$token.
        '<br>'.
        'Puede entrar al sistema en la siguiente liga: http://'.$_SERVER['SERVER_NAME'].$l.
        '<br><br>'.
        'NOTA: Por motivos de seguridad de su cuenta, se recomienda que cambie su contrase&nacute;a.'.
        '<br>'.
        'Favor de NO RESPONDER a este correo.'.
        '<br><br>'.
        'Atentamente,'.
        '<br>'.
        'Macarena Baile'.
        '<br>'.
        'soporte@macarenabaile.com';
        /*Subject*/
        $subject = 'Creacion de Cliente Nuevo';
        /*Enviado de*/
        $from = 'no-reply@macarenabaile.com';
        /*PhpMailer info*/
        $mail = new PHPMailer();
        /*Mail Options*/
        $mail->FromName = "No-Reply Macarena Baile";
        $mail->IsHTML(true);
        $mail->Host = 'email-smtp.us-west-2.amazonaws.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'send-email-nuvet';  //domain email
        $mail->Password = 'Ne||c(vG1ZTj';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->From = $from;
        $mail->addAddress($email);
        $mail->addReplyTo($from, 'No-Reply Macarena Baile');
        $mail->Subject = $subject;
        $mail->Body = $message;
        /*Send E-Mail*/
        if($mail->Send()){
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
    }

    /*Send email to a new created USER*/
    function sendNewUserEmail($email, $token){
      include 'class.phpmailer.php';
      if(isset($token) && isset($email)){
        /*Body of e-mail.*/
        $link = explode('/', $_SERVER['REQUEST_URI']);
        array_pop($link);
        array_pop($link);
        $l='';
        for($i=0; $i<sizeof($link); $i++){
          $l = $l.$link[$i].'/';
        }
        $message = 
        '<p align=center style=font-weight:bold>Creacion de Usuario Nuevo</p>'.
        '<br><br><br>'.
        '<p>Estimado usuario,</p>'.
        '<br><br>'.
        'Se ha creado una nueva cuenta de usuario en Macarena con este correo.'.
        '<br><br>'.
        'Su contrase&nacute;a es la siguiente: '.$token.
        '<br>'.
        'Puede entrar al sistema en la siguiente liga: http://'.$_SERVER['SERVER_NAME'].$l.
        '<br><br>'.
        'NOTA: Por motivos de seguridad de su cuenta, se recomienda que cambie su contrase&nacute;a.'.
        '<br>'.
        'Favor de NO RESPONDER a este correo.'.
        '<br><br>'.
        'Atentamente,'.
        '<br>'.
        'Macarena Baile'.
        '<br>'.
        'soporte@macarenabaile.com';
        /*Subject*/
        $subject = 'Creacion de Usuario Nuevo';
        /*Enviado de*/
        $from = 'no-reply@macarenabaile.com';
        /*PhpMailer info*/
        $mail = new PHPMailer();
        /*Mail Options*/
        $mail->FromName = "No-Reply Macarena Baile";
        $mail->IsHTML(true);
        $mail->Host = 'email-smtp.us-west-2.amazonaws.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'send-email-nuvet';  //domain email
        $mail->Password = 'Ne||c(vG1ZTj';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->From = $from;
        $mail->addAddress($email);
        $mail->addReplyTo($from, 'No-Reply Macarena Baile');
        $mail->Subject = $subject;
        $mail->Body = $message;
        /*Send E-Mail*/
        if($mail->Send()){
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
    }


      /*Update token in table*/
      function updateToken($email, $token, $date, $idContacto)
      {
          include '../queries/dbcon.php';
          if($con)
          {
              if(mysqli_autocommit($con, FALSE))
              {	
                  $stmt = mysqli_prepare($con, "INSERT INTO recovery(email, token, date, idContacto) VALUES (?,?,?,?)");
                  mysqli_stmt_bind_param($stmt, 'sssi', 
                                      $email, $token, $date, $idContacto);
                  if(mysqli_stmt_execute($stmt)){
                      mysqli_commit($con);
                      return true;
                  } else {
                      return false;
                  }
              } else {
                  return false;
              }
          }else {
              return false;
          }
      }

      /*Update the generated password to that user.*/
      function addNewPassword($email, $token, $con)
      {
          //include_once 'queries/dbcon.php';
          if($con)
          {

              $stmt = mysqli_prepare($con, "UPDATE usuario SET password='?' WHERE email ='?'");
              mysqli_stmt_bind_param($stmt, 'ss', 
                                  $token, $email);
              if(mysqli_stmt_execute($stmt))
              {
                  return true;
              } else {
                  return false;
              }
          } else {
              return false;
          }
      }

      /*Get email from a given ID*/
      function getEmailFromID($id){
          include 'dbcon.php';
          if($con)
          {
              $stmt = mysqli_prepare($con, "SELECT u.email FROM usuario AS u 
                  LEFT JOIN cliente AS c ON c.idUsuario = u.idUsuario 
                  WHERE c.idCliente = ?");
              mysqli_stmt_bind_param($stmt, 'i', $id);
              mysqli_stmt_bind_result($stmt, $email);
              if(mysqli_stmt_execute($stmt))
              {
                  mysqli_stmt_fetch($stmt);
                  return $email;
              } else {
                  return 'STMT se hizo.';
              }
          } else {
              return 'Con invalid';
          }
      }

      /*Searches email in DB returns true if exists*/
      function searchEmailInDb($email){
          include_once 'queries/dbcon.php';
          if($con){
              $stmt = mysqli_prepare($con, "SELECT email FROM usuario WHERE email = ?");
              mysqli_stmt_bind_param($stmt, 's', $email);
              mysqli_stmt_bind_result($stmt, $result);
              if(mysqli_stmt_execute($stmt)){
                  mysqli_stmt_store_result($stmt);
                  if(mysqli_stmt_num_rows($stmt) != 1){
                      return false;
                  } else {
                      return true;
                  }
              } else {
                  return false;
              }
          } else {
              return false;
          }
      }

      /*Update sent status in the CC with the $folio given.*/
      function updateSentInDb($idCartaCobro){
          include 'dbcon.php';
          if($con)
          {
              $stmt = mysqli_prepare($con, "UPDATE cartacobro SET enviada = 1 WHERE idCartaCobro = ?");
              mysqli_stmt_bind_param($stmt, 'i', $idCartaCobro);
              if(mysqli_stmt_execute($stmt))
              {
                  return true;
              } else {
                  return false;
              }
          } else {
              return false;
          }

      }

      /*Deletes a file specified.*/
      function deleteTmpFile($file){
          if(isset($file)){
              if(unlink($file)){
                  return true;
              } else {
                  return false;
              }
          } else {
              return false;
          }
      }

      /*Sends recovery email with token if token its generated and if it updates in DB.*/
      function sendRecoveryPass($email, $type, $idContacto)
      {
          include 'class.phpmailer.php';
          include 'randomLib.php';
          $randomLib = new randomLib();
          $randomLib->add_allow_alphnum();
          $token = $randomLib->generateString(10);
          $date = date('Y-m-d h:i:s');
          if(isset($token)){
            if($this->updateToken($email, $token, $date, $idContacto)){
              /*Body of e-mail.*/
              $link = explode('/', $_SERVER['REQUEST_URI']);
              array_pop($link);
              array_pop($link);
              $l='';
              for($i=0; $i<sizeof($link); $i++){
                $l = $l.$link[$i].'/';
              }
              $message = 
              '<p align=center style=font-weight:bold>Recuperaci&oacute;n de Contrase&ntilde;a de su Cuenta de Academia Net</p>'.
              '<br><br><br>'.
              '<p>Estimado usuario,</p>'.
              '<br><br>'.
              'Se ha solicidato la recuperaci&oacute;n de su contrase&ntilde;a de su cuenta en Nuvet.'.
              '<br><br>'.
              'Para poder reestablecer su contrase&ntilde;a favor de entrar a la siguiente liga: '.
              '<br>'.
              'http://'.$_SERVER['SERVER_NAME'].$l.'recovery.php?token='.$token.'&t='.$type.
              '<br><br>'.
              'NOTA: La liga solo estar&aacute; disponible por los siguientes 30 minutos.'.
              '<br>'.
              'Si usted no solicit&oacute; la recuperaci&oacute;n de su cuenta, favor de contactarnos en el siguiente correo: '.
              'soporte@academianet.mx'.
              '<br><br>'.
              'Atentamente,'.
              '<br>'.
              'Sistema Academias Net'.
              '<br><br>'.
              'ESTE CORREO SE HA GENERADO AUTOMATICAMENTE. FAVOR NO DE RESPONDER A ESTE CORREO.';
              /*Subject*/
              $subject = 'Recuperacion de Contrasena Academias Net';
              /*Enviado de*/
              $from = 'no-responder@academiasnet.mx';
              /*PhpMailer info*/
              $mail = new PHPMailer();
              /*Mail Options*/
              $mail->FromName = "Recuperacion de Contrasena Academias Net";
              $mail->IsHTML(true);
              $mail->Host = 'email-smtp.us-west-2.amazonaws.com';
              $mail->SMTPAuth = true;
              $mail->Username = 'send-email-nuvet';  //domain email
              $mail->Password = 'Ne||c(vG1ZTj';
              $mail->SMTPSecure = 'tls';
              $mail->Port = 587;
              $mail->From = $from;
              $mail->addAddress($email);
              $mail->Subject = $subject;
              $mail->Body = $message;
              /*Send E-Mail*/
              if($mail->Send())
              {
                return true;
              } else {
                return false;
              }
            } else {
              return false;
            }
        } else {
          return false;
        }
      }



      /*Send email to a new created user*/
      function sendEmailWithFileAttached($email, $emailsToSend, $file, $idCartaCobro, $nombreUsuario){
          include 'class.phpmailer.php';
          if(isset($file) && isset($emailsToSend) && isset($idCartaCobro) && isset($email) && isset($nombreUsuario)){
              /*Body of e-mail.*/
              $message = 
              '<p align=center style=font-weight:bold>Carta de Cobro</p>'.
              '<br><br><br>'.
              '<p>Estimado cliente,</p>'.
              '<br><br>'.
              'Se ha generado una carta de cobro de los servicios prestados.'.
              '<br><br>'.
              'La carta de cobro se encuentra adjunta en el presente correo.'.
              '<br>'.
              '<br><br>'.
              'Atentamente,'.
              '<br>'.
              $nombreUsuario['nombreUsuario'].
              '<br>'.
              'soporte@nuvet.clinic';
              /*Subject*/
              $subject = 'Carta de Cobro Nuvet Clinic';
              /*Enviado de*/
              $from = 'soporte@nuvet.clinic';
              /*PhpMailer info*/
              $mail = new PHPMailer();
              /*Mail Options*/
              $mail->FromName = "Nuvet Clinic";
              $mail->IsHTML(true);
              $mail->Host = 'email-smtp.us-west-2.amazonaws.com';
              $mail->SMTPAuth = true;
              $mail->Username = 'send-email-nuvet';  //domain email
              $mail->Password = 'Ne||c(vG1ZTj';
              $mail->SMTPSecure = 'tls';
              $mail->Port = 587;
              $mail->From = $from;
              $mail->addAddress($email);
              for($i=0;$i<sizeof($emailsToSend);$i++){
                  $mail->AddCC($emailsToSend[$i]);
              }
              $mail->AddCC($from);
              $mail->addReplyTo($from, 'Nuvet Clinic Gestión Veterinaria');
              $mail->Subject = $subject;
              $mail->Body = $message;
              $mail->AddAttachment($file);
              if($mail->Send())
              {
                  if($this->deleteTmpFile($file)){
                      if($this->updateSentInDb($idCartaCobro)){
                          return true;
                      } else {
                          return false;
                      }
                  } else {
                      return false;
                  }
              } else {
                  return false;
              }

          } else {
              return false;
          }
      }
  }
?>