<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-user"></i> </div>
    <div class="text-container"> VER CLIENTES </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive"
      data-pdf = true data-csv = true data-importar = "clientes" data-copy = true data-xls = true data-titulo = "Lista de Clientes" id="clientesVer">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE COMPLETO</th>
          <th class="table-column-title">CORREO</th>
          <th class="table-column-title">DIRECCIÓN</th>
          <th class="table-column-title">TELÉFONO CELULAR</th>
          <th class="table-column-title">NUM. ALUMNOS</th>
          <th class="table-column-title">SEDE</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE COMPLETO</th>
          <th class="table-column-title">CORREO</th>
          <th class="table-column-title">DIRECCIÓN</th>
          <th class="table-column-title">TELÉFONO CELULAR</th>
          <th class="table-column-title">NUM. ALUMNOS</th>
          <th class="table-column-title">SEDE</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <!-- Modal Edit -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modaleditarCliente">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-user"></i> </div>
            <div class="text-container"><abbr title = 'Modifique los datos que desea editar'>  EDITAR CLIENTE</abbr></div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> NOMBRE COMPLETO </div>
                </div>
              </div>
              <input type='hidden' id='idCliente' class='form-input' />
              <input type='hidden' id='idContacto' class='form-input' />
              <input type='hidden' id='idDireccion' class='form-input' />
              <input type='hidden' id='idFacturacion' class='form-input' />
              <input type='hidden' id='idPersona' class='form-input' />
              <input type='hidden' id='numAlumnos' class='form-input' />
              <div class="col-xs-12 col-sm-3 col-md-3 input-container pre">
                <select class="selectpicker form-input" data-script="prefijoSelect" data-live-search="true" required data-label="Prefijo" id="idPrefijo" name='Prefijo'> </select>
              </div>
              <div class="col-xs-12 col-sm-9 col-md-9 input-container">
                <input type="text" class="form-control form-input capitalize" required placeholder="Nombre(s)" id="nombre"> </div>
              <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input capitalize" required placeholder="Apellido Paterno" id="apellidoPaterno"> </div>
              <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input capitalize" placeholder="Apellido Materno" id="apellidoMaterno"> </div>
              <div class="col-xs-12 col-sm-6 col-md-6 input-container">
                <select class="selectpicker form-input" data-live-search="true" data-script="generoSelect" required data-label="Genero" id="idGenero" name='Genero'> </select>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 input-container date-container">
                <label class='label-fecha'>FECHA DE NACIMIENTO</label>
                <div class="input-group date form-input date-input" id="fechaSelect"> <span class="input-group-addon">
                    <i class="glyphicon glyphicon-calendar"></i>
                </span>
                  <input type="text" class="form-control form-input date-input" required id="fechaSelectText"> </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> INFORMACIÓN DE CONTACTO </div>
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
                  <div class="jumbotron-text"> DATOS DE FACTURACIÓN </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input uppercase" placeholder="RFC" id="rfc"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DIRECCIÓN FISCAL </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input capitalize" data-minlength="1" data-maxlength="30" data-label="Calle" data-subtype="alphnum" id="calle" placeholder="Calle" name="Calle"> </div>
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
              <div class="col-xs-12 col-sm-4 col-md-12 marTop-md input-container">
                <input type="text" placeholder="Ciudad" id="citySum" name='Ciudad' disabled/> </div>
              <div class="col-xs-12 col-sm-4 col-md-12 marTop-md input-container">
                <input type="text" placeholder="Estado" id="stateSum" name='Estado' disabled/> </div>
              <div class="col-xs-12 col-sm-4 col-md-12 marTop-md input-container">
                <input type="text" placeholder="Pa&iacute;s" id="countrySum" name='pais' disabled/>
                <input type="hidden" id="countryIdSum" name='Pais' /> </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="jumbotron jumbotron-container">
                    <div class="jumbotron-text"> DATOS ADMINISTRATIVOS </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <select class="selectpicker form-input" required data-live-search="true" data-script="sedeSelect" data-label="Sede" id="idSede" name='Sede'> </select>
                </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <div class="col-xs-12 col-md-12 col-md-9">
                  <input type="checkbox" id="estatus" checked data-true="ACTIVO" data-false="INACTIVO" class='form-input switcher'> </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" data-form="form-input" data-script="editarCliente" data-function="afterEdit" data-clear="true" id="editarCliente">editar cliente</button>
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
        //Csser.collapse(1);
        tableUtilities.createTable('clientesVer', ['nombreCompleto', 'email',
         'dirCompleta', 'telCelular', 'numAlumnos',  'sede', 'estatus', 'acciones'], ['numAlumnos', 'sede', {
           key:'estatus',
           default:0,
           text: 'INACTIVO',
           activeValue: 'ACTIVO'
         }]);
        tableUtilities.setUniqueColumns('clientesVer', ['idCliente']);
        tableUtilities.loadScript('clientesVer', 'getCliente', {}, agregarCliente);
        FormEngine.setFormEngine('editarCliente');
        modalUtilities.Initialize('editarCliente');
        Utilizer.makeDatepicker('fechaSelect');
        $("#postalcodeSum").change(Utilizer.loadDireccion);

      });

      function agregarCliente(data) {
        data.nombreCompleto = data.prefijo + " " + data.nombre + " " + data.apellidoPaterno;
        data.nombreCompleto = data.apellidoMaterno != "" ? data.nombreCompleto + " " + data.apellidoMaterno : data.nombreCompleto;
        data.dirCompleta = Utilizer.concatenateDireccion(data);
        data.dirCompleta = data.dirCompleta == "" ? "N/E" : data.dirCompleta;
        data.estatus = data.estatus == 1 ? "ACTIVO" : "INACTIVO";
        data.fechaSelect = data.fechaNacimiento;
        data.postalcodeSum = data.postalcodeSum == 0 ? "" : data.postalcodeSum;
        data.numAlumnos = data.numAlumnos == null ? 0 : data.numAlumnos;
        data.buttons = [["Editar", "btn-edit", editarCliente]];
        return data;
      }

      function editarCliente(event) {
        Utilizer.setPicker('idPrefijo', '');
        Utilizer.setPicker('idGenero', '');
        var data = tableUtilities.getDataFromEvent(event);
        modalUtilities.LoadShow('editarCliente', data);
      }

      function afterEdit(data, extra) {
        $("#modaleditarCliente").modal('hide');
        tableUtilities.loadScript('clientesVer', 'getCliente', {}, agregarCliente);
      }
    </script>
