var Csser = {};
$(document).ready(function(){
	/** ;
		* @param {String} string   Required. The string;
	* @author
	*/
	Csser.collapse = function (headerIndex,itemIndex){
		var header = $('#collapse'+headerIndex);
		header.removeClass('collapse');
		if(header.length==0){
			Messager.addAlertText('Csser', 'No existe [#collapse'+headerIndex+'] dentro del documento.', 'e');
		}else{
			if(itemIndex>=0){
				var item = $('#collapse'+headerIndex).find('a').eq((Number(itemIndex)));
				if(item.length==0){
					Messager.addAlertText('Csser', 'No existe un objeto en la posición ['+itemIndex+'] dentro de [#collapse'+headerIndex+']', 'e');
				}else{
					item.find('button').addClass('is-selected');
				}
			} else if(itemIndex==undefined){
				var item = $('#collapse'+headerIndex).prev();
				if(item.length==0){
					Messager.addAlertText('Csser', 'No existe un objeto en la posición ['+itemIndex+'] dentro de [#collapse'+headerIndex+']', 'e');
				}else{
					item.addClass('is-selected');
				}
			}
		}
	}
});
