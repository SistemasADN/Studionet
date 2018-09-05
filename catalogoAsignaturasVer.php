<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-book"></i> </div>
    <div class="text-container"> VER CLASES </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="asignaturasVer" data-pdf = true data-csv = true data-copy = true data-xls = true data-titulo = "Asignaturas" >
      <thead>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">DISCIPLINA</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">DISCIPLINA</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <!-- Modal Edit -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modaleditarAsignatura">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-book"></i> </div>
            <div class="text-container"> EDITAR CLASE </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DATOS DE CLASE </div>
                </div>
              </div>
              <input type='hidden' id='idAsignatura' class='form-input' />
              <input type='hidden' id='nombreDisciplina' class='form-input' />
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input capitalize" required placeholder="Nombre de Clase" id="nombreAsignatura"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <select class="selectpicker form-input " data-script="disciplinaSelect" data-live-search="true" required data-label="Disciplina" id="disciplinaSearch" name='Disciplina'> </select>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <div class="col-xs-12 col-md-12 col-md-9">
                  <input type="checkbox" id="estatus" checked data-true="ACTIVO" data-false="INACTIVO" class='form-input switcher'> </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" data-function='afterEdit' data-form="form-input" data-script="editarAsignatura" data-clear="true" id="editarAsignatura">editar clase</button>
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
        //Csser.collapse(6);
        tableUtilities.createTable('asignaturasVer', ['nombreAsignatura', 'nombreDisciplina', 'estatus', 'acciones'], [{
          key:'estatus',
          default:0,
          text: 'INACTIVO',
          activeValue: 'ACTIVO'
        }]);
        tableUtilities.setUniqueColumns('asignaturasVer', ['idAsignatura']);
        tableUtilities.loadScript('asignaturasVer', 'getAsignatura', {}, agregarAsignatura);
        //Utilizer.loadSelect('disciplinaSearch', 'disciplinaSelect', 'Disciplina');
        FormEngine.setFormEngine('editarAsignatura');
        modalUtilities.Initialize('editarAsignatura');
      });

      function agregarAsignatura(data) {
        data.estatus = data.activo == 1 ? "ACTIVO" : "INACTIVO";
        data.buttons = [["Editar", "btn-edit", editarAsignatura]];
        data.disciplinaSearch = data.idDisciplina;
        return data;
      }

      function editarAsignatura(event) {
        var data = tableUtilities.getDataFromEvent(event);
        console.log(data);
        Utilizer.setPicker('disciplinaSearch', data.idDisciplina);
        modalUtilities.LoadShow('editarAsignatura', data);
      }

      function afterEdit(data, extra) {
        $("#modaleditarAsignatura").modal('hide');
        tableUtilities.loadScript('asignaturasVer', 'getAsignatura', {}, agregarAsignatura);
      }
    </script>
