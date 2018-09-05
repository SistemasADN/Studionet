<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-list-ul"></i> </div>
    <div class="text-container"> VER CONCEPTOS </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="conceptosVer" data-pdf = true data-csv = true data-copy = true data-xls = true data-titulo = "Ver Conceptos" >
      <thead>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">PRECIO UNITARIO</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">PRECIO UNITARIO</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <!-- Modal Edit -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modaleditarConcepto">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-list-ul"></i> </div>
            <div class="text-container"> EDITAR CONCEPTO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DATOS DE CONCEPTO </div>
                </div>
              </div>
              <input type='hidden' id='idConcepto' class='form-input' />
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input capitalize" required placeholder="Nombre de Concepto" id="nombreConcepto"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="coin" class="form-control form-input" required placeholder="Precio Unitario" id="precioUnitario"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <div class="col-xs-12 col-md-12 col-md-9">
                  <input type="checkbox" id="estatus" checked data-true="ACTIVO" data-false="INACTIVO" class='form-input switcher'> </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" data-function='afterEdit' data-form="form-input" data-script="editarConcepto" data-clear="true" id="editarConcepto">EDITAR CONCEPTO</button>
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
        //Csser.collapse(14);
        tableUtilities.createTable('conceptosVer', ['nombreConcepto', 'precioUnitario', 'estatus', 'acciones'], [{
          key:'estatus',
          default:0,
          text: 'INACTIVO',
          activeValue: 'ACTIVO'
        }]);
        tableUtilities.setUniqueColumns('conceptosVer', ['idConcepto']);
        tableUtilities.loadScript('conceptosVer', 'getConcepto', {}, agregarConcepto);
        FormEngine.setFormEngine('editarConcepto');
        modalUtilities.Initialize('editarConcepto');

      });

      function agregarConcepto(data) {
        data.estatus = data.activo == 1 ? "ACTIVO" : "INACTIVO";
        data.buttons = [["Editar", "btn-edit", editarConcepto]];
        data.precioUnitario = Utilizer.numberToCoin(data.precioUnitario);
        return data;
      }

      function editarConcepto(event) {
        var data = tableUtilities.getDataFromEvent(event);
        data.precioUnitario = Utilizer.coinToNumber(data.precioUnitario);
        console.log(data);
        modalUtilities.LoadShow('editarConcepto', data);
      }

      function afterEdit(data, extra) {
        $("#modaleditarConcepto").modal('hide');
        tableUtilities.loadScript('conceptosVer', 'getConcepto', {}, agregarConcepto);
      }
    </script>
