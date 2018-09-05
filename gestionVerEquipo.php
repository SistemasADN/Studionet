<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-sitemap"></i> </div>
    <div class="text-container"> GESTIONAR EQUIPOS </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container" id="equipoContainer">
    <table class="table table-hover table-responsive" id="equiposVer" data-pdf = true data-csv = true data-copy = true data-xls = true data-titulo = "Gestión de Equipos" >
      <thead>
        <tr class="table-header">
          <th class="table-column-title">EQUIPO</th>
          <th class="table-column-title">SEDE</th>
          <th class="table-column-title">PROFESOR</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">EQUIPO</th>
          <th class="table-column-title">SEDE</th>
          <th class="table-column-title">PROFESOR</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container" id="equipoDetalleContainer" style='display:none'>
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DATOS DE EQUIPO </div>
          </div>
        </div>
        <input type='hidden' id='idEquipo' />
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <label class='label-right col-xs-4 col-sm-2 col-md-3'>EQUIPO: </label>
          <input type="input" class="information-display col-xs-8 col-sm-10 col-md-9" id="nombreEquipo" disabled/> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <label class='label-right col-xs-4 col-sm-2 col-md-3'>SEDE</label>
          <input type="input" class="information-display col-xs-8 col-sm-10 col-md-9" id="nombreSede" disabled/> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <label class='label-right col-xs-4 col-sm-2 col-md-3'>PROFESOR</label>
          <input type="input" class="information-display col-xs-8 col-sm-10 col-md-9" id="nombreProfesor" disabled/> </div>
        <button type='button' class='btn btn-save' id='inscribir'>AGREGAR ALUMNO A EQUIPO</button>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 input-container" style="text-align:center;">
      <button type='button' class='btn btn-back' id='back'>REGRESAR</button>
    </div>
    </fieldset>
    <div>
      <table class="table table-hover table-responsive" id="equiposDetallesVer">
        <thead>
          <tr class="table-header">
            <th class="table-column-title">ALUMNO</th>
            <th class="table-column-title">FECHA ALTA</th>
            <th class="table-column-title">ACCIONES</th>
          </tr>
        </thead>
        <tfoot>
          <tr class="table-header">
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
            <div class="text-container"> AGREGAR ALUMNO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <select class="selectpicker form-input" data-live-search="true" id="idAlumno" name='Clase'> </select>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" id="inscribirAlumnoTerminar">AGREGAR</button>
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
            <div class="logo-container"> <i class="fa fa-trash"></i> </div>
            <div class="text-container"> BAJA ALUMNO DE EQUIPO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <input type='hidden' id='idAlumnoBaja' /> <span class="uppercase"><div class="col-xs-12 col-sm-12 col-md-12"> ¿Desea dar de baja a [<span style='font-weight: bold' id="nombreAlumnoBaja"></span>] del equipo [<span style='font-weight: bold' id="nombreEquipoBaja"></span>]? </div>
          </span>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container">
            <button type="button" class="btn btn-save" id="bajaAlumnoTerminar">Dar de baja</button>
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
        //Csser.collapse(8);
        tableUtilities.createTable('equiposVer', ['nombreEquipo', 'nombreSede', 'nombreProfesor', 'acciones']);
        tableUtilities.setUniqueColumns('equiposVer', ['idEquipo']);
        tableUtilities.createTable('equiposDetallesVer', ['nombreAlumno', 'fechaAlta', 'acciones']);
        tableUtilities.setUniqueColumns('equiposDetallesVer', ['idAlumno']);
        tableUtilities.loadScript('equiposVer', 'getEquipoGestion', {}, agregarEquipo);
        Utilizer.loadSelect('idAlumno', 'alumnoTutorSelect', 'Alumno');
        $("#back").click(function () {
          tableUtilities.loadScript('equiposVer', 'getEquipoGestion', {}, agregarEquipo);
          $("#equipoDetalleContainer").hide();
          $("#equipoContainer").show();
        });
      });

      function agregarEquipo(data) {
        //console.log(data);
        data.buttons = [['Seleccionar', 'btn-select', seleccionarequipo]];
        return data;
      }
      $("#inscribirAlumnoTerminar").click(function () {
        var data = {}
          , txt = "";
        data.idAlumno = $("#idAlumno").val();
        data.idEquipo = $("#idEquipo").val();
        if (data.idAlumno === null) {
          txt += "Seleccione un alumno. ";
        }
        if (txt == "") {
          Utilizer.getResponse('inscribirAlumnoEquipo', data, afterInscribir, data);
        }
        else {
          Messager.addAlertText("Inscribir Alumno", "Para continuar: " + txt, 'w');
        }
      });
      $("#bajaAlumnoTerminar").click(function () {
        var data = {};
        data.idAlumno = $("#idAlumnoBaja").val();
        data.idEquipo = $("#idEquipo").val();
        Utilizer.sendData('bajaAlumnoEquipo', data, afterBaja, data);
      });

      function afterInscribir(data, extra) {
        data = data.split('|');
        if (data[0] == "s") {
          var insert = {};
          insert.idAlumno = extra.idAlumno;
          insert.nombreAlumno = Utilizer.getSelected('idAlumno').text();
          insert.fechaAlta = Utilizer.fechaDbParseToFecha(data[3]);
          //insert.nombreEquipo = data[4];
          tableUtilities.addRowDraw('equiposDetallesVer', insert, [['Dar de baja', 'btn-danger', bajaAlumno]]);
          $("#modalInscribirAlumno").modal('hide');
        }
        Messager.addAlertText(data[2], data[1], data[0]);
      }

      function afterBaja(data) {
        var idEquipo = $("#idEquipo").val();

        tableUtilities.loadScript('equiposDetallesVer', 'getEquipoDetalles', {
          idEquipo: idEquipo
        }, agregarequipoDetalle);
        $("#modalBajaAlumno").modal('hide');
      }

      function seleccionarequipo() {
        var data = tableUtilities.getDataFromEvent(event);
        $("#nombreProfesor").val(data.nombreProfesor);
        $("#nombreSede").val(data.nombreSede);
        $("#nombreEquipo").val(data.nombreEquipo);
        $("#equipoDetalleContainer").show();
        $("#equipoContainer").hide();
        $("#idEquipo").val(data.idEquipo);
        tableUtilities.loadScript('equiposDetallesVer', 'getEquipoDetalles', {
          idEquipo: data.idEquipo
        }, agregarequipoDetalle);
      }

      function agregarequipoDetalle(data) {
        //data.fechaAlta = Utilizer.fechaDbParseToFecha(data.fechaAlta);
        data.buttons = [['Dar de baja alumno', 'btn-danger', bajaAlumno]];
        return data;
      }

      function bajaAlumno() {
        var data = tableUtilities.getDataFromEvent(event);
        $("#idAlumnoBaja").val(data.idAlumno);
        $("#nombreAlumnoBaja").text(data.nombreAlumno);
        $("#nombreEquipoBaja").text($("#nombreEquipo").val());
        $("#modalBajaAlumno").modal('show');
      }

      $("#inscribir").click(function () {
        Utilizer.setPicker('idAlumno', '');
        $("#modalInscribirAlumno").modal('show');
      });
    </script>
