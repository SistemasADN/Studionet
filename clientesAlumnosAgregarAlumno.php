<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-users"></i> </div>
    <div class="text-container"> AGREGAR ALUMNO </div>
  </div>
  <?php if($_SESSION['idSede']!=-1):?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          <button type="button" onClick = 'location.href = "inscribirAlumnosGrupos.php";' class="btn btn-save">INSCRIBIR ALUMNOS A 	CLASES</button>
      </div>
      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
  </div>
<?php endif; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"><abbr title = 'Por favor llene la forma para agregar un alumno al sistema'>NOMBRE COMPLETO</abbr></div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input capitalize" required placeholder="Nombre(s)" id="nombre"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input capitalize" required placeholder="Apellido Paterno" id="apellidoPaterno"> </div>
        <div class="col-xs-12 col-sm-12 col-md-6 input-container">
          <input type="text" class="form-control form-input capitalize" placeholder="Apellido Materno" id="apellidoMaterno"> </div>
        <div class="col-xs-6 col-sm-6 col-md-6 input-container">
          <select class="selectpicker form-input" data-live-search="false" required data-label="Genero" id="generoSearch" name='Genero'> </select>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 input-container date-container">
          <label class='label-fecha'>FECHA DE NACIMIENTO</label>
          <div class="input-group date form-input" id="fechaSelect"> <span class="input-group-addon">
              <i class="glyphicon glyphicon-calendar"></i>
          </span>
            <input type="text" class="form-control date form-input" required id="fechaSelectText"> </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DATOS CLÍNICOS </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input lowercase" placeholder = "Alergias" id="alergias"></div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input" placeholder = "Enfermedades" id="enfermedades"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input" placeholder = "Medicamentos que toma" id="medicamentos"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> INFORMACIÓN DE CONTACTO </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="email" class="form-control form-input lowercase" placeholder="Correo Electronico" id="email">
        </div>
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
            <div class="jumbotron-text"> DATOS DE PADRE/TUTOR </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <select class="selectpicker form-input" data-live-search="true" required data-label="Padre/Tutor" id="clienteSearch" name='Padre/Tutor'> </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DATOS DE COLEGIO </div>
          </div>
        </div>
        <div class="col-xs-4 col-sm-8 col-md-8 input-container">
          <select class="selectpicker form-input" data-live-search="true" data-label="Colegio" id="colegioSearch" name='Colegio'> </select>
        </div>
        <div class="col-xs-8 col-sm-4 col-md-4 input-container">
          <button type = 'button' class = 'btn agregar btn-save' id = "colegio">AGREGAR COLEGIO</button>
        </div>
        <div class="col-xs-4 col-sm-8 col-md-8 input-container">
          <select class="selectpicker form-input" data-live-search="true" data-label="Grado" id="gradoSearch" name='Grado'> </select>
        </div>
        <div class="col-xs-8 col-sm-4 col-md-4 input-container">
          <button type = 'button' class = 'btn agregar btn-save' id = "grado">AGREGAR GRADO ESCOLAR</button>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save list-input" data-form="form-input" data-script="agregarAlumno"
          data-clear="true" id="agregarAlumno">AGREGAR ALUMNO</button>
        </div>
      </fieldset>
    </div>
  </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="gradoModal">
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
              <div class="text-container"> AGREGAR GRADO ESCOLAR</div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
              <fieldset>
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <input type="text" class="form-control capitalize form-grado invalid" required="" placeholder="Nombre de Grado (Obligatorio)" id="nombreGrado" title="Nombre de Grado">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <button type="button" class="btn btn-save" data-form="form-grado"
                   data-function = "loadGrado" data-script="agregarGrado" data-clear="true" id="agregarGrado">Guardar</button>
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
              <div class="text-container"> AGREGAR COLEGIO </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
              <fieldset>
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="jumbotron jumbotron-container">
                    <div class="jumbotron-text"> DATOS DE COLEGIO </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <input type="text" class="form-control form-colegio capitalize" required placeholder="Nombre de Colegio" id="nombreColegio"> </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="jumbotron jumbotron-container">
                    <div class="jumbotron-text"> DIRECCIÓN DE COLEGIO </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <input type="text" class="form-control form-colegio capitalize" data-minlength="1" data-maxlength="30" data-label="Calle" data-subtype="alphnum" id="street" placeholder="Calle" name="Calle"> </div>
                <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                  <input type="text" class="form-control form-colegio" data-minlength="1" data-maxlength="10" data-label="Número exterior" data-subtype="alphnum" id="numExt" placeholder="No. Exterior" name='NoExterior'> </div>
                <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                  <input type="text" class="form-control form-colegio" data-minlength="1" data-maxlength="10" data-label="Número interior" data-subtype="alphnum" id="numInt" placeholder="No. Interior" name='NoInterior'> </div>
                <div class="col-xs-12 col-sm-4 col-md-4 input-container">
                  <input type="text" class="form-control form-colegio" data-minlength="4" data-maxlength="5" data-label="Codigo Postal" data-subtype="alphnum" id="postalcodeSum" placeholder="C.P." name='CP'> </div>
                <div class="col-xs-12 col-sm-8 col-md-8 input-container">
                  <select class="selectpicker form-colegio" data-live-search="true" id="areaSum" data-label="Colonia">
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
                    <div class="jumbotron-text"> INFORMACIÓN DE CONTACTO </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <input type="text" class="form-control form-colegio capitalize" placeholder="Nombre de Contacto" id="nombreContacto"> </div>
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <input type="text" class="form-control form-colegio lowercase" placeholder="Correo Electronico" id="correo"> </div>
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <input type="text" class="form-control form-colegio capitalize" placeholder="Puesto" id="puesto"> </div>
                <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                  <input type="text" class="form-control form-colegio" placeholder="Telefono" id="telefono"> </div>
                <div class="col-xs-12 col-sm-12 col-md-6 input-container">
                  <input type="text" class="form-control form-colegio" placeholder="Telefono Otro" id="telefonoOtro"> </div>
                <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <button type="button" class="btn btn-save" data-form="form-colegio"
                  data-script="agregarColegio" data-function = "loadColegio" data-clear="true" id="agregarColegio">Guardar</button>
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
        //Csser.collapse(2, 1);
        Utilizer.makeDatepicker('fechaSelect');
        Utilizer.loadSelect('generoSearch', 'generoSelect', 'Genero', {}, loadFem);
        Utilizer.loadSelect('clienteSearch', 'clienteSelect', 'Cliente');
        Utilizer.loadSelect('colegioSearch', 'colegioSelect', 'Colegio');
        Utilizer.loadSelect('gradoSearch', 'gradoSelect', 'Grado Escolar');

        FormEngine.setFormEngine('agregarAlumno');
        FormEngine.setFormEngine('agregarGrado');
        FormEngine.setFormEngine('agregarColegio');


        function loadFem(){
          Utilizer.setPicker('generoSearch', '1');
          Utilizer.setPicker('generoSearch', '1');
        }

        $("#grado").click(function (){
            $("#gradoModal").modal('show');
        });

        $("#colegio").click(function (){
            $("#colegioModal").modal('show');
        });

      });

      function loadGrado (){
          $("#gradoModal").modal('hide');
          Utilizer.loadSelect('gradoSearch', 'gradoSelect', 'Grado Escolar');
      }

      function loadColegio (){
          $("#colegioModal").modal('hide');
          Utilizer.loadSelect('colegioSearch', 'colegioSelect', 'Colegio');
      }

    </script>
