<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-ticket"></i> </div>
    <div class="text-container"> GENERAR CARTA DE COBRO </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"><abbr title = 'Al seleccionar un alumno, automáticamente seleccionará al cliente, sin embargo, lo mismo no sucede a la inversa.'>FECHA Y CLIENTE/ALUMNO</abbr></div>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 input-container date-container">
          <label class='label-fecha-recibo col-xs-2 col-sm-2 col-md-3'>FECHA:</label>
          <div class="input-group date col-xs-10 col-sm-10 col-md-8 form-input" id="fechaSelect"> <span class="input-group-addon">
              <i class="glyphicon glyphicon-calendar"></i>
          </span>
            <input type="text" class="form-control form-input date" data-label="fecha" id="fechaSelectText" name='fecha' data-required-message=" una fecha" data-id='fechaSelectText' data-value='fecha' data-name="Fecha"> </div>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1 input-container"></div>
        <div class="col-xs-5 col-sm-5 col-md-5 input-container">
          <select class="selectpicker" data-live-search="true" required data-label="Cliente" id="idClienteSelect" name='Cliente' data-required-message=" un cliente" data-id='idCliente' data-value='cliente' data-name="Cliente"> </select>
        </div>
        <div class="col-xs-5 col-sm-5 col-md-5 input-container">
          <select class="selectpicker" data-live-search="true" data-label="Cliente" id="idAlumno" name='Alumno' data-required-message=" un cliente" data-id='idCliente' data-value='cliente' data-name="Cliente"> </select>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container" style="margin-top:20px;">
          <table class="table table-hover table-responsive table-input" required
           data-required-message = 'un alumno' data-unique = 'idAlumno'
           data-selected = 'selected'
           data-keys = 'idAlumno,alumno' id="listaAlumnos">
            <thead>
              <tr class="table-header">
                <th class="table-column-title"></th>
                <th class="table-column-title">ALUMNO</th>
              </tr>
            </thead>
            <tfoot>
              <tr class="table-header">
                <th class="table-column-title"></th>
                <th class="table-column-title">ALUMNO</th>
              </tr>
            </tfoot>
            <tbody> </tbody>
          </table>
        </div>


        <div class="col-xs-1 col-sm-1 col-md-1 input-container"></div>
        <input type = 'hidden' class = 'form-input' required id = 'idCliente' />
        <label class= 'col-xs-2 col-sm-2 col-md-3 label-right' style = 'margin-top:10px'>BALANCE CLIENTE:</label>
        <div class="col-xs-10 col-sm-10 col-md-9 input-container">
          <input type = 'text' disabled class = 'information-display' id = "balanceCliente"/>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> AGREGAR CONCEPTOS A RECIBO </div>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <select class="selectpicker table-input" data-subtext-name="precioUnitario" data-live-search="true" required data-label="Conceptos" id="idConcepto" name='Concepto' data-required-message=" un concepto" data-id='idConcepto' data-value='concepto' data-name="Conceptos"> </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="number" class="form-control table-input" required data-label="Cantidad" id="cantidad" value = 1 name='Cantidad' data-required-message=" una cantidad" data-id='cantidad' data-value='cantidad' data-name="Cantidad" placeholder="Cantidad"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="number" class="form-control table-input" data-label="Descuento" name='Descuento' data-id='descuento' data-value='descuento' data-name="Descuento" placeholder="Descuento" min="0" max="100" placeholder="Descuento" id="descuento"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save table-input" data-form="table-input" data-clear="true" id="reciboCobroAdd">Agregar CONCEPTO(S)</button>
        </div>
      </fieldset>
    </div>
  </div>


  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container" style="margin-top:20px;">
    <table class="table table-hover table-responsive list-input form-input"
      data-afterinsert="recalcularTotales"
      data-format="agregarConcepto"
      data-keys="cantidad,idConcepto,precioUnitario,descuento,idAlumno"
      data-unique = 'idConcepto,idAlumno'
     id="reciboCobro">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">CANTIDAD</th>
          <th class="table-column-title">CONCEPTO</th>
          <th class="table-column-title">ALUMNO</th>
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
          <th class="table-column-title">ALUMNO</th>
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
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> TOTALES </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" disabled class="form-control" required placeholder="Sub Total" id="subTotalTabla"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="number" max="100" class="form-control form-input list-input" placeholder="Descuento al Total de Recibo" id="descuentoTabla"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" disabled class="form-control" required placeholder="TOTAL" id="totalTabla"> </div>
        <label class= 'col-xs-2 col-sm-2 col-md-3 label-right label-switcher'>CREAR Y FOLIAR?</label>
        <div class="col-xs-10 col-sm-10 col-md-9 input-container">
          <input type="checkbox" id="conFolio" class='form-input switcher'> </div>

        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-form="form-input" data-script="generarReciboCobro"
           data-function = 'resetEverything' data-clear="false" id="generarReciboCobrar">GENERAR CARTA DE COBRO</button>
        </div>
        <form action = "administracionIngresosCapturar.php" method = "POST">
        <div class="col-xs-12col-sm-12 col-md-12 input-container" id = "afterGenerar" hidden>
          <input type = 'hidden' name = 'idCliente' id = "idClienteGenerar"/>
          <input type="submit" class="btn btn-save" id = "generarIngreso" value = ""/>
        </div>
        </form>
      </fieldset>
    </div>
  </div>







  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(0, 1);
        tableUtilities.createTable('reciboCobro', [{
          key:'cantidad',
          type:'display'
        }, 'concepto', 'alumno', {
          key:'precioUnitario',
          type:'display'
        }, {
          key:'subTotal',
          type:'display'
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
              change: calcularSubtotal
            },
         }, {
          key:'totalConDescuento',
          type:'display'
        }, 'acciones']);

        tableUtilities.createTable('listaAlumnos', [{
            key:'selected',
            type:'table-checkbox',
          }, 'alumno']);

        tableUtilities.setUniqueColumns('reciboCobro', ['idConcepto']);

        tableUtilities.initializeTableEngine('reciboCobro');
        //ListEngine.initializeListEngine('generarReciboCobrar');
        FormEngine.setFormEngine('generarReciboCobrar');

        tableUtilities.addDrawEvent('reciboCobro', recalcularTotales);
        Utilizer.setToggler("conFolio", "SI", "NO");
        Utilizer.makeDatepicker('fechaSelect');
        Utilizer.loadSelect('idConcepto','conceptoSelect', 'Concepto');
        Utilizer.loadSelect('idClienteSelect', 'clienteSelect', 'Cliente', {},afterLoadCliente, false, true);
        Utilizer.loadSelect('idAlumno', 'selectAlumnoIdCliente', 'Alumno');
        $("#balanceCliente").val(Utilizer.numberToCoin(0));
        $("#descuentoTabla").on('change', calcularTotal);

        $("#idClienteSelect,#idAlumno").change(function (){

          $("#afterGenerar").hide();
          $("#idClienteGenerar").val('');
          if($(this).attr('id')=="idAlumno"){
            Utilizer.setPicker('idClienteSelect', Utilizer.getSelected('idAlumno').data('cliente'));
          }else{
            Utilizer.setPicker('idAlumno', '');
          }

          var selected = Utilizer.getSelected($(this).attr('id')), al = Utilizer.getSelected('idAlumno');
          //console.log($(selected).data());
          tableUtilities.clearTable('listaAlumnos');
          var listaAlumnos = $("#idAlumno option"), alumnos = [];
          for(var i = 0;i<listaAlumnos.length;i++){
            if($(listaAlumnos[i]).data('cliente')==$("#idClienteSelect").val()) {
              alumnos.push({
                id:$(listaAlumnos[i]).val(),
                nombre:$(listaAlumnos[i]).text()
              });
            }
          }
          console.log(alumnos);
          var actual = {};
          for(var i = 0;i<alumnos.length;i++){
            actual = {selected:false, idAlumno:alumnos[i].id, alumno:alumnos[i].nombre};
            if(actual.idAlumno==al.data('idAlumno')){
              actual.selected = true;
            }
            tableUtilities.addRow('listaAlumnos', actual);
          }
          tableUtilities.draw('listaAlumnos');

          $("#balanceCliente").val(Utilizer.numberToCoin($(selected).data('balance')));
          $("#idCliente").val($('#idClienteSelect').val());
        });
      });
      function afterLoadCliente ()
      {
        if(<?php
          if(isset($_POST['idClienteSelect'])){
            echo "true";
          }else{
            echo "false";
          }
        ?>) {
              Utilizer.setPicker('idClienteSelect', <?php
              if(isset($_POST['idClienteSelect'])){
                echo $_POST['idClienteSelect'];
              }else{
                echo "''";
              }
              ?>);
              Utilizer.setPicker('idClienteSelect', <?php
              if(isset($_POST['idClienteSelect'])){
                echo $_POST['idClienteSelect'];
              }else{
                echo "''";
              }
              ?>);
              $("#idClienteSelect").trigger('change');
            }
      }
      function agregarConcepto(data) {
        console.log(data);
        data.precioUnitario = data.idConceptosubtext;
        data.subTotal = Number(data.cantidad) * Number(data.precioUnitario);
        data.totalConDescuento = Number(data.subTotal) * (1 - Number(data.descuento) / 100);
        data.precioUnitario = Number(data.precioUnitario);
        if (data.descuento == "") {
          data.descuento = 0;
        }
        return data;
      }

      function calcularSubtotalTabla(tableData) {
        var subtotal = 0;
        for (var i = 0; i < tableData.length; i++) {
          var actual = tableData[i];
          subtotal += Utilizer.coinToNumber(actual.totalConDescuento);
        }
        $("#subTotalTabla").val(Utilizer.numberToCoin(subtotal));
        calcularTotal();
      }

      function calcularTotal() {
        var subtotal = Utilizer.coinToNumber($('#subTotalTabla').val());
        var desc = $('#descuentoTabla').val();
        var total = Utilizer.numberToCoin((subtotal * (1 - desc / 100)).toFixed(2));
        $("#totalTabla").val(total);
      }

      function recalcularTotales() {
        if (tableUtilities.isEmpty('reciboCobro')) {
          Utilizer.selectPickerEnable('idClienteSelect');
          Utilizer.selectPickerEnable('idAlumno');
        }
        else {
          Utilizer.selectPickerDisable('idClienteSelect');
          Utilizer.selectPickerDisable('idAlumno');
        }
        //console.log(tableUtilities.getTableData('reciboCobro'));
        calcularSubtotalTabla(tableUtilities.getTableData('reciboCobro'));
      }

      function resetEverything(){
          var sel = Utilizer.getOptionByValue('idClienteSelect', $("#idCliente").val());
          $("#idClienteGenerar").val($("#idCliente").val());
          tableUtilities.clearTable('listaAlumnos');
          $("#generarIngreso").val("GENERAR INGRESO PARA "+$(sel).text());
          $("#afterGenerar").show();

          Utilizer.selectPickerEnable('idClienteSelect');
          Utilizer.selectPickerEnable('idAlumno');
          Utilizer.setPicker('idClienteSelect', '');
          Utilizer.setPicker('idConcepto', '');
          $("#cantidad").val(1);
          $("#descuento").val("");
          tableUtilities.clearTable('reciboCobro');
          $("#subTotalTabla").val('');
          $("#descuentoTabla").val('');
          $("#totalTabla").val('');
          $("#balanceCliente").val(Utilizer.numberToCoin(0));
          Utilizer.makeDatepicker('fechaSelect');
      }
      function calcularSubtotal(){
        console.log("CALCULAR SUBTOTAL");
        var cantidad = tableUtilities.getRowValueFromObject(this, 'cantidad'),
        descuento = tableUtilities.getRowValueFromObject(this, 'descuento'),
        precio = tableUtilities.getRowValueFromObject(this, 'precioUnitario');
        tableUtilities.setRowValueFromObject(this, 'subTotal', precio*cantidad);
        tableUtilities.setRowValueFromObject(this, 'totalConDescuento', Utilizer.calcularSubtotal(precio, cantidad, descuento));
        recalcularTotales();
      }

    </script>
