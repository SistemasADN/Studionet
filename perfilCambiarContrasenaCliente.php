<?php include 'templates/topCliente.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-cog"></i> </div>
    <div class="text-container"> CAMBIAR CONTRASE&Ntilde;A </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> LLENE EL FORMULARIO PARA CAMBIAR SU CONTRASE&Ntilde;A </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="password" class="form-control form-input" required placeholder="Contrase&ntilde;a Actual" id="contraActual"> 
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="password" class="form-control form-input" required placeholder="Contrase&ntilde;a Nueva" id="contraNueva"> 
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="password" class="form-control form-input" required placeholder="Repetir Contrase&ntilde;a Nueva" id="contraNuevaRepetir"> 
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-form="form-input" data-script="cambiarContrasenaCliente" data-clear="true" id="cambiarContrasena">Guardar</button>
        </div>
      </fieldset>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(1);
        FormEngine.setFormEngine('cambiarContrasena');
      });
    </script>