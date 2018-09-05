<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-arrows-h"></i> </div>
    <div class="text-container"><abbr title = 'Al transferir alumnos de grado escolar el sistema removerá a todos los alumnos de ese grado y los moverá al de su elección'>TRANSFERIR ALUMNOS DE GRADO ESCOLAR</abbr></div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>

        <div class="col-xs-12 col-sm-4 col-md-4 input-container">
          <select class="selectpicker" data-live-search="true" required data-label="Grado" id="idGradoOrigen" name='Grado'> </select>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 input-container">
          <select class="selectpicker" data-live-search="true" required data-label="Grado" id="idGradoDestino" name='Grado'> </select>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 input-container">
          <button type="button" class="btn btn-save" id="agregarTabla">TRANSFERIR ALUMNO</button>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
          <table class="table required table-hover table-responsive form-input" data-keys = 'idGradoOrigen,idGradoDestino' id="listaGrados">
            <thead>
              <tr class="table-header">
                <th class="table-column-title">GRADO ESCOLAR ORIGEN</th>
                <th class="table-column-title">GRADO ESCOLAR DESTINO</th>
                <th class="table-column-title">ACCIONES</th>
              </tr>
            </thead>
            <tfoot>
              <tr class="table-header">
                <th class="table-column-title">GRADO ESCOLAR ORIGEN</th>
                <th class="table-column-title">GRADO ESCOLAR DESTINO</th>
                <th class="table-column-title">ACCIONES</th>
              </tr>
            </tfoot>
            <tbody> </tbody>
          </table>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
            <div class = 'custom-legend' id = 'textoExplicativo'></div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-function = 'afterScript' data-form="form-input" data-script="cambiarGrados"
           data-clear="true" id="guardarTabla">TRANSFERIR ALUMNOS DE GRADO ESCOLAR</button>
        </div>
      </fieldset>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(3, 1);
        $("#agregarTabla").click(function (){
          var data = {};
          data.idGradoOrigen = Number($("#idGradoOrigen").val());
          data.idGradoDestino = Number($("#idGradoDestino").val());
          data.gradoOrigen = Utilizer.getSelected('idGradoOrigen').text();
          data.gradoDestino = Utilizer.getSelected('idGradoDestino').text();
          var txt = '';

          if(data.idGradoOrigen===null){
            txt += "Debe elegir un grado de origen. ";
          }
          if(data.idGradoDestino===null||data.idGradoDestino===0){
            txt += "Debe elegir un grado de destino. ";
          }
          if(data.idGradoOrigen===data.idGradoDestino&&data.idGradoDestino!==null){
            txt += "Debe elegir un origen y destino diferentes. ";
          }

          if(txt===''){
            if(!tableUtilities.isInTable('listaGrados', {idGradoOrigen:data.idGradoOrigen})){
              tableUtilities.addRowDraw('listaGrados', data, [
                ['Borrar', 'borrar btn-danger', tableUtilities.borrarFila]
              ]);
              Utilizer.setPicker('idGradoOrigen', data.idGradoDestino);
              Utilizer.setPicker('idGradoDestino', null);
              $("#idGradoDestino").focus();
              $('#idGradoDestino').selectpicker('toggle');
            }

          }else{
            Messager.addAlertText('Agregar', 'Para continuar: '+txt, 'w');
          }
        });

        tableUtilities.createTable('listaGrados', ['gradoOrigen', 'gradoDestino', 'acciones']);
        tableUtilities.addDrawEvent('listaGrados', function (){
          var data = tableUtilities.getTableData('listaGrados'),  actual;
          if(data.length===0){
            return;
          }
          $("#textoExplicativo").text("Se van a mover los alumnos: ");

              for(var i = 0;i<data.length;i++){
                  actual = data[i];
                  $("#textoExplicativo").append("<br>De "+actual.gradoOrigen+" a "+actual.gradoDestino);
              }
            });

        Utilizer.loadSelect('idGradoOrigen', 'gradoSelect', 'Grado Escolar Origen');
        Utilizer.loadSelect('idGradoDestino', 'gradoSelect', 'Grado Escolar Destino');
        FormEngine.setFormEngine('guardarTabla');
      });
      function afterScript(){
        $("#textoExplicativo").text("");
        Utilizer.setPicker('idGradoOrigen', '');
        Utilizer.setPicker('idGradoDestino', '');
      }
    </script>
