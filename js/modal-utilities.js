var modalUtilities = {};
$(document).ready(function(){
	modalUtilities.Initialize = function(boton){
		boton = $("#"+boton);
		if(boton.data('form')){
			var clas = boton.data('form');
			$('.'+clas).each(function (index){
				var id = $(this).attr('id');
				if($(this).hasClass('selectpicker')&& !$(this).hasClass('manual')){
					if(id.slice(0, 4)!='area'){
						//console.log($(this).data());
						Utilizer.loadSelect(id, $(this).data('script'), $(this).data('label'));
					}
				}else if($(this).hasClass('date-input')||$(this).parent().hasClass('date')){
					Utilizer.makeDatepicker($(this).parent().parent().attr('id'));
				}else if($(this).hasClass('switcher')){
					Utilizer.setToggler(id, $(this).data('true'), $(this).data('false'));
				}else if($(this).is('input')&&!$(this).is('input[type=hidden]')){
					//$(this).after("<label for='"+$(this).attr('id')+"'>"+$(this).attr('placeholder').replace('(Obligatorio)', '')+"</label>");

					//$(this).before("<label class='label-input'>"+$(this).attr('placeholder').replace('(Obligatorio)', '')+"</label>");
				}
			});
		}else{
			Messager.addAlertText('Error ModalUtilities.Initialize',"El botón "+boton.attr('id')+" no tiene data-form.",'e');
		}
	}

	modalUtilities.Load = function (boton, data, func){
		//console.log("LOAD FORM DATA");console.log(data);
		var id = boton;
		boton = $("#"+id);
		if(boton){
			if(boton.data('form')){
				var clas = boton.data('form');
				var txt = "";
				$('.'+clas).each(function (index){
					if(index==0){
						$(this).focus();
					}
					if(!$(this).hasClass('bootstrap-select')){
						var id = $(this).attr('id');

						if(data[id]!==undefined){
							var val = data[id];
						}else{
							if(id===undefined){
								txt += "El elemento con clases ["+$(this).attr('class')+"] no tiene id. | ";
							}else{
								txt += "["+id+"] no existe en los datos. | ";
							}
						}
						if(val!==undefined&&id!==undefined){
							//console.log($(this));
							if($(this).hasClass('selectpicker')){
								Utilizer.setPicker(id, '');
								Utilizer.setPicker(id, val);
							}else if($(this).hasClass('timepicker')){
								//console.log("SETTING TIMEPICKER");console.log($(this).attr('id'));console.log(val);
								Utilizer.setTimePicker($(this).attr('id'), val);
							}else if($(this).hasClass('date')){
								//console.log("Date");console.log(val);console.log($(this));
								var d = new Date(val);
								d.setMinutes( d.getMinutes() + d.getTimezoneOffset() );
								//console.log(d);
								$(this).datepicker( "setDate", d);
								//console.log("END Date");
							}else if($(this).is('table')){
									//console.log("ES UNA TABLA");console.log(val);
									tableUtilities.clearTable($(this).attr('id'));
									for(var i = 0;i<val.length;i++){
										tableUtilities.addRow($(this).attr('id'), val[i], [["BORRAR", "btn-danger borrar", tableUtilities.borrarFila]]);
									}
									tableUtilities.draw($(this).attr('id'));
							}else if($(this).hasClass('switcher')){
								Utilizer.setTogglerValue(id, val);
							}else if(id.slice(0,10)=='postalcode'){
								$(this).val(val);
								Utilizer.loadManualDireccion(id.replace('postalcode', ''), data['area'+id.replace('postalcode', '')]);
								FormEngine.tog(this);
							}else {
								if(id.slice(0, 4)!='area'){
									$(this).val(val);
									FormEngine.tog(this);
								}
							}
						}
						$(this).trigger('blur');
					}
				});
				if(txt!=""){
						Messager.addAlertText('Error ModalUtilities.Load',txt,'e');
				}else{
					if(func){
						func(data);
					}
				}
			}else{
				Messager.addAlertText('Error ModalUtilities.Load',"El botón "+boton.attr('id')+" no tiene data-form.",'e');
			}
		}else{
			Messager.addAlertText('Error ModalUtilities.Load',"No existe el botón "+id+".",'e');
		}
	}

	modalUtilities.LoadShow = function (boton, data, func){
		modalUtilities.Load(boton,data,func);
		modalUtilities.Show(boton);
	}

	modalUtilities.Show = function (boton){
		var mod = $("#modal"+boton);
		mod.modal('show');
		if($("#"+boton).data('form')){
			mod.on('shown.bs.modal', function() {
				$('.'+$("#"+boton).data('form')).eq(0).focus();
			});
		}
	}
	modalUtilities.Hide = function (boton){
		$("#"+boton).modal('hide');
	}
});
