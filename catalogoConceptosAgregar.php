<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-list-ul"></i> </div>
    <div class="text-container"> AGREGAR CONCEPTO </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"><abbr title = 'Especifíque la cantidad que desea cobrar y el concepto por el que se cobra. '>DATOS DE CONCEPTO</abbr></div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="text" class="form-control form-input capitalize" required placeholder="Nombre de Concepto" id="nombreConcepto"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="coin" class="form-control form-input" required placeholder="Precio Unitario" id="precioUnitario"> </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-form="form-input" data-script="agregarConcepto" data-clear="true" id="agregarConcepto">Agregar concepto</button>
        </div>
      </fieldset>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(14, 1);
        FormEngine.setFormEngine('agregarConcepto');
      });
    </script>
