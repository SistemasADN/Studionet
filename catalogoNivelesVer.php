<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-navicon"></i> </div>
    <div class="text-container"> VER NIVELES </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="nivelesVer" data-pdf = true data-csv = true data-copy = true data-xls = true data-titulo = "Niveles" >
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
  <div class="modal fade" tabindex="-1" role="dialog" id="modaleditarNivel">
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
            <div class="text-container"> EDITAR NIVEL </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DATOS DE NIVEL </div>
                </div>
              </div>
              <input type='hidden' id='idNivel' class='form-input' />
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input capitalize" required placeholder="Nombre de Nivel" id="nombreNivel"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <div class="col-xs-12 col-md-12 col-md-9">
                  <input type="checkbox" id="estatus" checked data-true="ACTIVO" data-false="INACTIVO" class='form-input switcher'> </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" data-function='afterEdit' data-form="form-input" data-script="editarNivel" data-clear="true" id="editarNivel">editar nivel</button>
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
        //Csser.collapse(7);
        tableUtilities.createTable('nivelesVer', ['nombreNivel', 'estatus', 'acciones'], [ {
          key:'estatus',
          default:0,
          text: 'INACTIVO',
          activeValue: 'ACTIVO'
        }]);
        tableUtilities.setUniqueColumns('nivelesVer', ['idNivel']);
        tableUtilities.loadScript('nivelesVer', 'getNivel', {}, agregarNivel);
        FormEngine.setFormEngine('editarNivel');
        modalUtilities.Initialize('editarNivel');

        function agregarNivel(data) {
          data.estatus = data.activo == 1 ? "ACTIVO" : "INACTIVO";
          data.buttons = [["Editar", "btn-edit", editarNivel]];
          return data;
        }
      });

      function editarNivel(event) {
        var data = tableUtilities.getDataFromEvent(event);
        console.log(data);
        modalUtilities.LoadShow('editarNivel', data);
      }

      function afterEdit(data, extra) {
        data.activo = data.estatus ? 1 : 0;
        data.idNivel = Number(data.idNivel);
        data.estatus = data.activo == 1 ? "ACTIVO" : "INACTIVO";
        var buttons = [["Editar", "btn-edit", editarNivel]];
        tableUtilities.updateRow('nivelesVer', {
          idNivel: data.idNivel
        }, data, buttons);
        $("#modaleditarNivel").modal('hide');
      }
    </script>
