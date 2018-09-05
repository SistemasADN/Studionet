<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-plus"></i> </div>
    <div class="text-container"> CAPTURAR EGRESO</div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"><abbr title = 'Por favor llene la forma para generar el egreso'>DATOS DEL EGRESO </abbr></div>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 input-container spec">
          <select class="selectpicker form-egreso" data-live-search="true" required id="idTipoEgreso"> </select>
        </div>


        <div class="col-xs-12 col-sm-6 col-md-6 input-container date-container form-egreso form-personal form-transferencia" hidden>
          <label class='label-fecha fecha'>FECHA</label>
          <div class="input-group date form-egreso form-personal form-transferencia" id="fechaSelect"> <span class="input-group-addon">
              <i class="glyphicon glyphicon-calendar"></i>
          </span>
            <input type="text" class="form-control date" required id="fechaSelectText"> </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12 input-container form-personal" hidden>
          <select class="selectpicker form-personal" data-live-search="false" required id="idPersonal" data-label="Personal"> </select>
        </div>

                  <div class="col-xs-12 col-sm-12 col-md-12 input-container form-egreso form-personal" hidden>
            <select class="selectpicker form-egreso form-personal" data-live-search="true" required id="idCuenta"> </select>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-transferencia" hidden>
            <select class="selectpicker form-transferencia" data-live-search="true" required id="idCuentaOrigen"> </select>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-transferencia" hidden>
            <select class="selectpicker form-transferencia" data-live-search="true" required id="idCuentaDestino"> </select>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-personal" hidden>
            <select class="selectpicker form-personal" data-live-search="false" required id="idModalidadPago" data-label="Modalidad de Pago"> </select>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-personal" hidden>
            <div class="col-xs-12 col-sm-6 col-md-6 input-container form-personal">
              <label class='label-fecha'>INICIO PERIODO PAGO</label>
              <div class="input-group date form-personal" data-paired = "fechaFinal" id="fechaInicio"> <span class="input-group-addon">
                  <i class="glyphicon glyphicon-calendar"></i>
              </span>
                <input type="text" class="form-control  date" required id="fechaInicioText"> </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 input-container form-personal">
              <label class='label-fecha'>FIN PERIODO PAGO</label>
              <div class="input-group date form-personal" id="fechaFinal"> <span class="input-group-addon">
                  <i class="glyphicon glyphicon-calendar"></i>
              </span>
                <input type="text" class="form-control date" required id="fechaFinalText"> </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container unidadCalculoContainer">
            <div class="jumbotron jumbotron-container">
              <div class="jumbotron-text"> CALCULO DE PAGO </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container unidadCalculoContainerStatic" >
            <label class='label-right col-xs-4 col-sm-2 col-md-3' id = 'unidadCalculoTextStatic'></label>
            <input type="number" class="information-display col-xs-8 col-sm-10 col-md-9 form-personal"  disabled id="unidadCalculoStatic"/>
            <input type="hidden" class="col-xs-8 col-sm-10 col-md-9 form-personal"  disabled id="montoCalculoStatic"/>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container unidadCalculoContainer" >
            <label class='label-right col-xs-4 col-sm-2 col-md-3' id = 'unidadCalculoText'></label>
            <input type="number" class="col-xs-8 col-sm-10 col-md-9" id="unidadCalculo"/>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container unidadCalculoContainer">
            <label class='label-right col-xs-4 col-sm-2 col-md-3'>SUELDO POR UNIDAD</label>
            <input type="number" class="col-xs-8 col-sm-10 col-md-9" id="sueldoUnidad"/>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container unidadCalculoContainer">
            <label class='label-right'>Los datos de CALCULO DE PAGO sirven exclusivamente para calcular la cantidad a pagar. No se guardan en el sistema ni cambian algún dato. </label>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-egreso form-personal form-transferencia" hidden>
            <select class="selectpicker form-egreso form-personal form-transferencia" data-live-search="false" required id="idFormaPago" data-label="Forma de Pago"> </select>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-egreso form-personal form-transferencia" hidden>
            <input type="number" data-subtype="coin" class="form-control form-egreso form-personal form-transferencia" required id="cantidad" placeholder="Monto" name="Pago">
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-egreso" hidden>
            <input type="text" class="form-control form-egreso" required id="beneficiario" placeholder="Beneficiario">
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-egreso form-personal form-transferencia" hidden>
            <input type="text" class="form-control form-egreso form-personal form-transferencia" required id="concepto" placeholder="Concepto">
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-egreso form-personal form-transferencia" hidden>
            <input type="text" class="form-control form-egreso form-personal form-transferencia" id="referencia" placeholder="Referencia">
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-egreso form-personal form-transferencia " hidden>
            <input type="text" class="form-control form-egreso form-personal form-transferencia" id="comentarios" placeholder="Comentarios">
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 input-container form-egreso form-transferencia form-personal" hidden>
            Crear y aprobar egreso?
            <input type="checkbox" id="aprobar" class='form-input form-personal form-egreso form-transferencia switcher'> </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 input-container spec">
            <button style = "display:none" type="button" class="btn btn-save form-egreso" data-form="form-egreso" data-script="agregarEgreso" data-function="afterEdit" data-clear="true" id="agregarEgreso">capturar egreso</button>
            <button style = "display:none" type="button" class="btn btn-save form-personal" data-form="form-personal" data-script="agregarPagoPersonal" data-function="afterEdit" data-clear="true" id="agregarEgresoPersonal">capturar egreso</button>
            <button style = "display:none" type="button" class="btn btn-save form-transferencia" data-form="form-transferencia" data-script="agregarTransferencia" data-function="afterEdit" data-clear="true" id="agregarTransferencia">capturar egreso</button>
          </div>
      </fieldset>
    </div>
  </div>

  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        //Csser.collapse(3, 1);
        Utilizer.loadSelect('idFormaPago', 'formaPagoSelect', 'Forma de Pago');

        Utilizer.loadSelect('idCuenta', 				  'selectCuenta', 			'Cuenta');
      	Utilizer.loadSelect('idCuentaOrigen', 	  'selectCuenta', 			'Cuenta Origen');
      	Utilizer.loadSelect('idTipoEgreso', 		  'selectTipoEgreso', 	'Tipo de Egreso', {}, easyLoad);
      	Utilizer.loadSelect('idPersonal', 		    'personalSelect', 	  'Personal');
      	Utilizer.loadSelect('idModalidadPago', 		'modalidadPagoSelect','Modalidad de Pago');

        Utilizer.makeDatepicker('fechaSelect');
        Utilizer.makeDatepicker('fechaInicio');
        Utilizer.makeDatepicker('fechaFinal');

        Utilizer.setToggler("aprobar", "SI", "NO");
        function easyLoad(){
          Utilizer.setPicker('idTipoEgreso', 3);
          $("#idTipoEgreso").trigger('change');
        }

        $("#idPersonal").change(()=>{
          Utilizer.fillForm(Utilizer.getSelected('idPersonal').data());
          $("#sueldoUnidad").val($("#cantidad").val());
          $("#idModalidadPago").trigger('change');
        });

        $("#fechaFinal, #fechaInicio").change(function (){
            var data = {};
            data.idPersonal = $("#idPersonal").val();
            data.fechaInicial = Utilizer.fechaParseToDbDate($("#fechaInicioText").val());
            data.fechaFinal = Utilizer.fechaParseToDbDate($("#fechaFinalText").val());
            data.idModalidadPago = $("#idModalidadPago").val();
            data.esProfesor = Utilizer.getSelected('idPersonal').data('esProfesor');
            if(!Utilizer.objectHasNullUndefined(data)){
              Utilizer.getResponse('getObjetoModalidad', data, setObjetoModalidad, event.currentTarget);
            }
        });

        $("#idModalidadPago").change(function (){
          console.log("idModalidadPago change");
          var sel = Utilizer.getSelected('idModalidadPago');
          Utilizer.clearDatePairClasses('fechaInicio');
          switch($(sel).text()){
            case 'Clase':
                texto = "Clase(s)";
            break; //Inicio - Fin
            case 'Maquila':
                texto = "Unidad";
            break;  //Inicio - Fin
            case 'Mensual':
                Utilizer.bindSetDatePair('fechaInicio');
                $("#fechaInicio").addClass('month'); texto = "Unidad";
                Utilizer.setDatePair('fechaInicio');
            break;  //1 al fin de mes
            case 'Por Hora':
                texto = "Horas"; break; //Inicio - Fin
            case 'Quincenal':
                Utilizer.bindSetDatePair('fechaInicio');
                $("#fechaInicio").addClass('fortnight'); texto = "Unidad";
                Utilizer.setDatePair('fechaInicio');
            break; //1-15, 16-fin de mes
            case 'Semanal':
                Utilizer.bindSetDatePair('fechaInicio');
                $("#fechaInicio").addClass('week'); texto = "Unidad";
                Utilizer.setDatePair('fechaInicio');
            break; //Semana
            case 'Dia':
                texto = "Días";
            break; //Inicio - fin
            default:
                  texto = "Unidad";

            break;
          }

          $("#unidadCalculoTextStatic").text(texto+' en calculo para el periodo:');
          $("#unidadCalculoText").text(texto+' para calcular');
          $("#fechaInicio").trigger('change');
        });

        function setObjetoModalidad(data){
          var cantidad = data.veces;
          $(".unidadCalculoContainer").show();
          $(".unidadCalculoStatic").hide();
          if($("#unidadCalculoTextStatic").text()!="Unidad en calculo para el periodo:"){
            $(".unidadCalculoContainerStatic").show();
          }else{
            $(".unidadCalculoContainerStatic").hide();
          }
            $("#unidadCalculo").val(cantidad);
            $("#unidadCalculoStatic").val(cantidad);
            $("#unidadCalculo").trigger('change');
            $("#montoCalculoStatic").val(Number($("#unidadCalculo").val())*Number($("#sueldoUnidad").val()));
        }

        $("#unidadCalculo, #sueldoUnidad").change(function (){
            $("#cantidad").val(Number($("#unidadCalculo").val())*Number($("#sueldoUnidad").val()));
        });

        $("#idCuentaOrigen").change(cargarDestino);
        $("#idCuentaDestino").change(cargarSaldoDestino);



        $("#idTipoEgreso").change(function (){
            var sel = Utilizer.getSelected('idTipoEgreso');
            console.log($(sel).text());
            var clas = "";
            $(".label-fecha.fecha").text("FECHA");
            switch($(sel).text()){
              case 'Sueldos y Salarios':
                clas = 'personal';
                $(".label-fecha.fecha").text("FECHA DE PAGO");
              break;
              case 'Transferencia entre cuentas':
                clas = 'transferencia';
              break;
              default:
                clas = 'egreso';
              break;
            }

            $(".input-container").each(function(){
              if(!$(this).hasClass('spec')){
                $(this).hide();
              }
            });

            $(".btn-save").each(function(){
              $(this).hide();
            });
            $(".form-"+clas).each(function(){
              $(this).show();
            });

        });


        	function cargarDestino(event){
        		var idC = $(event.target).val(), saldo = Utilizer.getSelected(event.target.id).data('saldo');
        		//$("#cantidad").data('max', saldo);
        		$("#saldoActualOrigen").html("Saldo: $"+saldo);
        		Utilizer.loadSelect('idCuentaDestino', 	'selectCuenta', 'Cuenta Destino', {}, disableDestino, idC);
        	}

        	function cargarSaldoDestino(event){
        		var idC = $(event.target).val(), saldo = Utilizer.getSelected(event.target.id).data('saldo');
        		$("#saldoActualDestino").html("Saldo: $"+saldo);
        	}

        	function disableDestino(extra){
        		Utilizer.disableSelectOption('idCuentaDestino', extra);
        	}

        FormEngine.setFormEngine('agregarEgreso');
        FormEngine.setFormEngine('agregarEgresoPersonal');
        FormEngine.setFormEngine('agregarTransferencia');
      });

      function afterEdit(data, extra) {}
    </script>
