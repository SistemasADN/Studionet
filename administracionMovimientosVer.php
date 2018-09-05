<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-exchange"></i> </div>
    <div class="text-container"> VER MOVIMIENTOS </div>
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
          <div class="text-container-subtitle"><abbr title = 'Seleccione alguna especificación para filtrar los movimientos'>DETALLES MOVIMIENTOS</abbr> </div>
        </div>
        <div class="row table-container">
          <div style="margin-bottom:10px;" class="totalBox"><table><tbody>
                <tr><td class="col-xs-8 col-sm-6 col-md-4"><label style="margin-bottom:0px;">TOTAL FILTRADO:</label></td>
                  <td class="totalFiltrado" class="col-xs-2 col-sm-6 col-md-8"></td></tr></tbody></table>
          </div>
          <table class = "table table-hover table-responsive" id="verFinanzas">
            <thead>
              <tr class="table-header">
                <th class="table-fecha">FECHA</th>
                <th class="table-cantidad">MOVIMIENTO</th>
                <th class="table-cantidad">TIPO MOVIMIENTO</th>
                <th class="table-cantidad">NOMBRE</th>
                <th class="table-cantidad">FORMA PAGO</th>
                <th class="table-cantidad coin">CANTIDAD</th>
                <th class="table-cantidad">CUENTA</th>
                <th class="table-cantidad">CONCEPTO</th>
                <th class="table-cantidad">ESTADO</th>
                <th class="table-cantidad">COMENTARIOS</th>
              </tr>
            </thead>
            <tfoot>
              <tr class="table-header">
                <th class="table-fecha">FECHA</th>
                <th class="table-cantidad">MOVIMIENTO</th>
                <th class="table-cantidad">TIPO MOVIMIENTO</th>
                <th class="table-cantidad">NOMBRE</th>
                <th class="table-cantidad">FORMA PAGO</th>
                <th class="table-cantidad">CANTIDAD</th>
                <th class="table-cantidad">CUENTA</th>
                <th class="table-cantidad">CONCEPTO</th>
                <th class="table-cantidad">ESTADO</th>
                <th class="table-cantidad">COMENTARIOS</th>
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
  	tableUtilities.createTable('verFinanzas',
    ['fecha', 'tipo', 'tipoTipo', 'beneficiario', 'formaPago',
    'cantidad',  'cuenta', 'concepto', 'estado', 'comentario'],
     ['tipo', 'tipoTipo', 'concepto', 'cuenta', 'beneficiario', 'formaPago', 'estado']);
    tableUtilities.addFilterEvent('verFinanzas', calcularTotales);

  	var firstDate = Utilizer.getFirstDateMonth();
  	var lastDate = Utilizer.getLastDateMonth();

  	Utilizer.makeDatepicker('fechaInicial', firstDate);
  	Utilizer.makeDatepicker('fechaFinal', lastDate);
  	getTableDataHistoria();
  	$('#fechaInicial,#fechaFinal').on('change', getTableDataHistoria);
  });

  function getTableDataHistoria(){
      var data = {}
      data.fechaInicial = Utilizer.fechaParseToDbDate($('#fechaInicialText').val());
      data.fechaFinal = Utilizer.fechaParseToDbDate($('#fechaFinalText').val());
      tableUtilities.loadScript('verFinanzas', 'reportesMovimientos', data, loadTable);
  }

  	function loadTable(data){
			if(data.beneficiarioCuenta!=null){
				data.beneficiario = data.beneficiarioCuenta;
			}
			data.fecha = Utilizer.fechaDbParseToFecha(data.fecha);
      data.cantidad = data.cantidadCosto;
      data.estado = data.aprobar===1?'Aprobado':data.aprobar===0?'No aprobado':'Cancelado';
      //data.buttons = [];
      return data;
		}



  		function calcularTotales(){
  			var total = 0;
  			var data = tableUtilities.getFilteredRowsData('verFinanzas');
  			for(var i = 0;i<data.length;i++){
  				actual = data[i];
          if(actual.estado!="Aprobado"){
            //continue;
          }
  				if(actual.tipo=="Ingreso"){
  					total += Number(Utilizer.coinToNumber(actual.cantidad));
  				}else if(actual.tipo=="Egreso"){
  					total -= Number(Utilizer.coinToNumber(actual.cantidad));
  				}
  			}
  			total = Utilizer.coinToNumber(total);
  			$(".totalFiltrado").html(Utilizer.saldo(total));
  		}
  </script>
