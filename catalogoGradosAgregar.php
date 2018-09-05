<?php include 'templates/top.php'; ?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
  <div class="logo-container"> <i class="fa fa-tags"></i> </div>
  <div class="text-container">AGREGAR GRADO ESCOLAR</div>
</div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <div class="templates" data-type="legend" data-text="DATOS DE GRADO ESCOLAR"></div>
      <div class="datosGrado"></div>
      <div class="col-xs-12 col-sm-12 col-md-12 input-container">
        <button type="button" class="btn btn-save" data-form="form-input" data-script="agregarGrado" data-clear="true" id="agregarGrado">agregar grado</button>
      </div>
      </fieldset>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(13, 1);
        Templater.startTemplating("templates");
        var inputs = [
          {
            'type': 'text'
            , 'class': 'form-control capitalize form-input'
            , 'required': true
            , 'placeholder': 'Nombre de Grado Escolar'
            , 'id': 'nombreGrado'
          }
  ];
        Templater.templateForm('datosGrado', inputs);
        FormEngine.setFormEngine('agregarGrado');
      });
    </script>
