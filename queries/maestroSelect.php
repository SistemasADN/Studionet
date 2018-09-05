<?php
	include "../validation/classValidator.php";
	$validator = new Validator();	
	//Reglas
	$rules = array ();
	$validator->setRules($rules);
	$validator->validateArray($_POST);
	
	if($validator->isValid()){
		include "dbcon.php";
		$stmt = mysqli_prepare($con, "SELECT pe.idPersonal, CONCAT(p.nombre, ' ', p.apellidoPaterno, ' ', p.apellidoMaterno) as nombreMaestro FROM personal AS pe LEFT JOIN personas AS p ON pe.idPersona = p.idPersona WHERE pe.activo = 1 AND pe.idTipoPersonal = 1 ORDER BY nombreMaestro ASC");
		mysqli_stmt_bind_result($stmt, $id, $value);
		if(mysqli_stmt_execute($stmt)){
			$data = array();
			while(mysqli_stmt_fetch($stmt)){
				$row = array(
						'id' => $id,
						'value' => $value,
				);
				$data[] = $row;
			}
			/*Encodear arreglo php a JSON.*/
			header("Content-type: application/json;charset=utf8");
			echo json_encode($data);
		}else{
			echo "E1";
		}
	} else {
		echo 'e|Error|Datos no válidos';
	}
?>