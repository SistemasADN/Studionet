
<?php include 'templates/top.php'; ?>
<?php include "queries/getFormaCalculo.php";?>
<?php include "queries/getConfiguracionActual.php";?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-wrench"></i> </div>
    <div class="text-container"> CONFIGURACIÓN COBRANZA </div>
  </div>
  <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"></div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
      <button type="button" onClick = 'location.href = "gestionEquipoAlumnosCobro.php";' class="btn btn-save">GESTION EQUIPOS</button>
  </div>
  <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"></div>
  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
      <button type="button" onClick = 'location.href = "reportesOperativosAlumnos.php";' class="btn btn-save">REPORTES ALUMNOS</button>
  </div>
  <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
  <button type="button" class="btn btn-primary hidden" id="cgeneral">CONFIGURACIÓN GENERAL</button>
      <?php if($cobranzaDefault['idForma']==0)
      {
          $cobra = "POR DISCIPLINA Y EQUIPOS/PAQUETES";
          ?>
          <button type="button" id="cobranza" value="<?= $cobranzaDefault['idForma']; ?>" hidden></button>
          <button type="button" onClick = 'location.href = "#";' class="btn btn-info" id="cdisciplina">CONFIGURACIÓN POR DISCIPLINA</button>
          <button type="button" onClick = 'location.href = "#";' class="btn btn-info" id="cequipos">CONFIGURACIÓN POR EQUIPOS/PAQUETES</button>
          <button type="button" onClick = 'location.href = "#";' class="btn btn-primary" id="cobro">COBRO POR GRUPOS</button>
      <?php
      }
      else if($cobranzaDefault['idForma']==2)
      {
          $cobra = "POR GRUPOS Y EQUIPOS/PAQUETES";
          ?>
          <button type="button" id="cobranza" value="<?= $cobranzaDefault['idForma']; ?>" hidden></button>
          <button type="button" onClick = 'location.href = "#";' class="btn btn-primary" id="cdisciplina">CONFIGURACIÓN POR DISCIPLINA</button>
          <button type="button" onClick = 'location.href = "#";' class="btn btn-info" id="cequipos">CONFIGURACIÓN POR EQUIPOS/PAQUETES</button>
          <button type="button" onClick = 'location.href = "#";' class="btn btn-info" id="cobro">COBRO POR GRUPOS</button>
          <?php
      }
      ?>


<!--  <span><input type="checkbox" id="cClases" <?php /*if($cobranzaDefault['idForma']==2){echo "checked";} */?>> <label>COBRO POR GRUPOS</label></span>
-->
  </div>
  <div class="" id="general">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
      <div class="col-xs-12 col-sm-12 col-md-8 form-container">
        <div class="row" id="resumenCP">

          <div class="alert alert-info" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
           <center>
           <strong>La configuración de cobranza de su academia es:</strong>
           <p><?php echo $cobra;?></p>
           </center>
            <!-- CONFIGURACIÓN EQUIPOS-->
        </div>
        <div hidden id="configuracionActual">
        </div>
      </div>
        <fieldset>
        <div id = "vprincipal" class="hidden">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text" id="titulo"></div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container">
            <span class = "explain custom-legend lower">
              Cada forma de cálculo toma diferentes parametros para generar cartas de cobro.
              Todos los cálculos que se generan se hacen basados en los grupos en los que un alumno se encontraba
              inscrito en el mes al cual se le genera su cobranza.
            </span>
          </div>
          <div class="col-xs-2 col-sm-2 col-md-2 input-container">
          </div>
          <div class="col-xs-2 col-sm-2 col-md-2 input-container">
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container" hidden>
            <button type="button" class="btn btn-continue" id="seleccionarConfiguracion" >Continuar</button>
          </div>
          <div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container explain custom-legend lower" id = "explicacionPagos">

          </div>
          <div id="div_equipo" class="hidden">
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <legend>Elija un Equipo</legend>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <select id="idEquipos" data-live-search="true" required data-label="Equipos"
              class="selectpicker col-xs-12 col-sm-12 col-md-12"></select>
            </div>
          </div>
          <input type = 'hidden' id = 'idSelect' 
          class = 'config1-input config2-input config3-input config4-input config5-input seleccionar'/>
          <input type = 'hidden' id = 'tipoSelect'
          class = 'config1-input config2-input config3-input config4-input config5-input seleccionar'/>
        
          <div id="div_disciplina" class="hidden">
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <legend>Elija una disciplina</legend>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <select id="idDisciplinas" data-live-search="true" required data-label="Disciplinas"
              class="selectpicker col-xs-12 col-sm-12 col-md-12"></select>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container">
            <legend>Elija una opción de cobranza</legend>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container">
            <select id="idCalculoPagos" name = "formaCalculo" data-live-search="true" required data-label="Forma de Calculo"
            class="selectpicker seleccionar col-xs-12 col-sm-12 col-md-12"></select>
          </div>
          <!-- CUOTA MENSUAL -->
          <div class="col-xs-12 col-sm-12 col-md-12 configurar custom-legend lower" hidden id = "configurar1">
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <input type="number" class="form-control config1-input capitalize" data-min = 0 required placeholder="Cuota Mensual" id="cuotaMensual">
            </div>
          </div>
          <!-- CUOTA MENSUAL POR CLASE-->
          <div class="col-xs-12 col-sm-12 col-md-12 configurar custom-legend lower" hidden id = "configurar2">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <button type="button" onClick = 'location.href = "catalogoGruposVer.php";' class="btn btn-save">CATÁLOGOS GRUPOS</button>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
                <table class="table table-hover table-responsive config2-input" data-unique = 'idGrupo' id="listaClases">
                  <thead>
                    <tr class="table-header">
                      <th class="table-column-title">GRUPO</th>
                      <th class="table-column-title">CUOTA MENSUAL</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr class="table-header">
                      <th class="table-column-title">GRUPO</th>
                      <th class="table-column-title">CUOTA MENSUAL</th>
                    </tr>
                  </tfoot>
                  <tbody> </tbody>
                </table>
              </div>
          </div>
          <!-- CUOTA POR DIAS-->
          <div class="col-xs-12 col-sm-12 col-md-12 configurar custom-legend lower" hidden id = "configurar3">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 table-container">
              <table class="table table-hover table-responsive config3-input" required data-unique = 'dias' id="listaDias">
                <thead>
                  <tr class="table-header">
                    <th class="table-column-title">DIAS</th>
                    <th class="table-column-title">CUOTA</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr class="table-header">
                    <th class="table-column-title">DIAS</th>
                    <th class="table-column-title">CUOTA</th>
                  </tr>
                </tfoot>
                <tbody> </tbody>
              </table>
            </div>
          </div>
          <!-- CUOTA POR DIAS POR VECES A LA SEMANA-->
          <div class="col-xs-12 col-sm-12 col-md-12 configurar custom-legend lower" hidden id = "configurar4">
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Veces:</label>
              <input type="number" required data-min = 0 disabled class="input-group  veces-input col-xs-8 col-sm-8 col-md-8" id="veces">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Cuota:</label>
              <input type="number" data-subtype = 'coin' required data-min = 0 class="input-group enter veces-input col-xs-8 col-sm-8 col-md-8"
              data-boton = 'listaVecesAdd' id="vecesPrecioUnitario">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <button type="button" class="btn btn-save" data-form="veces-input" data-clear="false" id="listaVecesAdd">Agregar</button>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 table-container">
              <table class="table table-hover table-responsive config4-input" required data-unique = 'veces' id="listaVeces">
                <thead>
                  <tr class="table-header">
                    <th class="table-column-title">VECES</th>
                    <th class="table-column-title">CUOTA</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr class="table-header">
                    <th class="table-column-title">VECES</th>
                    <th class="table-column-title">CUOTA</th>
                  </tr>
                </tfoot>
                <tbody> </tbody>
              </table>
              <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 table-container">
                <button type="button" class="btn btn-danger ultimo" data-table = 'listaVeces'>Borrar último</button>
              </div>
            </div>
          </div>
          <!-- CUOTA POR TOTAL DE HORAS SEMANALES-->
          <div class="col-xs-12 col-sm-12 col-md-12 configurar custom-legend lower" hidden id = "configurar5">
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Horas:</label>
              <input type="number" required data-min = 1 disabled class="input-group horas-input col-xs-8 col-sm-8 col-md-8" id="horas">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <label class='label-fecha-recibo col-xs-4 col-sm-4 col-md-4'>Cuota:</label>
              <input type="number" data-subtype = 'coin' required data-min = 0 class="input-group enter horas-input col-xs-8 col-sm-8 col-md-8"
              data-boton = 'listaHorasAdd'
              id="horasPrecioUnitario">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 input-container">
              <button type="button" class="btn btn-save" data-form="horas-input" data-clear="false" id="listaHorasAdd">Agregar</button>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 table-container">
              <table class="table table-hover table-responsive config5-input" required data-unique = 'horas' id="listaHoras">
                <thead>
                  <tr class="table-header">
                    <th class="table-column-title">HORAS</th>
                    <th class="table-column-title">CUOTA</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr class="table-header">
                    <th class="table-column-title">HORAS</th>
                    <th class="table-column-title">CUOTA</th>
                  </tr>
                </tfoot>
                <tbody> </tbody>
              </table>
              <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 table-container">
                <button type="button" class="btn btn-danger ultimo" data-table = 'listaHoras'>Borrar último</button>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
  <script>
  $(document).ready(function ()
  {
      var x = $('#cobranza').val();
      if(x == 2)
      {
            Utilizer.loadSelect('idCalculoPagos', 'formaCalculoClases', 'Forma Cálculo', {}, setPorGrupos);
        $('#tipoSelect').val('1');
        $('#titulo').html('COBRANZA POR GRUPOS');
        $('#div_equipo').addClass('hidden');
        $('#div_disciplina').addClass('hidden');
        $('#tipoCobranza').addClass('hidden');
        $('#configurar2').removeClass('hidden');
        $('#vprincipal').removeClass('hidden');      
      }

      else {
        $('#cClases').prop('checked',false);
        $('#configurar2').addClass('hidden');
        $('#configuracionActual').prop('hidden',true);
        $('#cClases').prop('');
        $('#tipoSelect').val('2');
        $('#titulo').html('COBRANZA POR DISCIPLINA');
        $('#div_equipo').addClass('hidden');
        $('#div_disciplina').removeClass('hidden');
        $('#configuracionActual').prop('hidden',false);
        cargaDisciplinas();
        $('#tipoCobranza').removeClass('hidden');
        $('#vprincipal').removeClass('hidden');
            Utilizer.loadSelect('idCalculoPagos', 'formaCalculoSelectDisciplina', 'Forma Cálculo', {}, setSelected);
            Utilizer.loadSelect('idDisciplinas', 'disciplinaSelect', 'Disciplinas',{},setSelected);  
      }
      $('#cdisciplina').click(function(){
        $('#cClases').prop('checked',false);
        $('#configurar2').addClass('hidden');
        $('#configuracionActual').prop('hidden',true);
        $('#cClases').prop('');
        $('#tipoSelect').val('2');
        $('#titulo').html('COBRANZA POR DISCIPLINA');
        $('#div_equipo').addClass('hidden');
        $('#div_disciplina').removeClass('hidden');
        $('#configuracionActual').prop('hidden',false);
        cargaDisciplinas();
        $('#tipoCobranza').removeClass('hidden');
        $('#vprincipal').removeClass('hidden');
            Utilizer.loadSelect('idCalculoPagos', 'formaCalculoSelectDisciplina', 'Forma Cálculo', {}, setSelected);
            Utilizer.loadSelect('idDisciplinas', 'disciplinaSelect', 'Disciplinas',{},setSelected); 
      });
      $('#cequipos').click(function(){
        $('#cClases').prop('checked',false);
        $('#configurar2').addClass('hidden');
        $('#tipoSelect').val('3');
        $('#titulo').html('COBRANZA POR EQUIPOS');
        $('#div_equipo').removeClass('hidden');
        $('#configuracionActual').prop('hidden',false);
        cargaEquipos();
        $('#div_disciplina').addClass('hidden');
        $('#tipoCobranza').addClass('hidden');
        $('#vprincipal').removeClass('hidden');
            Utilizer.loadSelect('idCalculoPagos', 'formaCalculoSelect', 'Forma Cálculo', {}, setEquipos);
            Utilizer.loadSelect('idEquipos', 'equipoSelect', 'Equipos');    
      });





      $('#cobro').click(function()
      {
        Utilizer.loadSelect('idCalculoPagos', 'formaCalculoClases', 'Forma Cálculo', {}, setPorGrupos);
        /*  var x = $('#cobranza').val();
        if(x == 2)
        {*/
              $('#tipoSelect').val('1');
              $('#titulo').html('COBRANZA POR GRUPOS');
              $('#div_equipo').addClass('hidden');
              $('#configuracionActual').prop('hidden',true);
              $('#div_disciplina').addClass('hidden');
              $('#tipoCobranza').addClass('hidden');
              $('#configurar2').removeClass('hidden');
              $('#vprincipal').removeClass('hidden');
        /*}
        else {
                  $('#titulo').html('&nbsp;');
                  $('#div_equipo').addClass('hidden');
                  $('#div_disciplina').addClass('hidden');
                  $('#tipoCobranza').addClass('hidden');
                  $('#configurar2').addClass('hidden');
                  Utilizer.loadSelect('idCalculoPagos', 'formaCalculoClases', 'Forma Cálculo', {}, setSelected);
              }*/
      });




            var idCalculoPagosActual = 0;
            function setSelected() {
              var sel = {};
              $("#idCalculoPagos").find('option').each(function (){
                if($(this).data('idCalculoPagos')==1){
                    console.log('1');
                    sel = $(this).val();
                    idCalculoPagosActual = sel;
                }
              });
              Utilizer.setPicker('idCalculoPagos', sel);
              Utilizer.setPicker('idCalculoPagos', sel);
              $("#idCalculoPagos").trigger('change');
            }
            
            function setPorGrupos(){
              var sel = {};
              $("#idCalculoPagos").find('option').each(function (){
                    sel = 2;
                    idCalculoPagosActual = sel;
              });
              Utilizer.setPicker('idCalculoPagos', sel);
              Utilizer.setPicker('idCalculoPagos', sel);
              $("#idCalculoPagos").trigger('change');
            }

            function setEquipos() {
              var sel = {};
              $("#idCalculoPagos").find('option').each(function (){
                    sel = 1;
                    idCalculoPagosActual = sel;
              });
              Utilizer.setPicker('idCalculoPagos', sel);
              Utilizer.setPicker('idCalculoPagos', sel);
              $("#idCalculoPagos").trigger('change');
            }
            $("#idCalculoPagos").change(function (){
                $("#seleccionarConfiguracion").trigger('click');
            });
            $("#idDisciplinas").change(function (){
                $('#idSelect').val($(this).val());
                $("#seleccionarConfiguracion").trigger('click');
            });
            $("#idEquipos").change(function (){
                $('#idSelect').val($(this).val());
                $("#seleccionarConfiguracion").trigger('click');
            });
            $("#seleccionarConfiguracion").click(function (){
                  if(FormEngine.validateObject($("#idCalculoPagos"),$("#idSelect"))){
                      $(".configurar").hide();
                      $("#configurar"+$("#idCalculoPagos").val()).show();
                      $(".configurar"+$("#idCalculoPagos").val()).show();
                    
                      switch($("#idCalculoPagos").val()){
                        case "1":
                            $("#cuotaMensual").focus();
                        break;
                        case "2":
                          tableUtilities.loadScript('listaClases', 'getGrupo', {}, agregarClase);
                        break;
                        case "3":
                          tableUtilities.clearTable('listaDias'); 
                          for(i = 1;i<=7;i++){
                            tableUtilities.addRow('listaDias', {dias:i, precioUnitario:0});
                          }
                          tableUtilities.draw('listaDias');
                        break;
                        case "4":
                            $("#veces").val(1);
                            $("#vecesPrecioUnitario").focus();
                        break;
                        case "5":
                          $("#horas").val(1);
                          $("#horasPrecioUnitario").focus();
                        break;
                      }
                      Utilizer.getResponse('getInfoCalculo', {tipoSelect:$('#tipoSelect').val(),idSelect:$('#idSelect').val(),idCalculoPago:$("#idCalculoPagos").val()}, setInfoCalculos);
                  }
            }); 
        
            function setInfoCalculos(data){
              console.log(data);
              switch(data.idCalculoPagos){
                case 1:
                  $("#cuotaMensual").val(data.cuotaMensual);
                break;
                
                case 3:
                 tableUtilities.clearTable('listaDias');
                  var actual;
                  for(var i = 0;i<data.detalles.length;i++){
                    actual = {};
                    actual.dias = data.detalles[i].veceshorasdias;
                    actual.precioUnitario = data.detalles[i].cuota;
                    tableUtilities.addRow('listaDias', actual);
                  }
                  tableUtilities.draw('listaDias');
                break;
                case 4:
                  tableUtilities.clearTable('listaVeces');
                  var actual;
                  for(var i = 0;i<data.detalles.length;i++){
                    actual = {};
                    actual.veces = data.detalles[i].veceshorasdias;
                    actual.vecesPrecioUnitario = data.detalles[i].cuota;
                    tableUtilities.addRow('listaVeces', actual);
                  }
                  tableUtilities.draw('listaVeces');
                  $("#veces").val(i+1);
                  $("#vecesPrecioUnitario").val(data.detalles[i-1].cuota);
                  $("#vecesPrecioUnitario").focus();
                break;
                case 5:
                  tableUtilities.clearTable('listaHoras');
                  var actual;
                  for(var i = 0;i<data.detalles.length;i++){
                    actual = {};
                    actual.horas = data.detalles[i].veceshorasdias;
                    actual.horasPrecioUnitario = data.detalles[i].cuota;
                    tableUtilities.addRow('listaHoras', actual);
                  }
                  tableUtilities.draw('listaHoras');
                  $("#horas").val(i+1);
                  $("#horasPrecioUnitario").val(data.detalles[i-1].cuota);
                  $("#horasPrecioUnitario").focus();
                break;
              }
            }

            FormEngine.setWarningLabels("seleccionar");
            for(var i = 1;i<=5;i++)
            {
                $("#configurar"+i).append('<div class="col-xs-12 col-sm-12 col-md-12 input-container"><button type="button" class="btn btn-save" data-form="config'+i+'-input" data-function="afterEdit" data-script="cambiarConfiguracionPagos" data-clear="false" id="cambiarConfiguracion'+i+'">Guardar</button></div>');
                $("#idCalculoPagos").addClass('config'+i+'-input');

              FormEngine.setFormEngine("cambiarConfiguracion"+i);
            }

            tableUtilities.createTable('listaDisciplinas', ['nombreDisciplina', {
                key:'precioUnitario',
                validation:{
                  min:0,
                },
                name: 'Cuota Mensual',
                type:'number',
                required:true
            }]);

            tableUtilities.createTable('listaClases', ['nombreGrupo', {
                key:'precioUnitario',
                validation:{
                  min:0,
                },
                name: 'Cuota Mensual',
                type:'number',
                required:true
            }]);
            tableUtilities.createTable('listaDias', ['dias', {
                key:'precioUnitario',
                validation:{
                  min:0,
                },
                name: 'Cuota Mensual',
                type:'number',
                required:true
            }]);

            tableUtilities.createTable('listaVeces', ['veces', {
                key:'vecesPrecioUnitario',
                validation:{
                  min:0,
                },
                name: 'Cuota Mensual',
                type:'number',
                required:true
            }]);

            tableUtilities.createTable('listaHoras', ['horas', {
                key:'horasPrecioUnitario',
                validation:{
                  min:0,
                },
                name: 'Cuota Mensual',
                type:'number',
                required:true
            }]);

            function agregarDisciplina(data) {
              data.precioUnitario = 0;
              if(data.listaCalculos.length==1){
                if(data.listaCalculos[0].veceshorasdias==-1){
                  data.precioUnitario = data.listaCalculos[0].cuota;
                }
              }
              return data;
            }

            function agregarClase(data){
              data.precioUnitario = data.precio;
              return data;
            }

            FormEngine.setWarningLabels('veces-input');

            $("#listaVecesAdd").click(function (){
                var data = {}, cont = true;
                $(".veces-input").each(function (){
                  if(FormEngine.validateObject($(this))){
                    data[$(this).attr('id')] = $(this).val();
                  }else{
                    cont = false;
                  }
                });
                if(cont){
                  if(!tableUtilities.isInTable('listaVeces', {veces:data.veces})){
                      tableUtilities.addRowDraw('listaVeces', data);
                      $("#veces").val(Number($("#veces").val())+1);
                      $("#vecesPrecioUnitario").focus();
                  }
                }
            });

            $("#listaHorasAdd").click(function (){
                var data = {}, cont = true;
                $(".horas-input").each(function (){
                  if(FormEngine.validateObject($(this))){
                    data[$(this).attr('id')] = $(this).val();
                  }else{
                    cont = false;
                  }
                });
                if(cont){
                  if(!tableUtilities.isInTable('listaHoras', {veces:data.veces})){
                      tableUtilities.addRowDraw('listaHoras', data);
                      $("#horas").val(Number($("#horas").val())+1);
                      $("#horasPrecioUnitario").focus();
                  }
                }
            });
            function getConfig(){
              Utilizer.getResponse('getConfiguracionPago', {}, loadConfig);
            }

            function borrarUltimo (){
                var data = tableUtilities.getTableData($(this).data('table'));
                if(data.length==0){ return; }
                var key = $("#"+$(this).data('table')).data('unique');
                var value = data[data.length-1][key];
                var obj = {};
                obj[key] = value;
                tableUtilities.deleteRow($(this).data('table'), obj);
                $("#"+key).val(value);
            }

            function loadConfig(data){
            }

            function setDelete(){ $(".ultimo").unbind(); $(".ultimo").click(borrarUltimo); }

            function setEnter(){ $(".enter").unbind(); $(".enter").keypress(checkEnter); }

            function checkEnter(event){ e = event; if(e.which == 13) { $("#"+$(this).data('boton')).trigger('click'); } }

            setDelete();
            setEnter();
      });
      function afterEdit(){
       var config_calculo = $('#tipoSelect').val();
       if(config_calculo == 2)
       { //carga disciplinas configuradas
        cargaDisciplinas();
       } else if(config_calculo == 3){ //carga equipos configurados
        cargaEquipos();
       }

      }
      function cargaEquipos(){
        $.ajax
        ({
            url: "ajax/cargaEquipos.php",
            type: "POST",
            data: {accion: "equipos"},
            success: function (result)
            {
                $("#configuracionActual").html(result);
            }
        });
      }
      function cargaDisciplinas(){
        $.ajax
        ({
            url: "ajax/cargaDisciplinas.php",
            type: "POST",
            data: {accion: "disciplinas"},
            success: function (result) {
                $("#configuracionActual").html(result);
            }
        });
      }
    </script>