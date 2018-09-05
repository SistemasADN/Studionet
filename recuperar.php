<!DOCTYPE html>
<html lang='es'>

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
        <div class="image-container"> <img src="images/LogoStudioNet.png" class="img-responsive login-img" alt="Logo"> </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-container">
            <form action="queries/recuperar.php" method="post">
              <p class="lead">Ingrese el correo con el que ingresa al sistema. Se le enviar&aacute;n instrucciones para reestablecer su contrase&ntilde;a al correo. </p>
              <div class="form-group">
                <input type="email" name="email" class="form-control" id="email" placeholder="&#xf2c0; USUARIO"> </div>
              <div class="form-group top-margin-lg">
                <button type="submit" class="btn btn-default btn-lg" id="loginBtn">RECUPERAR</button>
              </div>
            </form>
            <div class="row text-center top-margin-md"> <a href="index.php" class="link">Regresar</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
