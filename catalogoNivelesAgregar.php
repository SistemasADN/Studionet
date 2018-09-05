<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-navicon"></i> </div>
    <div class="text-container"> AGREGAR NIVEL </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DATOS DE NIVEL </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input capitalize" data-subtype = 'alphnum' required placeholder="Nombre de Nivel" id="nombreNivel"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-form="form-input" data-script="agregarNivel" data-clear="true" id="agregarNivel">agregar nivel</button>
        </div>
      </fieldset>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(7, 1);
        FormEngine.setFormEngine('agregarNivel');
      });
    </script>
