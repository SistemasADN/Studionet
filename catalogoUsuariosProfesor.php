<?php include 'templates/top.php';
  //onlyAllow('1', $_SESSION['idTipoUsuario']);
  //var_dump($_SESSION)
?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-user-circle-o"></i> </div>
    <div class="text-container"> LIGAR USUARIO PROFESOR </div>
  </div>
  <legend>Se pueden ligar todos los usuarios a un perfil de profesor. La tabla muesta todos los usuarios que aún no tienen un perfil de profesor.</legend>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="usuariosVer">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE COMPLETO</th>
          <th class="table-column-title">TIPO</th>
          <th class="table-column-title">CORREO</th>
          <th class="table-column-title">DIRECCIÓN</th>
          <th class="table-column-title">TELÉFONO CELULAR</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE COMPLETO</th>
          <th class="table-column-title">TIPO</th>
          <th class="table-column-title">CORREO</th>
          <th class="table-column-title">DIRECCIÓN</th>
          <th class="table-column-title">TELÉFONO CELULAR</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <!-- Modal Edit -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modaleditarUsuario">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-user-circle-o"></i> </div>
            <div class="text-container"> EDITAR USUARIO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <input type="hidden" class="form-input" id="idUsuario">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DATOS DE FACTURACIÓN </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input uppercase" subtype = 'rfc' placeholder="RFC" id="rfc"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DIRECCIÓN FISCAL </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input capitalize" data-minlength="1" data-maxlength="30" data-label="Calle" data-subtype="alphnum" id="street" placeholder="Calle" name="Calle"> </div>
              <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input" data-minlength="1" data-maxlength="10" data-label="Número exterior" data-subtype="alphnum" id="numExt" placeholder="No. Exterior" name='NoExterior'> </div>
              <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input" data-minlength="1" data-maxlength="10" data-label="Número interior" data-subtype="alphnum" id="numInt" placeholder="No. Interior" name='NoInterior'> </div>
              <div class="col-xs-12 col-sm-4 col-md-4 input-container">
                <input type="number" class="form-control form-input" data-minlength="5" data-maxlength="15" data-label="Codigo Postal" data-subtype="alphnum" id="postalcodeSum" placeholder="C.P." name='CP'> </div>
              <div class="col-xs-12 col-sm-8 col-md-8 input-container">
                <select class="selectpicker form-input" data-live-search="true" id="areaSum" data-label="Colonia">
                  <option>Colonia</option>
                </select>
              </div>
              <div class="col-xs-12 col-sm-4 col-md-4 marTop-md input-container">
                <input type="text" placeholder="Ciudad" id="citySum" name='Ciudad' disabled/> </div>
              <div class="col-xs-12 col-sm-4 col-md-4 marTop-md input-container">
                <input type="text" placeholder="Estado" id="stateSum" name='Estado' disabled/> </div>
              <div class="col-xs-12 col-sm-4 col-md-4 marTop-md input-container">
                <input type="text" placeholder="Pa&iacute;s" id="countrySum" name='pais' disabled/>
                <input type="hidden" id="countryIdSum" name='Pais' /> </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> INFORMACIÓN DE PERSONAL </div>
                </div>
              </div>

              <div class="col-xs-12 col-sm-6 col-md-6 input-container">
                <select class="selectpicker form-input" data-script = 'modalidadPagoSelect' data-live-search="false" required id="modalidadPagoSearch" data-label="Modalidad de Pago">
                  <option>Modalidad de Pago</option>
                </select>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 input-container">
                <select class="selectpicker form-input" data-script = 'formaPagoSelect' data-live-search="false" required id="formaPagoSearch" data-label="Forma de Pago">
                  <option>Forma de Pago</option>
                </select>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 input-container">
                <input type="coin" class="form-control form-input" required data-minlength="1" data-maxlength="30" data-label="Sueld" data-subtype="coin" id="sueldo" placeholder="Sueldo" name="Sueldo"> </div>

              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" data-form="form-input" data-script="fusionUsuarioProfesor" data-function="afterEdit" data-clear="true" id="editarUsuario">Guardar</button>
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
        //Csser.collapse(11);

        tableUtilities.createTable('usuariosVer', ['nombreCompleto', 'tipoUsuario', 'email', 'dirCompleta', 'telCelular', 'estatus', 'acciones']);

        tableUtilities.setUniqueColumns('usuariosVer', ['idUsuario']);
        tableUtilities.loadScript('usuariosVer', 'getUsuarioProfesorList', {}, agregarUsuario);
        FormEngine.setFormEngine('editarUsuario');
        modalUtilities.Initialize('editarUsuario');
        Utilizer.makeDatepicker('fechaSelect');
        $("#postalcodeSum").change(Utilizer.loadDireccion);
      });

      function agregarUsuario(data) {
        data.nombreCompleto = data.nombre + " " + data.apellidoPaterno;
        data.nombreCompleto = data.apellidoMaterno != "" ? data.nombreCompleto + " " + data.apellidoMaterno : data.nombreCompleto;
        data.dirCompleta = Utilizer.concatenateDireccion(data);
        data.dirCompleta = data.dirCompleta == "" ? "N/E" : data.dirCompleta;
        data.estatus = data.activo == 1 ? "ACTIVO" : "INACTIVO";
        data.fechaSelectText = Utilizer.fechaDbParseToFecha(data.fechaNacimiento);
        data.postalcodeSum = data.postalcodeSum == 0 ? "" : data.postalcodeSum;
        data.buttons = [["Crear perfil profesor", "btn-edit", editarCliente]];
        console.log(data);
        return data;
      }

      function editarCliente(event) {
        var data = tableUtilities.getDataFromEvent(event);
        console.log(data);
        Utilizer.fillForm(data);
        $("#modaleditarUsuario").modal('show');
      }

      function afterEdit(data, extra) {
        $("#modaleditarUsuario").modal('hide');
        tableUtilities.loadScript('usuariosVer', 'getUsuarioProfesorList', {}, agregarUsuario);
      }
    </script>
