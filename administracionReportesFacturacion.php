<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-bar-chart"></i> </div>
    <div class="text-container"> REPORTE FACTURACIÓN </div>
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
          <div class="text-container-subtitle"> SELECCIONE UN CLIENTE Y UN RANGO DE FECHAS </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 input-container">
        <legend>Búsqueda por cliente</legend>
          <select class="selectpicker form-input" data-live-search="true" required data-label="Cliente" id="idCliente" name='Cliente'> </select>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 input-container">
        <legend><abbr title = 'Al buscar por alumno, automáticamente seleccionará al cliente'>Búsqueda por alumno</abbr></legend>
        <select class="selectpicker form-control" data-live-search="true" id="idAlumno"> </select>
        </div>
        <div class="row"></div>
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
        <label class='label-right col-xs-4 col-sm-4 col-md-4'>TOTAL FACTURADO: </label>
        <input type="text" class="information-display col-xs-8 col-sm-8 col-md-8" id="totalFacturado" disabled value = "$0.00"/>
      </div>
    </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="text-container-subtitle"> CARTAS DE COBRO FACTURADAS </div>
    </div>
    <table class="table table-hover table-responsive" id="reporteFacturacion" data-pdf = true data-csv = true data-copy = true data-xls = true data-titulo = "Recibos de Pago Facturados" >
      <thead>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">FOLIO</th>
          <th class="table-column-title">CLIENTE</th>
          <th class="table-column-title">TOTAL</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">FOLIO</th>
          <th class="table-column-title">CLIENTE</th>
          <th class="table-column-title">TOTAL</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function ()
       {
        var totalFacturado = 0;
        Utilizer.makeDatepicker('fechaInicial', Utilizer.getFirstDateMonth());
        Utilizer.makeDatepicker('fechaFinal', Utilizer.getLastDateMonth());
      //  Utilizer.loadSelect('idCliente', 'clienteSelect', 'Cliente');
        Utilizer.loadSelect('idCliente', 'clienteSelect', 'Cliente', {},  afterLoadCliente);
        Utilizer.loadSelect('idAlumno', 'selectAlumnoIdCliente', 'Alumno');
        $("#idCliente,#idAlumno").change(function ()
        {
          if($(this).attr('id')=="idAlumno"){
            Utilizer.setPicker('idCliente', Utilizer.getSelected('idAlumno').data('cliente'));
          }else{
            Utilizer.setPicker('idAlumno', '');
          }
        });
          tableUtilities.createTable('reporteFacturacion', ['fecha', 'folio', 'cliente', 'total']);
          tableUtilities.addDrawEvent('reporteFacturacion', updateTotal);
          $("#idCliente,#fechaInicial,#fechaFinal,#idAlumno").change(loadTable);
      
       });
      function afterLoadCliente ()
      {
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
      }
      function loadTable()
      {
        totalFacturado = Number(0);
        var data = FormEngine.getFormData('form-input');
        tableUtilities.loadScript('reporteFacturacion', 'getFacturacion', data, agregarRecibo);
      }


      function agregarRecibo(data){
        totalFacturado += Number(data.total);
        return data;
      }

      function updateTotal(){
        Utilizer.fillForm({totalFacturado:Utilizer.numberToCoin(totalFacturado)});
      }
      
    </script>
