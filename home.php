<?php
    if(!isset($_SESSION)){session_start();}
    //var_dump($_SESSION);
    if(isset($_POST['idSede'])){
      include "validation/classValidator.php";
      $rules['idSede'] = ['t'=>'coin', 'r'=>false];
      $validator = new Validator();
      $validator->setRulesValidateArrayEcho($rules, $_POST);

      $_SESSION['idSede'] = $_POST['idSede'];
      if($_POST['idSede']!=-1){
        include_once "queries/dbcon.php";
        $res = select_query($con, "SELECT s.nombreSede FROM sedes as s WHERE s.idSede = ?", 'i', [$_POST['idSede']]);
        $_SESSION['nombreSede'] = $res[0]['nombreSede'];
      }else{
        $_SESSION['nombreSede'] = "Administración General";
      }

  }

    include_once "queries/dbcon.php";
    include_once "validation/classValidator.php";


    $res = select_query($con, "SELECT pc.nombre as nombreUsuario,
      tu.nombreTipo as tipoUsuario, tu.idTipoUsuario FROM usuarios as u LEFT JOIN
      tipo_usuario as tu ON tu.idTipoUsuario = u.idTipoUsuario
      LEFT JOIN personacompleta as pc ON pc.idPersona = u.idPersona WHERE idUsuario = ?",
      'i', [$_SESSION['idUsuario']]);

    $_SESSION['nombreUsuario'] = $res[0]['nombreUsuario'];
    $_SESSION['tipoUsuario'] = $res[0]['tipoUsuario'];

    if(isset($_POST['tipoAdministracion'])){
      if($_POST['tipoAdministracion']==1) {
        $_SESSION['tipoUsuario'] = 'Super Administrador';
        $_SESSION['idTipoUsuario'] = 1;
      }else if($_POST['tipoAdministracion']==2) {
        $_SESSION['tipoUsuario'] = 'Administrador Senior';
        $_SESSION['idTipoUsuario'] = 2;
      }else if($_POST['tipoAdministracion']==4) {
        $_SESSION['tipoUsuario'] = 'Administrador';
        $_SESSION['idTipoUsuario'] = 4;
      }else{
        $_SESSION['tipoUsuario'] = 'Profesor';
        $_SESSION['idTipoUsuario'] = 3;
        if(isset($_SESSION['idSede'])){
          unset($_SESSION['idSede']);
          unset($_SESSION['nombreSede']);
        }
      }
    }

  include 'templates/top.php';
?>
<meta name="viewport" contet="width=device-width initial-scale=1">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
<?php
if($_SESSION['idTipoUsuario'] == 2)
{
  if($busca_usuario = $con ->query("SELECT * FROM terminos_condiciones WHERE
     id_usuario='$_SESSION[idUsuario]' AND tipo_usuario='$_SESSION[idTipoUsuario]' AND acepta=1
     OR id_usuario='$_SESSION[idUsuario]' AND tipo_usuario='$_SESSION[idTipoUsuario]' AND acepta=2"))
    {
      $encuentra = $busca_usuario ->num_rows;
      if($encuentra==0 || $encuentra==1)
      {?>
        <div class="alert alert-danger" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
           <strong>ATENCIÓN!</strong>

           <p>Le informamos que aún no ha Aceptado los Terminos y Condiciones y Los Avisos de Privacidad
              por lo que le sugerimos ir al menú PERFIL y en el apartado "LEGAL", leer y aceptar los documentos.
              O bien dando clic <a type="button" href="terminos.php">AQUÍ</a>. GRACIAS!!
           </p>
        </div>
<?php }
      $busca_usuario ->close();
    }
    $con ->close();
}
?>
  <div class="logo-container"> <i class="fa fa-home"></i> </div>
  <div class="text-container"> INICIO</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 home-container">
<?php if($_SESSION['tipoUsuario']!='Profesor'): ?>

  <h2>Administración General</h2>
  <div class="mainlogo-container" style = "height: 67px;">

  </div>
  <h2>Sucursal (es)</h2>
  <div class="mainlogo-container-two" style = "height: 67px;">

  </div><br><br><br><br><br>
  <?php endif; ?>

  <?php if($_SESSION['esProfesorYUsuario']): ?>
    <h2>Cambiar Tipo de Usuario</h2>
    <div class = 'mainlogo-container-three'>
      <?php if($res[0]['idTipoUsuario']===1): ?>
        <form action = 'home.php' method = 'post'>
          <input type = 'hidden' name = 'tipoAdministracion' value = "1"/>
          <div class = 'card <?php if($_SESSION['idTipoUsuario']==1){echo "is-selected";}?>'>
            <input type = 'submit' class = 'btn-primary btn' value = 'Super administrador'/>
          </div>
        </form>
      <?php endif; ?>
      <?php if($res[0]['idTipoUsuario']===2): ?>
        <form action = 'home.php' method = 'post'>
          <input type = 'hidden' name = 'tipoAdministracion' value = "2"/>
          <div class = 'card <?php if($_SESSION['idTipoUsuario']==2){echo "is-selected";}?>'>
            <input type = 'submit' class = 'btn-primary btn' value = 'Administrador Senior'/>
          </div>
        </form>
      <?php endif; ?>
        <form action = 'home.php' method = 'post'>
          <input type = 'hidden' name = 'tipoAdministracion' value = "3"/>
          <div class = 'card <?php if($_SESSION['idTipoUsuario']==3){echo "is-selected";}?>'>
            <input type = 'submit' class = 'btn-primary btn' value = 'Profesor'/>
          </div>
        </form>
      <?php if($res[0]['idTipoUsuario']===4): ?>
        <form action = 'home.php' method = 'post'>
          <input type = 'hidden' name = 'tipoAdministracion' value = "4"/>
          <div class = 'card <?php if($_SESSION['idTipoUsuario']==4){echo "is-selected";}?>'>
            <input type = 'submit' class = 'btn-primary btn' value = 'Administrador'/>
          </div>
        </form>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</div>


<script>
  $(document).ready(function (){
    <?php if($_SESSION['tipoUsuario']!="Profesor"): ?>
      Utilizer.getResponse('selectSedesAdministrador', {}, loadSedes);
      function loadSedes(datas){
        //console.log(datas);
        var nombreActual = "<?php if(isset($_SESSION['nombreSede'])){
          echo $_SESSION['nombreSede'];
        }else{
          echo "N/A";
        };?>";

        $(".mainlogo-container").append("<form action = 'home.php' method='post'><div class ='card'><input type = 'hidden' name = 'idSede' value = '-1'/><input type = 'submit' class = 'btn-primary btn' value = 'Administración General'/></div></form>");
        datas.sort(function (a,b){
          return a.nombreSede.localeCompare(b.nombreSede);
        });

        for(var i = 0;i<datas.length;i++){
          var data = datas[i];
         $(".mainlogo-container-two").append("<form action = 'home.php' method='post'><input type = 'hidden' name = 'idSede' value = '"+data.idSede+"'/><div class = 'card'><input type = 'submit' class = 'btn-primary btn' value = '"+data.nombreSede+"'/></div></form>");
        }

        $(".card").each(function(){
            if($(this).find('.btn-primary').val()=="<?php echo isset($_SESSION['nombreSede'])?$_SESSION['nombreSede']:"";?>"){
              $(this).addClass('is-selected');
            }
        });
      }
    <?php endif; ?>
  });
</script>
<?php
//var_dump($_SESSION);
 include 'templates/bottom.php';
?>
