<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-book"></i> </div>
    <div class="text-container"> LISTAS DE ASISTENCIA </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
          <div class="col-xs-12 col-sm-6 col-md-6 form-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="text-container-subtitle"> SELECCIONE UNA CLASE Y UN RANGO DE FECHAS </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container date-container">
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <select class="selectpicker form-input" data-live-search="true" data-label="Clase" id="idGrupo" > </select>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 input-container date-container">
                <label class='label-fecha'>FECHA INICIAL</label>
                <div class="input-group date" id="fechaInicial"> <span class="input-group-addon">
                    <i class="glyphicon glyphicon-calendar"></i>
                </span>
                  <input type="text" class="form-control date-input" id="fechaInicialText"> </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 input-container date-container">
                <label class='label-fecha'>FECHA FINAL</label>
                <div class="input-group date" id="fechaFinal"> <span class="input-group-addon">
                    <i class="glyphicon glyphicon-calendar"></i>
                </span>
                  <input type="text" class="form-control date-input" id="fechaFinalText"> </div>
              </div>
            </fieldset>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
          <table class="table table-hover table-responsive" data-unique = 'idAlumno' id="listaAsistencias">
            <thead>
              <tr class="table-header">
                <th class="table-column-title ordenar">ALUMNO</th>
                <th class="table-column-title">ASISTENCIAS</th>
                <th class="table-column-title">%</th>
                <th class="table-column-title">RETRASOS</th>
                <th class="table-column-title">%</th>
                <th class="table-column-title">FALTAS</th>
                <th class="table-column-title">%</th>
                <th class="table-column-title">TOTAL</th>
              </tr>
            </thead>
            <tfoot>
              <tr class="table-header">
                <th class="table-column-title ordenar">ALUMNO</th>
                <th class="table-column-title">ASISTENCIAS</th>
                <th class="table-column-title">%</th>
                <th class="table-column-title">RETRASOS</th>
                <th class="table-column-title">%</th>
                <th class="table-column-title">FALTAS</th>
                <th class="table-column-title">%</th>
                <th class="table-column-title">TOTAL</th>
              </tr>
            </tfoot>
            <tbody> </tbody>
          </table>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
          <table class="table table-hover table-responsive" data-unique = 'idAlumno' id="listaAsistenciasProfesor">
            <thead>
              <tr class="table-header">
                <th class="table-column-title ordenar">PROFESOR</th>
                <th class="table-column-title">ASISTENCIAS</th>
                <th class="table-column-title">%</th>
                <th class="table-column-title">RETRASOS</th>
                <th class="table-column-title">%</th>
                <th class="table-column-title">FALTAS</th>
                <th class="table-column-title">%</th>
                <th class="table-column-title">TOTAL</th>
              </tr>
            </thead>
            <tfoot>
              <tr class="table-header">
                <th class="table-column-title ordenar">PROFESOR</th>
                <th class="table-column-title">ASISTENCIAS</th>
                <th class="table-column-title">%</th>
                <th class="table-column-title">RETRASOS</th>
                <th class="table-column-title">%</th>
                <th class="table-column-title">FALTAS</th>
                <th class="table-column-title">%</th>
                <th class="table-column-title">TOTAL</th>
              </tr>
            </tfoot>
            <tbody> </tbody>
          </table>
        </div>
      </fieldset>
    </div>
  </div>

  <?php include 'templates/bottom.php'; ?>
    <script>

      $(document).ready(function () {
        var firstDate = Utilizer.getFirstDateMonth();
     	  var lastDate = Utilizer.getLastDateMonth();
        tableUtilities.createTable('listaAsistencias',          ['alumno', 'asistencia', 'asistenciaPorcentaje', 'retraso', 'retrasoPorcentaje', 'falta', 'faltaPorcentaje', 'completo']);
        tableUtilities.createTable('listaAsistenciasProfesor',  ['profesor', 'asistencia', 'asistenciaPorcentaje', 'retraso', 'retrasoPorcentaje', 'falta', 'faltaPorcentaje', 'completo']);
     	  Utilizer.makeDatepicker('fechaInicial', firstDate);
     	  Utilizer.makeDatepicker('fechaFinal', lastDate);
        Utilizer.loadSelect('idGrupo', 'grupoSelect', 'Clase', {}, easyLoad);
        $("#fechaInicial,#fechaFinal,#idGrupo").change(loadTable);
        function easyLoad(){
          return;
          Utilizer.setPicker('idGrupo', '4');
          Utilizer.setPicker('idGrupo', '4');
          $("#idGrupo").trigger('change');
        }
      });

      function loadTable(){
        var data = {};
        data.fechaInicial = Utilizer.fechaParseToDbDate($("#fechaInicialText").val());
        data.fechaFinal = Utilizer.fechaParseToDbDate($("#fechaFinalText").val());
        data.idGrupo = $("#idGrupo").val();
        data.tipo = 'alumno';
        tableUtilities.loadScript('listaAsistencias', 'getListaAsistenciaGrupo', data, loadAsistencia);
        data.tipo = 'profesor';
        tableUtilities.loadScript('listaAsistenciasProfesor', 'getListaAsistenciaGrupo', data, loadAsistencia);
      }

      var gOptions = ['asistencia','retraso','falta'];
      function loadAsistencia(data){
        console.table(data);
        data.completo = 0;
        for(var i = 0;i<gOptions.length;i++){
          if(data[i]!==undefined){
            data.completo += Number(data[i]);
            data[gOptions[i]] = Number(data[i]);
          }else{
            data[gOptions[i]] = 0;
          }
        }
        for(var i = 0;i<gOptions.length;i++){
            data[gOptions[i]+'Porcentaje'] = Number(100*data[gOptions[i]]/data.completo).toFixed(2)+"%";
        }
        return data;
      }
    </script>
