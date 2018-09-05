<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-plus"></i> </div>
    <div class="text-container"> RECIBOS DE NOMINA </div>
  </div>

    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        <button type="button" onClick = 'location.href = "catalogoPersonalVer.php";' class="btn btn-save">CATÁLOGO PERSONAL</button>
    </div>
  <div style="margin-bottom:10px;" class="totalBox"><table><tbody>
        <tr><td class="col-xs-8 col-sm-6 col-md-4"><label style="margin-bottom:0px;">TOTAL FILTRADO:</label></td>
          <td class="totalFiltrado" class="col-xs-2 col-sm-6 col-md-8"></td></tr></tbody></table>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="egresoVerRecibo">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">FOLIO</th>
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">TIPO DE PERSONAL</th>
          <th class="table-column-title">PERIODO PAGO (INICIO)</th>
          <th class="table-column-title">PERIODO PAGO (FIN)</th>
          <th class="table-column-title">FORMA DE PAGO</th>
          <th class="table-column-title">CANTIDAD</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">FECHA</th>
          <th class="table-column-title">FOLIO</th>
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">TIPO DE PERSONAL</th>
          <th class="table-column-title">PERIODO PAGO (INICIO)</th>
          <th class="table-column-title">PERIODO PAGO (FIN)</th>
          <th class="table-column-title">FORMA DE PAGO</th>
          <th class="table-column-title">CANTIDAD</th>
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
        tableUtilities.createTable('egresoVerRecibo', ['fecha', 'folio',
         'nombre', 'tipoPersonal', 'fechaInicio', 'fechaFin', 'formaPago', 'cantidadCosto', 'acciones'],
        ['nombre', 'tipoPersonal', 'fechaInicio', 'fechaFin', 'formaPago']);
        tableUtilities.addDrawEvent('egresoVerRecibo', calcularTotal);

        function calcularTotal(){
          var data = tableUtilities.getFilteredRowsData('egresoVerRecibo');
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
        $("#idGastos").val("");
        $("#idIngresos").val("");
        Utilizer.fillForm(data);
        $("#modalRevisarIngreso").modal('show');
      }

        function modalDetalles() {
          dataSend = tableUtilities.getDataFromEvent(event);
          var data = {};
          data.type = 'pagonomina';
          data.params = {};
          data.params.idEgreso = dataSend.idEgreso;
          data.www = "Pollo";
          Utilizer.makePdf(data, afterMakePdf, data);
        }

        function afterMakePdf(data, extra){
          Utilizer.SaveToDisk('pdfedit/pdf/pagonomina'+extra.params.idEgreso+".pdf", "pagonomina"+extra.params.idEgreso+".pdf");
        }

        function startTable(){
          tableUtilities.clearTable('egresoVerRecibo');
          tableUtilities.loadScript('egresoVerRecibo', 'getPagosNominaAprobados', {}, agregarIngreso);
        }


        function agregarIngreso(data) {
          if (data.aprobar == 1) {
            data.buttons = [["Generar Pdf", "btn-pdf", modalDetalles]];
          }
          data.cantidadCosto = data.cantidad;
          data.fecha = Utilizer.fechaDbParseToFecha(data.fecha);
          return data;
        }
      </script>
