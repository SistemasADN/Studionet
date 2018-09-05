<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array ();

	$rules['cp'] = 			['t' => 'num', 'r' => true];

	$validator->setRules($rules);
	$validator->validateArray($_POST);
	if($validator->isValid())
	{
		include "dbcon.php";
		$stmt = mysqli_prepare($con, "SELECT cp.idCiudad, c.ciudad, e.idEstado, e.estado, p.idPais, p.pais FROM direccion_codigopostal AS cp LEFT JOIN direccion_ciudadpoblacion AS c ON cp.idCiudad = c.idCiudad LEFT JOIN direccion_estado AS e ON e.idEstado = c.idEstado LEFT JOIN direccion_pais AS p ON e.idPais = p.idPais WHERE cp.cp = ?");
		mysqli_stmt_bind_param($stmt, 'i', $_POST['cp']);
		mysqli_stmt_bind_result($stmt, $idCiudad, $ciudad, $idEstado, $estado, $idPais, $pais);
		if(mysqli_stmt_execute($stmt))
		{
			$data = array();
			mysqli_stmt_fetch($stmt);
			$data['idCiudad'] = $idCiudad;
			$data['ciudad'] = $ciudad;
			$data['idEstado'] = $idEstado;
			$data['estado'] = $estado;
			$data['idPais'] = $idPais;
			$data['pais'] = $pais;

			mysqli_stmt_free_result($stmt);

			$stmt = mysqli_prepare($con, "SELECT idColonia, colonia FROM direccion_colonia WHERE cp = ?");
			mysqli_stmt_bind_param($stmt, 'i', $_POST['cp']);
			mysqli_stmt_bind_result($stmt, $idColonia, $colonia);
			if(mysqli_stmt_execute($stmt))
			{
				$data['colonia'] = array();
				while(mysqli_stmt_fetch($stmt)){
						$row = array(
						'id' => $idColonia,
						'value' => $colonia
					);
					$data['colonia'][] = $row;
				}
				header("Content-type: application/json;charset=utf8");
				echo json_encode($data);
			} else {
				echo '-1';
			}
		} else {
			echo '-1';
		}
	} else {
		echo 'e|Datos|Datos no válidos';
	}
	
?>