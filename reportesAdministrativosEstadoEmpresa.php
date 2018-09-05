<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-bar-chart"></i> </div>
    <div class="text-container"> ESTADO DE CUENTA EMPRESA </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <select class="selectpicker form-input" data-live-search="true"
          required data-label="Mes" id="yearSelect" name='Mes'>
            <option  value="none">Elija el año</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
            <option value="2027">2027</option>
            <option value="2028">2028</option>
            <option value="20219">2029</option>
          </select>
          <select class="selectpicker form-input" data-live-search="true"
          required data-label="Mes" id="mesSelect" name='Mes'>
            <option value="none">Elija el mes</option>
            <option value="01">Enero</option>
            <option value="02">Febrero</option>
            <option value="03">Marzo</option>
            <option value="04">Abril</option>
            <option value="05">Mayo</option>
            <option value="06">Junio</option>1
            <option value="07">Julio</option>
            <option value="08">Agosto</option>
            <option value="09">Septiembre</option>
            <option value="10">Octumbre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
          </select>
        </div>
      </fieldset>
    </div>
  </div>


  <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="jumbotron jumbotron-container">
      <div class="jumbotron-text"> ESTADO DE CUENTA MENSUAL</div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="input-disabled-container">
      <div class="col-xs-12 col-sm-12 col-md-12 input-container">
        <label class='label-right col-xs-4 col-sm-4 col-md-4'>INGRESOS: </label>
        <input type="text" class="information-display col-xs-8 col-sm-8 col-md-8" id="totalIngresos" disabled value = "$0.00"/>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 input-container">
        <label class='label-right col-xs-4 col-sm-4 col-md-4'>EGRESOS: </label>
        <input type="text" class="col-xs-8 col-sm-8 col-md-8 information-display" id="totalEgresos" disabled value = "$0.00"/>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 input-container">
        <label class='label-right col-xs-4 col-sm-4 col-md-4'>BALANCE: </label>
        <input type="text" class="col-xs-8 col-sm-8 col-md-8 information-display" id="balance" disabled value = "$0.00"/>
      </div>
    </div>
  </div>


  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="text-container-subtitle"> EGRESOS </div>
    </div>
    <table class="table table-hover table-responsive" id="egresosVer">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">CONCEPTO</th>
          <th class="table-column-title">FORMA DE PAGO</th>
          <th class="table-column-title">CANTIDAD</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">CONCEPTO</th>
          <th class="table-column-title">FORMA DE PAGO</th>
          <th class="table-column-title">CANTIDAD</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="text-container-subtitle"> INGRESOS </div>
    </div>
    <table class="table table-hover table-responsive" id="ingresosVer">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">CONCEPTO</th>
          <th class="table-column-title">FORMA DE PAGO</th>
          <th class="table-column-title">CANTIDAD</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">CONCEPTO</th>
          <th class="table-column-title">FORMA DE PAGO</th>
          <th class="table-column-title">CANTIDAD</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>

  <?php include 'templates/bottom.php'; ?>
    <script>

      $(document).ready(function () {
        var year;
        var mes;
        var days;
        var firstDate;
        var lastDate;
        //Csser.collapse(1,2);
        //tableUtilities.createTable('recibosVer', ['fecha', 'concepto', 'formaPago', 'cantidad']);

        $("#yearSelect").change(function (){
          year = $("#yearSelect").val();
          if(year != "none" || year != "" || mes != "none" || mes != ""){
            firstDate = year + "-" + mes + "-" + "01";
            days = Math.round(((new Date(year, mes))-(new Date(year, mes-1)))/86400000);
            lastDate = year + "-" + mes + "-" + days;
            //console.log(firstDate);
            //console.log(lastDate);
            getEstadoEmpresa();
          }
        });

        $("#mesSelect").change(function (){
          mes = $("#mesSelect").val();
          //console.log("year: " + mes);
          if(year != "none" || year != "" || mes != "none" || mes != ""){
            firstDate = year + "-" + mes + "-" + "01";
            days = Math.round(((new Date(year, mes))-(new Date(year, mes-1)))/86400000);
            lastDate = year + "-" + mes + "-" + days;
            //console.log(firstDate);
            //console.log(lastDate);
            getEstadoEmpresa();
          }
        });



        function getEstadoEmpresa(){
          if($("#yearSelect").val() != "none" && $("#mesSelect").val() != "none"){
          //  console.log("yearSelect: " + $("#yearSelect").val());
          //  console.log("mesSekect; " + $("#mesSelect").val());

            loadTodo();
          }


        }

        function loadTodo(){
          //console.log(firstDate);
          //console.log(lastDate);
          /*console.log({
    					fechaInicial:Utilizer.fechaParseToDbDate(firstDate),
    					fechaFinal:Utilizer.fechaParseToDbDate(lastDate)
    				});*/

            tableUtilities.loadScript('egresosVer', 'getReportesEgresos', {
      					fechaInicial:firstDate,
      					fechaFinal:lastDate
      				}, agregarEgreso);
            tableUtilities.loadScript('ingresosVer', 'getReportesIngresos', {
      					fechaInicial:firstDate,
      					fechaFinal:lastDate
      				}, agregarIngreso);
    		}

        tableUtilities.createTable('ingresosVer', ['fecha', 'concepto', 'formaPago', 'cantidadCosto']);
		    tableUtilities.createTable('egresosVer', ['fecha', 'concepto', 'formaPago', 'cantidadCosto']);
        tableUtilities.addDrawEvent('ingresosVer', recalcularTotales);
        tableUtilities.addDrawEvent('egresosVer', recalcularTotales);

        function recalcularTotales(){
          var data = {};
          data.totalIngresos = tableUtilities.getRowTotal('ingresosVer', 'cantidadCosto');
          data.totalEgresos = tableUtilities.getRowTotal('egresosVer', 'cantidadCosto');
          //console.log(data);
          data.balance = "$"+Number(Number(data.totalIngresos) - Number(data.totalEgresos)).toFixed(2);
          //console.log(data);
          data.totalIngresos = Utilizer.numberToCoin(data.totalIngresos);
          data.totalEgresos = Utilizer.numberToCoin(data.totalEgresos);
          Utilizer.setValuesWithObject(data);

        }

        function agregarEgreso(data){
          console.log("Egreso");
          console.log(data);
          return data;
        }

        function agregarIngreso(data){
          console.log("Ingreso");
          console.log(data);
          return data;
        }

      });


    </script>
