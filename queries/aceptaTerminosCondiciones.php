<?php
include "../validation/classValidator.php";
include "dbcon.php";
include "getIdSede.php";
$tipo_usuario = $_SESSION['idTipoUsuario'];
$id_usuario   = $_SESSION['idUsuario'];

if($tipo_usuario == 2)
{
    if(isset($_POST['acepta_terminos']))
    {
        $id_acepta    = $_POST['acepta_terminos'];
        if($busca_usuario = $con ->query(" SELECT * FROM terminos_condiciones WHERE 
                                        id_usuario='$id_usuario' AND tipo_usuario='$tipo_usuario' 
                                        AND acepta='$id_acepta'"))
        {
            $encuentra = $busca_usuario ->num_rows;
            if($encuentra==0)
            {
                if(execute_query($con, "INSERT INTO terminos_condiciones
                (id_tc,id_usuario,tipo_usuario,acepta)
                VALUES(?,?,?,?)",'iiii', [NULL,$id_usuario,$tipo_usuario,$id_acepta]))
                {$msj="Ha aceptado correctamente los Términos y Condiciones";}
                else
                {$msj="Ha ocurrido un problema, vuelva a intentarlo por favor";}
            }
            else
            {
                $msj="Ya ha aceptado los Términos y Condiciones anteriormente, puede continuar."; 
            }  
            $busca_usuario ->close();                                  
        }
        $con ->close();
        echo $msj;
    }

    if(isset($_POST['acepta_aviso']))
    {
        $id_acepta    = $_POST['acepta_aviso'];
        if($busca_usuario = $con ->query("SELECT * FROM terminos_condiciones WHERE 
                                        id_usuario='$id_usuario' AND tipo_usuario='$tipo_usuario' 
                                        AND acepta='$id_acepta'"))
        {
            $encuentra = $busca_usuario ->num_rows;
            if($encuentra==0)
            {
                if(execute_query($con, "INSERT INTO terminos_condiciones
                (id_tc,id_usuario,tipo_usuario,acepta)
                VALUES(?,?,?,?)",'iiii', [NULL,$id_usuario,$tipo_usuario,$id_acepta]))
                {$msj="Ha aceptado correctamente el Aviso de Privacidad";}
                else
                {$msj="Ha ocurrido un problema, vuelva a intentarlo por favor";}
            }
            else
            {
                $msj="Ya ha aceptado el Aviso de Privacidad anteriormente, puede continuar."; 
            }  
            $busca_usuario ->close();                                  
        }
        $con ->close();
        echo $msj;
    }   
}
else
{echo "Usted no tiene privilegios para realizar esta acción.";}

?>
