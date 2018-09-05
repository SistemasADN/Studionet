<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-clipboard"></i> </div>
    <div class="text-container"> ESTADO DE CUENTA EMPRESA </div>
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
          <div class="text-container-subtitle"> DETALLES MOVIMIENTOS </div>
        </div>
        <div class="row">
          <div style="margin-bottom:10px;" class="totalBox"><table><tbody>
                <tr><td class="col-xs-8 col-sm-6 col-md-4"><label style="margin-bottom:0px;">TOTAL:</label></td>
                  <td class="totalFiltrado" class="col-xs-2 col-sm-6 col-md-8"></td></tr></tbody></table>
          </div>
          <table class = "table-consulta-info" id="verFinanzas">
            <thead>
              <tr class="table-header">
                <th class="table-fecha">FECHA</th>
                <th class="table-fecha">SEDE</th>
                <th class="table-cantidad">MOVIMIENTO</th>
                <th class="table-cantidad">TIPO MOVIMIENTO</th>
                <th class="table-cantidad">NOMBRE</th>
                <th class="table-cantidad">FORMA PAGO</th>
                <th class="table-cantidad">CUENTA</th>
                <th class="table-cantidad">CONCEPTO</th>
                <th class="table-cantidad coin">CANTIDAD</th>
              </tr>
            </thead>
            <tfoot>
              <tr class="table-header">
                <th class="table-fecha">FECHA</th>
                <th class="table-fecha">SEDE</th>
                <th class="table-cantidad">MOVIMIENTO</th>
                <th class="table-cantidad">TIPO MOVIMIENTO</th>
                <th class="table-cantidad">NOMBRE</th>
                <th class="table-cantidad">FORMA PAGO</th>
                <th class="table-cantidad">CUENTA</th>
                <th class="table-cantidad">CONCEPTO</th>
                <th class="table-cantidad coin">CANTIDAD</th>
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
    tableUtilities.createTable('verFinanzas', ['fecha', 'sede', 'tipo', 'tipoTipo', 'beneficiario', 'formaPago', 'cuenta',  'concepto', 'cantidad'], ['sede','tipo', 'tipoTipo', 'concepto', 'cuenta', 'beneficiario', 'formaPago']);
    Utilizer.makeDatepickerRange('fechaInicial', 'fechaFinal', getTableDataHistoria);
    getTableDataHistoria();
  	var totales = {'Ingreso':{}, 'Egreso':{}};
    tableUtilities.addFilterEvent('verFinanzas', calcularTotales);
  
  });

  	function getTableDataHistoria(){
  		var data = {}
      data = Utilizer.getDatepickerRange('fechaInicial', 'fechaFinal', data);
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
    					totales[actual.tipo][actual.tipoTipo]['total'] += Utilizer.coinToNumber(actual.cantidad);
    					tableUtilities.addRow('verFinanzas', actual);
    				}
    			}
    		tableUtilities.draw('verFinanzas');
    }


    function calcularTotales(){
      var total = 0;
      
      var data = tableUtilities.getFilteredRowsData('verFinanzas');
     
      for(var i = 0;i<data.length;i++){
        actual = data[i];
        if(actual.tipo=="Ingreso"){
          total += Utilizer.coinToNumber(actual.cantidad);
        }else if(actual.tipo=="Egreso"){
          total -= Utilizer.coinToNumber(actual.cantidad);
        }
        
      }
      total = Utilizer.coinToNumber(total);
      $(".totalFiltrado").html(Utilizer.saldo(total));
    }
  </script>
