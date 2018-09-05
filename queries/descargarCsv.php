<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	$rules = array ();
	$rules['csv'] = ['r' => true , 	't' => "alpha"];
	$validator->setRulesValidateArrayEcho($rules,$_POST);
	//var_dump($_POST);exit;
		$csvStuff = true;
		include "../uploader/csvRules.php";
		if(isset($headers[$_POST['csv']])){
			 include "../uploader/csvMaker.php";
			$csv = new CSVMaker();
			$csv->makeCSVHeader($identifier[$_POST['csv']][0], $headers[$_POST['csv']]);
		}else{
			var_dump($_POST);
		}
?>
