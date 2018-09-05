<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-book"></i> </div>
    <div class="text-container"> ASISTENCIA POR PROFESOR </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
          <div class="col-xs-12 col-sm-6 col-md-6 form-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="text-container-subtitle"> SELECCIONE UN RANGO DE FECHAS Y UN PROFESOR </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container date-container">
                <label class='label-fecha'>PROFESOR</label>
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <select class="selectpicker form-input" data-live-search="true" data-label="Profesor" id="idProfesor" > </select>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 input-container date-container">
                <label class='label-fecha'>FECHA INICIAL</label>
                <div class="input-group form-input date" id="fechaInicial"> <span class="input-group-addon">
                    <i class="glyphicon glyphicon-calendar"></i>
                </span>
                  <input type="text" class="form-control date-input" id="fechaInicialText"> </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 input-container date-container">
                <label class='label-fecha'>FECHA FINAL</label>
                <div class="input-group form-input date" id="fechaFinal"> <span class="input-group-addon">
                    <i class="glyphicon glyphicon-calendar"></i>
                </span>
                  <input type="text" class="form-control date-input" id="fechaFinalText"> </div>
              </div>
            </fieldset>
          </div>
        </div>



        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="col-xs-12 col-sm-12 col-md-12 form-container">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> TOTALES</div>
                </div>
              </div>

              <div class="col-xs-12 col-sm-12 col-md-3">
                <label class='label-top'>ASISTENCIAS</label>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-3">
                <label class='label-top'>RETRASOS</label>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-3">
                <label class='label-top'>FALTAS</label>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-3">
                <label class='label-top'>TOTAL</label>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-3 input-container">
                <input type="text" class="information-display col-xs-12 col-sm-12 col-md-12" id="totalasistencias" disabled/> </div>
              <div class="col-xs-12 col-sm-12 col-md-3 input-container">
                <input type="text" class="information-display col-xs-12 col-sm-12 col-md-12" id="totaltarde" disabled/> </div>
              <div class="col-xs-12 col-sm-12 col-md-3 input-container">
                <input type="text" class="information-display col-xs-12 col-sm-12 col-md-12" id="totalfaltas" disabled/> </div>
              <div class="col-xs-12 col-sm-12 col-md-3 input-container">
                <input type="text" class="information-display col-xs-12 col-sm-12 col-md-12" id="totaltotal" disabled/> </div>

          </div>


        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container" id="grupoContainer">
          <table class="table table-hover table-responsive form-input" data-unique = 'idGrupo' id="listaAsistencias">
            <thead>
              <tr class="table-header">
                <th class="table-column-title">CLASE</th>
                <th class="table-column-title">ASISTENCIAS</th>
                <th class="table-column-title">RETRASOS</th>
                <th class="table-column-title">FALTAS</th>
                <th class="table-column-title">TOTAL</th>
              </tr>
            </thead>
            <tfoot>
              <tr class="table-header">
                <th class="table-column-title">CLASE</th>
                <th class="table-column-title">ASISTENCIAS</th>
                <th class="table-column-title">RETRASOS</th>
                <th class="table-column-title">FALTAS</th>
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
        tableUtilities.createTable('listaAsistencias', ['nombreGrupo', 'asistencias', 'tarde', 'faltas', 'registro']);
        tableUtilities.addDrawEvent('listaAsistencias', updateTotales);
        Utilizer.loadSelect('idProfesor', 'profesorSelect', 'Profesor');
     	  Utilizer.makeDatepicker('fechaInicial', firstDate);
     	  Utilizer.makeDatepicker('fechaFinal', lastDate);
        $("#fechaInicial,#fechaFinal,#idProfesor").change(loadTable);
        loadTable();
      });

      function loadTable(){
        var data = {
          fechaInicial:Utilizer.fechaParseToDbDate($("#fechaInicialText").val()),
          fechaFinal:Utilizer.fechaParseToDbDate($("#fechaFinalText").val()),
          idProfesor:$("#idProfesor").val()
        };

        if(data.idAlumno!==undefined&&data.idAlumno!==null){
            tableUtilities.loadScript('listaAsistencias', 'getDetallesAsistenciaProfesor', data, loadAsistencia);
            for(var i = 0;i<resultados.length;i++){
              totalGeneral[resultados[i]] = 0;
            }
        }

      }
      var resultados = ['asistencias', 'tarde', 'faltas'];
      var totalGeneral = {};
      for(var i = 0;i<resultados.length;i++){
        totalGeneral[resultados[i]] = 0;
      }

      function updateTotales(){
          var total = 0;
          var keys = Object.keys(totalGeneral);
          for(var i = 0;i<keys.length;i++){
              total += totalGeneral[keys[i]];
          }
          $("#totaltotal").val(total);
          for(var i = 0;i<keys.length;i++){
              if(total==0){
                $("#total"+keys[i]).val("0 (0%)");
              }else{
                $("#total"+keys[i]).val(totalGeneral[keys[i]]+" ("+Number(100*totalGeneral[keys[i]]/total).toFixed(1)+"%)");
              }
          }


      }

      function loadAsistencia(data){
        data.registro = 0;
        console.log(data);
        for(var i = 0;i<resultados.length;i++){
          data.registro += data[resultados[i]];
        }
        for(var i = 0;i<resultados.length;i++){
          totalGeneral[resultados[i]] += data[resultados[i]];
          data[resultados[i]] = Utilizer.numberAndPer(data[resultados[i]], data.registro)
        }
        return data;
      }

    </script>
