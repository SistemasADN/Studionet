<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-bell"></i> </div>
    <div class="text-container"> VER CLASES </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="clasesVer">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">ASIGNATURA</th>
          <th class="table-column-title">NIVEL</th>
          <th class="table-column-title">PRECIO ESTANDAR</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">ASIGNATURA</th>
          <th class="table-column-title">NIVEL</th>
          <th class="table-column-title">PRECIO ESTANDAR</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <!-- Modal Edit -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modaleditarClase">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-bell"></i> </div>
            <div class="text-container"> EDITAR CLASE </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DATOS DE CLASE </div>
                </div>
              </div>
              <input type="hidden" class="form-input" id="idClase">
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <select class="selectpicker form-input " data-script="asignaturaSelect" data-live-search="true" required data-label="Asignatura" id="asignaturaSearch" name='Asignatura'> </select>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <select class="selectpicker form-input " data-live-search="true" data-script="nivelSelect" required data-label="Nivel" id="nivelSearch" name='Nivel'> </select>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="number" class="form-control form-input" required placeholder="Precio estándar" id="precioEstandard"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <div class="col-xs-12 col-md-12 col-md-9">
                  <input type="checkbox" id="estatus" checked data-true="ACTIVO" data-false="INACTIVO" class='form-input switcher'> </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" data-form="form-input" data-function="afterEdit" data-script="editarClase" data-clear="true" id="editarClase">Guardar</button>
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
        //Csser.collapse(9);
        tableUtilities.createTable('clasesVer', ['nombreAsignatura', 'nombreNivel', 'precioEstandard', 'estatus', 'acciones']);
        tableUtilities.setUniqueColumns('clasesVer', ['idAsignatura']);
        tableUtilities.loadScript('clasesVer', 'getClase', {}, agregarClase);
        FormEngine.setFormEngine('editarClase');
        modalUtilities.Initialize('editarClase');

        function agregarClase(data) {
          data.estatus = data.activo == 1 ? "ACTIVO" : "INACTIVO";
          data.buttons = [["Editar", "btn-edit", editarClase]];
          data.asignaturaSearch = data.idAsignatura;
          data.nivelSearch = data.idNivel;
          data.precioEstandard = Utilizer.numberToCoin(Number(data.precioEstandard));
          return data;
        }
      });

      function editarClase(event) {
        var data = tableUtilities.getDataFromEvent(event);
        Utilizer.setPicker('asignaturaSearch', data.asignaturaSearch);
        Utilizer.setPicker('nivelSearch', data.nivelSearch);
        data.precioEstandard = Utilizer.coinToNumber(data.precioEstandard);
        modalUtilities.LoadShow('editarClase', data);
      }

      function afterEdit(data, extra) {
        data.activo = data.estatus ? 1 : 0;
        data.asignaturaSearch = Number(data.asignaturaSearch);
        data.estatus = data.activo == 1 ? "ACTIVO" : "INACTIVO";
        data.idAsignatura = Number(data.asignaturaSearch);
        data.idClase = Number(data.idClase);
        data.idNivel = Number(data.nivelSearch);
        data.nivelSearch = Number(data.nivelSearch);
        data.nombreAsignatura = extra.asignaturaSearch;
        data.nombreNivel = extra.nivelSearch;
        data.precioEstandard = Utilizer.numberToCoin(Number(data.precioEstandard));
        var buttons = [["Editar", "btn-edit", editarClase]];
        tableUtilities.updateRow('clasesVer', {
          idClase: data.idClase
        }, data, buttons);
        $("#modaleditarClase").modal('hide');
      }
    </script>
