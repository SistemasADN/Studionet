var Chartizer = {};
//console.log("CHARTIZER");
$(document).ready(function(){
		Chartizer.months = ["ENE", "FEB", "MAR", "ABR", "MAY", "JUN", "AGO", "SEP", "OCT", "NOV", "DEC"];
		Chartizer.monthsText = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];


		Chartizer.bar = function (id, title, date, numberType, data){
			var labs = new Array(), extraTitle = "";
			if($.isNumeric(date)){//Año
					labs = Chartizer.months;
					extraTitle = date;
			}else if(date.year!==undefined){
				for(var i = 1;i<=Utilizer.daysInMonth(date.year, date.month);i++){
					labs.push(i);
				}
				extraTitle = Chartizer.monthsText[date.month-1]+"/"+date.year;
			}else{
				labs = date;
			}

			var ctx = $("#"+id);
			var myChart = new Chart(ctx, {
		    type: 'bar',
		    data: {
		        labels: labs,
		        datasets: data
		    },
		    options: {
					title: {
						display:true,
						text: title+" "+extraTitle
					},
					scales: {
							yAxes: [{
									ticks: {
											beginAtZero:true,
											callback: function (value){
												if(numberType=="$"){
													return Utilizer.numberToCoin(value);
												}else if (numberType=="%"){
													return value+"%";
												}else{
													return value;
												}
											}
									},
									scaleLabel: {
						        display: true,
						      }
							}]
					},
					tooltips: {
									 enabled: true,
									 callbacks: {
											 label: function(tooltipItems, data) {
//												 	console.log(tooltipItems.datasetIndex);
//													console.log(data['datasets'][tooltipItems.datasetIndex]['label']);
													if(numberType=="$"){
	 													return data['datasets'][tooltipItems.datasetIndex]['label']+" "+Utilizer.numberToCoin(tooltipItems.yLabel);
	 												}else if (numberType=="%"){
	 													return data['datasets'][tooltipItems.datasetIndex]['label']+" "+tooltipItems.yLabel+"%";
	 												}else{
	 													return data['datasets'][tooltipItems.datasetIndex]['label']+" "+tooltipItems.yLabel;
	 												}
											 }
									 }
							 }
		    }
			});
		}


			Chartizer.pie = function (id, labels, title, numberType, backgroundColor, data){
				console.log("CREATING PIE CHART");
				console.log(id);
				var labs = new Array(), extraTitle = "";

				var ctx = $("#"+id);
				if(ctx.length==0){
					$("table").each(function (){
							if(ctx.length==0){
								var table = tableUtilities.getDataTable($(this).attr('id'));
								if(table){
									ctx = table.$("#"+id);
								}
							}
					});
				}
				console.log(ctx);
				var myPieChart  = new Chart(ctx, {
			    type: 'pie',
					"data":{
						"labels":labels,
						"datasets":[
							{"label":"????",
							"data":data,
							"backgroundColor":backgroundColor
							}
						]
					},
			    options: {
						title: {
							display:true,
							text: title+" "+extraTitle
						},
						tooltips: {
										 enabled: true,
										 callbacks: {
												 label: function(tooltipItems, data) {
													 var number = data['datasets'][0]['data'][tooltipItems.index];
														if(numberType=="$"){
		 													return data['labels'][tooltipItems.index]+" "+Utilizer.numberToCoin(number);
		 												}else if (numberType=="%"){
		 													return data['labels'][tooltipItems.index]+" "+number+"%";
		 												}else{
		 													return data['labels'][tooltipItems.index]+" "+number;
		 												}
												 }
										 }
								 }
			    }
				});
		}
});
