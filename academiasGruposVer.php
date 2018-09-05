<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-users"></i> </div>
    <div class="text-container"> VER GRUPOS </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="gruposVer">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">GRUPO</th>
          <th class="table-column-title">PROFESOR PRINCIPAL</th>
          <th class="table-column-title">PROFESOR SECUNDARIO</th>
          <th class="table-column-title">NUMERO MAXIMO ALUMNOS</th>
          <th class="table-column-title">PRECIO</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">GRUPO</th>
          <th class="table-column-title">PROFESOR PRINCIPAL</th>
          <th class="table-column-title">PROFESOR SECUNDARIO</th>
          <th class="table-column-title">NUMERO MAXIMO ALUMNOS</th>
          <th class="table-column-title">PRECIO</th>
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
            <div class="logo-container"> <i class="fa fa-users"></i> </div>
            <div class="text-container"> EDITAR GRUPO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DATOS DE GRUPO </div>
                </div>
              </div>
              <input type='hidden' id='idGrupo' class='form-input' />
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <select class="selectpicker form-input " data-live-search="true" data-script='claseSelect' required data-label="Clase" id="idClase" name='Clase'> </select>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                    <input type="text" class="form-control form-input" required data-type = "alphnum" placeholder="Nombre del grupo" id="nombreGrupo"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <select class="selectpicker form-input " data-live-search="true" data-script='profesorSelect' required data-label="Profesor Principal" id="idProfesorPrincipal" name='Clase'> </select>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <select class="selectpicker form-input " data-live-search="true" data-script='profesorSelect' data-label="Profesor Secundario" id="idProfesorSecundario" name='Clase'> </select>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="number" class="form-control form-input" required data-min='1' placeholder="Número máximo de alumnos" id="numMaxAlumnos"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="number" class="form-control form-input" required placeholder="Precio" id="precio"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" data-function='afterEdit' data-form="form-input" data-script="editarGrupo" data-clear="true" id="editarGrupo">Guardar</button>
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
            <div class="logo-container"> <i class="fa fa-users"></i> </div>
            <div class="text-container"> BAJA GRUPO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <input type='hidden' id='bajaIdGrupo' />
              <div class="col-xs-12 col-sm-12 col-md-12">
              <span class="uppercase">¿Desea dar de baja el grupo [<span style='font-weight: bold' id="grupoNombreBaja"></span>]? Esta acci&oacute;n es permanente.</span>
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
        //Csser.collapse(4);
        tableUtilities.createTable('gruposVer', ['nombreGrupo', 'nombreProfesorPrincipal', 'nombreProfesorSecundario', 'numMaxAlumnos', 'precio', 'estatus', 'acciones']);
        tableUtilities.setUniqueColumns('gruposVer', ['idGrupo']);
        tableUtilities.loadScript('gruposVer', 'getGrupo', {}, agregarGrupo);
        FormEngine.setFormEngine('editarGrupo');
        modalUtilities.Initialize('editarGrupo');

        function agregarGrupo(data) {
          if (data.fechaBaja === null) {
            data.estatus = "Activo desde " + Utilizer.fechaDbParseToFecha(data.fechaAlta);
            data.buttons = [["Editar", "btn-edit", editarGrupo], ['Dar de baja', 'btn-danger', bajaGrupo]];
          }
          else {
            data.estatus = "Inactivo desde " + Utilizer.fechaDbParseToFecha(data.fechaBaja);
            data.buttons = [];
          }
          data.precio = Utilizer.numberToCoin(data.precio);
          return data;
        }
      });

      function editarGrupo(event) {
        var data = tableUtilities.getDataFromEvent(event);
        data.precio = Utilizer.coinToNumber(data.precio);
        modalUtilities.LoadShow('editarGrupo', data);
      }

      function bajaGrupo(event) {
        var data = tableUtilities.getDataFromEvent(event);
        console.log(data);
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
          var d = tableUtilities.getRowData('gruposVer', {
            idGrupo: Number(extra.idGrupo)
          });
          d.estatus = "Inactivo desde " + Utilizer.fechaDbParseToFecha(data);
          tableUtilities.updateRow('gruposVer', {
            idGrupo: Number(extra.idGrupo)
          }, d, []);
          $("#modalBajaGrupo").modal('hide');
		  Messager.addAlertText("Baja grupo", "Se ha dado de baja el grupo correctamente.", 's');
        }
      }

      function afterEdit(data, extra) {
        var d = tableUtilities.getRowData('gruposVer', {
          idGrupo: Number(data.idGrupo)
        });
        var s = Utilizer.getOptionByValue('idClase', data.idClase);
        d.nombreProfesorPrincipal = extra.idProfesorPrincipal;
        if(extra.idProfesorSecundario===undefined){
          extra.idProfesorSecundario = "";
        }
        d.nombreGrupo = data.nombreGrupo;
        d.nombreProfesorSecundario = extra.idProfesorSecundario;
        console.log(extra);
        d.idClase = data.idClase;
        d.numMaxAlumnos = data.numMaxAlumnos;
        d.precio = Utilizer.numberToCoin(d.precio);
        var buttons = [["Editar", "btn-edit", editarGrupo], ['Dar de baja', 'btn-danger', bajaGrupo]];
        tableUtilities.updateRow('gruposVer', {
          idGrupo: Number(data.idGrupo)
        }, d, buttons);
        $("#modaleditarGrupo").modal('hide');
      }
    </script>
