<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-plus"></i> </div>
    <div class="text-container"> CAPTURAR INGRESO</div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"><abbr title = 'Por favor llene la forma para generar el ingreso'>DATOS DEL INGRESO</abbr></div>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 input-container spec">
          <select class="selectpicker form-ingreso" data-live-search="true" required id="idTipoIngreso"> </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container form-cliente" hidden>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container form-cliente" hidden>
                <legend>Seleccione un cliente o un alumno:</legend>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 input-container form-cliente" hidden>
              <select class="selectpicker form-cliente form-control" data-live-search="true" required id="idCliente"> </select>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 input-container form-cliente" hidden>
              <select class="selectpicker form-cliente form-control" data-live-search="true" id="idAlumno"> </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <button class="btn btn-primary generaNuevaCC" data-toggle = "modal" data-target = "#nuevaCC">Generar Carta de Cobro</button>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container form-cliente" hidden>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
            <legend>Cartas de cobro sin aprobar</legend>
            <table class="table table-hover table-responsive" id="recibosVer" >
              <thead>
                <tr class="table-header">
                  <th class="table-column-title ordenar" data-order = '0' data-order-dir = 'desc'>FECHA</th>
                  <th class="table-column-title">SEDE</th>
                  <th class="table-column-title">ESTATUS</th>
                  <th class="table-column-title">TOTAL CARTA DE COBRO</th>
                  <th class="table-column-title">ACCIONES</th>
                </tr>
              </thead>
              <tfoot>
                <tr class="table-header">
                  <th class="table-column-title ordenar" data-order = '0' data-order-dir = 'desc'>FECHA</th>
                  <th class="table-column-title">SEDE</th>
                  <th class="table-column-title">ESTATUS</th>
                  <th class="table-column-title">TOTAL CARTA DE COBRO</th>
                  <th class="table-column-title">ACCIONES</th>
                </tr>
              </tfoot>
              <tbody> </tbody>
            </table>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
            <legend>Cartas de cobro aprobadas sin liquidar</legend>
            <table class="table table-hover table-responsive" id="cuentasPorPagar" >
              <thead>
                <tr class="table-header">
                  <th class="table-column-title ordenar" data-order = '0' data-order-dir = 'desc'>FECHA</th>
                  <th class="table-column-title">SEDE</th>
                  <th class="table-column-title">ESTATUS</th>
                  <th class="table-column-title">TOTAL CARTA DE COBRO</th>
                  <th class="table-column-title">TOTAL PAGADO</th>
                  <th class="table-column-title">TOTAL POR PAGAR</th>
                  <th class="table-column-title">ACCIONES</th>
                </tr>
              </thead>
              <tfoot>
                <tr class="table-header">
                  <th class="table-column-title ordenar" data-order = '0' data-order-dir = 'desc'>FECHA</th>
                  <th class="table-column-title">SEDE</th>
                  <th class="table-column-title">ESTATUS</th>
                  <th class="table-column-title">TOTAL CARTA DE COBRO</th>
                  <th class="table-column-title">TOTAL PAGADO</th>
                  <th class="table-column-title">TOTAL POR PAGAR</th>
                  <th class="table-column-title">ACCIONES</th>
                </tr>
              </tfoot>
              <tbody> </tbody>
            </table>
          </div>
          <legend><abbr title = 'El balance del cliente es la diferencia entre los adeudos de Cartas de Cobro aprobadas y los montos de Cobros aprobados.'>Balance del cliente</abbr></legend>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-cliente">
            <input type = 'text' disabled class = 'information-display' id = "balanceCliente"/>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container form-cliente">
          <legend>Datos del cobro</legend>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container form-cliente" hidden>
          <input type="text" class="form-control" disabled id="nombreCliente" placeholder="Seleccione un cliente">
        </div>

        <div class="col-xs-12 col-sm-6 col-md-6 input-container date-container form-ingreso form-cliente form-transferencia" hidden>
          <label class='label-fecha'>FECHA</label>
          <div class="input-group date form-ingreso form-cliente form-transferencia" id="fechaSelect"> <span class="input-group-addon">
              <i class="glyphicon glyphicon-calendar"></i>
          </span>
            <input type="text" class="form-control  date" required id="fechaSelectText"> </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 input-container form-ingreso form-cliente form-transferencia" hidden>
          <select class="selectpicker form-ingreso form-cliente form-transferencia" data-live-search="false" required id="idFormaPago" data-label="Forma de Pago"> </select>
        </div>

          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-ingreso form-cliente" hidden>
            <select class="selectpicker form-ingreso form-cliente" data-live-search="true" required id="idCuenta"> </select>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-transferencia" hidden>
            <select class="selectpicker form-transferencia" data-live-search="true" required id="idCuentaOrigen"> </select>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-transferencia" hidden>
            <select class="selectpicker form-transferencia" data-live-search="true" required id="idCuentaDestino"> </select>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-ingreso form-cliente form-transferencia" hidden>
            <input type="number" data-subtype="coin" class="form-control form-ingreso form-cliente form-transferencia" required id="cantidad" placeholder="Monto" name="Pago">
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-ingreso" hidden>
            <input type="text" class="form-control form-ingreso" required id="beneficiario" placeholder="Beneficiario">
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-ingreso form-cliente form-transferencia" hidden>
            <input type="text" class="form-control form-ingreso form-cliente form-transferencia" required id="concepto" placeholder="Concepto">
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-ingreso form-cliente form-transferencia" hidden>
            <input type="text" class="form-control form-ingreso form-cliente form-transferencia" id="referencia" placeholder="Referencia">
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-ingreso form-cliente form-transferencia " hidden>
            <input type="text" class="form-control form-ingreso form-cliente form-transferencia" id="comentarios" placeholder="Comentarios">
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-ingreso form-transferencia form-cliente" hidden>
            Aprobar ingreso al crear?
            <input type="checkbox" id="aprobar" class='form-input form-cliente form-ingreso form-transferencia switcher'> </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 input-container spec">
            <button style = "display:none" type="button" class="btn btn-save form-ingreso" data-form="form-ingreso"
             data-script="agregarIngreso" data-function="afterEdit" data-clear="true" id="agregarIngreso">capturar ingreso</button>
            <button style = "display:none" type="button" class="btn btn-save form-cliente" data-form="form-cliente"
             data-script="agregarPagoCliente" data-function="afterEdit" data-clear="true" id="agregarIngresoCliente">capturar ingreso</button>
            <button style = "display:none" type="button" class="btn btn-save form-transferencia" data-form="form-transferencia"
             data-script="agregarTransferencia" data-function="afterEdit" data-clear="true" id="agregarTransferencia">capturar ingreso</button>
          </div>
      </fieldset>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="modalGenerarReciboPago">
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
            <div class="text-container"> GENERAR RECIBO DE PAGO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <div class="text-container-subtitle">¿Desea generar un recibo de pago?</div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="jumbotron jumbotron-container">
                <div class="jumbotron-text"> DATOS DEL PAGO </div>
              </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Fecha:</label>
              <input type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="fechaRP">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Cliente:</label>
              <input type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="nombreClienteRP">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Monto:</label>
              <input type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="montoRP">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Forma de Pago:</label>
              <input type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="formaPagoRP">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Concepto:</label>
              <input type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="conceptoRP">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="col-xs-12 col-sm-12 col-md-6 input-container">
              <button type="button" class="btn btn-pdf" id="generarPdf">GENERAR RECIBO DE PAGO</button>
              <button data-dismiss="modal" type="button" class="btn btn-cancel" id="generarPdf">NO, GRACIAS</button>
          </div>
          Pueden generar el recibo de pago en cualquier momento dentro de INGRESOS -> RECIBOS DE PAGO.
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" tabindex="-1" role="dialog" id="nuevaCC">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content contenidoNuevaCC">
       
      </div>
    </div>
</div>

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

            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="jumbotron jumbotron-container">
                <div class="jumbotron-text"> AGREGAR CONCEPTOS </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <select class="selectpicker concepto-input" data-live-search="true" required id="idAlumnoConcepto"> </select>
            </div>
            <div class="row col-xs-12 col-sm-12 col-md-12 input-container">
            <div class="col-xs-2 col-sm-2 col-md-2">
            <select class="selectpicker concepto-input" data-subtext-name="precioUnitario" data-live-search="true" required data-label="Conceptos" id="conceptoSearch" name='Concepto' data-required-message=" un concepto" data-id='idConcepto' data-value='concepto' data-name="Conceptos"> </select>
            </div>
            <div class="col-xs-offset-4 col-sm-offset-4 col-md-offset-4">
            <div class="row">
            <label class='label-total-recibo col-md-1 hidden' id="label_recargo">Total</label>
            <input type="text" readOnly class="information-display col-md-2 hidden" id="total_a_pagar"/>
            <label class='label-recargo_porc-recibo col-md-3 hidden' id="input_recargo">% De Recargo</label>
            <input type="number" class="information-display col-md-2 hidden" id="porcentaje_recargo" min="0" value="0"/>
            <label class='label-recargo-recibo col-md-2 hidden' id="label2_recargo">Recargo</label>
            <input type="number" readOnly class="information-display col-md-2 hidden" id="recargo_total" min="0" value="0"/>
            </div>
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <input type="number" class="form-control concepto-input" required data-label="Cantidad" id="cantidadConcepto" name='Cantidad' data-required-message=" una cantidad" data-id='cantidad' data-value='cantidad' data-name="Cantidad" placeholder="Cantidad"> </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <input type="number" class="form-control concepto-input" required value = '0' data-label="Descuento" name='Descuento' data-id='descuento' data-value='descuento' data-name="Descuento" placeholder="Descuento" min="0" max="100" placeholder="Descuento" id="descuento"> </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <button type="button" class="btn btn-save" data-form="form-concepto" data-script="agregarConceptoReciboPago"
               data-function = 'resetEverything' data-clear="false" id="generarReciboCobrar">AGREGAR CONCEPTO</button>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
              <table class="table table-hover table-responsive" required data-unique = 'idAlumno,idConcepto,idReciboPagoLista' id="detallesRecibo">
                <thead>
                  <tr class="table-header">
                    <th class="table-column-title">FECHA</th>
                    <th class="table-column-title">CANTIDAD</th>
                    <th class="table-column-title">CONCEPTO</th>
                    <th class="table-column-title">ALUMNO</th>
                    <th class="table-column-title">PRECIO</th>
                    <th class="table-column-title">DESCUENTO (%)</th>
                    <th class="table-column-title">TOTAL</th>
                    <th class="table-column-title">ACCIONES</th>
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
                    <th class="table-column-title">ACCIONES</th>
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
              <input type="number" data-min = "0" data-max="100" class="input-group col-xs-8 col-sm-8 col-md-8" id="descuentoRecibo">
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

  <div class="modal fade" tabindex="-1" role="dialog" id="modalPorCobrar">
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
          <button class="btn btn-close" id="closeDetalles">CERRAR</button>
        </div>
      </div>
    </div>
  </div>

  <?php include 'templates/bottom.php'; ?>
    <script>
       $('.generaNuevaCC').click(function () {
        $.post("ajax/ajaxNuevaCC.php", {accion:'nuevaCartaCobro', cliente:''}).done(function(x){$('.contenidoNuevaCC').html(x);});
       });

      $(document).ready(function () {
        //Csser.collapse(3, 1);
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


        Utilizer.loadSelect('idFormaPago', 'formaPagoSelect', 'Forma de Pago');

        Utilizer.loadSelect('conceptoSearch','conceptoSelect', 'Concepto');

        //Desde aquí
        Utilizer.loadSelect('idCliente', 'clienteSelect', 'Cliente', {}, afterLoadCliente);
        Utilizer.loadSelect('idAlumno', 'selectAlumnoIdCliente', 'Alumno');

        $("#idCliente,#idAlumno").change(function (){
          if($(this).attr('id')=="idAlumno"){
            Utilizer.setPicker('idCliente', Utilizer.getSelected('idAlumno').data('cliente'));
          }else{
            Utilizer.setPicker('idAlumno', '');
          }
        //} //Hasta aquí sin el comentario de la izquierda para buscar por alumno a un cliente
          $("#nombreCliente").val($(Utilizer.getSelected('idCliente')).text());
          getBalanceCliente();
          tableUtilities.loadScript('recibosVer', 'getRecibosCliente', {idCliente:$("#idCliente").val()}, agregarRecibo);
          tableUtilities.loadScript('cuentasPorPagar', 'clienteReciboPagoCobrar', {idCliente:$("#idCliente").val(), fechaInicial:'2017-01-01', fechaFinal:Utilizer.dateParseToDbDate(new Date()), todos:false}, addReciboPagar);
        });

        setBalanceCliente();
        Utilizer.loadSelect('idCuenta', 				'selectCuenta', 			'Cuenta', {}, setCuenta);
      	Utilizer.loadSelect('idCuentaOrigen', 	'selectCuenta', 			'Cuenta Origen');
      	Utilizer.loadSelect('idTipoIngreso', 		'selectTipoIngreso', 	'Tipo de Ingreso', {}, changeSelect);
        tableUtilities.createTable('recibosVer', ['fecha', 'sede', 'estatus', 'totalRecibo', 'acciones']);
        tableUtilities.createTable('cuentasPorPagar', ['fecha', 'sede', 'estatus', 'total', 'totalPagado', 'totalPorPagar', 'acciones']);
        tableUtilities.createTable('detallesRecibo', ['fecha','cantidad', 'concepto', 'alumno', 'precio', {
            key:'descuentoLista',
            validation:{
              min:0,
              max:100,
            },
            name: 'Descuento',
            type:'number',
            required:true,
            functions: {
              change: changeTotal
            }
        },
        {
            key:'totalLista',
            type:'display'
        }, 'acciones']);
        tableUtilities.addDrawEvent('detallesRecibo', recalcularSubtotal);

        function changeTotal(){
          var data = tableUtilities.getTableDataFromInput($(this));
          console.log(data);
          if($(this).val()>=0&&$(this).val()<=100){

            $("#"+$(this).data('table')+"totalLista"+$(this).data('uniqueId')).text(Utilizer.calcularSubtotal(data.precio, data.cantidad, $(this).val()));
            recalcularSubtotal();
          }
        }

        tableUtilities.createTable('detallesReciboDescuentosDetalles', ['cantidad', 'concepto', 'alumno', 'precio', 'descuentoLista', 'totalLista']);
        tableUtilities.createTable('detallesPagos', ['fechaAplicada', 'cantidadAplicada', 'pagoOriginal'])
        function recalcularSubtotal(){
            var data = tableUtilities.getTableData('detallesRecibo'), descuento = $("#descuentoRecibo").val(), total = 0;
            for(var i = 0;i<data.length;i++){
              if(data[i].totalLista=="-"){
                continue;
              }
                total += Number(data[i].totalLista);
            }

            $("#subTotalRecibo").val(Utilizer.numberToCoin(total));
            var totalRecibo = Utilizer.calcularSubtotal(total, 1, descuento);
            $("#totalRecibo").val(Utilizer.numberToCoin(totalRecibo));
        }

        $("#descuentoRecibo").change(recalcularSubtotal);
        $('#aprobarRecibo').on('click', aprobarRecibo);
        $('#borrarRecibo').on('click', borrarRecibo);

        $("#generarReciboCobrar").click(function (){
            if(FormEngine.validateForm('concepto-input')){
                var data = FormEngine.getFormData('concepto-input');
                //['cantidad', 'concepto', 'alumno', 'precio', 'descuentoLista', 'totalLista']
                //{idAlumnoConcepto: "311", conceptoSearch: "18", cantidadConcepto: "1", descuento: "0"}
                data.fecha = Utilizer.dateParseToDbDate(new Date()).substr(0,7);
                data.cantidad = data.cantidadConcepto;
                data.idConcepto = Number(data.conceptoSearch);
                data.idReciboPagoLista = "A";
                data.concepto = Utilizer.getSelected('conceptoSearch').text();
                data.descuentoLista = data.descuento;
                data.idAlumno = Number(data.idAlumnoConcepto);
                data.alumno = Utilizer.getSelected('idAlumnoConcepto').text();
                data.concepto=data.concepto.toUpperCase();
                console.log(data.concepto);
                if(data.concepto=="RECARGO")
                {
                  data.precio = $('#recargo_total').val();
                }
                else
                {
                  data.precio = Utilizer.getSelected('conceptoSearch').data('subtext');
                }
                data.totalLista = Utilizer.calcularSubtotal(data.precio, data.cantidad, data.descuentoLista);
                data.bd = false;
                if(!tableUtilities.isInTable('detallesRecibo', {idConcepto:data.idConcepto, idAlumno:data.idAlumno})){
                  tableUtilities.addRowDraw('detallesRecibo', data, [['Borrar', 'btn-danger', tableUtilities.borrarFila]]);
                  Messager.addAlertText('Agregar concepto','Concepto agregado', 's');
                }
            }
        });



        function changeSelect(){
          Utilizer.setPicker('idTipoIngreso', 1);
          Utilizer.setPicker('idTipoIngreso', 1);
          $("#idTipoIngreso").trigger("change");
        }



        function setCuenta(data){
          Utilizer.getResponse('getCuentaPrincipal', {}, setCuentaPrincipal);
        }

        function setCuentaPrincipal(data){
          if(data.length!=0){
            $("#idCuenta").data('default', data[0].idCuenta);
            Utilizer.setPicker('idCuenta', data[0].idCuenta);
          }
        }

        Utilizer.makeDatepicker('fechaSelect');

        Utilizer.setToggler("aprobar", "SI", "NO");

        $("#idCuentaOrigen").change(cargarDestino);
        $("#idCuentaDestino").change(cargarSaldoDestino);


        $("#idTipoIngreso").change(function (){
            var sel = Utilizer.getSelected('idTipoIngreso');
            //console.log($(sel).text());
            var clas = "";
            switch($(sel).text()){
              case 'Cobro cliente':
                clas = 'cliente';
              break;
              case 'Transferencia entre cuentas':
                clas = 'transferencia';
              break;
              default:
                clas = 'ingreso';
              break;
            }

            $(".input-container").each(function(){
              //console.log($(this));console.log($(this).parent().parent());
              if($(this).parent().parent().hasClass('modal-body')||$(this).parent().hasClass('modal-footer')){
                return;
              }

              if(!$(this).hasClass('spec')){
                $(this).hide();
              }
            });

            $(".btn-save").each(function(){
              if($(this).attr('id')!=='generarReciboCobrar'){
                $(this).hide();
              }
            });
            $(".form-"+clas).each(function(){
              $(this).show();
            });

        });


        	function cargarDestino(event){
        		var idC = $(event.target).val(), saldo = Utilizer.getSelected(event.target.id).data('saldo');
        		//$("#cantidad").data('max', saldo);
        		$("#saldoActualOrigen").html("Saldo: $"+saldo);
        		Utilizer.loadSelect('idCuentaDestino', 	'selectCuenta', 'Cuenta Destino', {}, disableDestino, idC);
        	}

        	function cargarSaldoDestino(event){
        		var idC = $(event.target).val(), saldo = Utilizer.getSelected(event.target.id).data('saldo');
        		$("#saldoActualDestino").html("Saldo: $"+saldo);
        	}

        	function disableDestino(extra){
        		Utilizer.disableSelectOption('idCuentaDestino', extra);
        	}

        FormEngine.setFormEngine('agregarIngreso');
        FormEngine.setFormEngine('agregarIngresoCliente');
        FormEngine.setFormEngine('agregarTransferencia');

        FormEngine.setWarningLabels('table');

        FormEngine.setWarningLabels('concepto-input');
        FormEngine.markRequired('concepto-input');
        //FormEngine.setFormEngine('generarReciboCobrar');

      });

      function aprobarRecibo() {
        if(FormEngine.validateObject($("#detallesRecibo")) && FormEngine.validateObject($("#descuentoRecibo"))) {
          var data = {};
          data.idReciboPago = $('#aprobarRecibo').val();
          data.listaRecibo = tableUtilities.getTableData('detallesRecibo', ['fecha', 'idAlumno', 'idConcepto', 'cantidad', 'idReciboPagoLista', 'descuentoLista']);
          for(var i = 0;i<data.listaRecibo.length;i++){
            if(data.listaRecibo[i].idConcepto=="A"){
              data.listaRecibo[i].idConcepto = "";
            }
            if(data.listaRecibo[i].idReciboPagoLista=="A"){
              data.listaRecibo[i].idReciboPagoLista = "";
            }
            data.listaRecibo[i].fecha = Utilizer.parseTextFechaToDbDate(data.listaRecibo[i].fecha);
          }
          data.descuentoRecibo = $("#descuentoRecibo").val();
          Utilizer.sendData('aprobarReciboPagoCambio', data,  afterAprobarRecibo);
        }
      }

      function afterAprobarRecibo(data, extra){
        tableUtilities.loadScript('recibosVer', 'getRecibosCliente', {idCliente:  $("#idCliente").val()}, agregarRecibo);
        tableUtilities.loadScript('cuentasPorPagar', 'clienteReciboPagoCobrar', {idCliente: $("#idCliente").val(), fechaInicial:'2017-01-01', fechaFinal:Utilizer.dateParseToDbDate(new Date()), todos:false}, addReciboPagar);
        getBalanceCliente();
        $("#modalRevisar").modal('hide');
      }

      function borrarRecibo() {
        var val = $('#borrarRecibo').val();
        Utilizer.sendData('borrarReciboCobro', {idReciboCobro:Number(val)}, afterAprobarRecibo);
      }


      function agregarRecibo(data){
             data.buttons = Array();
             data.totalPorPagar = data.totalRecibo - data.totalAplicado;
             if (data.folio === null) {
               data.folio = "Sin folio";
               data.estatus = "Sin aprobar";
               data.buttons.push(["Revisar", "btn-check", revisarReciboCobro]);
               //data.buttons.push(["Modificar descuentos", "btn-edit", descuentos]);
             }
             return data;
      }

      function addReciboPagar (data){
        data.buttons = Array();
        if(data.totalPagado==0){
          data.estatus = "Aprobado";
        }else{
          data.estatus = "Pagado parcialmente";
        }
        data.totalPorPagar = Number(data.total)-Number(data.totalPagado);
               data.buttons.push(["Detalles", "btn-check", revisarPorCobrar]);
        return data;
      }
      function revisarPorCobrar(event){
          data = tableUtilities.getDataFromEvent(event);
          $('#fechaDetalles').val(Utilizer.fechaDbParseToFecha(data.fecha));
          $('#clienteDetalles').val(data.cliente);
          $("#sedeDetalles").val(data.sede);
          $('#folioDetalles').val(data.folio);
          $('#totalReciboDetalles').val(Utilizer.numberToCoin(data.total));
          $('#descuentoReciboDetalles').val(Utilizer.numberToPercentage(data.descuento));
          $('#subTotalReciboDetalles').val(Utilizer.numberToCoin(Utilizer.coinToNumber(data.total)/(1-(Utilizer.percentageToNumber(data.descuento)/100))));
          tableUtilities.loadScript('detallesReciboDescuentosDetalles', 'getReciboCobroLista', {idReciboPago:data.idReciboPago}, agregarDetallesDescuento);
          tableUtilities.loadScript('detallesPagos', 'getReciboCobroListaPagos', {idReciboPago:data.idReciboPago}, agregarDetallesPagos)
          $("#modalPorCobrar").modal('show');
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


      function revisarReciboCobro(event) {
        data = tableUtilities.getDataFromEvent(event);
        //console.log('EVENT: ');
        $("#subTotalRecibo").val(data.subTotal);
        $("#descuentoRecibo").val(Number(data.descuento));
        $("#totalRecibo").val(data.totalRecibo);
        $('#modalRevisar').modal('show');
        //console.log(data);console.log("REVISAR RECIBO COBRO");console.log(data);
        Utilizer.getResponse('getReciboCobroLista', {idReciboPago:data.idReciboPago}, revisarReciboCobroAbrir,data);
      }



              function revisarReciboCobroAbrir(data, extra){
                console.log("revisarReciboCobroAbrir");console.log(data);
                Utilizer.loadSelect('idAlumnoConcepto', 'alumnoSelectFromCliente', 'Alumno',
                {idCliente:$("#idCliente").val()},
                 function () {
                   if($("#idAlumnoConcepto").find('option').length===2){
                        Utilizer.setPicker('idAlumnoConcepto', $("#idAlumnoConcepto").find('option').eq(1).val());
                   }else{
                    if($("#idAlumno").val()!==null) {
                        Utilizer.setPicker('idAlumnoConcepto', $("#idAlumno").val());
                    }
                  }
                });
                var actual, totalLista=0, subTotalCarta=0, descRecibo=0;
                tableUtilities.clearTable('detallesRecibo');
                for(var i=0; i<data.length; i++){
                  actual = data[i];
                  if(actual.idConcepto==null){
                    actual.idConcepto = "A";
                  }
                  if(actual.idReciboPagoLista===null){
                    actual.idReciboPagoLista = "A";
                  }
                  if(actual.idAlumnoGrupo===null&&actual.nombreConcepto!==null){
                      data.buttons = [['Borrar', 'btn-danger', tableUtilities.borrarFila]];
                  }else{
                    data.buttons = [['Borrar', 'btn-danger', tableUtilities.borrarFila]];
                  }
                  actual.totalLista = actual.cantidad * actual.precio * (1-actual.descuentoLista/100);
                  descRecibo = actual.descuentoRecibo;
                  subTotalCarta += actual.totalLista;
                  if(actual.precio==0){
                    actual.precio = "-";
                    actual.descuento = "-";
                    actual.totalLista = "-";
                    actual.descuentoLista = false;
                    data.buttons = [];
                  }
                  tableUtilities.addRow('detallesRecibo', actual, data.buttons);
                }

                tableUtilities.draw('detallesRecibo');
                //console.log(data.fecha);
                $('#fecha').val(Utilizer.fechaDbParseToFecha(extra.fecha));
                $('#cliente').val(extra.nombreCliente);
                $('#sede').val(extra.sede);
                $('#aprobarRecibo').val(extra.idReciboPago);
                $('#borrarRecibo').val(extra.idReciboPago);
              }


      function afterEdit(data, extra) {
          if(data.idPagoRecibido!==undefined){ //console.table(data);console.table(extra);
            $("#fechaRP").val(Utilizer.fechaDbParseToFecha(data.fechaSelect));
            $("#nombreClienteRP").val(Utilizer.getOptionByValue('idCliente', data.idCliente).text());
            $("#montoRP").val(Utilizer.numberToCoin(data.cantidad));
            $("#formaPagoRP").val(extra.idFormaPago);
            $("#conceptoRP").val(data.concepto);
            $("#generarPdf").data('idPagoRecibido', data.idPagoRecibido);
            $("#modalGenerarReciboPago").modal('show');
          }

          tableUtilities.clearTable('cuentasPorPagar');
          tableUtilities.clearTable('recibosVer');

          Utilizer.setPicker('idCliente', '');
          Utilizer.setPicker('idAlumno', '');
          $("#idCliente").val(undefined);
          $("#nombreCliente").val("");
          getBalanceCliente();
      }

      function getBalanceCliente(){
        if($("#idCliente").val()===undefined){
            setBalanceCliente();
        }else{
            Utilizer.getResponse('getBalanceCliente',
            {idCliente:$("#idCliente").val()}, setBalanceCliente);
        }

      }

      function setBalanceCliente(data){
        //console.log("setBalanceCliente");console.log(data);
        if(data!==undefined&&$.isNumeric(data)){
          num = data;
        }else{
          num = 0;
        }
        $("#balanceCliente").val(Utilizer.numberToCoin(num));
      }

      $("#idFormaPago").change(function (){
          var sel = Utilizer.getSelected('idFormaPago');
          if(sel.text()=="Efectivo"){
              Utilizer.setTogglerValue('aprobar', true);
          }else{
              Utilizer.setTogglerValue('aprobar', false);
          }
      });

      $("#generarPdf").click(function (){
        var data = {};
        if($(this).data('idPagoRecibido')===undefined){
          return;
        }
        data.type = 'recibospagoacademias';
        data.params = {};
        data.params.idPagoRecibido = $(this).data('idPagoRecibido');
        data.www = "Pollo";
        Utilizer.makePdf(data, afterMakePdf, data);
      });

      function afterMakePdf(data, extra){
        Utilizer.SaveToDisk('pdfedit/pdf/recibospagoacademias'+extra.params.idPagoRecibido+".pdf", "recibospagoacademias"+extra.params.idPagoRecibido+".pdf");
      }
      </script>
<script>
      $(document).ready(function ()
       {
          $("[name='Concepto']").change(function()
          {
            var combo = document.getElementById("conceptoSearch");
            var selected = combo.options[combo.selectedIndex].text;
            var concepto = selected.toUpperCase();
            if(concepto=="RECARGO")
            {
              $('#label_recargo').removeClass("hidden");
              $('#total_a_pagar').removeClass("hidden");
              $('#input_recargo').removeClass("hidden");
              $('#porcentaje_recargo').removeClass("hidden");
              $('#label2_recargo').removeClass("hidden");
              $('#recargo_total').removeClass("hidden");
              var total=document.getElementById("totalRecibo").value;
              $('#total_a_pagar').val(total);
            }
            else
            {
              $('#label_recargo').addClass("hidden");
              $('#total_a_pagar').addClass("hidden");
              $('#input_recargo').addClass("hidden");
              $('#porcentaje_recargo').addClass("hidden");
              $('#label2_recargo').addClass("hidden");
              $('#recargo_total').addClass("hidden");
              $('#total_a_pagar').val(0);
              $('#porcentaje_recargo').val(0);
              $('#recargo_total').val(0);
            }
          });
          $('#porcentaje_recargo').change(function()
          {
            var total_a_pagar = Utilizer.coinToNumber($('#total_a_pagar').val());
            var porcentaje = $(this).val();
            $('#recargo_total,#cantidadConcepto').val(Utilizer.calcularSubtotal(total_a_pagar, 1, 100-Number(porcentaje)));

          });
       });

</script>
