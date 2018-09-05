<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-calendar-o"></i> </div>
    <div class="text-container"> VER AGENDA</div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" data-pdf = true data-csv = true data-copy = true data-xls = true data-titulo = "Agenda" id="agendaVer">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">HORARIO</th>
          <th class="table-column-title">EVENTO</th>
          <th class="table-column-title">TIPO</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">HORARIO</th>
          <th class="table-column-title">EVENTO</th>
          <th class="table-column-title">TIPO</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <!-- Modal Edit -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modaleditarEvento">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-pencil-square-o"></i> </div>
            <div class="text-container"> EDITAR EVENTO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <div class="col-xs-12 col-sm-12 col-md-12 form-container">
              <fieldset>
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="jumbotron jumbotron-container">
                    <div class="jumbotron-text"> DATOS DEL EVENTO </div>
                  </div>
                </div>
                <input type='hidden' id='idAgenda' class='form-input' />
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <input type="text" class="form-control form-input capitalize" data-subtype = "alphnum"
                   required placeholder="Nombre del Evento" id="evento"> </div>

                  <div class="col-xs-12 col-sm-6 col-md-6 input-container">
                    <select class="selectpicker" data-live-search="true"
                    data-label="Equipo" id="idEquipo" name='Equipo' required> </select>
                  </div>

                  <!-- btn agregarEquipo -->
                  <div class="col-xs-12 col-sm-6 col-md-6 input-container">
                    <button type = 'button' class = 'btn btn-save' id = "agregarEquipo">
                      AGREGAR EQUIPO A LISTA</button>
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
                    <table class="table table-hover table-responsive form-input"
                    data-keys = "idEquipo" id="listaEquipos">
                      <thead>
                        <tr class="table-header">
                          <th class="table-column-title">EQUIPO</th>
                          <th class="table-column-title">ACCIONES</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr class="table-header">
                          <th class="table-column-title">EQUIPO</th>
                          <th class="table-column-title">ACCIONES</th>
                        </tr>
                      </tfoot>
                      <tbody> </tbody>
                    </table>
                  </div>

                <div class="col-xs-12 col-sm-6 col-md-6 input-container date-container">
                  <label class='label-fecha'>FECHA DEL EVENTO</label>
                <div class="input-group date form-input required" id="fecha"> <span class="input-group-addon">
      					  <i class="glyphicon glyphicon-calendar"></i>
      				  </span>
                    <input type="text" class="form-control" required id="fechaText"> </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 input-container" style="text-align:center;">
                  <label class='label-fecha'>HORA INICIO</label>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <input type="text" id='tiempoInicial' required class="timepicker form-input">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 input-container" style="text-align:center;">
                  <label class='label-fecha'>HORA FINAL</label>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <input type="text" id='tiempoFinal' required class="timepicker form-input" /> </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <button type="button"
                  class="btn btn-save" data-form="form-input"
                    data-script="editarEvento"
                    data-function="afterEdit"
                    data-clear="false" id="editarEvento">Editar Evento</button>
                </div>
              </fieldset>
            </div>
          </div>
        </div>
        <div class="modal-footer"> </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(1);
        Utilizer.makeDatepicker('fecha');
        //Utilizer.loadSelect('equipoSearch', 'equipoSelect', 'Equipo');
        Utilizer.makeTimePicker('tiempoInicial');
        Utilizer.makeTimePicker('tiempoFinal');
        FormEngine.setFormEngine('editarEvento');
        modalUtilities.Initialize('editarEvento');
          Utilizer.loadSelect('idEquipo', 'equipoSelect', 'Equipo');
        tableUtilities.createTable('agendaVer', ['fecha', 'horario', 'evento', 'equipo', 'acciones'], ['equipo']);
        tableUtilities.createTable('listaEquipos', ['equipo', 'acciones']);
        tableUtilities.loadScript('agendaVer', 'getEvento', {}, agregarAgenda);
        $("#agregarEquipo").click(agregarEquipo);
      });

      function agregarAgenda(data) {
        if (data.equipo != "Cumpleaños") {
          //console.log(data);
          if (data.tiempoInicial !== null && data.tiempoFinal !== null) {
            data.horario = data.tiempoInicial + " - " + data.tiempoFinal;
          }else {
            data.horario = "";
          }
          data.idEquipo = Number(data.idEquipo);
          data.equipo = "";
          for(var i = 0;i<data.listaEquipos.length;i++){
            data.equipo += data.listaEquipos[i].equipo+"<br>";
          }
          if(data.equipo==""){
            data.equipo = "Evento";
          }
          data.buttons = [["Editar", 'btn-edit', editarAgenda], ["Borrar", 'btn-danger', borrarAgenda]];
        }
        else {
          data.horario = "";
          data.buttons = [];
        }
        //data.fecha = data.fechaText;
        return data;
      }

      function editarAgenda() {
        var data = tableUtilities.getDataFromEvent(event);
        modalUtilities.LoadShow('editarEvento', data);
        $("#modaleditarEvento").modal('show');
      }

      function borrarAgenda() {
        var data = tableUtilities.getDataFromEvent(event);
        console.log(data);
        var actual = {};
        actual.idAgenda = data.idAgenda;
        console.log(actual);
        Utilizer.sendData('deleteEvento', actual, afterBorrar, actual);
      }

      function afterBorrar(data, extra) {
        tableUtilities.deleteRow('agendaVer', actual);
      }

      function agregarEquipo(){
        var sel = Utilizer.getSelected('idEquipo');
        var data = {idEquipo:Number($(sel).val()), equipo:$(sel).text()};
        console.log(data);
        if(!tableUtilities.isInTable('listaEquipos', data)&&data.idEquipo!=""){
          tableUtilities.addRowDraw('listaEquipos', data, [
            ["BORRAR", "btn-danger borrar", tableUtilities.borrarFila]
          ]);
        }
      }

      function afterEdit(data, extra) {
        tableUtilities.loadScript('agendaVer', 'getEvento', {}, agregarAgenda);
        $("#modaleditarEvento").modal('hide');
      }
    </script>
