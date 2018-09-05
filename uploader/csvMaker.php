<?php

class CSVMaker{
	function makeCSV($name, $header, $query){
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: inline; filename='.basename($name).'.csv');
		$output = fopen('php://output', 'w');
		//Output the header
		$data = $this->getData($query);
		foreach($data as $k => $v){
			foreach($v as $kk => $vv){
				$data[$k][$kk] = utf8_decode($vv);
			}
		}
		fputcsv($output, $header);
		foreach($data as $v){
			fputcsv($output, $v);
		}
		fclose($output);
	}

	function getData($query){
		include "dbcon.php";
		$stmt = $con->stmt_init();
		if(!$stmt->prepare($query)){
			return [];
		}else{
			$data = array();
			$stmt->execute();
			$result = $stmt->get_result();
			while ($row = $result->fetch_array(MYSQLI_NUM)){
				$data[] = $row;
			}
			$stmt->close();
			return $data;
		}
	}

	function makeCSVHeader($name, $header){
		$h = array();
		$r = array();
		foreach($header as $k=>$v) {
			$h[] = $k;
			$txt = "";
			if($v['r']){
				$txt .= "Requerido: ";
			}else{
				$txt .= "Opcional: ";
			}
			switch($v['t']){
				case 'date':		$txt .= "Fecha con formato: yyyy-mm-dd";		break;
				case 'datetime':	$txt .= "Fecha y hora con formato: yyyy-mm-dd HH:mm";		break;
				case 'alpha':		$txt .= "Letras y espacios";		break;
				case 'pref':		$txt .= "Letras, espacios y puntos";		break;
				case 'alphnum':		$txt .= "Letras, números y espacios";		break;
				case 'alphnumper':	$txt .= "Letras, números, parentesis y espacios";		break;
				case 'specs':		$txt .= "Letras, números, _ . , \ / - y espacios";		break;
				case 'servs':		$txt .= "Letras, números, _ . , \ / -, comillas dobles, ! = ? + y espacios";		break;
				case 'prinac':		$txt .= "Letras, números, _ . , \ / -, comillas dobles, ! = ? + % ( ) y espacios";		break;
				case 'tel':			$txt .= "Números, guines y espacios";		break;
				case 'num':			$txt .= "Números";		break;
				case 'int':			$txt .= "Números enteros (Positivos o negativos)";		break;
				case 'dec':			$txt .= "Números decimales con hasta 6 decimales (Positivos o negativos)";		break;
				case 'coin':		$txt .= "Números decimales con hasta 2 decimales (Positivos o negativos)";		break;
				case 'use':			$txt .= "Números enteros positivos.";		break;
				case 'website':		$txt .= "Dirección web.";		break;
				case 'email':		$txt .= "Correo electronico";		break;
				case 'rfc':			$txt .= "Formato de RFC";		break;
				case 'name':		$txt .= "Letras, puntos y espacios";		break;

			}
			$r[] = utf8_decode($txt);
		}
		/*
		$this->exps['date'] = '/^[0-9]{4}\-[0-1][0-9]\-[0-3][0-9]$/';
			$this->exps['datetime'] = '/^[0-9]{4}\-[0-1][0-9]\-[0-3][0-9] [0-2][0-9]\:[0-5][0-9]$/';
			$this->exps['alpha'] = '/^[A-Za-záéíóúñÑÁÉÍÓÚÜü ]+$/';
			$this->exps['alphnum'] = '/^[0-9A-Za-záéíóúñÑÁÉÍÓÚÜü ]+$/';
			$this->exps['alphnumper'] = '/^[0-9A-Za-záéíóúñÑÁÉÍÓÚÜü\(\) ]+$/';
			$this->exps['specs'] = '/^[0-9A-Za-záéíóúñÑÁÉÍÓÚÜü _.,\/\-]+$/';
			$this->exps['servs'] = '/^[0-9A-Za-záéíóúñÑÁÉÍÓÚÜü _.,\/\-"!=\?\+]+$/';
			$this->exps['tel'] = '/^[0-9 -]+$/';
			$this->exps['num'] = '/^[0-9]+$/';
			$this->exps['int'] = '/^(\-)?[0-9]+$/';
			$this->exps['dec'] = '/^\-?[0-9]+(\.[0-9]{1,6})?$/';
			$this->exps['coin'] = '/^\-?[0-9]+(\.[0-9]{1,2})?$/';
			$this->exps['use'] = '/^[0-9]+$/';
			$this->exps['website'] = '/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/';
			$this->exps['email'] = '/^[a-z0-9._-]+@([a-z0-9-]{2,}\.)+[a-z0-9-]{2,}$/';
			$this->exps['pass'] = '/^[a-zA-Z0-9]{4,12}$/';
			$this->exps['bool'] = '/^(T|t)rue|TRUE|(F|f)alse|FALSE|1|0$/';
			$this->exps['rfc'] = '/^[A-ZÑ]{4}[0-9]{2}(0[123456789]|10|11|12)[0-3][0-9][A-ZÑ0-9]{3}$/';
			$this->exps['year'] = '/^[0-9]{4}$/';
			$this->exps['name'] = '/^[0-9A-Za-záéíóúñÑÁÉÍÓÚÜü. ]+$/';

		/**/
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: inline; filename='.basename($name).'.csv');
		$output = fopen('php://output', 'w');
		$r[] = "Borre esta fila.";
		fputcsv($output, $h);
		fputcsv($output, $r);
		fclose($output);
		/**/
		//var_dump($name);var_dump($header);var_dump($h);var_dump($r);
	}

}
?>
