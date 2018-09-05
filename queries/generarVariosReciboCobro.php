<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	//Reglas
	//getDebuggingInfo(true);
	$rules = array ();
	$rules['fechaSelect'] = 						['r' => true , 	't' => "date"];
  $rules['descuentoTabla'] = 				   		['r' => false , 	't' => "num"];
	$rules['conFolio'] = 				   					['r' => true , 	't' => "bool"];
  $rules['tipo'] = 				   					    ['r' => true , 	't' => "alpha"];
  $rules['tipoId'] = 				   					  ['r' => true , 	't' => "num"];

	$rules2 = array ();
	$rules2['cantidad'] = 				        	['r' => true , 	't' => "num"];
	$rules2['idConcepto'] = 				        ['r' => true , 	't' => "num"];
	$rules2['precioUnitario'] = 				    ['r' => true , 	't' => "coin"];
  $rules2['descuento'] = 				        	['r' => true , 	't' => "num"];
	
	$cobro = $_POST['reciboCobro'];
	unset($_POST['reciboCobro']);

	$validator->setRulesValidateArrayEcho($rules, $_POST);
	foreach($cobro as $k=>$v){
		$validator->setRulesValidateArrayEcho($rules2, $v);
	}
  include "dbcon.php";
  include "getIdSede.php";

  $_POST['idSede'] = $idSede;
	//IS USING DISTINCT THE CORRECT CHOICE?
  switch($_POST['tipo']){
      case 'CLASE':
         $query = "SELECT DISTINCT a.idAlumno FROM alumnos as a
         LEFT JOIN alumnos_grupos as ag ON ag.idAlumno = a.idAlumno
         LEFT JOIN grupos as g ON ag.idGrupo = g.idGrupo AND g.idSede = ?
         WHERE ag.fechaBaja IS NULL AND ag.idGrupo = ?";
      break;
      case 'DISCIPLINA':
          $query = "SELECT DISTINCT a.idAlumno FROM alumnos as a
          LEFT JOIN alumnos_grupos as ag ON ag.idAlumno = a.idAlumno
          LEFT JOIN grupos as g ON ag.idGrupo = g.idGrupo AND g.idSede = ?
          LEFT JOIN asignaturas as aa ON aa.idAsignatura = g.idAsignatura
          WHERE ag.fechaBaja IS NULL AND aa.idDisciplina = ?";
      break;
      case 'ASIGNATURA':
          $query = "SELECT DISTINCT a.idAlumno FROM alumnos as a
          LEFT JOIN alumnos_grupos as ag ON ag.idAlumno = a.idAlumno
          LEFT JOIN grupos as g ON ag.idGrupo = g.idGrupo AND g.idSede = ?
          WHERE ag.fechaBaja IS NULL AND g.idAsignatura = ?";
      break;
      case 'NIVEL':
          $query = "SELECT DISTINCT a.idAlumno FROM alumnos as a
          LEFT JOIN alumnos_grupos as ag ON ag.idAlumno = a.idAlumno
          LEFT JOIN grupos as g ON ag.idGrupo = g.idGrupo AND g.idSede = ?
          WHERE ag.fechaBaja IS NULL AND g.idNivel = ?";
      break;
  }

  $listaAlumnos = select_query($con, $query, 'ii', [$_POST['idSede'], $_POST['tipoId']]);
  $listaClientes = array();
  foreach($listaAlumnos as $alumno){
    $idCliente = select_query_one($con,
    "SELECT c.idCliente FROM clientes as c
     LEFT JOIN alumnos as a ON a.idTutor = c.idCliente
     WHERE a.idAlumno = ?", 'i', [$alumno['idAlumno']]);
     $idCliente = $idCliente['idCliente'];
     if(!isset($listaClientes[$idCliente])){
       $listaClientes[$idCliente] = array();
     }
     $listaClientes[$idCliente][] = $alumno['idAlumno'];
  }
  foreach($listaClientes as $idCliente =>$listaAlumnos){
    $_POST['idCliente'] = $idCliente;
    //var_dump($idCliente);
		if($_POST['conFolio']=='true'){

			$folio = select_query($con, "SELECT folio FROM nextFolio WHERE idSede = ?", 'i', [$idSede]);
			$_POST['folio'] = $folio[0]['folio'];
      //echo "Requiere folio [".$_POST['folio']."]<br>";
      $idReciboPago = insert_id_query($con, "INSERT INTO recibo_pago (idCliente, fecha, descuento, idSede, folio) VALUES (?,?,?,?,?)", 'isdii',
			 reorder_array($_POST, ['idCliente', 'fechaSelect', 'descuentoTabla', 'idSede', 'folio']));
			 //APLICAR PAGOS
       //echo "RPID [".$idReciboPago."]<br>";
			 $totalAplicar = 0;
       //Por cada alumno
  		foreach($cobro as $row){
           foreach($listaAlumnos as $key=>$idAlumno){
  						$totalAplicar = $row['cantidad']*$row['precioUnitario']*(1-$row['descuento']/100);
  				}
        }
        //echo "totalAplicar: ".$totalAplicar."<br>";
        //Fin por cada alumno
				if($_POST['descuentoTabla']==""){
					$_POST['descuentoTabla'] = 0;
				}
				$totalRP = $totalAplicar*(1-$_POST['descuentoTabla']/100);
        //echo "totalRP: ".$totalRP."<br>";
			 //4. Sacar total pagos recibidos
			 $pagosRecibidos = select_query($con, "
			 SELECT r.idPagoRecibido, r.cantidad-IFNULL(SUM(a.cantidad),0) as cantidadAplicar
			 FROM pagos_recibidos as r LEFT JOIN pagos_aplicados as a ON a.idPagoRecibido = r.idPagoRecibido
			 WHERE r.idCliente = ? AND r.aprobado = 1
			 GROUP BY (r.idPagoRecibido)", 'i', [$_POST['idCliente']]);
			 $pagosRecibidosAplicar = array();
			 foreach($pagosRecibidos as $pago){
				 if($pago['cantidadAplicar']>0){
					 $pagosRecibidosAplicar[$pago['idPagoRecibido']] = $pago['cantidadAplicar'];
				 }
			 }

			$fecha = $_POST['fechaSelect'];
			foreach($pagosRecibidosAplicar as $idPagoRecibido => $disponible){
	 			$stmt = mysqli_prepare($con, "INSERT INTO pagos_aplicados (idPagoRecibido, idReciboPago, fecha, cantidad)
				 VALUES (?,?,?,?)");
	 			mysqli_stmt_bind_param($stmt, 'iisd', $idPagoRecibido, $idReciboPago, $fecha, $cantidadAplicar);

	 			if($disponible<$totalRP){
	 				$cantidadAplicar = $disponible;
	 				$totalRP -= $cantidadAplicar;
	 			}else{
	 				$cantidadAplicar = $totalRP;
	 				$totalRP = 0;
	 			}

	 			if($cantidadAplicar>0){
	 				mysqli_stmt_execute($stmt) or die ('{0}');
	 			}else{
	 				break;
	 			}
	 		}
				/**/
		}else{
			$idReciboPago = insert_id_query($con, "INSERT INTO recibo_pago (idCliente, fecha, descuento, idSede) VALUES (?,?,?,?)", 'isdi',
			 reorder_array($_POST, ['idCliente', 'fechaSelect', 'descuentoTabla', 'idSede']));
       //echo "NO REQUIERE FOLIO<br>";echo "IDRP ".$idReciboPago."<br>";
		}
		/*
		echo "CLIENTE";
		var_dump($idCliente);
		echo "ALUMNOS";
		var_dump($listaAlumnos);
		echo "COBRO";
		var_dump($cobro);
		/**/
    if($idReciboPago!=0){
      //Por cada alumno
      foreach($listaAlumnos as $key=>$idAlumno){
          foreach($cobro as $row){
    		      $row['idReciboPago'] = $idReciboPago;
							//echo "EXECUTING: ".$query;var_dump([$idAlumno, $row['idConcepto'], $row['cantidad'], $row['idReciboPago'], $row['precioUnitario'], $row['descuento']]);
            if(!execute_query($con,
						 "INSERT INTO recibo_pago_lista (fecha, idAlumno, idConcepto, cantidad, idReciboPago, precioActual, descuento) VALUES (?,?,?,?,?,?,?)",
							"siiiidi",
    				 [$_POST['fechaSelect'], $idAlumno, $row['idConcepto'], $row['cantidad'], $row['idReciboPago'], $row['precioUnitario'], $row['descuento']], false)){
              echo "e|Generar Carta de cobro|No se pudo generar el recibo de cobro.";exit;
    		        exit;
            }
            //var_dump($row);
          }
      }
      //Fin por cada alumno
    }else{
      echo "e|Generar Carta de cobro|No se pudo generar las cartas de cobro.";exit;
    }
  }

  mysqli_commit($con);
  echo "s|Generar Carta de cobro|Cartas de cobro generadas con exito.";
?>
