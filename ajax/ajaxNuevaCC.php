<?php
if($_POST['accion']=='nuevaCartaCobro'){ ?>
 <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fa fa-times-circle"></i></span>
          </button>
        </div>

        <div class="modal-body container-fluid">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-search"></i> </div>
            <div class="text-container"> NUEVA CARTA DE COBRO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="jumbotron jumbotron-container">
                <div class="jumbotron-text"> DATOS </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Fecha:</label>
              <input type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="fechaX">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Cliente:</label>
              <input type="text" disabled max="100" class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="clienteX">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Sede:</label>
              <input type="text" disabled max="100" class="information-display input-group col-xs-8 col-sm-8 col-md-8" id="sedeX">
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="jumbotron jumbotron-container">
                <div class="jumbotron-text"> AGREGAR CONCEPTOS </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <select class="selectpicker concepto-input" data-live-search="true" required id="idAlumnoConceptoX"> </select>
            </div>
            <div class="row col-xs-12 col-sm-12 col-md-12 input-container">
            <div class="col-xs-2 col-sm-2 col-md-2">
            <select class="selectpicker concepto-input" data-subtext-name="precioUnitario" data-live-search="true" required data-label="Conceptos" id="conceptoSearchX" name='Concepto' data-required-message=" un concepto" data-id='idConcepto' data-value='concepto' data-name="Conceptos"> </select>
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
              <input type="number" class="form-control concepto-input" required data-label="Cantidad" id="cantidadConceptoX" name='Cantidad' data-required-message=" una cantidad" data-id='cantidad' data-value='cantidad' data-name="Cantidad" placeholder="Cantidad"> </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <input type="number" class="form-control concepto-input" required value = '0' data-label="Descuento" name='Descuento' data-id='descuento' data-value='descuento' data-name="Descuento" placeholder="Descuento" min="0" max="100" placeholder="Descuento" id="descuentoX"> </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <button type="button" class="btn btn-save" data-form="form-concepto" data-script="agregarConceptoReciboPago"
               data-function = 'resetEverything' data-clear="false" id="generarReciboCobrarX">AGREGAR CONCEPTO</button>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
              <table class="table table-hover table-responsive" required data-unique = 'idAlumno,idConcepto,idReciboPagoLista' id="detallesReciboX">
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
              <input type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" placeholder="Sub Total" id="subTotalReciboX">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Descuento de Recibo:</label>
              <input type="number" data-min = "0" data-max="100" class="input-group col-xs-8 col-sm-8 col-md-8" id="descuentoReciboX">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>TOTAL:</label>
               <input type="text" disabled class="information-display input-group col-xs-8 col-sm-8 col-md-8" placeholder="Total" id="totalReciboX">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="col-xs-12 col-sm-12 col-md-6 input-container">
              <button type="button" class="btn btn-approve" data-form="form-input" data-clear="true" id="aprobarReciboX">APROBAR</button>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 input-container">
              <button type="button" class="btn btn-delete" data-form="form-input" data-clear="true" id="borrarReciboX">BORRAR</button>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container">
            <div class="text-container-subtitle">NOTA: Una vez aprobado el recibo de cobro, NO podrá ser modificado o borrado posteriormente.</div>
          </div>
        </div>
<?php
}
?>
       