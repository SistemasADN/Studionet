<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-building"></i> </div>
    <div class="text-container"> VER SALONES </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="salonesVer" data-pdf = true data-csv = true data-copy = true data-xls = true data-titulo = "Salones" >
      <thead>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <!-- Modal Edit -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modaleditarSalon">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-building"></i> </div>
            <div class="text-container"> EDITAR SALÓN </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DATOS DE SALÓN </div>
                </div>
              </div>
              <input type='hidden' id='idSalon' class='form-input' />
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input capitalize" required placeholder="Nombre de Salón" id="nombreSalon"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <div class="col-xs-12 col-md-12 col-md-9">
                  <input type="checkbox" id="estatus" checked data-true="ACTIVO" data-false="INACTIVO" class='form-input switcher'> </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" data-function='afterEdit' data-form="form-input" data-script="editarSalon" data-clear="true" id="editarSalon">editar salón</button>
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
        //Csser.collapse(8);
        tableUtilities.createTable('salonesVer', ['nombreSalon', 'estatus', 'acciones'], [ {
          key:'estatus',
          default:0,
          text: 'INACTIVO',
          activeValue: 'ACTIVO'
        }]);
        tableUtilities.setUniqueColumns('salonesVer', ['idSalon']);
        tableUtilities.loadScript('salonesVer', 'getSalones', {}, agregarSalon);
        FormEngine.setFormEngine('editarSalon');
        modalUtilities.Initialize('editarSalon');
      });

      function agregarSalon(data) {
        data.estatus = data.activo == 1 ? "ACTIVO" : "INACTIVO";
        data.buttons = [["Editar", "btn-edit", editarSalon]];
        data.sedeSearch = data.idSede;
        return data;
      }

      function editarSalon(event) {
        var data = tableUtilities.getDataFromEvent(event);
        Utilizer.setPicker('sedeSearch', data.idSede);
        modalUtilities.LoadShow('editarSalon', data);
      }

      function afterEdit(data, extra) {
        $("#modaleditarSalon").modal('hide');
        tableUtilities.loadScript('salonesVer', 'getSalones', {}, agregarSalon);
      }
    </script>
