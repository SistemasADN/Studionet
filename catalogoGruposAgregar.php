<?php include 'templates/top.php';   include_once "queries/getFormaCalculo.php";?>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-user-circle"></i> </div>
    <div class="text-container"> AGREGAR GRUPO </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          <button type="button" onClick = 'location.href = "inscribirAlumnosGrupos.php";' class="btn btn-save">INSCRIBIR ALUMNOS A 	GRUPOS</button>
      </div>
      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-6 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DATOS DEL GRUPO </div>
          </div>
        </div>

        <div class="col-xs-4 col-sm-8 col-md-8 input-container">
          <select class="selectpicker form-input " data-live-search="true" required data-label="Asignatura" id="asignaturaSearch" name='Asignatura'> </select>
        </div>
        <div class="col-xs-8 col-sm-4 col-md-4 input-container">
          <button type = 'button' class = 'btn agregar btn-save' id = "asignatura">AGREGAR CLASE</button>
        </div>
        <div class="col-xs-4 col-sm-8 col-md-8 input-container">
          <select class="selectpicker form-input " data-live-search="true" required data-label="Nivel" id="nivelSearch" name='Nivel'> </select>
        </div>
        <div class="col-xs-8 col-sm-4 col-md-4 input-container">
          <button type = 'button' class = 'btn agregar btn-save' id = "nivel">AGREGAR NIVEL</button>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <input type="text" class="form-control form-input capitalize" required data-type = "alphnum" placeholder="Nombre del grupo" id="nombreGrupo"> </div>
		<div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="number" class="form-control form-input" required data-min = '1' placeholder="Número máximo de alumnos" id="numMaxAlumno"> </div>

		<div class="col-xs-12 col-sm-12 col-md-12 input-container" <?php if($formaCalculoGot!="Por Mes Fijo"&&$formaCalculoGot!="Por Cada Grupo y Costo Por Hora"){ echo 'hidden';}?>>
          <input type="number" data-default = '0' <?php if($formaCalculoGot!="Por Mes Fijo"&&$formaCalculoGot!="Por Cada Grupo y Costo Por Hora"){ echo 'value = "0"';}?> class="form-control form-input" required placeholder="Precio <?php if($formaCalculoGot=="Por Mes Fijo"){echo 'Mensual';}else if($formaCalculoGot=="Por Cada Grupo y Costo Por Hora"){ echo 'Hora';}?>" id="precio"> </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="jumbotron jumbotron-container">
              <div class="jumbotron-text"> LISTA DE PROFESORES </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-8 col-md-8 input-container">
            <select class="selectpicker" required data-live-search="true" required data-label="Profesor" id="idProfesor"> </select>
          </div>
          <div class="col-xs-8 col-sm-4 col-md-4 input-container">
            <button type = 'button' class = 'btn btn-save' id = "agregarProfesor">AGREGAR PROFESOR A LISTA</button>
          </div>


          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
            <table class="table table-hover table-responsive form-input required"
              data-unique = 'idProfesor' data-keys = "idProfesor,principal"
                id="listaProfesores">
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
          <button type="button" class="btn btn-save" data-form="form-input" data-script="agregarGrupo" data-clear="true" id="agregarGrupo">agregar grupo</button>
        </div>
      </fieldset>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="nivelModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
              <i class="fa fa-times-circle"></i>
            </span> </button>
          </div>
          <div class="modal-body">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
              <div class="logo-container"> <i class="fa fa-book"></i> </div>
              <div class="text-container"> AGREGAR NIVEL </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
              <fieldset>
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <input type="text" class="form-control form-nivel capitalize" required placeholder="Nombre de nivel" id="nombreNivel"> </div>
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <button type="button" class="btn btn-save" data-form="form-nivel" data-function = "loadNivel" data-script="agregarNivel" data-clear="true" id="agregarNivel">Guardar</button>
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


  <div class="modal fade" tabindex="-1" role="dialog" id="asignaturaModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-book"></i> </div>
            <div class="text-container"> AGREGAR CLASE </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-asignatura capitalize" required placeholder="Nombre de la clase" id="nombreAsignatura"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <select class="selectpicker form-asignatura " data-live-search="true" required data-label="Disciplina" id="disciplinaSearch" name='Disciplina'> </select>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" data-form="form-asignatura" data-function = "loadAsignatura" data-script="agregarAsignatura" data-clear="true" id="agregarAsignatura">Guardar</button>
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



    <script>
      $(document).ready(function () {

        tableUtilities.createTable('listaProfesores', ['profesor',
            {
              key:'principal',
              options:'Principal',
              type:'table-radio',
              required:true
           }
           , 'acciones']);

        $(".agregar").click(function (){
          var id = $(this).attr('id');
          var vals = ['asignatura', 'nivel', 'clase'];
          for(var i = 0;i<vals.length;i++){
              $("#"+vals[i]+"Modal").modal('hide');
              Utilizer.loadSelect(vals[i]+'Search', vals[i]+'Select', vals[i]);
          }
          $("#"+id+"Modal").modal('show');
          FormEngine.deleteForm(id);
          Utilizer.loadSelect('asignaturaSearch', 'asignaturaSelect', 'Clase');
          Utilizer.loadSelect('nivelSearch', 'nivelSelect', 'Nivel');
          Utilizer.loadSelect('disciplinaSearch', 'disciplinaSelect', 'Disciplina');
        });

        //Csser.collapse(15, 1);
        Utilizer.loadSelect('asignaturaSearch', 'asignaturaSelect', 'Clase');
        Utilizer.loadSelect('nivelSearch', 'nivelSelect', 'Nivel');

        Utilizer.loadSelect('idProfesor', 'profesorSelect', 'Profesor');
        $(".back").click(function (){
          loadNivel();
          loadAsignatura();
        })

        FormEngine.setFormEngine('agregarGrupo');
        FormEngine.setFormEngine('agregarNivel');
        FormEngine.setFormEngine('agregarAsignatura');
        $("#agregarProfesor").click(agregarProfesor);

        $("#asignaturaSearch, #nivelSearch").change(function (){
            var txt = "", asSel = Utilizer.getSelected("asignaturaSearch"), niSel = Utilizer.getSelected("nivelSearch");

            if($("#asignaturaSearch").val()!==null){
              txt += $(asSel).text()+" ";
            }
            if($("#nivelSearch").val()!==null){
              txt += $(niSel).text()+" ";
            }
            txt = txt.trim();

            $("#nombreGrupo").val(txt);
        });
      });

      function agregarProfesor(){
        var sel = Utilizer.getSelected('idProfesor');
        var data = {idProfesor:$(sel).val(), profesor:$(sel).text(), principal:false};
        if(!tableUtilities.isInTable('listaProfesores', data)&&data.idProfesor!=""){
          if(tableUtilities.isEmpty('listaProfesores')){
            data.principal = true;
          }
          tableUtilities.addRowDraw('listaProfesores', data, [["BORRAR", "btn-danger borrar", tableUtilities.borrarFila]]);
        }
      }

      function loadAsignatura(){
        $("#asignaturaModal").modal('hide');
        FormEngine.deleteForm('asignatura');
        Utilizer.loadSelect('asignaturaSearch', 'asignaturaSelect', 'Clase');
      }
      function loadNivel(){
        $("#nivelModal").modal('hide');
        FormEngine.deleteForm('nivel');
        Utilizer.loadSelect('nivelSearch', 'nivelSelect', 'Nivel');
      }

    </script>
<?php include 'templates/bottom.php'; ?>
