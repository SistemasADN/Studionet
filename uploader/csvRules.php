<?php
	if(!isset($csvStuff)){
		exit;
	}

	$headers = array();
	$queries = array();
	$identifier = array();
			//CLIENTES
			//Reglas y headers
			//Persona
			$headers['clientes']["Prefijo"] = 							['r' => false , 't' => "pref"];
			$headers['clientes']["Nombre"] = 								['r' => true , 	't' => "name"];
			$headers['clientes']["Apellido Paterno"] = 			['r' => true , 	't' => "name"];
			$headers['clientes']["Apellido Materno"] = 			['r' => false, 	't' => "name"];
			$headers['clientes']["Sexo"] = 									['r' => true, 	't' => "alpha"];
			$headers['clientes']["Fecha Nacimiento"] = 			['r' => true, 	't' => "date"];


			$headers['clientes']["Correo Electronico"] =		['r' => true , 	't' => "email"];

			$headers['clientes']["Telefono Celular"] =			['r' => true , 	't' => "tel"];
			$headers['clientes']["Telefono Casa"] =					['r' => false, 	't' => "tel"];
			$headers['clientes']["Telefono Oficina"] =			['r' => false, 	't' => "tel"];
			$headers['clientes']["Telefono Otro"] =					['r' => false, 	't' => "tel"];

			$headers['clientes']["RFC"] =										['r' => false, 	't' => "alphnum"];

			$headers['clientes']["Calle"] = 								['r' => false,  't' => "alphnum"];
			$headers['clientes']["Numero Exterior"] = 			['r' => false, 	't' => "alphnum"];
			$headers['clientes']["Numero Interior"] = 			['r' => false,  't' => "alphnum"];
			$headers['clientes']["Codigo Postal"] =	 				['r' => false, 	't' => "alphnum"];
			$headers['clientes']["Colonia"] =								['r' => false, 	't' => "alphnum"];

			$headers['clientes']["Sede"] =								['r' => true, 	't' => "alphnum"];

			$insert['clientes'] = array(//INSERT CLIENTE
				'query' => "INSERT INTO clientes (idPersona, idFacturacion, idPrefijo, idContacto, idSede, pollito) VALUES (?,?,?,?,?, 'pwd')",
				'values' => array(
					array( //INSERT PERSONA
						'query' => "INSERT INTO personas (nombre, apellidoPaterno, apellidoMaterno, idGenero, fechaNacimiento) VALUES (?,?,?,?,?)",
						'values' => array('Nombre', 'Apellido Paterno', 'Apellido Materno',
						array(//SELECT GENERO
							'query' => "SELECT idGenero FROM generos WHERE genero = ?",
							'values' => array('Sexo'),
							'types' => "s"
						), 'Fecha Nacimiento'),
						'types'=>'sssis',
					),
						array( //INSERT FACTURACION
							'query' => "INSERT INTO facturacion (RFC, idDireccion) VALUES (?,?)",
							'values' => array('RFC',
							array(//INSERT DIRECCION
								'query' => "INSERT INTO direccion (calle, numExterior, numInterior, CP, idColonia) VALUES(?,?,?,?,?)",
								'values' => array("Calle", "Numero Exterior", "Numero Interior", "Codigo Postal",
								array(//SELECT COLONIA
									'query' => "SELECT idColonia FROM direccion_colonia WHERE colonia = ? AND cp = ?",
									'values' => array('Colonia', 'Codigo Postal'),
									'types' => "ss"
								)),
								'types' => "ssssi"
							)),
							'types' => 'si'
						),
						array( //SELECT PREFIJO
							'query' => "SELECT idPrefijo FROM prefijos WHERE prefijo = ?",
							'values' => array('Prefijo'),
							'types' => "s"
						),
						array( //INSERT CONTACTO
							'query' => "INSERT INTO contacto (email, telCelular, telCasa, telOficina, telOtro) VALUES (?,?,?,?,?)",
							'values' => array('Correo Electronico', 'Telefono Celular', 'Telefono Casa', 'Telefono Oficina', 'Telefono Otro'),
							'types' => 'sssss'
						),
						array( //SELECT SEDE
							'query' => "SELECT idSede FROM sedes WHERE nombreSede = ?",
							'values' => array('Sede'),
							'types' => "s"
						),
			),
			'types' =>'iiiii'
			);


			$identifier['clientes'] = array("Clientes", "Nombre", "Apellido Paterno", "Apellido Materno");
			//Queries
			//SELECT COUNT(u.idUsuario) FROM cliente as c LEFT JOIN usuario as u ON u.idUsuario = c.idUsuario WHERE u.nombre = ? AND u.apellidoPaterno = ? AND u.apellidoMaterno = ?	Params: nombre, Apellido Paterno, Apellido Materno	Warning
			//Ya existe un cliente con ese nombre (Sacar Aviso)
			$queries['clientes']['warning']['Clientes'] = array(
				"SELECT COUNT(u.idPersona) as existe FROM clientes as c LEFT JOIN personas
				 as u ON u.idPersona = c.idPersona WHERE u.nombre = ? AND u.apellidoPaterno = ? AND u.apellidoMaterno = ?",
				array('Nombre', 'Apellido Paterno', 'Apellido Materno'),
				'sss'
			);
			//SELECT COUNT(u.idUsuario) FROM cliente as c LEFT JOIN usuario as u ON u.idUsuario = c.idUsuario WHERE u.email = ?	Invalid	Params: Correo Electronico
			//Ya existe un cliente con ese correo (Marcar Invalido)
			$queries['clientes']['invalid']['Clientes'] = array(
				"SELECT COUNT(u.idContacto)
				 as existe FROM clientes as c LEFT JOIN contacto as u ON u.idContacto = c.idContacto
				 WHERE u.email = ?",
				array('Correo Electronico'),
				's'
			);
			//Se creara algo nuevo
			$queries['clientes']['new'] = array();

			$queries['clientes']['noexist'] = array();
			//No existe esa sede
			$queries['clientes']['noexist']['Sede'] = array(
				"SELECT COUNT(idSede) as existe FROM sedes WHERE nombreSede = ?",
				array('Sede'),
				's'
			);
			//No existe esa colonia y código postal
			$queries['clientes']['noexist']['Colonia'] = array(
				"SELECT COUNT(idColonia) as existe FROM direccion_colonia WHERE colonia = ? AND cp = ?",
				array('Colonia', 'Codigo Postal'),
				'ss'
			);
			//No existe ese prefijo
			$queries['clientes']['noexist']['Prefijo'] = array(
				"SELECT COUNT(idPrefijo) as existe FROM prefijos WHERE prefijo = ?",
				array('Prefijo'),
				's'
			);
			//No existe ese sexo
			$queries['clientes']['noexist']['Sexo'] = array(
				"SELECT COUNT(idGenero) as existe FROM generos WHERE genero = ?",
				array('Sexo'),
				's'
			);



			//ALUMNOS
			//Reglas y headers
			//Persona
			$headers['alumnos']["Nombre"] = 								['r' => true , 	't' => "name"];
			$headers['alumnos']["Apellido Paterno"] = 			['r' => true , 	't' => "name"];
			$headers['alumnos']["Apellido Materno"] = 			['r' => false, 	't' => "name"];
			$headers['alumnos']["Sexo"] = 									['r' => true, 	't' => "alpha"];
			$headers['alumnos']["Fecha Nacimiento"] = 			['r' => true, 	't' => "date"];

			$headers['alumnos']["Alergias"] =								['r' => false , 	't' => "alphnum"];
			$headers['alumnos']["Enfermedades"] =								['r' => false , 	't' => "alphnum"];
			$headers['alumnos']["Medicamentos"] =								['r' => false , 	't' => "alphnum"];

			$headers['alumnos']["Correo Electronico"] =					['r' => false , 	't' => "alphnum"];
			$headers['alumnos']["Nombre Contacto 1"] =					['r' => false , 	't' => "alphnum"];
			$headers['alumnos']["Tel Contacto 1"] =							['r' => false , 	't' => "tel"];
			$headers['alumnos']["Nombre Contacto 2"] =					['r' => false , 	't' => "alphnum"];
			$headers['alumnos']["Tel Contacto 2"] =							['r' => false , 	't' => "tel"];

			$headers['alumnos']["Nombre Tutor"] = 								['r' => true , 	't' => "name"];
			$headers['alumnos']["Apellido Paterno Tutor"] = 			['r' => true , 	't' => "name"];
			$headers['alumnos']["Apellido Materno Tutor"] = 			['r' => false, 	't' => "name"];

			$headers['alumnos']["Colegio"] = 											['r' => false,  't' => "alphnum"];
			$headers['alumnos']["Grado"] = 												['r' => false, 	't' => "alphnum"];

			$headers['alumnos']["Sede"] =												['r' => true, 	't' => "alphnum"];

			$insert['alumnos'] = array(//INSERT alumno
				'query' => "INSERT INTO alumnos (email, idPersona, idTutor, idColegio, idGrado, idSede) VALUES (?,?,?,?,?,?)",
				'values' => array('Correo Electronico',
					array( //INSERT PERSONA
						'query' => "INSERT INTO personas (nombre, apellidoPaterno, apellidoMaterno, idGenero, fechaNacimiento) VALUES (?,?,?,?,?)",
						'values' => array('Nombre', 'Apellido Paterno', 'Apellido Materno',
						array(//SELECT GENERO
							'query' => "SELECT idGenero FROM generos WHERE genero = ?",
							'values' => array('Sexo'),
							'types' => "s"
						), 'Fecha Nacimiento'),
						'types'=>'sssis',
					),
						array( //SELECT Tutor
							'query' => "SELECT idCliente FROM clientescompleto WHERE nombre = ? AND apellidoPaterno = ? AND apellidoMaterno = ?",
							'values' => array('Nombre Tutor', 'Apellido Paterno Tutor', 'Apellido Materno Tutor'),
							'types' => 'sss'
						),
						array( //SELECT Colegio
							'query' => "SELECT idColegio FROM colegios WHERE colegio = ?",
							'values' => array('Colegio'),
							'types' => "s"
						),
						array( //INSERT Grado
							'query' => "SELECT idGrado FROM grados WHERE nombreGrado = ?",
							'values' => array('Grado'),
							'types' => 's'
						),
						array( //SELECT SEDE
							'query' => "SELECT idSede FROM sedes WHERE nombreSede = ?",
							'values' => array('Sede'),
							'types' => "s"
						),
			),
			'types' =>'siiiii'
			);


			$identifier['alumnos'] = array("Alumnos", "Nombre", "Apellido Paterno", "Apellido Materno");
			//Queries
			//SELECT COUNT(u.idUsuario) FROM cliente as c LEFT JOIN usuario as u ON u.idUsuario = c.idUsuario WHERE u.nombre = ? AND u.apellidoPaterno = ? AND u.apellidoMaterno = ?	Params: nombre, Apellido Paterno, Apellido Materno	Warning
			//Ya existe un cliente con ese nombre (Sacar Aviso)
			$queries['alumnos']['warning']['Alumnos'] = array(
				"SELECT COUNT(u.idPersona) as existe FROM alumnos as c LEFT JOIN personas
				 as u ON u.idPersona = c.idPersona WHERE u.nombre = ? AND u.apellidoPaterno = ? AND u.apellidoMaterno = ?",
				array('Nombre', 'Apellido Paterno', 'Apellido Materno'),
				'sss'
			);
			//SELECT COUNT(u.idUsuario) FROM cliente as c LEFT JOIN usuario as u ON u.idUsuario = c.idUsuario WHERE u.email = ?	Invalid	Params: Correo Electronico
			//Se creara algo nuevo
			$queries['alumnos']['new'] = array();

			$queries['alumnos']['noexist'] = array();

			$queries['alumnos']['invalid'] = array();
			//No existe esa sede
			$queries['alumnos']['noexist']['Sede'] = array(
				"SELECT COUNT(idSede) as existe FROM sedes WHERE nombreSede = ?",
				array('Sede'),
				's'
			);
			//No existe ese Grado
			$queries['alumnos']['noexist']['Grado'] = array(
				"SELECT COUNT(idGrado) as existe FROM grados WHERE nombreGrado = ?",
				array('Grado'),
				's'
			);
			//No existe ese colegio
			$queries['alumnos']['noexist']['Colegio'] = array(
				"SELECT COUNT(idColegio) as existe FROM colegios WHERE colegio = ?",
				array('Colegio'),
				's'
			);
			//No existe ese tutor
			$queries['alumnos']['noexist']['Tutor'] = array(
				"SELECT COUNT(idCliente) as existe FROM clientescompleto WHERE nombre = ? AND apellidoPaterno = ? AND apellidoMaterno = ?",
				array('Nombre Tutor', 'Apellido Paterno Tutor', 'Apellido Materno Tutor'),
				'sss'
			);
			//No existe ese sexo
			$queries['alumnos']['noexist']['Sexo'] = array(
				"SELECT COUNT(idGenero) as existe FROM generos WHERE genero = ?",
				array('Sexo'),
				's'
			);
			//PACIENTES
			//Reglas y headers
			$headers['pacientes']["Nombre"] = 					['r' => true,  't' => "alphnumper"];
			$headers['pacientes']["Microchip"] =				['r' => false,  't' => "alphnum"];

			$headers['pacientes']["Cliente"] =					['r' => false , 	't' => "name"];

			$headers['pacientes']["Centro Ecuestre"] =			['r' => false,  't' => "alphnum"];
			$headers['pacientes']["Genero"] =					['r' => false,  't' => "alphnum"];
			$headers['pacientes']["Raza"] =						['r' => false,  't' => "alphnum"];
			$headers['pacientes']["Color"] =					['r' => false,  't' => "alphnum"];

			$headers['pacientes']["Fecha de Nacimiento"] =		['r' => false,  't' => "date"];
			$identifier['pacientes'] = array("Pacientes", "Nombre");
			$insert['pacientes'] = array(
				'query'=>"INSERT INTO paciente(idCliente, nombrePaciente, microchip, idGenero, idRaza, idColor, fechaNacimiento, idHipico) VALUES (?,?,?,?,?,?,?,?)",
				'values' => array(
				array(//SELECT idCliente
					'query'=>"SELECT c.idCliente FROM cliente as c LEFT JOIN usuario as u ON u.idUsuario = c.idUsuario WHERE CONCAT(u.nombre, ' ', u.apellidoPaterno, ' ', u.apellidoMaterno) = ?",
					'values' => array('Cliente'),
					'types'=>'s'
				), 'Nombre', 'Microchip', 'Genero', 'Raza', 'Color', 'Fecha de Nacimiento',
				array(//SELECT idHipico
					'query'=>"SELECT idHipico FROM hipico WHERE hipico = ?",
					'values' => array('Centro Ecuestre'),
					'types'=>'s'
				)),
				'types' => 'issiiisi'
			);

			//Queries
			//SELECT COUNT(u.idUsuario) FROM cliente as c LEFT JOIN usuario as u ON u.idUsuario = c.idUsuario WHERE CONCAT(u.nombre, ' ', u.apellidoPaterno, ' ', u.apellidoMaterno) = ?	Params: Cliente	Invalid
			$queries['pacientes']['noexist']['Cliente'] = array(
				"SELECT COUNT(u.idUsuario) as existe FROM cliente as c LEFT JOIN usuario as u ON u.idUsuario = c.idUsuario WHERE CONCAT(u.nombre, ' ', u.apellidoPaterno,
				IFNULL(CONCAT (' ', u.apellidoMaterno), '')) = ?",
				array('Cliente'),
				's'
			);
			//SELECT COUNT(idHipico) FROM hipico WHERE hipico = ?	Params: Centro Ecuestre	Invalid
			$queries['pacientes']['noexist']['Centro Ecuestre'] = array(
				"SELECT COUNT(idHipico) as existe FROM hipico WHERE hipico = ?",
				array('Centro Ecuestre'),
				's'
			);
			//SELECT COUNT(idGenero) FROM paciente_genero WHERE genero = ?	Params: Genero	New
			$queries['pacientes']['new']['Genero'] = array(
				"SELECT COUNT(idGenero) as existe FROM paciente_genero WHERE genero = ?",
				array("Genero"),
				's'
			);
			//SELECT COUNT(idRaza) FROM paciente_raza WHERE raza = ?	Params: Raza	New
			$queries['pacientes']['new']['Raza'] = array(
				"SELECT COUNT(idRaza) as existe FROM paciente_razas WHERE raza = ?",
				array("Raza"),
				's'
			);
			//SELECT COUNT(idColor) FROM paciente_color WHERE color = ?	Params: Color	New
			$queries['pacientes']['new']['Color'] = array(
				"SELECT COUNT(idColor) as existe FROM paciente_color WHERE color = ?",
				array("Color"),
				's'
			);
			$queries['pacientes']['invalid'] = array();
			$queries['pacientes']['warning'] = array();
			//SERVICIOS
			//Reglas y headers
			$headers['servicios']['Nombre'] =  				['r' => true , 	't' => "servs"];
			$headers['servicios']['Categoria'] =  			['r' => true , 	't' => "servs"];
			$headers['servicios']['Precio'] =  				['r' => true , 	't' => "coin"];
			$identifier['servicios'] = array("Servicios", "Nombre");
			//Queries
			//SELECT COUNT(idServicio) FROM servicio WHERE servicio = ?	Params: Nombre	Invalid
			$queries['servicios']['invalid']['Servicio'] = array(
				"SELECT COUNT(idServicio) as existe FROM servicio WHERE servicio = ?",
				array('Nombre'),
				's'
			);
			//SELECT COUNT(idCategoria) FROM servicio_categoria WHERE categoria = ?	Params: Categoria	New
			$queries['servicios']['new']['Categoria'] = array(
				"SELECT COUNT(idServicioCategoria) as existe FROM servicio_categoria WHERE categoria = ?",
				array('Categoria'),
				's'
			);

			$queries['servicios']['warning'] = array();
			$queries['servicios']['noexist'] = array();
			$insert['servicios'] = array(
				'query'=>"INSERT INTO servicio(idServicioCategoria, servicio, precio) VALUES (?,?,?)",
				'values' => array('Categoria', 'Nombre', 'Precio'),
				'types' => 'isd'
			);
			//MATERIALES
			//Reglas y headers
			$headers['materiales']['Nombre Comercial'] =  				['r' => true , 	't' => "prinac"];
			$headers['materiales']['Unidades de Uso'] =  					['r' => true , 	't' => "coin"];
			$headers['materiales']['Principio Activo'] =  				['r' => true , 	't' => "servs"];

			$identifier['materiales'] = array("Materiales", "Nombre Comercial");
			//Queries
			$queries['materiales']['invalid']['Nombre Comercial'] = array(
				"SELECT COUNT(idMaterialPresentacion) as existe FROM material_presentacion WHERE nombrePresentacion = ?",
				array('Nombre Comercial'),
				's'
			);

			//SELECT COUNT(idCategoria) FROM servicio_categoria WHERE categoria = ?	Params: Categoria	New
			$queries['materiales']['new']['Principio Activo'] = array(
				"SELECT COUNT(idMaterial) as existe FROM material WHERE nombre = ?",
				array('Principio Activo'),
				's'
			);

			$queries['materiales']['warning'] = array();
			$queries['materiales']['noexist'] = array();
			$insert['materiales'] = array(
				'query'=>"INSERT INTO material_presentacion(idMaterial, nombrePresentacion, cantidad) VALUES (?,?,?)",
				'values' => array('Principio Activo', 'Nombre Comercial', 'Unidades de Uso'),
				'types' => 'isd'
			);




		$new['pacientes']['Genero'] = array('table'=>'paciente_genero', 'idColumn'=>'idGenero', 'valueColumn'=>'Genero');
		$new['pacientes']['Raza'] = array('table'=>'paciente_razas', 'idColumn'=>'idRaza', 'valueColumn'=>'Raza');
		$new['pacientes']['Color'] = array('table'=>'paciente_color', 'idColumn'=>'idColor', 'valueColumn'=>'Color');

		$new['servicios']['Categoria'] = array('table'=>'servicio_categoria', 'idColumn'=>'idServicioCategoria', 'valueColumn'=>'Categoria', 'nameColumn'=>'Categoria');

		$new['clientes'] = array();
		$new['alumnos'] = array();

		$new['hipicos'] = array();

		$new['materiales']['Principio Activo'] = array('table'=>'material', 'idColumn'=>'idMaterial', 'valueColumn'=>'nombre', 'nameColumn'=>'Principio Activo');

	function insert_or_select_category($con, $tableInfo, $value){
		$params = array();
		$params[] = $value;
		$id = select_query($con, "SELECT ".$tableInfo['idColumn']." as id FROM ".$tableInfo['table']." WHERE ".$tableInfo['valueColumn']." = ?", 's', $params);
		if(count($id)==0){
			$id = insert_id_query($con, "INSERT INTO ".$tableInfo['table']." (".$tableInfo['valueColumn'].") VALUES (?)", 's', $params);
		}else{
			$id = $id[0]['id'];
		}
		return $id;
	}

	function isEmpty($arr){
		foreach($arr as $k => $v){
			if($v!=""){
				return false;
			}
		}
		return true;
	}

	function compareHeaders($headers, $header){
		$n = 0;
		if(count($headers)!=count($header)){
			return false;
		}

		foreach($headers as $h => $v){
			if($header[$n]!=$h){
				return false;
			}
			$n++;
		}
		return true;
	}

	function insert_deep($con, $insert, $header, $headers, $nuevos, $new, $checkforName){
		/*
		var_dump($insert);
		var_dump($header);
		var_dump($headers);
		echo "NUEVOS";
		var_dump($nuevos);
		echo "NUEVOS";
		var_dump($new);
		var_dump($checkforName);
		*/
		$params = array();
		foreach($insert['values'] as $k){
			if(is_array($k)){//El valor actual requiere un insert/select
				$params[] = insert_deep($con, $k, $header, $headers, $nuevos, $new, $checkforName);
			}else{
				$v = $header[array_search($k, array_keys($headers[$checkforName]))];
				if(isset($new[$checkforName][$k])){
					//var_dump($k);
					//var_dump($v);
					$v = $nuevos[$k][$v];
				}
				$params[] = $v;
			}
		}
		//var_dump($insert['query']);	var_dump($params);
		if(substr($insert['query'],0,1)=="I"){//INSERT
			return insert_id_query($con, $insert['query'], $insert['types'], $params);
		}else if(substr($insert['query'],0,1)=="S"){//SELECT
			$id = select_query($con, $insert['query'], $insert['types'], $params);
			if(count($id)==0){
				return null;
			}else{
				foreach($id[0] as $k=>$v){
					return $v;
				}
			}
		}else{
			echo "Esto no es un SELECT o un INSERT, o está mal escrito";
			var_dump($insert['query']);
			exit;
			return false;
		}


		/*
		$params = array();
		foreach($insert[$checkforName]['values'] as $k){//Crea params, las llaves que no encuentre se buscan en el arreglo de nuevos (Que es donde se insertan las tablas categoria)
			$v = $header[$p];

			//var_dump("Value");var_dump($k);var_dump($v);
			if(isset($new[$checkforName][$k])){
				$v = $nuevos[$k][$v];
			}
			$params[] = $v;
		}
		*/
		//;
	}
?>
