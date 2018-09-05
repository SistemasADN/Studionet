var tableUtilities = {};
var tableList = {};

jQuery.extend( jQuery.fn.dataTableExt.oSort, {
	"date-uk-pre": function ( a ) {
	    var ukDatea = a.split('/');
	    return (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
	},
	"date-uk-asc": function ( a, b ) {
	    return ((a < b) ? -1 : ((a > b) ? 1 : 0));
	},
	"date-uk-desc": function ( a, b ) {
    	return ((a < b) ? 1 : ((a > b) ? -1 : 0));
	}
});

$(document).ready(function(){

	tableUtilities.borrarFilaButton = ['Borrar', 'borrar btn-danger', tableUtilities.borrarFila];

	tableUtilities.getSelect = function (id){
		return tableList[id].selects;
	}

	tableUtilities.footerMax = function (id){
		return tableList[id].footer;
	}

	tableUtilities.setRowValueFromObject = function (object, key, value){
		if($(object).data('table')===undefined||$(object).data('uniqueId')===undefined){
			console.log("tableUtilities.setRowValueFromObject: El objeto no tiene la data correcta. ");
			console.log($(object).data());
		}
		if($("#"+$(object).data('table')+key+$(object).data('uniqueId'))===undefined){
			console.log("tableUtilities.setRowValueFromObject: No se encontró un objeto con key ["+key+"]");
		}
		var obj = $("#"+$(object).data('table')+key+$(object).data('uniqueId'));
		if($(obj).is('input')||$(obj).is('textarea')){
			$(obj).val(value);
		}else{
			$(obj).text(value);
		}
	}
	//TIENES QUE HACER QUE SE FORMATEE LA DATA DE LA TABLA AL OBTENER SUS DATOS PARA MANDARLA Y SE
	//CORTE CORRECTAMENTE CON LO DE data-keys es para pasar sólo lo indispensable al query
	tableUtilities.getRowValueFromObject = function (object, key){
		//console.log('getRowValueFromObject');console.log(object);console.log(key);
			if($(object).data('table')===undefined||$(object).data('uniqueId')===undefined){
				console.log("tableUtilities.getRowValueFromObject: El objeto no tiene la data correcta. ");
				console.log($(object).data());
				return "";
			}
			if($("#"+$(object).data('table')+key+$(object).data('uniqueId'))===undefined){
				console.log("tableUtilities.getRowValueFromObject: No se encontró un objeto con key ["+key+"]");
				return "";
			}
			var obj = $("#"+$(object).data('table')+key+$(object).data('uniqueId'));
			if($(obj).is('input')||$(obj).is('textarea')){
				return $(obj).val();
			}else{
				return $(obj).text();
			}
		}

		tableUtilities.findRowFromObject = function (obj){
		if($(obj).is('tr')){
			return obj;
		}else{
			return tableUtilities.findRowFromObject($(obj).parent());
		}
	}

	tableUtilities.getObjectDataFromObject = function (obj){
		var id = $(obj).data('table'), elements = tableUtilities.getElements(id),
		 unique = $("#"+id).data('unique').split(','), tab = tableUtilities.getDataTable(id),
		  data = {}, uniqueId = $(obj).data('uniqueId');
		for(var i = 0;i<elements.length;i++){
			if(typeof elements[i]== 'object'){
				obj = tab.$("#"+id+elements[i].key+uniqueId);
				data[elements[i].key] = $(obj).val();
			}
		}
		return data;
	}
	tableUtilities.getRowDataFromObject = function (obj){
		var row = tableUtilities.findRowFromObject(obj);
		return $(row).find(".rowData").data();
	}

	tableUtilities.recalculateUniqueIds = function (object){
		console.log('recalculateUniqueIds');
		var id = $(object).data('table'), elements = tableUtilities.getElements(id),
		 unique = $("#"+id).data('unique').split(','), uniqueId = $(object).data('uniqueId'), idList = [], skip,
		  tab = tableUtilities.getDataTable(id);
		 //console.log("OBJECT VALUE "+$(object).val());console.log("OBJECT");console.log(object);console.log("OBJECT DATA");console.log($(object).data());
		 var rowData = tableUtilities.getRowDataFromObject(object), rowKeys = Object.keys(rowData);
		 for(var j = 0;j<unique.length;j++){
			skip = false, temp = {};
		 	for(var i = 0;i<elements.length;i++){
				 if(elements[i].key==unique[j]){
					 idList[unique[j]] = tab.$("#"+id+elements[i].key+uniqueId).val();
					 skip = true;
					 break;
				 }
			 }
			 if(skip){
				 continue;
			 }
			 for(var i = 0;i<rowKeys.length;i++){
				 if(unique[j]==rowKeys[i]){
					 idList[unique[j]] = rowData[unique[j]];
					 break;
				 }
			 }
		 }

		 var newId = tableUtilities.createUniqueIdString($("#"+id).data('unique'), idList), obj;
		 for(var i = 0;i<elements.length;i++){
			 if(typeof elements[i]== 'object'){
				 obj = tab.$("#"+id+elements[i].key+uniqueId);
				 $(obj).data('uniqueId', newId);
				 $(obj).attr('id', id+elements[i].key+newId);
			 }
		 }
	}

	tableUtilities.changeSelectSelectedValueData = function(sel){
		var val = $(sel).val(), options = $(sel).data('options');
		for(var i = 0;i<options.length;i++){
			options[i].selected = false;
			if(options[i].id==val){
				options[i].selected = true;
			}
		}//console.log(options);
		$(sel).data('options', options);
		$(tableUtilities.findRowFromObject(sel)).find('.rowData').data($(sel).data('key'), options);
	}

	tableUtilities.getRowDataKeys = function (id){
		if(tableList[id]===undefined){
			Messager.addAlertText('tableUtilities.getRowDataKeys', 'No existe una declaración tabla ['+id+'], utilice tableUtilities.createTable(id, columnas) para continuar', 'e');
			return;
		}
		return Object.keys($(tableUtilities.getDataTable(id).row(0).node()).find('.rowData').data());
	}

tableUtilities.validateTableObjects = function (id, rows){
	console.log(id);
	console.log(rows);
	var ele = tableUtilities.getElements(id), answer = "", contador, elementos = false;
	//console.log("TABLE ROWS");console.log(rows);
	for(var i = 0;i<ele.length;i++){
		contador = 0;
		if(typeof(ele[i])=="object"){
			if(ele[i].required!==undefined&&ele[i].required){ //console.log(ele[i].key+" es required");
				var existe = false;
				for(var j = 0;j<rows.length;j++){//console.log(rows[j]);
					//console.log(rows[j]);console.log(ele[i].key);
					var objId = id+""+ele[i].key+""+tableUtilities.createUniqueIdString($("#"+id).data('unique'), rows[j]);
					if(rows[j][ele[i].key]){
						existe = true;
						break;
					}
				}

				if(!existe&&ele[i].type=='table-radio'){
					answer += "Debe seleccionar al menos un elemento como "+ele[i].options+". ";
				}
			}

			for(var j = 0;j<rows.length;j++){//console.log(rows[j]);
				//console.log(rows[j]);console.log(ele[i].key);
				var objId = id+""+ele[i].key+""+tableUtilities.createUniqueIdString($("#"+id).data('unique'), rows[j]);
				if(!FormEngine.validateObject(tableUtilities.getDataTable(id).$("#"+objId))){
					contador++;
				}
			}


		}
		if(contador>0){
			answer += "Existe"+(contador>1?'n':'')+" "+contador+" error"+(contador>1?'es':'')+" en la columna "+ele[i].name+".";
			elementos = true;
		}
	}
	if(elementos){
		answer += " Por favor corrija los campos marcados dentro de la tabla. ";
	}
	return answer;
}

	tableUtilities.updateSelect = function (id){
		var t = tableUtilities.getDataTable(id), sele = tableUtilities.getSelect(id), ele = tableUtilities.getElements(id);
		if(sele!==undefined){
			t.columns().every( function () {
				for(var i=0;i<sele.length;i++){
					actual = sele[i];
					if(typeof(actual)=="object"){
						var copy = actual;
						actual = actual.key;
					}
					if(_.indexOf(ele, actual)==this.index()){
						var column = this;
						var select = $('#tableSelect'+id+ele[_.indexOf(ele, actual)]);
						select.empty();
						select.append('<option value="">Todos</option>');
						column.data().unique().sort().each( function ( d, j ) {
							if(typeof(d)=='string'&&d.match("^<")&&d.match(">$")&&$(d).text!=""){
									d = $(d).text();
							}
							select.append('<option value="'+d+'">'+d+'</option>')
						});
						if(copy!==undefined){
							if($("#tableFilterToggle"+id+copy.key).data('toggle')===0){
									select.val(copy.activeValue);
							}else{
									select.val("TODOS");
							}
						}
						select.selectpicker('refresh');
						$(select).trigger("change");
					}
				}
			});
		}
	}

	//Agregar selects a la tabla
	tableUtilities.addSelect = function (id, sele){
		var t = tableUtilities.getDataTable(id);
		var ele = tableUtilities.getElements(id), actual;
		//console.log(ele);
		 t.columns().every( function () {

			 var hidden = false;
			if(sele!==undefined){
				for(var i=0;i<sele.length;i++){
					actual = sele[i];
					if(typeof(actual)=="object"){
						var squeak = actual;
						actual = actual.key;
						hidden = true;
					}
						if(_.indexOf(ele, actual)==this.index()){
							//console.log('Entro a este desmae');
							var column = this;
							var title = $(column.header()).html();
							if(hidden){
									var inputGroup = $("<div style='display:none;' class='input-group group-container' id = 'inputGroup"+id+ele[_.indexOf(ele, actual)]+"'></div>").appendTo($("#searcher"+id));
							}else{
									var inputGroup = $("<div class='input-group group-container' id = 'inputGroup"+id+ele[_.indexOf(ele, actual)]+"' style='display:inline-table;'></div>").appendTo($("#searcher"+id));
							}

							var select = $('<label data-first-value = "'+(squeak===undefined?'':squeak.activeValue)+'" class="label-right col-xs-4 col-sm-4 col-md-4">'+title+':</label> <select class="selectpicker" data-live-search="true" id = "tableSelect'+id+ele[_.indexOf(ele, actual)]+'" style = "margin-right:10px;margin-bottom:30px;"><option value=""></option></select></div>')
								.appendTo($("#inputGroup"+id+ele[_.indexOf(ele, actual)]))
								.on( 'change', function () {
									//console.log('Onchage');console.log($(this));
									var val = $.fn.dataTable.util.escapeRegex(
										$(this).val()
									);
									//console.log("CHANGE");console.log(val);
									column
										.search( val ? '^'+val+'$' : '', true, false )
										.draw();
										tableUtilities.filterEvent(id);
										//tableUtilities.drawEvent(id); //Temporary, better solution needed
										//Esto es para que se calculen subtotales conforme se filtren cosas
								} );

								if(window.innerWidth<=766){
									$('#tableSelect'+id+ele[_.indexOf(ele, actual)]).selectpicker('mobile');
								}
								$('#tableSelect'+id+ele[_.indexOf(ele, actual)]).selectpicker('refresh');
					}
				}
			}
       });
	}

	tableUtilities.addAlphabetSearch = function (id, sele){

		var t = tableUtilities.getDataTable(id);
		var ele = tableUtilities.getElements(id), actual;
		//console.log(ele);
		 t.columns().every( function () {
			if(sele!==undefined){
				for(var i=0;i<sele.length;i++){
					actual = sele[i];
					if(typeof(actual)=="object"){
						actual = actual.key;
					}
					if(_.indexOf(ele, actual)==this.index()){
						var column = this;
						var title = $(column.header()).html();
						var alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ".split("");
						$("<div class='input-group alphabetSearchContainer' id = 'searcherAlpha"+id+"'></div>").appendTo($("#searcher"+id));
						var btn = "<label>"+title+":</label> <button style='height:35px;' data-filter = '' class = 'btn btn-info "+id+"Button is-selected'>Todos</button>";
						$(btn)
						.appendTo($("#searcherAlpha"+id))
						.click(function () {
							$("."+id+"Button").removeClass('is-selected');
							$(this).addClass('is-selected');
							$(this).blur();
							var val = $.fn.dataTable.util.escapeRegex(
										$(this).data('filter')
								);
								column
									.search( val ? '^'+val : '', true, false )
									.draw();
						});

						for(var i=0;i<alphabet.length;i++){
							var letter = alphabet[i];
							var btn = "<button style='width:35px;height:35px;' data-filter = '"+letter+"' class = ' btn btn-info "+id+"Button'>"+letter+"</button>";
							$(btn)
							.appendTo($("#searcherAlpha"+id))
							.click(function () {
								$("."+id+"Button").removeClass('is-selected');
								$(this).addClass('is-selected');
								$(this).blur();

								var val = $.fn.dataTable.util.escapeRegex(
										$(this).data('filter')
								);
								column
									.search( val ? '^'+val : '', true, false )
									.draw();
							});
						}
					}
				}
			}
       });
	}
	//Borra una fila al presionar el boton de borrar de esa fila
	tableUtilities.borrarFila = function (event){
		var t = $(event.target);
		var id = t.parent().parent().parent().parent().attr('id');
		var t = tableUtilities.getDataTable(id);
		t.row($(event.target).parents('tr')).remove();
		tableUtilities.draw(id);
	}
	//Busca si el objeto que se inserto como row se encuentra en la tabla
	tableUtilities.isInTable = function (id, row){
			var t = tableUtilities.getDataTable(id);
			var result = true;
			t.rows().every(function (rowIdx, tableLoop, rowLoop){
				if(result){
					//console.log("IS IN TABLE?");console.log($(this.node()));
					if(_.isMatch($(this.node()).find('.rowData').data(), row)){
						result = false;
					}
				}
			});
			return !result;
	}

	tableUtilities.setTotalFechas = function (id, tot, value){
		$("#totalFechas"+id+''+"trueNumero").html(value);
	}

	tableUtilities.setTotal = function (id, tot, value){
		$("#total"+id+''+"trueNumero").html(value);
		//console.log(id);
		//console.log(tot);
		//console.log(value);
	}

	//Crea una tabla junto con sus elementos (Arreglo de las columnas)
	tableUtilities.createTable = function (id, ele, sele, tot, fulltot, order){
		var toggle = [];

		var cols = [];

		for(var i = 0;i<ele.length;i++){
			cols.push(i);
		}
		//console.log(ele[ele.length-1]);console.log(typeof(ele[ele.length-1]));
		if(typeof(ele[ele.length-1])=='object'){
			if(ele[ele.length-1].key.toLowerCase()=='acciones'){
				cols.splice(-1, 1);
			}
		}else if(ele[ele.length-1].toLowerCase()=="acciones"){
				cols.splice(-1, 1);
		}

		var buttons  = [];
		if($("#"+id).data('print')!==undefined){
			/*
			buttons.push({
					 extend: 'print',
					 title: $("#"+id).data('print'),
					 text: 'Imprimir',
					className: 'btn-print',
			 });
			 /**/
	 	}
		/*
		buttons.push({
				extend: 'colvis',
				text: 'Columnas',
			 className: 'btn-col',
		});
		*/

		 if($("#"+id).data('copy')!==undefined){
			 buttons.push({
	 				 extend: 'copy',
	 				 text: 'Copiar',
	 				className: 'btn-copy',
	 		 });
	 	}

		if($("#"+id).data('pdf')!==undefined) {
			buttons.push(
					{
							 extend: 'pdf',
							 title: function (){
								 	if($("#"+id).data('titulo')){
										return $("#"+id).data('titulo');
									}else{
										return "";
									}
								},
							 messageTop: function (){
								 return  tableUtilities.getFilterText(id);
							 },
							 //messageBottom:"Aquí van los filtros 2.",
							 text: 'Exportar PDF',
							 className: 'btn-pdf',
							 exportOptions: {
								columns: cols,
								stripNewlines: false
							},
							customize: function (doc){
								doc['footer']=(function(page, pages) {
										return {
										columns: [
										Utilizer.dateParseToFecha(new Date()),
										{
										alignment: 'right',
										text: [
										{ text: page.toString(), italics: true },
										' de ',
										{ text: pages.toString(), italics: true }
										]
										}
										],
										margin: [10, 0]
										}
										});
							}
					 }
			 );
		}

		if($("#"+id).data('csv')!==undefined){
			buttons.push({
					 extend: 'csv',
					 title: function (){
							if($("#"+id).data('titulo')){
								return $("#"+id).data('titulo');
							}else{
								return "";
							}
						},
					 text: 'Exportar CSV',
						className: 'btn-csv',
						exportOptions: {
							columns: cols
						}
			 });
		}

		if($("#"+id).data('xls')!==undefined){
			buttons.push({
					 extend: 'excel',
					 title: function (){
							if($("#"+id).data('titulo')){
								return $("#"+id).data('titulo');
							}else{
								return "";
							}
						},
					 text: 'Exportar Excel',
						className: 'btn-xls',
						exportOptions: {
							columns: cols
						}
			 });
		}
		/**/
		if($("#"+id).data('importar')!==undefined){
			buttons.push({
				 tableId: id,
				 text: function (dt, button, config ){
					 config.importName = $("#"+id).data('importar');
					 $("body").append('<div class="modal fade in" tabindex="-1" role="dialog" id="import'+config.tableId+'"><div class="modal-dialog modal-lg" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button></div><div class="modal-body container-fluid"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container"><div class="logo-container"></div><div class="text-container">IMPORTAR '+config.importName.toUpperCase()+'<i class="fa fa-file-excel"></i></i></div></div><div class="col-xs-12 col-sm-12 col-md-12 modal-content-container"></div></div><div class="modal-footer"></div></div></div></div>');
					 var modal = $("#import"+config.tableId);
					 $(modal).find('.modal-content-container').append("<form method = 'POST' action='queries/descargarCsv.php'><button type='submit' name = 'csv' value='"+config.importName+"' class='dt-button buttons-excel buttons-html5 btn-xls'>Descargar Formato</button></form><input type='file' id='csvUpload"+config.importName+"'/> </div><br><div id='answercsvUpload"+config.importName+"'> </div>");
					 loaderUtilities.newLoader('csvUpload'+config.importName, function (tableid) {
						 //$("#"+tableId)
					 });
					 $(button).data('config', config);
					 return 'Importar CSV';
				 },
				 className: 'btn-xls',
					action: function () {
						var actual = $(this)[0].node, config = $(actual).data('config');
						$("#import"+config.tableId).modal('show');
					}
		 });
	 	}
		//AGREGAR FILTROS BINARIOS
		if(sele!==undefined&&sele.length>0){
			$("<div class='searcher-container'><div class='searcher' id = 'searcher"+id+"'></div></div").insertBefore("#"+id);
			for(var i = 0;i<sele.length;i++){
				if(typeof(sele[i])!="object"){
					continue;
				}
						buttons.push({
								 extra: sele[i],
								 tableId: id,
								 text: function (dt, button, config ){
									 if($(button).data('toggle')===undefined){
										 if(config.extra.default===undefined){
												$(button).data('toggle', 1);
										 }else{
											 $(button).data('toggle', config.extra.default);
										 }
									 }

									 if($(button).data('text')===undefined){
										 if(config.extra.text===undefined){
												$(button).data('text', 'INACTIVO');
										 }else{
												$(button).data('text', config.extra.text);
										 }
									 }

									 if($(button).data('toggle')){
										 	$(button).addClass('mostrar').removeClass('ocultar');
											Utilizer.setPicker("tableSelect"+config.tableId+config.extra.key, 'TODOS');
									 }else{
										 $(button).addClass('ocultar').removeClass('mostrar');
										 Utilizer.setPicker("tableSelect"+config.tableId+config.extra.key, config.extra.activeValue);
									 }
									 $(button).attr('id', 'tableFilterToggle'+config.tableId+config.extra.key);
									 $(button).data('config', config);
									 return $(button).data('text');
									},
									action: function (){
										var actual = $(this)[0].node, config = $(actual).data('config');

											$(actual).data('toggle', $(actual).data('toggle')===1?0:1);
											if($(actual).data('toggle')){
												 $(actual).addClass('mostrar').removeClass('ocultar');
											}else{
												$(actual).addClass('ocultar').removeClass('mostrar');
											}
											if($(actual).data('toggle')){
													Utilizer.setPicker("tableSelect"+config.tableId+config.extra.key, 'TODOS');
											}else{
												  Utilizer.setPicker("tableSelect"+config.tableId+config.extra.key, config.extra.activeValue);
											}
											$("#tableSelect"+config.tableId+config.extra.key).trigger('change');
									},
									className: 'btn-filter'
						 });
						 console.log(buttons);
			}
		}
		$("<div id = 'tableButtons"+id+"' class = 'table-buttons'></div>").insertBefore("#"+id);

		//console.log("HEADERS de "+id);//Buscar cosas de formato en headers
		var headers = [];
		$("#"+id+" thead").find('th').each(function (index) {
			var type = "";
			if($(this).hasClass('coin')){ type = 'coin'; }
			var newObj = {text: $(this).text(), type: type};
			//console.log("PUSHING");console.log(newObj);
			headers[ele[index]] = newObj;
		});
		//console.table(headers);//console.log("HEADERS END de "+id);

		//AGREGAR CHECBOX EN LOS HEADERS

		/*Total Box that calculates based on dates.*/
		if(tot===true){
			$("<div style='margin-bottom:10px;' id = 'totalFechas"+id+''+tot+"' class='totalBox-container'><table><tr><td class='col-xs-8 col-sm-6 col-md-4'><label style='margin-bottom:0px;'><span id = 'l_"+id+"totalFechas'></span></label></td><td id='totalFechas"+id+''+tot+"Numero' class='col-xs-2 col-sm-6 col-md-8'></td></tr></table></div>").insertBefore("#"+id);
			$("#l_"+id+"totalFechas").html('Total de rango de fechas:');
		}

		/*Total box that calculates everything*/
		if(fulltot===true){
			$("<div id = 'total"+id+''+fulltot+"' class='totalBox-container'><table id='tablebox' class='col-xs-12 col-sm-12 col-md-12 table-totalBox'><tr><td id='firstTd' class='col-xs-8 col-sm-6 col-md-5 firstTd'><label style='margin-bottom:0px;'><span id = 'l_"+id+"total'></span></label></td><td id='total"+id+''+fulltot+"Numero' class='col-xs-4 col-sm-6 col-md-7' style='text-align:center;'></td></tr></table></div>").insertBefore("#"+id);
			//$("#l_"+id+"total").html('TOTAL');
		}
		var hasFecha = false, indexFecha = 0;

		for(var i=0; i<ele.length; i++){
			if(typeof(ele[i])=="object"){
				if(ele[i].type=="table-checkbox"){
					$("#"+id).find("thead").find('th').eq(i).html("<input type = 'checkbox' id = 'checkbox"+ele[i].key+"' />");
					$("#checkbox"+ele[i].key).change(function (){
							var tab = tableUtilities.getDataTable(id);
							tab.$("."+id+"table-checkbox").prop('checked', $(this).prop('checked'));
					});
				}
			}else if(ele[i].indexOf("fecha")>=0 || ele[i].indexOf("Fecha")>=0){
				hasFecha = true;
				break;
			}
		}


		var newOrder = new Array();
		if(order!==undefined){
			var actual;
			for(var i = 0;i<order.length;i++){
				actual = order[i];
				newOrder.push([_.indexOf(ele, actual[0]), actual[1]]);
			}
		}else{
			for(var i=0; i<ele.length; i++){
				if(typeof(ele[i])=="object"){
					newOrder.push([0, 'asc']);
				}else if(ele[i].indexOf("fecha")>=0 || ele[i].indexOf("Fecha")>=0){
					newOrder.push([ele[i].indexOf("fecha"), 'desc']);
				} else {
					newOrder.push([0, 'asc']);
				}
			}
		}
		//console.log(buttons);
		if(hasFecha){
			var columns = new Array();
			var styling = new Array();
			for(var i=0; i<ele.length; i++){
				if(typeof(ele[i])=="object"){
					columns.push(null);
					styling.push(null);
				}else if(ele[i].indexOf("fecha")>=0 || ele[i].indexOf("Fecha")>=0){
					columns.push({ "sType": "date-uk" });
					//styling.push({ className: "red" });
					styling.push(null);
				} else {
					columns.push(null);
					styling.push(null);
				}
			}
			tableList[id] = {table:$("#"+id).DataTable({
				//"stateSave": true,
		        "aoColumns": columns,
				"aaSorting": newOrder,
		        "autoWidth": true,
				"columns": styling,
					//paging: false,
					buttons: buttons,
					dom: 'Bfrtip',
		    }), elements:ele, unique:[], selects:sele, footer:10, toggler:toggle, heads:headers};
			/*
			//console.log(id);//console.log("STYLING");//console.log(styling);
			//console.log("ORDER");//console.log(columns);
			/**/
		} else {
			//console.log(newOrder);//console.log(id);
			tableList[id] = {table:$("#"+id).DataTable({
				"autoWidth": true,
				"aaSorting": newOrder,
				//paging: false,
				buttons: buttons,
				dom: 'Bfrtip',
			}), elements:ele, unique:[], selects:sele, footer:10, toggler:toggle, heads:headers};
		}

		$("#"+id+"_length select").on('change', function (){
			tableUtilities.checkFooter(id);
		});

		if(sele!==undefined){
			tableUtilities.addSelect(id, sele);
		}
		$('#'+id).on( 'page.dt', tableUtilities.pagination);
	}
	tableUtilities.pagination = function (event){
			//console.log(event.target);
			//console.log("PAGINATION");
	}

	tableUtilities.exportToPdf = function (){
		var data = {};
		data.type = 'tablafiltrada';
		data.params = tableUtilities.getDataForPdf($(event.target).data('tableId'));
		Utilizer.makePdf(data, tableUtilities.afterMakePdf, data);
	}

	tableUtilities.exportToCsv = function (){
		var data = tableUtilities.getDataForPdf($(event.target).data('tableId'));
		Utilizer.makeCsv(data, tableUtilities.afterMakeCsv, data);
	}

	tableUtilities.afterMakePdf = function (data, extra){
		  Utilizer.savePdfToDisk(extra.type, extra.params.titulopdf);
	}

	tableUtilities.afterMakeCsv = function (data, extra){
		  Utilizer.saveCsvToDisk(extra.titulopdf);
	}
	//Regresa la tabla y sus elementos|
	tableUtilities.getTable  = function (id){
		return tableList[id];
	}
	//Regresa la tabla
	tableUtilities.getDataTable = function (id){
		/*
		//console.log(id);
		//console.log(tableList);
		/**/
		if(tableList[id]!==undefined){
				return tableList[id].table;
		}else{
			return undefined;
		}
	}
	//Regresa los elementos
	tableUtilities.getElements = function (id){
		return tableList[id].elements;
	}

	tableUtilities.getHeaders = function (id){
		return tableList[id].heads;
	}

	tableUtilities.getSelectedData = function (id, keys, array){
		var data = [], i, send = [], cont, temp;
		if(array){
			data = tableUtilities.getTableData(id, _.union(keys, array));
		}else{
			data = tableUtilities.getTableData(id);
		}

		for(i=0;i<data.length;i++){
			cont = true;
			for(j=0;j<keys.length;j++){
				if(!data[i][keys[j]]){
					cont = false;
					break;
				}
			}
			if(cont){
				var temp  = {};
				if(array){
					for(var j = 0;j<array.length;j++){
						temp[array[j]] = data[i][array[j]];
					}
				}else{
					temp = data[i];
				}
				send.push(temp);
			}
		}
			return send;
	}

	tableUtilities.getUnselectedData = function (id, array){
			if(array){
				if(_.indexOf(array, 'seleccionar')==-1){
					array.push('seleccionar');
				}
			}
			var data = tableUtilities.getTableData(id, array), i, send = [];
			for(i=0;i<data.length;i++){
					if(!data[i].seleccionar){
						send.push(data[i]);
					}
			}
			return send;
	}
	//Regresa toda la data de la tabla, si se incluye un arreglo sólo se regresan los objetos cuyas llaves esten en el arreglo
	tableUtilities.getTableData = function (id, array){
	var t = tableUtilities.getDataTable(id);
	var ele = tableUtilities.getElements(id);
	var objs = new Array();
	for(var i = 0;i<ele.length;i++){
		if(typeof(ele[i])=="object"){
			objs.push(ele[i]);
		}
	}
	//console.log("OBJECT LIST TO RETRIEVE");console.log(objs);
	//Shara
	var result = new Array();
	if(array){
		//console.log("WITH ARRAY");
		t.rows().every(function (rowIdx, tableLoop, rowLoop){
			//var resultado = tableUtilities.formatDataToSend(_.pick($(this.node()).find('div').data(), array));
			var nodeData = $(this.node()).find('.rowData').data();
			//console.log("NODE DATA");console.log(nodeData);console.log("ARRAY");console.log(array);console.log("PICK");console.log(_.pick(nodeData, array));
			resultado = tableUtilities.formatDataToSend(_.pick(nodeData, array), id);
			//console.log("RESULTADO");console.log(resultado);
			for(var i = 0;i<objs.length;i++){
					if(array.includes(objs[i].key)){
						//console.log("NODE DATA");console.log(nodeData);
						resultado[objs[i].key] = tableUtilities.getObjectData(id, objs[i], tableUtilities.formatDataToSend(nodeData, id));
					}
			}
			//console.log("RESULT AFTER");console.log(resultado);
			result.push(resultado);
		});
	}else{
		//console.log("WITHOUT ARRAY");
		t.rows().every(function (rowIdx, tableLoop, rowLoop){
			var nodeData = $(this.node()).find('.rowData').data();
			var resultado = tableUtilities.formatDataToSend(nodeData, id);
			//console.log(resultado);
			for(var i = 0;i<objs.length;i++){
					//console.log(objs[i].key);
					resultado[objs[i].key] = tableUtilities.getObjectData(id, objs[i], resultado);
					//console.log(resultado[objs[i].key]);
			}
			//result.push(tableUtilities.formatDataToSend($(this.node()).find('div').data()));
			result.push(resultado);
		});
	}
	return result;
}

tableUtilities.formatDataToSend = function(row, id){
	if(id!==undefined) {

		var headers = tableUtilities.getHeaders(id);
	}
	//console.log("formatDataToSend");console.log(row);
		if(row===undefined){
			return row;
		}
		var rowKeys = Object.keys(row);
		//console.log(rowKeys);
	for(i=0;i<rowKeys.length;i++){
		actual = rowKeys[i];
		//console.log("["+actual+"]:["+row[actual]+"]");
		if(row[actual]===null){
			continue;
		}

		if(headers!==undefined) {
			var type = "";
			if(headers[actual]!==undefined) {
				switch(headers[actual].type) {
					case 'coin':
							if(row[actual].match(/^\$\-?[0-9,]+(\.[0-9]{1,2})?$/)) {
								row[actual] = Utilizer.coinToNumber(row[actual]);
							}else if(row[actual].match(/^\-?[0-9]+(\.[0-9]{1,2})?\%$/)) {
								row[actual] =  row[actual].substring(0, row[actual].length-1);
							}
					break;
				}
				if(type!=""){
					continue;
				}
			}
		}

		if(row[actual]=="N/A"){
			row[actual] = "";
		}

		if(headers!==undefined) {

		}

		if(typeof row[actual]!="string"){
			continue;
		}
		if (actual=="seleccionar"){
			var unique = tableUtilities.getUniqueColumns(row['dataTableId']);
			//console.log($("#check"+row[unique]));
			row['seleccionar'] = $("#check"+unique+""+row[unique]).prop('checked');
		}


		if(actual.includes('fecha')||actual.includes("Fecha")){
			if(row[actual].match(/^[0-3][0-9]\/[0-1][0-9]\/[0-9]{4}$/)){
				row[actual] = Utilizer.fechaParseToDbDate(row[actual]);
			}
		}else if (actual.includes('precio')||actual.includes("Precio")||actual.includes('Costo')||actual.includes('costo')||actual.includes('descuento')||actual.includes("Descuento")||actual.includes('total')||actual.includes('Total')){
			if(row[actual].match(/^\$\-?[0-9,]+(\.[0-9]{1,2})?$/)) {
				row[actual] = Utilizer.coinToNumber(row[actual]);
			}else if(row[actual].match(/^\-?[0-9]+(\.[0-9]{1,2})?\%$/)) {
				row[actual] =  row[actual].substring(0, row[actual].length-1);
			}
		}
	}
	return row;
}

	tableUtilities.formatDataToPaint = function (row, id){
		var headers;
		if(id!==undefined) {
			 headers = tableUtilities.getHeaders(id);
			//console.log("FORMAT DATA");console.log(headers);console.log("FORMAT DATA END");
		}
		var rowKeys = Object.keys(row);
		//console.log(rowKeys);
		for(i=0;i<rowKeys.length;i++){
			actual = rowKeys[i];

			if(row[actual]===null){
				row[actual] = "N/A";
				continue;
			}
			if(row[actual]==""&&typeof row[actual]=="string"){
				row[actual] = "N/A";
				continue;
			}

			if(headers!==undefined) {
				var type = "";
				if(headers[actual]!==undefined) {
					switch(headers[actual].type) {
						case 'coin':
							if(row[actual]==0){
								row[actual] = "$0.00";
							}else if($.isNumeric(row[actual])){
								row[actual] = Utilizer.numberToCoin(row[actual]);
							}
						break;
					}
					if(type!=""){
						continue;
					}
				}
			}

			if(actual.includes('fecha')||actual.includes("Fecha")){
				if(row[actual].match('^[0-9]{4}\-[0-1][0-9]\-[0-3][0-9]$')){
					row[actual] = Utilizer.fechaDbParseToFecha(row[actual]);
				}else if(row[actual].match('^[0-9]{4}\-[0-1][0-9]$')){
					row[actual] = Utilizer.fechaDbParseToFecha(row[actual], true);
				}
			}else if (actual.includes('precio')||actual.includes("Precio")||actual.includes('Costo')||actual.includes('costo')||actual.includes('total')||actual.includes('Total')){
				//console.log(row[actual]);
				if(row[actual]==0){
					row[actual] = "$0.00";
				}else if($.isNumeric(row[actual])){
					row[actual] = Utilizer.numberToCoin(row[actual]);
				}
			}else if (actual.includes('descuento')||actual.includes("Descuento")){
				if(row[actual]===0){
					row[actual] = "0%";
				}else if(row[actual]===false){
					row[actual] = false;
				}else if(row[actual].match('^\-?[0-9]+(\.[0-9]{1,2})?$')){
					row[actual] += "%";
				}
			}else if (actual.includes('estatus')||actual.includes("Estatus")){
				if(row[actual].toLowerCase()=="activo"){
					row[actual] = "<span style = 'background-color:green;color:white;padding:2px;'>"+row[actual]+"</span>";
				}else if(row[actual].toLowerCase()=="inactivo"){
					row[actual] = "<span style = 'background-color:#ca0b0b;color:white;padding:2px;'>"+row[actual]+"</span>";
				}
			}else if(actual=='seleccionar'){
				var unique = tableUtilities.getUniqueColumns(row['dataTableId']);
				row['seleccionar'] = '<input type="checkbox" class = "check'+row['dataTableId']+'" id = "check'+unique+""+row[unique]+'"/>';
			}
		}
		return row;
	}
	//Borra la tabla y lo dibuja
	tableUtilities.clearTable = function (id){
		var t = tableUtilities.getDataTable(id);
		t.clear();
		tableUtilities.draw(id);
	}
	tableUtilities.createUniqueIdString = function (keys, data){
		//console.log("createUniqueIdString");console.log(keys);console.log(data);
		var string = "";
		keys = keys.split(',');
		for(var i = 0;i<keys.length;i++){
				string += data[keys[i]]+"-";
		}
		return string.substring(0, string.length - 1);
	}
	tableUtilities.createValidationText = function (object){
			var txt = "";
			if(object.validation){
				var keys = Object.keys(object.validation);
				for(var i = 0;i<keys.length;i++){
						txt += "data-"+keys[i]+" = '"+object.validation[keys[i]]+"' ";
				}
			}
			if(object.required===true){
				txt+= " required ";
			}
			return txt;
	}

	tableUtilities.createObject = function(id, object, row){
			//console.log("CREATING OBJECT");console.log("ID");console.log(id);console.log("OBJECT");console.log(object);console.log("ROW");console.log(row);
			var row = tableUtilities.formatDataToSend(row, id);
			if(object.output){
				return object.options[row[object.key]];
			}
			//console.log("tableUtilities.createObject");console.log(object);console.log(row);
			if(object.type===undefined){
				 return "No se encuentra el atributo [type] dentro del objeto.";
			}
			var uniqueString = tableUtilities.createUniqueIdString($("#"+id).data('unique'), row);
			switch(object.type){
				case 'select'://GOTO
					if(row[object.key]===undefined){
						return "El valor del objeto ["+object.key+"] no existe en el row.";
					}
					var txt = "<select data-table = '"+id+"' data-tag = '"+object.tag+"' data-key = '"+object.key+"' data-unique-id = '"+uniqueString+"' id = '"+id+""+object.key+""+uniqueString+"' class = '"+id+object.key+object.type+" "+id+object.key+" "+id+"selectpicker selectpicker' data-options = '"+JSON.stringify(row[object.key])+"'></select>";
					return txt;
				break;
				case 'table-radio':
					if(object.options===undefined){
						return "Un objeto con type:[table-radio] requiere un string [options]";
					}
					var txt = "<div data-table = '"+id+"' data-key = '"+object.key+"' data-unique-id = '"+uniqueString+"' id = '"+id+""+object.key+""+uniqueString+"' class = '"+id+"table-radio-group "+id+object.key+" "+object.options+"' data-option = '"+object.options+"'>";
					//console.log("TABLE RADIO");console.log(row);
						txt += "<button class = 'btn table-radio btn-default ";
						if(row[object.key]==1){
							txt += "is-selected";
						}
						txt +=" ' value = '"+1+"' type = 'button'>"+object.options+"</button>";
					txt += "</div>";
					return txt;
				break;
				case 'table-checkbox':
						//console.log(row);console.log($("#"+id).data());console.log(id);
					var txt = "<input data-table = '"+id+"' ";
					if(row[object.key]===true){
						txt += "checked";
					}
					txt += " data-key = '"+object.key+"' data-unique-id = '"+uniqueString+"' id = '"+id+""+object.key+""+uniqueString+"' class = '"+id+"table-checkbox "+id+object.key+"' type = 'checkbox' />";
					return txt;
				break;

				case 'radio':
					if(object.options===undefined){
						return "Un objeto con type:[radio] requiere un arreglo de strings con la llave [options]";
					}
					//console.log(id);
					var txt = "<div data-table = '"+id+"' data-key = '"+object.key+"' data-unique-id = '"+uniqueString+"' id = '"+id+""+object.key+""+uniqueString+"' class = '"+id+"radio-group "+id+object.key+"'>";
					if(typeof(object.options[0])=="object"){
						for(var i = 0;i<object.options.length;i++){
								var actual = object.options[i];
								txt += "<button class = 'btn table-radio ";
								if(object.selected!==undefined&&object.selected==actual.id){
									txt += "is-selected";
								}else{
									if(row[object.key]!==undefined&&row[object.key]==actual.id){
											txt += "is-selected";
									}
								}
								if(object.required!==undefined){
									txt += " data-required = '";
									if(object.required){
										txt += "true";
									}else{
										txt += "false";
									}
									txt += "'";
								}
							 txt += " btn-default' ";
							 if(object.required!==undefined){
								 txt += " data-required = '";
								 if(object.required){
									 txt += "true";
								 }else{
									 txt += "false";
								 }
								 txt += "'";
							 }
							 txt += " value = '"+actual.id+"' type = 'button'>"+actual.value+"</button>";
						}
					}else{
						for(var i = 0;i<object.options.length;i++){
								txt += "<button class = 'btn table-radio ";
								if(object.selected!==undefined&&object.selected==i){
									txt += "is-selected";
								}else{
									if(row[object.key]!==undefined&&row[object.key]==i){
											txt += "is-selected";
									}
								}
							 txt += " btn-default' ";
							 if(object.required!==undefined){
								 txt += " data-required = '";
								 if(object.required){
									 txt += "true";
								 }else{
									 txt += "false";
								 }
								 txt += "'";
							 }
							 txt += " value = '"+i+"' type = 'button'>"+object.options[i]+"</button>";
						}
					}
					txt += "</div>";
					return txt;
				break;
				case 'number':
					var txt = "<input type = 'number' "+tableUtilities.createValidationText(object);
					//console.log("NUMBER");console.log(row);
					if(row[object.key]===false){
						return "N/A";
					}else if(row[object.key]!==undefined){
						txt += "value = '"+row[object.key]+"'";
					}
					txt+= " data-table = '"+id+"' data-key = '"+object.key+"' data-unique-id = '"+uniqueString+"' id = '"+id+""+object.key+""+uniqueString+"' class = '"+id+""+object.key+"number "+id+object.key+"'>";
					txt += "<div id = '"+id+""+object.key+""+uniqueString+"_warn' class = 'validator-warn'></div>";
					return txt;
				break;
				case 'textarea':
						var txt = "<textarea "+tableUtilities.createValidationText(object);
						txt += " data-table = '"+id+"' data-key = '"+object.key+"' data-unique-id = '"+uniqueString+"' id = '"+id+""+object.key+""+uniqueString+"' class = '"+id+""+object.key+"textarea "+id+object.key+"'>";
						if(row[object.key]===false){
							return "N/A";
						}else if (row[object.key]==="N/A"){
							txt += "";
						}else if(row[object.key]!==undefined){
							txt += row[object.key];
						}
						txt += "</textarea><div id = '"+id+""+object.key+""+uniqueString+"_warn' class = 'validator-warn'></div>";
						return txt;
				break;
				case 'datetime':
							//console.log("OBJECT IS DATE TIME");
							if(Object.prototype.toString.call(row[object.key]) === '[object Date]'){
								var val = Utilizer.dateParseToDbDate(row[object.key]);
							}else{
								var val = Utilizer.fechaParseToDbDate(row[object.key]);
							}
							//console.log("VALUE ["+val+"]");
							if(object.defaultTime!==undefined){
								val +="T"+object.defaultTime;
							}
							var txt = "<div class='input-group date "+id+object.key+" "+id+"dateTime' data-table = '"+id+"' data-value = '"+val+"' ";
							if(object.options){
								txt += "data-options = '"+JSON.stringify(object.options)+"'";
							}
							txt += " data-key = '"+object.key+"' data-unique-id = '"+uniqueString+"' id = '"+id+""+object.key+""+uniqueString+"'>";
								txt +=  "<div class='inputFecha dateTime'><span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span><span class='glyphicon glyphicon-time'></span></span><input type='text' class='form-control' /></div></div>";
							return txt;
				break;
				case 'display':
					//var txt = "<input type='text' value = '"+row[object.key]+"' class='information-display' id = '"+id+""+object.key+""+uniqueString+"' disabled/>";
					var txt = "<div id = '"+id+""+object.key+""+uniqueString+"'>"+row[object.key]+"</div>";
					return txt;
				break;
				case 'checkbox':
					if(object.options===undefined){
						return "Un objeto con type:[checkbox] requiere un arreglo de strings con la llave [options]";
					}
					var txt = "<div data-table = '"+id+"' data-key = '"+object.key+"' data-unique-id = '"+uniqueString+"' id = '"+id+""+object.key+""+uniqueString+"' class = '"+id+"checkbox-group "+id+object.key+"'>";
					if(typeof(object.options[0])=="object"){
						for(var i = 0;i<object.options.length;i++){
								var actual = object.options[i];
								txt += "<button class = 'btn table-checkbox ";
								if(object.selected!==undefined&&object.selected==actual.id){
									txt += "is-selected";
								}else{
									for(var j = 0;j<row[object.key].length;j++){
										if(row[object.key][j]==actual.id){
											txt += "is-selected";
										}
									}
								}
							 txt += " btn-default' value = '"+actual.id+"' type = 'button'>"+actual.value+"</button>";
						}
					}else{
						for(var i = 0;i<object.options.length;i++){
								txt += "<button class = 'btn table-checkbox ";
								if(object.selected!==undefined&&object.selected==i){
									txt += "is-selected";
								}else{
									for(var j = 0;j<row[object.key].length;j++){
										if(row[object.key][j]==actual.id){
											txt += "is-selected";
										}
									}
								}
							 txt += " btn-default' value = '"+i+"' type = 'button'>"+object.options[i]+"</button>";
						}
					}
					txt += "</div>";
					return txt;
				break;
			}
			return "objeto "+object.key;
	}

	tableUtilities.getObjectData = function (id, object, data){
			//console.log("getObjectData "+id);console.log(object);console.log(data);
			var tab = tableUtilities.getDataTable(id);
			var objId = id+""+object.key+""+tableUtilities.createUniqueIdString($("#"+id).data('unique'), data), send = "";
			//console.log("OBJID "+objId);
			switch(object.type){
				case 'table-radio':
					send = tab.$("#"+objId).find('button').hasClass('is-selected');
				break;
				case 'radio':
						send = tab.$("#"+objId).find('.is-selected').val();
						if(tab.$("#"+objId).find('button').length==1){
							if(send===undefined){
								send = false;
							}else{
								send = true;
							}
						}
						//console.log("RADIO");console.log(objId);console.log(send);
				break;
				case 'checkbox':
						send = tab.$("#"+objId).find('.is-selected');
						send = send.map(function(i,v) {return $(this).val();}).toArray();
				break;
				case 'table-checkbox':
						send = tab.$("#"+objId).prop('checked');
				break;
				case 'display':
					send = tab.$("#"+objId).text();
				break;
				default:
						//console.log("OBJECT DEFAULT");
						if(tab.$("#"+objId).is('input')||tab.$("#"+objId).is('textarea')){
							//console.log("IS INPUT OR TEXTAREA");
							send = tab.$("#"+objId).val();
						}else if(tab.$("#"+objId).hasClass('selectpicker')){
							send = tab.$("#"+objId).val();
						}else if(tab.$("#"+objId).hasClass('date')){
							//console.log("HAS CLASS date");
							if(tab.$("#"+objId).find('.dateTime').length>0){
								send = Utilizer.dateTimeParseToDbDate(tab.$("#"+objId).find("input").val());
							}else{
									send = Utilizer.fechaParseToDbDate(tab.$("#"+objId).find("input").val());
							}
						}else{
							send = tab.$("#"+objId).text();
						}
						//console.log("NAME ["+objId+"] VALUE ["+send+"]");
				break;
			}
			//console.log(send);
			return send;
	}

	tableUtilities.getTableDataFromInput = function (obj){

		return $(obj).parent().parent().find('.rowData').eq(0).data();
	}

	//Agrega una fila
	tableUtilities.addRow = function (id, row, botones){
		if(tableList[id]===undefined){
			Messager.addAlertText('tableUtilities.addRow', 'No existe una declaración tabla ['+id+'], utilice tableUtilities.createTable(id, columnas) para continuar', 'e');
			return;
		}
		//Table and element, and initalization
		var tabl = tableUtilities.getDataTable(id);
		var elements = tableUtilities.getElements(id);
		var i, length = elements.length, arr = new Array(), boton, j;
		row['dataTableId'] = id;
		if(_.indexOf(elements, 'seleccionar')!=-1){
			row['seleccionar'] = 'checkbox';
		}
		row = tableUtilities.formatDataToPaint(row, id);
		//console.log("ROW");console.log(row);
		//GOTO
		//Iteramos los elementos que deben de ir en la tabla
		for(i=0;i<length;i++){
			if(i!=length-1){
				//console.log("ROW");console.log(row);console.log("ELEMENTS[i]");console.log(elements[i]);
				if(row[elements[i]]===undefined&&elements[i].key===undefined){
					//console.log("tableUtilities.addRow ERROR: El elemento definido ["+elements[i]+"] no se encuentra dentro del objeto insertado.");
					arr.push(elements[i]+": No se encontró");
				}else{
					//Tomamos el elemeneto del objeto row y lo ponemos en un arreglo
					if(typeof(elements[i])=="object"){//POLLO
						arr.push(tableUtilities.createObject(id, elements[i], row));
					}else{
						arr.push(row[elements[i]]);
					}
				}
			}else{
				//La última columna recibe botones y un div
				boton = "";
				if(botones){
					//console.log(botones);
					//Botones es un arreglo con 3 datos, el nombre del boton, sus clases de estilos y una funcion que se hará bind
					for(j=0;j<botones.length;j++){
						boton += "<button type = 'button' class = 'btn "+botones[j][1]+"'> "+botones[j][0]+"</button> ";
					}
					arr.push(boton+" <div class = 'rowData'></div>");
				}else{
					if(typeof(elements[i])=="object"){
						arr.push(tableUtilities.createObject(id,elements[i],row)+" <div class = 'rowData'></div>");
					}else{
						arr.push(row[elements[i]]+" <div class = 'rowData'></div>");
					}
				}
			}
		}
		//Nodo para buscar el div y los botones recien agregados
		//Nodo para buscar el div y los botones recien agregados
		var node = tabl.row.add(arr).node(), j, keys, temp, functions;
		for(i=0;i<length;i++){
			if(typeof(elements[i])=='object'){
				//console.log("ES UN OBJETO OBJETEADO ");console.log(elements[i]);console.log("FINDING ["+"."+id+""+elements[i].key+elements[i].type+"]");
				var unbind = true, temp = $(node).find("."+id+""+elements[i].key+elements[i].type);
				//GOTO
				//console.log("TEMP");console.log(temp);
				if(elements[i].functions){
					//console.log("TIENE FUNCTIONS");console.log(elements[i].functions);
					keys = Object.keys(elements[i].functions);
					for(j=0;j<keys.length;j++){
						if(elements[i].functions){
							if(unbind){
								$(temp).unbind();
								unbind = false;
							}
							functions = Object.keys(elements[i].functions);
							for(k=0;k<functions.length;k++){
								//console.log("BINDING ["+functions[k]+"]");console.log(elements[i].functions[functions[k]]);
								$(temp).on(functions[k], elements[i].functions[functions[k]]);
							}
						}
					}
				}//END FUNCTIONS
				if(elements[i].validation){
					//console.log("TIENE VALIDACION");console.log(temp);
					$(temp).change(function (){
							FormEngine.validateObject(this);
					});
				}
			}
		}
		//Buscamos el div y metemos el objecto row dentro de el para futuras referencias
		$(node).find('.rowData').data(row);
		if(botones){
			//Si existe botones
			var clase = "";
			for(j=0;j<botones.length;j++){
				//Se toma la primer clase y se le hace un bind de la funcion seleccionada
				//console.log(botones[j][2]===undefined);
				if(botones[j][1]===undefined){
					Messager.addAlertText('tableUtilities.addRow', 'El boton #['+j+'] no tiene su clase definida. Asegurese de que el boton esté declarado de la siguiente forma [Texto boton, Clase, funcion]');
				}else if (botones[j][2]===undefined){
					Messager.addAlertText('tableUtilities.addRow', 'El boton #['+j+'] no tiene su función definida. Asegurese de que el boton esté declarado de la siguiente forma [Texto boton, Clase, funcion]');
				}else{
					clase = botones[j][1].split(' ');
					$(node).find("."+clase[0]).click(id, botones[j][2]);
				}
			}
		}
	}
	//Toma los datos a partir de un evento (Es decir despues de un click)
	//Necesito sacar el id de la tabla!
	tableUtilities.getDataFromEvent = function (event) {
		  var data = $(event.target).parent().find('div').data();
			return tableUtilities.formatDataToSend(data);
	}
	tableUtilities.getDataFromButton = function (but) {
			var data = $(but).parent().find('div').data();
			return tableUtilities.formatDataToSend(data);
	}
	//Agrega y dibuja una fila
	tableUtilities.addRowDraw = function (id, row, botones){
		tableUtilities.addRow(id, row, botones);
		tableUtilities.draw(id);
	}
	//Borra una fila y luego la vuelve a insertar con los nuevos datos
	tableUtilities.updateRow = function (id, rowParameters, rowData, boton){
		tableUtilities.deleteRow(id,  rowParameters, true);
		if(boton!==undefined){
			tableUtilities.addRowDraw(id, rowData, boton);
		}else{
			tableUtilities.addRowDraw(id, rowData);
		}
	}
	//Regresa las llaves de los datos de una fila
	tableUtilities.getRowDataKeys = function (id){
		return Object.keys($(tableUtilities.getDataTable(id).row(0).node()).find('div').data());
	}
	//Regresa los datos de la fila que cumpla con rowParameters
	tableUtilities.getRowData = function (id, rowParameters){
		var t = tableUtilities.getDataTable(id);
		var result = "";

		t.rows().every(function (rowIdx, tableLoop, rowLoop){
			if(result.length==""){
				var dats = $(this.node()).find('.rowData').data();
				if(_.isMatch(dats, rowParameters)){
					result = dats;
				}//If match
			}
		});//Every
		return result;
	}
	//Borra una fila que cumpla con rowParameters
	tableUtilities.deleteRow = function (id, rowParameters, noExecute){
		var t = tableUtilities.getDataTable(id);
		var result = true;
		t.rows().every(function (rowIdx, tableLoop, rowLoop){
			if(result){
				if(_.isMatch($(this.node()).find('.rowData').data(), rowParameters)){
					result = false;
					t.row(this).remove();
				}//If match
			}//If result
		});//Every
		//AQI
		if(noExecute===undefined){
			var afterDelete = $("#"+id).data('afterdelete');
			if(afterDelete){
				  window[afterDelete](rowParameters);
			}
		}
		tableUtilities.draw(id);
	}

	tableUtilities.getFilteredRowsData = function (id){
		var rows = $("#"+id).dataTable().$('tr', {"filter":"applied"}), data = [], actual
		for(var i = 0;i<rows.length;i++){
			actual = $(rows[i]).find('.rowData').data();
			if(actual!==undefined){
				data.push(actual);
			}
		}
		data = tableUtilities.formatDataToSend(data, id);
		console.table(data);
		return data;
	}

	//Regresa la suma de los elementos dentro de la columna especificada
	tableUtilities.getRowTotal = function (id, row){
		var total = 0;
		var t = tableUtilities.getDataTable(id);
		t.rows().every(function (rowIdx, tableLoop, rowLoop){
			var data = $(this.node()).find('.rowData').data();
				if(typeof data[row] == "string"){
					total += Utilizer.coinToNumber(data[row]);
				}else if($.isNumeric(data[row])){
					total += data[row];
				}else{
					total += 0;
				}
		});//Every
		return total;
	}
	//Dibuja la tabla
	tableUtilities.draw = function (id){
		//console.log("TABLE UTILITIES DRAW");
		tableUtilities.updateSelect(id);
		//console.log("UPDATED SELECT");
		//ORDENAR HEADERS
		//console.log("DRAW");console.log("DRAW");
		var headers = $("#"+id+" thead").find('th'), orderArray = [], orderArraySuffix = [];
			//console.log("Actual: "+actual);console.log(tableUtilities.getDataTable(id).columns('.ordenar'));
			for(var i = 0;i<tableUtilities.getDataTable(id).columns('.ordenar')[0].length;i++){
				var actual = tableUtilities.getDataTable(id).columns('.ordenar')[0][i]; //data-order='0' data-order-dir = 'asc'
				var header = tableUtilities.getDataTable(id).column(actual).header(); //console.log($(header).data());//console.log($(actual).data());
				var txt = $(headers[actual]).find('span').text(), dir = 'asc';
				if($(header).data('orderDir')!==undefined){
						dir = $(header).data('orderDir');
						if(dir!='asc'&&dir!='desc'){
							dir = 'asc';
						}
				}//console.log(dir);
				//console.log("TEXT");console.log(txt);console.log("DIR");console.log(dir);

				if((txt.indexOf("fecha")>=0 || txt.indexOf("Fecha")>=0)&&$(header).data('order')===undefined){
					orderArraySuffix.push([actual, 'asc']); //orderArray.push([actual, 'desc']);
				}else if($(header).data('order')!==undefined){
					//console.log("ORDER");console.log($(header).data('order'));
					orderArray[$(header).data('order')] = [actual, dir];
				}else{
					orderArraySuffix.push([actual, dir]);
				}
			}
			orderArray = orderArray.concat(orderArraySuffix);
			if(orderArray.length==0){
				orderArray.push([0, 'asc']);
			}
		//console.log("MANDANDO A LLAMAR DATATABLES DRAW");
		tableUtilities.getDataTable(id).order(orderArray).draw(true);
		//PONER WARNINGS
		//FormEngine.validateObject($("#"+id));
		//tableUtilities.createWarnings(id);
		//VER TABLA
		for(var i = 0;i<tableUtilities.getDataTable(id).columns('.hide-col')[0].length;i++){
			tableUtilities.getDataTable(id).columns(tableUtilities.getDataTable(id).columns('.hide-col')[0][i]).visible(false);
		}
		//tableUtilities.getDataTable(id).columns( '.ordenar' ).order(orderArray).draw(true);
//		tableUtilities.getDataTable(id).draw(true);
		//tableUtilities.getDataTable(id).columns.adjust().draw();
		//tableUtilities.checkFooter(id);
		//console.log("DRAW EVENT");
		tableUtilities.drawEvent(id);
		var tab = tableUtilities.getDataTable(id);
		//Initialize special stuff from createObject
		//RADIOS
		tab.$("."+id+"radio-group").find('button').off();
		tab.$("."+id+"radio-group").find('button').click(function (){
			$(this).parent().find('button').removeClass('is-selected');
			$(this).addClass('is-selected');
		});
		//POLLO 2

		tab.$("."+id+"table-radio-group").find('button').off();

		tab.$("."+id+"table-radio-group").find('button').off();
		tab.$("."+id+"table-radio-group").find('button').click(function (){
			if($(this).hasClass('is-selected')){
				$(this).removeClass('is-selected');
			}else{
				tab.$("."+$(this).parent().data('option')).find('button').removeClass('is-selected');
				$(this).addClass('is-selected');
			}
		});

		tab.$("."+id+"table-checkbox").change(function (){
				//console.log("CLICKED");console.log(this);
		});

		tab.$("."+id+"checkbox-group").find('button').off();
		tab.$("."+id+"checkbox-group").find('button').click(function (){
			$(this).toggleClass('is-selected');
		});
	}

	tableUtilities.addDrawEvent = function (id, func){
		tableList[id].drawEvent = func;
	}

	tableUtilities.addFilterEvent = function (id, func){
		tableList[id].filterEvent = func;
	}

	tableUtilities.filterEvent = function (id){
		if(tableList[id].filterEvent){
			tableList[id].filterEvent();
		}
	}

	tableUtilities.drawEvent = function (id){
		if(tableList[id].drawEvent){
			tableList[id].drawEvent();
		}
	}

	tableUtilities.isEmpty = function (id){
		var emptyTable = $("#"+id+" .dataTables_empty");
		if(emptyTable.length==1){
			return true;
		}
		return false;
	}

	tableUtilities.checkFooter = function (id){
		if(tableUtilities.numVisibleRows(id)>tableUtilities.footerMax(id)){
			$("#"+id+" tfoot").show();
		}else{
			$("#"+id+" tfoot").hide();
		}
	}
	tableUtilities.numVisibleRows = function (id){
		return Number($("#"+id+" tr").length)-2;
	}
	//Regresa la data visible
	tableUtilities.getVisibleData = function(id, last){
		var oTable = $("#"+id).dataTable();
		var anNodes = $("#"+id+" tbody tr");
		var data = new Array(), row, temp;
		for (var i = 0; i < anNodes.length; ++i){
			row = oTable.fnGetData( anNodes[i]);
			if(row!=null){
				if(!last){
					temp = row.pop();
				}
				data.push(_.clone(row));
				if(!last){
					row.push(temp);
				}
			}
		}
		return data;
	}

	tableUtilities.generatePDF = function(){
		var t = this;
		var ultimo = $(t).data('ultimo'), id = $(t).data('table'), data = {}, headers = new Array(), widths = new Array(), landscape = $(t).data('landscape');

		if(landscape == 'SI'){
			landscape = true;
		}else {
			landscape = false;
		}

		if(ultimo=='SI'){
			ultimo = true;
		} else {
			ultimo = false;
		}
		$('#'+id+' thead tr th').each(function(){
			headers.push($(this).text());
			widths.push($(this).width());
		});
		if(!ultimo){
			headers.pop();
			widths.pop();
		}
		if(landscape){
			data.landscape = 1;
		}

		data.headers = headers;
		data.widths = widths;
		data.title =  $(t).data('title');
		data.info = tableUtilities.getFilteredData(id, ultimo);
		//console.log(data);
		//return;
		if(data.info==0){
			return 0;
		} else {
			Messager.addAlertText('Generando PDF',"Generando "+id+".pdf.",'i');
			$.post('queries/pdfMake.php', data, function(response){
				window.location.replace('queries/nuevoPDF.php');
			});
		}
		//Utilizer.getResponse($(t).data('script'), {data}, afterGenerate);
	}

	tableUtilities.getFilteredData = function(id, ultimo){
		var data = new Array(), n, l;
		var info = tableUtilities.getDataTable(id).rows( {order:'index', search:'applied'} ).nodes();
		for(var i = 0;i < info.length; i++){
			var temp = new Array();
			n = 0;
			l = $(info[i]).find('td').length;
			$(info[i]).find('td').each(function(){
				if(!ultimo && n == l-1){
					return;
				}
				temp.push($(this).text());
				n++;
			});
			data.push(temp);
		}
		return data;
	}

		/**		Table Engine 	**/
	tableUtilities.initializeTableEngine = function (id){
		var bot = $("#"+id+"Add");
		if(bot.length!=0){
			bot.click(tableUtilities.runTableEngine);
		}else{
			Messager.addAlertText('Table Engine', 'No existe el boton: '+id+'Add', 'e');
		}
	}

	tableUtilities.setUniqueColumns = function (id, cols){
			tableList[id]['unique'] = cols;
	}

	tableUtilities.getUniqueColumns = function (id){
		if(tableList[id]['unique']){
			return tableList[id]['unique'];
		}else{
			return [];
		}
	}
	/*
	tableUtilities.createWarnings = function (id){
		var ele = tableUtilities.getElements(id);
		var objs = new Array();
		for(var i = 0;i<ele.length;i++){
			if(typeof(ele[i])=="object"){
				objs.push(ele[i]);
			}
		}
		//console.log(objs);
	}
	/**/
	tableUtilities.makeUniqueObject = function (id, item){
		//AILEEN
		//console.log("makeUniqueObject!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!");console.log("ID ["+id+"]");console.log("ITEM");console.table(item);
		var unique = $("#"+id).data('unique').split(','), uniqueObj = {}, elem = tableUtilities.getElements(id), skip, itemKeys = Object.keys(item);
		//console.log("UNIQUE");console.table(unique);
		//console.log("ELEMENTS");console.table(elem);
		for(var i = 0;i<unique.length;i++){//console.log("UNIQUE ["+i+"]");console.log(unique[i]);
			skip = false;
			for(var j = 0;j<elem.length;j++){
					if(elem[j].key==unique[i]){//console.log("IS AN ELEMENT");
						skip = true;
						if(typeof elem[j]=='object'){
							switch(elem[j].type){
								case 'select':
								if(typeof item[unique[i]]=='string'){
									uniqueObj[unique[i]] = item[unique[i]];
								}else{
									for(var k = 0;k<item[unique[i]].length;k++){
										if(item[unique[i]][k].selected){
											uniqueObj[unique[i]] = item[unique[i]][k].id;
											break;
										}
									}
								}

								break;
							}
						}else{
							uniqueObj[unique[i]] = item[unique[i]];
						}
						break;
				}
			}
			if(skip){
				continue;
			}
			for(var j = 0;j<itemKeys.length;j++){
				if(unique[i]==itemKeys[j]){
					uniqueObj[unique[i]] = item[unique[i]];
					break;
				}
			}
		}
		//console.log("UNIQUE OBJ!!!");console.table(uniqueObj);
		return uniqueObj;
	}

	tableUtilities.runTableEngine = function (){//console.log("RUNNING TABLE ENGINE");
		var clas = $(this).data("form"), txt = "", r, v, actual = {}, lists = {}, res = $(this).data('reset'), validForm = true;
			/* EACH INPUT */
			$("."+clas).each(function (){
				//console.log("TABLE ENGINE This");console.log(this);
				if(!FormEngine.validateObject(this)){
					validForm = false;
					return;
				}
				//console.log("VALID!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!");
					var id = $(this).attr('id');
					if(id===undefined){
						return;
					}
					if($(this).is('select')){
                if($(this).data('subtext')===undefined){
                    $.extend( actual, Utilizer.getSelectedObject(id, $(this).data('id'), $(this).data('value')));
                  } else {
                    $.extend( actual, Utilizer.getSelectedObject(id, $(this).data('id'), $(this).data('value'), $(this).data('subtext')));
                  }
					}else if($(this).hasClass('switcher')){
							$.extend(actual, FormEngine.getObjectData($("#"+id)));
					}else if($(this).is('table')||$(this).hasClass('grid')){
						lists[id] = FormEngine.getObjectData(this);
					}else{
						actual[id] = FormEngine.getObjectData(this);
					}
					//console.log("ID:"+$(this).attr('id')); console.log($(this)); console.log(actual);
				//console.log($(this).data());
			});
			//console.log("ACTUAL");console.log(actual);console.log("LISTA");console.log(lists);console.log("TXT");console.log(txt);
			/* END EACH INPUT */

			if(validForm){
				var id = $(this).attr('id'), item, keys = Object.keys(lists);
				id = id.substring(0, id.length-3);
				var tempData = tableUtilities.getTableData(id), func = $("#"+id).data('format');
				//console.log("ID");console.log(id);console.log("KEYS");console.log(keys);
				if(keys.length==0){
						item = actual;
						if (func !== undefined) {
							item = window[func](item);
						}
						if(item.buttons!==undefined){
							buttons = item.buttons;
							delete(item.buttons);
						}else{
							buttons = [["Borrar", "borrar btn-danger",tableUtilities.borrarFila]];
						}
						//console.log(buttons);
						//console.log("INSERTING WITH ARRAY ");console.log(item);
						if($("#"+id).data('unique')!==undefined){
							uniqueObj = tableUtilities.makeUniqueObject(id, item);
							if(!tableUtilities.isInTable(id, uniqueObj)){
								tableUtilities.addRow(id, item,  buttons);
							}
						}else{
							tableUtilities.addRow(id, item,  buttons);
						}
				}else{
					for(var j = 0;j<keys.length;j++){
							for(var i = 0;i<lists[keys[j]].length;i++){
									item = {};
									item = Object.assign(item, lists[keys[j]][i]);
									item = Object.assign(item, actual);
									//console.log("ITEM");console.log(item);
									if (func !== undefined) {
										item = window[func](item);
									}
									if(item.buttons!==undefined){
										buttons = item.buttons;
										delete(item.buttons);
									}else{
										buttons = [["Borrar", "borrar btn-danger",tableUtilities.borrarFila]];
									}
									//console.log("INSERTING");console.log(item);
									if($("#"+id).data('unique')!==undefined){
										uniqueObj = tableUtilities.makeUniqueObject(id, item);
										if(!tableUtilities.isInTable(id, uniqueObj)){
											tableUtilities.addRow(id, item,  buttons);
										}
									}else{
										tableUtilities.addRow(id, item,  buttons);
									}
							}
					}
				}
				tableUtilities.draw(id);
				if(res){
					$("."+clas).each(function (){
						//console.log("Yay");
						Utilizer.reset($(this).attr('id'));
					})
				}
        var after = $("#"+id).data('afterinsert');
				//console.log("AFTER INSERT");console.log(after);
        if (after !== undefined) {
					if(window[after]===undefined){
							Messager.addAlertText('tableUtilities.runTableEngine', 'No existe la función ['+after+'] en la ventana.', 'e');
					}else{
							window[after](tableUtilities.getTableData(id),tempData, actual);
					}
        }
			}else{
				Messager.addAlertText($(this).text(), "Algunos campos de la forma son invalidos, por favor corrija dichos campos y vuelva a intentarlo.", 'w');
			}
	}

	tableUtilities.loadScript = function (id, script, params, func){
		//console.log("Load script");
			if (func && typeof(func) === "function") {
				//console.log("Func existe");
				tableUtilities.clearTable(id);
				Utilizer.getResponse(script, params, tableUtilities.afterLoad, {idTable: id, f: func});
			}else{
				//console.log("Func no existe");
					Messager.addAlertText('tableUtilities.loadScript', 'No existe la funcion ['+func+'], asegurese que se encuentra declarada en el contexto de ventana, fuera de cosas como $(document).ready(function(){}). ','e');
			}
	}

	tableUtilities.afterLoad = function (data, extra){
		var i = 0, actual;
		//console.log("afterLoad");console.log(data);
		for(i = 0;i<data.length;i++){
			if(data[i]===undefined){
				Messager.addAlertText('tableUtilities.afterLoad', 'La data que se pasa en afterLoad no está definida.', 'e');
				return;
			}else if (data[i]=="<"){
				console.log(data);
				Messager.addAlertText('tableUtilities.afterLoad', 'No se cargo bien la tabla.', 'e');
				//console.log("Respuesta de loadScript: "+data);
				return;
			}else if (data[i]=='e'){
				console.log(data);
				Messager.addAlertText('tableUtilities.afterLoad', 'Datos Invalidos.', 'e');
				//console.log("Respuesta de loadScript: "+data);
				return;
			}
			actual = data[i];

			if(extra.f){
				actual = extra.f(actual);
			}
			//console.log(actual);
			if(actual.buttons!==undefined){
				tableUtilities.addRow(extra.idTable, actual, actual.buttons);
				delete(actual.buttons);
			}else{
				tableUtilities.addRow(extra.idTable, actual);
			}
		}
		tableUtilities.draw(extra.idTable);
	}
	/*
	tableUtilities.getHeaders = function (id){
		return $("#"+id).find("thead").find("th").map(function (index, element){
			return $(element).text();
		});
	}
	*/
	tableUtilities.getDataForPdf = function (id){
		var data = {};
			data.headers = tableUtilities.getHeaders(id).slice(0);
			data.elements = tableUtilities.getElements(id).slice(0);
			//console.log("HEADERS");console.log(data.headers);console.log("ELEMENTS");console.log(data.elements);
			if(data.headers[data.headers.length-1]=="ACCIONES"||data.headers[data.headers.length-1]=="acciones"||data.headers[data.headers.length-1]=="Acciones"){
					data.headers.splice(-1, 1);
					data.elements.splice(-1, 1);
			}
		data.info = tableUtilities.getFilteredData(id);
		var send = {};
		//HEADER
		send.header = Array();
		send.info = Array();
		for(var i = 0;i<data.headers.length;i++){
			send['header'][i] = {};
			send['header'][i]['titulo'] = data.headers[i];
			send['header'][i]['key'] = data.elements[i];
		}

		for(var i = 0;i<data.info.length;i++){
			send.info[i] = {};
			for(var j = 0;j<data.elements.length;j++){
				send['info'][i][data.elements[j]] = data.info[i][j];
			}
		}
		send.titulo = $("#"+id).data('titulo')===undefined?"":$("#"+id).data('titulo');
		send.titulopdf = $("#"+id).data('pdf')===undefined?"":$("#"+id).data('pdf');
		send.filtros = tableUtilities.getFilters(id);
		return send;
	}
	tableUtilities.getFilterText = function (id){
		//console.log("getFilterText");
		var txt = "", filters = tableUtilities.getFilters(id);
		//console.log(filters);
		for(var i = 0 ;i<filters.length;i++){
			if(filters[i].valor!==undefined){
				txt += filters[i].nombre+" ["+filters[i].valor+"] \n";
			}
		}
		if(txt!=""){
			txt = "FILTROS \n"+txt;
		}
		return txt;
	}

	tableUtilities.getFilters = function (id){
		var data = Array();
		$("#searcher"+id).find('.input-group').each(function (){
			var arr = {};
			arr.nombre = $(this).find('.label-right').text();
			arr.nombre = arr.nombre.replace(":", "");
			arr.valor = Utilizer.getSelected($(this).find('.selectpicker').attr('id')).text();
			if(arr.valor!="Todos"){
				data.push(arr);
			}
		});
		var extra = $("#"+id+"_filter").find('input').val();
		if(extra!=""){
			data.push({nombre:"FILTRAR", valor:extra});
		}
		return data;
	}
});
