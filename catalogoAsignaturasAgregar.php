<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-book"></i> </div>
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
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input capitalize" required placeholder="Nombre de la clase" id="nombreAsignatura"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <select class="selectpicker form-input " data-live-search="true" required data-label="Disciplina" id="disciplinaSearch" name='Disciplina'> </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-form="form-input" data-script="agregarAsignatura" data-clear="true" id="agregarAsignatura">agregar clase</button>
        </div>
      </fieldset>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(6, 1);
        Utilizer.loadSelect('disciplinaSearch', 'disciplinaSelect', 'Disciplina');
        /*Templater.startTemplating("templates");
  var inputs = [
		{'type':'text', 'class':'form-control form-input', 'required':true, 'placeholder':'Nombre de Asignatura', 'id':'nombreAsignatura'}
  ];
  Templater.templateForm('datosAsignatura', inputs);*/
        FormEngine.setFormEngine('agregarAsignatura');
      });
    </script>
