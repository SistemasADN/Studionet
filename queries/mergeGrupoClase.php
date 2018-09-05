<?php
    require "dbcon.php";
    require "../validation/classValidator.php";
    if(!isset($_GET['pollo'])){
      echo "Done";exit;
    }
  
    $clases = select_query($con, "SELECT idClase, idAsignatura, idNivel FROM clases");
    var_dump($clases);

    mysqli_autocommit($con, FALSE);
    execute_query($con, "ALTER TABLE `grupos` ADD `idAsignatura` INT NOT NULL AFTER `idClase`, ADD `idNivel` INT NOT NULL AFTER `idAsignatura`;") or die ("No se ejecutó la query de cambiar grupo ".mysqli_error($con));
     $error = false;
     $errors = array();
     foreach($clases as $clase){
       var_dump($clase);
        if(!execute_query($con, "UPDATE grupos SET idAsignatura = ?, idNivel = ? WHERE idClase = ?", 'iii', [$clase['idAsignatura'], $clase['idNivel'], $clase['idClase']], false)){
          $errors[] = ["datos"=>$clase, "error"=>mysqli_error($con)];
        }
     }
     //$error = true;
     if($error){
        echo "There was an error";
        var_dump($errors);
        execute_query($con, "ALTER TABLE `grupos` DROP `idAsignatura`;");
        execute_query($con, "ALTER TABLE `grupos` DROP `idNivel`;");
     }else{
        mysqli_commit($con);
        execute_query($con, "ALTER TABLE grupos DROP FOREIGN KEY grupos_clase;");
        execute_query($con, "ALTER TABLE `grupos` DROP `idClase`;");
     }

     //ALTER TABLE `grupos` DROP `idClase`;
?>
