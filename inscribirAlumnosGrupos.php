<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-calendar-plus-o"></i> </div>
    <div class="text-container"> INSCRIBIR ALUMNOS A GRUPOS</div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
          <button type="button" onClick = 'location.href = "clientesAlumnosAgregarAlumno.php";' class="btn btn-save">CATÁLOGO AGREGAR ALUMNO</button>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
          <button type="button" onClick = 'location.href = "catalogoGruposAgregar.php";' class="btn btn-save">CATÁLOGO AGREGAR GRUPO</button>
      </div>
      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 form-container">
      <fieldset>
        <div class = 'row container'>
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="jumbotron jumbotron-container">
              <div class="jumbotron-text"><abbr title = 'Seleccione el alumno y el grupo al que desea inscribir a dicho alumno'>SELECCIÓN</abbr></div>
            </div>
          </div>
        </div>
        <!-- fecha -->
                <!-- select equipo -->
        <div class = 'row container'>

          <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="col-xs-12 col-sm-6 col-md-6 input-container">
              <select class="selectpicker" data-live-search="true" data-label="Alumnos" id="idAlumno" name='Alumnos' required> </select>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 input-container">
              <select class="selectpicker" data-live-search="true" data-label="Equipos" id="idEquipo" name='Equipos'> </select>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 input-container" hidden>
              <button type = 'button' class = 'btn btn-save' id = "agregarAlumno"> AGREGAR ALUMNO</button>
            </div>
          </div>

          <div class="col-xs-12 col-sm-6 col-md-6">

            <div class="col-xs-12 col-sm-6 col-md-6 input-container">
              <select class="selectpicker" data-live-search="true" data-label="Grupos" id="idGrupo" name='Grupos' required> </select>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 input-container" hidden>
              <button type = 'button' class = 'btn btn-save' id = "agregarGrupo"> AGREGAR GRUPO</button>
            </div>
          </div>
        </div>

        <div class = 'row container'>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 table-container table-padding">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="jumbotron jumbotron-container">
                <div class="jumbotron-text"> LISTA ALUMNOS </div>
              </div>
            </div>
            <table class="table table-hover table-responsive form-input"
            data-keys = "idAlumno" id="listaAlumnos">
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
            <button class = 'btn btn-danger' data-id = 'listaAlumnos'>Vaciar tabla</button>
          </div>

          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 table-container table-padding">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="jumbotron jumbotron-container">
                <div class="jumbotron-text"> LISTA GRUPOS </div>
              </div>
            </div>
            <table class="table table-hover table-responsive form-input"
            data-keys = "idGrupo" id="listaGrupos">
              <thead>
                <tr class="table-header">
                  <th class="table-column-title">GRUPO</th>
                  <th class="table-column-title">ACCIONES</th>
                </tr>
              </thead>
              <tfoot>
                <tr class="table-header">
                  <th class="table-column-title">GRUPO</th>
                  <th class="table-column-title">ACCIONES</th>
                </tr>
              </tfoot>
              <tbody> </tbody>
            </table>
            <button class = 'btn btn-danger' data-id = 'listaGrupos'>Vaciar tabla</button>
          </div>
        </div>

        <div class = 'row container'>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container no-continuar" hidden>
            <div class="col-xs-12 col-sm-12 col-md-12 empalmes">
              <div class="jumbotron jumbotron-container">
                <div class="jumbotron-text"> EMPALMES DE ALUMNOS CON GRUPOS </div>
              </div>
              <div id = "listaEmpalmes"></div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="jumbotron jumbotron-container inscritos">
                <div class="jumbotron-text"> ALUMNOS YA INSCRITOS A GRUPOS </div>
              </div>
              <div id = "listaInscritos"></div>
              Remueva los grupos o alumnos empalmados para continuar.
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="jumbotron jumbotron-container empalmeHorario">
                <div class="jumbotron-text"> EMPALMES DE GRUPOS CON GRUPOS </div>
              </div>
              <div id = "listaEmpalmeHorario"></div>
            </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 input-container continuar" hidden>
            <button type="button" class="btn btn-save" data-form="form-input" data-script="inscribirAlumnosGrupos"
            data-function="checkEmpalmes" data-clear = "false"
            id="inscribirAlumnosGrupos">Inscribir alumnos a grupos</button>
          </div>
        </div>


      </fieldset>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(2);

        tableUtilities.createTable('listaAlumnos', ['alumno', 'acciones']);
        tableUtilities.createTable('listaGrupos', ['grupo', 'acciones']);

        tableUtilities.addDrawEvent('listaAlumnos', checkEmpalmes);
        tableUtilities.addDrawEvent('listaGrupos', checkEmpalmes);

        Utilizer.loadSelect('idGrupo', 'grupoSelect', 'Grupo');
        Utilizer.loadSelect('idAlumno', 'alumnoSelect', 'Alumno');
        Utilizer.loadSelect('idEquipo', 'equipoAlumnosSelect', 'Equipo');

        FormEngine.setFormEngine('inscribirAlumnosGrupos');
        $("#idAlumno").change(function (){
          $("#agregarAlumno").trigger('click');
        });

        $("#idEquipo").change(function (){
            var alumnos = Utilizer.getSelected('idEquipo').data('alumnos'), curV = $("#idAlumno").val();
            for(var i = 0;i<alumnos.length;i++){
                $("#idAlumno").val(alumnos[i].idAlumno);
                $("#agregarAlumno").trigger('click');
            }
            Utilizer.setPicker('idAlumno', curV);
            Utilizer.setPicker('idEquipo', '');
        });

        $("#idGrupo").change(function (){
          $("#agregarGrupo").trigger('click');
        });

        $("#agregarAlumno").click(agregarAlumno);
        $("#agregarGrupo").click(agregarGrupo);

        $(".btn-danger").click(function (){
            tableUtilities.clearTable($(this).data('id'));
        });

      });

      function agregarGrupo(){
        var sel = Utilizer.getSelected('idGrupo');
        var data = {idGrupo:$(sel).val(), grupo:$(sel).text()};
        if(!tableUtilities.isInTable('listaGrupos', data)&&data.idGrupo!=""){
          tableUtilities.addRowDraw('listaGrupos', data, [["BORRAR", "btn-danger borrar", tableUtilities.borrarFila]]);
        }
      }

      function agregarAlumno(){
        var sel = Utilizer.getSelected('idAlumno');
        var data = {idAlumno:$(sel).val(), alumno:$(sel).text()};
        if(!tableUtilities.isInTable('listaAlumnos', data)&&data.idAlumno!=""){
          tableUtilities.addRowDraw('listaAlumnos', data, [["BORRAR", "btn-danger borrar", tableUtilities.borrarFila]]);
        }
      }

      function checkEmpalmes(){
        var data = {};
        data.alumnos = tableUtilities.getTableData('listaAlumnos', ['idAlumno']);
        data.grupos = tableUtilities.getTableData('listaGrupos', ['idGrupo']);
        Utilizer.getResponse('empalmesAlumnosGrupos', data, agregarEmpalme, data);
      }

      function agregarEmpalme(data, extra){
        console.log(data);
        var actual;
        if(extra.alumnos.length>0&&extra.grupos.length>0){
          if(data.empalme.length==0&&data.inscrito.length==0&&data.empalmeHorario.length==0){
            $(".continuar").show();
            $(".no-continuar").hide();
            $(".empalmes").hide();
            $(".inscritos").hide();
            $(".empalmesHorario").hide();
          }else{
            $(".continuar").hide();
            $(".no-continuar").show();

            if(data.empalme.length>0){
              $(".empalmes").show();
              //crear lista de empalmes
              $("#listaEmpalmes").text("");
              for(var i = 0;i<data.empalme.length;i++){
                actual = data.empalme[i];
                $("#listaEmpalmes").append(Utilizer.getOptionByValue('idAlumno', actual.idAlumno).text()+" ["+Utilizer.getOptionByValue('idGrupo', actual.idGrupoAlumno).text()+"] empalma con ["+Utilizer.getOptionByValue('idGrupo', actual.idGrupoEmpalme).text()+"]<br>");
              }
            }else{
              $("#listaEmpalmes").text("");
              $(".empalmes").hide();
            }

            if(data.inscrito.length>0){
              $(".inscritos").show();
              //Crear lista de inscritos
              $("#listaInscritos").text("");
              for(var i = 0;i<data.inscrito.length;i++){
                actual = data.inscrito[i];
                $("#listaInscritos").append(Utilizer.getOptionByValue('idAlumno', actual.idAlumno).text()+" ["+Utilizer.getOptionByValue('idGrupo', actual.idGrupo).text()+"]<br>");
              }
            }else{
              $("#listaInscritos").text("");
              $(".inscritos").hide();
            }

            if(data.empalmeHorario.length>0){
              $(".empalmeHorario").show();
              //Crear lista de inscritos
              $("#listaEmpalmeHorario").text("");
              for(var i = 0;i<data.empalmeHorario.length;i++){
                actual = data.empalmeHorario[i];
                $("#listaEmpalmeHorario").append("["+Utilizer.getOptionByValue('idGrupo', actual.idGrupoA).text()+"] empalma con ["+Utilizer.getOptionByValue('idGrupo', actual.idGrupoB).text()+"]<br>");
              }
            }else{
              $("#listaEmpalmeHorario").text("");
              $(".empalmeHorario").hide();
            }
          }
        }else{
          $(".continuar").hide();
          $(".no-continuar").hide();
        }
      }

    </script>
