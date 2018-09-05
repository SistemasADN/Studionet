<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-bell"></i> </div>
    <div class="text-container"> AGREGAR CLASE </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DATOS DE CLASE </div>
          </div>
        </div>
        <div class="col-xs-4 col-sm-8 col-md-8 input-container">
          <select class="selectpicker form-input " data-live-search="true" required data-label="Asignatura" id="asignaturaSearch" name='Asignatura'> </select>
        </div>
        <div class="col-xs-8 col-sm-4 col-md-4 input-container">
          <button type = 'button' class = 'btn agregar btn-save' id = "asignatura">AGREGAR ASIGNATURA</button>
        </div>
        <div class="col-xs-4 col-sm-8 col-md-8 input-container">
          <select class="selectpicker form-input " data-live-search="true" required data-label="Nivel" id="nivelSearch" name='Nivel'> </select>
        </div>
        <div class="col-xs-8 col-sm-4 col-md-4 input-container">
          <button type = 'button' class = 'btn agregar btn-save' id = "nivel">AGREGAR NIVEL</button>
        </div>
		<div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="number" class="form-control form-input" required placeholder="Precio estándar" id="precioEstandard"> </div>

        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-form="form-input" data-script="agregarClase" data-clear="true" id="agregarClase">Guardar</button>
        </div>
      </fieldset>
    </div>
  </div>







  <div class="modal fade" tabindex="-1" role="dialog" id="nivelModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
              <i class="fa fa-times-circle"></i>
            </span> </button>
          </div>
          <div class="modal-body">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
              <div class="logo-container"> <i class="fa fa-book"></i> </div>
              <div class="text-container"> AGREGAR NIVEL </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
              <fieldset>
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <input type="text" class="form-control form-nivel capitalize" required placeholder="Nombre de nivel" id="nombreNivel"> </div>
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <button type="button" class="btn btn-save" data-form="form-nivel" data-function = "loadNivel" data-script="agregarNivel" data-clear="true" id="agregarNivel">Guardar</button>
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


  <div class="modal fade" tabindex="-1" role="dialog" id="colegioModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
          </span> </button>
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-book"></i> </div>
            <div class="text-container"> AGREGAR ASIGNATURA </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DATOS DE COLEGIO </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input capitalize" required placeholder="Nombre de Colegio" id="nombreColegio"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> DIRECCION DE COLEGIO </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input capitalize" data-minlength="1" data-maxlength="30" data-label="Calle" data-subtype="alphnum" id="street" placeholder="Calle" name="Calle"> </div>
              <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input" data-minlength="1" data-maxlength="10" data-label="Número exterior" data-subtype="alphnum" id="numExt" placeholder="No. Exterior" name='NoExterior'> </div>
              <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input" data-minlength="1" data-maxlength="10" data-label="Número interior" data-subtype="alphnum" id="numInt" placeholder="No. Interior" name='NoInterior'> </div>
              <div class="col-xs-12 col-sm-4 col-md-4 input-container">
                <input type="text" class="form-control form-input" data-minlength="4" data-maxlength="5" data-label="Codigo Postal" data-subtype="alphnum" id="postalcodeSum" placeholder="C.P." name='CP'> </div>
              <div class="col-xs-12 col-sm-8 col-md-8 input-container">
                <select class="selectpicker form-input" data-live-search="true" id="areaSum" data-label="Colonia">
                  <option>Colonia</option>
                </select>
              </div>
              <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 marTop-md input-container">
                <input type="text" placeholder="Ciudad" id="citySum" name='Ciudad' disabled/> </div>
              <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 marTop-md input-container">
                <input type="text" placeholder="Estado" id="stateSum" name='Estado' disabled/> </div>
              <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 marTop-md input-container">
                <input type="text" placeholder="Pa&iacute;s" id="countrySum" disabled/>
                <input type="hidden" id="countryIdSum" name='Pais' /> </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="jumbotron jumbotron-container">
                  <div class="jumbotron-text"> INFORMACION DE CONTACTO </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input capitalize" placeholder="Nombre de Contacto" id="nombreContacto"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input lowercase" placeholder="Correo Electronico" id="correo"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <input type="text" class="form-control form-input capitalize" placeholder="Puesto" id="puesto"> </div>
              <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input" placeholder="Telefono" id="telefono"> </div>
              <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                <input type="text" class="form-control form-input" placeholder="Telefono Otro" id="telefonoOtro"> </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" data-form="form-input" data-script="agregarAsignatura " data-clear="true" id="agregarAsignatura ">Guardar</button>
              </div>
            </fieldset>
          </div>
        </div>
        <div class="modal-footer"> </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(9, 1);
        Utilizer.loadSelect('asignaturaSearch', 'asignaturaSelect', 'Asignatura');
        Utilizer.loadSelect('nivelSearch', 'nivelSelect', 'Nivel');
	      Utilizer.loadSelect('profesorSearch', 'profesorSelect', 'Profesor');
        Utilizer.loadSelect('disciplinaSearch', 'disciplinaSelect', 'Disciplina');

        FormEngine.setFormEngine('agregarNivel');
        FormEngine.setFormEngine('agregarAsignatura');
        FormEngine.setFormEngine('agregarClase');

        $(".agregar").click(function (){
          var id = $(this).attr('id');
          $("#"+id+"Modal").modal('show');
          FormEngine.deleteForm(id);
        });
      });

      function loadAsignatura(){
        $("#asignaturaModal").modal('hide');
        FormEngine.deleteForm('asignatura');
        Utilizer.loadSelect('asignaturaSearch', 'asignaturaSelect', 'Asignatura');
      }
      function loadNivel(){
        $("#nivelModal").modal('hide');
        FormEngine.deleteForm('nivel');
        Utilizer.loadSelect('nivelSearch', 'nivelSelect', 'Nivel');
      }
    </script>
