<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-plus"></i> </div>
    <div class="text-container"> RECIBOS DE PAGO </div>
  </div>
  <div style="margin-bottom:10px;" class="totalBox"><table><tbody>
        <tr><td class="col-xs-8 col-sm-6 col-md-4"><label style="margin-bottom:0px;">TOTAL FILTRADO:</label></td>
          <td class="totalFiltrado" class="col-xs-2 col-sm-6 col-md-8"></td></tr></tbody></table>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="ingresoVerCliente" >
      <thead>

        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">FOLIO</th>
          <th class="table-column-title">CLIENTE</th>
          <th class="table-column-title">ALUMNO</th>
          <th class="table-column-title">FORMA DE PAGO</th>
          <th class="table-column-title">CANTIDAD</th>
          <!--<th class="table-column-title">CANTIDAD APLICADA</th>-->
          <th class="table-column-title">ESTADO</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">FOLIO</th>
          <th class="table-column-title">CLIENTE</th>
          <th class="table-column-title">ALUMNO</th>
          <th class="table-column-title">FORMA DE PAGO</th>
          <th class="table-column-title">CANTIDAD</th>
          <!--<th class="table-column-title">CANTIDAD APLICADA</th>-->
          <th class="table-column-title">ESTADO</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>

  <!-- /.modal -->
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        tableUtilities.createTable('ingresoVerCliente', ['fecha', 'folio', 'nombreCliente','nombreAlumnos', 'formaPago', 'cantidadCosto', 'estado', 'acciones'],
         ['nombreCliente', 'formaPago', 'estado']);
        tableUtilities.addFilterEvent('ingresoVerCliente', calcularTotal);

        function calcularTotal(){
          var data = tableUtilities.getFilteredRowsData('ingresoVerCliente');
          var totalFiltrado = 0;
          for(var i = 0;i<data.length;i++){
            totalFiltrado+= Number(data[i].cantidad);
          }
          $(".totalFiltrado").text(Utilizer.numberToCoin(totalFiltrado));
        }
        startTable();
      });

      function verMovimiento(event){
        var data = tableUtilities.getDataFromEvent(event);
        data.fecha2 = Utilizer.fechaDbParseToFecha(data.fecha);
        data.formaPagoD = data.formaPago;
        //console.log("VER MOVIMIENTOS");console.log(data);
        $("#idGastos").val("");
        $("#idIngresos").val("");
        Utilizer.fillForm(data);
        //console.log(data);
        $("#modalRevisarIngreso").modal('show');
      }

        function modalDetalles() {
          dataSend = tableUtilities.getDataFromEvent(event);
          var data = {};
          data.type = 'recibospagoacademias';
          data.params = {};
          data.params.idPagoRecibido = dataSend.idPagoRecibido;
          data.www = "Pollo";
          Utilizer.makePdf(data, afterMakePdf, data);
        }

        function afterMakePdf(data, extra){
          console.log(data);
          Utilizer.SaveToDisk('pdfedit/pdf/recibospagoacademias'+extra.params.idPagoRecibido+".pdf", 'recibospagoacademias'+extra.params.idPagoRecibido+".pdf");
        }

        function startTable(){
          tableUtilities.clearTable('ingresoVerCliente');
          tableUtilities.loadScript('ingresoVerCliente', 'getPagosRecibidosAdmin', {}, agregarIngreso);
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
          console.log(data);
          data.estado = data.aprobado===1?'Aprobado':data.aprobado===0?'No aprobado':'Cancelado';
          data.buttons = [["Generar Pdf", "btn-pdf", modalDetalles]];
          data.cantidadCosto = data.cantidad;
          data.nombreCliente = data.nombre;
          return data;
        }
      </script>
