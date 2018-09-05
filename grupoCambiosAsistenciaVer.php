<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-book"></i> </div>
    <div class="text-container"> REGISTRO DE CAMBIOS </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
          <div class="col-xs-12 col-sm-6 col-md-6 form-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="text-container-subtitle"> SELECCIONE UN RANGO DE FECHAS </div>
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
          <table class="table table-hover table-responsive" id="registroCambios">
            <thead>
              <tr class="table-header">
                <th class="table-column-title">FECHA</th>
                <th class="table-column-title">CLASE</th>
                <th class="table-column-title">ASIGNATURA - NIVEL</th>
                <th class="table-column-title">NOMBRE</th>
                <th class="table-column-title">TIPO</th>
                <th class="table-column-title">ASISTENCIA ORIGINAL</th>
                <th class="table-column-title">ASISTENCIA CAMBIO</th>
                <th class="table-column-title">MOTIVO</th>
                <th class="table-column-title">USUARIO</th>
              </tr>
            </thead>
            <tfoot>
              <tr class="table-header">
                <th class="table-column-title">FECHA</th>
                <th class="table-column-title">CLASE</th>
                <th class="table-column-title">ASIGNATURA - NIVEL</th>
                <th class="table-column-title">NOMBRE</th>
                <th class="table-column-title">TIPO</th>
                <th class="table-column-title">ASISTENCIA ORIGINAL</th>
                <th class="table-column-title">ASISTENCIA CAMBIO</th>
                <th class="table-column-title">MOTIVO</th>
                <th class="table-column-title">USUARIO</th>
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

        tableUtilities.createTable('registroCambios', ['fecha', 'nombreGrupo', 'nombreClase',
         'nombre', 'tipo', {
             key:'asistenciaOriginal',
             options:['Asistió', 'Llegó tarde', 'Faltó'],
             type:'radio',
             output:true
           }, {
               key:'asistenciaActual',
               options:['Asistió', 'Llegó tarde', 'Faltó'],
               type:'radio',
               output:true
             }, 'motivo', 'usuario'],
          ['nombreGrupo', 'nombreClase', 'nombre', 'tipo', 'asistenciaOriginal', 'asistenciaActual', 'usuario']);
          Utilizer.makeDatepicker('fechaInicial', firstDate);
          Utilizer.makeDatepicker('fechaFinal', lastDate);
        $("#fechaInicial,#fechaFinal").change(loadTable);
        loadTable();
      });

      function loadTable(){
        tableUtilities.loadScript('registroCambios', 'getRegistroCambios', {
          fechaInicial:Utilizer.fechaParseToDbDate($("#fechaInicialText").val()),
          fechaFinal:Utilizer.fechaParseToDbDate($("#fechaFinalText").val())
        }, loadAsistencia);
      }

      function loadAsistencia(data){
        console.log(data);
        return data;
      }
    </script>
