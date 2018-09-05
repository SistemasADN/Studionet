<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-graduation-cap"></i> </div>
    <div class="text-container"> AGREGAR COLEGIO </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"><abbr title = 'Por favor llene la forma para agregar un colegio al sistema'>DATOS DE COLEGIO</abbr></div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input capitalize" required placeholder="Nombre de Colegio" id="nombreColegio"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DIRECCIÓN DE COLEGIO </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input capitalize" data-minlength="1" data-maxlength="30" data-label="Calle" data-subtype="alphnum" id="street" placeholder="Calle" name="Calle"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" data-minlength="1" data-maxlength="10" data-label="Número exterior" data-subtype="alphnum" id="numExt" placeholder="No. Exterior" name='NoExterior'> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" data-minlength="1" data-maxlength="10" data-label="Número interior" data-subtype="alphnum" id="numInt" placeholder="No. Interior" name='NoInterior'> </div>
        <div class="col-xs-12 col-sm-4 col-md-4 input-container">
          <input type="text" class="form-control form-input" data-minlength="4" data-maxlength="5" data-label="Codigo Postal" data-subtype="alphnum" id="postalcodeSum" placeholder="C.P." name='CP'> </div>
        <div class="col-xs-12 col-sm-8 col-md-8 input-container">
          <select class="selectpicker form-input" data-live-search="true" id="areaSum" data-label="Colonia">
            <option>Colonia</option>
          </select>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 marTop-md input-container">
          <input type="text" placeholder="Ciudad" id="citySum" name='Ciudad' disabled/> </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 marTop-md input-container">
          <input type="text" placeholder="Estado" id="stateSum" name='Estado' disabled/> </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 marTop-md input-container">
          <input type="text" placeholder="Pa&iacute;s" id="countrySum" disabled/>
          <input type="hidden" id="countryIdSum" name='Pais' /> </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> INFORMACIÓN DE CONTACTO </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input capitalize" placeholder="Nombre de Contacto" id="nombreContacto"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input lowercase" placeholder="Correo Electrónico" id="correo"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input capitalize" placeholder="Puesto" id="puesto"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" placeholder="Teléfono" id="telefono"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" placeholder="Teléfono Otro" id="telefonoOtro"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-form="form-input" data-script="agregarColegio" data-clear="true" id="agregarColegio">agregar colegio</button>
        </div>
      </fieldset>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(12, 1);
        FormEngine.setFormEngine('agregarColegio');
        $('#postalcodeSum').on('change', Utilizer.loadDireccion);
      });
    </script>
