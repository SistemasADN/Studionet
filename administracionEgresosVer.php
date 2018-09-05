<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-minus"></i> </div>
    <div class="text-container"> VER EGRESOS </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="egresoVer" data-pdf = true data-csv = true data-copy = true data-xls = true data-titulo = "Ver egresos" >
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
  <div class="modal fade" tabindex="-1" role="dialog" id="modalRevisarEgreso">
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
            <div class="text-container"> REVISAR EGRESO </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12 form-container">
                <legend class="custom-legend" style="text-align:center;"> ¿Qu&eacute; desea realizar a este egreso?</legend>
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
                <input id="idEgreso" type= "hidden" />
              </div>
            </fieldset>
          </div>
        </div>
        <div class="modal-footer">
          <div class="col-xs-12 col-sm-12 col-md-6 input-container">
            <button type="button" class="btn btn-approve" data-type = 'aprobar' data-form="form-input" data-clear="true" id="aprobarEgreso">APROBAR</button>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 input-container">
            <button type="button" class="btn btn-delete" data-type = 'borrar' data-form="form-input" data-clear="true" id="borrarEgreso">BORRAR</button>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container">
            <div class="text-container-subtitle">NOTA: Una vez aprobado el egreso, NO podrá ser borrado o editado posteriormente.</div>
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
        tableUtilities.createTable('egresoVer', ['fecha', 'movimiento', 'cuenta', 'beneficiario','concepto','cantidad','formaPago','referencia','comentario','acciones']);
        tableUtilities.createTable('egresoDetallesVer', ['fecha', 'folio', 'cantidadAplicadaDetalleCosto']);
        Utilizer.getResponse('movimientosSinAprobar', {}, loadTableMovimientos);
//        Utilizer.getResponse('movimientosSinAprobar', {}, loadTableMovimientos);
        	function loadTableMovimientos(data){
            $("#modalRevisarEgreso").modal('hide');
        		var keys = Object.keys(data);
        		tableUtilities.clearTable('egresoVer');
            console.log(data);
        		for(var j = 0;j<keys.length;j++){
        				var actual;
        				for(var i = 0;i<data[keys[j]].length;i++){
        					actual = data[keys[j]][i];
        					if(actual.tipo=='Ingreso'){
        						continue;
        					}
        					if(actual.beneficiarioCuenta!=null){
        						actual.beneficiario = actual.beneficiarioCuenta;
        					}else if (actual.nombreProfesor!=null){
                    actual.beneficiario = actual.nombreProfesor;
                  }
                  actual.cantidad = Utilizer.numberToCoin(actual.cantidad);
        					actual.fecha = Utilizer.fechaDbParseToFecha(actual.fecha);
        					tableUtilities.addRow('egresoVer', actual, [['VER DETALLES', 'ver btn-edit', verMovimiento]]);
        				}
        			}
        		tableUtilities.draw('egresoVer');
        	}


          $("#aprobarEgreso,#borrarEgreso").click(function(){
            var data = {};
            data.act = $(this).data('type');
            data.id = $("#idEgreso").val();
            data.tipo = 'egreso';
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
      });

      function verMovimiento(event){
        var data = tableUtilities.getDataFromEvent(event);
        data.fecha2 = Utilizer.fechaDbParseToFecha(data.fecha);
        data.formaPago2 = data.formaPago;
        $("#idGastos").val("");
        $("#idEgresos").val("");
        Utilizer.fillForm(data);
        console.log(data);
        $("#modalRevisarEgreso").modal('show');
      }
        function modalDetalles(data) {
          var data = tableUtilities.getDataFromEvent(event);
          tableUtilities.loadScript('egresoDetallesVer', 'getPagosRecibidosDetalles', {
            idPagoRecibido: data.idPagoRecibido
          }, agregarDetalles);
          $("#modalegresoDetalles").modal('show');
        }

        function agregarDetalles(data) {
          return data;
        }

        function agregarEgreso(data) {
          //console.log("DATA");
          //console.log(data);
          if (data.aprobado == 1) {
            data.estado = "APROBADO";
            data.buttons = [["Ver detalles", "btn-detail", modalDetalles]];
          }
          else {
            data.estado = "SIN APROBAR";
            data.buttons = [["Revisar", "btn-edit", modalRevisar]];
          }
          data.cantidadCosto = data.cantidad;
          data.nombreCliente = data.nombre;
          return data;
        }
      </script>
