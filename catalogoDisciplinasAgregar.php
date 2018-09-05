<?php include 'templates/top.php'; ?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
  <div class="logo-container">
    <i class="fa fa-bookmark-o"></i>
  </div>
  <div class="text-container">
    AGREGAR DISCIPLINA
  </div>
</div>
<?php
  include_once "queries/getFormaCalculo.php";
  //$formaCalculoGot
  //Por Cada Grupo y Costo Por Hora
  //Por Mes Fijo
  //Por Horas Totales
  //Por Disciplina Horas Totales
  //Agregar tabla de horas
?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
  <div class="col-xs-12 col-sm-12 col-md-8 form-container">
    <fieldset>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="jumbotron jumbotron-container">
          <div class="jumbotron-text">
            DATOS DE DISCIPLINA
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 input-container">
        <input type="text" data-subtype = 'alphnum' class="form-control form-input capitalize" required placeholder="Nombre de Disciplina" id="nombreDisciplina">
      </div>
      <?php
        include_once "queries/getFormaCalculo.php";
       // echo $formaCalculoGot; exit;
        if($formaCalculoGot=="Por Disciplina Horas Totales"):
       ?>
      <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="number" class="form-control form-input" data-min = '0' required placeholder="Mínimo de horas totales" id="minimoHorasTotales"> </div>

        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="number" class="form-control form-input" data-min = '0' data-subtype = "coin" required placeholder="Costo Mensual" id="cuotaMensual"> </div>

        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <input type="number" class="form-control form-input" data-min = '0' data-subtype = "coin" required placeholder="Costo Extra por Hora" id="costoExtraPorHora"> </div>
      <?php
        endif;
      ?>

      <div class="col-xs-12 col-sm-12 col-md-12 input-container">
        <button type="button" class="btn btn-save" data-form="form-input" data-script="agregarDisciplina" data-clear = "true" id="agregarDisciplina">agregar disciplina</button>
      </div>



    </fieldset>
  </div>
</div>

<?php include 'templates/bottom.php'; ?>

<script>
$(document).ready(function(){
  //Csser.collapse(5,1);
  FormEngine.setFormEngine('agregarDisciplina');
});
</script>
