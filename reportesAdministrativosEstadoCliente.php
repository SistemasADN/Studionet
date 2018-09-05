<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-bar-chart"></i> </div>
    <div class="text-container"> ESTADO DE CUENTA DE CLIENTE </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-6 col-md-6 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <select class="selectpicker form-input" data-live-search="true" required data-label="Cliente" id="clienteSearch" name='Cliente'> </select>
        </div>
      </fieldset>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="input-disabled-container">
      <div class="col-xs-12 col-sm-12 col-md-12 input-container">
        <label class='label-right col-xs-4 col-sm-4 col-md-4'>PAGOS: </label>
        <input type="text" class="information-display col-xs-8 col-sm-8 col-md-8" id="totalIngresos" disabled value = "$0.00"/>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 input-container">
        <label class='label-right col-xs-4 col-sm-4 col-md-4'>CARTAS DE COBRO: </label>
        <input type="text" class="information-display col-xs-8 col-sm-8 col-md-8" id="totalEgresos" disabled value = "$0.00"/>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 input-container">
        <label class='label-right col-xs-4 col-sm-4 col-md-4'>BALANCE: </label>
        <input type="text" class="information-display col-xs-8 col-sm-8 col-md-8" id="balance" disabled value = "$0.00"/>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="text-container-subtitle"> PAGOS RECIBIDOS </div>
    </div>
    <table class="table table-hover table-responsive" id="recibosVer">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">CANTIDAD</th>
          <th class="table-column-title">FORMA DE PAGO</th>
          <th class="table-column-title">ESTATUS</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">CANTIDAD</th>
          <th class="table-column-title">FORMA DE PAGO</th>
          <th class="table-column-title">ESTATUS</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="text-container-subtitle"> MOVIMIENTOS DEL CLIENTE </div>
    </div>
    <table class="table table-hover table-responsive" id="movimientosVer">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">TIPO</th>
          <th class="table-column-title">CONCEPTO</th>
          <th class="table-column-title">CANTIDAD</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">TIPO</th>
          <th class="table-column-title">CONCEPTO</th>
          <th class="table-column-title">CANTIDAD</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>

  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(1,1);
        tableUtilities.createTable('recibosVer', ['fecha', 'cantidad', 'formaPago', 'estatus'], ['formaPago', 'estatus']);
        tableUtilities.createTable('movimientosVer', ['fecha', 'tipo', 'concepto', 'cantidadCosto'], ['tipo', 'concepto'], undefined, true);
        Utilizer.loadSelect('clienteSearch', 'clienteSelect', 'Cliente');

        tableUtilities.addDrawEvent('movimientosVer', recalcularTotales);

        $('#clienteSearch').on('change', cargarPagosRecibidos);
        $('#tablebox').removeClass('table-totalBox');
        $('#firstTd').removeClass('firstTd');
      });

      function recalcularTotales(){
        alert("Si SIRVE CHINGADO");
        var data = {};
        data.totalIngresos = tableUtilities.getRowTotal('recibosVer', 'cantidad');
        data.totalEgresos = tableUtilities.getRowTotal('movimientosVer', 'cantidadCosto');
        data.balance = "$"+Number(Number(data.totalIngresos) - Number(data.totalEgresos)).toFixed(2);
        console.log("recalcularTotales");
        console.log(data);
        data.totalIngresos = Utilizer.numberToCoin(data.totalIngresos);
        data.totalEgresos = Utilizer.numberToCoin(data.totalEgresos);
        Utilizer.setValuesWithObject(data);
      }


      var totalIngresos=0;
      var totalEgresos=0;

      function loadSaldoTotal(data){
        $('#tablebox').addClass('table-totalBox');
        $('#firstTd').addClass('firstTd');
    		if(data > 0){
    			data = '<div style="color:green">'+Utilizer.numberToCoin(data);
                $('#l_movimientosVertotal').html('Saldo a Favor:');
    		} else if(data < 0){
    			data = '<div style="color:red">'+Utilizer.numberToCoin(data);
                $('#l_movimientosVertotal').html('Saldo Deudor:');
    		} else {
    			data = '<div style="color:black">'+Utilizer.numberToCoin(data);
                $('#l_movimientosVertotal').html('Saldo:');
    		}
    		$('#totalmovimientosVertrueNumero').html(data);
	   }

      function agregarPagoRecibido(data){
        data.estatus = data.aprobado == 1 ? "APROBADO":"NO APROBADO";
        return data;
      }

      function agregarMovimiento(data){
        console.log(data);
        if(data.tipo != "Pago de Cliente"){
          console.log("Pago");
          totalEgresos+= Number(data.cantidadCosto);
        } else {
        console.log("Cobro");
          totalIngresos+= Number(data.cantidadCosto);
        }
        console.log(data);
        //loadSaldoTotal(total);
        return data;
      }

      function cargarPagosRecibidos(){
        totalIngresos=0;
        totalEgresos=0;
        var idCliente = Utilizer.getSelected('clienteSearch').val();
        tableUtilities.loadScript('recibosVer', 'getPagosRecibidos', {idCliente:Number(idCliente)}, agregarPagoRecibido);
        tableUtilities.loadScript('movimientosVer', 'getMovimientos', {idCliente:Number(idCliente)}, agregarMovimiento);
      }

      function recalcularTotales(){
        var data = {};
        data.totalIngresos = totalIngresos;
        data.totalEgresos = totalEgresos;
        console.log(data);
        data.balance = "$"+Number(Number(data.totalIngresos) - Number(data.totalEgresos)).toFixed(2);
        console.log(data);
        data.totalIngresos = Utilizer.numberToCoin(data.totalIngresos);
        data.totalEgresos = Utilizer.numberToCoin(data.totalEgresos);
        Utilizer.setValuesWithObject(data);
      }
    </script>
