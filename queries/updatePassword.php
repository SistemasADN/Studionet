<?php
  $pass1 = $_POST["contraUno"];
  $pass2 = $_POST["contraDos"];
  $token = $_POST["token"];
  $type = $_POST["type"];
  if($pass1 == $pass2){
    include 'dbcon.php';
    $stmt = mysqli_prepare($con, "SELECT email, idContacto FROM recovery WHERE token = ?");
    mysqli_stmt_bind_param($stmt, 's', $token);
    mysqli_stmt_bind_result($stmt, $email, $idContacto);
    if(mysqli_stmt_execute($stmt)){
      mysqli_commit($con);
      mysqli_stmt_fetch($stmt);
      mysqli_stmt_close($stmt);
      // CON ID CONTACTO HACER UPDATE
      if($type=='c'){
        $stmt2 = mysqli_prepare($con, 'UPDATE clientes SET pollito = ? WHERE idContacto = ?');
        mysqli_stmt_bind_param($stmt2, 'si', $pass1, $idContacto);
        if(mysqli_stmt_execute($stmt2)){
          mysqli_commit($con);
          return header('Location: ../index.php');
        } else {
          return header('Location: ../recuperar.php?err=1');  
        }
      } else if($type=='u'){
        $stmt2 = mysqli_prepare($con, 'UPDATE usuarios SET pollito = ? WHERE idContacto = ?');
        mysqli_stmt_bind_param($stmt2, 'si', $pass1, $idContacto);
        if(mysqli_stmt_execute($stmt2)){
          mysqli_commit($con);
          return header('Location: ../index.php');
        } else {
          return header('Location: ../recuperar.php?err=2');  
        }
      } 
    } else {
      return header('Location: ../recuperar.php?err=3');
    }
  } else {
    return header('Location: ../recuperar.php?err=4');
  }
?>