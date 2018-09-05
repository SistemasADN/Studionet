<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-sitemap"></i> </div>
    <div class="text-container"> VER EQUIPOS </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="equiposVer" data-pdf = true data-csv = true data-copy = true data-xls = true data-titulo = "Ver Equipos" >
      <thead>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">SEDE</th>
          <th class="table-column-title">PROFESOR</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">SEDE</th>
          <th class="table-column-title">PROFESOR</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <!-- Modal Edit -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modaleditarEquipo">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-sitemap"></i> </div>
            <div class="text-container"> EDITAR EQUIPO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DATOS DEL EQUIPO </div>
                </div>
              </div>
              <input type="hidden" class="form-input" id="idEquipo">
              <input type="hidden" class="form-input" id="nombre">
              <input type="hidden" class="form-input" id="apellidoPaterno">
              <input type="hidden" class="form-input" id="apellidoMaterno">
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input capitalize" required placeholder="Nombre de Equipo" id="nombreEquipo"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <select class="selectpicker form-input" data-live-search="true" data-script="sedeSelect" required data-label="Sede" id="idSede" name='Sede'> </select>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <select class="selectpicker form-input" data-live-search="true" data-script="profesorSelect" required data-label="Profesor" id="idProfesor" name='Maestro'> </select>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <div class="col-xs-12 col-md-12 col-md-9">
                  <input type="checkbox" id="estatus" checked data-true="ACTIVO" data-false="INACTIVO" class='form-input switcher'> </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" data-form="form-input" data-function="afterEdit" data-script="editarEquipo" data-clear="true" id="editarEquipo">Editar Equipo</button>
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
        //Csser.collapse(10);
        tableUtilities.createTable('equiposVer', ['nombreEquipo', 'nombreSede', 'profesor', 'estatus', 'acciones']);
        tableUtilities.setUniqueColumns('equiposVer', ['idEquipo']);
        tableUtilities.loadScript('equiposVer', 'getEquipo', {}, agregarEquipo);
        FormEngine.setFormEngine('editarEquipo');
        modalUtilities.Initialize('editarEquipo');


      });
      function agregarEquipo(data) {
        data.profesor = data.nombre + " " + data.apellidoPaterno;
        data.profesor = data.apellidoMaterno == "" ? data.profesor : data.profesor + " " + data.apellidoMaterno;
        data.estatus = data.activo == 1 ? "ACTIVO" : "INACTIVO";
        data.buttons = [["Editar", "btn-edit", editarEquipo]];
        return data;
      }
      function editarEquipo(event) {
        var data = tableUtilities.getDataFromEvent(event);
        data.sedeSearch = data.idSede;
        data.profesorSearch = data.idProfesor;
        modalUtilities.LoadShow('editarEquipo', data);
      }

      function afterEdit(data, extra) {
        tableUtilities.loadScript('equiposVer', 'getEquipo', {}, agregarEquipo);
        $("#modaleditarEquipo").modal('hide');
      }
    </script>
