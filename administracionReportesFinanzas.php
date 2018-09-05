<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-clipboard"></i> </div>
    <div class="text-container"> REPORTE DE FINANZAS </div>
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
    <div class="row">
      <div class="col-xs-12 col-sm-3 col-md-3"></div>
      <div class="col-xs-12 col-sm-6 col-md-6">
        <canvas id = "bar" style = "width:auto;max-width:1000px"></canvas>
      </div>
      <div class="col-xs-12 col-sm-3 col-md-3"></div>
    </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="row">
      <div class="col-xs-12 col-sm-1 col-md-1"></div>
        <div class="col-xs-12 col-sm-10 col-md-10">
          <fieldset>
            <div class="col-xs-12 col-sm-12 col-md-12" style = "text-align: center;">
              <div class="text-container-subtitle"> UTILIDADES</div>

              <div id = "totalUtilidades"></div>
            </div>
          </fieldset>

          <div class = 'row'>
  					<div class="col-xs-12 col-sm-1 col-md-1"></div>
  					<div class="col-xs-12 col-sm-12 col-md-12">
              <div class="col-xs-12 col-sm-12 col-md-12" style = "text-align: center;">
                <div class="text-container-subtitle"> INGRESOS <button type = 'button' class = 'toggleShow btn btn-default'
                  data-hidden = 'false' data-class = 'ingresos'><i class = 'fa fa-eye'></i><i class = 'fa fa-eye-slash'></i></button></div>
                <div class = 'verde' id = "totalIngreso"></div>
              </div>
  							<div class="row ingresos">
  								<div class="col-xs-12 col-sm-4 col-md-4"></div>
  								<div class="col-xs-12 col-sm-4 col-md-4">
  									<canvas id = "porcentajeIngreso" style = "width:auto;"></canvas>
  								</div>
  								<div class="col-xs-12 col-sm-4 col-md-4"></div>
  							</div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container ingresos">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="text-container-subtitle"></div>
                  </div>
                    <table class="table table-hover table-responsive" id="verIngreso">
  										<thead>
  											<tr class="table-header">
  												<th class="table-cantidad">TIPO DE MOVIMIENTO</span></th>
  												<th class="table-cantidad">CANTIDAD</span></th>
  												<th class="table-cantidad">% SOBRE INGRESOS</th>
  												<th class="table-cantidad">% SOBRE EGRESOS</th>
  											</tr>
  										</thead>
  										<tfoot>
  											<tr class="table-header">
  												<th class="table-cantidad">TIPO DE MOVIMIENTO</span></th>
                          <th class="table-cantidad">CANTIDAD</span></th>
  												<th class="table-cantidad">% SOBRE INGRESOS</th>
  												<th class="table-cantidad">% SOBRE EGRESOS</th>
  											</tr>
  										</tfoot>
  										<tbody>
  										</tbody>
  									</table>
  							</div>
  							<div class="row ingresos">
  								<legend>Seleccione un subtipo para más información del mismo.</legend>
  				        <div class="form-group" >
  									<select class="selectpicker" data-live-search="true" id="subTipoIngreso"></select>
  								</div>
  				      </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container ingresos">
  									<table class = "table table-hover table-responsive table-consulta-info" id="verSubtipoIngresoBeneficiario">
  										<thead>
  											<tr class="table-header">
  												<th class="table-cantidad">BENEFICIARIO</span></th>
  												<th class="table-cantidad">TOTAL</th>
  												<th class="table-cantidad"><span id = 'porcentajeSubtipoIngresoB'></span></th>
  											</tr>
  										</thead>
  										<tfoot>
  											<tr class="table-header">
  												<th class="table-cantidad">BENEFICIARIO</span></th>
  												<th class="table-cantidad">TOTAL</th>
  												<th class="table-cantidad"><span id = 'porcentajeSubtipoIngresoB'></span></th>
  											</tr>
  										</tfoot>
  										<tbody>
  										</tbody>
  									</table>
  							</div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container ingresos">
		                <table class = "table table-hover table-responsive table-consulta-info" id="verSubtipoIngresoConcepto">
  										<thead>
  											<tr class="table-header">
  												<th class="table-cantidad">CONCEPTO</span></th>
  												<th class="table-cantidad">TOTAL</th>
  												<th class="table-cantidad"><span id = 'porcentajeSubtipoIngresoC'></span></th>
  											</tr>
  										</thead>
  										<tfoot>
  											<tr class="table-header">
  												<th class="table-cantidad">CONCEPTO</span></th>
  												<th class="table-cantidad">TOTAL</th>
  												<th class="table-cantidad"><span id = 'porcentajeSubtipoIngresoC'></span></th>
  											</tr>
  										</tfoot>
  										<tbody>
  										</tbody>
  									</table>
  							</div>
  						</div>
  						<!-- End Third Row -->
  						<div class="col-xs-12 col-sm-1 col-md-1"></div>
  						<!-- Start Third Row -->
  						<div class="col-xs-12 col-sm-4 col-md-12">
  							<fieldset>
                  <div class="col-xs-12 col-sm-12 col-md-12" style = "text-align: center;">
                    <div class="text-container-subtitle"> EGRESOS <button type = 'button' class = 'toggleShow btn btn-default'
                       data-hidden = 'false' data-class = 'egresos'><i class = 'fa fa-eye'></i><i class = 'fa fa-eye-slash'></i></button></div>
                    <div class = 'rojo' id = "totalEgreso"></div>
                  </div>

  							  <div class="row egresos">
  									<div class="col-xs-12 col-sm-4 col-md-4"></div>
  									<div class="col-xs-12 col-sm-4 col-md-4">
  										<canvas id = "porcentajeEgreso"></canvas>
  									</div>
  									<div class="col-xs-12 col-sm-4 col-md-4"></div>
  								</div>

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container egresos">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="text-container-subtitle"></div>
                    </div>
  										<table class = "table table-hover table-responsive table-consulta-info" id="verEgreso">
  											<thead>
  												<tr class="table-header">
  													<th class="table-cantidad">TIPO DE MOVIMIENTO</span></th>
                            <th class="table-cantidad">CANTIDAD</span></th>
                            <th class="table-cantidad">% SOBRE INGRESOS</th>
                            <th class="table-cantidad">% SOBRE EGRESOS</th>
  												</tr>
  											</thead>
  											<tfoot>
  												<tr class="table-header">
  													<th class="table-cantidad">TIPO DE MOVIMIENTO</span></th>
                            <th class="table-cantidad">CANTIDAD</span></th>
    												<th class="table-cantidad">% SOBRE INGRESOS</th>
    												<th class="table-cantidad">% SOBRE EGRESOS</th>
  												</tr>
  											</tfoot>
  											<tbody>
  											</tbody>
  										</table>
  								</div>
  								<div class="row egresos">
  									<legend>Seleccione un subtipo para más información del mismo.</legend>
  									<div class="form-group" >
  										<select class="selectpicker" data-live-search="true" id="subTipoEgreso"></select>
  									</div>
  								</div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container egresos">
  										<table class = "table table-hover table-responsive table-consulta-info" id="verSubtipoEgresoBeneficiario">
  											<thead>
  												<tr class="table-header">
  													<th class="table-cantidad">BENEFICIARIO</span></th>
  													<th class="table-cantidad">TOTAL</th>
  													<th class="table-cantidad"><span id = 'porcentajeSubtipoEgresoB'></span></th>
  												</tr>
  											</thead>
  											<tfoot>
  												<tr class="table-header">
  													<th class="table-cantidad">BENEFICIARIO</span></th>
  													<th class="table-cantidad">TOTAL</th>
  													<th class="table-cantidad"><span id = 'porcentajeSubtipoEgresoB'></span></th>
  												</tr>
  											</tfoot>
  											<tbody>
  											</tbody>
  										</table>
  								</div>

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container egresos">
  										<table class = "table table-hover table-responsive table-consulta-info" id="verSubtipoEgresoConcepto">
  											<thead>
  												<tr class="table-header">
  													<th class="table-cantidad">CONCEPTO</span></th>
  													<th class="table-cantidad">TOTAL</th>
  													<th class="table-cantidad"><span id = 'porcentajeSubtipoEgresoC'></span></th>
  												</tr>
  											</thead>
  											<tfoot>
  												<tr class="table-header">
  													<th class="table-cantidad">CONCEPTO</span></th>
  													<th class="table-cantidad">TOTAL</th>
  													<th class="table-cantidad"><span id = 'porcentajeSubtipoEgresoC'></span></th>
  												</tr>
  											</tfoot>
  											<tbody>
  											</tbody>
  										</table>
  								</div>
  						</div>
  						<div class="col-xs-12 col-sm-1 col-md-1"></div>
  					</div>
        </div>
      <div class="col-xs-12 col-sm-1 col-md-1"></div>
    </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-10 col-md-10 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="text-container-subtitle"> DETALLES MOVIMIENTOS <button type = 'button' class = 'toggleShow btn btn-default'
            data-hidden = 'false' data-class = 'movimientos'><i class = 'fa fa-eye'></i><i class = 'fa fa-eye-slash'></i></button></div>
        </div>
        <div class="row movimientos">
          <div style="margin-bottom:10px;" class="totalBox"><table><tbody>
                <tr><td class="col-xs-8 col-sm-6 col-md-4"><label style="margin-bottom:0px;">TOTAL FILTRADO:</label></td>
                  <td class="totalFiltrado" class="col-xs-2 col-sm-6 col-md-8"></td></tr></tbody></table>
          </div>
          <table class = "table table-hover table-responsive table-consulta-info" id="verFinanzas">
            <thead>
              <tr class="table-header">
                <th class="table-fecha">FECHA</th>
                <th class="table-cantidad">MOVIMIENTO</th>
                <th class="table-cantidad">TIPO MOVIMIENTO</th>
                <th class="table-cantidad">BENEFICIARIO</th>
                <th class="table-cantidad">FORMA PAGO</th>
                <th class="table-cantidad">CUENTA</th>
                <th class="table-cantidad">CONCEPTO</th>
                <th class="table-cantidad">CANTIDAD</th>
              </tr>
            </thead>
            <tfoot>
              <tr class="table-header">
                <th class="table-fecha">FECHA</th>
                <th class="table-cantidad">MOVIMIENTO</th>
                <th class="table-cantidad">TIPO MOVIMIENTO</th>
                <th class="table-cantidad">BENEFICIARIO</th>
                <th class="table-cantidad">FORMA PAGO</th>
                <th class="table-cantidad">CUENTA</th>
                <th class="table-cantidad">CONCEPTO</th>
                <th class="table-cantidad">CANTIDAD</th>
              </tr>
            </tfoot>
            <tbody>
            </tbody>
          </table>
        </div>
        </fieldset>
      </div>
    <!-- End Third Row -->

  </div>




  <?php include 'templates/bottom.php'; ?>
  <script>
  $(document).ready(function () {
    $(".toggleShow").click(function (){
      var hidden = $(this).data('hidden');
      if(hidden){
        $(this).find('.fa-eye-slash').hide();
        $(this).find('.fa-eye').show();
        $("."+$(this).data('class')).show();
      }else{
        $(this).find('.fa-eye-slash').show();
        $(this).find('.fa-eye').hide();
        $("."+$(this).data('class')).hide();
      }
      $(this).data('hidden', !hidden);
    });

    $(".toggleShow").trigger('click');

  	tableUtilities.createTable('verFinanzas', ['fecha', 'tipo', 'tipoTipo', 'beneficiario', 'formaPago', 'cuenta',  'concepto', 'cantidad'], ['tipo', 'tipoTipo', 'concepto', 'cuenta', 'beneficiario', 'formaPago']);
  	tableUtilities.createTable('verIngreso', ['tipoTipo', 'cantidad', 'porcentajeIngreso', 'porcentajeEgreso']);
  	tableUtilities.createTable('verEgreso', ['tipoTipo', 'cantidad', 'porcentajeIngreso', 'porcentajeEgreso']);
  	tableUtilities.createTable('verSubtipoIngresoConcepto', ['concepto', 'total', 'porcentaje']);
  	tableUtilities.createTable('verSubtipoIngresoBeneficiario', ['concepto', 'total', 'porcentaje']);
  	tableUtilities.createTable('verSubtipoEgresoConcepto', ['concepto', 'total', 'porcentaje']);
  	tableUtilities.createTable('verSubtipoEgresoBeneficiario', ['concepto', 'total', 'porcentaje']);

  /**/


  	var firstDate = Utilizer.getFirstDateMonth();
  	var lastDate = Utilizer.getLastDateMonth();

  	Utilizer.makeDatepicker('fechaInicial', firstDate);
  	Utilizer.makeDatepicker('fechaFinal', lastDate);

  	getTableDataHistoria();

  	$('#fechaInicial').on('change', getTableDataHistoria);
  	$('#fechaFinal').on('change', getTableDataHistoria);
  	var totales = {'Ingreso':{}, 'Egreso':{}};
    tableUtilities.addFilterEvent('verFinanzas', calcularTotales);
          function calcularTotales(){
            var total = 0;
            var data = tableUtilities.getFilteredRowsData('verFinanzas');
            for(var i = 0;i<data.length;i++){
              actual = data[i];
              if(actual.tipo=="Ingreso"){
                total += Number(actual.cantidad);
              }else if(actual.tipo=="Egreso"){
                total -= Number(actual.cantidad);
              }
            }
            total = Utilizer.coinToNumber(total);
            $(".totalFiltrado").html(Utilizer.saldo(total));
          }
  });

  	function getTableDataHistoria(){
  		var data = {}
  		data.fechaInicial = Utilizer.fechaParseToDbDate($('#fechaInicialText').val());
  		data.fechaFinal = Utilizer.fechaParseToDbDate($('#fechaFinalText').val());
  		Utilizer.getResponse('reportesFinanzasGraficos', data, loadTableHistoria);
  	}

  	function loadTableHistoria(data){

  		var keys = Object.keys(data);
  		totales = {'Ingreso':{}, 'Egreso':{}};
  		keys = Object.keys(totales);
  		var keysFinal = {}, colorsFinal = {}, valuesFinal = {};
  		for(var j = 0;j<keys.length;j++){
  			keysFinal[keys[j]] = {};
  			colorsFinal[keys[j]] = {};
  			valuesFinal[keys[j]] = {};
  		}
  		//console.log(data);
  		keys = Object.keys(data);
  		tableUtilities.clearTable('verFinanzas');

  		for(var j = 0;j<keys.length;j++){
  				var actual;
  				for(var i = 0;i<data[keys[j]].length;i++){
  					actual = data[keys[j]][i];
  					if(actual.beneficiarioCuenta!=null){
  						actual.beneficiario = actual.beneficiarioCuenta;
  					}
  					if(totales[actual.tipo][actual.tipoTipo]===undefined){
  						totales[actual.tipo][actual.tipoTipo] = {'conceptos':{}, 'beneficiario':{}, 'total':0};
  					}
  					actual.fecha = Utilizer.fechaDbParseToFecha(actual.fecha);
            actual.cantidad = actual.cantidadCosto;
  					totales[actual.tipo][actual.tipoTipo]['conceptos'][actual.concepto]===undefined?totales[actual.tipo][actual.tipoTipo]['conceptos'][actual.concepto] = Number(actual.cantidad):totales[actual.tipo][actual.tipoTipo]['conceptos'][actual.concepto]+= Number(actual.cantidad);
  					totales[actual.tipo][actual.tipoTipo]['beneficiario'][actual.beneficiario]===undefined?totales[actual.tipo][actual.tipoTipo]['beneficiario'][actual.beneficiario] = Number(actual.cantidad):totales[actual.tipo][actual.tipoTipo]['beneficiario'][actual.beneficiario]+= Number(actual.cantidad);
  					totales[actual.tipo][actual.tipoTipo]['total'] += Number(actual.cantidad);
  					tableUtilities.addRow('verFinanzas', actual);
  				}
  			}
  		tableUtilities.draw('verFinanzas');

  		//COSITAS pros
  		//console.log({totales});
  		var k = Object.keys(totales);
  		var total = {'Ingreso':0, 'Egreso':0};

  		tableUtilities.clearTable('verIngreso');
  		tableUtilities.clearTable('verEgreso');
  		for(var z = 0;z<k.length;z++){
  			man = Object.keys(totales[k[z]]);
  			for(var i = 0;i<man.length;i++){
  				man[i] = {id:man[i], value:man[i]};
  			}
  			$("#subTipo"+k[z]).change(loadTableConceptoBeneficiario);

  			Utilizer.manualLoadSelect('subTipo'+k[z], 'Subtipo de '+k[z], man);

  				keys = Object.keys(totales[k[z]]);
  				for(i = 0;i<keys.length;i++){
  						total[k[z]] += Number(totales[k[z]][keys[i]]['total']);
  				}
  				$("#subTipo"+k[z]).data('info', totales[k[z]]);
  				$("#subTipo"+k[z]).data('tipo', k[z]);
  		}

  		for(var z = 0;z<k.length;z++){
  				keys = Object.keys(totales[k[z]]);
  				for(i = 0;i<keys.length;i++){
  						actual = {'tipoTipo':keys[i],'cantidad':totales[k[z]][keys[i]]['total']};
  						actual.porcentajeIngreso = Number(100*actual.cantidad/total['Ingreso']).toFixed(2)+"%";
  						actual.porcentajeEgreso = Number(100*actual.cantidad/total['Egreso']).toFixed(2)+"%";
  						actual.cantidad = Utilizer.numberToCoin(actual.cantidad);
  						tableUtilities.addRow('ver'+k[z], actual);
  				}
  		}
  		tableUtilities.draw('verIngreso');
  		tableUtilities.draw('verEgreso');

  		$("#totalIngreso").html(Utilizer.numberToCoin(total['Ingreso']));
  		$("#totalEgreso").html(Utilizer.numberToCoin(total['Egreso']));
  		$("#totalUtilidades").html(Utilizer.numberToCoin(Number(total['Ingreso'])-Number(total['Egreso'])));

  		var bgc, bc;
  		if((Number(total['Ingreso'])-Number(total['Egreso'])>=0)){
  			$("#totalUtilidades").addClass('verde');
  			bgc = 'rgba(0, 99, 132, 0.2)';
  			bc = 'rgba(0,99,132,1)';
  		}else{
  			$("#totalUtilidades").addClass('rojo');
  			bgc = 'rgba(255, 99, 132, 0.2)';
  			bc = 'rgba(255,99,132,1)';
  		}

  		Chartizer.bar("bar", "Utilidades", ['Periodo '+$('#fechaInicialText').val()+" a "+$('#fechaFinalText').val()], "$",
  		 [{
  					label: 'Ingresos',
  					data: [total['Ingreso']],
  					backgroundColor: 'rgba(0, 99, 132, 0.2)',
  					borderColor: 'rgba(0,99,132,1)',
  					borderWidth: 1
  			},
  			{
  				label: 'Egresos',
  				data: [total['Egreso']],
  				backgroundColor: 'rgba(255, 99, 132, 0.2)',
  				borderColor: 'rgba(255,99,132,1)',
  				borderWidth: 1
  		},
  		{
  				label: 'Utilidades',
  				data: [Number(total['Ingreso'])-Number(total['Egreso'])],
  				backgroundColor: bgc,
  				borderColor: bc,
  				borderWidth: 1
  		}]

  	);
  				for(var z = 0;z<k.length;z++){
  					keys = Object.keys(totales[k[z]]);
  					var values = [], colors = [];
  					for(var j = 0;j<keys.length;j++){
  						values.push(Number(100*totales[k[z]][keys[j]].total/total[k[z]]).toFixed());
  						colors.push(randomColor({
  							hue:k[z]=="Ingreso"?'green':'red',
  							luminosity:k[z]=="Ingreso"?'dark':'',
  						}));
  					}

  					Chartizer.pie(
  											 "porcentaje"+k[z],
  					 							keys,
  					  						"Porcentaje de "+k[z]+" por tipo",
  												"%",
  												colors,
  												values);
  				}
  	}

  	function loadTableConceptoBeneficiario(){
  		var tipo = $(this).data('tipo'), data = $(this).data('info')[this.value], keys, actual = {};
  		console.log({data});
  		tableUtilities.clearTable('verSubtipo'+tipo+'Beneficiario');
  		tableUtilities.clearTable('verSubtipo'+tipo+'Concepto');
  		keys = Object.keys(data['beneficiario']);
  		for(var i = 0;i<keys.length;i++){
  			actual.concepto = keys[i];
  			actual.total = data['beneficiario'][keys[i]];
  			actual.porcentaje = Number((100*actual.total)/Number(data.total)).toFixed(2)+"%";
  			actual.total = Utilizer.numberToCoin(data['beneficiario'][keys[i]]);
  			tableUtilities.addRow('verSubtipo'+tipo+'Beneficiario', actual);
  		}
  		$("#porcentajeSubtipo"+tipo+"B").text('Porcentaje sobre '+this.value);
  		tableUtilities.draw('verSubtipo'+tipo+'Beneficiario');
  		keys = Object.keys(data['conceptos']);
  		for(var i = 0;i<keys.length;i++){
  			actual.concepto = keys[i];
  			actual.total = data['conceptos'][keys[i]];
  			actual.porcentaje = Number((100*actual.total)/Number(data.total)).toFixed(2)+"%";
  			actual.total = Utilizer.numberToCoin(data['conceptos'][keys[i]]);
  			tableUtilities.addRow('verSubtipo'+tipo+'Concepto', actual);
  		}
  		$("#porcentajeSubtipo"+tipo+"C").text('Porcentaje sobre '+this.value);
  		tableUtilities.draw('verSubtipo'+tipo+'Concepto');
  	}
  </script>
