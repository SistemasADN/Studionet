<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-clipboard"></i> </div>
    <div class="text-container"> REPORTE DE CLASES </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-6 col-md-6 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="text-container-subtitle"> SELECCIONE UN RANGO DE FECHAS </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 input-container date-container">
          <label class='label-fecha'>FECHA INICIAL</label>
          <div class="input-group form-input date" id="fechaInicial"> <span class="input-group-addon">
              <i class="glyphicon glyphicon-calendar"></i>
          </span>
            <input type="text" class="form-control date-input" id="fechaInicialText"> </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 input-container date-container">
          <label class='label-fecha'>FECHA FINAL</label>
          <div class="input-group form-input date" id="fechaFinal"> <span class="input-group-addon">
              <i class="glyphicon glyphicon-calendar"></i>
          </span>
            <input type="text" class="form-control date-input" id="fechaFinalText"> </div>
        </div>
      </fieldset>
    </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-10 col-md-10 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="text-container-subtitle"> UTILIDAD ESPERADA POR CLASE </div>
        </div>
        <div class="row">
          <div style="margin-bottom:10px;" class="totalBox"><table><tbody>
                <tr><td class="col-xs-8 col-sm-6 col-md-4"><label style="margin-bottom:0px;">TOTAL FILTRADO:</label></td>
                  <td class="totalFiltrado" class="col-xs-2 col-sm-6 col-md-8"></td></tr></tbody></table>
          </div>
          <table class = "table-consulta-info" id="verFinanzas">
            <thead>
              <tr class="table-header">
                <th class="table-cantidad">GRUPO</th>
                <th class="table-cantidad">TOTAL COBRAR</th>
                <th class="table-cantidad">COSTO PROFESORES</th>
                <th class="table-cantidad">TOTAL COSTO</th>
                <th class="table-cantidad">UTILIDAD</th>
                <th class="table-cantidad">PORCENTAJE</th>
              </tr>
            </thead>
            <tfoot>
              <tr class="table-header">
                <th class="table-cantidad">GRUPO</th>
                <th class="table-cantidad">TOTAL COBRAR</th>
                <th class="table-cantidad">COSTO PROFESORES</th>
                <th class="table-cantidad">TOTAL COSTO</th>
                <th class="table-cantidad">UTILIDAD</th>
                <th class="table-cantidad">PORCENTAJE</th>
              </tr>
            </tfoot>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    <!-- End Third Row -->
    </fieldset>
  </div>




  <?php include 'templates/bottom.php'; ?>
  <script>
  $(document).ready(function () {
  	tableUtilities.createTable('verFinanzas', ['nombreGrupo', 'totalCobrar', 'profesoresLista', 'totalEgresos', 'totalUtilidad', 'porcentaje']);

  	var firstDate = Utilizer.getFirstDateMonth();
  	var lastDate = Utilizer.getLastDateMonth();

  	Utilizer.makeDatepicker('fechaInicial', firstDate);
  	Utilizer.makeDatepicker('fechaFinal', lastDate);

  	getTableDataHistoria();

  	$('#fechaInicial').on('change', getTableDataHistoria);
  	$('#fechaFinal').on('change', getTableDataHistoria);

  	var totales = {'totalCobrar':{}, 'totalEgresos':{}};
  });

  	function getTableDataHistoria(){
  		var data = {}
  		data.fechaInicial = Utilizer.fechaParseToDbDate($('#fechaInicialText').val());
  		data.fechaFinal = Utilizer.fechaParseToDbDate($('#fechaFinalText').val());
  		Utilizer.getResponse('reporteUtilidadesGrupo', data, loadTableHistoria);
  	}

  	function loadTableHistoria(data){
      var actual, profe;
      console.log(data);
      tableUtilities.clearTable('verFinanzas');
      for(var i = 0;i<data.length;i++){
        actual = data[i];
        actual.profesoresLista = "";
        actual.totalEgresos = 0;
        //actual.totalCobrar = 2000;
        for(var j = 0;j<actual['profesores'].length;j++){
          profe = actual['profesores'][j];

          profe.horas = Math.floor(profe.totalHoras/ 2).toString() + ":";
          profe.horas += profe.totalHoras % 2 == 0 ? "00" : "30";
          actual.profesoresLista += profe.nombreProfesor+"("+profe.horas+") ("+Utilizer.numberToCoin(profe.costoGrupo)+")<br>";
          actual.totalEgresos += profe.costoGrupo;
        }
        actual.pintar = true;
        actual.totalUtilidad = Number(actual.totalCobrar)-Number(actual.totalEgresos);
        if(actual.totalUtilidad<=0){
          actual.porcentajeUtilidad = 0;
          actual.porcentajeEgresos = 100;
        }else if(actual.totalEgresos<=0){
          actual.porcentajeUtilidad = 100;
          actual.porcentajeEgresos = 0;
        }
        if(actual.totalCobrar>0){
          actual.porcentajeUtilidad = Number(100*actual.totalUtilidad/actual.totalCobrar).toFixed(1);
          actual.porcentajeEgresos = Number(100*actual.totalEgresos/actual.totalCobrar).toFixed(1);
        }else{
          actual.porcentajeUtilidad = 0;
          actual.porcentajeEgresos = 0;
          actual.pintar = false;
        }
        actual.porcentaje = "Utilidad "+actual.porcentajeUtilidad+"%<br>Costo "+actual.porcentajeEgresos+"%<br>";
        actual.porcentaje = "";
        actual.porcentaje += "<div class = 'barCanvas'><canvas id = 'barrPor"+actual.idGrupo+"'></canvas></div>";
        tableUtilities.addRow('verFinanzas', actual);
      }
      tableUtilities.draw('verFinanzas');
      var colors = [];
      colors.push("#228B22");
      colors.push("#F2003C");
      console.log(colors);
      for(var i = 0;i<data.length;i++){
        actual = data[i];
        if(!actual.pintar){
          $("#barrPor"+actual.idGrupo).parent().remove();
          continue;
        }

        Chartizer.pie(
                     "barrPor"+actual.idGrupo,
                      ["Utilidad", "Costo"],
                      "["+actual.nombreGrupo+"]",
                      "%",
                      colors,
                      [actual.porcentajeUtilidad, actual.porcentajeEgresos]);


      }

  	}
  </script>
  <style>
    .barCanvas{
      width:200px;
      height:200px;
    }
  </style>
