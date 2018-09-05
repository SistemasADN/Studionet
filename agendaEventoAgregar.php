<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-calendar-plus-o"></i> </div>
    <div class="text-container"> AGREGAR EVENTO</div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"><abbr title = 'Datos generales del evento'>DATOS DEL EVENTO</abbr></div>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input capitalize"
          required data-subtype = 'alphnum' data-maxlength = '200' placeholder="Nombre del Evento" id="nombre">
        </div>

        <!-- fecha -->
        <div class="col-xs-12 col-sm-12 col-md-12 input-container date-container">
          <label class='label-fecha'>FECHA DEL EVENTO</label>
          <div class="input-group form-input date required" id="fechaSelect">
            <span class="input-group-addon">
              <i class="glyphicon glyphicon-calendar"></i>
            </span>
            <input type="text" class="form-control date-input" required id="fechaSelectText">
          </div>
        </div>

        <!-- horario -->
        <div class="col-xs-12 col-sm-6 col-md-6 input-container" style="text-align:center;">
          <label class='label-fecha'>HORA INICIO</label>
          <div class="col-xs-12 col-sm-12 col-md-12">
            <input type="text" id = 'horaInicio' data-default = "7:00" required class="timepicker form-input"/>
          </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-6 input-container" style="text-align:center;">
          <label class='label-fecha'>HORA FINAL</label>
          <div>
            <input type="text" id = 'horaFinal' data-default = "8:00"  required class="timepicker form-input"/>
          </div>
        </div>

        <!-- title -->
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"><abbr title = 'Agregar una lista de equipos es opcional'> LISTA DE EQUIPOS</abbr></div>
          </div>
        </div>

        <!-- select equipo -->
        <div class="col-xs-12 col-sm-6 col-md-6 input-container">
          <select class="selectpicker" data-live-search="true"
          data-label="Equipo" id="equipoSearch" name='Equipo' required> </select>
        </div>

        <!-- btn agregarEquipo -->
        <div class="col-xs-12 col-sm-6 col-md-6 input-container">
          <button type = 'button' class = 'btn btn-save' id = "agregarEquipo">
            AGREGAR EQUIPO A LISTA</button>
        </div>

        <!-- table equipos -->
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

        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-form="form-input"
          data-script="agregarEvento" data-function="afterEdit" data-clear="true"
          id="agregarEvento">Agregar Evento</button>
        </div>

      </fieldset>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(2);
        tableUtilities.createTable('listaEquipos', ['equipo', 'acciones']);
        Utilizer.makeDatepicker('fechaSelect');
        Utilizer.loadSelect('equipoSearch', 'equipoSelect', 'Equipo');
        Utilizer.makeTimePicker('horaInicio');
        Utilizer.makeTimePicker('horaFinal');
        FormEngine.setFormEngine('agregarEvento');

        $("#agregarEquipo").click(agregarEquipo);
      });

      function afterEdit(data, extra) {
        console.log(data);
        console.log(extra);
        Utilizer.makeDatepicker('fechaSelect');
      }

      function agregarEquipo(){
        var sel = Utilizer.getSelected('equipoSearch');
        var data = {idEquipo:$(sel).val(), equipo:$(sel).text()};
        console.log(data);
        if(!tableUtilities.isInTable('listaEquipos', data)&&data.idEquipo!=""){
          tableUtilities.addRowDraw('listaEquipos', data, [
            ["BORRAR", "btn-danger borrar", tableUtilities.borrarFila]
          ]);
        }
      }

    </script>
