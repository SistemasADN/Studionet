<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-bar-chart"></i> </div>
    <div class="text-container"> ESTADO DE CUENTA DE CLIENTE </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-6 col-sm-6 col-md-6 form-container">
      <fieldset>
        <div class="col-xs-6 col-sm-6 col-md-6 input-container">
        <legend>Busca por cliente</legend>
          <select class="selectpicker form-input" data-live-search="true" required data-label="Cliente" id="clienteSearch" name='Cliente'> </select>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 input-container">
        <legend><abbr title = 'Al buscar por alumno, automáticamente seleccionará al cliente'>Busca por alumno</abbr></legend>
        <select class="selectpicker form-control" data-live-search="true" id="idAlumno"> </select>
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
      <div class="text-container-subtitle"> MOVIMIENTOS DEL CLIENTE </div>
    </div>
    <table class="table table-hover table-responsive" id="movimientosVer" data-pdf = true data-csv = true data-copy = true data-xls = true data-titulo = "Estado de Cuenta de Cliente" >
      <thead>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">TIPO</th>
          <th class="table-column-title">FORMA PAGO</th>
          <th class="table-column-title">CUENTA</th>
          <th class="table-column-title">FOLIO</th>
          <th class="table-column-title">CANTIDAD</th>
        <!--  <th class="table-column-title">SALDO</th> -->
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">TIPO</th>
          <th class="table-column-title">FORMA PAGO</th>
          <th class="table-column-title">CUENTA</th>
          <th class="table-column-title">FOLIO</th>
          <th class="table-column-title">CANTIDAD</th>
        <!--  <th class="table-column-title">SALDO</th> -->
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>

  <?php include 'templates/bottom.php'; ?>
    <script>
    totalSaldo = 0;
      $(document).ready(function () {
        //Csser.collapse(5);
        //tableUtilities.createTable('movimientosVer', ['fecha', 'tipo', 'formaPago','cuenta','folio','cantidadCosto', 'saldo'], ['tipo', 'concepto'], undefined, true);
        tableUtilities.createTable('movimientosVer',
        ['fecha', 'tipo', 'formaPago','cuenta','folio','cantidadCosto'],
        ['tipo', 'concepto'], undefined, true);
        Utilizer.loadSelect('clienteSearch', 'clienteSelect', 'Cliente', {}, afterLoadCliente);
       // Utilizer.loadSelect('clienteSearch', 'clienteSelect', 'Cliente');
        Utilizer.loadSelect('idAlumno', 'selectAlumnoIdCliente', 'Alumno');
        
        $("#clienteSearch,#idAlumno").change(function (){
          if($(this).attr('id')=="idAlumno"){
            Utilizer.setPicker('clienteSearch', Utilizer.getSelected('idAlumno').data('cliente'));
          }else{
            Utilizer.setPicker('idAlumno', '');
          }
        });
        
        tableUtilities.addDrawEvent('movimientosVer', recalcularTotales);

        $('#clienteSearch,#idAlumno').on('change', cargarPagosRecibidos);
        $('#tablebox').removeClass('table-totalBox');
        $('#firstTd').removeClass('firstTd');
        
      });

           function afterLoadCliente (){
        if(<?php
          if(isset($_POST['clienteSearch'])){
            echo "true";
          }else{
            echo "false";
          }
        ?>){
              Utilizer.setPicker('clienteSearch', <?php
              if(isset($_POST['clienteSearch'])){
                echo $_POST['clienteSearch'];
              }else{
                echo "''";
              }
              ?>);
              Utilizer.setPicker('clienteSearch', <?php
              if(isset($_POST['clienteSearch'])){
                echo $_POST['clienteSearch'];
              }else{
                echo "''";
              }
              ?>);
              $("#clienteSearch").trigger('change');
            }
            /*
            Utilizer.setPicker('idCliente', '331');
            Utilizer.setPicker('idCliente', '331');
            $("#idCliente").trigger('change');
            /**/
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

        totalSaldo = 0;
        totalIngresos = 0;
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
          totalSaldo += Number(data.cantidadCosto);
          totalEgresos+= Number(data.cantidadCosto);
        } else {
          totalSaldo -= Number(data.cantidadCosto);
          totalIngresos+= Number(data.cantidadCosto);
        }
        //data.saldo = Utilizer.saldo(totalSaldo);
        //console.log(data);
        //loadSaldoTotal(total);
        return data;
      }

      function cargarPagosRecibidos(){
        var sel = Utilizer.getSelected('clienteSearch'), idCliente = $("#clienteSearch").val();
        $("#movimientosVer").data('titulo', "Estado de Cuenta de "+$(sel).text());
        totalSaldo = 0;
        totalIngresos = 0;
        totalEgresos = 0;

        tableUtilities.loadScript('movimientosVer', 'getMovimientos',
        {idCliente:Number(idCliente)}, agregarMovimiento);
      }
      /*
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
        console.log("HAVE BEEN SET");
        totalSaldo = 0;
        totalIngresos = 0;
      }
      */
      
    </script>
