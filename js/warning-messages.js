var Messager = {};
$(document).ready(function(){
	/*Function to add header and message to alert*/
	Messager.addAlertText = function (headerText, message, type){
		var clas = '';
		//var subClas = '';
		var divId = 'messageContainer';
		if(type == "e")
		{
			clas = 'error';
			console.log(headerText+": "+message);
			//subClas = 'error';
		} else if (type == "i")
		{
			clas = 'info';
			//subClas = 'info';
		} else if (type == "w")
		{
			clas = 'warning';
			//subClas = 'warning';
		} else if (type == "s")
		{
			clas = 'success';
			//subClas = 'success';
		}
		var div = $('<div class="'+clas+' message"><h3 class="header-text"><div class="'+clas+'-icon-message"></div> '+headerText+'</h3><p class="paragraph-text">'+message+'</p></div>');
		var container = $("#"+divId);
		container.append(div);
		var seconds = 0;
		seconds += Utilizer.subStringNumInString(headerText,' ')+1;
		seconds += Utilizer.subStringNumInString( message,' ')+1;
		seconds *= 1300;
		seconds /= 4;
		setTimeout(function(){
				$(div).slideFadeToggle(1000);
			}, seconds
		);
		//hideWarningMessage(subClas, 1000);
	}

	$.fn.slideFadeToggle  = function(speed, easing, callback) {
        return this.animate({opacity: 'toggle', height:'toggle', padding: 'toggle'}, speed, easing, callback);
	};

	Messager.hideWarningMessage = function (id, time){
		$("#"+id).fadeOut(time);
	}
});
