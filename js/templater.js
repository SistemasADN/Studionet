var Templater = {};
$(document).ready(function(){
	Templater.startTemplating = function (clas){
		$("."+clas).each(function (){
			console.log($(this).attr('id'));
			console.log($(this).data());
			var rep = "";
			switch($(this).data('type')){
				case 'title': 
					rep = Templater.templateTitle(this); break;
				case 'legend': 
					rep = Templater.templateLegend(this); break;
			}
			$(this).replaceWith(rep);
		});
	}
	
	Templater.templateTitle = function (obj){
		var data = $(obj).data();
		var icon = data.icon;
		var text = data.text;
		var temp = '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">';
		if(icon!==undefined){
			temp += '<div class="logo-container"><i class="fa '+icon+'"></i></div>';
		}
		temp += '<div class="text-container">'+text+'</div></div>';
		return temp;
	}
	
	Templater.templateLegend = function (obj){
		var data = $(obj).data();
		var text = data.text;
		var temp = '<div class="col-xs-12 col-sm-12 col-md-12"><div class="jumbotron jumbotron-container"><div class="jumbotron-text">'+text+'</div></div></div>';
		return temp;
	}
	
	Templater.templateForm = function (form, inputs){
		var f = $("."+form), actual;
		for(var i=0;i<inputs.length;i++){
			actual = inputs[i];
			if(actual.type=="select"){
				
			}else{
				f.append(Templater.templateInput(actual));
			}
		}
	}

	Templater.templateInput = function (input){
		var r = '<div class="col-xs-12 col-sm-12 col-md-12 input-container"><input ';
		for(keys in input){
			if(keys=="required"){
				r+= keys+" ";
			}else{
				r+= keys+"='"+input[keys]+"'";
			}
		}
		r += "/></div>";
		return $(r);
	}
});