<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-user"></i> </div>
    <div class="text-container"> AGREGAR CLIENTE </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> NOMBRE COMPLETO </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 input-container pre">
          <select class="selectpicker form-input" data-live-search="false" required data-label="Prefijo" id="prefijoSearch" data-name='prefijoSearch'> </select>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-9 input-container">
          <input type="text" class="form-control form-input capitalize" required placeholder="Nombre(s)" id="nombre"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input capitalize" required placeholder="Apellido Paterno" id="apellidoPaterno"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input capitalize" placeholder="Apellido Materno" id="apellidoMaterno"> </div>
        <div class="col-xs-12 col-sm-6 col-md-6 input-container">
          <select class="selectpicker form-input" data-live-search="false" required data-label="Genero" data-script="generoSelect" id="generoSearch" name='Genero'> </select>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 input-container date-container">
          <label class='label-fecha'>FECHA DE NACIMIENTO</label>
          <div class="input-group date" id="fechaSelect"> <span class="input-group-addon">
              <i class="glyphicon glyphicon-calendar"></i>
          </span>
            <input type="text" class="form-control form-input" required id="fechaSelectText"> </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> INFORMACION DE CONTACTO </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="email" class="form-control form-input lowercase" required placeholder="Correo Electronico" id="email"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" required placeholder="Tel. Celular" id="telCelular"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" placeholder="Tel. Casa" id="telCasa"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" placeholder="Tel. Oficina" id="telOficina"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" placeholder="Tel. Otro" id="telOtro"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> CREAR ALUMNO CON CLIENTE </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <div class="col-xs-4 col-sm-1 col-md-1">
            <input type="checkbox" class="form-control form-input" placeholder="Cliente como Alumno" id="checkAlumno"> 
          </div>
          <div class="col-xs-8 col-sm-11 col-md-11">
            <label class="label-check uppercase">Al elegir esta opci&oacute;n, se creará un alumno con la informaci&oacute;n proporcionada de este cliente.</label>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DATOS DE FACTURACION </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input uppercase" placeholder="RFC" id="rfc"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DIRECCION FISCAL </div>
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
        <div class="col-xs-12 col-sm-4 col-md-4 marTop-md input-container">
          <input type="text" placeholder="Ciudad" id="citySum" name='Ciudad' disabled/> </div>
        <div class="col-xs-12 col-sm-4 col-md-4 input-container marTop-md">
          <input type="text" placeholder="Estado" id="stateSum" name='Estado' disabled/> </div>
        <div class="col-xs-12 col-sm-4 col-md-4 input-container marTop-md">
          <input type="text" placeholder="Pa&iacute;s" id="countrySum" name='pais' disabled/>
          <input type="hidden" id="countryIdSum" name='Pais' /> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-form="form-input" data-script="agregarCliente" data-function="afterEdit" data-clear="true" id="agregarCliente">Guardar</button>
        </div>
      </fieldset>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(1, 1);
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