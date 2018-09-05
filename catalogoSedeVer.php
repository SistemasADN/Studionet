<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-institution"></i> </div>
    <div class="text-container"> VER SUCURSALES </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="sedesVer">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">DIRECCIÓN</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">DIRECCIÓN</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <!-- Modal Edit -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modaleditarSede">
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
            <div class="text-container"> EDITAR SUCURSAL </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DATOS DE SUCURSAL </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type='hidden' id='idSede' class='form-input' />
                <input type="text" class="form-control form-input" required placeholder="Nombre de Sucursal" id="nombreSede"> </div>
              <!--Direccion -->
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DIRECCIÓN DE SUCURSAL </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input capitalize" data-minlength="1" data-maxlength="30" data-label="Calle" data-subtype="alphnum" id="calle" placeholder="Calle" name="Calle"> </div>
              <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input" data-minlength="1" data-maxlength="10" data-label="Número exterior" data-subtype="alphnum" id="numExt" placeholder="No. Exterior" name='NoExterior'> </div>
              <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input" data-minlength="1" data-maxlength="10" data-label="Número interior" data-subtype="alphnum" id="numInt" placeholder="No. Interior" name='NoInterior'> </div>
              <div class="col-xs-12 col-sm-12 col-md-4 input-container">
                <input type="number" class="form-control form-input" data-minlength="4" data-maxlength="15" data-label="Codigo Postal" data-subtype="alphnum" id="postalcodeSum" placeholder="C.P." name='CP'> </div>
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
                <input type="text" placeholder="Pa&iacute;s" id="countrySum" disabled/>
                <input type="hidden" id="countryIdSum" name='Pais' /> </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> ESTADO SUCURSAL </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <div class="col-xs-12 col-md-12 col-md-9">
                  <input type="checkbox" id="estatus" checked data-true="ACTIVO" data-false="INACTIVO" class='form-input switcher'> </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" data-function='afterEdit' data-form="form-input" data-script="editarSede" data-clear="true" id="editarSede">editar sucursal</button>
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
        //Csser.collapse(3);
        tableUtilities.createTable('sedesVer', ['nombreSede', 'dirCompleta', 'estatus', 'acciones']);
        tableUtilities.setUniqueColumns('sedesVer', ['idSede']);
        tableUtilities.loadScript('sedesVer', 'getSede', {}, agregarSede);
        FormEngine.setFormEngine('editarSede');
        modalUtilities.Initialize('editarSede');
        $("#postalcodeSum").change(Utilizer.loadDireccion);


      });
      function agregarSede(data) {
        console.log(data);
        if(data.postalcodeSum == 0){
          data.postalcodeSum = "";
        }
        data.dirCompleta = Utilizer.concatenateDireccion(data);
        if(data.dirCompleta == ""){
          data.dirCompleta = "N/E";
        }
        data.estatus = data.activo == 1 ? "ACTIVO" : "INACTIVO";
        data.buttons = [["Editar", "btn-edit", editarSede]];
        return data;
      }
      function editarSede(event) {
        var data = tableUtilities.getDataFromEvent(event);
        //console.log(data);
        modalUtilities.LoadShow('editarSede', data);
      }

      function afterEdit(data, extra) {
        tableUtilities.loadScript('sedesVer', 'getSede', {}, agregarSede);
        $("#modaleditarSede").modal('hide');
      }
    </script>
