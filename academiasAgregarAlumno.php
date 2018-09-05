<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-users"></i> </div>
    <div class="text-container"> AGREGAR ALUMNO </div>
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
          <select class="selectpicker form-input" data-live-search="false" required data-label="Genero" id="generoSearch" name='Genero'> </select>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 input-container date-container">
          <label class='label-fecha'>FECHA DE NACIMIENTO</label>
          <div class="input-group date" id="fechaSelect"> <span class="input-group-addon">
              <i class="glyphicon glyphicon-calendar"></i>
          </span>
            <input type="text" class="form-control form-input" required id="fechaSelectText"> </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> INFORMACION DE CONTACTO </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="email" class="form-control form-input lowercase" placeholder="Correo Electronico" id="email"> </div>
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
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <select class="selectpicker form-input" data-live-search="true" data-label="Colegio" id="colegioSearch" name='Colegio'> </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <select class="selectpicker form-input" data-live-search="true" data-label="Grado" id="gradoSearch" name='Grado'> </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save list-input" data-form="form-input" data-script="agregarAlumno" data-clear="true" id="agregarAlumno">Guardar</button>
        </div>
      </fieldset>
    </div>
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
        function loadFem(){
          Utilizer.setPicker('generoSearch', '1');
          Utilizer.setPicker('generoSearch', '1');
        }
      });
    </script>
