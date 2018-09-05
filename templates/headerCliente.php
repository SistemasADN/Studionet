<!--  STATIC NAVBAR -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container full-height">
    <div class="navbar-header full-height">
      <!-- Collapse Button for Small Screens-->
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- Name -->
      <a class="navbar-brand" href="homeCliente.php">
        <img class='logo' src='images/logoHome.png'></img>
      </a>
    </div>

    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li class="menu-item" id="barAgendaCliente">
          <a href="agendaClienteMain.php">
            <i class="fa fa-calendar fa-3x"></i>
            <div class="menu-text-item">
              AGENDA Y HORARIO
            </div>
          </a>
        </li>
        <li class="menu-item" id="barAdministracionCliente">
          <a href="administracionClienteMain.php">
            <i class="fa fa-usd fa-3x"></i>
            <div class="menu-text-item">
              ESTADO DE CUENTA
            </div>
          </a>
        </li>
        <li class="menu-item" id="barReportesCliente">
          <a href="reportesClienteMain.php">
            <i class="fa fa-signal fa-3x"></i>
            <div class="menu-text-item">
              REPORTES
            </div>
          </a>
        </li>
        <li class="menu-item" id="barClientesAlumnosCliente">
          <a href="clientesAlumnosClienteMain.php">
            <i class="fa fa-users fa-3x"></i>
            <div class="menu-text-item">
              CLIENTE Y ALUMNO
            </div>
          </a>
        </li>
        <li class="menu-item" id="barPerfilCliente">
          <a href="perfilClienteMain.php">
            <i class="fa fa-cogs fa-3x"></i>
            <div class="menu-text-item">
              PERFIL
            </div>
          </a>
        </li>
        <li class="menu-item" id="barSalir">
          <a href="queries/logout.php">
            <i class="fa fa-sign-out fa-3x"></i>
            <div class="menu-text-item">
              SALIR
            </div>
          </a>
        </li>
      </ul>

    </div><!--/.nav-collapse -->
  </div>
</nav>