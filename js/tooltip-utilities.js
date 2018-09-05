$(document).ready(function(){
	return;
	var delay=1000, setTimeoutConst;
	var helpListing = {
		"PAGOS":"Total de pagos que ha realizado el cliente.",
		"CARTAS DE COBRO":"Total de Cartas de cobro que se han aprobado para el cliente."
	}
	var helpListingKeys = Object.keys(helpListing);

	$("label").each(function (){
        var txt = $(this).text();
        //console.log(txt);
				for(var i = 0;i<helpListingKeys.length;i++){
					if(txt.startsWith(helpListingKeys[i])){
						var newTxt = helpListing[helpListingKeys[i]];
						//console.log(newTxt);
						$(this).hover(function (){
								if(setTimeoutConst===undefined){
										setTimeoutConst = setTimeout(function(){
											Messager.addAlertText(txt, newTxt, 'i');
										}, delay);
								}
						}, function(){
							 clearTimeout(setTimeoutConst);
							 setTimeoutConst = undefined;
						});
					}
				}
    });
});
