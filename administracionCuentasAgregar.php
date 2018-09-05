<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-credit-card"></i> </div>
    <div class="text-container"> AGREGAR CUENTA </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"><abbr title = 'Por favor llene los datos necesarios para generar una cuenta'>DATOS DE CUENTA</abbr></div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-9 input-container">
          <input type="text" class="form-control form-input capitalize" required placeholder="Nombre Cuenta" id="nombreCuenta"> </div>
          <div class="col-xs-12 col-sm-9 col-md-9 input-container">
            <input type="text" class="form-control form-input capitalize"  placeholder="Banco" id="nombreBanco"> </div>
          <div class="col-xs-12 col-sm-9 col-md-9 input-container">
            <input type="text" class="form-control form-input capitalize"  placeholder="Número de cuenta" id="numeroCuenta"> </div>
          <div class="col-xs-12 col-sm-9 col-md-9 input-container">
              <input type="text" class="form-control form-input capitalize" data-elength = '18'  placeholder="CLABE" id="clabe"> </div>
          <div class="col-xs-12 col-sm-9 col-md-9 input-container">
              <input type="text" class="form-control form-input capitalize"  placeholder="Número de cliente" id="numeroCliente"> </div>
          <div class="col-xs-12 col-sm-9 col-md-9 input-container">
                <input type="number" data-subtype = 'coin' class="form-control form-input capitalize" required placeholder="Monto Inicial" id="montoInicial"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-form="form-input" data-script="agregarCuenta" data-function="afterEdit" data-clear="true" id="agregarCliente">AGREGAR CUENTA</button>
        </div>
      </fieldset>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(8,1);
        Utilizer.makeDatepicker('fechaSelect');
        Utilizer.loadSelect('prefijoSearch', 'prefijoSelect', 'Prefijo');
        Utilizer.loadSelect('generoSearch', 'generoSelect', 'Genero');
        FormEngine.setFormEngine('agregarCliente');
        $('#postalcodeSum').on('change', Utilizer.loadDireccion);
      });

      function afterEdit(data, extra) {
        console.log(data);
        console.log(extra);
        Utilizer.makeDatepicker('fechaSelect');
      }
    </script>
