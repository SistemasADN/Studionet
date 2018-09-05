<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
//	var_dump($_POST); exit;
	//getDebuggingInfo(true); debuguear por fuera de la consola
	//deleteDebuggingInfo();
	//Rules es el array a las que se agregan los inputs a validar
	$rules = array();
	$rules['idCalculoPagos'] = ['r'=>true, 't'=>'num'];
	$rules['tipoSelect'] = ['r'=>true, 't'=>'num'];
	if($_POST['tipoSelect']!=1){ $rules['idSelect'] = ['r'=>true, 't'=>'num']; }
	$arrRules = array();
	$lista = array();
	if($_POST['idSelect']==NULL OR $_POST['idSelect']==""){$idSelect = '0';}
   // $_POST['idCalculoPagos'];   // idTipoDeCobro (cuota fija, por clase, por dias, por veces a la semana, por veces a la semana)
   // $_POST['tipoSelect'];       // 1:General 2:Disciplina 3:Equipos
   // $_POST['idSelect'];         // idDisciplina o idEquipo
    
    if($idSelect == '0' AND $_POST['tipoSelect']!='1'){
		if($_POST['tipoSelect']==3){
		die ("e|Guardar Configuración|Por favor elija un Equipo");	
		} else if($_POST['tipoSelect']==2){
			die ("e|Guardar Configuración|Por favor elija una Disciplina");
		}
	} else{
	switch($_POST['idCalculoPagos'])
	{
		case 1: //Cuota Fija Mensual
				$rules['cuotaMensual'] = ['r'=>true, 't'=>'coin'];
		break;

		case 2: //Cuota Fija Mensual Por Clase
				$arrRules['idGrupo'] = ["t"=>'num', "r"=>true];
				$arrRules['precioUnitario'] = ["t"=>'coin', "r"=>true];
				foreach($_POST['listaClases'] as $k){
					$lista[] = reorder_array_keys($k, array_keys($arrRules));
				}
		unset($_POST['listaClases']);
		break;

		case 3: //Cuota Por Días
				$arrRules['dias'] = ["t"=>'num', "r"=>true];
				$arrRules['precioUnitario'] = ["t"=>'coin', "r"=>true];
				foreach($_POST['listaDias'] as $k){
							$lista[] = reorder_array_keys($k, array_keys($arrRules));
						}
				unset($_POST['listaDias']);
		break;

		case 4: //Cuota Por Veces A La Semana
			$arrRules['veces'] = ["t"=>'num', "r"=>true];
			$arrRules['vecesPrecioUnitario'] = ["t"=>'coin', "r"=>true];
			foreach($_POST['listaVeces'] as $k){
						$lista[] = reorder_array_keys($k, array_keys($arrRules));
					}
			unset($_POST['listaVeces']);
		break;
	
		case 5: //Cuota Por Total de Horas Semanales
			$arrRules['horas'] = ["t"=>'num', "r"=>true];
			$arrRules['horasPrecioUnitario'] = ["t"=>'coin', "r"=>true];
			foreach($_POST['listaHoras'] as $k){
						$lista[] = reorder_array_keys($k, array_keys($arrRules));
					}
					unset($_POST['listaHoras']);
		break;
		default:
			dnv();
		break;
	}
	include_once "dbcon.php";
	if($_POST['tipoSelect']=='2') {
		execute_query($con, "UPDATE formacobranzadefault SET idForma = 0 , modalidad = ''", '', [], false) or die ("e|Guardar Configuración|No se pudo cambiar la configuración anterior.");
		execute_query($con, "DELETE FROM forma_calculos_detalle WHERE idDisciplina = ? AND idEquipo IS NULL", 'i', [$_POST['idSelect']], false) or die ("e|Guardar Configuración|No se pudo cambiar la configuración anterior.");
	}else if($_POST['tipoSelect']=='3') {
		//execute_query($con, "UPDATE formacobranzadefault SET idForma = 0 , modalidad = ''", '', [], false) or die ("e|Guardar Configuración|No se pudo cambiar la configuración anterior.");
		execute_query($con, "DELETE FROM forma_calculos_detalle WHERE idDisciplina IS NULL AND idEquipo = ?", 'i', [$_POST['idSelect']], false) or die ("e|Guardar Configuración|No se pudo cambiar la configuración anterior.");
	}
	else if($_POST['tipoSelect']=='1'){
		execute_query($con, "UPDATE formacobranzadefault SET idForma = 2 , modalidad = ''", '', [], false) or die ("e|Guardar Configuración|No se pudo cambiar la configuración anterior.");
}

	switch($_POST['idCalculoPagos'])
	{
			case 1: //Cuota Fija Mensual
			    
				if($_POST['tipoSelect']=='2') {
					execute_query($con, "INSERT INTO forma_calculos_detalle (idDisciplina, idCalculoPagos, veceshorasdias,
					 cuota) VALUES (?,?,'-1',?)", 'iid', [$_POST['idSelect'], $_POST['idCalculoPagos'],$_POST['cuotaMensual']], false) 
					 or die ("e|Guardar Configuración|No se pudo guardar los datos de la configuración.");
				}else if($_POST['tipoSelect']=='3') {
					execute_query($con, "INSERT INTO forma_calculos_detalle (idEquipo, idCalculoPagos, veceshorasdias,
					 cuota) VALUES (?,?,'-1',?)", 'iid', [$_POST['idSelect'], $_POST['idCalculoPagos'],$_POST['cuotaMensual']], false) 
					 or die ("e|Guardar Configuración|No se pudo guardar los datos de la configuración.");
				}else if($_POST['tipoSelect']=='1'){
					execute_query($con, "INSERT INTO forma_calculos_detalle (idCalculoPagos, veceshorasdias, cuota) VALUES (?,'-1',?)", 'id', [$_POST['idCalculoPagos'], $_POST['cuotaMensual']], false) or die ("e|Guardar Configuración|No se pudo guardar los datos de la configuración.");
			}
			break;

			case 2: //Cuota Mensual Por Clase
				if($_POST['tipoSelect']=='1') {
				foreach($lista as $m=>$clase){
					execute_query($con, "UPDATE grupos SET precio = ? WHERE idGrupo = ?", 'di', [$clase['precioUnitario'], $clase['idGrupo']], false) or die ("e|Guardar Configuración|No se pudo guardar los datos de la configuración.");
				}
			}
			break;
			case 3: //Cuota Por Días
				if($_POST['tipoSelect']=='2') {
					foreach($lista as $l=>$dias){
						execute_query($con, "INSERT INTO forma_calculos_detalle (idCalculoPagos, idDisciplina, veceshorasdias, cuota) VALUES (?,?,?,?)", 'iiid', [$_POST['idCalculoPagos'], $_POST['idSelect'], $dias['dias'], $dias['precioUnitario']], false) or die ("e|Guardar Configuración|No se pudo guardar los datos de la configuración.");
					}
				}
				else if($_POST['tipoSelect']=='3') {
					foreach($lista as $l=>$dias){
						execute_query($con, "INSERT INTO forma_calculos_detalle (idCalculoPagos, idEquipo, veceshorasdias, cuota) VALUES (?,?,?,?)", 'iiid', [$_POST['idCalculoPagos'], $_POST['idSelect'], $dias['dias'], $dias['precioUnitario']], false) or die ("e|Guardar Configuración|No se pudo guardar los datos de la configuración.");
					}
				}
				else if($_POST['tipoSelect']=='1') {
					foreach($lista as $l=>$dias){
						execute_query($con, "INSERT INTO forma_calculos_detalle (idCalculoPagos, veceshorasdias, cuota) VALUES (?,?,?)", 'iid', [$_POST['idCalculoPagos'], $dias['dias'], $dias['precioUnitario']], false) or die ("e|Guardar Configuración|No se pudo guardar los datos de la configuración.");
					}	
				}
			break;
			case 4: //Cuota Por Veces A La Semana
				if($_POST['tipoSelect']=='2') {
					foreach($lista as $veces){
						execute_query($con, "INSERT INTO forma_calculos_detalle (idCalculoPagos, idDisciplina, veceshorasdias, cuota) VALUES (?,?,?,?)", 'iiid', [$_POST['idCalculoPagos'], $_POST['idSelect'], $veces['veces'], $veces['vecesPrecioUnitario']], false) or die ("e|Guardar Configuración|No se pudo guardar los datos de la configuración.");
					}
				}
				else if($_POST['tipoSelect']=='3') {
					foreach($lista as $veces){
						execute_query($con, "INSERT INTO forma_calculos_detalle (idCalculoPagos, idEquipo, veceshorasdias, cuota) VALUES (?,?,?,?)", 'iiid', [$_POST['idCalculoPagos'], $_POST['idSelect'], $veces['veces'], $veces['vecesPrecioUnitario']], false) or die ("e|Guardar Configuración|No se pudo guardar los datos de la configuración.");
					}
				}
				else if($_POST['tipoSelect']=='1'){
					foreach($lista as $veces){
						execute_query($con, "INSERT INTO forma_calculos_detalle (idCalculoPagos, veceshorasdias, cuota) VALUES (?,?,?)", 'iid', [$_POST['idCalculoPagos'], $veces['veces'], $veces['vecesPrecioUnitario']], false) or die ("e|Guardar Configuración|No se pudo guardar los datos de la configuración.");
					}
				}
			break;
			case 5: //Cuota Por Total de Horas Semanales
				if($_POST['tipoSelect']=='2') {
					foreach($lista as $horas){
						execute_query($con, "INSERT INTO forma_calculos_detalle (idCalculoPagos, idDisciplina, veceshorasdias, cuota) VALUES (?,?,?,?)", 'iiid', [$_POST['idCalculoPagos'], $_POST['idSelect'], $horas['horas'], $horas['horasPrecioUnitario']], false) or die ("e|Guardar Configuración|No se pudo guardar los datos de la configuración.");
					}
				}
				else if($_POST['tipoSelect']=='3') {
					foreach($lista as $horas){
						execute_query($con, "INSERT INTO forma_calculos_detalle (idCalculoPagos, idEquipo, veceshorasdias, cuota) VALUES (?,?,?,?)", 'iiid', [$_POST['idCalculoPagos'], $_POST['idSelect'], $horas['horas'], $horas['horasPrecioUnitario']], false) or die ("e|Guardar Configuración|No se pudo guardar los datos de la configuración.");
					}
				}
				else if($_POST['tipoSelect']=='1'){
					foreach($lista as $horas){
						execute_query($con, "INSERT INTO forma_calculos_detalle (idCalculoPagos, veceshorasdias, cuota) VALUES (?,?,?)", 'iid', [$_POST['idCalculoPagos'],$horas['horas'], $horas['horasPrecioUnitario']], false) or die ("e|Guardar Configuración|No se pudo guardar los datos de la configuración.");
					}
				}
			break;
			default:
				dnv();
			break;
		}
		mysqli_commit($con);
		if($_POST['tipoSelect']==3){
			die ("s|Guardar Configuración|Configuración de cobro de Equipos guardada exitosamente.");	
			} else if($_POST['tipoSelect']==2){
				die ("s|Guardar Configuración|Configuración de cobro por Disciplina guardada exitosamente. Ahora cobra por Disciplinas");
			} else if($_POST['tipoSelect']==1){
				die ("s|Guardar Configuración|Configuración de cobro por Grupos guardada exitosamente. Ahora cobra por Grupos");
			}
		//echo "s|Guardar Configuración|Configuración de pagos guardada exitosamente.";
	}
		?>
