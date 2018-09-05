<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-user-o"></i> </div>
    <div class="text-container"> VER PERSONAL </div>
  </div>
  <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
      <button type="button" onClick = 'location.href = "administracionPagosNomina.php";' class="btn btn-save">RECIBOS DE NOMINA</button>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" data-titulo = "Lista de Personal" data-pdf = true data-csv = true data-copy = true data-xls = true data-titulo = "Lista de Personal" id="personalVer" >
      <thead>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">CORREO</th>
          <th class="table-column-title">DIRECCIÓN</th>
          <th class="table-column-title">TELÉFONO CELULAR</th>
          <th class="table-column-title">TIPO PERSONAL</th>
          <th class="table-column-title">FORMA DE PAGO</th>
          <th class="table-column-title">MODALIDAD DE PAGO</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th class="table-column-title">NOMBRE</th>
          <th class="table-column-title">CORREO</th>
          <th class="table-column-title">DIRECCIÓN</th>
          <th class="table-column-title">TELÉFONO CELULAR</th>
          <th class="table-column-title">TIPO PERSONAL</th>
          <th class="table-column-title">FORMA DE PAGO</th>
          <th class="table-column-title">MODALIDAD DE PAGO</th>
          <th class="table-column-title">ESTATUS</th>
          <th class="table-column-title">ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>
  <!-- Modal Edit -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modaleditarPersonal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-user-o"></i> </div>
            <div class="text-container"> EDITAR PERSONAL </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> NOMBRE COMPLETO </div>
                </div>
              </div>
              <input type='hidden' id='idPersonal' class='form-input' />
              <input type='hidden' id='idContacto' class='form-input' />
              <input type='hidden' id='idDireccion' class='form-input' />
              <input type='hidden' id='idFacturacion' class='form-input' />
              <input type='hidden' id='idPersona' class='form-input' />
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input capitalize" required placeholder="Nombre(s)" id="nombre"> </div>
              <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input capitalize" required placeholder="Apellido Paterno" id="apellidoPaterno"> </div>
              <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input capitalize" placeholder="Apellido Materno" id="apellidoMaterno"> </div>
              <div class="col-xs-12 col-sm-6 col-md-6 input-container">
                <select class="selectpicker form-input" data-live-search="true" data-script="generoSelect" required data-label="Genero" id="generoSearch" name='Genero'> </select>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 input-container date-container">
                <label class='label-fecha'>FECHA DE NACIMIENTO</label>
                <div class="input-group form-input date" id="fechaSelect"> <span class="input-group-addon">
                  <i class="glyphicon glyphicon-calendar"></i>
              </span>
                  <input type="text" class="form-control form-input" required id="fechaSelectText"> </div>
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
                <input type="email" class="form-control form-input lowercase" required placeholder="Correo Electronico" id="email"> </div>
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
                <input type="text" class="form-control form-input" placeholder="RFC" id="rfc"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DIRECCIÓN FISCAL </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input capitalize" data-minlength="1" data-maxlength="30" data-label="Calle" data-subtype="alphnum" id="calle" placeholder="Calle" name="Calle"> </div>
              <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input" data-minlength="1" data-maxlength="10" data-label="Número exterior" data-subtype="alphnum" id="numExt" placeholder="No. Exterior" name='NoExterior'> </div>
              <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input" data-minlength="1" data-maxlength="10" data-label="Número interior" data-subtype="alphnum" id="numInt" placeholder="No. Interior" name='NoInterior'> </div>
              <div class="col-xs-12 col-sm-4 col-md-4 input-container">
                <input type="number" class="form-control form-input" data-minlength="5" data-maxlength="15" data-label="Codigo Postal" data-subtype="alphnum" id="postalcodeSum" placeholder="C.P." name='CP'> </div>
              <div class="col-xs-12 col-sm-8 col-md-8 input-container">
                <select class="selectpicker form-input" data-live-search="true" id="areaSum" data-label="Colonia">
                  <option>Colonia</option>
                </select>
              </div>
              <div class="col-xs-12 col-sm-4 col-md-4 marTop-md input-container">
                <input type="text" placeholder="Ciudad" id="citySum" name='Ciudad' disabled/> </div>
              <div class="col-xs-12 col-sm-4 col-md-4 marTop-md input-container">
                <input type="text" placeholder="Estado" id="stateSum" name='Estado' disabled/> </div>
              <div class="col-xs-12 col-sm-4 col-md-4 marTop-md input-container">
                <input type="text" placeholder="Pa&iacute;s" id="countrySum" name='pais' disabled/>
                <input type="hidden" id="countryIdSum" name='Pais' /> </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> INFORMACIÓN DE PERSONAL </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 input-container">
                <select class="selectpicker form-input" data-live-search="false" data-script="tipoPersonalSelect" required id="tipoPersonalSearch" data-label="Tipo de Personal">
                  <option>Tipo de Personal</option>
                </select>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 input-container">
                <select class="selectpicker form-input" data-live-search="false" data-script="modalidadPagoSelect" required id="modalidadPagoSearch" data-label="Modalidad de Pago">
                  <option>Modalidad de Pago</option>
                </select>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 input-container">
                <select class="selectpicker form-input" data-live-search="false" data-script="formaPagoSelect" required id="formaPagoSearch" data-label="Forma de Pago">
                  <option>Forma de Pago</option>
                </select>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 input-container">
                <input type="coin" class="form-control form-input" required data-minlength="1" data-maxlength="30" data-label="Sueldo" data-subtype="coin" id="sueldo" placeholder="Sueldo" name="Sueldo"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <div class="col-xs-12 col-md-12 col-md-9">
                  <input type="checkbox" id="estatus" checked data-true="ACTIVO" data-false="INACTIVO" class='form-input switcher'> </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" data-form="form-input" data-script="editarPersonal" data-function="afterEdit" data-clear="true" id="editarPersonal">Editar Personal</button>
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
  <!-- /.modal -->
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(4);
        tableUtilities.createTable('personalVer', ['nombreCompleto', 'email', 'dirCompleta',
        'telCelular', 'tipoPersonal', 'formaPago', 'modalidadPago', 'estatus', 'acciones'], ['tipoPersonal', {
          key:'estatus',
          default:0,
          text: 'INACTIVO',
          activeValue: 'ACTIVO'
        }]);

        tableUtilities.setUniqueColumns('personalVer', ['idPersonal']);
        tableUtilities.loadScript('personalVer', 'getPersonal', {}, agregarPersonal);
        FormEngine.setFormEngine('editarPersonal');
        modalUtilities.Initialize('editarPersonal');
        Utilizer.makeDatepicker('fechaSelect');

        $("#postalcodeSum").change(Utilizer.loadDireccion);

        $("#sensual").click(function (){
            var data = {};
            data.type = 'tablafiltrada';
            data.params = tableUtilities.getDataForPdf('personalVer');
            Utilizer.makePdf(data, afterMakePdf, data);
        });

        function afterMakePdf(data, extra){ //console.log(data);console.log(extra);
          Utilizer.savePdfToDisk(extra.type, extra.params.titulopdf);
        }


      });
      function agregarPersonal(data) {
        console.log(data);
        data.nombreCompleto = data.nombre + " " + data.apellidoPaterno;
        data.nombreCompleto = data.apellidoMaterno != "" ? data.nombreCompleto + " " + data.apellidoMaterno : data.nombreCompleto;
        data.dirCompleta = Utilizer.concatenateDireccion(data);
        data.dirCompleta = data.dirCompleta == "" ? "N/E" : data.dirCompleta;
        data.estatus = data.activo == 1 ? "ACTIVO" : "INACTIVO";
        if(data.fechaNacimiento!==null){
          data.fechaSelect = data.fechaNacimiento;
        }else{
          data.fechaSelect = "01/01/2018";
        }
        data.postalcodeSum = data.postalcodeSum == 0 ? "" : data.postalcodeSum;
        data.modalidadPago = data.modalidad + " (" + Utilizer.numberToCoin(data.sueldo) + ") ";
        data.rfc = data.rfc == "" ? "N/E" : data.rfc;
        data.buttons = [["Editar", "btn-edit", editarPersonal]];
        return data;
      }
      function editarPersonal(event) {

        Utilizer.setPicker('idGenero', '');
        var data = tableUtilities.getDataFromEvent(event);
        data.generoSearch = data.idGenero;
        data.tipoPersonalSearch = data.idTipoPersonal;
        data.modalidadPagoSearch = data.idModalidadPago;
        data.formaPagoSearch = data.idFormaPago;
        data.sueldo = Utilizer.coinToNumber(data.sueldo);
        if(data.rfc == "N/E"){
          data.rfc = "";
        }
        modalUtilities.LoadShow('editarPersonal', data);
      }

      function afterEdit(data, extra) {

        tableUtilities.loadScript('personalVer', 'getPersonal', {}, agregarPersonal);
        $("#modaleditarPersonal").modal('hide');
        return;
        data.activo = data.estatus == true ? 1 : 0;
        data.areaSum = Number(data.areaSum);
        data.colonia = extra.areamSum;
        data.dirCompleta = Utilizer.concatenateDireccion(data, extra);

        data.estatus = data.estatus == true ? "ACTIVO" : "INACTIVO";
        data.formaPago = extra.formaPagoSearch;
        data.genero = Number(extra.generoSearch);
        data.idContacto = Number(data.idContacto);
        data.idDireccion = Number(data.idDireccion);
        data.idFacturacion = Number(data.idFacturacion);
        data.idFormaPago = Number(data.formaPagoSearch);
        data.idGenero = Number(data.generoSearch);
        data.idModalidadPago = Number(data.modalidadPagoSearch);
        data.idPersona = Number(data.idPersona);
        data.idPersonal = Number(data.idPersonal);
        data.idTipoPersonal = Number(data.tipoPersonalSearch);
        data.modalidad = extra.modalidadPagoSearch;
        data.modalidadPago = data.modalidad + " (" + Utilizer.numberToCoin(data.sueldo) + ") ";
        data.nombreCompleto = data.nombre + " " + data.apellidoPaterno;
        data.nombreCompleto = data.apellidoMaterno != "" ? data.nombreCompleto + " " + data.apellidoMaterno : data.nombreCompleto;
        data.postalcodeSum = Number(data.postalcodeSum);
        data.tipoPersonal = extra.tipoPersonalSearch;
        if(data.colonia == undefined){
          data.colonia = "";
        }
        if(data.postalcodeSum == 0 ){
          data.postalcodeSum = "";
        }
        if(extra.areaSum == "Colonia" || data.areaSum == 0){
          data.dirCompleta = "N/E";
        }
        //console.log(data);
        //console.log(extra);
        var buttons = [["Editar", "btn-edit", editarPersonal]];
        tableUtilities.updateRow('personalVer', {
          idPersonal: data.idPersonal
        }, data, buttons);

      }
    </script>
