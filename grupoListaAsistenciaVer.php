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

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container" id="grupoContainer">
          <table class="table table-hover table-responsive" data-unique = 'idGrupo' id="listaAsistencias">
            <thead>
              <tr class="table-header">
                <th class="table-column-title">FECHA</th>
                <th class="table-column-title">GRUPO</th>
                <th class="table-column-title">CLASE - NIVEL</th>
                <th class="table-column-title">PROFESOR</th>
                <th class="table-column-title">ACCIONES</th>
              </tr>
            </thead>
            <tfoot>
              <tr class="table-header">
                <th class="table-column-title">FECHA</th>
                <th class="table-column-title">GRUPO</th>
                <th class="table-column-title">CLASE - NIVEL</th>
                <th class="table-column-title">PROFESOR</th>
                <th class="table-column-title">ACCIONES</th>
              </tr>
            </tfoot>
            <tbody> </tbody>
          </table>
        </div>
      </fieldset>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="modalListaAsistencia">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body container-fluid">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-search"></i> </div>
            <div class="text-container"> LISTA DE ASISTENCIA </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="jumbotron jumbotron-container">
                <div class="jumbotron-text"> DATOS </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Fecha:</label>
              <input type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="fecha">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Grupo:</label>
              <input type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="nombreGrupo">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Clase-Nivel:</label>
              <input type="text" disabled max="100" class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="nombreClase">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Profesor:</label>
              <input type="text" disabled max="100" class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="nombreProfesor">
            </div>
            <div id = 'listasAsistencia'>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> ALUMNOS </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
                <table class="table table-hover table-responsive" id="detallesAsistencia">
                  <thead>
                    <tr class="table-header">
                      <th class="table-column-title">NOMBRE</th>
                      <th class="table-column-title">ASISTENCIA</th>
                      <th class="table-column-title">ACCIONES</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr class="table-header">
                      <th class="table-column-title">NOMBRE</th>
                      <th class="table-column-title">ASISTENCIA</th>
                      <th class="table-column-title">ACCIONES</th>
                    </tr>
                  </tfoot>
                  <tbody> </tbody>
                </table>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> PROFESORES </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
                <table class="table table-hover table-responsive" id="detallesAsistenciaProfesor">
                  <thead>
                    <tr class="table-header">
                      <th class="table-column-title">NOMBRE</th>
                      <th class="table-column-title">ASISTENCIA</th>
                      <th class="table-column-title">ACCIONES</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr class="table-header">
                      <th class="table-column-title">NOMBRE</th>
                      <th class="table-column-title">ASISTENCIA</th>
                      <th class="table-column-title">ACCIONES</th>
                    </tr>
                  </tfoot>
                  <tbody> </tbody>
                </table>
              </div>
            </div>
            <div id = 'justificarAsistencia' hidden>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> CAMBIAR ASISTECIA </div>
                </div>
              </div>
              <input class = 'form-input' type = 'hidden' id = 'idAsistenciaAlumno' />
              <input class = 'form-input' type = 'hidden' id = 'idAsistenciaProfesor' />
              <input class = 'form-input' type = 'hidden' id = 'asistenciaOriginal' />
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Nombre:</label>
                <input  type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" id = "nombre" />
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Asistencia:</label>
                <input  type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" id = "asistencia" />
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Cambiar:</label>
                <div class = 'col-xs-8 col-sm-8 col-md-8'>
                    <select required class = 'selectpicker form-input' id = 'asistenciaActual'></select>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Motivo:</label>
                <input required type="text" data-subtype = 'alphnum' class="input-group form-input col-xs-8 col-sm-8 col-md-8" id = "motivo" />
              </div>

              <div class="col-xs-12 col-sm-12 col-md-12 input-container spec">
                <button type="button" class="btn btn-save" data-form="form-input"
                data-script="cambiarAsistencia" data-function="afterEdit" data-clear="true"
                 id="cambiarAsistencia">Cambiar</button>
              </div>

            </div>
          </div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

  <?php include 'templates/bottom.php'; ?>
    <script>
      var gOptions = ['Asistió','Llegó tarde','Faltó'];
      $(document).ready(function () {
        var firstDate = Utilizer.getFirstDateMonth();
     	  var lastDate = Utilizer.getLastDateMonth();

        tableUtilities.createTable('listaAsistencias', ['fecha', 'nombreGrupo', 'nombreClase', 'nombreProfesor', 'acciones'], ['nombreGrupo', 'nombreClase']);

        tableUtilities.createTable('detallesAsistencia', ['nombreAlumno',   {
            key:'asistencia',
            options:gOptions,
            type:'radio',
            output:true
          }, 'acciones']);

           tableUtilities.createTable('detallesAsistenciaProfesor', ['nombreProfesor',   {
               key:'asistencia',
               options:gOptions,
               type:'radio',
               output:true
              }, 'acciones']);

        Utilizer.manualLoadSelect('asistenciaActual', 'Asistencia', [
          {id:0, value: "Asistió"},
          {id:1, value: "Llegó tarde"},
          {id:2, value: "Faltó"},
        ]);
        FormEngine.setFormEngine('cambiarAsistencia');
     	  Utilizer.makeDatepicker('fechaInicial', firstDate);
     	  Utilizer.makeDatepicker('fechaFinal', lastDate);
        $("#fechaInicial,#fechaFinal").change(loadTable);
        loadTable();
      });

      function loadTable(){
        tableUtilities.loadScript('listaAsistencias', 'getListaAsistencia', {
          fechaInicial:Utilizer.fechaParseToDbDate($("#fechaInicialText").val()),
          fechaFinal:Utilizer.fechaParseToDbDate($("#fechaFinalText").val())
        }, loadAsistencia);
      }

      function loadAsistencia(data){
        data.buttons = [["VER LISTA", 'btn-edit', getModalData]];
        return data;
      }

      function getModalData(event){
        var data = tableUtilities.getDataFromEvent(event);
          Utilizer.getResponse('getDetallesAsistencia', {idAsistencia:data.idAsistencia}, loadModal, data);
      }

      function loadModal(data, extra){
        extra.fecha = Utilizer.fechaDbParseToFecha(extra.fecha);
        Utilizer.fillForm(extra);
        tableUtilities.clearTable('detallesAsistencia');
        tableUtilities.clearTable('detallesAsistenciaProfesor');

        for(var i = 0;i<data.alumnos.length;i++){
          tableUtilities.addRow('detallesAsistencia', data.alumnos[i], [['Cambiar', 'btn-edit', editar]]);
        }
        for(var i = 0;i<data.profesores.length;i++){
          tableUtilities.addRow('detallesAsistenciaProfesor', data.profesores[i], [['Cambiar', 'btn-edit', editar]]);
        }
        tableUtilities.draw('detallesAsistencia');
        tableUtilities.draw('detallesAsistenciaProfesor');
        $("#listasAsistencia").show();
        $("#justificarAsistencia").hide();
        $("#modalListaAsistencia").modal('show');
      }

      function editar(){
        var data = tableUtilities.getDataFromEvent(event);
        if(data.idAsistenciaAlumno===undefined){
          $("#idAsistenciaProfesor").val(data.idAsistenciaProfesor);
          $("#nombre").val(data.nombreProfesor);
        }else{
          $("#idAsistenciaAlumno").val(data.idAsistenciaAlumno);
          $("#nombre").val(data.nombreAlumno);
        }
        $("#asistenciaOriginal").val(data.asistencia);
        $("#asistencia").val(gOptions[data.asistencia]);
        $("#listasAsistencia").hide();
        $("#justificarAsistencia").show();
      }

      function afterEdit(){
          $("#modalListaAsistencia").modal('hide');
      }

    </script>
