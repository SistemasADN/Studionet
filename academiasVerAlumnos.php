<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-users"></i> </div>
    <div class="text-container"> VER ALUMNOS </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="alumnosVer">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">CORREO</th>
          <th class="table-column-title">GÉNERO</th>
          <th class="table-column-title">PADRE/TUTOR</th>
          <th class="table-column-title">COLEGIO</th>
          <th class="table-column-title">GRADO ESCOLAR</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">CORREO</th>
          <th class="table-column-title">GÉNERO</th>
          <th class="table-column-title">PADRE/TUTOR</th>
          <th class="table-column-title">COLEGIO</th>
          <th class="table-column-title">GRADO ESCOLAR</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <!-- Modal Edit -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modaleditarAlumno">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-users"></i> </div>
            <div class="text-container"> EDITAR ALUMNO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> NOMBRE COMPLETO </div>
                </div>
              </div>
              <input type="hidden" class="form-input" id="idAlumno">
              <input type="hidden" class="form-input" id="idPersona">
              <input type="hidden" class="form-input" id="ca">
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input capitalize" required placeholder="Nombre(s)" id="nombre"> </div>
              <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input capitalize" required placeholder="Apellido Paterno" id="apellidoPaterno"> </div>
              <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input capitalize" placeholder="Apellido Materno" id="apellidoMaterno"> </div>
              <div class="col-xs-12 col-sm-6 col-md-6 input-container">
                <select class="selectpicker form-input" data-live-search="false" data-script="generoSelect" required data-label="Genero" id="generoSearch" name='Genero'> </select>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 input-container date-container">
                <label class='label-fecha'>FECHA DE NACIMIENTO</label>
                <div class="input-group date" id="fechaSelect"> <span class="input-group-addon">
                    <i class="glyphicon glyphicon-calendar"></i>
                </span>
                  <input type="text" class="form-control form-input" required id="fechaSelectText"> </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> INFORMACION DE CONTACTO </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="email" class="form-control form-input lowercase" placeholder="Correo Electronico" id="email"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DATOS DE PADRE/TUTOR </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <select class="selectpicker form-input" data-live-search="true" data-script="clienteSelect" required data-label="Padre/Tutor" id="clienteSearch" name='Padre/Tutor'> </select>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DATOS DE COLEGIO </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <select class="selectpicker form-input" data-live-search="true" data-script="colegioSelect" data-label="Colegio" id="colegioSearch" name='Colegio'> </select>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <select class="selectpicker form-input" data-live-search="true" data-script="gradoSelect" data-label="Grado" id="gradoSearch" name='Grado'> </select>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <div class="col-xs-12 col-md-12 col-md-9">
                  <input type="checkbox" id="estatus" checked data-true="ACTIVO" data-false="INACTIVO" class='form-input switcher'> </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" data-form="form-input" data-script="editarAlumno" data-function="afterEdit" data-clear="true" id="editarAlumno">Guardar</button>
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
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(2);
        tableUtilities.createTable('alumnosVer', ['nombreCompleto', 'email', 'genero', 'tutor', 'colegio', 'nombreGrado', 'estatus', 'acciones']);
        tableUtilities.setUniqueColumns('alumnosVer', ['idAlumno']);
        tableUtilities.loadScript('alumnosVer', 'getAlumno', {}, agregarAlumno);
        FormEngine.setFormEngine('editarAlumno');
        modalUtilities.Initialize('editarAlumno');
        Utilizer.makeDatepicker('fechaSelect');

        function agregarAlumno(data) {
          data.nombreCompleto = data.nombre + " " + data.apellidoPaterno;
          if (data.apellidoMaterno != "") {
            data.nombreCompleto += " " + data.apellidoMaterno;
          }
          if (data.email == "") {
            data.email = "N/E";
          }
          if(data.colegio == null){
            data.colegio = "N/E";
          }
          if(data.nombreGrado == null){
            data.nombreGrado = "N/E";
          }
          data.estatus = data.activo == 1 ? "ACTIVO" : "INACTIVO";
          if(data.ca!=null){
            data.tutor += ' (Alumno es cliente)';
          }
          //console.log(data);
          data.buttons = [["Editar", "btn-edit", editarAlumno]];
          return data;
        }
      });

      function editarAlumno(event) {
        var data = tableUtilities.getDataFromEvent(event);
        data.generoSearch = data.idGenero;
        data.fechaSelectText = Utilizer.fechaDbParseToFecha(data.fechaNacimiento);
        if (data.email == "N/E") {
          data.email = "";
        }
        data.clienteSearch = data.idTutor;
        data.colegioSearch = data.idColegio;
        data.gradoSearch = data.idGrado;
        //console.log(data);
        if(data.ca===null){
          data.ca = 0;
          $('#clienteSearch').prop('disabled',false);
        } else {
          $('#clienteSearch').prop('disabled',true);
        }
        modalUtilities.LoadShow('editarAlumno', data);
      }

      function afterEdit(data, extra) {
        data.activo = data.estatus ? 1 : 0;
        data.estatus = data.activo == 1 ? "ACTIVO" : "INACTIVO";
        data.idColegio = Number(data.colegioSearch);
        if (data.email == "") {
          data.email = "N/E";
        }
        data.fechaNacimiento = Utilizer.fechaParseToDbDate(data.fechaSelectText);
        data.genero = extra.generoSearch;
        data.idAlumno = Number(data.idAlumno);
        data.idColegio = Number(data.colegioSearch);
        data.idGenero = Number(data.generoSearch);
        data.idGrado = Number(data.gradoSearch);
        data.idPersona = Number(data.idPersona);
        data.idTutor = Number(data.clienteSearch);
        data.nombreCompleto = data.nombre + " " + data.apellidoPaterno;
        data.nombreCompleto = data.apellidoMaterno != "" ? data.nombreCompleto + " " + data.apellidoMaterno : data.nombreCompleto;
        data.tutor = extra.clienteSearch;
        if(data.idColegio == 0) {
          data.colegio = "N/E";
        } else {
          data.colegio = extra.colegioSearch;
        }
        if(data.idGrado == 0) {
          data.nombreGrado = "N/E";
        } else {
          data.nombreGrado = extra.gradoSearch;
        }
        //console.log(data);
        //console.log(extra);
        data.ca = Number(data.ca);
        if(data.ca==0){
          data.ca = null;
        } else {
          data.tutor = data.nombreCompleto;
        }
        var buttons = [["Editar", "btn-edit", editarAlumno]];
        tableUtilities.updateRow('alumnosVer', {
          idAlumno: data.idAlumno
        }, data, buttons);
        $("#modaleditarAlumno").modal('hide');
      }
    </script>
