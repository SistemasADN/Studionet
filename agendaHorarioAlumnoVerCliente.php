<?php include 'templates/topCliente.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-users"></i> </div>
    <div class="text-container"> VER HORARIO ALUMNO </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 filter-container">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <legend class="custom-legend">Elije un alumno.</legend>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 input-container">
        <label class="col-xs-3 col-sm-3 col-md-4 label-text">ALUMNO: </label>
        <select id="alumnoSearch" data-live-search="true" class="selectpicker col-xs-9 col-sm-9 col-md-8"></select>
      </div>
      <!-- TABLA -->
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
        <table class="table table-hover table-responsive" id="salonGrupo">
          <thead>
            <tr class="table-header">
              <th class="table-column-title">CLASE</th>
			  <th class="table-column-title">SALON</th>
              <th class="table-column-title">COLOR</th>
			  <th class="table-column-title">LETRA</th>
            </tr>
          </thead>
          <tfoot>
            <tr class="table-header">
              <th class="table-column-title">CLASE</th>
			  <th class="table-column-title">SALON</th>
              <th class="table-column-title">COLOR</th>
			  <th class="table-column-title">LETRA</th>
            </tr>
          </tfoot>
          <tbody> </tbody>
        </table>
      </div>
      <!-- TABLA -->
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 special-table-container">
      <div id="horarioContainer" class="specialTable"> </div>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(2);
        tableUtilities.createTable('salonGrupo', ['nombreGrupo', 'nombreSalon', 'color', 'letra']);
        Utilizer.loadSelect('alumnoSearch', 'alumnoSelectCliente', 'Alumno');
        Utilizer.loadSelect('idGrupo', 'grupoSelect', 'Grupo');
        $("#alumnoSearch").change(function () {
          $("#horarioContainer").find('.header-class').text('');
          $("#horarioContainer").find('.header-class').removeClass('header-class');
          $("#horarioContainer").find('.applied-class').removeClass('applied-class');
		  tableUtilities.clearTable('salonGrupo');
		  var t = ""
            , d;
          for (var j = 0; j < days.length; j++) {
            d = 0;
            for (var i = 0; i < 48; i++) {
              t = $("#" + j + i), d;
              if (!_.isEmpty(t.data())) {
                  d = Number(t.data('duracion'));
                  t.data({});
				  t.text("");
                  t.removeClass('used').removeClass('header-class').removeClass('applied-class');
                  t.css('background-color', 'white');
              }
              else if (d > 0) {
				t.text("");
                t.removeClass('used').removeClass('header-class').removeClass('applied-class');
                t.css('background-color', 'white');
                d--;
              }
            }
          }

          Utilizer.getResponse('getHorarioAlumno', {
            idAlumno: $("#alumnoSearch").val()
          }, loadHorario);
        });

        function loadHorario(data) {
			console.log(data);
          $("#horarioContainer").find('.is-selected').text("");
          $("#horarioContainer").find('.is-selected').removeClass('is-selected');
          $("#horarioContainer").find('.is-applied').removeClass('is-applied');
          $(".options-container").hide();
          var i, actual, extra, chr;

          for (i = 0; i < data.length; i++) {
			      chr = Utilizer.makeLetter(i);
            actual = data[i];
            actual.randomColor = Utilizer.randomColor(100, 150);
			actual.letra = chr;
            actual.color = "<div style = 'background-color: " + Utilizer.colorRGB(actual.randomColor) + ";width:100%;height:34px'></div>";
            tableUtilities.addRow('salonGrupo', actual);
            extra = actual.horarios;
            for (j = 0; j < extra.length; j++) {
              var c = {};
              c.r = actual.randomColor.r;
              c.g = actual.randomColor.g;
              c.b = actual.randomColor.b;
              extra[j].idSalonGrupo = actual.idSalonGrupo;
              $("#" + extra[j].dia + "" + extra[j].horaInicio).addClass('used');
              $("#" + extra[j].dia + "" + extra[j].horaInicio).addClass('used-header');
              $("#" + extra[j].dia + "" + extra[j].horaInicio).data(extra[j]);
              $("#" + extra[j].dia + "" + extra[j].horaInicio).css('background-color', Utilizer.colorRGB(c));
			  $("#" + extra[j].dia + "" + extra[j].horaInicio).text(actual.letra);

              var l = Utilizer.colorLumin(c, 0.5);
              extra[j].duracion = Number(extra[j].duracion);
              for (k = 1; k < Number(extra[j].duracion); k++) {
                $("#" + extra[j].dia + "" + (Number(extra[j].horaInicio) + Number(k))).addClass('used');
                $("#" + extra[j].dia + "" + (Number(extra[j].horaInicio) + Number(k))).css('background-color', Utilizer.colorRGB(l));
				$("#" + extra[j].dia + "" + (Number(extra[j].horaInicio) + Number(k))).text(chr);
              }
            }
            delete actual.horarios;
          }
          tableUtilities.draw('salonGrupo');
        }
        $(".tiempo").click(function () {
          var timeDif = $(this).data('time');
          console.log(timeDif);
          var min = 30;
          var sel = $("#horarioContainer").find(".is-selected");
          var id = $(sel).attr('id');
          var num = id.slice(1);
          var time = $("#horarioContainer").find('.is-applied').length + 1 + timeDif;
          if (time == 0) {
            time = 1;
          }
          $("#horarioContainer").find('.is-applied').removeClass('is-applied');
          for (var i = num; i < Number(num) + Number(time); i++) {
            //console.log("I: "+i);
            //console.log("#"+id[0]+""+i);
            if (i != num) {
              if ($("#" + id[0] + "" + i).hasClass('header-class') || $("#" + id[0] + "" + i).hasClass('used')) {
                time--;
                break;
              }
              $("#" + id[0] + "" + i).addClass('is-applied');
            }
          }
          $("#duracion").text(Number(min * time) + ":00");
          /**/
        });

        function preAsignarHorario() {
          var d = tableUtilities.getDataFromEvent(event);

          var data = {}
            , id = $("#horarioContainer").find(".is-selected").attr('id');
		  if(id===undefined){
			  Messager.addAlertText("Asignar grupo", "Elija una hora", 'w');
			  return;
		  }
		  data.dia = id[0];
          data.horaInicio = id.slice(1);
          data.duracion = $("#horarioContainer").find('.is-applied').length + 1;
          data.idSalonGrupo = d.idSalonGrupo;
		        //console.log(data);
          Utilizer.sendData('asignarHorario', data, asignarHorario, {
            data: data
            , extra: d
          });
        }

        $("#nuevoRegistro").click(function () {
          var data = {}, txt = "";
          data.idGrupo = $("#idGrupo").val();
          data.idSalon = $("#salonSearch").val();

          if (data.idGrupo === null) {
            txt += "Debe seleccionar un grupo. ";
          }

          if (data.idSalon === null) {
            txt += "Debe seleccionar un salón. ";
          }

          if (tableUtilities.isInTable('salonGrupo', {
              idGrupo: Number(data.idGrupo)
            })) {
            txt += "Seleccione otro grupo, ya que ese grupo ya está asignado a este salón. ";
          }

          if (txt == "") {
            Utilizer.getResponse('asignarSalonClase', data, nuevoSalonClase, data);
          }
          else {
            Messager.addAlertText('Crear Registro', "Para continuar: " + txt, 'w');
          }
        });

        function nuevoSalonClase(data, extra) {
		  console.log("Nuevo Salon Clase");
          data.randomColor = Utilizer.randomColor(75, 150);
		  console.log(data);
		  console.log(extra);
		  var sel = Utilizer.getOptionByValue('idGrupo', extra.idGrupo);
		  data.precio = sel.data('precio');
		  data.nombreGrupo = sel.text()+" - "+sel.data('subtext');
          data.color = "<div style = 'background-color: " + Utilizer.colorRGB(data.randomColor) + ";width:100%;height:34px'>&nbsp</div>";
		  console.log("YES");
          console.log("Row Data");
          console.log(data);
          tableUtilities.addRowDraw('salonGrupo', data, [['Asignar', 'btn-select', preAsignarHorario], ['Borrar', 'btn-danger', borrarSalonClase]]);
          $("#modalNuevoRegistro").modal('hide');
          Utilizer.setPicker('idGrupo', '');
        }

        function borrarSalonClase() {
          var data = tableUtilities.getDataFromEvent(event);
          $("#borraridSalonGrupo").val(data.idSalonGrupo);
          $("#modalBorrarRegistro").modal('show');
        }

        $("#borrarRegistro").click(function () {
          Utilizer.sendData('borrarSalonClase', {
            idSalonGrupo: $("#borraridSalonGrupo").val()
          }, limpiarSalonClase, {
            idSalonGrupo: $("#borraridSalonGrupo").val()
          });
        });

        function limpiarSalonClase(data) {
          $("#modalBorrarRegistro").modal('hide');
          console.log(data);
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

        function asignarHorario(data, extra) {
          var c = {};
          c.r = data.extra.randomColor.r;
          c.g = data.extra.randomColor.g;
          c.b = data.extra.randomColor.b;
          $("#horarioContainer").find('.is-selected').addClass('header-class');
          $("#horarioContainer").find('.is-selected').data(data.data);
          $("#horarioContainer").find('.is-selected').css('background-color', Utilizer.colorRGB(c));
          $("#horarioContainer").find('.is-applied').css('background-color', Utilizer.colorRGB(Utilizer.colorLumin(c, 0.2)));
          $("#horarioContainer").find('.is-applied').addClass('applied-class');
          $("#horarioContainer").find('.is-selected').removeClass('is-selected');
          $("#horarioContainer").find('.is-applied').removeClass('is-applied');
          $("#duracion").text("30:00");
          $(".options-container").hide();
        }

        if($(window).width() < 480){
          var days = ["LUN", "MAR", "MIER", "JUE", "VIE", "SAB", "DOM"];
        }else {
          var days = ["LUNES", "MARTES", "MIERCOLES", "JUEVES", "VIERNES", "SABADO", "DOMINGO"];
        }
        paintHorario();
        $("#nuevoSalonGrupo").click(function () {
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
          for (var i = 12; i <= 40; i++) {
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
              c.append("<div class='cell' id = '" + j + i + "'></div>");
              //$("#" + j + i).click(togg);
            }
            //tab.append("</div>");
          }
        }

        function togg() {
          $("#horarioContainer").find('.is-selected').text("");
          $("#horarioContainer").find('.is-selected').removeClass('is-selected');
          $("#horarioContainer").find('.is-applied').removeClass('is-applied');
          if ($(this).hasClass('header-class') || $(this).hasClass('applied-class') || $(this).hasClass('used')) {
            var id = $(this).attr('id')
              , day = ""
              , start = "";
            day = id[0];
            start = id.slice(1);
            while (_.isEmpty($("#" + day + "" + start).data())) {
              start--;
            }
            console.log($("#" + day + "" + start).data());
            $("#" + day + "" + start).addClass('is-selected');
            id = start;
            hora = Math.floor(id / 2);
            minutos = id % 2 == 0 ? "0" : "3";
            tiempo = hora + ":" + minutos + "0";
            $("#seleccionBorrar").val(days[day] + ", " + tiempo + ", " + Number($("#" + day + "" + start).data('duracion') * 30) + ":00");
            $(".options-container").hide();
            $("#borrarContainer").show();
            //seleccionBorrar
            return;
          }
          var data = {};
          data.id = $(this).attr('id'), data.day = data.id[0]
          data.id = data.id.slice(1);
          data.hora = Math.floor(data.id / 2);
          data.minutos = data.id % 2 == 0 ? "0" : "3";
          data.tiempo = data.hora + ":" + data.minutos + "0";
          $(this).addClass('is-selected');
          $("#seleccion").val(days[data.day] + ", " + data.tiempo);
          $(".options-container").show();
          $("#borrarContainer").hide();
        }
        $("#borrarSeleccionado").click(function () {
          Utilizer.sendData('borrarHorario', {
            idHorario: $("#horarioContainer").find('.is-selected').data('idHorario')
          }, finBorrarHorario, $("#horarioContainer").find('.is-selected').data());
        });

        function finBorrarHorario(data) {
          $("#borrarContainer").hide();
          t = $("#" + data.dia + "" + data.horaInicio);
          d = Number(t.data('duracion'));
          t.data({});
          t.removeClass('used').removeClass('header-class').removeClass('applied-class').removeClass('is-selected');
          t.css('background-color', 'white');
          for (var i = data.horaInicio + 1; i < data.horaInicio + d; i++) {
            t = $("#" + data.dia + "" + i);
            t.removeClass('used').removeClass('header-class').removeClass('applied-class');
            t.css('background-color', 'white');
          }
        }
      });
    </script>
