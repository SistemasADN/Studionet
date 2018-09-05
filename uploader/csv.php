<?php
	include "../validation/classValidator.php";
	//include_once "../validation/utilities.php";
	$csvStuff = true;
	include "csvRules.php";

	$data = $_FILES['file_data'];
	//var_dump($data);
	/**/
	//$data['type']= 'application/octet-stream';
	//$data['name'] = 'pacientestemp.csv';
	/**/
	$respuesta = array();
	//$respuesta['error'] = $data;
	//var_dump($respuesta);exit;
	if($data['type']=='application/octet-stream'||$data['type']=='application/vnd.ms-excel'){
		if(preg_match('/^[0-9A-Za-zaeiouñÑaeiouÜü_ \-]+\.csv$/', $data['name'])){
			//Checar el header para ver si se reconoce alguno
			if (($gestor = fopen($data['tmp_name'], "r")) !== FALSE) {
			//if (($gestor = fopen($_SERVER['DOCUMENT_ROOT']."pacientestemp.csv", "r")) !== FALSE) {

				$header = fgetcsv($gestor, 1000, ",");
				$respuesta['nope'] = array();
				$checkforName = "";
				foreach($headers as $h => $v){
					if(compareHeaders($v, $header)){
						$checkforName = $h;
						unset($respuesta['nope']);
						break;
					}else{
						$respuesta['nope'][] = array($header, "!=", $v);
					}
				}
				//var_dump($header);var_dump($respuesta);
				if($checkforName!=""){
					include "../queries/dbcon.php";
					$linea = 2;
					$validator = new Validator();
					$validator->setRules($headers[$checkforName]);
					//Registro de las tuplas que no se deben repetir
					$noRepetir = array();
					$nuevos = array();
					while($header = fgetcsv($gestor, 1000, ",")){
						foreach($header as $k=>$v){
							$header[$k] = utf8_encode($v);
						}
						if(!isEmpty($header)){
							$i = 0;
							$valido = true;
							//Validar que los inputs sean correctos
							foreach($headers[$checkforName] as $k =>$v){
								if(!$validator->validate($k, $header[$i])){
									if(!isset($respuesta['validacion'][$linea])){
										$respuesta['validacion'][$linea] = array();
									}
									$respuesta['validacion'][$linea][] = $k;
									$valido = false;
								}
								$i++;
							}

							if($valido){
								$insertar = true;
								//Validar vs CSV todos los invalids
								foreach($queries[$checkforName]['invalid'] as $invalidName => $query){
									$keys = $query[1];
									$temp = array();
									foreach($keys as $k=>$v){
										$s = array_search($v, array_keys($headers[$checkforName]));
										//var_dump("New"); var_dump($k); var_dump($v); var_dump($s); var_dump($header[$s]);
										$temp[] = $header[$s];
									}
									if(!isset($noRepetir['csv'][$invalidName])){
										$noRepetir['csv'][$invalidName] = array();
									}
									if(in_array($temp, $noRepetir['csv'][$invalidName])){
										if(!isset($respuesta['noRepetir']['csv'][$invalidName][$linea])){
											$respuesta['noRepetir']['csv'][$invalidName][$linea] = array();
										}
										$respuesta['noRepetir']['csv'][$invalidName][$linea][] = $keys;
										$insertar = false;
									}else{
										$noRepetir['csv'][$invalidName][] = $temp;
									}
									//var_dump($noRepetir);
								}
								//Validar vs BD
								//Invalid
								foreach($queries[$checkforName]['invalid'] as $invalidName => $query){
									$arr = array();
									foreach($query[1] as $qk => $qv){
										$s = array_search($qv, array_keys($headers[$checkforName]));
										$arr[] = $header[$s];
									}
									//var_dump($query[0]); var_dump($arr);
									$queryResponse = select_query($con, $query[0], $query[2], $arr);
									if($queryResponse[0]['existe']>0){
										$respuesta['noRepetir']['db'][$invalidName][$linea][] = $query[1];
										$insertar = false;
									}
								}
								//No Existe
								foreach($queries[$checkforName]['noexist'] as $invalidName => $query){
									$arr = array();
									$combText = array();
									foreach($query[1] as $qk => $qv){
										$s = array_search($qv, array_keys($headers[$checkforName]));
										$arr[] = $header[$s];
										$combText[] = $qv.": ".$header[$s];
									}
									//var_dump($query[0]); var_dump($arr);
									$queryResponse = select_query($con, $query[0], $query[2], $arr);
									//var_dump($queryResponse);
									if($queryResponse[0]['existe']==0){
										if($header[$s]!="") {
											$respuesta['noExiste'][$invalidName][$linea][] = $combText;
											$insertar = false;
										}
									}
								}
								//New
								foreach($queries[$checkforName]['new'] as $invalidName => $query){
									$arr = array();
									$combText = "";
									foreach($query[1] as $qk => $qv){
										$s = array_search($qv, array_keys($headers[$checkforName]));
										$arr[] = $header[$s];
										$combText = $header[$s];
									}
									//var_dump($query[0]); var_dump($arr);
									$queryResponse = select_query($con, $query[0], $query[2], $arr);
									if($queryResponse[0]['existe']==0){
										if(!isset($nuevos[$invalidName])){
											$nuevos[$invalidName] = array();
										}

										if(!in_array($combText, $nuevos[$invalidName])){
											$nuevos[$invalidName][] =  $combText;
											$respuesta['new'][$invalidName][$linea] = $combText;
										}
									}
								}
								//Warning
								foreach($queries[$checkforName]['warning'] as $invalidName => $query){
									$arr = array();
									$combText = array();
									foreach($query[1] as $qk => $qv){
										$s = array_search($qv, array_keys($headers[$checkforName]));
										$arr[] = $header[$s];
										$combText[] = $qv.": ".$header[$s];
									}
									//var_dump($query[0]); var_dump($arr);
									$queryResponse = select_query($con, $query[0], $query[2], $arr);
									if($queryResponse[0]['existe']>0){
										$respuesta['warning'][$invalidName][$linea][] = $combText;
									}
								}

								if($insertar){
									$newtext = "";
									for($i=1;$i<count($identifier[$checkforName]);$i++){
										$newtext .= $header[array_search($identifier[$checkforName][$i], array_keys($headers[$checkforName]))]." ";
									}
									if(!isset($respuesta['new'][$identifier[$checkforName][0]])){
										$respuesta['new'][$identifier[$checkforName][0]] = array();
									}
									$respuesta['new'][$identifier[$checkforName][0]][$linea] = $newtext;
								}
							}
							$linea++;
						}
					}
					$respuesta['csvName'] = $identifier[$checkforName][0];
					fclose($gestor);
					//Aquí copia el archivo temporal y pasalo a un lado donde sobreviva si todo salió pro
					if(!isset($respuesta['noRepetir']['csv'])&&!isset($respuesta['validacion'])&&!isset($respuesta['noExiste'])){
						/**/
												if(rename($data['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/".$checkforName."temp.csv")){
								$respuesta['fileName'] = $checkforName."temp.csv";
						}else{
							$respuesta['error'] .= "Hubo un problema al mover el archivo.";
							//var_dump($_FILES);
						}
						/**/
					}else{
						$respuesta['fileName'] = "";
					}
				}else{
					$respuesta['error'] = "Las cabeceras del CSV subido no coinciden con ningun set de cabeceras validas.";
				}
			}else{
				$respuesta['error'] = "Ha ocurrido un error al leer el archivo.";
			}
		}else{
			$respuesta['error'] = "El archivo seleccionado no es un archivo CSV";
		}
	}else{
		$respuesta['error'] = "El archivo seleccionado no es un archivo CSV";
	}
	//var_dump($respuesta);
	echo json_encode($respuesta);
    //'type' => string 'application/octet-stream' (length=24)
	//'tmp_name' => string 'C:\wamp\tmp\php9468.tmp' (length=23)
    //'error' => int 0
    //'size' => int 116
?>
