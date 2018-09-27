<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-user-circle"></i> </div>
    <div class="text-container"> GESTIONAR GRUPOS </div>
  </div>

  <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
      <button type="button" onClick = 'location.href = "catalogoGruposVer.php";' class="btn btn-save">CATÁLOGOS GRUPOS</button>
  </div>
  <?php include_once "queries/getFormaCalculo.php"; ?>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container" id="grupoContainer">
    <table class="table table-hover table-responsive" id="gruposVer" data-csv = true data-copy = true data-xls = true data-titulo = "Gestión de grupos" >
      <thead>
        <tr class="table-header">
          <th class="table-column-title">GRUPO</th>
          <th class="table-column-title">PROFESOR PRINCIPAL</th>
          <th class="table-column-title">CLASE-NIVEL</th>
          <th class="table-column-title">DISCIPLINA</th>
          <th class="table-column-title">HORARIO</th>
          <th class="table-column-title ">NÚMERO MÁXIMO DE ALUMNOS</th>
          <th class="table-column-title ordenar" data-order-dir = "desc">NÚMERO DE ALUMNOS INSCRITOS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">GRUPO</th>
          <th class="table-column-title">PROFESOR PRINCIPAL</th>
          <th class="table-column-title">CLASE-NIVEL</th>
          <th class="table-column-title">DISCIPLINA</th>
          <th class="table-column-title">HORARIO</th>
          <th class="table-column-title ">NÚMERO MÁXIMO DE ALUMNOS</th>
          <th class="table-column-title">NÚMERO DE ALUMNOS INSCRITOS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container" id="grupoDetalleContainer" style='display:none'>
    <div class="col-xs-12 col-sm-12 col-md-6 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DATOS DEL GRUPO SELECCIONADO</div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <label class='label-right col-xs-4 col-sm-2 col-md-3'>GRUPO: </label>
          <input type="text" class="information-display col-xs-8 col-sm-10 col-md-9" id="nombreGrupo" disabled/> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-right col-xs-4 col-sm-2 col-md-3'>PROFESOR PRINCIPAL: </label>
              <input type="text" class="information-display col-xs-8 col-sm-10 col-md-9" id="profesorPrincipal" disabled/> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
            <label class='label-right col-xs-4 col-sm-2 col-md-3'>Clase - Nivel: </label>
            <input type="text" class="information-display col-xs-8 col-sm-10 col-md-9" id="nombreClase" disabled/> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <label class='label-right col-xs-4 col-sm-2 col-md-3'>HORARIO: </label>
                <div class="information-display col-xs-8 col-sm-10 col-md-9" id="horario" disabled></div> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <label class='label-right col-xs-4 col-sm-2 col-md-3'>HORAS: </label>
                <input type="text" class="information-display col-xs-8 col-sm-10 col-md-9" id="horas" disabled/> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <label class='label-right col-xs-4 col-sm-2 col-md-3'>NÚMERO MÁXIMO DE ALUMNOS: </label>
          <input type="text" class="information-display col-xs-8 col-sm-10 col-md-9" id="numMaxAlumnos" disabled/> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <label class='label-right col-xs-4 col-sm-2 col-md-3'>ALUMNOS INSCRITOS: </label>
          <input type="text" class="information-display col-xs-8 col-sm-10 col-md-9" id="alumnosInscritos" disabled/> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <div class="col-xs-6 col-sm-6 col-md-6 input-container">
            <button type='button' class='btn btn-save' id='inscribir'>INSCRIBIR ALUMNO</button>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 input-container">
            <button type='button' class='btn btn-save' id='inscribirVarios'>INSCRIBIR VARIOS ALUMNOS</button>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container" style="text-align:center;">
          <button type='button' class='btn btn-transfer' id='transferir'>TRANSFERIR ALUMNOS SELECCIONADOS</button>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container" style="text-align:center;">
          <button type='button' class='btn btn-danger' id='baja'>DAR DE BAJA ALUMNOS SELECCIONADOS</button>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container" style="text-align:center;">
          <button type='button' class='btn btn-back' id='back'>REGRESAR</button>
        </div>
      </fieldset>
    </div>
    <div>
      <button class="btn btn-pdf"  id="exportarPDF">Exportar a PDF</button>
      <table data-unique = "idAlumno" class="table table-hover table-responsive" id="gruposDetallesVer">
        <thead>
          <tr class="table-header">
            <th class="table-column-title"></th>
            <th class="table-column-title">ALUMNO</th>
            <th class="table-column-title">FECHA ALTA</th>
            <th class="table-column-title">ACCIONES</th>
          </tr>
        </thead>
        <tfoot>
          <tr class="table-header">
            <th class="table-column-title"></th>
            <th class="table-column-title">ALUMNO</th>
            <th class="table-column-title">FECHA ALTA</th>
            <th class="table-column-title">ACCIONES</th>
          </tr>
        </tfoot>
        <tbody> </tbody>
      </table>
    </div>
  </div>
  </div>
  <!-- Modal Edit -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modalInscribirAlumno">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-user-circle"></i> </div>
            <div class="text-container"> INSCRIBIR ALUMNO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <select class="selectpicker form-input" id="idAlumno" data-live-search="true" name='Asignatura - Nivel'> </select>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" id="inscribirAlumnoTerminar">INSCRIBIR</button>
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



  <div class="modal fade" tabindex="-1" role="dialog" id="modalInscribirVariosAlumnos">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-user-circle"></i> </div>
            <div class="text-container"> INSCRIBIR VARIOS ALUMNOS </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <div class="col-xs-6 col-sm-6 col-md-6">
                  <select class="selectpicker form-input" id="idAlumnoVarios" data-live-search="true" name='Asignatura - Nivel'> </select>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6" hidden>
                  <button type="button" class="btn btn-save" id="agregarAlumnoLista">AGREGAR alumno</button>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
                <table class="table table-hover table-responsive required form-alumno"
                       data-unique = 'idAlumno' data-keys = "idAlumno" id="listaAlumnos">
                  <thead>
                    <tr class="table-header">
                      <th class="table-column-title">ALUMNO</th>
                      <th class="table-column-title">ACCIONES</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr class="table-header">
                      <th class="table-column-title">ALUMNO</th>
                      <th class="table-column-title">ACCIONES</th>
                    </tr>
                  </tfoot>
                  <tbody> </tbody>
                </table>
                <div id = 'textListaAlumnos'></div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save"
                data-function='afterAddVariosAlumnos' data-form="form-alumno" data-script="inscribirVariosAlumnos" data-clear="false"
                 id="inscribirVariosAlumnosTerminar">INSCRIBIR</button>
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
  <div class="modal fade" tabindex="-1" role="dialog" id="modalBajaAlumno">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-user-circle"></i> </div>
            <div class="text-container"> BAJA ALUMNO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <input type='hidden' id='idAlumnoBaja' />
              <div class="col-xs-12 col-sm-12 col-md-12"> <span class="uppercase">¿Desea dar de baja a [<span style='font-weight: bold' id="nombreAlumnoBaja"></span>] de la CLASE [<span style='font-weight: bold' id="nombreGrupoBaja"></span>]? </span>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" id="bajaAlumnoTerminar">Continuar</button>
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
  <div class="modal fade" tabindex="-1" role="dialog" id="modalTransferirAlumno">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-user-circle"></i> </div>
            <div class="text-container"> TRANSFERIR ALUMNOS </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12"> <span class="uppercase">¿A qué clase desea transferir los alumnos seleccionados?</span></div>
              <select id="transferirGrupo" data-live-search='true' class='selectpicker'></select>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" id="transferirAlumnoTerminar">Continuar</button>
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
  <div class="modal fade" tabindex="-1" role="dialog" id="modalBajaAlumnos">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-user-circle"></i> </div>
            <div class="text-container"> BAJA ALUMNOS </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12"> <span class="uppercase">¿Desea dar de baja los alumnos seleccionados de esta clase?</span></div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" id="bajaAlumnosTerminar">Continuar</button>
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

  <div class="modal fade" tabindex="-1" role="dialog" id="modalListaProfesores">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-user-circle"></i> </div>
            <div class="text-container"> EDITAR LISTA DE PROFESORES </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="jumbotron jumbotron-container">
              <div class="jumbotron-text"> GRUPO </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container">
            <label class='label-right col-xs-4 col-sm-4 col-md-4'>GRUPO: </label>
            <input type="text" class="col-xs-8 col-sm-8 col-md-8" id="nombreGrupoPersonal" disabled value = ""/>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> LISTA PROFESORES </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-8 col-md-8 input-container">
                <select class="selectpicker" required data-live-search="true" required data-label="Profesor" id="idProfesor"> </select>
              </div>
              <div class="col-xs-8 col-sm-4 col-md-4 input-container">
                <button type = 'button' class = 'btn btn-save' id = "agregarProfesor">AGREGAR profesor</button>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
                <table class="table table-hover table-responsive form-profesores required"  data-unique = 'idProfesor' data-keys = "idProfesor,principal" id="listaProfesores">
                  <thead>
                    <tr class="table-header">
                      <th class="table-column-title">PROFESOR</th>
                        <th class="table-column-title">PRINCIPAL</th>
                      <th class="table-column-title">ACCIONES</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr class="table-header">
                      <th class="table-column-title">PROFESOR</th>
                        <th class="table-column-title">PRINCIPAL</th>
                      <th class="table-column-title">ACCIONES</th>
                    </tr>
                  </tfoot>
                  <tbody> </tbody>
                </table>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type='hidden' id='idGrupo' class='form-profesores form-alumno' />
                <button type="button" class="btn btn-save"
                data-function='afterEditProfesores' data-form="form-profesores" data-script="editarListaProfesores" data-clear="true" id="editarListaProfesores">EDITAR LISTA DE PROFESORES</button>
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




  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(7);
        $("#idAlumnoVarios").change(function (){
	$("#agregarAlumnoLista").trigger('click');
});

        tableUtilities.createTable('gruposVer', ['nombreGrupo', 'profesorPrincipal', 'nombreClase', 'nombreDisciplina',
         'horario', 'numMaxAlumnos', 'alumnosInscritos', 'acciones'], ['profesorPrincipal','nombreAsignatura - Nivel', 'nombreDisciplina']);
        tableUtilities.setUniqueColumns('gruposVer', ['idGrupo']);
        tableUtilities.createTable('gruposDetallesVer', [{
            key:'selected',
            type:'table-checkbox',
          }, 'nombreAlumno', 'fechaAlta', 'acciones']);

        tableUtilities.createTable('listaProfesores', ['profesor',
        {
          key:'principal',
          options:'Principal',
          type:'table-radio',
          required:true
       },
       'acciones']);

        tableUtilities.createTable('listaAlumnos', ['alumno', 'acciones']);

        FormEngine.setFormEngine('editarListaProfesores');
        FormEngine.setFormEngine('inscribirVariosAlumnosTerminar');

        Utilizer.loadSelect('idProfesor', 'profesorSelect', 'Profesor');

        $("#agregarProfesor").click(agregarProfesorGrupoButton);

        function agregarProfesorGrupoButton(){
          var sel = Utilizer.getSelected('idProfesor');
          var data = {idProfesor:Number($(sel).val()), profesor:$(sel).text(), principal:false};
          //console.log(data);console.log(tableUtilities.getTableData('listaProfesores'));
          if(!tableUtilities.isInTable('listaProfesores', {idProfesor:data.idProfesor})&&data.idProfesor!=0){
            if(tableUtilities.isEmpty('listaProfesores')){
              data.principal = true;
            }
            tableUtilities.addRowDraw('listaProfesores', data, [["BORRAR", "btn-danger borrar", tableUtilities.borrarFila]]);
          }else{
            console.log(data.idProfesor);
            if(data.idProfesor==0){
                Messager.addAlertText("Agregar profesor", "Para continuar: ", 'w');
            }else{
                Messager.addAlertText("Agregar profesor distinto", "Para continuar: ", 'w');
            }
          }

        }



        function agregarProfesorGrupo(data) {
          data.buttons = [['QUITAR', 'baja btn-danger', tableUtilities.borrarFila]];
          return data;
        }

        tableUtilities.setUniqueColumns('gruposDetallesVer', ['idAlumno']);
        tableUtilities.loadScript('gruposVer', 'getGrupoGestion', {}, agregarGrupo);
        $("#back").click(function () {
          tableUtilities.loadScript('gruposVer', 'getGrupoGestion', {}, agregarGrupo);
          $("#grupoDetalleContainer").hide();
          $("#grupoContainer").show();
        });

        $("#exportarPDF").click(function (){
          var data = {};
          data.type = 'listaalumnos';
          data.params = {};
          data.params.idGrupo = Number($("#idGrupo").val());
          Utilizer.makePdf(data, afterMakePdf, data);
        });
      });

      function afterMakePdf(data, extra){
        Utilizer.savePdfToDisk(extra.type, extra.params.idGrupo);
      }

      function afterEditProfesores() {
        tableUtilities.loadScript('gruposVer', 'getGrupoGestion', {}, agregarGrupo);
        $("#modalListaProfesores").modal('hide');
      }

      function loadProfesores(data){
          data.buttons = [["BORRAR", "btn-danger borrar", tableUtilities.borrarFila]];
          return data;
      }

      function editarProfesores(event) {
        var data = tableUtilities.getDataFromEvent(event);
        data.nombreGrupoPersonal = data.nombreGrupo;
        Utilizer.fillForm(data);
        //console.log("EDITAR Profesores");console.log(data);console.log($("#idGrupo"));
        $("#modalListaProfesores").modal('show');
        tableUtilities.loadScript('listaProfesores', 'getProfesoresGrupo', {idGrupo:data.idGrupo}, loadProfesores);
      }


      function agregarGrupo(data) {
        //console.log(data);
        data.horario = Utilizer.createTextFromHorario(data.listaHorario);
        if (data.alumnosInscritos === null) {
          data.alumnosInscritos = 0;
        }
        data.horas = Utilizer.transFormNumberToHours(data.horas);
        data.precio = Utilizer.numberToCoin(data.precio);
        data.buttons = [['GESTIONAR', 'btn-select', seleccionarGrupo],
        ["Lista Profesores", "profes btn-edit", editarProfesores]];
        return data;
      }

      $("#inscribirAlumnoTerminar").click(function () {
        var data = {}
          , txt = "";
        data.idAlumno = $("#idAlumno").val();
        data.idGrupo = $("#idGrupo").val();
        if (data.idAlumno === null) {
          txt += "Seleccione un alumno. ";
        }
        if (txt == "") {
          Utilizer.getResponse('inscribirAlumnoGrupo', data, afterInscribir, data);
        }
        else {
          Messager.addAlertText("Inscribir Alumno", "Para continuar: " + txt, 'w');
        }
      });
      $("#bajaAlumnoTerminar").click(function () {
        var data = {};
        data.idAlumno = $("#idAlumnoBaja").val();
        data.idGrupo = $("#idGrupo").val();
        Utilizer.sendData('bajaAlumnoGrupo', data, afterBaja, data);
      });

      function afterInscribir(data, extra) {
        //console.log(data);
        data = data.split('|');
        if (data[0] == "s") {
          var insert = {};
          insert.idAlumno = extra.idAlumno;
          insert.nombreAlumno = Utilizer.getSelected('idAlumno').text();
          insert.fechaAlta = Utilizer.fechaDbParseToFecha(data[3]);
          insert.nombreEquipo = data[4];
          tableUtilities.addRowDraw('gruposDetallesVer', insert, [['Dar de baja', 'btn-danger', bajaAlumno]]);
          $("#modalInscribirAlumno").modal('hide');
          $("#alumnosInscritos").val(Number($("#alumnosInscritos").val()) + 1);
          checkPdf();
        }
        Messager.addAlertText(data[2], data[1], data[0]);
      }

      function checkPdf(){
        if(Number($("#alumnosInscritos").val())>0){
          $(".btn-pdf").show();
        }else{
          $(".btn-pdf").hide();
        }
      }

      function afterBaja(data) {
//        console.log(data);
        $("#alumnosInscritos").val(Number($("#alumnosInscritos").val()) - 1);
        checkPdf();
        tableUtilities.loadScript('gruposDetallesVer', 'getGrupoDetalles', {
          idGrupo: $("#idGrupo").val()
        }, agregarGrupoDetalle);

        $("#modalBajaAlumno").modal('hide');
      }

      function seleccionarGrupo() {
        $("#checkMaingruposDetallesVer").prop('checked', false);
        var data = tableUtilities.getDataFromEvent(event);
        Utilizer.fillForm(data);

        if (Number(data.alumnosInscritos) <= Number(data.numMaxAlumnos)) {
          $("#inscribir").show();
        } else {
          $("#inscribir").hide();
        }
        checkPdf();

        tableUtilities.loadScript('gruposDetallesVer', 'getGrupoDetalles', {
          idGrupo: data.idGrupo
        }, agregarGrupoDetalle);
        $("#grupoDetalleContainer").show();
        $("#grupoContainer").hide();
      }

      function agregarGrupoDetalle(data) {
        if (data.nombreEquipo === null) {
          data.nombreEquipo = "N/A";
        }
        //data.fechaAlta = Utilizer.fechaDbParseToFecha(data.fechaAlta);
        data.buttons = [['Dar de baja', 'btn-danger', bajaAlumno]];
        return data;
      }

      function bajaAlumno() {
        var data = tableUtilities.getDataFromEvent(event);
        $("#idAlumnoBaja").val(data.idAlumno);
        $("#nombreAlumnoBaja").text(data.nombreAlumno);
        $("#nombreGrupoBaja").text($("#nombreGrupo").val());
        $("#modalBajaAlumno").modal('show');
      }

      $("#transferir").click(function () {
        var data = tableUtilities.getSelectedData('gruposDetallesVer', ['selected'], ['idAlumno']);
        if (data.length == 0) {
          Messager.addAlertText('Transferir', 'Debe seleccionar al menos un alumno para transferir.', 'w');
        } else {
          $("#modalTransferirAlumno").modal('show');
          Utilizer.loadSelect('transferirGrupo', 'transferirGrupoSelect', 'Grupo', {
            idGrupo: $("#idGrupo").val()
          });
        }
      });

      $("#inscribir").click(function () {
        Utilizer.setPicker('idAlumno', '');
        Utilizer.loadSelect('idAlumno', 'alumnoTutorGrupoSelect', 'Alumno', {});
        $("#modalInscribirAlumno").modal('show');
      });

      $("#inscribirVarios").click(function () {
        Utilizer.setPicker('idAlumnoVarios', '');
        Utilizer.loadSelect('idAlumnoVarios', 'alumnoTutorGrupoSelect', 'Alumno', {});
        tableUtilities.clearTable('listaAlumnos');
        $("#modalInscribirVariosAlumnos").modal('show');
      });

      $("#agregarAlumnoLista").click(function (){
          var data = {}, sel = Utilizer.getSelected('idAlumnoVarios');
          data.idAlumno = Number(sel.val());
          data.alumno = sel.text();
          if(data.idAlumno==""){
            Messager.addAlertText('Agregar Alumno', 'Debe seleccionar un alumno para agregar.', 'w');
          }else if(!tableUtilities.isInTable('listaAlumnos', {idAlumno:Number(data.idAlumno)})){
              tableUtilities.addRowDraw('listaAlumnos', data, [['Borrar', 'btn-danger borrar', tableUtilities.borrarFila]]);
          }
      });

      $("#baja").click(function () {
          var data = tableUtilities.getSelectedData('gruposDetallesVer', ['selected'], ['idAlumno']);
        //console.log("Seleccionados");console.log(data);
        if (data.length == 0) {
          Messager.addAlertText('Baja', 'Debe seleccionar al menos un alumno para dar de baja.', 'w');
        }
        else {
          $("#modalBajaAlumnos").modal('show');
        }
      });

      $("#bajaAlumnosTerminar").click(function () {
        var data = {}
          , txt;
        data.alumnos = tableUtilities.getSelectedData('gruposDetallesVer', ['selected'], ['idAlumno']);
        data.idGrupo = $("#idGrupo").val();
        Utilizer.sendData('bajaAlumnos', data, transferirAlumnoTerminar, data);
      });

      $("#transferirAlumnoTerminar").click(function () {
        var data = {}, txt;
        data.alumnos = tableUtilities.getSelectedData('gruposDetallesVer', ['selected'], ['idAlumno']);
        data.idGrupo = $("#idGrupo").val();
        data.idGrupoTransferir = $("#transferirGrupo").val();
        //console.log(data);
        if (data.idGrupoTransferir === null) {
          Messager.addAlertText('Transferir', "Debe seleccionar un grupo para transferir a los alumnos. ", 'w');
        }
        else {
          Utilizer.sendData('transferirAlumnos', data, transferirAlumnoTerminar, data);
        }
      });

      function transferirAlumnoTerminar(data, extra) {
        //console.log("transferirAlumnoTerminar");console.log(data);console.log(extra);
        $("#modalTransferirAlumno").modal('hide');
        $("#modalBajaAlumnos").modal('hide');
        tableUtilities.loadScript('gruposDetallesVer', 'getGrupoDetalles', {
          idGrupo: $("#idGrupo").val()
        }, agregarGrupoDetalle);
        var inscritos = Number($("#alumnosInscritos").val());
        inscritos -= extra.alumnos.length;
        $("#alumnosInscritos").val(inscritos);
        checkPdf();
      }

      function afterAddVariosAlumnos(data){
        if(data.inscrito===undefined){
          $("#modalInscribirVariosAlumnos").modal('hide');
          tableUtilities.loadScript('gruposDetallesVer', 'getGrupoDetalles', {idGrupo: $("#idGrupo").val()}, agregarGrupoDetalle);
          $("#alumnosInscritos").val(Number($("#alumnosInscritos").val())+tableUtilities.getTableData('listaAlumnos').length);
        }else{
          for(var i = 0;i<data.inscrito.length;i++){
            tableUtilities.deleteRow('listaAlumnos', {idAlumno:Number(data.inscrito[i].idAlumno)});
          }
          tableUtilities.draw('listaAlumnos');
          if(data.inscrito.length>0){
            $("#textListaAlumnos").text("Se han quitado los alumnos que ya estaban inscritos a esta clase.");
          }
        }
      }
    </script>
