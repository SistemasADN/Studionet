<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-sitemap"></i> </div>
    <div class="text-container"> AGREGAR EQUIPO </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DATOS DEL EQUIPO </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input capitalize" required placeholder="Nombre de Equipo" id="nombreEquipo"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <select class="selectpicker form-input" data-live-search="true" required data-label="Sede" id="sedeSearch" name='Sede'> </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <select class="selectpicker form-input" data-live-search="true" required data-label="Maestro" id="profesorSearch" name='Maestro'> </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-form="form-input" data-script="agregarEquipo" data-clear="true" id="agregarEquipo">Guardar</button>
        </div>
      </fieldset>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(3, 1);
        Utilizer.loadSelect('sedeSearch', 'sedeSelect', 'Sede');
        Utilizer.loadSelect('profesorSearch', 'profesorSelect', 'Maestro');
        FormEngine.setFormEngine('agregarEquipo');
      });
    </script>