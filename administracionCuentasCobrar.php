<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-bar-chart"></i> </div>
    <div class="text-container"> CUENTAS POR COBRAR </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-6 col-md-6 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="text-container-subtitle"> SELECCIONE UN RANGO DE FECHAS Y UN CLIENTE</div>
        </div>
        <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
        <legend>Búsqueda por Cliente: </legend>
          <select class="selectpicker form-input" data-live-search="true" data-label="Cliente" id="idCliente" > </select>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
        <legend><abbr title = 'Al buscar por alumno, automáticamente seleccionará al cliente'>Búsqueda por alumno:</abbr></legend>
        <select class="selectpicker form-input" data-live-search="true" id="idAlumno"> </select>
        </div>
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
        <label class='label-right col-xs-4 col-sm-4 col-md-4'>TOTAL POR COBRAR: </label>
          <input type="text" class="information-display col-xs-8 col-sm-8 col-md-8" id="total" disabled value = "$0.00"/>
      </div>
    </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="verTotales" data-pdf = "cuentasporcobrar" data-csv = "cuentasporcobrar" data-xls="cuestasporcobrar" data-titulo = "Cuentas por Cobrar" >
      <thead>
        <tr class="table-header">
          <th class="table-column-title">fecha</th>
          <th class="table-column-title">folio</th>
          <th class="table-column-title">sede</th>
          <th class="table-column-title">cliente</th>
          <th class="table-column-title">alumno</th>
          <th class="table-column-title">estatus</th>
          <th class="table-column-title">total</th>
          <th class="table-column-title">total Pagado</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">fecha</th>
          <th class="table-column-title">folio</th>
          <th class="table-column-title">sede</th>
          <th class="table-column-title">cliente</th>
          <th class="table-column-title">alumno</th>
          <th class="table-column-title">estatus</th>
          <th class="table-column-title">total</th>
          <th class="table-column-title">total Pagado</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <?php include 'templates/bottom.php'; ?>
  <script>
        function verCartaCobro(){
        		var data = tableUtilities.getDataFromEvent(event);
        		var tabla = tableUtilities.getTableData('cartaCobro');
        		var idCliente = data.idCliente;
        		Utilizer.getResponse('getCartaCobroServicios', {idCartaCobro:data.idCartaCobro, idCliente:idCliente}, verCartaCobroServicios, {idCartaCobro:data.idCartaCobro, idCliente:idCliente, nombreCliente:data.nombreCliente, subtotal:data.total, descuentoCC:data.descuento});
      	}

      	function verCartaCobroServicios(data, extra){
      		console.log("E");
      		var i, actual, sub=0, total, length = data['servicios'].length;
      		tableUtilities.clearTable('cc-verServicios');
      		for(i=0;i<length;i++){
      			actual = data['servicios'][i];
      			actual.fecha = Utilizer.fechaDbParseToFecha(actual.fecha);
      			actual.subtotal = Number(Utilizer.calcularSubtotal(actual.precio, actual.cantidad, actual.descuento));
      			sub += actual.subtotal;
      			actual.subtotal = Utilizer.numberToCoin(Number(actual.subtotal));
      			actual.descuento = Utilizer.numberToPercentage(actual.descuento);
      			actual.precio = Utilizer.numberToCoin(Number(actual.precio));
      			//console.log(actual);
      			tableUtilities.addRow('cc-verServicios', actual);
      		}

      		total = Utilizer.calcularTotal(sub, extra.descuentoCC);
      		$('#subTotalCC').val(Utilizer.numberToCoin(Number(sub)));
      		$('#descuentoCC').val(Utilizer.numberToPercentage(extra.descuentoCC));
      		$('#totalCC').val(Utilizer.numberToCoin(total));

      		tableUtilities.draw('cc-verServicios');
      		Utilizer.getResponse('cartaCobroPagos', {idCartaCobro:extra.idCartaCobro}, verCartaCobroAbrir, {idCartaCobro:extra.idCartaCobro, idCliente:extra.idCliente});

      	}

      	function verCartaCobroAbrir(data, extra){
      		var i, actual, length = data.length;
      		console.log(data);
      		console.log(extra);
      		tableUtilities.clearTable('cc-verPagos')
      		for(i=0;i<length;i++){
      			actual = data[i];
      			actual.cantidad = Utilizer.numberToCoin(actual.cantidad);
      			actual.fecha = Utilizer.fechaDbParseToFecha(actual.fecha);
      			actual.originalFecha = Utilizer.fechaDbParseToFecha(actual.originalFecha);
      			actual.original = Utilizer.numberToCoin(actual.originalCantidad)+" "+actual.originalTipo+" "+actual.originalFecha;
      			tableUtilities.addRow('cc-verPagos', actual);
      		}
      		tableUtilities.draw('cc-verPagos');
      		$("#popupVerCC").modal('show');
      	}

      $(document).ready(function()
      {
        function afterLoadCliente (){
        if(<?php
          if(isset($_POST['idCliente'])){
            echo "true";
          }else{
            echo "false";
          }
        ?>){
              Utilizer.setPicker('idCliente', <?php
              if(isset($_POST['idCliente'])){
                echo $_POST['idCliente'];
              }else{
                echo "''";
              }
              ?>);
              Utilizer.setPicker('idCliente', <?php
              if(isset($_POST['idCliente'])){
                echo $_POST['idCliente'];
              }else{
                echo "''";
              }
              ?>);
              $("#idCliente").trigger('change');
            }
            /*
            Utilizer.setPicker('idCliente', '331');
            Utilizer.setPicker('idCliente', '331');
            $("#idCliente").trigger('change');
            /**/
          }
      	Utilizer.loadSelect('idCliente', 'clienteRPSelect', 'Cliente', {}, afterLoadCliente);
        Utilizer.loadSelect('idAlumno', 'selectAlumnoIdCliente', 'Alumno');
        $("#idCliente,#idAlumno").change(function ()
        {
         
          if($(this).attr('id')=="idAlumno")
          {
            Utilizer.setPicker('idCliente', Utilizer.getSelected('idAlumno').data('cliente'));
          }
          else
          {
            Utilizer.setPicker('idAlumno', '');
          }
         });
        tableUtilities.createTable('verTotales', ['fecha', 'folio', 'sede', 'cliente','nombreAlumnos', 'estatus', 'total', 'totalPagado'],
        ['sede', 'cliente', 'estatus']);
      
        tableUtilities.addFilterEvent('verTotales', updateTotal);
        
      	var CurrentDate = new Date();
      	var firstDate = Utilizer.getFirstDateMonth();
      	var  lastDate = Utilizer.getLastDateMonth();
      	Utilizer.makeDatepicker('fechaInicial', firstDate);
      	Utilizer.makeDatepicker('fechaFinal', lastDate);
      
      	$('#idCliente,#fechaInicial,#fechaFinal,#idAlumno').on('change', getTable);



      	function getTable(){
          var data = {
            idCliente: $("#idCliente").val(),
            fechaInicial: Utilizer.fechaParseToDbDate($('#fechaInicialText').val()),
            fechaFinal: Utilizer.fechaParseToDbDate($('#fechaFinalText').val())
          }
      		if(data.idCliente > 0){
            data.todos = false;
            console.log(data);
      			tableUtilities.loadScript('verTotales', 'clienteReciboPagoCobrar', data, addReciboPago);
            total = 0;
      		} else {
            data.todos = true;
            console.log(data);
            tableUtilities.loadScript('verTotales', 'clienteReciboPagoCobrar', data, addReciboPago);
            total = 0;
      		}
      	}
      });
      var total = 0;
      function addReciboPago (data){
        console.log(data);
        if(data.totalPagado==0){
          data.estatus = "Aprobado";
        }else{
          data.estatus = "Pagado parcialmente";
        }
        total += Number(data.total)-Number(data.totalPagado);
        return data;
      }
      function updateTotal(){
          console.log(total);
          $("#total").val(Utilizer.numberToCoin(total));
      }
  </script>
