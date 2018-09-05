<?php
	//$_POST['fileName'] = "pacientestemp.csv";
	//$_POST['fileName'] = "materialestemp.csv";
	//$_POST['fileName'] = "serviciostemp.csv";
	//$_POST['fileName'] = "clientestemp.csv";
	//var_dump($_POST);
	$_POST['fileName'] = "alumnostemp.csv";
	if(!isset($_POST['fileName'])&&count($_POST)!=1){
		exit;
	}

	//error_reporting(0);
	include "../validation/classValidator.php";
	$csvStuff = true;
	include "../uploader/csvRules.php";
	function encode_array($arr){
		foreach($arr as $k=>$v){
			if(is_array($v)){
				$arr[$k] = encode_array($v);
			}else{
				$arr[$k] = utf8_encode($v);
			}
		}
		return $arr;
	}


	$respuesta = array();


	if(preg_match('/^[0-9A-Za-zaeiouñÑaeiouÜü_ \-]+\.csv$/', $_POST['fileName'])){
		if (($gestor = fopen($_SERVER['DOCUMENT_ROOT']."/".$_POST['fileName'], "r")) !== FALSE) {
			//Buscar los headers
			$header = fgetcsv($gestor, 1000, ",");
			$checkforName = "";
			foreach($headers as $h => $v){
				//var_dump($h);
				if(compareHeaders($v, $header)){
					$checkforName = $h;
					unset($respuesta['nope']);
					break;
				}else{
					$respuesta['nope'][] = array($header, "!=", $v);
				}
			}
			//Ver si el header es valido
			if($checkforName!=""){
					include "dbcon.php";
					mysqli_autocommit($con, FALSE);
					$linea = 2;
					$validator = new Validator();
					$validator->setRules($headers[$checkforName]);
					//Registro de las tuplas que no se deben repetir
					$noRepetir = array();
					$nuevos = array();
					$categoriaId = array();
				//Filtrar las tuplas
				while($header = fgetcsv($gestor, 1000, ",")){
					//Para evitar problemas con los acentos
					foreach($header as $k=>$v){
						$header[$k] = utf8_encode($v);

					}
					if(!isEmpty($header)){
						//Validar que los inputs sean correctos
						$i = 0;
						$valido = true;
						foreach($headers[$checkforName] as $k =>$v){
							if(!$validator->validate($k, $header[$i])){
								if(!isset($respuesta['validacion'][$linea])){
									$respuesta['validacion'][$linea] = array();
								}
								$respuesta['validacion'][$linea][] = $k;
								$valido = false;
							}
							$header[$i] = ucfirst($header[$i]);
							$i++;
						}
						if($valido){//Los inputs son correctos
							$insertar = true;
								//Validar vs CSV todos los invalids (This should say: Fuck it!)
								foreach($queries[$checkforName]['invalid'] as $invalidName => $query){
									$keys = $query[1];
									$temp = array();
									foreach($keys as $k=>$v){
										$s = array_search($v, array_keys($headers[$checkforName]));
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
								//Validar que existan las dependencias correspondientes de tablas que debieron ser insertadas antes
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
									if($queryResponse[0]['existe']==0){
										if($header[$s]!="") {
											$respuesta['noExiste'][$invalidName][$linea][] = $combText;
											$insertar = false;
									  }
									}
								}
								//Validar si ya existe algo (Invalid) (This should be skipped)
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
								//Buscar id de dependencias de tablas 'categoria' o crear la dependencia si no existe
								foreach($new[$checkforName] as $newName => $tableInfo){
									//var_dump($tableInfo);var_dump($headers);var_dump($checkforName);
									$value = $header[array_search($tableInfo['valueColumn'], array_keys($headers[$checkforName]))];
									if(!isset($nuevos[$tableInfo['valueColumn']][$value])){
										$nuevos[$tableInfo['valueColumn']][$value] = insert_or_select_category($con, $tableInfo, $value);
										/*
										echo "insert_or_select_category ";
										var_dump($tableInfo);
										var_dump($value);
										/**/
									}
									//var_dump($value);var_dump($nuevos);var_dump($tableInfo);
								}
								//exit;
								//var_dump($nuevos);exit;
								if($insertar){
									//var_dump($insert[$checkforName]);var_dump("Headers");var_dump($headers[$checkforName]);var_dump("Nuevos");var_dump($nuevos);var_dump("Header");var_dump($header);var_dump("New");var_dump($new[$checkforName]);
									insert_deep($con, $insert[$checkforName], $header, $headers, $nuevos, $new, $checkforName);
									/*
									echo "insert_deep ";
									var_dump($insert[$checkforName];
									var_dump($header);
									var_dump($headers);
									var_dump($nuevos);
									var_dump($new);
									var_dump($checkforName);
									/**/
								}
						}//End valido
					}
					$linea++;
				}
				//exit;
				if(!isset($respuesta['noRepetir']['csv'])&&!isset($respuesta['noExiste'])){
					mysqli_commit($con);
				}
				fclose($gestor);
				//Se debería borrar el archivo después de todo, no importa que
				//unlink($_SERVER['DOCUMENT_ROOT']."".$_POST['fileName']);
				//echo "Borrando: ".$_SERVER['DOCUMENT_ROOT']."".$_POST['fileName'];

			}else{
				$respuesta['error'] = "Las cabeceras del CSV subido no coinciden con ningun set de cabeceras validas.";
			}
		}else{
			$respuesta['error'] = "Hubo un problema al leer el archivo";
		}
	}else{
		$respuesta['error'] = "El archivo no es un .csv";
	}
	echo json_encode($respuesta);
?>
