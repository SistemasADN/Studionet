<?php
	include "../validation/classValidator.php";
    include '../mailer/randomLib.php';
    include '../mailer/emailFunctions.php';
	$validator = new Validator();
	//Reglas

	$rules = array ();
  $rules['idGrupo'] = ["t"=>'num',"r"=>true];
	$listaProfesores = $_POST['listaProfesores'];
	unset($_POST['listaProfesores']);
	$validator->enableEchos();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	$rules = array ();
	$rules["idProfesor"] =		 		['r' => true,  't' => "num"];
	$rules["principal"] =		 			['r' => true,  't' => "bool"];
	for($i=0;$i<count($listaProfesores);$i++){
		$validator->setRulesValidateArrayEcho($rules, $listaProfesores[$i]);
	}
	include "dbcon.php";
	mysqli_autocommit($con, FALSE);
	$_POST['fechaAlta'] = date("Y-m-d");



	$listaActual = select_query($con, "SELECT idProfesor FROM grupo_profesor WHERE idGrupo = ? AND fechaBaja IS NULL", 'i', [$_POST['idGrupo']]);
  /*
  Lista de profesores es lo que tiene que quedar...
  	OPCION A) Está en LA y LP: Se queda
  	OPCION B) Está en LA y NO en LP: UPDATE fechaBaja = Y-m-d
  	OPCION C) NO está en LA y sí en LP: INSERT
*/
for($i=0;$i<count($listaProfesores);$i++){
			if($listaProfesores[$i]['principal']=="true"){
				$listaProfesores[$i]['principal'] = 1;
			}else{
				$listaProfesores[$i]['principal'] = 0;
			}
			$next = [$_POST['idGrupo'], $listaProfesores[$i]['idProfesor'], $listaProfesores[$i]['principal'],$_POST['fechaAlta']];

		$found = false;

    for($j=0;$j<count($listaActual);$j++){
      if($listaActual[$j]['idProfesor']==$listaProfesores[$i]['idProfesor']){
        $found = true;
      }
    }
		//var_dump($listaActual);var_dump($listaProfesores);echo "Found";var_dump($found);exit;
		if(!$found){
			if(!execute_query($con, "INSERT INTO grupo_profesor (idGrupo, idProfesor, principal, fechaAlta) VALUES (?,?,?,?)", 'iiss', $next, false)){
			//if(!execute_query($con, "INSERT INTO grupo_profesor (idGrupo, idProfesor, fechaAlta) VALUES (?,?,?)", 'iis', $next, false)){
  			echo "e|Crear clase|No se pudo crear la lista de profesores.";exit;
  		}
		}else{
			if(!execute_query($con, "UPDATE grupo_profesor SET principal = ? WHERE idGrupo = ? AND idProfesor = ? AND fechaBaja IS NULL", 'iii',
			 [$listaProfesores[$i]['principal'], $_POST['idGrupo'], $listaProfesores[$i]['idProfesor']])){
				 echo "e|Crear clase|No se pudo editar la lista de profesores.";exit;
			 }
		}
	}

	for($i=0;$i<count($listaActual);$i++){
			$next = [date('Y-m-d'), $_POST['idGrupo'], $listaActual[$i]['idProfesor'],];
			$found = false;
			for($j=0;$j<count($listaProfesores);$j++){
	     	if($listaProfesores[$j]['idProfesor']==$listaActual[$i]['idProfesor']){
	       	$found = true;
	     	}
	   	}
			if(!$found){
				if(!execute_query($con, "UPDATE grupo_profesor SET fechaBaja = ?, principal = 0 WHERE idGrupo= ? AND idProfesor = ? AND fechaBaja IS NULL", 'sii', $next, false)){
					echo "e|Crear clase|No se pudo crear la lista de profesores..";exit;
				}
			}
	}

	echo "s|Editar lista profesores|Lista de profesores editada exitosamente";
	mysqli_commit($con);
	exit;
	//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME
	$horario = array();
	$horario[] = $_POST;
	unset($horario[0]['idSalonGrupo']);
	//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME


	//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME
	$profesores = select_query($con, "SELECT idProfesor FROM grupo_profesor WHERE idGrupo = ? AND fechaBaja IS NULL", 'i', reorder_array($_POST, ['idGrupo']));
	$continue = true;
	//Grupos de profesor principal
	for($i=0;$i<count($profesores);$i++){
			if(!$continue){
				break;
			}
			$profesores[$i]['grupos'] = select_query($con, "SELECT idGrupo FROM grupo_profesor WHERE idProfesor = ? AND fechaBaja IS NULL", 'i', [$profesores[$i]['idProfesor']]);
			for($j=0;$j<count($profesores[$i]['grupos']);$j++){
				if(!$continue){
					break;
				}
				$insert = array($profesores[$i]['grupos'][$j]['idGrupo']);
				//var_dump($insert);
				$horarioGrupo = select_query($con, "SELECT dia, horaInicio, duracion
				FROM horario as h LEFT JOIN salon_grupo as sg ON sg.idSalonGrupo = h.idSalonGrupo
				WHERE sg.idGrupo = ?", 'i', $insert);
				if(empalme_horario($horarioGrupo, $horario)){
					$continue = false;
				}
			}
	}
//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME//EMPALME
?>
