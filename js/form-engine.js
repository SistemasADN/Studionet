var FormEngine = {};
$(document).ready(function () {

  jQuery.fn.ucwords = function () {
    return this.each(function () {
      var val = $(this).val(), newVal = '';
      val = val.toLowerCase();
      val = val.split(' ');
      for (var c = 0; c < val.length; c++) {
        newVal += val[c].substring(0, 1).toUpperCase() + (val[c].substring(1, val[c].length) + (c + 1 == val.length ? '' : ' ')).toLowerCase();
      }
      $(this).val(newVal);
    });
  }

  FormEngine.sendForm = function (event) {
    var dat = {};
    //La clase que se va a iterar
    var boton = this;
    var clas = $(boton).data('form');
    if (clas != undefined) {
      var php = $(boton).data('script'); //El script que se va a ejecutar
      if (php != undefined) {
        if (FormEngine.validateForm(clas)) {//validamos la forma, si la forma es valida, no se hace nada porque validateForm crea mensajes para los inputs no validos
          dat = FormEngine.getFormData(clas);
          extra = FormEngine.getFormExtra(clas);
          var formDelete = $(boton).data('clear');
          $.ajax({
            type: 'post'
            , url: 'queries/' + php + '.php'
            , data: dat
            , success: function (data) {
              //console.log(data);//console.log(data.length);//Descomentar para ver que regresa el servidor.
              if (data) {
                data = data.split('|');
                switch (data[0]) {
                case 's':
                  if (formDelete != undefined) {
                    if (formDelete) {
                      FormEngine.deleteForm(clas);
                    }
                  }

                    if ($(boton).data('function') !== undefined) {
                      var func = $(boton).data('function');
                      if(window[func]!==undefined){
												window[func](dat, extra);
											}else{
												Messager.addAlertText('formEngine',"El atributo [data-function] apunta a una función que no existe en el contexto de la ventana. Si esa funciona está declarada, asegurese de que esté afuera de cualquier contexto: ejemplo: fuera de: $(document).ready(function(){}). ",'e');
											}
                    }

                  if ($(boton).parent().hasClass('modal-footer')) {
                    $('#' + $(boton).parent().parent().parent().parent().attr('id')).modal('hide');
                  }
                  break;
                case 'e':
                  break;
                default:
                  console.log("Respuesta php desde "+php+"[" + data + "]:Respuesta php");
                  $("#respuestaPhp").html(data);
                  data[0] = "e";
                  data[1] = "Problema del codigo";
                  data[2] = "Ha habido un problema con la ejecucion del codigo. Vea la consola para mas informacion.";

                  break;
                }
                Messager.addAlertText(data[1], data[2], data[0]);
                if(data[3]!==undefined){
                  if ($(boton).data('function') !== undefined) {
                    var func = $(boton).data('function');
                    window[func](JSON.parse(data[3]), extra);
                  }
                }
              }
            }
            , error: function () {
              Messager.addAlertText('Error en servidor', "No se ha podido comenzar a ejecutar el código.", 'e');
            }
          });
        }else {
          Messager.addAlertText('Forma','Algunos campos de la forma no son validos.','e');
        } //validateForm
      }
      else {
        Messager.addAlertText('Error Creación Forma', 'El atributo data-script no existe en este botón.', 'e');
      }
    }
    else {
      Messager.addAlertText('Error Creación Forma', "El atributo data-form no existe en este botón.", 'e');
    }
  }

  FormEngine.getObjectData = function (obj){
		if($(obj).attr('id')!=undefined){
			//console.log("ID:"+$(obj).attr('id')+", VAL:"+$(obj).val()); //Descomentar esta y las //console.log(IDS) si se quieren saber los ids para el validador en php
			var value = "", id = $(obj).attr('id')
			if($(obj).val()!=null){
				if($(obj).hasClass('date')){
					if($(obj).find('.dateTime').length>0){
						value = Utilizer.dateTimeParseToDbDate($(obj).find("input").val());
					}else{
						value = Utilizer.fechaParseToDbDate($(obj).find("input").val());
					}
				}else if($(obj).hasClass('date-input')){
					value = Utilizer.fechaParseToDbDate($(obj).val());
				}else if($(obj).hasClass('grid')){
					//console.log("ES UN GRID");
					var keys = $(obj).data('keys'),  value = [];
					if(keys!==undefined){
						keys = keys.split(',');
					}
					//console.log("ID ["+id+"]");console.log("KEYS");console.log(keys);console.log("SEARCH");
					$(obj).find(".is-selected").each(function () {
							if(keys===undefined){
								value.push($(this).data());
							}else{
								value.push(_.pick($(this).data(), keys));
							}
					});
					//console.log("END SEARCH");console.log("VALOR DE GRID");console.log(value);console.log("END GRID");
				} else if($(obj).hasClass('table')||$(obj).is('table')){
          console.log(obj);
					if($(obj).data('keys')){
						value = tableUtilities.getTableData($(obj).attr('id'), $(obj).data('keys').split(','));
					}else{
						value = tableUtilities.getTableData($(obj).attr('id'));
					}
          if($(obj).data('selected')){
            console.log("HAS DATA SELECTED");
            for(var i = 0;i<value.length;i++){
              if(value[i][$(obj).data['selected']!==undefined]) {
                if(!value[i][$(obj).data['selected']]) {
                  value = value.splice(i, 1);
                }
              }
            }
          }
				}else if($(obj).attr('type')=="checkbox"){
					//console.log($(obj).attr('id')+" es un checkbox");
					if($(obj).parent().hasClass('bootstrap-switch-container')){
						value = {};
						value[$(obj).attr('id')] = Utilizer.getTogglerValue($(obj).attr('id'));
						value[$(obj).attr('id')+"Text"] = Utilizer.getTogglerText($(obj).attr('id'));
					}else{
						value = $(obj).prop('checked');
					}
				}else if($(obj).hasClass('radioButtonGroup')){
						value = {};
						value.value = Utilizer.getRadioButtonGroupValue(id);
						value.text = Utilizer.getRadioButtonGroupText(id);
				}else if($(obj).is('div')){
							value = $(obj).text();
				}else{
						//console.log('Other: ');
						value = $(obj).val();
						if ($(obj).hasClass('upper')){
							//console.log('Upper: ');
							value = value.toUpperCase();
						}else if ($(obj).hasClass('capitalize')){
							//console.log('Cap: ');
							value = value.toLowerCase().split(' ');
							for (var i = 0; i < value.length; i++) {
								value[i] = value[i].charAt(0).toUpperCase() + value[i].substring(1);
							}
							value = value.join(' ');
						}
						//console.log(value);
					}
			}else{
					value = "";
			}
			return value;
		}
	}

  FormEngine.deleteForm = function (clas) {
    $('.' + clas).each(function (index) {
      if ($(this).attr('id') != undefined) {
        if($(this).data('default')!==undefined){
          $(this).val($(this).data('default'));
        }else{
          $(this).val("");
        }

        if ($(this).hasClass('selectpicker')) {
          $(this).selectpicker('refresh');
        }

        if ($(this).hasClass('datepicker')) {
          $(this).datepicker('setDate', Utilizer.dateParseToFecha(new Date()));
        }
        if ($(this).parent().hasClass('date')) {
          Utilizer.makeDatepicker($(this).parent().attr('id'));
        }

        if($(this).hasClass('table')){
          tableUtilities.clearTable($(this).attr('id'));
        }
        if($(this).hasClass('timepicker')){
          $(this).val(Utilizer.makeValidTimeFromString($(this).data('default')));
        }
      }
    });
  }

  FormEngine.validateForm = function (clas) {
    var valido = true;
    $('.' + clas).each(function (index) {
      if ($(this).attr('id') != undefined) {
        if (!FormEngine.validateObject(this)) {
          valido = false;
        }
      }
    });
    return valido;
  }

  FormEngine.getObjectData = function (obj){
		if($(obj).attr('id')!=undefined){
			//console.log("ID:"+$(obj).attr('id')+", VAL:"+$(obj).val()); //Descomentar esta y las //console.log(IDS) si se quieren saber los ids para el validador en php
			var value = "", id = $(obj).attr('id');
			if($(obj).val()!=null){
        //console.log($(this));
        if ($(obj).hasClass('timepicker')){
          //console.log("IS TIME PICKER");
            value = $(obj).val().replace(/ /g,'');
            value = value.split(":");
            //console.log(value);
            if(value[1].includes('AM')){
              value[1] = value[1].replace("AM", '');
              if(value[0]==12){
                value[0] = 0;
              }
            }else{
              value[1] = value[1].replace("PM", '');
              value[0] = Number(value[0])+12;
            }
            if(value[0]<10){
              value[0] = "0"+value[0];
            }
            value = value[0]+":"+value[1];
        } else if($(obj).hasClass('date')){
					if($(obj).find('.dateTime').length>0){
						value = Utilizer.dateTimeParseToDbDate($(obj).find("input").val());
					}else{
						value = Utilizer.fechaParseToDbDate($(obj).find("input").val());
					}
				}else if($(obj).hasClass('date-input')){
					value = Utilizer.fechaParseToDbDate($(obj).val());
				}else if($(obj).hasClass('grid')){
					//console.log("ES UN GRID");
					var keys = $(obj).data('keys'),  value = [];
					if(keys!==undefined){
						keys = keys.split(',');
					}
					//console.log("ID ["+id+"]");console.log("KEYS");console.log(keys);console.log("SEARCH");
					$(obj).find(".is-selected").each(function () {
							if(keys===undefined){
								value.push($(this).data());
							}else{
								value.push(_.pick($(this).data(), keys));
							}
					});
					//console.log("END SEARCH");console.log("VALOR DE GRID");console.log(value);console.log("END GRID");
				} else if($(obj).hasClass('table')||$(obj).is('table')){
					if($(obj).data('keys')){
						value = tableUtilities.getTableData($(obj).attr('id'), $(obj).data('keys').split(','));
					}else{
						value = tableUtilities.getTableData($(obj).attr('id'));
					}
					//console.log("SACANDO DATOS DE LA TABLA");console.log(value);
				}else if($(obj).attr('type')=="checkbox"){
					//console.log($(obj).attr('id')+" es un checkbox");
					if($(obj).parent().hasClass('bootstrap-switch-container')){
            /*
						      value = {};
						      value[$(obj).attr('id')] = Utilizer.getTogglerValue($(obj).attr('id'));
						      value[$(obj).attr('id')+"Text"] = Utilizer.getTogglerText($(obj).attr('id'));
            */
            value = Utilizer.getTogglerValue($(obj).attr('id'));
					}else{
						value = $(obj).prop('checked');
					}
				}else if($(obj).hasClass('radioButtonGroup')){
						value = {};
						value.value = Utilizer.getRadioButtonGroupValue(id);
						value.text = Utilizer.getRadioButtonGroupText(id);
				}else if($(obj).is('div')){
							value = $(obj).text();
				}else{
						//console.log('Other: ');
						value = $(obj).val();
						if ($(obj).hasClass('upper')){
							//console.log('Upper: ');
							value = value.toUpperCase();
						}else if ($(obj).hasClass('capitalize')){
							//console.log('Cap: ');
							value = value.toLowerCase().split(' ');
							for (var i = 0; i < value.length; i++) {
								value[i] = value[i].charAt(0).toUpperCase() + value[i].substring(1);
							}
							value = value.join(' ');
						}
						//console.log(value);
					}
			}else{
					value = "";
			}
			return value;
		}
	}

  FormEngine.getFormData = function(clas){
  //console.log("CLASS:"+clas);//Descomentar para asegurar que la clase se esté pasando bien
  //console.log('Datos: ');
  var datos = {};
  $('.'+clas).each(function (index){
      datos[$(this).attr('id')] = FormEngine.getObjectData(this);
  });
  //console.log("DATA"); //console.log(datos); //console.log("DATA"); //Descomentar estas lineas si se quiere saber la data que se está pasando.
  return datos;
}

  FormEngine.getFormExtra = function (clas) {
    //console.log("CLASS:"+clas);//Descomentar para asegurar que la clase se esté pasando bien
    var datos = {};
    $('.' + clas).each(function (index) {
      if ($(this).attr('id') != undefined) {
        //console.log("ID:"+$(this).attr('id')+", VAL:"+$(this).val()); //Descomentar esta y las //console.log(IDS) si se quieren saber los ids para el validador en php
        var value = "";
        var id = $(this).attr('id');
        if ($(this).val() != null) {
          if ($(this).hasClass('selectpicker')) {
            datos[id] = Utilizer.getSelected($(this).attr('id')).text();
          }
          else if (id.slice(0, 10) == 'postalcode') {
            var end = id.replace('postalcode', '');
            datos['country' + end] = $('#country' + end).val();
            datos['state' + end] = $('#state' + end).val();
            datos['city' + end] = $('#city' + end).val();
          }
        }
      }
    });
    //console.log("DATA"); //console.log(datos); //console.log("DATA"); //Descomentar estas lineas si se quiere saber la data que se está pasando.
    return datos;
  }
  FormEngine.setFormEngine = function (id) {
    var boton = $('#' + id);
    if(!boton.exists()){
        Messager.addAlertText('Error Form Engine', "El botón " + id + " no EXISTE.", 'e');return;
    }
    var clas = boton.data('form');
    FormEngine.markRequired(clas);
    var php = boton.data('script');
    var clear = boton.data('clear');
    var subtype = boton.data('subtype');
    if (clas != undefined && php != undefined && clear != undefined) {
      $('.' + clas + ':first').focus();
      boton.on('click', FormEngine.sendForm);
      FormEngine.setWarningLabels(clas);
      //FormEngine.setClearables();
    }
    else {
      if (clas == undefined) {
        Messager.addAlertText('Error Form Engine', "El botón " + id + " no tiene data-form.", 'e');
      }
      if (php == undefined) {
        Messager.addAlertText('Error Form Engine', "El botón " + id + " no tiene data-script.", 'e');
      }
      if (clear == undefined) {
        Messager.addAlertText('Error Form Engine', "El botón " + id + " no tiene data-clear.", 'e');
      }
    }
  }
  FormEngine.setWarningLabel = function (obj){
    if ($(obj).attr("type") != 'hidden') {
      $(obj).on('blur', FormEngine.validateFunction);
      if ($(obj).hasClass('date-input')) {
        $(obj).parent().after("<div id = '" + $(obj).attr('id') + "_warn' class = 'validator-warn'></div>");
      } else if($(obj).hasClass('selectpicker')){
        if(!$(obj).prop('required')){
          var i = $('<button class="btn btn-cancel-select" data-id = "'+$(obj).attr('id')+'">Cancelar Selección<i class="fa fa-times" aria-hidden="true"></i></button>');
          $(obj).after(i);
          $(i).click(function (){
              console.log("Cancelar selección");
              Utilizer.setPicker($(this).data('id'), '');
              Utilizer.setPicker($(this).data('id'), '');
          });
        }
        $(obj).parent().after("<div id = '" + $(obj).attr('id') + "_warn' class = 'validator-warn'></div>");
      } else if($(obj).hasClass('timepicker')){
          $(obj).parent().after("<div id = '" + $(obj).attr('id') + "_warn' class = 'validator-warn'></div>");
      }else{
        $(obj).after("<div id = '" + $(obj).attr('id') + "_warn' class = 'validator-warn'></div>");
      }
    }
  }

  FormEngine.setWarningLabels = function (clas){
    $("." + clas).each(function () {
      FormEngine.setWarningLabel(this);
    });
  }

  FormEngine.validateObject = function (t, print) { //Validador
    if(print===undefined){
      print = true;
    }
    //console.log(t.id);
    var txt = "";
    var id = $(t).attr('id');
    var value = "";
    //console.log("VALIDANDO");console.log(t);console.log(value);console.log(id);
    if($(t).hasClass('table')){
      if($(t).data('keys')){
        //console.log("KEYS:"+$(t).data('keys'));
        value = tableUtilities.getTableData($(t).attr('id'), $(t).data('keys').split(','));
      }else{
        value = tableUtilities.getTableData($(t).attr('id'));
      }
    }else if($(t).hasClass('date')){
      //console.log("AQUI");
      value = $("#"+id+"Text").val();
      if(value===undefined){
        value = $("#"+id).val();
      }
      //console.log(value);
    }else{
      value = $(t).val();
      //console.log(t);console.log(value);
    }

    var label = $(t).data('label');
    var length = "";
    if (value == null) {
      length = 0;
    }else {
      length = value.length;
    }
    //console.log(length);
    var type = $(t).attr("type");
    var subtype = $(t).data("subtype");
    //console.log("Label:"+label+", Valor: "+value+", Length:"+length+", Type:"+type+", Subtype:"+subtype);
    //Checar que sea requerido
    //console.log("REQUIRED");console.log("t.required ["+t.required+"]");console.log("$(t).hasClass('required') ["+$(t).hasClass('required')+"]");console.log("$(t).attr('required') ["+$(t).attr('required')+"]");
    if (t.required||$(t).hasClass('required')||$(t).attr('required')) {
      if (length == 0) {
        if($(t).hasClass('table')){
          txt += "Se requiere al menos un elemento en la tabla.";
        }else{
          txt += "Es un campo requerido.";
        }

        if($(t).data('table')){
          tableUtilities.getDataTable($(t).data('table')).$('#' + id).removeClass('valid');
          tableUtilities.getDataTable($(t).data('table')).$('#' + id).addClass('invalid');
          tableUtilities.getDataTable($(t).data('table')).$('#' + id + '_warn').html(txt);
        }else{
          $('#' + id).addClass('invalid');
          $('#' + id).removeClass('valid');
          $('#' + id + '_warn').html(txt);
        }
        //$('#'+id+'_warn').html(label+": "+txt);
        return false;
      }
    }else {
      if (length == 0) {
        if($(t).data('table')){
          tableUtilities.getDataTable($(t).data('table')).$('#' + id).removeClass('invalid');
          tableUtilities.getDataTable($(t).data('table')).$('#' + id).addClass('valid');
          tableUtilities.getDataTable($(t).data('table')).$('#' + id + '_warn').html('');
        }else{
            $('#' + id + '_warn').html('');
            $('#' + id).removeClass('invalid');
            $('#' + id).addClass('valid');
        }
        return true;
      }
    }
    if($(t).hasClass('table')){
      txt += tableUtilities.validateTableObjects($(t).attr('id'), value);
      //console.log("AFTER validateTableObjects");console.log(txt);
    }
    //Checar valor minimo
    if ($(t).data('min')||$(t).data('min')===0) {
      var nmin = $(t).data('min');
      if (value < nmin) {
        txt += "Se requiere un valor mínimo de " + nmin + ".";
      }
    }
    //Checar valor maximo
    if ($(t).data('max')) {
      var nmax = $(t).data('max');
      if (value > nmax) {
        txt += "Se requiere un valor máximo de " + nmax + ".";
      }
    }
    //Checar numero eminimo
    if ($(t).data('emin')) {
      var emin = $(t).data('emin');
      if (value <= emin) {
        txt += "Se requiere un valor mayor a " + emin + ". ";
      }
    }
    //Checar numero emaximo
    if ($(t).data('emax')) {
      var emax = $(t).data('emax');
      if (value >= emax) {
        txt += "Se requiere un valor menor a " + emax + ". ";
      }
    }
    //Checar tamaño minimo
    if ($(t).data('minlength')) {
      var min = $(t).data('minlength');
      if (length < min) {
        txt += "Se requiere un mínimo de " + min + " carácteres. Hay: " + length + " .";
      }
    }
    //Checar tamaño maximo
    if ($(t).data('maxlength')) {
      var max = $(t).data('maxlength');
      if (length > max) {
        txt += "Se requiere un máximo de " + max + " carácteres. Hay: " + length + " .";
      }
    }
    //Checar tamaño eLength
    if ($(t).data('elength')) {
      var eLength = $(t).data('elength');
      if (length != eLength) {
        txt += "Debe de tener exactamente " + eLength + " carácteres. Hay: " + length + " .";
      }
    }
    //Checar campos iguales
    if (subtype !== undefined) {
      if (subtype.slice(0, 2) == "e|") {
        var id2 = subtype.replace("e|", "");
        if ($(t).val() != $("#" + id2).val()) {
          txt += "La nueva contraseña y la confirmación no son iguales. ";
        }
      }
    }
    /**/
    //regexp
    var reg = "";
    var mensaje = "";
    if (type == "text") {
      switch (subtype) {
        //VALIDACION!
      case 'alpha':
        reg = '^[A-Za-záéíóúñÑÁÉÍÓÚÜü ]+$'
        mensaje = "letras mayúsculas, minúsculas y espacios."
        break;
      case 'alphnum':
        reg = '^[0-9A-Za-záéíóúñÑÁÉÍÓÚÜü ]+$'
        mensaje = "números, letras mayúsculas, minúsculas y espacios."
        break;
      case 'alphnumper':
        reg = '^[0-9A-Za-záéíóúñÑÁÉÍÓÚÜü() ]+$';
        mensaje = "números, letras mayúsculas, minúsculas, paréntesis y espacios."
        break;
      case 'specs':
        reg = '^[0-9A-Za-záéíóúñÑÁÉÍÓÚÜü _.,\/\-]+$'
        mensaje = "números, letras mayuscúlas, minúsculas, espacios, guiones y puntos."
        break;
      case 'servs':
        reg = '^[0-9A-Za-záéíóúñÑÁÉÍÓÚÜü _.,\/\\-\"\!\=\?\+]+$'
        mensaje = "números, letras mayúsculas, minúsculas, espacios, guiones, puntos, comillas y signos de admiración."
        break;
      case 'rfc':
        reg = '^[A-ZÑ]{3,4}[0-9]{6}[A-ZÑ0-9]{3}$'
        mensaje = "RFC (3 o 4 letras seguido de 6 números y una homoclave de 3 carácteres, todas las letras deben ser mayúsculas)."
        break;
      case 'num':
        reg = '^[0-9]+$'
        mensaje = "números."
        break;
      case 'tel':
        reg = '^[0-9 \-]+$'
        mensaje = "números, espacios y guiones."
        break;
      case 'date':
        reg = '^[0-3][0-9]/(0[1-9]|10|11|12)/[0-9]{4}$'
        mensaje = "fecha valida"
        break;
      case 'password':
        reg = '^[0-9A-ZÑa-zñ]+$'
        mensaje = "números, letras mayúsculas y minúsculas."
        break;
      case 'name':
        reg = '^[0-9A-Za-záéíóúñÑÁÉÍÓÚÜü. ]+$';
        mensaje = "números, letras mayusculas, minusculas, puntos y espacios."
        break;
      }
      if ($(t).hasClass("timepicker")){
         reg = '^[0-9]{1,2} \: [0-5][0-9] (AM|PM)$';
         mensaje = "una hora válida";
      }
    }
    else if (type == "number") {
      switch (subtype) {
      case 'coin':
        reg = '^[0-9]+(\.[0-9]{1,2})?$'
        mensaje = "números con hasta dos decimales."
        break;
      case 'use':
        reg = '^[0-9]+$'
        mensaje = "números enteros."
        break;
      }
    }
    else if (type == "email") {
      reg = '^[A-Za-z0-9._-]+@([A-Za-z0-9-]{2,}\.)+[A-Za-z0-9-]{2,}$'
      mensaje = "E-mail (ejemplo@dominio.com)."
    }
    /*if(reg==""){
    	//console.log("No se asigno una expresion regular.");
    	return;
    }*/
    var regExp = new RegExp(reg);
    if (!regExp.test(value)) {
      txt += "Es inválido, sólo acepta " + mensaje;
    }
    if (txt == "") {
      if (type != "hidden") {
        if(print){
          if($(t).data('table')){
            tableUtilities.getDataTable($(t).data('table')).$('#' + id).removeClass('invalid');
            tableUtilities.getDataTable($(t).data('table')).$('#' + id).addClass('valid');
            tableUtilities.getDataTable($(t).data('table')).$('#' + id + '_warn').html(txt);
          }else{
              $('#' + id).removeClass('invalid');
              $('#' + id).addClass('valid');
              $('#' + id + '_warn').html(txt);
          }
        }
      }
      return true;
    } else {
      if (type != "hidden") {
        //txt = label+": "+txt;
        if(print){
          if($(t).data('table')){
            tableUtilities.getDataTable($(t).data('table')).$('#' + id).removeClass('valid');
            tableUtilities.getDataTable($(t).data('table')).$('#' + id).addClass('invalid');
            tableUtilities.getDataTable($(t).data('table')).$('#' + id + '_warn').html(txt);
          }else{
              $('#' + id).removeClass('valid');
              $('#' + id).addClass('invalid');
              $('#' + id + '_warn').html(txt);
          }

        }
      }
      return false;
    }
  }

  FormEngine.validateFunction = function (event) {
    //console.log("BLUR "+$(event.target).data('label'));
    FormEngine.validateObject(event.target);
  }
  FormEngine.markRequired = function (clas) {
    $('.' + clas).each(function (index) {
      if ($(this).data('label') !== undefined && $(this).attr('placeholder') === undefined) {
        $(this).attr('placeholder', $(this).data('label'));
      }
    });
    $('.' + clas).each(function (index) {
      $(this).attr('title', $(this).attr('placeholder'));
    });

    $('.' + clas + ':required').each(function (index) {
        //console.log(this);
          if($(this).attr('placeholder')!==undefined){
            if($(this).attr('placeholder').indexOf('Obligatorio')==-1){
		          $(this).attr('placeholder', $(this).attr('placeholder') + " (Obligatorio)");
            }
          }
    });
  }
  FormEngine.formatFields = function (fields) {
    var field, i;
    for (i = 0; i < fields.length; i++) {
      field = $('#' + fields[i]);
      if (field.data('label') !== undefined && field.attr('placeholder') === undefined) {
        field.attr('placeholder', field.data('label'));
      }
      field.attr('title', field.attr('placeholder'));
      field.attr('placeholder', field.attr('placeholder'));
    }
  }
  FormEngine.setClearables = function () {
      $("input[type=text], input[type=search], input[type=alpha], input[type=email], input[type=number],textarea").each(function () {
        $(this).addClass('clearable');
      });
      $(document).on('input', '.clearable', function () {
        FormEngine.tog(this);
      }).on('mousemove', '.x', function (e) {
        $(this)[FormEngine.togValue(this.offsetWidth - 18 < e.clientX - this.getBoundingClientRect().left)]('onX');
      }).on('touchstart click', '.onX', function (ev) {
        ev.preventDefault();
        if ($(this).attr('type') == "number") {
          $(this).removeClass('x onX').val('0').change();
        }
        else {
          $(this).removeClass('x onX').val('').change();
        }
        FormEngine.tog(this);
      });
      $(".clearable").on('blur', function () {
        //console.log("Blurred");
        if ($(this).hasClass('capitalize')) {
          //console.log("capitalize");
          $(this).ucwords();
        }
      });
      $(".clearable").each(function () {
        FormEngine.tog(this);
      });
    }
    // CLEARABLE INPUT
  FormEngine.tog = function (t) {
    var v = $(t).val();
    if ($(t).is(":focus")) {
      if (v) {
        $(t).addClass('x');
      }
      else {
        $(t).removeClass('x');
      }
    }
    else {
      if (v) {
        $(t).addClass('x');
      }
      else {
        $(t).removeClass('x');
      }
    }
    return v ? 'addClass' : 'removeClass';
  }
  FormEngine.togValue = function (v) {
    return v ? 'addClass' : 'removeClass';
  }
  FormEngine.setClearables();
});
