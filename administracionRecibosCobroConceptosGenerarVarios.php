<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-ticket"></i> </div>
    <div class="text-container"> GENERAR VARIAS CARTAS DE COBRO </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"><abbr title = 'Asigne la fecha y seleccione una clase, asignatura, disciplina o nivel por el cual desea generar su carta de cobro'>FECHA Y SELECCIÓN</abbr></div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container date-container">
          <label class='label-fecha-recibo col-xs-2 col-sm-2 col-md-3'>FECHA:</label>
          <div class="input-group date col-xs-10 col-sm-10 col-md-8 form-input" id="fechaSelect"></div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 input-container date-container">
          <label class='col-xs-2 col-sm-2 col-md-2'>SELECCIONE UNA CLASE, ASIGNATURA, DISCIPLINA O NIVEL</label>
          <div class='col-xs-5 col-sm-5 col-md-5'>
              <select class="selectpicker choice" data-live-search="true" id="idGrupo"></select>
              <select class="selectpicker choice" data-live-search="true" id="idAsignatura"></select>
          </div>
          <div class='col-xs-5 col-sm-5 col-md-5'>
              <select class="selectpicker choice" data-live-search="true" id="idDisciplina"></select>
              <select class="selectpicker choice" data-live-search="true" id="idNivel"></select>
          </div>
        </div>
        <button type="button" class="btn btn-save"  id="listaAlumnos">Ver lista de alumnos</button>


        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"><abbr title = 'Elija el o los conceptos con los que desea generar su carta de cobro'>AGREGAR CONCEPTOS</abbr></div>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <select class="selectpicker table-input" data-subtext-name="precioUnitario" data-live-search="true" required data-label="Conceptos" id="idConcepto" name='Concepto' data-required-message=" un concepto" data-id='idConcepto' data-value='concepto' data-name="Conceptos"> </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="number" class="form-control table-input" required data-label="Cantidad" id="cantidad" name='Cantidad' data-required-message=" una cantidad" data-id='cantidad' data-value='cantidad' data-name="Cantidad" placeholder="Cantidad"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="number" class="form-control table-input" data-label="Descuento" name='Descuento' data-id='descuento' data-value='descuento' data-name="Descuento" placeholder="Descuento" min="0" max="100" placeholder="Descuento" id="descuento"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save table-input" data-form="table-input" data-clear="true" id="reciboCobroAdd">Agregar concepto</button>
        </div>
      </fieldset>
    </div>
  </div>


  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container" style="margin-top:20px;">
    <table class="table table-hover table-responsive list-input form-input"
    required
    data-afterinsert="recalcularTotales"
    data-format="agregarConcepto"
    data-unique = 'idConcepto'
    data-keys="cantidad,idConcepto,precioUnitario,descuento" id="reciboCobro">
      <thead>
        <tr class="table-header">
          <th class="table-column-title">CANTIDAD</th>
          <th class="table-column-title">CONCEPTO</th>
          <th class="table-column-title coin">PRECIO UNITARIO</th>
          <th class="table-column-title coin">SUBTOTAL</th>
          <th class="table-column-title">DESCUENTO (%)</th>
          <th class="table-column-title coin">TOTAL CON DESCUENTO</th>
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
          <input type="number" max="100" class="form-control form-input list-input" placeholder="Descuento al Total" id="descuentoTabla"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" disabled class="form-control" required placeholder="TOTAL" id="totalTabla"> </div>
        <label class= 'col-xs-2 col-sm-2 col-md-3 label-right label-switcher'>CREAR Y FOLIAR?</label>
        <div class="col-xs-10 col-sm-10 col-md-9 input-container">
          <input type="checkbox" id="conFolio" class='form-input switcher'> </div>
          <input class = 'form-input' required type = 'hidden' id = "tipo"/>
          <input class = 'form-input' required type = 'hidden' id = "tipoId"/>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-form="form-input" data-script="generarVariosReciboCobro"
           data-function = 'resetEverything' data-clear="false" id="generarReciboCobrar">GENERAR carta de cobro</button>
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

  <div class="modal fade" tabindex="-1" role="dialog" id="modalListaAlumnos">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-user-circle"></i> </div>
            <div class="text-container"> LISTA DE ALUMNOS </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
                <table class="table table-hover table-responsive"
                       data-unique = 'idAlumno' data-keys = "idAlumno" id="listaAlumnosVer">
                  <thead>
                    <tr class="table-header">
                      <th class="table-column-title">CLIENTE</th>
                      <th class="table-column-title">ALUMNO</th>
                      <th class="table-column-title">CLASE</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr class="table-header">
                      <th class="table-column-title">CLIENTE</th>
                      <th class="table-column-title">ALUMNO</th>
                      <th class="table-column-title">CLASE</th>
                    </tr>
                  </tfoot>
                  <tbody> </tbody>
                </table>
                <div id = 'textListaAlumnos'></div>
              </div>
            </fieldset>
          </div>
        </div>
        <div class="modal-footer"> </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(0, 1);
        tableUtilities.createTable('reciboCobro', [{
          key:'cantidad',
          type:'display'
        }, 'concepto', {
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

        tableUtilities.createTable('listaAlumnosVer', ['cliente', 'alumno', 'clase'], ['cliente', 'clase']);


        $("#listaAlumnos").click(function (){

            var data = {
              tipo: $("#tipo").val(),
              idTipo: $("#tipoId").val(),
            }
            if(data.tipo!=""){
              tableUtilities.loadScript('listaAlumnosVer', 'verListaAlumnosVarios', data, agregarAlumno);
              $("#modalListaAlumnos").modal('show');
            }else{
              Messager.addAlertText('Ver Lista de Alumnos', 'SELECCIONE UNA CLASE, ASIGNATURA, DISCIPLINA O NIVEL', 'w');
            }
        });

        function agregarAlumno(data){

            return data;
        }

        function calcularSubtotal(){
          var cantidad = tableUtilities.getRowValueFromObject(this, 'cantidad'),
          descuento = tableUtilities.getRowValueFromObject(this, 'descuento'),
          precio = tableUtilities.getRowValueFromObject(this, 'precioUnitario');
          tableUtilities.setRowValueFromObject(this, 'subTotal', precio*cantidad);
          tableUtilities.setRowValueFromObject(this, 'totalConDescuento', Utilizer.calcularSubtotal(precio, cantidad, descuento));
          recalcularTotales();
        }

        tableUtilities.setUniqueColumns('reciboCobro', ['idConcepto']);

        tableUtilities.initializeTableEngine('reciboCobro');
        //ListEngine.initializeListEngine('generarReciboCobrar');
        FormEngine.setFormEngine('generarReciboCobrar');

        tableUtilities.addDrawEvent('reciboCobro', recalcularTotales);
        Utilizer.setToggler("conFolio", "SI", "NO");
        Utilizer.makeDatepicker('fechaSelect');
        Utilizer.loadSelect('idConcepto',    'conceptoSelect', 'Concepto');
        Utilizer.loadSelect('idCliente',     'clienteSelect', 'Cliente');
        Utilizer.loadSelect('idAlumno',      'selectAlumnoIdCliente', 'Alumno');

        Utilizer.loadSelect('idGrupo',          'grupoSelect',        'Clase');
        Utilizer.loadSelect('idAsignatura',     'asignaturaSelect',   'Asignatura');
        Utilizer.loadSelect('idDisciplina',     'disciplinaSelect',   'Disciplina');
        Utilizer.loadSelect('idNivel',          'nivelSelect',        'Nivel');

        $(".choice.selectpicker").change(function (){
          var not = this, sel = Utilizer.getSelected($(this).attr('id')), tipo, articulo;
          switch($(this).attr('id')){
            case 'idGrupo':         articulo = "EL"; tipo = "CLASE";            break;
            case 'idAsignatura':    articulo = "LA"; tipo = "ASIGNATURA";       break;
            case 'idDisciplina':    articulo = "LA"; tipo = "DISCIPLINA";       break;
            case 'idNivel':         articulo = "EL"; tipo = "NIVEL";            break;
          }
          $("#generarReciboCobrar").html("GENERAR CARTAS DE COBRO PARA "+articulo+" [<span style = 'color:black'>"+tipo+"</span>] [<span style = 'color:black'>"+$(sel).text()+"</span>]");
          $("#tipo").val(tipo);
          $("#tipoId").val($(this).val());
          $(".choice.selectpicker").each(function(){
            if(not!=this){
              Utilizer.setPicker($(this).attr('id'), '');
            }
          });
        });

        $("#descuentoTabla").on('change', calcularTotal);
        //$("#reciboCobroAdd").click(agregarConcepto);
        });

      function agregarConcepto(data) {
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
        calcularSubtotalTabla(tableUtilities.getTableData('reciboCobro'));
      }

      function resetEverything(){
          Utilizer.setPicker('idConcepto', '');
          $("#cantidad").val('');
          $("#descuento").val('');
          tableUtilities.clearTable('reciboCobro');
          $("#subTotalTabla").val('');
          $("#descuentoTabla").val('');
          $("#totalTabla").val('');
          Utilizer.makeDatepicker('fechaSelect');
      }
    </script>
