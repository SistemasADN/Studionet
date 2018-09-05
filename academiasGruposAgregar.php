<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-users"></i> </div>
    <div class="text-container"> AGREGAR CLASE </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-6 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DATOS DE LA CLASE </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <input type="text" class="form-control form-input" required data-type = "alphnum" placeholder="Nombre del grupo" id="nombreGrupo"> </div>


        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <select class="selectpicker form-input " data-live-search="true" required data-label="Clase" id="idClase" name='Clase'> </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <select class="selectpicker form-input " required data-live-search="true" required data-label="Profesor Principal" id="idProfesorPrincipal" name='Clase'> </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <select class="selectpicker form-input " data-live-search="true" data-label="Profesor Secundario" id="idProfesorSecundario" name='Clase'> </select>
        </div>
		<div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="number" class="form-control form-input" required data-min = '1' placeholder="Número máximo de alumnos" id="numMaxAlumno"> </div>

		<div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="number" class="form-control form-input" required placeholder="Precio" id="precio"> </div>

        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-form="form-input" data-script="agregarGrupo" data-clear="true" id="agregarGrupo">Guardar</button>
        </div>
      </fieldset>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(4, 1);
        Utilizer.loadSelect('idClase', 'claseSelect', 'Clase');
        Utilizer.loadSelect('idProfesorPrincipal', 'profesorSelect', 'Profesor Principal');
        $("#idProfesorPrincipal").change(function () {
          console.log({
            idProfesor: $(this).val()
          });
          Utilizer.loadSelect('idProfesorSecundario', 'profesorSecundarioSelect', 'Profesor Secundario', {
            idProfesor: $(this).val()
          });
		$("#idClase").change(function (){
			var sel = Utilizer.getSelected('idClase');
			console.log(sel.data());
			$("#precio").val($(sel).data('precioEstandard'));
		});
        FormEngine.setFormEngine('agregarGrupo');

      });
    </script>
