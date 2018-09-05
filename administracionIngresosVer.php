
<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-plus"></i> </div>
    <div class="text-container"> VER INGRESOS </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <legend>Cobros de Clientes</legend>
    <div style="margin-bottom:10px;" class="totalBox"><table><tbody>
          <tr><td class="col-xs-8 col-sm-6 col-md-4"><label style="margin-bottom:0px;">TOTAL FILTRADO:</label></td>
            <td class="totalFiltrado" class="col-xs-2 col-sm-6 col-md-8"></td></tr></tbody></table>
    </div>
    <table class="table table-hover table-responsive" id="ingresoVerCliente" data-pdf = true data-csv = true data-copy = true data-xls = true data-titulo = "Ver Ingresos" >
      <thead>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">CLIENTE</th>
          <th class="table-column-title">ALUMNO</th>
          <th class="table-column-title">FOLIO</th>
          <th class="table-column-title">FORMA DE PAGO</th>
          <th class="table-column-title">CANTIDAD</th>
          <th class="table-column-title">CONCEPTO</th>
          <th class="table-column-title">ESTADO</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">CLIENTE</th>
          <th class="table-column-title">ALUMNO</th>
          <th class="table-column-title">FOLIO</th>
          <th class="table-column-title">FORMA DE PAGO</th>
          <th class="table-column-title">CANTIDAD</th>
          <th class="table-column-title">CONCEPTO</th>
          <th class="table-column-title">ESTADO</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <!---->

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <legend>Otros ingresos</legend>
    <table class="table table-hover table-responsive" id="ingresoVer">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">MOVIMIENTO</th>
          <th class="table-column-title">CUENTA</th>
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">CONCEPTO</th>
          <th class="table-column-title">CANTIDAD</th>
          <th class="table-column-title">FORMA DE PAGO</th>
          <th class="table-column-title">REFERENCIA</th>
         <th class="table-column-title">COMENTARIOS</th>
         <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">MOVIMIENTO</th>
          <th class="table-column-title">CUENTA</th>
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">CONCEPTO</th>
          <th class="table-column-title">CANTIDAD</th>
          <th class="table-column-title">FORMA DE PAGO</th>
          <th class="table-column-title">REFERENCIA</th>
         <th class="table-column-title">COMENTARIOS</th>
         <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>




  <!-- Modal Edit -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modalRevisarIngresoCliente">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-pencil-square-o"></i> </div>
            <div class="text-container"> REVISAR COBRO CLIENTE </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12 form-container">
                <legend class="custom-legend" style="text-align:center;"> ¿Qu&eacute; desea realizar a este ingreso?</legend>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 form-container">
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <label class='label-right col-xs-4 col-sm-4 col-md-4'>CLIENTE: </label>
                  <input type="text" class="col-xs-8 col-sm-8 col-md-8" id="nombreCliente" disabled value = "$0.00"/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <label class='label-right col-xs-4 col-sm-4 col-md-4'>FECHA: </label>
                  <input type="text" class="col-xs-8 col-sm-8 col-md-8" id="fecha" disabled value = "$0.00"/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <label class='label-right col-xs-4 col-sm-4 col-md-4'>FORMA DE PAGO: </label>
                  <input type="text" class="col-xs-8 col-sm-8 col-md-8" id="formaPagoD" disabled value = "$0.00"/>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <label class='label-right col-xs-4 col-sm-4 col-md-4'>CANTIDAD: </label>
                  <input type="text" class="col-xs-8 col-sm-8 col-md-8" id="cantidadCosto" disabled value = "$0.00"/>
                </div>
                <input id="idPagoRecibido" type= "hidden" />
              </div>
            </fieldset>
          </div>
        </div>
        <div class="modal-footer">
          <div class="col-xs-12 col-sm-12 col-md-6 input-container">
            <button type="button" class="btn btn-approve" data-form="form-input"
            data-clear="true" id="aprobarIngresoCliente">APROBAR cobro</button>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 input-container">
            <button type="button" class="btn btn-delete" data-form="form-input"
            data-clear="true" id="borrarIngresoCliente">CANCELAR cobro</button>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container">
            <div class="text-container-subtitle">NOTA: Una vez aprobado el cobro, <b>NO</b> podrá ser editado posteriormente.</div>
          </div>
        </div>
      <!-- /.modal-content -->
      </div>
    <!-- /.modal-dialog -->
    </div>
  <!-- /.modal -->
  </div>



  <!-- Modal Edit -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modalRevisarIngreso">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-pencil-square-o"></i> </div>
            <div class="text-container"> REVISAR INGRESO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12 form-container">
                <legend class="custom-legend" style="text-align:center;"> ¿Qu&eacute; desea realizar a este ingreso?</legend>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 form-container">

                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <label class='label-right col-xs-4 col-sm-4 col-md-4'>FECHA: </label>
                  <input type="text" class="col-xs-8 col-sm-8 col-md-8" id="fecha2" disabled value = ""/>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <label class='label-right col-xs-4 col-sm-4 col-md-4'>MOVIMIENTO: </label>
                  <input type="text" class="col-xs-8 col-sm-8 col-md-8" id="movimiento" disabled value = ""/>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <label class='label-right col-xs-4 col-sm-4 col-md-4'>CUENTA: </label>
                  <input type="text" class="col-xs-8 col-sm-8 col-md-8" id="cuenta" disabled value = ""/>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <label class='label-right col-xs-4 col-sm-4 col-md-4'>BENEFICIARIO: </label>
                  <input type="text" class="col-xs-8 col-sm-8 col-md-8" id="beneficiario" disabled value = ""/>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <label class='label-right col-xs-4 col-sm-4 col-md-4'>CONCEPTO: </label>
                  <input type="text" class="col-xs-8 col-sm-8 col-md-8" id="concepto" disabled value = ""/>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <label class='label-right col-xs-4 col-sm-4 col-md-4'>CANTIDAD: </label>
                  <input type="text" class="col-xs-8 col-sm-8 col-md-8" id="cantidad" disabled value = ""/>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <label class='label-right col-xs-4 col-sm-4 col-md-4'>FORMA DE PAGO: </label>
                  <input type="text" class="col-xs-8 col-sm-8 col-md-8" id="formaPago" disabled value = ""/>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <label class='label-right col-xs-4 col-sm-4 col-md-4'>REFERENCIA: </label>
                  <input type="text" class="col-xs-8 col-sm-8 col-md-8" id="referencia" disabled value = ""/>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <label class='label-right col-xs-4 col-sm-4 col-md-4'>COMENTARIO: </label>
                  <input type="text" class="col-xs-8 col-sm-8 col-md-8" id="comentario" disabled value = ""/>
                </div>
                <input id="idIngresos" type= "hidden" />
              </div>
            </fieldset>
          </div>
        </div>
        <div class="modal-footer">
          <div class="col-xs-12 col-sm-12 col-md-6 input-container">
            <button type="button" class="btn btn-approve" data-type = 'aprobar' data-form="form-input" data-clear="true" id="aprobarIngreso">APROBAR</button>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 input-container">
            <button type="button" class="btn btn-delete"
             data-type = 'borrar' data-form="form-input" data-clear="true" id="borrarIngreso">BORRAR</button>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container">
            <div class="text-container-subtitle">NOTA: Una vez aprobado el ingreso, <b>NO</b> podrá ser cancelado o editado posteriormente.</div>
          </div>
        </div>
      <!-- /.modal-content -->
      </div>
    <!-- /.modal-dialog -->
    </div>
  <!-- /.modal -->
  </div>





  <!-- /.modal -->
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(2);
        //tableUtilities.createTable('ingresoVerCliente', ['fecha', 'nombreCliente', 'formaPago', 'cantidadCosto', 'cantidadAplicadaCosto', 'estado', 'acciones'], ['formaPago']);
        tableUtilities.createTable('ingresoVerCliente', ['fecha', 'nombreCliente', 'nombreAlumnos', 'folio', 'formaPago', 'cantidadCosto', 'concepto', 'estado', 'acciones'],
         ['nombreCliente', 'nombreAlumnos', 'formaPago', 'concepto']);
        tableUtilities.createTable('ingresoVer', ['fecha', 'movimiento', 'cuenta', 'beneficiario','concepto','cantidad','formaPago','referencia','comentario','acciones']);
        //, 'cuenta', 'beneficiario', 'concepto', 'cantidad', 'formaPago', 'referencia','comentario', 'acciones']
        //tableUtilities.createTable('ingresoVer', ['fecha', 'tipoTipo', 'cuenta', 'beneficiario', 'concepto', 'cantidad', 'formaPago', 'referencia', 'comentario', 'acciones'], ['tipoTipo', 'concepto', 'cuenta', 'beneficiario', 'formaPago']);
        tableUtilities.addFilterEvent('ingresoVerCliente', calcularTotal);

        function calcularTotal(){
          var data = tableUtilities.getFilteredRowsData('ingresoVerCliente');
          var totalFiltrado = 0;
          for(var i = 0;i<data.length;i++){
            totalFiltrado+= Number(data[i].cantidad);
          }
          $(".totalFiltrado").text(Utilizer.numberToCoin(totalFiltrado));
        }

        tableUtilities.createTable('ingresoDetallesVer', ['fecha', 'folio', 'cantidadAplicadaDetalleCosto']);
        Utilizer.getResponse('movimientosSinAprobar', {}, loadTableMovimientos);
//        Utilizer.getResponse('movimientosSinAprobar', {}, loadTableMovimientos);

        startTable();
        $("#aprobarIngresoCliente").on("click", aprobarIngresoCliente);
        $("#borrarIngresoCliente").click(borrarIngresoCliente);


        	function loadTableMovimientos(data){
            $("#modalRevisarIngreso").modal('hide');
        		var keys = Object.keys(data);
        		tableUtilities.clearTable('ingresoVer');

        		for(var j = 0;j<keys.length;j++){
        				var actual;
        				for(var i = 0;i<data[keys[j]].length;i++){
        					actual = data[keys[j]][i];
        					if(actual.tipo=='Egreso'){
        						continue;
        					}
        					if(actual.beneficiarioCuenta!=null){
        						actual.beneficiario = actual.beneficiarioCuenta;
        					}
                  actual.cantidad = Utilizer.numberToCoin(actual.cantidad);
        					actual.fecha = Utilizer.fechaDbParseToFecha(actual.fecha);
        					tableUtilities.addRow('ingresoVer', actual, [['REVISAR', 'ver btn-edit', verMovimiento]]);
        				}
        			}
        		tableUtilities.draw('ingresoVer');
        	}


          $("#aprobarIngreso,#borrarIngreso").click(function(){
            var data = {};
            data.act = $(this).data('type');
            data.id = $("#idIngresos").val()==""?$("#idGastos").val():$("#idIngresos").val();
            data.tipo = $("#idIngresos").val()==""?'egreso':'ingreso';
            Utilizer.getResponse('aprobarBorrarMovimiento', data, aprobarBorrarTerminar);
          });

          function aprobarBorrarTerminar(data){
            console.log(data);
            data = data.split('|');
            switch(data[0]){
              case 's':
                Utilizer.getResponse('movimientosSinAprobar', {}, loadTableMovimientos);
              break;
            }
            Messager.addAlertText(data[1],data[2],data[0]);
          }

        function aprobarIngresoCliente(){
          var data = {};
          data.idPagoRecibido = $("#idPagoRecibido").val();
          Utilizer.getResponse('editarPagosRecibidos', data, afterAprobado, data);
        }

        function borrarIngresoCliente(){
          var data = {};
          data.idPagoRecibido = $("#idPagoRecibido").val();
          Utilizer.getResponse('eliminarIngreso', data, afterAprobado, data);
        }


        function afterAprobado(data, extra) {
          //console.log("AFTER APROBADO");console.log(data);
          data = data.split('|');
          Messager.addAlertText(data[1], data[2], data[0]);
          if (data[0] == "s") {
            $("#modalRevisarIngresoCliente").modal('hide');
            $("#modalRevisarIngreso").modal('hide');
            startTable();
          }
        }


      });

      function verMovimiento(event){
        var data = tableUtilities.getDataFromEvent(event);
        data.fecha2 = Utilizer.fechaDbParseToFecha(data.fecha);

        data.formaPagoD = data.formaPago;
        console.log("VER MOVIMIENTOS");
          console.log(data);
        $("#idGastos").val("");
        $("#idIngresos").val("");
        Utilizer.fillForm(data);
        console.log(data);
        $("#modalRevisarIngreso").modal('show');
      }
        function modalDetalles(data) {
          var data = tableUtilities.getDataFromEvent(event);
          tableUtilities.loadScript('ingresoDetallesVer', 'getPagosRecibidosDetalles', {
            idPagoRecibido: data.idPagoRecibido
          }, agregarDetalles);
          $("#modalRevisarIngreso").modal('show');
        }
        function startTable(){
          tableUtilities.clearTable('ingresoVerCliente');
          tableUtilities.loadScript('ingresoVerCliente', 'getPagosRecibidos', {}, agregarIngreso);
        }

        function agregarDetalles(data) {
          return data;
        }

        function modalRevisar() {

          var data = tableUtilities.getDataFromEvent(event);
          console.log(data);
          data.cantidadCosto = Utilizer.numberToCoin(data.cantidadCosto);
          data.fecha = Utilizer.fechaDbParseToFecha(data.fecha);
          data.formaPagoD = data.formaPago;
          Utilizer.fillForm(data);
          $("#modalRevisarIngresoCliente").modal('show');
        }

        function agregarIngreso(data) {
          //console.log("DATA");
          //console.log(data);
          if (data.aprobado == 1) {
            data.estado = "APROBADO";
            data.buttons = [["Ver detalles", "btn-detail", modalDetalles]];
          }
          else {
            data.estado = "SIN APROBAR";
            data.buttons = [["Revisar", "revisar btn-edit", modalRevisar]];
          }
          data.cantidadCosto = data.cantidad;
          data.nombreCliente = data.nombre;
          
          return data;
        }
      </script>
