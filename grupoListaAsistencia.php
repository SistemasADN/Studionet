<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-book"></i> </div>
    <div class="text-container"> LISTA DE ASISTENCIA </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> GRUPO </div>
          </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-6 input-container">
          <select class="selectpicker form-input " data-live-search="true"
          required data-label="Grupo" id="idGrupo" name='Grupo'>
          </select>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6 input-container date-container">
          <label class='label-fecha' style="align:left">FECHA </label>
          <div class="input-group form-input date" id="fechaSelect"> <span class="input-group-addon">
              <i class="glyphicon glyphicon-calendar"></i>
          </span>
            <input type="text" class="form-control date-input" required id="fechaSelectText"/> </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container" id="grupoContainer">
          <table class="table table-hover table-responsive form-input" data-keys = 'idAlumno,asistencia' data-unique = 'idAlumno' id="listaAsistencia">
            <thead>
              <tr class="table-header">
                <th class="table-column-title">NOMBRE ALUMNO</th>
                <th class="table-column-title">REGISTRAR</th>
              </tr>
            </thead>
            <tfoot>
              <tr class="table-header">
                <th class="table-column-title">NOMBRE ALUMNO</th>
                <th class="table-column-title">REGISTRAR</th>
              </tr>
            </tfoot>
            <tbody> </tbody>
          </table>
        </div>

        <table class="table table-hover table-responsive form-input" data-keys = 'idProfesor,asistencia' data-unique = 'idProfesor' id="listaAsistenciaProfesor">
          <thead>
            <tr class="table-header">
              <th class="table-column-title">NOMBRE PROFESOR</th>
              <th class="table-column-title">REGISTRAR</th>
            </tr>
          </thead>
          <tfoot>
            <tr class="table-header">
              <th class="table-column-title">NOMBRE PROFESOR</th>
              <th class="table-column-title">REGISTRAR</th>
            </tr>
          </tfoot>
          <tbody> </tbody>
        </table>
      </div>

        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-form="form-input"
            data-script="pasarLista" data-clear="true" id="pasarLista">
            Pasar lista
          </button>
        </div>

      </fieldset>
    </div>
  </div>

  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        tableUtilities.createTable('listaAsistencia', ['nombre',
        {
          key:'asistencia',
          options:['Asistió','Llegó tarde','Faltó'],
          type:'radio',
          selected:0
         }
       ]);

       tableUtilities.createTable('listaAsistenciaProfesor', ['nombre',
       {
         key:'asistencia',
         options:['Asistió','Llegó tarde','Faltó'],
         type:'radio',
         selected:0
        }
      ]);

       Utilizer.makeDatepicker('fechaSelect', undefined, 'past');
        Utilizer.loadSelect('idGrupo', 'grupoAsistenciaSelect', 'Grupo');
        $("#idGrupo").change(()=>{
            tableUtilities.loadScript('listaAsistencia', 'getGrupoAlumnos', {idGrupo:$("#idGrupo").val()}, agregarGrupo);
            tableUtilities.loadScript('listaAsistenciaProfesor', 'getGrupoProfesor', {idGrupo:$("#idGrupo").val()}, agregarGrupo);
        });
        FormEngine.setFormEngine('pasarLista');
      });

      function agregarGrupo(data){
        return data;
      }
    </script>
