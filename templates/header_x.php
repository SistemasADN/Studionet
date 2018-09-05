<!--  STATIC NAVBAR -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class= "full-height">
      <div class="navbar-header full-height">
        <!-- Collapse Button for Small Screens-->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!-- Name -->
        <a class="navbar-brand" href="home.php">
          <!--<img class='logo' src='images/logoHome.png'></img>-->
        </a>
      </div>

      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <?php
          //Por: idTipoUsuario
          //1 = Super administrador
            $clearUsuario[1] = [];
            //asistencia
          //2 = Administrador
            $clearUsuario[2] = ['asistencia'];
          //3 = Profesor
            $clearUsuario[3] = ['agenda', 'administracion', 'clientesAlumnos', 'catalogos'];
          //4 Administrador
            //$clearUsuario[4] = ['agenda', 'clientesAlumnos', 'catalogos'];
            $clearUsuario[4] = ['agenda'];
            //5 Soporte
            $clearUsuario[5] = [];
          //Por: idSede

          // -1 = General
          $clearSede['-1'] =    ['agenda', 'gestion'];
          // #  = Sede
          $clearSede['Sede'] =  ['asistencia'];

          //for($i=1;$i<=4;$i++){ $clearUsuario[$i] = []; }
          //$clearSede['-1'] = [];  $clearSede['Sede'] = [];
          $navBar = [
            ['text' => 'INICIO', 'icon' => 'home',
          	'href' => 'home',
          	'id' => 'home'],

            ['text' => 'AGENDA', 'icon' => 'calendar',
          	'href' => 'agendaMain',
          	'id' => 'agenda'],

            ['text' => 'HORARIOS E INSCRIPCIONES',
          	'icon' => 'clock-o',
          	'href' => 'gestionMain',
          	'id' => 'gestion'],

            ['text' => 'ASISTENCIAS',
            'icon' => 'list-alt',
            'href' => 'asistenciaMain',
            'id' => 'asistencia'],

          	['text' => 'ADMINISTRACI&Oacute;N',
          	'icon' => 'usd',
          	'href' => 'administracionMain',
          	'id' => 'administracion'],

          	['text' => 'CLIENTES Y ALUMNOS',
          	'icon' => 'users',
          	'href' => 'clientesAlumnosMain',
          	'id' => 'clientesAlumnos'],

          	['text' => 'CAT&Aacute;LOGOS',
          	'icon' => 'file-text-o',
          	'href' => 'catalogoMain',
          	'id' => 'catalogos'],

          	['text' => 'PERFIL',
          	'icon' => 'cogs',
          	'href' => 'perfilMain',
          	'id' => 'perfil'],

            ['text' => 'AYUDAS',
            'icon' => 'question-circle',
            'id' => 'ayuda',
            'onClick' =>'Tutorializer.startTutorial();'],

          	['text' => 'SALIR',
          	'icon' => 'sign-out',
          	'href' => 'queries/logout',
          	'id' => 'salir']];

            foreach($navBar as $nav){
              //Quitar permisos por Usuario
              if(in_array($nav['id'], $clearUsuario[$_SESSION['idTipoUsuario']])){
                continue;
              }
              //Quitar permisos por Sede (Saltar si no existe)
              if(!isset($_SESSION['idSede'])&&$_SESSION['tipoUsuario']!="Profesor"){
                continue;
              }else{
                if($_SESSION['idTipoUsuario']!=3){
                  if(in_array($nav['id'], $clearSede[$_SESSION['idSede']==-1?"-1":"Sede"])){
                    continue;
                  }
                }
              }

              echo '<li class="menu-item" id="bar'.$nav['id'].'" ';
              if(isset($nav['onClick'])){
                echo "onClick = '".$nav['onClick']."'";
              }
              echo ">";
              if(isset($nav['href'])){
                echo '<a href="'.$nav['href'].'.php">';
              }else{
                echo '<a>';
              }
              echo '<i class="fa fa-'.$nav['icon'].' fa-3x"></i><div class="menu-text-item">';
              echo $nav['text'].'</div></a></li>';
            }
          ?>
        </ul>
      </div><!--/.nav-collapse -->

      <div class = "fixed-badge">
          <div id = "actualNombreUsuario"><?php echo $_SESSION['nombreUsuario']; ?></div>
          <div id = "actualTipoUsuario"><?php echo $_SESSION['tipoUsuario']; ?></div>
          <div id = "actualSede"><?php
          if($_SESSION['tipoUsuario']!="Profesor"){
              if(isset($_SESSION['nombreSede'])){
                echo $_SESSION['nombreSede'];
              }else{
                echo "No se ha seleccionado una sede.";
              }
           }
            ?></div>
      </div>
    </div>
</nav>
