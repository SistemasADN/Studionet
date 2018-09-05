<?php
	include "../validation/classValidator.php";
	$validator = new Validator();	
	//Reglas
	$rules = array ();
	$validator->setRules($rules);
	$validator->validateArray($_POST);
	
	if($validator->isValid()){
		include "dbcon.php";
		$stmt = mysqli_prepare($con, "
          SELECT 
            c.idCliente, 
            CONCAT(p.nombre, ' ', p.apellidoPaterno, ' ', p.apellidoMaterno) AS nombreCompleto 
          FROM clientes AS c 
            LEFT JOIN personas AS p 
              ON c.idPersona = p.idPersona 
          WHERE c.activo = 1 
          ORDER BY nombreCompleto ASC");
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
            mysqli_stmt_free_result($stmt);
            for($i=0;$i<sizeof($data);$i++){
              $nombreAlumno = '';
              $res = '';
              $current = $data[$i];
              $stmt = mysqli_prepare($con,
              "SELECT
                CONCAT(p.nombre,' ',p.apellidoPaterno, ' ', p.apellidoMaterno) as nombreAlumno
              FROM
                alumnos AS a
              LEFT JOIN personas AS p
                ON a.idPersona = p.idPersona
              WHERE
                a.idTutor = ?");
              mysqli_stmt_bind_param($stmt, 'i', $data[$i]['id']);
              mysqli_stmt_bind_result($stmt, $nombreAlumno);
              if(mysqli_stmt_execute($stmt)){
                while(mysqli_stmt_fetch($stmt)){
                  $res .= $nombreAlumno.',';                  
                }
                $data[$i]['data-subtext'] = $res;
              }
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