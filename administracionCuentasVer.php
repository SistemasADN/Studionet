<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-minus"></i> </div>
    <div class="text-container"> VER CUENTAS </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="cuentasVer" data-pdf = "vercuentas" data-csv = "vercuentas" data-titulo = "Ver Cuentas" >
      <thead>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">PRINCIPAL</th>
          <th class="table-column-title">BANCO</th>
          <th class="table-column-title">NÚMERO CUENTA</th>
          <th class="table-column-title">CLABE</th>
          <th class="table-column-title">NÚMERO CLIENTE</th>
          <th class="table-column-title">MONTO INICIAL</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">PRINCIPAL</th>
          <th class="table-column-title">BANCO</th>
          <th class="table-column-title">NÚMERO CUENTA</th>
          <th class="table-column-title">CLABE</th>
          <th class="table-column-title">NÚMERO CLIENTE</th>
          <th class="table-column-title">MONTO INICIAL</th>
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
            <div class="text-container"> EDITAR CUENTA </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <div class = "hiddens">
                <input type = 'hidden' class = 'form-input' id = "idCuenta"/>
            </div>
            <div class="col-xs-12 col-sm-9 col-md-9 input-container">
              <input type="text" class="form-control form-input capitalize" required placeholder="Nombre Cuenta" id="nombreCuenta"> </div>
              <div class="col-xs-12 col-sm-9 col-md-9 input-container">
                <input type="text" class="form-control form-input capitalize"  placeholder="Banco" id="nombreBanco"> </div>
              <div class="col-xs-12 col-sm-9 col-md-9 input-container">
                <input type="text" class="form-control form-input capitalize"  placeholder="Número de cuenta" id="numeroCuenta"> </div>
              <div class="col-xs-12 col-sm-9 col-md-9 input-container">
                  <input type="text" class="form-control form-input capitalize"  placeholder="CLABE" id="clabe"> </div>
              <div class="col-xs-12 col-sm-9 col-md-9 input-container">
                  <input type="text" class="form-control form-input capitalize"  placeholder="Número de cliente" id="numeroCliente"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <div class="col-xs-12 col-md-12 col-md-9">
                  <input type="checkbox" id="principal" checked data-true="PRINCIPAL" data-false="NO" class='form-input switcher'> </div>
              </div>
              <div class="col-xs-12 col-sm-9 col-md-9 input-container">
                    <input type="number" data-subtype = 'coin' class="form-control form-input capitalize" required placeholder="Monto Inicial" id="montoInicial"> </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="col-xs-12 col-sm-12 col-md-6 input-container">
              <button type="button" class="btn btn-save" data-form="form-input" data-script="editarCuenta" data-function="afterEdit" data-clear="true" id="editarCuenta">EDITAR CUENTA</button>
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
      $(document).ready(function (){
        //Csser.collapse(8);
        tableUtilities.createTable('cuentasVer', ['nombreCuenta', 'principal', 'nombreBanco', 'numeroCuenta', 'clabe', 'numeroCliente', 'montoInicial', 'acciones']);
        tableUtilities.loadScript('cuentasVer', 'getCuenta', {}, agregarCuenta);
        FormEngine.setFormEngine('editarCuenta');
        modalUtilities.Initialize('editarCuenta');
       
      });
      function agregarCuenta(data){
        data.principal = data.principal===1?"SÍ":"NO";
        data.buttons = [['EDITAR', 'btn-edit', editarCuenta]];
        data.montoInicial = Utilizer.numberToCoin(data.montoInicial);  //Se agregó formato de moneda (string)
        return data;
      }

      function editarCuenta(event){
        var data = tableUtilities.getDataFromEvent(event);
        data.montoInicial = Utilizer.coinToNumber(data.montoInicial);  //Se vuelve a convertir a número para enviar
        $("#modalRevisarEgreso").modal('show');
        Utilizer.fillForm(data);
        console.log(data);
      }
      function afterEdit(){
          $("#modalRevisarEgreso").modal('hide');
        tableUtilities.loadScript('cuentasVer', 'getCuenta', {}, agregarCuenta);
      }
      </script>
