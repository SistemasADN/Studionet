<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-user-o"></i> </div>
    <div class="text-container">VER HORARIO PROFESOR</div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 filter-container">
    <?php if($_SESSION['tipoUsuario']!="Profesor"): ?>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <legend class="custom-legend"><abbr title = 'Al elegir un profesor se desplegarán en su pantalla los espacios durante los cuáles estará activo dicho profesor.'>Elije un profesor</abbr></legend>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 input-container">
        <label class="col-xs-3 col-sm-3 col-md-4 label-text">PROFESOR: </label>
        <select id="profesorSearch" data-live-search="true" class="selectpicker col-xs-9 col-sm-9 col-md-8"></select>
      </div>
    <?php else: ?>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <legend class="custom-legend">Elije una sede.</legend>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 input-container">
        <label class="col-xs-3 col-sm-3 col-md-4 label-text">SEDE: </label>
        <select id="sedeSearch" data-live-search="true" class="selectpicker col-xs-9 col-sm-9 col-md-8"></select>
      </div>
    <?php endif; ?>
      <!-- TABLA -->
      <div class="col-xs-12 col-sm-12 col-md-12">
        <legend class="custom-legend">Lista de Grupos.</legend>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
        <table class="table table-hover table-responsive" id="salonGrupo">
          <thead>
            <tr class="table-header">
              <th class="table-column-title">GRUPO</th>
              <th class="table-column-title">PROFESOR (CLASE - NIVEL)</th>
			        <th class="table-column-title">SALÓN</th>
              <th class="table-column-title">COLOR</th>
            </tr>
          </thead>
          <tfoot>
            <tr class="table-header">
              <th class="table-column-title">GRUPO</th>
              <th class="table-column-title">PROFESOR (CLASE - NIVEL)</th>
			        <th class="table-column-title">SALÓN</th>
              <th class="table-column-title">COLOR</th>
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
        //Csser.collapse(5);
        tableUtilities.createTable('salonGrupo', ['nombreGrupo', 'detallesGrupo', 'nombreSalon', 'color']);
        Utilizer.loadSelect('profesorSearch', 'profesorSelect', 'profesor');
        Utilizer.loadSelect('sedeSearch', 'profesorSedeSelect', 'Sede');

        $("#profesorSearch,#sedeSearch").change(function () {
          $("#horarioContainer").find('.header-class').text('');
          $("#horarioContainer").find('.header-class').removeClass('header-class');
          $("#horarioContainer").find('.applied-class').removeClass('applied-class');
          Utilizer.loadSelect('idGrupo', 'grupoSelect', 'Clase');
    		  tableUtilities.clearTable('salonGrupo');
		      var t = "", d;
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
          if($("#profesorSearch").val()!==undefined){
            Utilizer.getResponse('getHorarioProfesor', {
              idProfesor: $("#profesorSearch").val()
            }, loadHorario);
          }else{
            Utilizer.getResponse('getHorarioProfesor', {
              idSede: $("#sedeSearch").val()
            }, loadHorario);
          }
        });

        function loadHorario(data) {
          //console.log("LOAD HORARIO");console.log(data);
          $("#horarioContainer").find('.is-selected').text("");
          $("#horarioContainer").find('.is-selected').removeClass('is-selected');
          $("#horarioContainer").find('.is-applied').removeClass('is-applied');
          $(".options-container").hide();
          var i, actual, extra, chr;

          for (i = 0; i < data.length; i++) {
			      chr = Utilizer.makeLetter(i);
            actual = data[i];
            actual.randomColor = Utilizer.randomColor(i, 100, 150);
			      actual.letra = chr;
            if(actual.nombreSalon==null){
              actual.nombreSalon = "Sin Salón ("+actual.nombreSede+")";
            }
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
			        $("#" + extra[j].dia + "" + extra[j].horaInicio).text(actual.nombreGrupo);

              var l = Utilizer.colorLumin(c, 1.5);
              extra[j].duracion = Number(extra[j].duracion);
              for (k = 1; k < Number(extra[j].duracion); k++) {
                $("#" + extra[j].dia + "" + (Number(extra[j].horaInicio) + Number(k))).addClass('used');
                $("#" + extra[j].dia + "" + (Number(extra[j].horaInicio) + Number(k))).css('background-color', Utilizer.colorRGB(l));
				        $("#" + extra[j].dia + "" + (Number(extra[j].horaInicio) + Number(k))).text(actual.nombreGrupo);
              }
            }
            delete actual.horarios;
          }
          tableUtilities.draw('salonGrupo');
        }

        if($(window).width() < 480){
          var days = ["LUN", "MAR", "MIER", "JUE", "VIE", "SAB", "DOM"];
        }else {
          var days = ["LUNES", "MARTES", "MIÉRCOLES", "JUEVES", "VIERNES", "SÁBADO", "DOMINGO"];
        }
        paintHorario();

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
              c.append("<div class='cell' id = '" + j + i + "'></div>");
              //$("#" + j + i).click(togg);
            }
            //tab.append("</div>");
          }
        }
      });
    </script>
