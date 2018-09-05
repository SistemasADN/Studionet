<?php
    date_default_timezone_set('America/Mexico_City');
	$token = $_GET['token'];
    $type = $_GET['t'];
	if(isset($token)){
      include 'queries/dbcon.php';
      if($con){
        $stmt = mysqli_prepare($con, "SELECT token, datetime FROM recovery WHERE token = ? ORDER BY datetime LIMIT 1");
        mysqli_stmt_bind_param($stmt, 's', $token);
        mysqli_stmt_bind_result($stmt, $token, $datetime);
        if(mysqli_stmt_execute($stmt)){
         mysqli_stmt_store_result($stmt);
         if(mysqli_stmt_num_rows($stmt) == 1){
           mysqli_stmt_fetch($stmt);
           $fecha1 = new DateTime($datetime);
           $fecha2 = new DateTime(date('Y-m-d h:i:s'));
           $intervalo = date_diff($fecha1, $fecha2);
           if($intervalo->y==0 && $intervalo->m==0 && $intervalo->d==0 && $intervalo->i<30){  if($intervalo->h<1){
?>
  <!DOCTYPE html>
  <html>
    <head>
      <link rel="icon" type="image/png" href="images/favicon.ico">
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/raleway-webfont.css">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/font-awesome.min.css">
      <link rel="stylesheet" href="css/login.css">
      <link rel="stylesheet" href="css/login_responsive.css">
      <script src="js/jquery-3.1.1.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <title>Academias Net Recuperar</title>
    </head>

    <body>
      <div class="container-fluid fix">
        <div class="row main-container">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 left-container">
            <div class="image-container"> <img src="images/logo_macarena.png" class="img-responsive login-img" alt="Logo"> </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-container">
                <form action="queries/updatePassword.php" method="post">
                  <div class="form-group">
                    <input type="password" name="contraUno" class="form-control" id="contraUno" placeholder="&#xf023; NUEVA CONTRASEÑA"> 
                  </div>
                  <div class="form-group">
                    <input type="password" name="contraDos" class="form-control" id="contraDos" placeholder="&#xf023; REPETIR NUEVA CONTRASEÑA"> 
                  </div>
                  <input type='hidden' name="token" value="<?php print_r($token);?>" />
                  <input type='hidden' name="type" value="<?php print_r($type);?>" />
                  <div class="form-group top-margin-lg">
                    <button type="submit" class="btn btn-default btn-lg" id="loginBtn">CAMBIAR</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </body>
  </html>
<?php
         } else {
?>
  <!DOCTYPE html>
  <html>

    <head>
      <link rel="icon" type="image/png" href="images/favicon.ico">
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/raleway-webfont.css">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/font-awesome.min.css">
      <link rel="stylesheet" href="css/login.css">
      <link rel="stylesheet" href="css/login_responsive.css">
      <script src="js/jquery-3.1.1.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <title>Academias Net</title>
    </head>

    <body>
      <div class="container-fluid fix">
        <div class="row main-container">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 left-container">
            <div class="image-container"> <img src="images/logo_macarena.png" class="img-responsive login-img" alt="Logo"> </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-container">
                <p class="lead">Token invalido. Favor de Intentar nuevamente mas tarde. </p>
                <div class="row text-center top-margin-md"> <a href="index.php" class="link">Regresar</a> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </body>

  </html>
<?php
         }
?>
<?php
                                                                                         } else {
?>
<!DOCTYPE html>
  <html>
   <head>
    <link rel="icon" type="image/png" href="images/favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/raleway-webfont.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/login_responsive.css">
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>Academias Net</title>
  </head>

  <body>
    <div class="container-fluid fix">
      <div class="row main-container">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 left-container">
          <div class="image-container"> <img src="images/logo_macarena.png" class="img-responsive login-img" alt="Logo"> </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-container">
              <p class="lead">Token invalido. Favor de Intentar nuevamente mas tarde. </p>
              <div class="row text-center top-margin-md"> <a href="index.php" class="link">Regresar</a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<?php					
         }
       } else {
         echo 'more than 1 res';
       }
      }else{
        echo 'No se execute';
      }
    }else {
      echo 'con no jala';
    }
  }else {
    echo 'token no jalo';
}
?>