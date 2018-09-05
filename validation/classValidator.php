<?php
	$db_origen = "nuvet";	$db_comparar =  "nuvet_diteq";
	//date_default_timezone_set('America/Mexico_City');
	date_default_timezone_set('america/mexico_city');
	class Validator{
		var $exps;
		var $valid;
		var $rules;
		var $echos;
		function Validator(){
			$this->echos = false;

			$this->exps = array();
			$this->exps['date'] = '/^[0-9]{4}\-[0-1][0-9]\-[0-3][0-9]$/';
			$this->exps['datetime'] = '/^[0-9]{4}\-[0-1][0-9]\-[0-3][0-9] [0-2][0-9]\:[0-5][0-9]$/';
			$this->exps['time'] = '/^[0-2][0-9]\:[0-5][0-9]$/';
			$this->exps['alpha'] = '/^[A-Za-záéíóúñÑÁÉÍÓÚÜü ]+$/';
			$this->exps['alphnum'] = '/^[0-9A-Za-záéíóúñÑÁÉÍÓÚÜü ]+$/';
			$this->exps['alphnumper'] = '/^[0-9A-Za-záéíóúñÑÁÉÍÓÚÜü\(\) ]+$/';
			$this->exps['file'] =  '/^[0-9A-Za-záéíóúñÑÁÉÍÓÚÜü]+\.[0-9A-Za-záéíóúñÑÁÉÍÓÚÜü]+$/';
			$this->exps['specs'] = '/^[0-9A-Za-záéíóúñÑÁÉÍÓÚÜü _.,\/\-]+$/';
			$this->exps['pref'] = '/^[A-Za-záéíóúñÑÁÉÍÓÚÜü .]+$/';
			$this->exps['servs'] = '/^[0-9A-Za-záéíóúñÑÁÉÍÓÚÜü _.,\/\-"!=?%()\+]+$/';
			$this->exps['tel'] = '/^[0-9 -]+$/';
			$this->exps['num'] = '/^[0-9]+$/';
			$this->exps['int'] = '/^(\-)?[0-9]+$/';
			$this->exps['dec'] = '/^\-?[0-9]+(\.[0-9]{1,6})?$/';
			$this->exps['decOne'] = '/^\-?[0-9]+(\.[0-9])?$/';
			$this->exps['coin'] = '/^\-?[0-9]+(\.[0-9]{1,2})?$/';
			$this->exps['use'] = '/^[0-9]+$/';
			$this->exps['website'] = '/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/';
			$this->exps['email'] = '/^[A-Za-z0-9._-]+@([A-Za-z0-9-]{2,}\.)+[A-Za-z0-9-]{2,}$/';
			$this->exps['pass'] = '/^[a-zA-Z0-9]{4,12}$/';
			$this->exps['bool'] = '/^(T|t)rue|TRUE|(F|f)alse|FALSE|1|0$/';
			$this->exps['rfc'] = '/^[A-ZÑ]{3,4}[0-9]{2}(0[123456789]|10|11|12)[0-3][0-9][A-ZÑ0-9]{3}$/';
			$this->exps['year'] = '/^[0-9]{4}$/';
			$this->exps['name'] = '/^[0-9A-Za-záéíóúñÑÁÉÍÓÚÜü. ]+$/';
			$this->valid = true;
		}

		function enableEchos(){
			$this->echos = true;
		}
		function isValid(){
			return $this->valid;
		}

		function isValidEcho(){
			if(!$this->valid){
				dnv();
			}
			return $this->valid;
		}

		function setRulesValidateArrayEcho($r, $a){
			$this->setRulesValidateArray($r, $a);
			if(!$this->valid){
				dnv();exit;
			}
		}

		function setRulesValidateArray($r, $a){
			$this->setRules($r);
			$this->validateArray($a);
		}

		function setRules($r){
			$this->rules = $r;
		}
		function showArrayKeys(&$arr){
			echo "(KEYS ";
			foreach ($arr as $k=>$v){
				echo "[".$k."] ";
			}
			echo ") ";
		}

		function showArrayKeyValues(&$arr){
			echo "(KEY, VAL ";
			foreach ($arr as $k=>$v){
				echo "[".$k." , ".$v."] ";
			}
			echo ") ";
		}

		function validateArray(&$arr){
			if(count($arr)!=count($this->rules)){
				if($this->echos){
					echo "Validator Error: Rules doesn't match the array.";
				}
				$this->valid = false;
			}

			foreach($this->rules as $k=>$v){
				if($this->isValid()){
					if(isset($arr[$k])){
						$this->validate($k, $arr[$k]);
						if(isset($this->rules[$k])){
							if($this->rules[$k]['t']=="bool"){
								if($arr[$k]=="true"){
									$arr[$k] = 1;
								}else if($arr[$k]=="false"){
									$arr[$k] = 0;
								}
							}
						}
					}else{
						if($v['r']){
							if($this->echos){
								echo "Validator Error: Rule was set for: ".$k." but is not in the array.";
							}
							$this->valid = false;
						}else{
							$arr[$k] = "";
						}
					}
				}
			}
		}

		function validateArrayShow($arr){
			foreach($arr as $k=>$v){
				if($this->isValid()){
					echo "[".$k." | ".$v."] ";
					$this->validate($k, $v);
				}
			}
		}

		function validate($name, $value){
			if(isset($this->rules[$name])){
				if(count($this->rules[$name])==0){
					if($this->echos){
						echo "Validator Error: No rules on: ".$name.".";
					}
					$this->valid = false;
					return false;
				}else{
					$rules = $this->rules[$name];
				}
			}else{
				if($this->echos){
					echo "Validator Error: No rules set on: ".$name.".";
				}
				$this->valid = false;
				return false;
			}


			$data = $value;

			$isNumber = false;

			if($rules['t']=='num'||$rules['t']=='dec'){
					$isNumber = true;
			}

			if($rules["r"]){ //Es requerido
				if($data==""||($data=="0"&&!$isNumber&&!$rules['t']=='bool')){
					if($this->echos){
						echo "Validator message: Validation failed on ".$name.", it is required, value = ".$data.".";
					}
					$this->valid = false;
					return false;
				}
			}else{//No es requerido
				if($data==""||($data=="0"&&!$isNumber)){//Está vacio
					return true;
				}
			}

			if(isset($this->exps[$rules['t']])){//La expresion existe
				if(preg_match($this->exps[$rules['t']], $data)){//La expresion hace match
					return true;
				}else{//La expresion no hace match
					if($this->echos){
						echo "Validator message: Validation failed on ".$name.", not matched with ".$rules["t"].", value = ".$data.".";
					}
					$this->valid = false;
					return false;
				}
			}else{//La expresion no existe
				if($this->echos){
					echo "Validator Error: ".$rules["t"]." invalid expression type on ".$name.".";
				}
				$this->valid = false;
				return false;
			}
		}
	};
	//SESION
	/*
	if(!isset($login)){
		if(!isset($_SESSION)){
	        session_start();
	    }

		if(isset($_SESSION['idUsuario'])&&isset($_SESSION['username'])&&$_SESSION['timeout'] + 16 * 60 >= time()){
	        $_SESSION['timeout'] = time();
		}else{
			session_destroy();
			echo 'e|Sesion|Ha expirado su sesion, por favor ingrese de nuevo al sistema.';
			exit;
		}
	}
	*/
	function vde(){
		var_dump($_POST);exit;
	}

	//recordar hacer que aquellos campos no requeridos y vacios/nulos se les asigne un string vacio/0 automaticamente
	function select_query_one($con, $query, $paramText = "", $paramsArray = array()){
		$respuesta = select_query($con, $query, $paramText, $paramsArray);
		if(isset($respuesta[0])){
			return $respuesta[0];
		}else{
			return false;
		}
	}

	function sanit($string) {
		return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
	}

	function select_query($con, $query, $paramText = "", $paramsArray = array()){
		$stmt = mysqli_prepare($con, $query) or die ("FALLO STMT: ".mysqli_error($con)." ".$query);
		$err = false;
		if(!is_string($query)) {
			$err = true;
			echo "El parametro 2: \$query no es un string. ";
			var_dump($query);
		}
		if(!is_string($paramText)) {
			$err = true;
			echo "El parametro 3: \$paramText no es un string.";
			var_dump($paramText);
		}
		if(!is_array($paramsArray)) {
			$err = true;
			echo "El parametro 4: \$paramsArray no es un array.";
			var_dump($paramsArray);
		}
		if($err) { exit; }
		if(count($paramsArray)>0){
			$params = array($paramText);
		}
		if($paramsArray==$_POST){
			foreach($paramsArray as $k=>$v){
				$params[] = &$_POST[$k];
			}
		}else{
			foreach($paramsArray as $k=>$v){
				$params[] = &$paramsArray[$k];
			}
		}
		if(count($paramsArray)>0){
			call_user_func_array(array($stmt, 'bind_param'), $params);
		}
		if(mysqli_stmt_execute($stmt)){
			$data = array();
			$result = mysqli_stmt_get_result($stmt);
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ $data[] = $row; }
			return $data;
		}else{
			echo "FALLO EXECUTE: ".$query." ".mysqli_error($con); exit;
		}
	}

	function json_echo($data){
		header("Content-type: application/json;charset=utf8");
		echo json_encode($data);
	}

	function cap_all($arr){
		foreach($arr AS $key => $value){
			foreach($value AS $kk => $vv){
				$arr[$key][$kk] = ucwords(strtolower($vv));
			}
		}
		return $arr;
	}

	function upper_all($arr){
		foreach($arr AS $key => $value){
			foreach($value AS $kk => $vv){
				$arr[$key][$kk] = strtoupper(strtolower($vv));
			}
		}
		return $arr;
	}

	function insert_query($con, $query, $paramText, $paramsArray, $commit = true){
		mysqli_autocommit($con, false);
		$params = array();
		$stmt = mysqli_prepare($con, $query) or die ("FALLO STMT: ".mysqli_error($con)." ".$query);
		if(count($paramsArray)==0){
			var_dump($query);
			die ('FALLO PARAM: El arreglo de parametros está vacío.');
		}

		if(isset($paramsArray[0])){
			if(is_array($paramsArray[0])){
				foreach($paramsArray as $k=>$v){
					$params[$k] = array($paramText);
					foreach($v AS $kk => $vv){
						$params[$k][] = &$paramsArray[$k][$kk];
					}
				}
			}
		}else {
			$params[0] = array($paramText);
			foreach($paramsArray as $k=>$v){
				$params[0][] = &$paramsArray[$k];
			}
		}

		//var_dump($params);exit;
		$continuar = true;
		for($i=0;$i<count($params);$i++){
			call_user_func_array(array($stmt, 'bind_param'), $params[$i]);
			if(!mysqli_stmt_execute($stmt)){
				echo "FALLO EXECUTE INSERT QUERY: ".mysqli_error($con);
				$continuar = false;
				var_dump($params[$i]);
				echo 'FIN FALLO EXECUTE <br>';
			}
			//var_dump($params[$i]);
		}
		if($continuar){
			if($commit){
				mysqli_commit($con);
			}
			return true;
		}
		return false;
		//var_dump($params);
	}

	function insert_id_direccion_vacia($con){
			$smt = mysqli_prepare($con, "INSERT INTO direccion (idDireccion, calle, numExterior, numInterior, cp, idColonia) VALUES (NULL, '', '', '', NULL, NULL)");
			mysqli_stmt_execute($smt) or die ("insert_id_direccion_vacia ".mysqli_error($con));
			return mysqli_insert_id($con);
	}

	function insert_id_query($con, $query, $paramText, $paramsArray){
		mysqli_autocommit($con, false);
		$params = array();
		$stmt = mysqli_prepare($con, $query) or die ("FALLO STMT: ".mysqli_error($con)." ".$query);
		if(count($paramsArray)==0){
			var_dump($query);
			die ('FALLO PARAM: El arreglo de parametros está vacío.');
		}

		if(!isset($paramsArray[0])){
			//echo "No recuerdo para que es esto.";
			if(is_array($paramsArray[0])){
				foreach($paramsArray as $k=>$v){
					$params[$k] = array($paramText);
					foreach($v AS $kk => $vv){
						$params[$k][] = &$paramsArray[$k][$kk];
					}
				}
			}
		}else {
			$params[0] = array($paramText);
			foreach($paramsArray as $k=>$v){
				$params[0][] = &$paramsArray[$k];
			}
		}

		//var_dump($params);exit;
		$continuar = true;
		//var_dump($query);
		//var_dump($params);
		for($i=0;$i<count($params);$i++){
			if(!call_user_func_array(array($stmt, 'bind_param'), $params[$i])){
				echo mysqli_error($con).'!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!';
			}
			if(!mysqli_stmt_execute($stmt)){
				echo "FALLO EXECUTE INSERT ID QUERY: ".mysqli_error($con);
				$continuar = false;
				var_dump($params[$i]);
				echo 'FIN FALLO EXECUTE <br>';exit;
			}
			//var_dump($params[$i]);
		}
		if($continuar){
			return mysqli_insert_id($con);
		}
		return false;
		//var_dump($params);
	}

	function unshift_all($arr, $otherArr){
		foreach($arr as $k => $v){
			$arr[$k] = $otherArr+$arr[$k];
		}
		return $arr;
	}

	function execute_query($con, $query, $paramText = "", $paramsArray = array(), $commit = true){
		mysqli_autocommit($con, FALSE);
		if(false){
			/*
			echo "DEBUGGING execute_query:<br>";
			echo "QUERY: <br>";
			var_dump($query);
			echo "paramText: <br>";
			var_dump($paramText);
			echo "PARAMS ARRAY: <br>";
			var_dump($paramsArray);
			echo "COMMIT: <br>";
			var_dump($commit);
			/**/
		}

		$stmt = mysqli_prepare($con, $query) or die ("FALLO STMT: ".mysqli_error($con)." ".$query);
		if(count($paramsArray)>0){
			$params = array($paramText);
		}
		if($paramsArray==$_POST){
			foreach($paramsArray as $k=>$v){
				$params[] = &$_POST[$k];
			}
		}else{
			foreach($paramsArray as $k=>$v){
				$params[] = &$paramsArray[$k];
			}
		}
		if(count($paramsArray)>0){
			//var_dump($params);
			call_user_func_array(array($stmt, 'bind_param'), $params);
		}
		if(mysqli_stmt_execute($stmt)){
			if($commit){
				mysqli_commit($con);
			}else{
				//echo "No se hizo commit";
			}
			return true;
		}else{
			//var_dump($query); var_dump($paramText); var_dump($paramsArray);
			echo "FALLO EXECUTE: ".mysqli_error($con);
			return false;
		}
	}
	function dnv(){
		echo "e|Datos|Datos invalidos. ";
		echo $_SERVER['PHP_SELF'];
	}

	function makeAnswerArray($answer){
		$arr = array();
		for($i=0;$i<count($answer);$i++){
			$n=0;
			foreach($answer[$i] as $k=>$v){
				if($n==0){
					$arr[] = $v;
				}
				$n++;
			}
		}
		return $arr;
	}

	function makeConfArray($con){
		$arr = select_query($con, "SELECT * FROM ajustes");
		$conf = array();
		foreach($arr as $k=>$v){
			$conf[$v['opcion']] = $v['valor'];
		}
		return $conf;
	}

	function format_respuesta_select($respuesta, $toSubtext = ""){
		foreach($respuesta as $k=>$v){
			foreach($v as $kk =>$vv){
				if($kk!="id"&&$kk!='value'){
					if($kk==$toSubtext||$kk=="subtext"){
						$respuesta[$k]["data-subtext"] = $vv;
					}
					$respuesta[$k]["data-".$kk] = $vv;
					unset($respuesta[$k][$kk]);
				}
			}
		}
		return $respuesta;
	}

	function reorder_array_keys($source, $inputs){
		$arr = array();
		for($i = 0;$i<count($inputs);$i++){
			if(isset($source[$inputs[$i]])){
				if($source[$inputs[$i]]=="true"){
					$source[$inputs[$i]] = 1;
				}else if($source[$inputs[$i]]=="false"){
					$source[$inputs[$i]] = 0;
				}
				$arr[$inputs[$i]] = $source[$inputs[$i]];
			}
		}
		return $arr;
	}

	function reorder_array($source, $inputs){
		$arr = array();
		for($i = 0;$i<count($inputs);$i++){
			if(isset($source[$inputs[$i]])){
				if($source[$inputs[$i]]=="true"){
					$source[$inputs[$i]] = 1;
				}else if($source[$inputs[$i]]=="false"){
					$source[$inputs[$i]] = 0;
				}
				$arr[] = $source[$inputs[$i]];
			}
		}
		return $arr;
	}

	function direccion_rules($arr, $end){
		$arr["street"] = 					['r' => false,  't' => "alphnum"];
		$arr["numExt"] = 					['r' => false, 	't' => "alphnum"];
		$arr["numInt"] = 					['r' => false,  't' => "alphnum"];
		$arr["postalcode".$end] = 		['r' => false, 	't' => "alphnum"];
		$arr["area".$end] =				['r' => false, 	't' => "alphnum"];
		return $arr;
	}

	function insert_direccion($con, $arr){
		$paramString = 'sss';
		$paramArr = array('street', 'numExt', 'numInt');
		$paramColumns = 'calle, numExterior, numInterior';
		$paramQuest = '?,?,?';

		if($arr['postalcodeSum']!=""){
			$paramArr[] = 'postalcodeSum';
			$paramColumns.= ", cp";
			$paramQuest.= ",?";
			$paramString.="i";
		}

		if($arr['areaSum']!=""&&$arr['areaSum']!="Colonia"){
			$paramArr[] = 'areaSum';
			$paramColumns.= ", idColonia";
			$paramQuest.= ",?";
			$paramString.="i";
		}
		return insert_id_query($con, "INSERT INTO direccion (".$paramColumns.") VALUES (".$paramQuest.")", $paramString, reorder_array($arr, $paramArr));
	}

	function setDireccionRules($arr, $finish){
		$arr["street"] = 				['r' => false,  't' => "alphnum"];
		$arr["numExt"] = 				['r' => false, 	't' => "alphnum"];
		$arr["numInt"] = 				['r' => false,  't' => "alphnum"];
		$arr["postalcode".$finish] = 		['r' => false, 	't' => "alphnum"];
		$arr["area".$finish] =				['r' => false, 	't' => "alphnum"];
		return $arr;
	}

	function lista_empalme_horario($horarioA, $horarioB){
		$empalmes = array();
		foreach($horarioA as $k=>$v){
			if(empalme_horario([$v], $horarioB)){
				$empalmes[] = $v;
			}
		}
		return $empalmes;
	}

	function empalme_horario($horarioA, $horarioB){
		foreach($horarioA as $k=>$v){
			$diaA = 		$v['dia'];
			$horaInicioA = 	$v['horaInicio'];
			$horaFinalA = 	$horaInicioA+$v['duracion'];
			foreach($horarioB as $kk=>$vv){
				$diaB = $vv['dia'];
				$horaInicioB = $vv['horaInicio'];
				$horaFinalB = $horaInicioB+$vv['duracion'];
				if($diaA==$diaB){//Mismo día

					if($horaInicioA<=$horaInicioB&&$horaFinalA>$horaInicioB){
						return true;
					}

					if($horaInicioA<$horaFinalB&&$horaFinalA>=$horaFinalB){
						return true;
					}

					if($horaInicioA<=$horaInicioB&&$horaFinalA>=$horaFinalB){
						return true;
					}

					if($horaInicioA>=$horaInicioB&&$horaFinalA<=$horaInicioB){
						return true;
					}
				}
			}
		}
		return false;
	}

	function calcular_meses($fechaInicial, $fechaFinal){
		$start    = new DateTime($fechaInicial);
		$start->modify('first day of this month');
		$end      = new DateTime($fechaFinal);
		$end->modify('first day of next month');
		$interval = DateInterval::createFromDateString('1 month');
		$period   = new DatePeriod($start, $interval, $end);
		$months = Array();
		foreach ($period as $dt) {
			$months[] = $dt->format("Y-m");
		}
		return $months;
	}
	function formatNumberToTime($number){
		if(floor($number)!=$number){
			list($hours, $wrongMinutes) = explode('.', $number);
			$minutes = ($wrongMinutes < 10 ? $wrongMinutes * 10 : $wrongMinutes) * 0.6;
			return $hours . ':' . $minutes;
		}else{
			return $number.':00';
		}
	}

	function setPrecioHora($row, $calc){
		if(isset($row['precio'])&&isset($row['horas'])){
			switch($calc){
					case 'Por Mes Fijo':
						return $row['precio'];
					break;
					case 'Por Cada Grupo y Costo Por Hora':
						return 4*$row['precio']*($row['horas']/2);
					break;
					case 'Por Horas Totales':
						$row['horas'] = $row['horas']/2;
						$whole = floor($row['horas']);
						$fraction = $row['horas'] - $whole;
						if($fraction==0){
							$whole = $whole.":00";
						}else{
							$whole = $whole.":30";
						}
						return $whole;
					break;
					default:
						return 0;
					break;
			}
		}else{
			echo "Resultado";
			var_dump($row);
			echo "Tipo de calculo";
			var_dump($calc);
			echo "No existe [precio] y/u [horas] en los resultados.";exit;
		}
	}
	function format_respuesta_checkbox($respuesta){
		$arr = array();
		//var_dump($respuesta);
		foreach($respuesta as $k=>$v){
			foreach($v as $kk=>$vv){
				$arr[] = $vv;
			}
		}
		return $arr;
	}


	function getDebuggingInfo($echo = false, $delete = false){
			if(!isset($_SESSION)){
				session_start();
			}
			if(!isset($_SESSION['post'])){
				$_SESSION['post'] = $_POST;
				echo "e|Modo Debug|Modo debug empezado.";exit;
			}else{
				$_POST = $_SESSION['post'];
			}
			if($delete){
				deleteDebuggingInfo();
			}
			if($echo){
				var_dump($_SESSION['post']);
			}
	}

	function deleteDebuggingInfo(){
		if(!isset($_SESSION)){
			session_start();
		}
		if(isset($_SESSION['post'])){
			unset($_SESSION['post']); echo "e|Session borrada|S_SESSION['post'] borrado.";exit;
		}
	}

	function getWeekDayMonday($mysql_date_string){
		$day = date('w', strtotime($mysql_date_string)) - 1;
		return $day==-1?6:$day;
	}





	function compareDatabases($original, $compare){
		$data[$original] = getDatabaseDefs($original);
		$data[$compare] = getDatabaseDefs($compare);

		$tables = [];
		$con = mysqli_connect('localhost', 'root', 'polloman', $original);
				/*
						'Field' => string 'opcion' (length=6), 'Type' => string 'varchar(30)' (length=11), 'Null' => string 'NO' (length=2)
           'Key' => string 'PRI' (length=3), 'Default' => null, 'Extra' => string '' (length=0)
					/**/

		foreach($data[$original]['tables'] as $k=>$table){ //Data Original
			$tables[$table['name']]['existe'] = false;
			foreach($data[$compare]['tables'] as $kk=>$tableCompare){ //Data Compare
					if($table['name']==$tableCompare['name']){	//EXISTE EN LAS DOS
						$tables[$table['name']]['existe'] = true;
						foreach($table['data'] as $tk =>$tableData){ //Comparación de columnas (Original)
							$columnFromTableExistsInCompare = false;
							$tables[$table['name']]['columns'][$tableData['Field']] = []; //Lista de columnas
							foreach($tableCompare['data'] as $tck=>$tableCompareData){ //Comparación de columnas (Compare)
								if(!isset($tableCompare['data'][$tck]['existInOriginal'])){
									$tableCompare['data'][$tck]['existInOriginal'] = false;
								}
								if($tableData['Field']==$tableCompareData['Field']){ //Ambas tienen la misma columna
									$tableCompare['data'][$tck]['existInOriginal'] = true;
									$columnFromTableExistsInCompare = true;
									// Field
									if($tableData['Key']==='MUL'){
										$tableData['Key'] = '';
									}
									if($tableCompareData['Key']==='MUL'){
										$tableCompareData['Key'] = '';
									}

									if(	$tableData['Type']==$tableCompareData['Type']&&
											$tableData['Null']==$tableCompareData['Null']&&
											$tableData['Key']==$tableCompareData['Key']&&
											$tableData['Default']==$tableCompareData['Default']&&
											$tableData['Extra']==$tableCompareData['Extra']
										){ //Los datos importantes son iguales
											$tables[$table['name']]['columns'][$tableData['Field']]['modifyScript'] = false;
											//ALTER TABLE `ajustes` CHANGE `valor` `valor` VARCHAR(30) NOT NULL;	//ALTER TABLE `ajustes` CHANGE `valor` `valor` VARCHAR(30) NOT NULL;
											//ALTER TABLE `ajustes` CHANGE `valor` `valor` VARCHAR(30) NOT NULL DEFAULT 'pollo';	//ALTER TABLE `ajustes` CHANGE `valor` `valor` VARCHAR(30) NULL DEFAULT NULL;
											//ALTER TABLE `ajustes` CHANGE `valor` `valor` VARCHAR(30) NULL DEFAULT 'pollo';	//ALTER TABLE `ajustes` ADD `pollo` 					 INT NULL DEFAULT NULL
											//ALTER TABLE `ajustes` ADD `vamosaborraresta` INT NOT NULL AFTER `valor`;	//ALTER TABLE `ajustes` DROP `vamosaborraresta`;
									}else{ //Los datos importantes no son iguales
										//Creamos la sentencia
										if($table['name']=='config'&&$tableData['Field']=="descripcion"){
											/**/
										}
										$tables[$table['name']]['columns'][$tableData['Field']]['modifyScript'] = "ALTER TABLE `".$table['name']."` CHANGE `".$tableData['Field']."` ";
									}//Fin comparación datos importantes
									break; //Siguiente columna
								} //Fin ambas tienen misma columna

								if(!$tableCompare['data'][$tck]['existInOriginal']){

								}
							} //Fin foreach Columnas Compare
							if(!$columnFromTableExistsInCompare){
								$tables[$table['name']]['columns'][$tableData['Field']]['modifyScript'] = "ALTER TABLE `".$table['name']."` ADD ";
							}

							if($tables[$table['name']]['columns'][$tableData['Field']]['modifyScript']!==false){ //SI es ADD o CHANGE
								//var_dump($tableData);exit;
								$temp = "`".$tableData['Field']."` ".$tableData['Type']." ";
								if($tableData['Null']=="YES"){
										$temp .= "NULL ";
											$temp .= "DEFAULT NULL";
											if($tableData['Default']===null){
										}else{
											$temp .= "DEFAULT '".utf8_encode($tableData['Default'])."'";
										}
								}else{
										$temp .= "NOT NULL ";
										if($tableData['Default']!==null){
											$temp .= "DEFAULT '".utf8_encode($tableData['Default'])."'";
										}
								}
								$tables[$table['name']]['columns'][$tableData['Field']]['modifyScript'] .= $temp;
							}
							$table['data'][$tk]['existsInBoth'] = $columnFromTableExistsInCompare;
						} //Fin foreach Columnas Original
						foreach($tableCompare['data'] as $tck=>$tableCompareData){//Checamos si existe o no para droppear la columna en caso de ser necesario
							if(!isset($tableCompareData['existInOriginal'])){
								$tableCompareData['existInOriginal'] = false;
							}
							if(!$tableCompareData['existInOriginal']){
								$tables[$table['name']]['columns'][$tableCompareData['Field']]['modifyScript'] = 'ALTER TABLE `'.$table['name'].'` DROP `'.$tableCompareData['Field'].'`;';
							}
						}
					}//FIN EXISTE EN LAS DOS
			} //FIN foreach data compare

			if(!$tables[$table['name']]['existe']){//NO EXISTE EN LA SEGUNDA, sacar definición de tabla de original
				$temp = select_query($con, "SHOW CREATE TABLE ".$table['name']);
				$tables[$table['name']]['existe'] = false;
				$tables[$table['name']]['create'] = "DROP TABLE IF EXISTS ".$table['name']."; ".$temp[0]['Create Table'].";";
				//
				if(strpos($tables[$table['name']]['create'], 'AUTO_INCREMENT')!==false){
						$tables[$table['name']]['create'] .= " ALTER TABLE ".$table['name']." AUTO_INCREMENT = 1;";
				}
			}
		}//FIN foreach data original

		return $tables;
	}



	function getDatabaseDefs ($database){
			$con = mysqli_connect('localhost', 'root', 'polloman', $database);
			mysqli_set_charset ($con, "utf8");
			$data = select_query($con, "SHOW TABLES");
			$tables = [];	$views = [];	$undf = [];
			foreach($data as $k=>$v){
				//var_dump($v);
				$data[$k]['table_definition'] = select_query($con, 'SHOW CREATE TABLE '.$v['Tables_in_'.$database]);
				if(isset($data[$k]['table_definition'][0]['Table'])){
						$tables[]['name'] = $data[$k]['Tables_in_'.$database];
				}else if(isset($data[$k]['table_definition'][0]['View'])){
					  $views[]['name'] = $data[$k]['Tables_in_'.$database];
				}else{
					$undf[]['name'] = $data[$k]['Tables_in_'.$database];
				}
			}

			foreach($tables as $k=>$table){
				$tables[$k]['data'] = select_query($con, 'SHOW COLUMNS FROM '.$table['name'].' FROM '.$database);
				/*
				$tables[$k]['data'] = select_query($con, 'SELECT column_name,ordinal_position,data_type,column_type,COLUMN_DEFAULT, IS_NULLABLE FROM (
							SELECT column_name,ordinal_position, data_type,column_type, COLUMN_DEFAULT, IS_NULLABLE,COUNT(1) rowcount
							FROM information_schema.columns
							WHERE((table_schema="'.$database.'" AND table_name="'.$table['name'].'"))
							GROUP BY column_name,ordinal_position, data_type,column_type HAVING COUNT(1)=1) A ORDER BY ordinal_position ASC;');
				/**/
			}

			foreach($views as $k=>$view){
				$temp = select_query($con, 'SHOW CREATE VIEW '.$view['name']);
				$temp = $temp[0]['Create View'];
				$temp = str_replace('CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER ', 'CREATE ', $temp);
				$temp = str_replace('CREATE ALGORITHM=UNDEFINED DEFINER=`vragnuvser`@`localhost` SQL SECURITY DEFINER ', 'CREATE ', $temp);
				$views[$k]['data'] = $temp;
			}
			mysqli_close($con);
			return ['tables'=>$tables, 'views'=>$views, 'undefined'=>$undf];
	}
	function getTableData($con, $table){
    $data = select_query($con, "SELECT * FROM ".$table);
		foreach($data as $k=>$v){
			foreach($v as $key=>$value){
				$data[$k][$key] = utf8_encode($value);
			}
		}
    $primary = select_query($con, "SHOW KEYS FROM ".$table." WHERE Key_name = 'PRIMARY'");
    if(count($primary)>0){
      $primary = $primary[0]['Column_name'];
    }else{
      $primary = "";
    }
    return ['primary'=>$primary, 'data'=>$data];
  }
?>
