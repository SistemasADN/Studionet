<?php include 'templates/top.php'; include 'queries/cargaLogsCobranza.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-list-ul"></i> </div>
    <div class="text-container"> GENERAR COBRANZA MENSUAL </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> AÑO Y MES </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 input-container">
          <select class="selectpicker form-input" data-live-search="true" required id="ano" name='Genero'> </select>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 input-container">
            <select class="selectpicker form-input" data-live-search="true" required id="mes">
              <option disabled hidden>Primero seleccione un año</option>
            </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" id="generar">Generar cobranza mensual</button>
        </div>
      </fieldset><br><br>
      <div class="row">
          <div class="alert alert-info" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
           <center>
           <strong>La última cobranza se realizó el:</strong>
           <p><b><?="[ ".$ultimaFecha['fecha']." ]  correspondiente al mes de:  [ ".$ultimaFecha['mensualidad']." ]";?></b></p>
           </center>
        </div>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        var month = new Array("Enero", "Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"), years = [], today = new Date(), year = today.getFullYear();
        if(today.getMonth()==0){
          //year--;
        }
        for(var i = 2017;i<=year;i++){
          years.push({id:i, value:i});
        }
        Utilizer.manualLoadSelect('ano', 'Año', years);
        $("#ano").change(function (){
            var last = 11;
            if($(this).val()==today.getFullYear()){
              last = today.getMonth();
            }
            var options = [];
            for(var i = 0;i<=last;i++){
                options.push({id:i, value:month[i]});
            }
            Utilizer.manualLoadSelect('mes', 'Mes', options);
        });
        Utilizer.setPicker('ano', year);
        $("#ano").trigger('change');
        $("#generar").click(function (){
            var fecha = $("#ano").val();
            if($("#mes").val()){
              var mes = Number($("#mes").val())+1;
              fecha += "-"+(mes<10?'0':'')+mes;
              Utilizer.sendData('generarCargosRecurrentes', {fecha:fecha});
            }else{
              Messager.addAlertText("Para continuar:", "Debe seleccionar un año y luego un mes.", 'w');
            }
        });
      });
    </script>
