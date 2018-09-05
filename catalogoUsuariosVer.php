<?php include 'templates/top.php';
  //onlyAllow('1', $_SESSION['idTipoUsuario']);
  //var_dump($_SESSION)
?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-user-circle-o"></i> </div>
    <div class="text-container"> VER USUARIOS </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="usuariosVer">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE COMPLETO</th>
          <th class="table-column-title">CORREO</th>
          <?php if($_SESSION['nombreUsuario']=="Soporte Academianet "&&$_SESSION['tipoUsuario']=='Soporte'): ?>
            <th class="table-column-title">PWD</th>
          <?php endif; ?>
          <th class="table-column-title">DIRECCIÓN</th>
          <th class="table-column-title">TELÉFONO CELULAR</th>
          <th class="table-column-title">TIPO USUARIO</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE COMPLETO</th>
          <th class="table-column-title">CORREO</th>
          <?php if($_SESSION['nombreUsuario']=="Soporte Academianet "&&$_SESSION['tipoUsuario']=='Soporte'): ?>
            <th class="table-column-title">PWD</th>
          <?php endif; ?>
          <th class="table-column-title">DIRECCIÓN</th>
          <th class="table-column-title">TELÉFONO CELULAR</th>
          <th class="table-column-title">TIPO USUARIO</th>
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
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> NOMBRE COMPLETO </div>
                </div>
              </div>
              <input type="hidden" class="form-input" id="idUsuario">
              <input type="hidden" class="form-input" id="idDireccion">
              <input type="hidden" class="form-input" id="idContacto">
              <input type="hidden" class="form-input" id="idPersona">
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input capitalize" required placeholder="Nombre(s)" id="nombre"> </div>
              <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input capitalize" required placeholder="Apellido Paterno" id="apellidoPaterno"> </div>
              <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input capitalize" placeholder="Apellido Materno" id="apellidoMaterno"> </div>
              <div class="col-xs-12 col-sm-6 col-md-6 input-container">
                <select class="selectpicker form-input" data-live-search="false" required data-script="generoSelect" data-label="Genero" id="generoSearch" name='Genero'> </select>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 input-container date-container">
                <label class='label-fecha'>FECHA DE NACIMIENTO</label>
                <div class="input-group date form-input" id="fechaSelect"> <span class="input-group-addon">
                  <i class="glyphicon glyphicon-calendar"></i>
              </span>
                  <input type="text" class="form-control form-input" required id="fechaSelectText"> </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> TIPO DE USUARIO </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <select class="selectpicker form-input" data-live-search="false" data-script="tipousuarioSelect" required data-label="Tipo de Usuario" id="tipousuarioSearch" name='Tipo de Usuario'> </select>
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
                  <div class="jumbotron-text"> DIRECCIÓN </div>
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
                <input type="text"  placeholder="Ciudad" id="citySum" name='Ciudad' disabled/> </div>
              <div class="col-xs-12 col-sm-4 col-md-4 marTop-md input-container">
                <input type="text"  placeholder="Estado" id="stateSum" name='Estado' disabled/> </div>
              <div class="col-xs-12 col-sm-4 col-md-4 marTop-md input-container">
                <input type="text"  placeholder="Pa&iacute;s" id="countrySum" name='pais' disabled/>
                <input type="hidden" id="countryIdSum" name='Pais' /> </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <div class="col-xs-12 col-md-12 col-md-9">
                  <input type="checkbox" id="estatus" checked data-true="ACTIVO" data-false="INACTIVO" class='form-input switcher'> </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" data-form="form-input" data-script="editarUsuario" data-function="afterEdit" data-clear="true" id="editarUsuario">editar usuario</button>
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
        <?php if($_SESSION['nombreUsuario']=="Soporte Academianet "&&$_SESSION['tipoUsuario']=='Soporte'): ?>
          tableUtilities.createTable('usuariosVer', ['nombreCompleto', 'email', 'pollito','dirCompleta', 'telCelular', 'tipoUsuario', 'estatus', 'acciones'], ['tipoUsuario']);
        <?php else: ?>
          tableUtilities.createTable('usuariosVer', ['nombreCompleto', 'email', 'dirCompleta', 'telCelular', 'tipoUsuario', 'estatus', 'acciones'], ['tipoUsuario']);

        <?php endif; ?>

        tableUtilities.setUniqueColumns('usuariosVer', ['idUsuario']);
        tableUtilities.loadScript('usuariosVer', 'getUsuario', {}, agregarUsuario);
        FormEngine.setFormEngine('editarUsuario');
        modalUtilities.Initialize('editarUsuario');
        Utilizer.makeDatepicker('fechaSelect');
        $("#postalcodeSum").change(Utilizer.loadDireccion);
      });

      function agregarUsuario(data) {
        <?php if($_SESSION['nombreUsuario']=="Soporte Academianet " && $_SESSION['tipoUsuario']=='Soporte'): ?>
            data.pollito = "<div style = 'text-transform: none;'>"+data.pollito+"</div>";
        <?php endif ?>
        data.nombreCompleto = data.nombre + " " + data.apellidoPaterno;
        data.nombreCompleto = data.apellidoMaterno != "" ? data.nombreCompleto + " " + data.apellidoMaterno : data.nombreCompleto;
        data.dirCompleta = Utilizer.concatenateDireccion(data);
        data.dirCompleta = data.dirCompleta == "" ? "N/E" : data.dirCompleta;
        data.estatus = data.activo == 1 ? "ACTIVO" : "INACTIVO";
        data.fechaSelectText = Utilizer.fechaDbParseToFecha(data.fechaNacimiento);
        data.postalcodeSum = data.postalcodeSum == 0 ? "" : data.postalcodeSum;
        data.buttons = [["Editar", "btn-edit", editarCliente]];
        return data;
      }

      function editarCliente(event) {
        var data = tableUtilities.getDataFromEvent(event);
        data.generoSearch = data.idGenero;
        data.tipousuarioSearch = data.idTipoUsuario;
        data.street = data.calle;
        data.fechaSelect = data.fechaNacimiento;
        modalUtilities.LoadShow('editarUsuario', data);
      }

      function afterEdit(data, extra) {
        $("#modaleditarUsuario").modal('hide');
        tableUtilities.loadScript('usuariosVer', 'getUsuario', {}, agregarUsuario);
      }
    </script>
