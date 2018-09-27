<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-user-o"></i> </div>
    <div class="text-container"> AGREGAR PERSONAL </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> NOMBRE COMPLETO </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input capitalize" required placeholder="Nombre(s)" id="nombre"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input capitalize" required placeholder="Apellido Paterno" id="apellidoPaterno"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input capitalize" placeholder="Apellido Materno" id="apellidoMaterno"> </div>
        <div class="col-xs-6 col-sm-6 col-md-6 input-container">
          <select class="selectpicker form-input" data-live-search="true" required data-label="Genero" id="generoSearch" name='Genero'> </select>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 input-container date-container">
          <label class='label-fecha'>FECHA DE NACIMIENTO</label>
          <div class="input-group form-input date" id="fechaSelect"> <span class="input-group-addon">
              <i class="glyphicon glyphicon-calendar"></i>
          </span>
            <input type="text" class="form-control date" required id="fechaSelectText"> </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DATOS CLÍNICOS </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input lowercase" placeholder = "Alergias" id="alergias"></div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input lowercase" placeholder = "Enfermedades" id="enfermedades"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input lowercase" placeholder = "Medicamentos que toma" id="medicamentos">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> INFORMACIÓN DE CONTACTO </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="email" class="form-control form-input lowercase" required placeholder="Correo Electrónico" id="email"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" required placeholder="Tel. Celular" id="telCelular"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" placeholder="Tel. Casa" id="telCasa"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" placeholder="Tel. Oficina" id="telOficina"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" placeholder="Tel. Otro" id="telOtro"> </div>
          <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input" placeholder="Nombre Contacto 1" id="contacto1"> </div>
                <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input" placeholder="Tel. Contacto 1" id="telC1"> </div>
                <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input" placeholder="Nombre Contacto 2" id="contacto2"> </div>
                <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input" placeholder="Tel. Contacto 2" id="telC2"> </div>  
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DATOS DE FACTURACIÓN </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input uppercase" placeholder="RFC" id="rfc"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DIRECCIÓN FISCAL </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input capitalize" data-minlength="1" data-maxlength="30" data-label="Calle" data-subtype="alphnum" id="street" placeholder="Calle" name="Calle"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" data-minlength="1" data-maxlength="10" data-label="Número exterior" data-subtype="alphnum" id="numExt" placeholder="No. Exterior" name='NoExterior'> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input" data-minlength="1" data-maxlength="10" data-label="Número interior" data-subtype="alphnum" id="numInt" placeholder="No. Interior" name='NoInterior'> </div>
        <div class="col-xs-12 col-sm-4 col-md-4 input-container">
          <input type="number" class="form-control form-input" data-minlength="4" data-maxlength="5" data-label="Codigo Postal" data-subtype="alphnum" id="postalcodeSum" placeholder="C.P." name='CP'> </div>
        <div class="col-xs-12 col-sm-8 col-md-8 input-container">
          <select class="selectpicker form-input" data-live-search="true" id="areaSum" data-label="Colonia">
            <option>Colonia</option>
          </select>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 marTop-md input-container">
          <input type="text" placeholder="Ciudad" class = "citySum" id="citySum" name='Ciudad' readOnly /> </div>
        <div class="col-xs-12 col-sm-4 col-md-4 marTop-md input-container">
          <input type="text" placeholder="Estado" class = "stateSum" id="stateSum" name='Estado' readOnly /> </div>
        <div class="col-xs-12 col-sm-4 col-md-4 marTop-md input-container">
          <input type="text" placeholder="Pa&iacute;s" class = "countrySum" id="countrySum" name='pais' readOnly />
          <input type="hidden" id="countryIdSum" name='Pais' /> </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> INFORMACIÓN DE PERSONAL </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 input-container">
          <select class="selectpicker form-input" data-live-search="false" required id="tipoPersonalSearch" data-label="Tipo de Personal">
            <option>Tipo de Personal</option>
          </select>
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
        <div class="col-xs-12 col-sm-6 col-md-6 input-container">
          <input type="coin" class="form-control form-input" required data-minlength="1" data-maxlength="30" data-label="Sueld" data-subtype="coin" id="sueldo" placeholder="Sueldo" name="Sueldo"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-form="form-input" data-script="agregarPersonal" data-function="afterEdit" data-clear="true" id="agregarPersonal">Guardar</button>
        </div>
      </fieldset>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(4, 1);
        Utilizer.makeDatepicker('fechaSelect');
        Utilizer.loadSelect('generoSearch', 'generoSelect', 'Genero');
        Utilizer.loadSelect('tipoPersonalSearch', 'tipoPersonalSelect', 'Tipo de Personal');
        Utilizer.loadSelect('modalidadPagoSearch', 'modalidadPagoSelect', 'Modalidad de Pago');
        Utilizer.loadSelect('formaPagoSearch', 'formaPagoSelect', 'Forma de Pago');
        FormEngine.setFormEngine('agregarPersonal');
        $('#postalcodeSum').bind('change', Utilizer.loadDireccion);

      // $('.cpostal').on('change',function () {
      //      var cp = $('.cpostal').val();
      //      $.ajax({
      //             async: true,
      //             data:{cp:cp},
      //             type:"POST",
      //             dataType:"json",
      //             url: "queries/getDireccion.php",
      //       success:function(data, textStatus, jqXHR) {
      //             //Utilizer.manualLoadSelect('area' + cp, 'Colonia', data.colonia);
      //             $('.stateSum').attr('value',data.estado);
      //             $('.citySum').attr('value',data.ciudad);
      //             $('.countrySum').attr('value',data.pais);
      //       },
      //       error:function( jqXHR, textStatus, errorThrown ) {
      //           if ( console && console.log ) {
      //               console.log( "La solicitud a fallado: " +  textStatus);
      //           }
      //       }
      //   });
      // });

      function afterEdit(data, extra) {
        console.log(data);
        console.log(extra);
        Utilizer.makeDatepicker('fechaSelect');
      }
    });
    
    </script>
