<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-ticket"></i> </div>
    <div class="text-container"> CARTAS DE COBRO </div>
  </div>
  <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
      <button type="button" onClick = 'location.href = "reportesOperativosAlumnos.php";' class="btn btn-save">REPORTE ALUMNOS</button>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="recibosVer" data-pdf = true data-csv = true data-copy = true data-xls = true data-titulo = "Cartas de Cobro" >
      <thead>
        <tr class="table-header">
          <th class="table-column-title ordenar" data-order = '0' data-order-dir = 'desc'>FECHA</th>
          <th class="table-column-title">SEDE</th>
          <th class="table-column-title">FOLIO</th>
          <th class="table-column-title">CLIENTE</th>
          <th class="table-column-title">ALUMNO(S)</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">TOTAL RECIBO</th>
          <th class="table-column-title">TOTAL PAGADO</th>
          <th class="table-column-title">TOTAL POR PAGAR</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">SEDE</th>
          <th class="table-column-title">FOLIO</th>
          <th class="table-column-title">CLIENTE</th>
          <th class="table-column-title">ALUMNO(S)</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">TOTAL RECIBO</th>
          <th class="table-column-title">TOTAL PAGADO</th>
          <th class="table-column-title">TOTAL POR PAGAR</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>

  <!-- Modal Revisar -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modalRevisar">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body container-fluid">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-search"></i> </div>
            <div class="text-container"> REVISAR CARTA DE COBRO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="jumbotron jumbotron-container">
                <div class="jumbotron-text"> DATOS </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Fecha:</label>
              <input type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="fecha">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Cliente:</label>
              <input type="text" disabled max="100" class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="cliente">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Sede:</label>
              <input type="text" disabled max="100" class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="sede">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
              <table class="table table-hover table-responsive" id="detallesRecibo">
                <thead>
                  <tr class="table-header">
                    <th class="table-column-title">FECHA</th>
                    <th class="table-column-title">CANTIDAD</th>
                    <th class="table-column-title">CONCEPTO</th>
                    <th class="table-column-title">ALUMNO</th>
                    <th class="table-column-title">PRECIO</th>
                    <th class="table-column-title">DESCUENTO (%)</th>
                    <th class="table-column-title">TOTAL</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr class="table-header">
                    <th class="table-column-title">FECHA</th>
                    <th class="table-column-title">CANTIDAD</th>
                    <th class="table-column-title">CONCEPTO</th>
                    <th class="table-column-title">ALUMNO</th>
                    <th class="table-column-title">PRECIO</th>
                    <th class="table-column-title">DESCUENTO (%)</th>
                    <th class="table-column-title">TOTAL</th>
                  </tr>
                </tfoot>
                <tbody> </tbody>
              </table>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="jumbotron jumbotron-container">
                <div class="jumbotron-text"> TOTALES </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Sub Total:</label>
              <input type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" placeholder="Sub Total" id="subTotalRecibo">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Descuento de Recibo:</label>
              <input type="text" disabled max="100" class="input-group col-xs-8 col-sm-8 col-md-8" id="descuentoRecibo">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>TOTAL:</label>
               <input type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" placeholder="Total" id="totalRecibo">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="col-xs-12 col-sm-12 col-md-6 input-container">
              <button type="button" class="btn btn-approve" data-form="form-input" data-clear="true" id="aprobarRecibo">APROBAR</button>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 input-container">
              <button type="button" class="btn btn-delete" data-form="form-input" data-clear="true" id="borrarRecibo">BORRAR</button>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container">
            <div class="text-container-subtitle">NOTA: Una vez aprobado el recibo de cobro, NO podrá ser modificado o borrado posteriormente.</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Descuentos -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modalDescuentos">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body container-fluid">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-pencil-square-o"></i> </div>
            <div class="text-container"> MODIFICAR DESCUENTOS </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="jumbotron jumbotron-container">
                <div class="jumbotron-text"> DATOS </div>
              </div>
            </div>
            <input type = 'hidden' disabled class = 'descuento-input' id = 'idReciboPagoDesc' />
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Fecha:</label>
              <input type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="fechaDesc">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Cliente:</label>
              <input type="text" disabled max="100" class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="clienteDesc">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Sede:</label>
              <input type="text" disabled max="100" class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="sedeDesc">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
              <table class="table table-hover table-responsive descuento-input"
              data-unique = 'idReciboPagoLista' data-keys = 'descuento,idReciboPagoLista'
               id="detallesReciboDescuentos">
                <thead>
                  <tr class="table-header">
                    <th class="table-column-title">CANTIDAD</th>
                    <th class="table-column-title">CONCEPTO</th>
                    <th class="table-column-title">PRECIO</th>
                    <th class="table-column-title">DESCUENTO (%)</th>
                    <th class="table-column-title">TOTAL</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr class="table-header">
                    <th class="table-column-title">CANTIDAD</th>
                    <th class="table-column-title">CONCEPTO</th>
                    <th class="table-column-title">PRECIO</th>
                    <th class="table-column-title">DESCUENTO (%)</th>
                    <th class="table-column-title">TOTAL</th>
                  </tr>
                </tfoot>
                <tbody> </tbody>
              </table>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="jumbotron jumbotron-container">
                <div class="jumbotron-text"> TOTALES </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Sub Total:</label>
              <input type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="subTotalReciboDesc">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Descuento de Recibo:</label>
              <input type="number" max="100" class="input-group col-xs-8 col-sm-8 col-md-8 descuento-input" data-min = 0 data-max = 100 id="descuentoReciboDesc">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>TOTAL:</label>
               <input type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" placeholder="Total" id="totalReciboDesc">
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-approve"
          data-script = 'editarDescuentos' data-clear = 'false' data-function = 'afterEditDescuentos'
          data-form = 'descuento-input' id="guardarCambios">GUARDAR CAMBIOS</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Ver Detalles -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modalVerDetalles">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body container-fluid">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-search-plus"></i> </div>
            <div class="text-container"> VER DETALLES DE CARTA DE COBRO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="jumbotron jumbotron-container">
                <div class="jumbotron-text"> DATOS </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Fecha:</label>
              <input type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="fechaDetalles">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Cliente:</label>
              <input type="text" disabled max="100" class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="clienteDetalles">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Sede:</label>
              <input type="text" disabled max="100" class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="sedeDetalles">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Folio:</label>
              <input type="number" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="folioDetalles">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
              <table class="table table-hover table-responsive" id="detallesReciboDescuentosDetalles">
                <thead>
                  <tr class="table-header">
                    <th class="table-column-title">CANTIDAD</th>
                    <th class="table-column-title">CONCEPTO</th>
                    <th class="table-column-title">ALUMNO</th>
                    <th class="table-column-title">PRECIO</th>
                    <th class="table-column-title">DESCUENTO (%)</th>
                    <th class="table-column-title">TOTAL</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr class="table-header">
                    <th class="table-column-title">CANTIDAD</th>
                    <th class="table-column-title">CONCEPTO</th>
                    <th class="table-column-title">ALUMNO</th>
                    <th class="table-column-title">PRECIO</th>
                    <th class="table-column-title">DESCUENTO (%)</th>
                    <th class="table-column-title">TOTAL</th>
                  </tr>
                </tfoot>
                <tbody> </tbody>
              </table>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="jumbotron jumbotron-container">
                <div class="jumbotron-text"> TOTALES </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Sub Total:</label>
              <input type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="subTotalReciboDetalles">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Descuento de Recibo:</label>
              <input type="text" disabled max="100" class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="descuentoReciboDetalles">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>TOTAL:</label>
               <input type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" placeholder="Total" id="totalReciboDetalles">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="jumbotron jumbotron-container">
                <div class="jumbotron-text"> PAGOS APLICADOS </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
              <table class="table table-hover table-responsive" id="detallesPagos">
                <thead>
                  <tr class="table-header">
                    <th class="table-column-title">FECHA</th>
                    <th class="table-column-title">CANTIDAD USADA</th>
                    <th class="table-column-title">PAGO ORIGINAL</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr class="table-header">
                    <th class="table-column-title">FECHA</th>
                    <th class="table-column-title">CANTIDAD USADA</th>
                    <th class="table-column-title">PAGO ORIGINAL</th>
                  </tr>
                </tfoot>
                <tbody> </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        $("#exportarPDF").click(function (){
          var data = {};
          data.type = 'cartacobro';
          data.params = {};
          data.params.idReciboPago = Number($('#idReciboPago').val());
          Utilizer.makePdf(data, afterMakePdf, data);
        });
        function afterMakePdf(data, extra){
          Utilizer.SaveToDisk('pdfedit/pdf/cartacobro'+extra.params.idReciboPago+".pdf", "cartacobro"+extra.params.idReciboPago+".pdf");
        }
        //Csser.collapse(0);
        tableUtilities.createTable('recibosVer', ['fecha', 'sede', 'folio', 'nombreCliente', 'nombreAlumnos', 'estatus', 'totalRecibo', 'totalAplicado', 'totalPorPagar', 'acciones'],
        ['nombreCliente', 'nombreAlumnos', 'sede', 'estatus']);
        tableUtilities.createTable('detallesRecibo', ['fecha', 'cantidad', 'concepto', 'alumno', 'precio', 'descuentoLista', 'totalLista']);
        tableUtilities.createTable('detallesReciboDescuentos', [{
           key:'cantidad',
           type: 'display'
         }, 'concepto', {
            key:'precio',
            type: 'display'
          }, {
            key:'descuento',
            validation:{
              min: 0,
              max: 100
            },
            name: 'Descuento',
            type:'number',
            required:true,
           functions: {
               change: calcularSubtotalTabla
             },
          }, {
             key:'totalLista',
             type: 'display'
           }]);
          function calcularSubtotalTabla(){
            var cantidad = tableUtilities.getRowValueFromObject(this, 'cantidad'),
            descuento = tableUtilities.getRowValueFromObject(this, 'descuento'),
            precio = Utilizer.coinToNumber(tableUtilities.getRowValueFromObject(this, 'precio'));
            //console.log(cantidad);console.log(descuento);console.log(precio);
            tableUtilities.setRowValueFromObject(this, 'totalLista', Utilizer.calcularSubtotal(precio, cantidad, descuento));
            var data = tableUtilities.getTableData('detallesReciboDescuentos', ['cantidad', 'descuento', 'precio']);
            var subtotal = 0;
            for(var i = 0;i<data.length;i++){
                subtotal += Utilizer.calcularSubtotal(data[i].precio, data[i].cantidad,data[i].descuento);
            }
            $("#subTotalReciboDesc").val(subtotal);
            var descuentoRecibo = $("#descuentoReciboDesc").val();
            descuentoRecibo = descuentoRecibo==""?0:descuentoRecibo;
            $("#totalReciboDesc").val(Utilizer.calcularSubtotal(subtotal,1,descuentoRecibo));
          }
        tableUtilities.createTable('detallesReciboDescuentosDetalles', ['cantidad', 'concepto', 'alumno', 'precio', 'descuentoLista', 'totalLista']);
        tableUtilities.createTable('detallesPagos', ['fechaAplicada', 'cantidadAplicada', 'pagoOriginal'])
        tableUtilities.setUniqueColumns('recibosVer', ['idReciboCobro']);
        FormEngine.setFormEngine('guardarCambios');
        tableUtilities.loadScript('recibosVer', 'getRecibos', {}, agregarRecibo);
        $('#aprobarRecibo').on('click', aprobarRecibo);
        $('#borrarRecibo').on('click', borrarRecibo);
        $('#calcularSubTotal').on('click', recalcularSubTotalDescuentos);
        $('#descuentoReciboDesc').on('change', calcularTotal);
        $('#guardarCambios').on('click', guardarCambios);
        $('#closeDetalles').on('click', cerrarDetallesModal);
        //$('#exportarPDF').on('click', crearPDF);
        tableUtilities.addDrawEvent('detallesRecibo', recalcularSubtotal);
      });
	   function agregarRecibo(data) {
          //console.log(data);
          data.buttons = Array();
          data.totalPorPagar = data.totalRecibo - data.totalAplicado;
          if (data.folio === null) {
            data.folio = "Sin folio";
            data.estatus = "Sin aprobar";
            data.buttons.push(["Revisar", "btn-check", revisarReciboCobro]);
            data.buttons.push(["Modificar descuentos", "btn-edit", descuentos]);
          }
          else if (data.totalPorPagar <= 0) {
            data.estatus = "Liquidado";
            data.buttons.push(["Ver Detalles", "btn-detail", verDetalles]);
          }
          else if (data.totalAplicado <= 0) {
            data.estatus = "Aprobado";
            data.buttons.push(["Ver Detalles", "btn-detail", verDetalles]);
          }
          else {
            data.estatus = "Pagado parcialmente";
            data.buttons.push(["Ver Detalles", "btn-detail", verDetalles]);
          }
          return data;
        }
      function revisarReciboCobro(event) {
        data = tableUtilities.getDataFromEvent(event);
        //console.log('EVENT: ');
        //console.log(data);
        Utilizer.getResponse('getReciboCobroLista',
                             {idReciboPago:data.idReciboPago},
                             revisarReciboCobroAbrir,
                             data);
        $('#modalRevisar').modal('show');
      }
      function revisarReciboCobroAbrir(data, extra){
        //console.log("ABRIENDO RECIBO DE COBRO");console.table(data);console.table(extra);
        var actual, totalLista=0, subTotalCarta=0, descRecibo=0;
        tableUtilities.clearTable('detallesRecibo');
        for(var i=0; i<data.length; i++){
          actual = data[i];
          actual.totalLista = Utilizer.calcularSubtotal(actual.precio, actual.cantidad, actual.descuentoLista);
          descRecibo = actual.descuentoRecibo;
          subTotalCarta += Number(actual.totalLista);
          //console.log(subTotalCarta);
          if(actual.precio==0){
            actual.precio = "-";
            actual.descuentoLista = "-";
            actual.totalLista = "-";
            actual.cantidad = "-";
          }
          tableUtilities.addRow('detallesRecibo', actual);
        }
        $('#descuentoRecibo').val(extra.descuento);
        //console.log(data.fecha);
        $('#fecha').val(Utilizer.fechaDbParseToFecha(extra.fecha));
        $('#cliente').val(extra.nombreCliente);
        $('#sede').val(extra.sede);
        $('#subTotalRecibo').val(Utilizer.numberToCoin(subTotalCarta));
        //$('#totalRecibo').val(Utilizer.numberToCoin(subTotalCarta * (1-descRecibo/100)));
        $('#aprobarRecibo').val(extra.idReciboPago);
        $('#borrarRecibo').val(extra.idReciboPago);
        tableUtilities.draw('detallesRecibo');
      }
      function descuentos() {
        //console.log("MODIFICAR DESCUENTOS");
        data = tableUtilities.getDataFromEvent(event);
        //console.log("DESCUENTOS");console.log(data);console.log('EVENT: ');console.log(data);
        $('#subTotalReciboDesc').val(data.subTotal);
        $('#descuentoReciboDesc').val(data.descuento);
        $('#totalReciboDesc').val(data.totalRecibo);
        Utilizer.getResponse('getReciboCobroLista',
                             {idReciboPago:data.idReciboPago},
                             descuentosAbrir,
                             data);
        $('#modalDescuentos').modal('show');
      }
      function descuentosAbrir(data, extra){
        //console.log("DESCUENTOS ABRIR");console.log(extra);
        $("#idReciboPagoDesc").val(extra.idReciboPago);
        var actual, totalLista=0, subTotalCarta=0, descRecibo=0, descList=0;
        tableUtilities.clearTable('detallesReciboDescuentos');
        for(var i=0; i<data.length; i++){
          actual = data[i];
          actual.totalLista = actual.cantidad * actual.precio * (1-actual.descuentoLista/100);
          descRecibo = actual.descuentoRecibo;
          subTotalCarta += actual.totalLista;
          descList = actual.descuentoLista;
          actual.descuento = actual.descuentoLista;
          tableUtilities.addRow('detallesReciboDescuentos', actual);
        }
        tableUtilities.draw('detallesReciboDescuentos');
        $('#fechaDesc').val(Utilizer.fechaDbParseToFecha(extra.fecha));
        $('#clienteDesc').val(extra.nombreCliente);
        $('#sedeDesc').val(extra.sede);
      }
      function recalcularTotal(idRPL, value){
        var data = tableUtilities.getRowData('detallesReciboDescuentos', {idReciboPagoLista:idRPL});
        data.totalLista = Utilizer.coinToNumber(data.precio) * data.cantidad * (1-value/100);
        data.descuentoLista = "<input type='number' min='0' max='100' id='"+idRPL+"' value='"+value+"' onChange='recalcularTotal("+idRPL+",this.value)'> ";
        tableUtilities.updateRow('detallesReciboDescuentos', {idReciboPagoLista:idRPL}, data);
      }
      function recalcularSubtotal(){
        //console.log("recalcularSubtotal INICIO");console.log($("#descuentoRecibo").val());
          if($("#descuentoRecibo").val()>100){
            $("#descuentoRecibo").val(100);
          }else if($("#descuentoRecibo").val()<0){
            $("#descuentoRecibo").val(0);
          }
          var data = tableUtilities.getTableData('detallesRecibo'), descuento = $("#descuentoRecibo").val(), total = 0;
          for(var i = 0;i<data.length;i++){
            if(data[i].totalLista=="-"){
              continue;
            }
              total += Number(data[i].totalLista);
          }
          $("#subTotalRecibo").val(Utilizer.numberToCoin(total));
          //console.log("TOTAL PRE DESCUENTO");console.log(total);console.log("DESCUENTO "+descuento);
          var totalRecibo = Utilizer.calcularSubtotal(total, 1, descuento);
          //console.log("TOTAL RECIBO");console.log(totalRecibo);
          $("#totalRecibo").val(Utilizer.numberToCoin(totalRecibo));
          //console.log("recalcularSubtotal FINAL");
      }
      function recalcularSubTotalDescuentos() {
        console.log("RECALCULANDO SUBTOTAL DESCUENTOS");
        var data = tableUtilities.getTableData('detallesReciboDescuentos');
        //console.log("DATA");console.log(data);
        var act, subTotal=0, descRecibo=0;
        for(var i=0; i<data.length; i++){
          act = data[i];
          act.descNuevo = $('#'+act.idReciboPagoLista).val();
          subTotal += act.cantidad * act.precio * (1-act.descNuevo/100);
          $('#descuentoReciboDesc').val(act.descuentoRecibo);
          descRecibo = act.descuentoRecibo;
        }
        //console.log("subTotal");console.log(subTotal);console.log("descRecibo");console.log(descRecibo);
        $('#subTotalReciboDesc').val(Utilizer.numberToCoin(subTotal));
        var total = subTotal * (1-Number(descRecibo)/100);
        $('#totalReciboDesc').val(Utilizer.numberToCoin(total));
      }
      function calcularTotal(){
        console.log("CALCULANDO TOTAL");
        var descRec = $('#descuentoReciboDesc').val();
        var total = Utilizer.coinToNumber($('#subTotalReciboDesc').val());
        $('#totalReciboDesc').val(Utilizer.numberToCoin(total*(1-descRec/100)));
      }
      function borrarRecibo() {
        var val = $('#borrarRecibo').val();
        Utilizer.getResponse('borrarReciboCobro', {idReciboCobro:Number(val)}, afterBorrar, val);
      }
      function afterBorrar(data,extra){
        if(data!=-1){
          data = data.split('|');
		  switch(data[0]){
		    case 's':
			 tableUtilities.deleteRow('recibosVer', {idReciboPago:Number(extra)});
			 $("#modalRevisar").modal('hide');
			 break;
			case 'e':
			 break;
			default:
			 data[0] = "e";
			 data[1] = "Problema del codigo";
			 data[2] = "Ha habido un problema con la ejecucion del codigo. Vea la consola para mas informacion.";
			 break;
		  }
		  Messager.addAlertText(data[1],data[2],data[0]);
        }
      }
      function afterEditDescuentos(){
              tableUtilities.loadScript('recibosVer', 'getRecibos', {}, agregarRecibo);
              $("#modalDescuentos").modal('hide');
      }
      function cerrarDetallesModal() {
        $("#modalVerDetalles").modal('hide');
      }
      function verDetalles() {
        var data = tableUtilities.getDataFromEvent(event);
        $('#fechaDetalles').val('');
        $('#clienteDetalles').val('');
        $('#folioDetalles').val('');
        $('#subTotalReciboDetalles').val('');
        $('#descuentoReciboDetalles').val('');
        $('#totalReciboDetalles').val('');
        //console.log(data);
        $("#idReciboPago").val(data.idReciboPago);
        $('#fechaDetalles').val(Utilizer.fechaDbParseToFecha(data.fecha));
        $('#clienteDetalles').val(data.nombreCliente);
        $("#sedeDetalles").val(data.sede);
        $('#folioDetalles').val(data.folio);
        $('#totalReciboDetalles').val(Utilizer.numberToCoin(data.totalRecibo));
        $('#descuentoReciboDetalles').val(Utilizer.numberToPercentage(data.descuento));
        //console.log(Utilizer.percentageToNumber(data.descuento));
        $('#subTotalReciboDetalles').val(Utilizer.numberToCoin(Utilizer.coinToNumber(data.totalRecibo)/(1-(Utilizer.percentageToNumber(data.descuento)/100))));
        tableUtilities.loadScript('detallesReciboDescuentosDetalles', 'getReciboCobroLista', {idReciboPago:data.idReciboPago}, agregarDetallesDescuento);
        tableUtilities.loadScript('detallesPagos', 'getReciboCobroListaPagos', {idReciboPago:data.idReciboPago}, agregarDetallesPagos)
        $('#modalVerDetalles').modal('show');
        //console.log(data);
      }
      function agregarDetallesDescuento(data){
        data.totalLista = data.cantidad * data.precio * (1-data.descuentoLista/100);
        return data;
      }
      function agregarDetallesPagos(data){
        //console.log(data);
        data.cantidadAplicada = Utilizer.numberToCoin(data.cantidadAplicada);
        data.pagoOriginal = Utilizer.numberToCoin(data.cantidadRecibida) +' '+ data.formaPago + ' ' + Utilizer.fechaDbParseToFecha(data.fechaRecibido);
        return data;
      }
      function aprobarRecibo() {
        var idReciboPago = $('#aprobarRecibo').val();
        //console.log(idReciboPago);
        Utilizer.getResponse('aprobarReciboPago',
                             {idReciboPago:idReciboPago},
                             afterAprobarRecibo,
                             idReciboPago);
      }
      function afterAprobarRecibo(data, extra){
        //console.log(data);console.log(extra);
        if(data==-1){
          Messager.addAlertText('Aprobar Carta de cobro', 'El Carta de cobro no ha sido aprobado con exito.', 'e');
          return;
        }
        Messager.addAlertText('Aprobar Carta de cobro', 'El Carta de cobro ha sido aprobado con exito.', 's');
        tableUtilities.loadScript('recibosVer', 'getRecibos', {}, agregarRecibo);
        $("#modalRevisar").modal('hide');
      }
      /*function crearPDF(){
        var data = tableUtilities.getTableData('detallesReciboDescuentosDetalles');
        data.fecha = $('#fechaDetalles').val();
        data.cliente = $('#clienteDetalles').val();
        data.folio = $('#folioDetalles').val();
        var content = pdfHandler.setContent(data, 1);
        pdfMake.createPdf(content).open();
      }*/
    </script>
