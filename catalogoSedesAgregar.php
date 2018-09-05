<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-institution"></i> </div>
    <div class="text-container"> AGREGAR SUCURSAL </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DATOS DE SUCURSAL </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input capitalize" required placeholder="Nombre de Sucursal" id="nombreSede"> </div>
        <!--Direccion -->
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DIRECCIÓN DE SUCURSAL </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input capitalize" data-minlength="1" data-maxlength="30" data-label="Calle" data-subtype="alphnum" id="street" placeholder="Calle" name="Calle"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" data-minlength="1" data-maxlength="10" data-label="Número exterior" data-subtype="alphnum" id="numExt" placeholder="No. Exterior" name='NoExterior'> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" data-minlength="1" data-maxlength="10" data-label="Número interior" data-subtype="alphnum" id="numInt" placeholder="No. Interior" name='NoInterior'> </div>
        <div class="col-xs-4 col-sm-4 col-md-4 input-container">
          <input type="number" class="form-control form-input" data-minlength="4" data-maxlength="5" data-label="Codigo Postal" data-subtype="alphnum" id="postalcodeSum" placeholder="C.P." name='CP'> </div>
        <!-- Colonia search -->
        <div class="col-xs-8 col-sm-8 col-md-8 input-container">
          <select class="selectpicker form-input" data-live-search="true" id="areaSum" data-label="Colonia">
            <option>Colonia</option>
          </select>
        </div>
        <!-- Ciudad search -->
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 marTop-md input-container">
          <input type="text" placeholder="Ciudad" id="citySum" name='Ciudad' disabled/> </div>
        <!-- Estado search -->
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 marTop-md input-container">
          <input type="text" placeholder="Estado" id="stateSum" name='Estado' disabled/> </div>
        <!-- Pais search -->
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 marTop-md input-container">
          <input type="text" placeholder="Pa&iacute;s" id="countrySum" disabled/>
          <input type="hidden" id="countryIdSum" name='Pais' /> </div>
        <!--/Direccion -->
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-form="form-input" data-script="agregarSede" data-clear="true" id="agregarSede">Agregar sucursal</button>
        </div>
      </fieldset>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(3, 1);
        FormEngine.setFormEngine('agregarSede');
        $('#postalcodeSum').on('change', Utilizer.loadDireccion);
      });
    </script>
