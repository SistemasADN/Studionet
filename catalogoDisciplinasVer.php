<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-bookmark-o"></i> </div>
    <div class="text-container"> VER DISCIPLINAS </div>
  </div>
  <?php include_once "queries/getFormaCalculo.php";?>
  <?php if($formaCalculoGot==2||$formaCalculoGot==5||$formaCalculoGot==7||$formaCalculoGot==9): ?>
    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        <button type="button" onClick = 'location.href = "perfilConfiguracionPagos.php";' class="btn btn-save">CONFIGURACIÓN COBRANZA</button>
    </div>
  <?php endif; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="disciplinasVer" data-pdf = true data-csv = true data-copy = true data-xls = true data-titulo = "Disciplinas">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE</th>
          <?php
            include_once "queries/getFormaCalculo.php";
            if($formaCalculoGot==2||$formaCalculoGot==5||$formaCalculoGot==7||$formaCalculoGot==9):
          ?>
            <th class="table-column-title">CUOTA MENSUAL</th>
          <?php endif; ?>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE</th>
        <?php if($formaCalculoGot==2||$formaCalculoGot==5||$formaCalculoGot==7||$formaCalculoGot==9): ?>
          <th class="table-column-title">CUOTA MENSUAL</th>
        <?php endif; ?>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>

  <!-- Modal Edit -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modaleditarDisciplina">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-bookmark-o"></i> </div>
            <div class="text-container"> EDITAR DISCIPLINA </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DATOS DE DISCIPLINA </div>
                </div>
              </div>
              <input type='hidden' id='idDisciplina' class='form-input' />
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input capitalize" required placeholder="Nombre de Disciplina" id="nombreDisciplina"> </div>
                <div class="col-xs-12 col-md-12 col-md-9">
                  <input type="checkbox" id="estatus" checked data-true="ACTIVO" data-false="INACTIVO" class='form-input switcher'> </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" data-function='afterEdit' data-form="form-input" data-script="editarDisciplina" data-clear="true" id="editarDisciplina">editar disciplina</button>
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
        //Csser.collapse(5);
        <?php if($formaCalculoGot !="1"): ?>
          tableUtilities.createTable('disciplinasVer', ['nombreDisciplina', 'cuota' ,'estatus', 'acciones'], [ {
            key:'estatus',
            default:1,
            text: 'ACTIVO',
            activeValue: 'INACTIVO'
          }]);
        <?php else: ?>
          console.log("forma_calculo: "+<?=$formaCalculoGot;?>);
          tableUtilities.createTable('disciplinasVer', ['nombreDisciplina', 'estatus', 'acciones'], [ {
            key:'estatus',
            default:1,
            text: 'INACTIVO',
            activeValue: 'ACTIVO'
          }]);
        <?php endif; ?>
        tableUtilities.setUniqueColumns('disciplinasVer', ['idDisciplina']);
        tableUtilities.loadScript('disciplinasVer', 'getDisciplina', {}, agregarDisciplina);
        FormEngine.setFormEngine('editarDisciplina');
        modalUtilities.Initialize('editarDisciplina');
      });

      function agregarDisciplina(data) {
        console.log(data);
        <?php if($formaCalculoGot!=""): ?>
          data.cuota = Utilizer.generateTextoPagos(data.listaCalculos, <?php echo $formaCalculoGot;?>);
        <?php endif; ?>
        data.estatus = data.activo == 1 ? "ACTIVO" : "INACTIVO";
        data.buttons = [["Editar", "btn-edit", editarDisciplina]];
        return data;
      }

      function editarDisciplina(event) {
       var data = tableUtilities.getDataFromEvent(event);
       modalUtilities.LoadShow('editarDisciplina', data);
      }

      function afterEdit(data, extra) {
        $("#modaleditarDisciplina").modal('hide');
        tableUtilities.loadScript('disciplinasVer', 'getDisciplina', {}, agregarDisciplina);
      }
    </script>
