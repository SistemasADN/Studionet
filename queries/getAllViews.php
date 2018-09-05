<?php
  include "../validation/classValidator.php";
  //getDebuggingInfo();
  $validator = new Validator();
  $rules = array ();
  $validator->setRulesValidateArrayEcho($rules, $_POST);
  include "dbcon.php";
  $answers = array();
  $var = select_query($con, "SHOW FULL TABLES WHERE TABLE_TYPE LIKE 'VIEW'");
  foreach($var as $k=>$v){
    $define = select_query_one($con, "SHOW CREATE VIEW ".$v['Tables_in_'.$dbname]);
    $cV = $define['Create View'];
    $cV = str_replace('CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `'.$v['Tables_in_'.$dbname].'` AS (', '', $cV);
    $cV = str_replace('CREATE ALGORITHM=UNDEFINED DEFINER=`vragnuvser`@`localhost` SQL SECURITY DEFINER VIEW `'.$v['Tables_in_'.$dbname].'` AS (', '', $cV);
    $cV = str_replace('CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `'.$v['Tables_in_'.$dbname].'` AS ', '', $cV);
    $answers[] = ['viewName'=>$v['Tables_in_'.$dbname], 'createView'=> substr($cV,0,-1)];
  }
  foreach($answers as $value){
      echo "DROP VIEW IF EXISTS ".$value['viewName'].";<br>";
      echo "CREATE VIEW ".$value['viewName']." AS (".$value['createView'].");<br><br>";
  }
?>
