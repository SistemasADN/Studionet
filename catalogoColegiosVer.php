<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-graduation-cap"></i> </div>
    <div class="text-container"> VER COLEGIOS </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="colegiosVer" data-pdf = true data-csv = true data-copy = true data-xls = true data-titulo = "Colegios" >
      <thead>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">DIRECCIÓN</th>
          <th class="table-column-title">NOMBRE DE CONTACTO</th>
          <th class="table-column-title">CORREO DE CONTACTO</th>
          <th class="table-column-title">TELÉFONO</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">DIRECCIÓN</th>
          <th class="table-column-title">NOMBRE CONTACTO</th>
          <th class="table-column-title">CORREO</th>
          <th class="table-column-title">TELÉFONO</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <!-- Modal Edit -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modaleditarColegio">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-navicon"></i> </div>
            <div class="text-container"><abbr title = 'Modifique los datos que desea editar'>EDITAR COLEGIO</abbr></div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DATOS DE COLEGIO </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type='hidden' id='idColegio' class='form-input' />
                <input type="text" class="form-control form-input capitalize" required placeholder="Nombre del Colegio" id="colegio"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DIRECCIÓN DE COLEGIO </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input capitalize" data-minlength="1" data-maxlength="30" data-label="Calle" data-subtype="alphnum" id="calle" placeholder="Calle" name="Calle"> </div>
              <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input" data-minlength="1" data-maxlength="10" data-label="Número exterior" data-subtype="alphnum" id="numExt" placeholder="No. Exterior" name='NoExterior'> </div>
              <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input" data-minlength="1" data-maxlength="10" data-label="Número interior" data-subtype="alphnum" id="numInt" placeholder="No. Interior" name='NoInterior'> </div>
              <div class="col-xs-12 col-sm-12 col-md-4 input-container">
                <input type="text" class="form-control form-input" data-minlength="4" data-maxlength="5" data-label="Codigo Postal" data-subtype="alphnum" id="postalcodeSum" placeholder="C.P." name='CP'> </div>
              <!-- Colonia search -->
              <div class="col-xs-12 col-sm-12 col-md-8 input-container">
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
                <input type="text" placeholder="País" id="countrySum" disabled/>
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
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> ESTADO COLEGIO </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <div class="col-xs-12 col-md-12 col-md-9">
                  <input type="checkbox" id="estatus" checked data-true="ACTIVO" data-false="INACTIVO" class='form-input switcher'> </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" data-function='afterEdit' data-form="form-input" data-script="editarColegio" data-clear="true" id="editarColegio">editar colegio</button>
              </div>
            </fieldset>
          </div>
        </div>
        <div class="modal-footer"> </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(12);
        tableUtilities.createTable('colegiosVer', ['colegio', 'dirCompleta', 'nombreContacto', 'correo', 'telefono', 'estatus', 'acciones'], [ {
          key:'estatus',
          default:0,
          text: 'INACTIVO',
          activeValue: 'ACTIVO'
        }]);
        tableUtilities.setUniqueColumns('colegiosVer', ['idColegio']);
        tableUtilities.loadScript('colegiosVer', 'getColegio', {}, agregarColegio);
        FormEngine.setFormEngine('editarColegio');
        modalUtilities.Initialize('editarColegio');
        $("#postalcodeSum").change(Utilizer.loadDireccion);
      });

      function agregarColegio(data) {
        data.dirCompleta = Utilizer.concatenateDireccion(data);
        data.estatus = data.activo == 1 ? "ACTIVO" : "INACTIVO";
        data.buttons = [["Editar", "btn-edit", editarColegio]];
        if (data.dirCompleta === "") {
          data.dirCompleta = "N/E";
        }
        if (data.nombreContacto === "") {
          data.nombreContacto = "N/E";
        }
        if (data.correo === "") {
          data.correo = "N/E";
        }
        if (data.telefono === "") {
          data.telefono = "N/E";
        }
        console.log(data);
        return data;
      }

      function editarColegio(event) {
        var data = tableUtilities.getDataFromEvent(event);
        if (data.dirCompleta === "N/E") {
          data.dirCompleta = "";
        }
        if (data.nombreContacto === "N/E") {
          data.nombreContacto = "";
        }
        if (data.correo === "N/E") {
          data.correo = "";
        }
        if (data.telefono === "N/E") {
          data.telefono = "";
        }
        if (data.postalcodeSum === 0) {
          data.postalcodeSum = "";
        }
        modalUtilities.LoadShow('editarColegio', data);
      }

      function afterEdit(data, extra) {
        $("#modaleditarColegio").modal('hide');
        tableUtilities.loadScript('colegiosVer', 'getColegio', {}, agregarColegio);
      }
    </script>
