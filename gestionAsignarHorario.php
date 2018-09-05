<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-calendar-plus-o"></i> </div>
    <div class="text-container"> ASIGNAR HORARIO </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 filter-container">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <legend class="custom-legend"><abbr title = 'Elija el salón al que desea asignarle un horario'>Elije un salón.</abbr></legend>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 input-container">
        <label class="col-xs-4 col-sm-4 col-md-4 label-text">SALÓN: </label>
        <select id="salonSearch" data-live-search="true" class="selectpicker col-xs-8 col-sm-8 col-md-8"></select>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 grupo" hidden>
        <legend class="custom-legend">Elije un grupo.</legend>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 input-container grupo" hidden>
        <label class="col-xs-4 col-sm-4 col-md-4 label-text">GRUPO: </label>
        <select id="selectGrupoHorario" data-live-search="true" class="selectpicker col-xs-8 col-sm-8 col-md-8"></select>
      </div>
      <!-- TABLA -->
      <div class="col-xs-12 col-sm-12 col-md-12 instrucciones" hidden>
        <legend class="custom-legend con-salon">Lista de grupos asignados al salón [<span id = "legendSalon">No seleccionado</span>]</legend>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container instrucciones" hidden>
        <div class="col-xs-12 col-sm-12 col-md-12 grupo" hidden>
          <legend class="custom-legend con-salon">Lista de salones del grupo [<span id = "legendGrupo">No selecionada</span>] </legend>
        </div>
        <table class="table table-hover table-responsive" id="salonGrupo">
          <thead>
            <tr class="table-header">
              <th class="table-column-title"><span class = 'columnaEspecial'></span></th>
              <th class="table-column-title">PROFESOR (CLASE - NIVEL)</th>
              <th class="table-column-title">COLOR</th>
              <!-- <th class="table-column-title ordenar" data-order-dir = 'asc'>LETRA</th> -->
            </tr>
          </thead>
          <tfoot>
            <tr class="table-header">
              <th class="table-column-title"><span class = 'columnaEspecial'></span></th>
              <th class="table-column-title">PROFESOR (CLASE - NIVEL)</th>
              <th class="table-column-title">COLOR</th>
              <!-- <th class="table-column-title ordenar" data-order-dir = 'asc'>LETRA</th> -->
            </tr>
          </tfoot>
          <tbody> </tbody>
        </table>
      </div>
      <legend class="col-xs-12 col-sm-12 col-md-12 custom-legend vacio" hidden>
          Para asignar un grupo a este salón utilice <img class = 'mouse-icon' src = "images/primary_mouse.png"/> para definir el horario deseado. Luego utilice <img class = 'mouse-icon' src = "images/secondary_mouse.png"/> sobre la selección y presione la opción de [Asignar GRUPO]
          Por último elija el grupo que quiere asignar y presione el botón [ASIGNAR GRUPO] para terminar.
      </legend>
      <!-- TABLA -->
      <div class="col-xs-12 col-sm-12 col-md-12 empalme" hidden>
        <legend class="custom-legend con-salon">Lista de empalmes</legend>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 empalme" id = "textoEmpalme" hidden></div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 special-table-container instrucciones" hidden>
      <div class="col-xs-12 col-sm-12 col-md-12 leyenda-instrucciones">
        <legend class="custom-legend">
          Utilice <img class = 'mouse-icon' src = "images/primary_mouse.png"/> y arrastre para seleccionar un rango.<br>
          Utilice <img class = 'mouse-icon' src = "images/secondary_mouse.png"/> para abrir el menú de opciones disponible.<br>
          <span id = "opcionPegar" hidden>Para pegar utilice <img class = 'mouse-icon' src = "images/secondary_mouse.png"/> en un espacio vacío y no seleccionado.
          <div class = 'cell' style = 'border: 1px solid rgb(229, 229, 229); width: 114.59px; height: 30px; text-align: center; margin-bottom: 10px;'>Ejemplo</div>
          En caso de que el espacio esté seleccionado use la opción de "QUITAR SELECCIÓN".
        </legend>
      </div>
      <div id="horarioContainer" class="specialTable"> </div>
    </div>
  </div>

  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modalNuevoRegistro">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-navicon"></i> </div>
            <div class="text-container"> ASIGNAR GRUPO AL HORARIO SELECCIONADO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <label class="col-xs-3 col-sm-3 col-md-4 label-text">GRUPOS: </label>
                <select id="idGrupo" data-live-search="true" class="selectpicker col-xs-9 col-sm-9 col-md-8"></select>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" data-function='afterEdit' data-form="form-input" data-script="editarSede"
                data-clear="true" id="nuevoRegistro">Asignar grupo</button>
              </div>
            </fieldset>
          </div>
        </div>
        <div class="modal-footer"></div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->

<!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modalCambiarRegistro">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-navicon"></i> </div>
            <div class="text-container"> CAMBIAR GRUPO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <label class="col-xs-3 col-sm-3 col-md-4 label-text">GRUPO: </label>
                <select id="idGrupoCambiar" data-live-search="true" class="selectpicker col-xs-9 col-sm-9 col-md-8"></select>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" data-function='afterEdit' data-form="form-input" data-script="editarSede" data-clear="true" id="cambiarRegistro">Cambiar grupo</button>
              </div>
            </fieldset>
          </div>
        </div>
        <div class="modal-footer"></div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->

<!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modalBorrarTodosRegistro">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-navicon"></i> </div>
            <div class="text-container"> BORRAR REGISTRO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container"> ¿Está seguro que desea borrar todos los horarios asignados de este grupo a este salón?
                <button type="button" class="btn btn-save" data-function='afterEdit' data-form="form-input" data-script="editarSede" data-clear="true" id="borrarTodosRegistro">Borrar</button>
              </div>
            </fieldset>
          </div>
        </div>
        <div class="modal-footer"></div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->  <!-- Modal Edit -->

<div id = 'datosSeleccion'></div>

<?php include 'templates/bottom.php'; ?>


    <script>
      $(document).ready(function () {
        function resetCopy(){
          $(".copied").removeClass('copied').removeClass('last-copied');
          copyMemory = {};
          $("#opcionPegar").hide();
        }
        tableUtilities.createTable('salonGrupo', ['nombreGrupo', 'detallesGrupo', 'color']);
        //tableUtilities.createTable('grupoSalon', ['nombreSalon', 'color', 'letra']);
        Utilizer.loadSelect('salonSearch', 'salonSelect', 'Salón', {}, easyLoad, undefined, false, [{val:'0',texto:"Sin salón"}]);
        //Utilizer.loadSelect('salonSearch', 'salonSelect', 'Salon', {}, easyLoad);

        Utilizer.loadSelect('selectGrupoHorario', 'grupoSelect', 'Grupo');
        Utilizer.loadSelect('idGrupoCambiar', 'grupoSelect', 'Grupo');

        //$(".instrucciones").show();

        function easyLoad(){
          return;
          //console.log("Easy load Active");
          Utilizer.setPicker('salonSearch', 2);
          $("#salonSearch").trigger('change');
        }

        function changeSelectGrupoHorario (){
          //CHECKPOINT 1
          var send = {};
          //$(".grupo").hide();
          $(".instrucciones").show();
          $("#horarioContainer").find('.header-class').text('');
          $("#horarioContainer").find('.header-class').removeClass('header-class');
          $("#horarioContainer").find('.applied-class').removeClass('applied-class');
          //$("#legendSalon").text(Utilizer.getSelected('salonSearch').text());
          tableUtilities.clearTable('salonGrupo');
          clearCalendar();
          send.idGrupo = $("#selectGrupoHorario").val();
          Utilizer.getResponse('getHorarioGrupo', send, loadHorario);
        }
        $("#selectGrupoHorario").change(changeSelectGrupoHorario);

        $("#salonSearch").change(function () {
          //CHECKPOINT 2
          Utilizer.setPicker('selectGrupoHorario', '');
          if($("#salonSearch").val()==0){
            $(".grupo").show();
            $(".instrucciones").hide();
            return;
          }

          //$(".grupo").hide();
          $(".instrucciones").show();

          $("#horarioContainer").find('.header-class').text('');
          $("#horarioContainer").find('.header-class').removeClass('header-class');
          $("#horarioContainer").find('.applied-class').removeClass('applied-class');

          $("#legendSalon").text(Utilizer.getSelected('salonSearch').text());

		      tableUtilities.clearTable('salonGrupo');
		      clearCalendar();
          Utilizer.getResponse('getHorarioSalon', {idSalon: $("#salonSearch").val()}, loadHorario);
        });

        function clearCalendar(){
          resetCopy();
          var t = "", d;
          for (var j = 0; j < days.length; j++) {
            d = 0;
            for (var i = 0; i < 48; i++) {
              t = $("#" + j + i), d;
              if (!_.isEmpty(t.data())) {
                  d = Number(t.data('duracion'));
                  t.data({});
                  t.removeClass('used').removeClass('header-class').removeClass('applied-class');
                  t.css('background-color', 'white');
                  t.text("");
              } else if (d > 0) {
                t.removeClass('used').removeClass('header-class').removeClass('applied-class');
                t.css('background-color', 'white');
                t.text("");
                d--;
              }
            }
          }
        }

      function loadHorario(data) {
        //console.log("loadHorario");
        //CHECKPOINT 3
        var gray = '';
        if($("#salonSearch").val()==='0'){
            $(".columnaEspecial").text("SALÓN");
            $(".salon").hide();
            $(".grupo").show();
            gray = 'gray';
        }else{
            $(".columnaEspecial").text("GRUPO");
            $(".salon").show();
            $(".grupo").hide();
        }

        $(".empalme").hide();
        $("#escribirEmpalme").html("");
        ////console.log("LOADING HORARIO");////console.log(data);
          tableUtilities.clearTable('salonGrupo');
          $("#horarioContainer").find('.is-selected').text("");
          $("#horarioContainer").find('.is-selected').removeClass('is-selected');
          $("#horarioContainer").find('.is-applied').removeClass('is-applied');
          $(".options-container").hide();
          ////console.log("DATA");//console.log(data);

          var i, actual, extra;
          for (i = 0; i < data.length; i++) {
            actual = data[i];
            //console.log(actual);
            chr = Utilizer.makeLetter(i);
            actual.letra = chr;

            //console.log(actual);
            if(actual.nombreGrupo===null){
              actual.randomColor = Utilizer.randomColor(i, 30, 190);
              actual.nombreGrupo = "Sin Salón";
            }else{
              if(gray){
                  actual.randomColor = {r:150,g:150,b:150};
              }else{
                  actual.randomColor = Utilizer.randomColor(i, 30, 190);
              }
            }
            actual.color = "<div style = 'background-color: " + Utilizer.colorRGB(actual.randomColor) + ";width:100%;height:34px'>&nbsp</div>";
            //tableUtilities.addRow('salonGrupo', actual, [['Asignar horario', 'btn-select', preAsignarHorario], ['Borrar', 'btn-danger', borrarSalonClase]]);
            tableUtilities.addRow('salonGrupo', actual);
            extra = actual.horarios;
            for (j = 0; j < extra.length; j++) {
              var c = {};
              c.r = actual.randomColor.r;
              c.g = actual.randomColor.g;
              c.b = actual.randomColor.b;
              extra[j].idSalonGrupo = actual.idSalonGrupo;
              $("#" + extra[j].dia + "" + extra[j].horaInicio).addClass('used');
              if(actual.nombreGrupo!="Sin Salón"){
                $("#" + extra[j].dia + "" + extra[j].horaInicio).addClass(gray);
              }
              $("#" + extra[j].dia + "" + extra[j].horaInicio).addClass('used-header');
              $("#" + extra[j].dia + "" + extra[j].horaInicio).data(extra[j]);
              $("#" + extra[j].dia + "" + extra[j].horaInicio).css('background-color', Utilizer.colorRGB(c));
              $("#" + extra[j].dia + "" + extra[j].horaInicio).text(actual.nombreGrupo);
              var l = Utilizer.colorLumin(c, 1.5);
              //var l = Utilizer.colorRGB(c);
              //console.log(l);
              extra[j].duracion = Number(extra[j].duracion);
              for (k = 1; k < Number(extra[j].duracion); k++) {
                $("#" + extra[j].dia + "" + (Number(extra[j].horaInicio) + Number(k))).addClass('used');
                if(actual.nombreGrupo!="Sin Salón"){
                  $("#" + extra[j].dia + "" + (Number(extra[j].horaInicio) + Number(k))).addClass(gray);
                }
                $("#" + extra[j].dia + "" + (Number(extra[j].horaInicio) + Number(k))).css('background-color', Utilizer.colorRGB(l));
                $("#" + extra[j].dia + "" + (Number(extra[j].horaInicio) + Number(k))).text(actual.nombreGrupo);
              }
            }
            delete actual.horarios;
          }
          tableUtilities.draw('salonGrupo');
          if(tableUtilities.isEmpty('salonGrupo')){
            $(".vacio").show();
            $(".leyenda-instrucciones").hide();
          }else{
            $(".vacio").hide();
            $(".leyenda-instrucciones").show();
          }
        }

      function preAsignarHorario() {
        alert("preAsignarHorario");
          var d = tableUtilities.getDataFromEvent(event);

          var data = {}, id = $("#horarioContainer").find(".is-selected").attr('id');

    		  if(id===undefined){
    			  Messager.addAlertText("Asignar Clase", "Elija una hora", 'w');
    			  return;
    		  }
		      data.dia = id[0];
          data.horaInicio = id.slice(1);
          data.duracion = $("#horarioContainer").find('.is-applied').length + 1;
          data.idSalonGrupo = d.idSalonGrupo;
//		  //console.log(data);
          Utilizer.sendData('asignarHorario', data, asignarHorario, {data: data, extra: d});
        }

        $("#nuevoRegistro").click(function () {
          var data = {}, txt = "";
          data.idGrupo = $("#idGrupo").val();
          data.idSalon = $("#salonSearch").val();

          if (data.idGrupo === null||data.idGrupo=="") {
            txt += "Debe seleccionar una Clase. ";
          }

          if (data.idSalon === null||data.idSalon=="") {
            txt += "Debe seleccionar un salón. ";
          }

          if(txt==""){
            data.dia =             Number($("#datosSeleccion").data('header').j),
            data.duracion =        Number($("#datosSeleccion").data('header').duracion),
            data.horaInicio =      Number($("#datosSeleccion").data('header').i+1)
            Utilizer.getResponse('getOrAddSalonGrupoHorario', data, asignarSalonGrupoRespuesta, data);
          }else{
            Messager.addAlertText('Asignar Horario', 'Para continuar: '+txt, 'w');
          }
        });


        $("#cambiarRegistro").click(function () {
          var data = {}, txt = "";
          data.idGrupo = $("#idGrupoCambiar").val();
          data.idSalon = $("#salonSearch").val();

          if (data.idGrupo === null||data.idGrupo=="") {
            txt += "Debe seleccionar un Clase. ";
          }

          if (data.idSalon === null||data.idSalon=="") {
            txt += "Debe seleccionar un salón. ";
          }

          if(txt==""){
            data.idHorario = $("#datosSeleccion").data().data.idHorario;
            Utilizer.getResponse('cambiarGrupoHorario', data, cambiarGrupoRespuesta, data);
          }else{
            Messager.addAlertText('Asignar Horario', 'Para continuar: '+txt, 'w');
          }
        });

        $("#borrarTodosRegistro").click(function (){
          Utilizer.sendData('borrarHorarioGrupo', {idSalonGrupo:$("#datosSeleccion").data().data.idSalonGrupo}, borrarHorario);
        });

        function asignarSalonGrupoRespuesta(data, extra){ //f("asignarSalonGrupoRespuesta");//console.log(data);
        //console.log(data);
          $("#modalNuevoRegistro").modal('hide');
          if(data.idHorario){
            Messager.addAlertText('Asignar Horario', 'Horario asignado correctamente.', 's');
            if($("#salonSearch").val()==="0"){
              changeSelectGrupoHorario();
            }else{
              Utilizer.getResponse('getHorarioSalon', {idSalon: $("#salonSearch").val()}, loadHorario);
            }
          }else{
            //console.log("EMPALME EXTRA");console.log(extra);
            Utilizer.getResponse('calcularEmpalme', extra, escribirEmpalme);
            Messager.addAlertText('Asignar Horario', 'No se puede asignar el horario ya que crearía un empalme con el horario de profesores.', 'e');
          }
        }

        function cambiarGrupoRespuesta(data, extra){ ////console.log("asignarSalonGrupoRespuesta");//console.log(data);return;
          data = data.split('|');
          $("#modalCambiarRegistro").modal('hide');
          if(data[0]=='s'){
            Utilizer.getResponse('getHorarioSalon', {idSalon: $("#salonSearch").val()}, loadHorario);
          }else{
            Utilizer.getResponse('calcularEmpalme', extra, escribirEmpalme);
          }
          Messager.addAlertText(data[1], data[2], data[0]);
        }

        function borrarHorario (){
          if(Number($("#salonSearch").val())===0){
            changeSelectGrupoHorario();
          }else{
            clearCalendar();
            $("#modalBorrarTodosRegistro").modal('hide');
            Utilizer.getResponse('getHorarioSalon', {idSalon: $("#salonSearch").val()}, loadHorario);

          }
        }

        function escribirEmpalme(data){
          console.log("EMPALME");console.log(data);

          var txt = "", keys = Object.keys(data);////console.log(data);
          for(var i = 0;i<keys.length;i++){
            //console.log(keys[i]);
            //console.log(data[keys[i]]);
            if(data[keys[i]].length>0){
              txt += "<b>"+keys[i]+"</b><br>";
              for(var j = 0;j<data[keys[i]].length;j++){
                var actual = data[keys[i]][j];
                txt += days[actual.dia]+": <i>"+actual.nombreGrupo+"</i> "+Utilizer.transFormNumberToHours(Number(actual.horaInicio))+" - "+Utilizer.transFormNumberToHours(Number(actual.horaInicio)+Number(actual.duracion))+"<br>";
              }
              txt +="<br>";
            }
          }
          //console.log(txt);
          $(".empalme").show();
          $("#textoEmpalme").html(txt);
        }


      function limpiarSalonClase(extra, data) {
          $("#modalBorrarRegistro").modal('hide');
          //console.log(data);
          tableUtilities.deleteRow('salonGrupo', {
            idSalonGrupo: Number(data.idSalonGrupo)
          });
          var t = ""
            , d;
          for (var j = 0; j < days.length; j++) {
            d = 0;
            for (var i = 0; i < 48; i++) {
              t = $("#" + j + i), d;
              if (!_.isEmpty(t.data())) {
                if (t.data('idSalonGrupo') == Number(data.idSalonGrupo)) {
                  d = Number(t.data('duracion'));
                  t.data({});
                  t.removeClass('used').removeClass('header-class').removeClass('applied-class');
                  t.css('background-color', 'white');
                  t.text("");
                }
              }
              else if (d > 0) {
                t.removeClass('used').removeClass('header-class').removeClass('applied-class');
                t.css('background-color', 'white');
                d--;
              }
            }
          }
        }

        function compareHorario (compA, compB){
              if(compA.dia==compB.horarios[i].dia&&compA.duracion==compB.horarios[i].duracion&&compA.horaInicio==compB.horarios[i].horaInicio&&compA.idSalonGrupo==compB.horarios[i].idSalonGrupo){
                return true;
              }
              return false;
        }




        function asignarHorario(extra, data) {
          //console.log(extra);
          //console.log(data);
          return;
          data.data.idHorario = extra[3];
          extra = data.extra;
          var c = {};
          c.r = data.extra.randomColor.r;
          c.g = data.extra.randomColor.g;
          c.b = data.extra.randomColor.b;
          $("#horarioContainer").find('.is-selected').addClass('header-class');
          $("#horarioContainer").find('.is-selected').data(data.data);
          $("#horarioContainer").find('.is-selected').css('background-color', Utilizer.colorRGB(c));
          $("#horarioContainer").find('.is-selected').text(data.extra.letra);
          $("#horarioContainer").find('.is-applied').css('background-color', Utilizer.colorRGB(Utilizer.colorLumin(c, 1.5)));
          $("#horarioContainer").find('.is-applied').text(data.extra.letra);
          $("#horarioContainer").find('.is-applied').addClass('applied-class');
          $("#horarioContainer").find('.is-selected').removeClass('is-selected');
          $("#horarioContainer").find('.is-applied').removeClass('is-applied');
          $("#duracion").text("30:00");
          $(".options-container").hide();
        }

        if($(window).width() < 480){
          var days = ["LUN", "MAR", "MIER", "JUE", "VIE", "SAB", "DOM"];
        }else {
          var days = ["LUNES", "MARTES", "MIÉRCOLES", "JUEVES", "VIERNES", "SÁBADO", "DOMINGO"];
        }

        paintHorario();

        $("#nuevoSalonGrupo").click(function () {
          Utilizer.loadSelect('idGrupo', 'grupoSalonSelect', 'Clase', {idSalon:$("#salonSearch").val()});
          $("#modalNuevoRegistro").modal('show');
        });

        //header
        function paintHorario() {
          var tab = $("#horarioContainer");
          tab.append("<div class='row-table header'></div>");
          var c = tab.find('.row-table:last-child');
          c.append("<div class='cell-header'>HORA</div>");
          for (var j = 0; j < days.length; j++) {
            c.append("<div class='cell-header'>" + days[j] + "</div>");
          }
          //12 = 6 am, 40 = 8 pm8
          for (var i = Utilizer.horaInicio; i <= Utilizer.horaFinal; i++) {
            //:00
            tab.append("<div class='row-table'></div>");
            c = tab.find('.row-table:last-child');
            c.append("<div class='cell horario'></div>");
            c = c.find('.horario');
            var str = '';
            //c = tab.find('.cell:last-child');
            //tab.append("<td>");
            str = Math.floor(i / 2).toString() + ":";
            str += i % 2 == 0 ? "00" : "30";
            //c.append("0");
            //c.append("</div>")
            c.html(str);
            for (var j = 0; j < days.length; j++) {
              c = tab.find('.row-table:last-child');
              c.append("<div oncontextmenu='return false;' class='cell' id = '" + j + i + "' data-i = '"+i+"' data-j = '"+j+"'></div>");
              //$("#" + j + i).click(startTogg);
              $("#" + j + i).mousedown(mouseDown);
              $("#" + j + i).mouseleave(mouseLeave);
              $("#" + j + i).mouseover(mouseOver);
              $("#" + j + i).mouseup(mouseUp);

              //$("#" + j + i).click(startTogg);
            }
            //////////////////
            //////////////////
            //////////////////
            //////////////////
            /*
              FUNCIONALIDAD DE DRAG
              Seleccionas una celda y arrastras. Primero se quitan todas las celdas selecionadas.
              Se van a seleccionar hacia arriba o hacia abajo todas las celdas por las que pase el cursor
              que estén entre la inicial y la final con una excepcion:
              Si ya hay horario en alguna celda no se saltará ningún espacio. La primer celda se considerará
              la celda inicial y será marcada como tal.

              Todas las celdas seleccioadas tendrán la clase: selected, la inicial tendrá la clase: selected-header

              OPCIONES
              [is-selected]
                  1. (Asignar grupo a celdas seleccionadas): Sale un modal con los datos de la seleccion, se selecciona el grupo que se desea asignar.
                  Se hace la query correspondiente, se le asigna la siguiente letra y un color.
                  Se le pone la clase [used]
              [used]
                  1. (Copiar): Se "copia" el grupo y duración para poder pegarse en otro lado. Se podría agregar una clase de [copied]
                  2. (Replicar): De alguna forma que se seleccione que días se quiere replicar este horario. Se siguen las mismas reglas que "pegar".
                  3. (Cambiar grupo): Sale un modal con los grupos, se selecciona el grupo que se desea asignar y se hacen los cambios correspondientes.
                  Si el grupo no existía anteriormente se le asigna una letra y color.
                  4. (Borrar): Se borra el grupo asignado.
                  5. (Borrar todos [nombre grupo]): Se borran todas las instancias de este grupo con este salon?
              []
                1. (Pegar): Se "pega" el grupo en cualquier lugar de la tabla. No se aceptan colisiones. Podríamos checar desde la misma celda si
                ese grupo cabe. Si no entonces esta opción podría salir como "No se puede pegar"
            */


            var menu = new BootstrapMenu('.cell', {
              /* Esto es lo que se va a pasar como parametro a todas las demás funciones */
              //CHECKPOINT 4
              fetchElementData: function(clickedElement) {
                var data = {};
                data.isSelected = $(clickedElement).hasClass('is-selected');
                data.numberSelected = $(".is-selected").length;
                data.isAssigned = $(clickedElement).hasClass('used');
                data.gray = $(clickedElement).hasClass('gray');
                data.porSalon = $("#salonSearch").val()!=="0";
                data.data = $(clickedElement).data();
                data.header = {j:data.data.j, i:data.data.i};
                if(data.isSelected){
                  while($("#"+data.header.j+data.header.i).hasClass('is-selected')){
                    data.header.i--;
                  }
                  data.header.duracion = $(".is-selected").length;
                }else if(data.isAssigned){
                  while(!$("#"+data.header.j+data.header.i).hasClass('used-header')){
                    data.header.i--;
                  }
                }
                data.data = $("#"+data.header.j+data.header.i).data();
                $("#datosSeleccion").data('header', data.header);
                $("#datosSeleccion").data('data', data.data);
                return data;
              },

              actions: {
                asignarGrupo: {
                  name: function (row){
                    //console.log(row);
                    if(row.porSalon){
                      return 'Asignar Clase';
                    }else{
                      return 'Asignar Horario';
                    }
                  },
                  iconClass: 'fa-plus-square',
                  onClick: function(row) {
                    if(row.porSalon){
                        //Sacar modal para asignar un grupo
                        Utilizer.loadSelect('idGrupo', 'grupoSelect', 'Clase');
                        $("#modalNuevoRegistro").modal('show');
                    }else{
                        var data = {}, txt = "";
                        data.idGrupo = $("#selectGrupoHorario").val();
                        data.idSalon = 0;
                        data.dia =             Number($("#datosSeleccion").data('header').j),
                        data.duracion =        Number($("#datosSeleccion").data('header').duracion),
                        data.horaInicio =      Number($("#datosSeleccion").data('header').i+1)
                        Utilizer.getResponse('getOrAddSalonGrupoHorario', data, asignarSalonGrupoRespuesta, data);
                    }
                  },
                  isShown: function(row) {
                    return row.isSelected;
                  }

                },

                copiarHorario: {
                  name: 'Copiar Horario',
                  iconClass: 'fa-clipboard',
                  onClick: function(row) {
                    //Guardar datos de horario en una variable
                    resetCopy();
                    copyMemory = row.data;
                    for(var i = row.data.i;i<row.data.i+Number(copyMemory.duracion);i++){
                        $("#"+row.data.j+i).addClass('copied');
                        if(i==row.data.i+Number(copyMemory.duracion-1)){
                          $("#"+row.data.j+i).addClass('last-copied');
                        }
                    }
                    var tableData = tableUtilities.getRowData('salonGrupo', {idSalonGrupo:Number(copyMemory.idSalonGrupo)});
                    $("#opcionPegar").show();
                    Messager.addAlertText('Copiar Horario',
                     'Horario ['+tableData.nombreGrupo+"] con duración ["+Utilizer.transFormNumberToHours(copyMemory.duracion)+"] copiado en memoria.", 'i');////console.log("ROW");//console.log(row);//console.log("COPY MEMORY");//console.log(copyMemory);//console.log("TABLE DATA");//console.log(tableData);
                  },
                  isShown: function(row) {
                    return row.isAssigned&&!row.gray;
                  }
                },

                replicarHorario: {
                  name: 'Replicar Horario',
                  iconClass: 'fa-files-o',
                  onClick: function(row) {
                      //Sacar modal con seleccion de días validos para replicar el horario
                  },
                  isShown: function(row) {
                    //return row.isAssigned;
                    return false;
                  }
                },

                cambiarHorario: {
                  name: 'Cambiar Clase',
                  iconClass: 'fa-retweet',
                  onClick: function(row) {
                      //Sacar modal para seleccionar el grupo al que cambiar el horario   ////console.log("CAMBIAR GRUPO");//console.log(row);
                      var temp = tableUtilities.getRowData('salonGrupo', {idSalonGrupo:Number(row.data.idSalonGrupo)});
                      Utilizer.setPicker('idGrupoCambiar', temp.idGrupo);
                      $("#modalCambiarRegistro").modal('show');
                  },
                  isShown: function(row) {
                    return row.isAssigned&&!row.gray&&row.porSalon;
                  }
                },
                borrarHorario: {
                  name: 'Borrar Horario',
                  iconClass: 'fa-eraser',
                  onClick: function(row) {
                    Utilizer.sendData('borrarHorario', {idHorario:row.data.idHorario}, borrarHorario);
                  },
                  isShown: function(row) {
                    return row.isAssigned&&!row.gray;
                  }
                },
                borrarTodosHorario: {
                  name: 'Borrar Todos los horarios de esta clase',
                  iconClass: 'fa-trash',
                  onClick: function(row) {
                    //Sacar modal de confirmacion
                    $("#modalBorrarTodosRegistro").modal('show');
                  },
                  isShown: function(row) {
                    return row.isAssigned&&!row.gray&&row.porSalon;
                  }
                },
                pegarHorario: {
                  name: function (row){
                    var name = false;
                    for(var i = row.data.i;i<row.data.i+Number(copyMemory.duracion);i++){
                      if($("#"+row.data.j+i).hasClass('used')){
                        return "Espacio insuficiente con duración "+Utilizer.transFormNumberToHours(copyMemory.duracion)+".";
                      }
                      if(!$("#"+row.data.j+i).hasClass('cell')){
                        return "Espacio insuficiente con duración "+Utilizer.transFormNumberToHours(copyMemory.duracion)+".";
                      }
                    }
                    return "Pegar horario";
                  },
                  iconClass: 'fa-clipboard',
                  onClick: function(row) {
                    var data = {};
                    data.horaInicio = row.data.i;
                    data.dia = row.data.j;
                    data.duracion = copyMemory.duracion;
                    data.idSalonGrupo = copyMemory.idSalonGrupo;
                    Utilizer.getResponse('pegarHorario', data, cambiarGrupoRespuesta, data);
                  },
                  isEnabled: function(row) {
                    for(var i = row.data.i;i<row.data.i+Number(copyMemory.duracion);i++){
                      if($("#"+row.data.j+i).hasClass('used')){
                        return false;
                      }
                      if(!$("#"+row.data.j+i).hasClass('cell')){
                        return false
                      }
                    }
                    return true;
                  },
                  isShown: function(row) {
                    console.log(row);
                    if(row.numberSelected<=1){
                      //row.isSelected = false;
                    }
                    return !row.isSelected&&!row.isAssigned&&!jQuery.isEmptyObject(copyMemory);
                  }
                },
                quitarSeleccion: {
                  name: 'Quitar selección',
                  iconClass: 'fa-minus-square',
                  onClick: function(row) {
                     $(".is-selected").removeClass('is-selected');                  //Sacar modal con seleccion de días validos para replicar el horario
                  },
                  isShown: function(row) {
                    return row.isSelected;
                  }
                },
              }
            });
          }
        }

        var isClicking = false, initialCell = false, finalCell = false, copyMemory = {};

        function assignCellPath(){  ////console.log("Initial cell");  //console.log(initialCell); //console.log($(initialCell).data()); //console.log("Final cell"); //console.log(finalCell);  //console.log($(finalCell).data());
          $(".is-selected").removeClass('is-selected');
          var start = $(initialCell).data('i'); end = $(finalCell).data('i'), startsTop = true;
          if($(initialCell).data('i')>$(finalCell).data('i')){
            start = $(finalCell).data('i'); end = $(initialCell).data('i'); startsTop = false; ////console.log(start); //console.log(end);
          }

          for(i = start;i<=end;i++){  //Sonda para saber donde empieza y termina en caso de que haya horarios enmedio
            if($("#"+$(initialCell).data('j')+i).hasClass('used')&&startsTop){
              end = i-1;
              break;
            }else if($("#"+$(initialCell).data('j')+i).hasClass('used')&&!startsTop){
              start = i+1;
            }
          }

          for(i = start;i<=end;i++){  ////console.log("#"+i+$(initialCell).data('j'));
            if(i==start){
              $("#"+$(initialCell).data('j')+i).addClass('is-selected-header');
            }
            $("#"+$(initialCell).data('j')+i).addClass('is-selected');
          }
        }

        function mouseDown(){ ////console.log("Mouse Down");  //console.log(this);
          if(!isClicking&&Utilizer.detectLeftButton(event)){ ////console.log("Mouse started clicking");//console.log(this);
            if($(this).hasClass('is-selected')&&$(".is-selected").length==1){
              //var e = e || window.event;  Utilizer.pauseEvent(e);
              //return;
            }else if(!$(this).hasClass('is-selected')&&$(".is-selected").length==1&&event.shiftKey){
              finalCell = this;
              assignCellPath();
              var e = e || window.event;  Utilizer.pauseEvent(e);
              return;
            }
            $(this).removeClass('is-selected');
            $(".is-selected").removeClass('is-selected');
            $(this).addClass('is-selected');
            isClicking = true;
            initialCell = this;
            finalCell = this;
          }else{
            if(!$(this).hasClass('is-selected')){
              isClicking = false;
              initialCell = false;
              finalCell = false;
              $(".is-selected").removeClass('is-selected');
            }
          }
          var e = e || window.event;  Utilizer.pauseEvent(e);
        }

        function mouseFinish(){
          if(isClicking){ ////console.log("The mouse stopped clicking somewhere");
            assignCellPath();
            if(initialCell!=finalCell){
              initialCell = false;  finalCell = false;
            }
            isClicking = false;
          }
        }

        function mouseLeave(){  ////console.log("Mouse Leave");//console.log(this);
          if(isClicking){ ////console.log("The mouse left this while it was being pressed");//console.log(this);
          }
          var e = e || window.event;  Utilizer.pauseEvent(e);
        }

        function mouseOver(){   ////console.log("Mouse Over");//console.log(this);
          if(isClicking){ ////console.log("The mouse entered this while it was being pressed");//console.log(this);
            finalCell = this;
            assignCellPath();
          }
          var e = e || window.event;  Utilizer.pauseEvent(e);
        }

        function mouseUp(){   ////console.log("Mouse Up"); //console.log(this);
          /*
            //console.log($(this).hasClass('is-selected'));//console.log($(".is-selected").length);
            if($(this).hasClass('is-selected')&&$(".is-selected").length==1){
              $(this).removeClass('is-selected');
              var e = e || window.event;  Utilizer.pauseEvent(e);
              isClicking = false;
              initialCell = false;
              finalCell = false;
              return;
            }
            */
          mouseFinish();
          var e = e || window.event;  Utilizer.pauseEvent(e);
        }

        $("body").mouseup(mouseFinish);
      });
    </script>
