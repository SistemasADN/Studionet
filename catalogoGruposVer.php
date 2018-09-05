<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-user-circle"></i> </div>
    <div class="text-container"> VER GRUPOS </div>
  </div>
  <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
      <button type="button" onClick = 'location.href = "gestionVerGrupo.php";' class="btn btn-save">GESTIONAR GRUPOS</button>
  </div>
  <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
      <button type="button" onClick = 'location.href = "perfilConfiguracionPagos.php";' class="btn btn-save">CONFIGURACIÓN COBANZA</button>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="gruposVer" data-pdf = true data-csv = true data-copy = true data-xls = true data-titulo = "Grupos" >
      <thead>
        <tr class="table-header">
          <th class="table-column-title">GRUPO</th>
          <th class="table-column-title">CLASE</th>
          <th class="table-column-title">NIVEL</th>
          <th class="table-column-title">NÚMERO MÁXIMO ALUMNOS</th>
        <!--  <th class="table-column-title">CUOTA MENSUAL</th> -->
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">GRUPO</th>
          <th class="table-column-title">CLASE</th>
          <th class="table-column-title">NIVEL</th>
          <th class="table-column-title">NÚMERO MÁXIMO ALUMNOS</th>
      <!--    <th class="table-column-title">CUOTA MENSUAL</th> -->
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <!-- Modal Edit -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modaleditarGrupo">
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
            <div class="text-container"> EDITAR GRUPO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DATOS DEL GRUPO </div>
                </div>
              </div>
              <input type='hidden' id='idGrupo' class='form-input form-profesores' />
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <select class="selectpicker form-input " data-live-search="true" data-script='asignaturaSelect' required data-label="Clase" id="idAsignatura" name='Asignatura'> </select>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <select class="selectpicker form-input " data-live-search="true" data-script='nivelSelect' required data-label="Nivel" id="idNivel" name='Nivel'> </select>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                    <input type="text" class="form-control form-input capitalize" required data-type = "alphnum" placeholder="Nombre de la clase" id="nombreGrupo"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="number" class="form-control form-input" required data-min='1' placeholder="Número máximo de alumnos" id="numMaxAlumnos"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container" hidden>
                <input type="number" class="form-control form-input" id = 'precio' hidden required placeholder="Precio"/>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" data-function='afterEdit' data-form="form-input" data-script="editarGrupo" data-clear="true" id="editarGrupo">editar grupo</button>
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






  <div class="modal fade" tabindex="-1" role="dialog" id="modalBajaGrupo">
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
            <div class="text-container"> BAJA GRUPO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <input type='hidden' id='bajaIdGrupo' />
              <div class="col-xs-12 col-sm-12 col-md-12">
              <span class="uppercase">¿Desea dar de baja al grupo [<span style='font-weight: bold' id="grupoNombreBaja"></span>]? Esta acci&oacute;n es permanente.</span>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" id="bajaGrupo">Continuar</button>
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
        //Csser.collapse(15);
        tableUtilities.createTable('gruposVer',
        ['nombreGrupo', 'nombreAsignatura', 'nombreNivel', 'numMaxAlumnos', 'estatus', 'acciones'],
         ['nombreAsignatura', 'nombreNivel']);

        tableUtilities.setUniqueColumns('gruposVer', ['idGrupo']);
        tableUtilities.loadScript('gruposVer', 'getGrupo', {}, agregarGrupo);
        FormEngine.setFormEngine('editarGrupo');
        modalUtilities.Initialize('editarGrupo');
      });

      function agregarGrupo(data) {
        if (data.fechaBaja === null) {
          data.estatus = "Activo desde " + Utilizer.fechaDbParseToFecha(data.fechaAlta);
          data.buttons = [["Editar", "editar btn-edit", editarGrupo], ['Dar de baja', 'btn-danger', bajaGrupo]];
        }
        else {
          data.estatus = "Inactivo desde " + Utilizer.fechaDbParseToFecha(data.fechaBaja);
          data.buttons = [];
        }
        data.precio = Utilizer.numberToCoin(data.precio);
        return data;
      }



      function editarGrupo(event) {
        var data = tableUtilities.getDataFromEvent(event);
        data.precio = Utilizer.coinToNumber(data.precio);
        modalUtilities.LoadShow('editarGrupo', data);
      }


      function bajaGrupo(event) {
        var data = tableUtilities.getDataFromEvent(event);
        $("#grupoNombreBaja").html(data.nombreGrupo);
        $("#bajaIdGrupo").val(data.idGrupo);
        $("#modalBajaGrupo").modal('show');
      }
      $("#bajaGrupo").click(function () {
        Utilizer.getResponse('bajaGrupo', {
          idGrupo: $("#bajaIdGrupo").val()
        }, afterBaja, {
          idGrupo: $("#bajaIdGrupo").val()
        });
      });

      function afterBaja(data, extra) {
        if (data[0] == "e") {
          data = data.split('|');
          Messager.addAlertText(data[1], data[2], data[0]);
        }
        else {
          tableUtilities.loadScript('gruposVer', 'getGrupo', {}, agregarGrupo);
          $("#modalBajaGrupo").modal('hide');
		      Messager.addAlertText("Baja CLASE", "Se ha dado de baja la clase correctamente.", 's');
        }
      }

      function afterEdit(data, extra) {
        tableUtilities.loadScript('gruposVer', 'getGrupo', {}, agregarGrupo);
        $("#modaleditarGrupo").modal('hide');
      }

    </script>
