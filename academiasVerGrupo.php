<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-user-circle"></i> </div>
    <div class="text-container"> GESTIONAR GRUPOS </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container" id="grupoContainer">
    <table class="table table-hover table-responsive" id="gruposVer">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">CLASE</th>
          <th class="table-column-title">PROFESOR PRINCIPAL</th>
          <th class="table-column-title">PROFESOR SECUNDARIO</th>
          <th class="table-column-title">PRECIO/HORAS</th>
          <th class="table-column-title">NUMERO MAXIMO DE ALUMNOS</th>
          <th class="table-column-title">NUMERO ALUMNOS INSCRITOS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">CLASE</th>
          <th class="table-column-title">PROFESOR PRINCIPAL</th>
          <th class="table-column-title">PROFESOR SECUNDARIO</th>
          <th class="table-column-title">PRECIO/HORAS</th>
          <th class="table-column-title">NUMERO MAXIMO DE ALUMNOS</th>
          <th class="table-column-title">NUMERO ALUMNOS INSCRITOS</th>
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
            <div class="jumbotron-text"> DATOS DE GRUPO SELECCIONADO</div>
          </div>
        </div>
        <input type='hidden' id='idGrupo' />
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <label class='label-right col-xs-4 col-sm-2 col-md-3'>PROFESOR PRINCIPAL: </label>
          <input type="text" class="information-display col-xs-8 col-sm-10 col-md-9" id="nombreProfesorPrincipal" disabled/> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <label class='label-right col-xs-4 col-sm-2 col-md-3'>PROFESOR SECUNDARIO: </label>
          <input type="text" class="information-display col-xs-8 col-sm-10 col-md-9" id="nombreProfesorSecundario" disabled/> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <label class='label-right col-xs-4 col-sm-2 col-md-3'>GRUPO: </label>
          <input type="text" class="information-display col-xs-8 col-sm-10 col-md-9" id="nombreGrupo" disabled/> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <label class='label-right col-xs-4 col-sm-2 col-md-3'>NUMERO MAXIMO DE ALUMNOS: </label>
          <input type="text" class="information-display col-xs-8 col-sm-10 col-md-9" id="numMaxAlumnos" disabled/> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <label class='label-right col-xs-4 col-sm-2 col-md-3'>ALUMNOS INSCRITOS: </label>
          <input type="text" class="information-display col-xs-8 col-sm-10 col-md-9" id="alumnosInscritos" disabled/> </div>
        <button type='button' class='btn btn-save' id='inscribir'>INSCRIBIR ALUMNO</button>
        <button type='button' class='btn btn-transfer' id='transferir'>TRANSFERIR ALUMNOS SELECCIONADOS</button>
        <button type='button' class='btn btn-danger' id='baja'>DAR DE BAJA ALUMNOS SELECCIONADOS</button>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container" style="text-align:center;">
          <button type='button' class='btn btn-back' id='back'>REGRESAR</button>
        </div>
      </fieldset>
    </div>
    <div>
      <table class="table table-hover table-responsive" id="gruposDetallesVer">
        <thead>
          <tr class="table-header">
            <th class="table-column-title">
              <input type="checkbox" data-class="checkgruposDetallesVer" id="checkMaingruposDetallesVer" />
            </th>
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
                <select class="selectpicker form-input" id="idAlumno" data-live-search="true" name='Clase'> </select>
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
              <div class="col-xs-12 col-sm-12 col-md-12"> <span class="uppercase">¿Desea dar de baja a [<span style='font-weight: bold' id="nombreAlumnoBaja"></span>] del grupo [<span style='font-weight: bold' id="nombreGrupoBaja"></span>]? </span>
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
              <div class="col-xs-12 col-sm-12 col-md-12"> <span class="uppercase">¿A qué grupo desea transferir los alumnos seleccionados?</span></div>
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
              <div class="col-xs-12 col-sm-12 col-md-12"> <span class="uppercase">¿Desea dar de baja los alumnos seleccionados de este grupo?</span></div>
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
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(6);
        tableUtilities.createTable('gruposVer', ['nombreGrupo', 'nombreProfesorPrincipal', 'nombreProfesorSecundario', 'precioHoras', 'numMaxAlumnos', 'alumnosInscritos', 'acciones'], ['nombreClase']);
        tableUtilities.setUniqueColumns('gruposVer', ['idGrupo']);
        tableUtilities.createTable('gruposDetallesVer', ['seleccionar', 'nombreAlumno', 'fechaAlta', 'acciones']);
        tableUtilities.setUniqueColumns('gruposDetallesVer', ['idAlumno']);
        tableUtilities.loadScript('gruposVer', 'getGrupoGestion', {}, agregarGrupo);
        Utilizer.loadSelect('idAlumno', 'alumnoTutorGrupoSelect', 'Alumno');
        $("#back").click(function () {
          tableUtilities.loadScript('gruposVer', 'getGrupoGestion', {}, agregarGrupo);
          $("#grupoDetalleContainer").hide();
          $("#grupoContainer").show();
        });
      });

      function agregarGrupo(data) {
        console.log(data);
        if (data.alumnosInscritos === null) {
          data.alumnosInscritos = 0;
        }
        data.precio = Utilizer.numberToCoin(data.precio);
        data.buttons = [['Seleccionar', 'btn-select', seleccionarGrupo]];
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
        console.log(data);
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
        }
        Messager.addAlertText(data[2], data[1], data[0]);
      }

      function afterBaja(data) {
        console.log(data);
        $("#alumnosInscritos").val(Number($("#alumnosInscritos").val()) - 1);
        tableUtilities.deleteRow('gruposDetallesVer', {
          idAlumno: Number(data.idAlumno)
        });
        $("#modalBajaAlumno").modal('hide');
      }

      function seleccionarGrupo() {
        $("#checkMaingruposDetallesVer").prop('checked', false);
        var data = tableUtilities.getDataFromEvent(event);
        $("#nombreProfesorPrincipal").val(data.nombreProfesorPrincipal);
        $("#nombreProfesorSecundario").val(data.nombreProfesorSecundario);
        $("#alumnosInscritos").val(data.alumnosInscritos);
        $("#numMaxAlumnos").val(data.numMaxAlumnos);
        $("#nombreGrupo").val(data.nombreGrupo);
        $("#idGrupo").val(data.idGrupo);
        if (Number(data.alumnosInscritos) <= Number(data.numMaxAlumnos)) {
          $("#inscribir").show();
        }
        else {
          $("#inscribir").hide();
        }
        $("#grupoDetalleContainer").show();
        $("#grupoContainer").hide();
        tableUtilities.loadScript('gruposDetallesVer', 'getGrupoDetalles', {
          idGrupo: data.idGrupo
        }, agregarGrupoDetalle);
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
        var data = tableUtilities.getSelectedData('gruposDetallesVer');
        //console.log("Seleccionados");console.log(data);
        if (data.length == 0) {
          Messager.addAlertText('Transferir', 'Debe seleccionar al menos un alumno para transferir.', 'w');
        }
        else {
          $("#modalTransferirAlumno").modal('show');
          Utilizer.loadSelect('transferirGrupo', 'transferirGrupoSelect', 'Grupo', {
            idGrupo: $("#idGrupo").val()
          });
        }
      });
      $("#inscribir").click(function () {
        Utilizer.setPicker('idAlumno', '');
        $("#modalInscribirAlumno").modal('show');
      });
      $("#baja").click(function () {
        var data = tableUtilities.getSelectedData('gruposDetallesVer');
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
        data.alumnos = tableUtilities.getSelectedData('gruposDetallesVer', ['idAlumno']);
        data.idGrupo = $("#idGrupo").val();
        Utilizer.sendData('bajaAlumnos', data, transferirAlumnoTerminar, data);
      });
      $("#transferirAlumnoTerminar").click(function () {
        var data = {}
          , txt;
        data.alumnos = tableUtilities.getSelectedData('gruposDetallesVer', ['idAlumno']);
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

      function transferirAlumnoTerminar(data) {
        $("#modalTransferirAlumno").modal('hide');
        $("#modalBajaAlumnos").modal('hide');
        for (var i = 0; i < data.alumnos.length; i++) {
          tableUtilities.deleteRow('gruposDetallesVer', {
            idAlumno: Number(data.alumnos[i].idAlumno)
          });
        }
        var inscritos = Number($("#alumnosInscritos").val());
        inscritos -= data.alumnos.length;
        $("#alumnosInscritos").val(inscritos);
        tableUtilities.draw('gruposDetallesVer');
      }
    </script>
