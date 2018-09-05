<?php
	include "../validation/classValidator.php";
	$validator = new Validator();
	$rules = array ();
	$validator->setRulesValidateArrayEcho($rules, $_POST);
	include "dbcon.php";
		$respuesta = select_query($con, "SHOW TABLES");
		foreach($respuesta as $k=>$v){
			$respuesta[$k]['table_definition'] = select_query($con, 'SHOW CREATE TABLE '.$v['Tables_in_academia']);
		}
		$constraints = select_query($con, 'select
				TABLE_NAME, COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME
				from INFORMATION_SCHEMA.KEY_COLUMN_USAGE');
		
		foreach($constraints as $k=>$v){
			foreach($respuesta as $kk=>$vv){
				if($v['TABLE_NAME']==$vv['Tables_in_academia']){
					if(!isset($respuesta[$kk]['constraints'])){
						$respuesta[$kk]['constraints'] = array();
					}
					$respuesta[$kk]['constraints'][] = $v;
					break;
				}
			}
		}
		json_echo($respuesta);
?>
