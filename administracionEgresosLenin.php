<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-gamepad"></i> </div>
    <div class="text-container"> PLAYGROUND LENIN</div>
  </div>
  <div>
    TESTING GROUNDS
      <div id = "input">1 5 9 20</div>
      <div id = "output">OUTPUT</div>
    TESTING GROUNDS
  </div>

  <script>
//0,1,2,3,4,5,6,7,8,9,10
$(document).ready(function(){
  $("#output").text(min_product);

  function min_product(){
    $("#input").text("294");
    //7*7*6
    /*
    var input = Number($("#input").text()), temp, num, i = 0;
    do{
      temp = i.toString(); num = 1;
      for(var j = 0;j<temp.length;j++){
        if(temp[j]=="0"){
          num = 0;
          break;
        }
        num *= Number(temp[j]);
      }
      console.log(i+" "+num);
      if(num===input){
        return i;
      }
      i++
    }while(input>num);
    /**/
    return -1;
  }

  function min_weight (){
    $("#input").text("5 8 13 27 14");
    var input = $("#input").text(), output, min;
    input = input.split(" ");
    for(i = 0; i<input.length; i++){
      for(j = i+1; j<input.length; j++){
        if(min===undefined){
          min = Math.abs(input[i]-input[j]);
        }else if(Math.abs(input[i]-input[j])<min){
          min = Math.abs(input[i]-input[j]);
        }
      }
    }
    output = min;
    return output;
  }


//  Itera un arreglo de objetos. por cada elemento, si es un cobro la cantiudad se suma, si es un pago la cantidad se resta, si está aprobado se toma en cuenta ,si no se ignora. Imprimir suma total al final.

var inicial = 0;
var lista = [
	{nombre: 'Cobro', cantidad:300, aprobado:0},
	{nombre: 'Pago', cantidad:200, aprobado:1},
	{nombre: 'Pago', cantidad:200, aprobado:0},
	{nombre: 'Cobro',  cantidad:500, aprobado:1},
];

for(var i = 0;i<lista.length;i++){
  console.log(valoresAprobados(lista[i]));
	inicial += valoresAprobados(lista[i]);
}

function valoresAprobados(obj){
  if(obj.aprobado===0){
    return 0;
  }

	if(obj.nombre ==='Cobro'){
	  return obj.cantidad;
	}else{
    return obj.cantidad*-1;
  }
}


for(var i = 0;i<lista.length;i++){
  if(lista[i].aprobado===0){
    continue;
  }
  if(lista[i].nombre ==='Cobro'){
    inicial+= lista[i].cantidad;
  }else{
    inicial-= lista[i].cantidad;
  }
}

});

  </script>
  <!--
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> DATOS DEL EGRESO </div>
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
            <button style = "display:none" type="button" class="btn btn-save form-egreso" data-form="form-egreso" data-script="agregarEgreso" data-function="afterEdit" data-clear="true" id="agregarEgreso">Guardar</button>
            <button style = "display:none" type="button" class="btn btn-save form-personal" data-form="form-personal" data-script="agregarPagoPersonal" data-function="afterEdit" data-clear="true" id="agregarEgresoPersonal">Guardar</button>
            <button style = "display:none" type="button" class="btn btn-save form-transferencia" data-form="form-transferencia" data-script="agregarTransferencia" data-function="afterEdit" data-clear="true" id="agregarTransferencia">Guardar</button>
          </div>
      </fieldset>
    </div>
  </div>
-->
  <?php include 'templates/bottom.php'; ?>
  <!--
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
            case 'Grupo':
                texto = "Grupo(s)";
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
-->
