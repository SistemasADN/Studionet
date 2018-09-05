<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-bar-chart"></i> </div>
    <div class="text-container"> REPORTE VENTAS </div>
  </div>
  <!--
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
  -->
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-6 col-md-6 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="text-container-subtitle"> SELECCIONE EL TIPO DE REPORTE QUE DESEA VER Y UN RANGO DE FECHAS</div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <select class="selectpicker form-input" data-live-search="true" data-label="Cliente" id="tipo" > </select>
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
    <div class="input-disabled-container">
      <div class="col-xs-12 col-sm-12 col-md-12 input-container">
        <label class='label-right col-xs-4 col-sm-4 col-md-4'>TOTAL: </label>
          <input type="text" class="totalTabla information-display col-xs-8 col-sm-8 col-md-8" id="total" disabled value = "$0.00"/>
      </div>
    </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="text-container-subtitle">¡Tipo de Reporte no seleccionado!</div>
    </div>
    <table class="table table-hover table-responsive" data-pdf = true data-csv = true data-copy = true data-xls = true id="verTotales">
      <thead>
        <tr class="table-header">
          <th><span class = 'rank'></span></th>
          <th><span class = 'concepto'></span></th>
          <th><span class = 'total'></span></th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th><span class = 'rank'></span></th>
          <th><span class = 'concepto'></span></th>
          <th><span class = 'total'></span></th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <?php include 'templates/bottom.php'; ?>
  <script>
  $(document).ready(function () {
  	tableUtilities.createTable('verTotales', ['rank', 'concepto', 'total']);
  	var firstDate = Utilizer.getFirstDateMonth();
  	var lastDate = Utilizer.getLastDateMonth();

  	Utilizer.makeDatepicker('fechaInicial', firstDate);
  	Utilizer.makeDatepicker('fechaFinal', lastDate);
    Utilizer.manualLoadSelect('tipo', 'Tipo', [
      //{id:'clase', 					      value:'Total por clase'},
      //{id:'asignatura', 					  value:'Total por asignatura'},
      //{id:'disciplina', 					  value:'Total por disciplina'},
      {id:'alumnos', 					      value:'Total por alumno'},
      {id:'cliente', 					      value:'Total por cliente'},
      {id:'conceptos', 					    value:'Total por concepto'},
      {id:'clientePagos', 					value:'Total pagos cliente'},
    ]);

  	$('#fechaInicial,#fechaFinal,#tipo').on('change', getTableDataHistoria);
  	var totales = {'Ingreso':{}, 'Egreso':{}};
  });

  	function getTableDataHistoria(){
  		var data = {}
  		data.fechaInicial = Utilizer.fechaParseToDbDate($('#fechaInicialText').val());
  		data.fechaFinal = Utilizer.fechaParseToDbDate($('#fechaFinalText').val());
      data.tipo = $("#tipo").val();
      console.log(data);
      if(data.tipo!==null){
  		    Utilizer.getResponse('getReportesTotales', data, loadTableHistoria, data.tipo);
      }
  	}

  	function loadTableHistoria(data, extra){
        $(".rank").html("Número");
        switch(extra){
          case 'grupos':
            $(".concepto").html("Grupo");
            $(".total").html("Total producido");
          break;
          case 'clase':
            $(".concepto").html("Clase");
            $(".total").html("Total producido");
          break;
          case 'asignatura':
            $(".concepto").html("Asignatura");
            $(".total").html("Total producido");
          break;
          case 'disciplina':
            $(".concepto").html("Disciplina");
            $(".total").html("Total producido");
          break;
          case 'alumnos':
            $(".concepto").html("Alumno");
            $(".total").html("Total producido");
          break;
          case 'cliente':
            $(".concepto").html("Cliente");
            $(".total").html("Total producido");
          break;
          case 'clientePagos':
            $(".concepto").html("Cliente");
            $(".total").html("Total pagado");
          break;
        }
        var sel = Utilizer.getOptionByValue('tipo', extra);
        var value = $(sel).text()
        console.log(sel);
        console.log(value);
        $(".text-container-subtitle").text(value);
        $("#verTotales").data('titulo', value);
        tableUtilities.clearTable('verTotales');
  			var total = 0;
      for(var i = 0;i<data.length;i++){
        data[i].rank = i+1;
        //data[i].cantidad
  			total += Number(data[i].total);
        data[i].total = Utilizer.numberToCoin(data[i].total);
        tableUtilities.addRow('verTotales', data[i]);
      }
  		tableUtilities.draw('verTotales');
  		$(".totalTabla").val(Utilizer.numberToCoin(total));
  	}
  </script>
