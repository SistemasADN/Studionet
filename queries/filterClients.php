<?php
  include "../validation/classValidator.php";
  include "dbcon.php";
  mysqli_autocommit($con, FALSE);
  $clientes = select_query($con, "SELECT c.idCliente, c.idPersona, c.idPrefijo, c.idContacto, p.*, co.* FROM clientes as c LEFT JOIN personacompleta as p ON p.idPersona = c.idPersona LEFT JOIN contacto as co ON c.idContacto = co.idContacto ORDER BY c.idCliente");
  $filtrados = array();
  $inactivar = array();
  foreach($clientes as $cliente){
    $existe = false;
    foreach($filtrados as $filtro){
      if($filtro['email']==$cliente['email']&&$filtro['nombre']==$cliente['nombre']){
        $existe = true;
      }
    }
    if(!$existe){
        $filtrados[] = $cliente;
    }else{
        $inactivar[] = $cliente;
        execute_query($con, "UPDATE clientes SET activo = 0 WHERE idCliente = ?", 'i', [$cliente['idCliente']], false);
        execute_query($con, "UPDATE personas SET apellidoMaterno = 'Duplicado' WHERE idPersona = ?", 'i', [$cliente['idPersona']], false);
        execute_query($con, "UPDATE alumnos SET activo = 0 WHERE idTutor = ?", 'i', [$cliente['idCliente']], false);
    }
  }
  mysqli_commit($con);

?>
