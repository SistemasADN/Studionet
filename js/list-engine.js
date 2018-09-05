var ListEngine = {};
$(document).ready(function(){
	ListEngine.initializeListEngine = function (id){
		var but = $("#"+id), txt = "";
		if(but.data('list')===undefined){
			txt += "list|";
		}
		if(!but.data('script')===undefined){
			txt += "script|";
		}
		if(!but.data('clear')===undefined){
			txt += "clear|";
		}

		if(but.data('after')!==undefined){
			var func = but.data('after');
			if(!typeof window[func] == 'function'){
				txt += "after [No existe la funcion "+but.data('after')+"]|";
			}
		}

		if(txt==""){
			$("#"+id).click(ListEngine.createListObject);
		}else{
			txt = txt.substr(0, txt.length-1);
			Messager.addAlertText('initializeListEngine', "No existe data [ "+txt+" ] en [ "+id+" ]",'e');
		}
	}

	ListEngine.createListObject = function (){
		var bot = $(this);
		var param = bot.data(), data = {}, txt = "";
		$("."+param.list).each(function (){
          console.log($(this).attr('id'));
          console.log($(this).val());
			var v;
			//Sacamos el valor
			if($(this).is('table')){
				if($(this).data('specialcolumns')===undefined){
					v = tableUtilities.getTableData($(this).attr('id'));
				}else{
					v = tableUtilities.getTableData($(this).attr('id'), $(this).data('specialcolumns').split(','));
				}
			}else{
				v = $(this).val();
			}
			//Procesando
			var r = $(this).attr('required'), rm = $(this).data('message');
			if(r){
				if($(this).is('table')){
					if(v.length==0){
						txt += "Debe agregar al menos un elemento a "+rm+". ";
					}
				}else if($(this).is('select')){
					if(!v){
						txt += "Debe seleccionar "+rm+". ";
					}
				}
			}

			if(txt==""){
				if($(this).attr('id')){
					data[$(this).attr('id')] = v;
				}
			}
		});


		if(txt==""){
			data = tableUtilities.formatDataToSend(data);
			if($(this).data('clear')){
				console.log("CLEARING!");
				Utilizer.sendData($(this).data('script'), data, ListEngine.clearFields, $(this).data('list'));
			}else{
				Utilizer.sendData($(this).data('script'), data, window[$(this).data('after')], $(this).data('list'));
			}
			if(window[$(this).data('function')]){
					window[$(this).data('function')]();
			}
		}else{
			Messager.addAlertText($(this).text(),"Para continuar: "+txt,'w');
		}

		//data-list = 'list-input' data-clear = 'true' data-script = 'crearTraslado'
	}

	ListEngine.clearFields = function (clas, extra){
		if(clas[0]!==undefined){
			clas = extra;
		}
		
		$("."+clas).each(function (){
			Utilizer.reset($(this).attr('id'));
		});
	}
});
