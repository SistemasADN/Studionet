<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-user"></i> </div>
    <div class="text-container"> CAPTURAR PAGO DE PERSONAL</div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DATOS DE PAGO </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <select class="selectpicker form-input " data-live-search="true" required data-label="Personal" id="idPersonal" name='Personal'> </select>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 input-container">
          <select class="selectpicker form-input" data-live-search="false" required id="modalidadPagoSearch" data-label="Modalidad de Pago">
            <option>Modalidad de Pago</option>
          </select>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 input-container">
          <select class="selectpicker form-input" data-live-search="false" required id="formaPagoSearch" data-label="Forma de Pago">
            <option>Forma de Pago</option>
          </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="coin" class="form-control form-input" required data-minlength="1" data-maxlength="30" data-label="Sueld" data-subtype="coin" id="sueldo" placeholder="Sueldo" name="Sueldo"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-form="form-input" data-script="agregarEgresoPersonal" data-function="afterEdit" data-clear="true" id="agregarEgreso">Guardar</button>
        </div>
      </fieldset>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(4, 2);
        Utilizer.makeDatepicker('fechaSelect');
        Utilizer.loadSelect('idPersonal', 'personalSelect', 'Personal');
        Utilizer.loadSelect('modalidadPagoSearch', 'modalidadPagoSelect', 'Modalidad de Pago');
        Utilizer.loadSelect('formaPagoSearch', 'formaPagoSelect', 'Forma de Pago');
        FormEngine.setFormEngine('agregarEgreso');
        $("#idPersonal").change(function () {
          var sel = Utilizer.getSelected("idPersonal").data();
          Utilizer.setPicker('formaPagoSearch', sel.idFormaPago);
          Utilizer.setPicker('formaPagoSearch', sel.idFormaPago);
          Utilizer.setPicker('modalidadPagoSearch', sel.idModalidadPago);
          Utilizer.setPicker('modalidadPagoSearch', sel.idModalidadPago);
          $("#sueldo").val(sel.sueldo);
        });
      });

      function afterEdit(data, extra) {
        console.log(data);
        console.log(extra);
        Utilizer.makeDatepicker('fechaSelect');
      }
    </script>