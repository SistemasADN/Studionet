<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-ticket"></i> </div>
    <div class="text-container"> GENERAR CARGOS SIN COBRAR </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-6 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> AGREGAR CONCEPTOS A RECIBO </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <select class="selectpicker form-input" data-live-search="true" required data-label="Cliente" id="clienteSearch" name='Cliente' data-required-message = " un cliente" data-id = 'idCliente' data-value = 'cliente' data-name = "Cliente"> </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <select class="selectpicker form-input table-input" data-subtext-name="precioUnitario" data-live-search="true" required data-label="Conceptos" id="conceptoSearch"  name='Concepto' data-required-message = " un concepto" data-id = 'idConcepto' data-value = 'concepto' data-name = "Conceptos"> </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
           <input type="number" class="form-control form-input table-input" required data-label="Cantidad" id="cantidad" name='Cantidad' data-required-message = " una cantidad" data-id = 'cantidad' data-value = 'cantidad' data-name = "Cantidad" placeholder="Cantidad">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
           <input type="number" class="form-control form-input table-input" data-label="Descuento"  name='Descuento' data-id = 'descuento' data-value = 'descuento' data-name = "Descuento" placeholder="Descuento" min = "0" max = "100" placeholder="Descuento" id="descuento">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save table-input" data-form="table-input" data-clear="true" id="reciboCobroAdd">Agregar</button>
        </div>
      </fieldset>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container" style="margin-top:20px;">
    <table class="table table-hover table-responsive list-input" data-afterinsert="calcularSubtotal" data-format="agregarConcepto" id="reciboCobro">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">CANTIDAD</th>
          <th class="table-column-title">CONCEPTO</th>
          <th class="table-column-title">PRECIO UNITARIO</th>
          <th class="table-column-title">SUBTOTAL</th>
          <th class="table-column-title">DESCUENTO (%)</th>
          <th class="table-column-title">TOTAL CON DESCUENTO</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">CANTIDAD</th>
          <th class="table-column-title">CONCEPTO</th>
          <th class="table-column-title">PRECIO UNITARIO</th>
          <th class="table-column-title">SUBTOTAL</th>
          <th class="table-column-title">DESCUENTO (%)</th>
          <th class="table-column-title">TOTAL CON DESCUENTO</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-6 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> TOTALES </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container date-container">
          <label class='label-fecha-recibo col-xs-2 col-sm-2 col-md-3'>FECHA:</label>
          <div class="input-group date col-xs-10 col-sm-10 col-md-8" id="fechaSelect"> <span class="input-group-addon">
              <i class="glyphicon glyphicon-calendar"></i>
          </span>
            <input type="text" class="form-control form-input" data-label="fecha" id="fechaSelectText"  name='fecha' data-required-message = " una fecha" data-id = 'fechaSelectText' data-value = 'fecha' data-name = "Fecha"> </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
           <input type="number" disabled class="form-control form-input" required placeholder="Sub Total" id="subTotalTabla">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
           <input type="number" class="form-control form-input" placeholder="Descuento al Total de Recibo" id="descuentoTabla">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
           <input type="number" disabled class="form-control form-input" required placeholder="TOTAL" id="totalTabla">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-form="form-input" data-clear="true" id="generarReciboCobrar" data-list = 'list-input'>GENERAR</button>
        </div>
      </fieldset>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(1,2);
        tableUtilities.createTable('reciboCobro', ['cantidad', 'concepto', 'precioUnitario', 'subTotal', 'descuento', 'totalConDescuento', 'acciones']);
        tableUtilities.setUniqueColumns('reciboCobro', ['idConcepto']);
		tableUtilities.initializeTableEngine('reciboCobro');
		ListEngine.initializeListEngine('generarReciboCobrar');

        Utilizer.makeDatepicker('fechaSelect');
        Utilizer.loadSelect('conceptoSearch', 'conceptoSelect', 'Concepto');
        Utilizer.loadSelect('clienteSearch', 'clienteSelect', 'Cliente');
      });

      function agregarConcepto(data){
        data.subTotal = Utilizer.numberToCoin(Number(data.cantidad) * Number(data.precioUnitario));
        data.totalConDescuento = Utilizer.coinToNumber(data.subTotal) * (1-Number(data.descuento)/100);
        data.totalConDescuento = Utilizer.numberToCoin(data.totalConDescuento.toFixed(2));
        data.precioUnitario = Utilizer.numberToCoin(data.precioUnitario);
        return data;
      }

      function calcularSubtotal(tableData){
        console.log('calcular subtotal');
        console.table(tableData);
      }
    </script>
