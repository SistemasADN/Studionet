<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $menus['perfil'] = [
    [
      "href"=>'perfilCambiarContrasena',
      "icon"=>'cog',
      "text"=>'CAMBIAR CONTRASE&Ntilde;A',
      "list"=>[]
    ],
    [
      "href"=>'perfilConfiguracionPagos',
      "icon"=>'wrench',
      "text"=>'CONFIGURACI&Oacute;N DE PAGOS',
      "list"=>[]
    ],
  ];
?>
  <!-- End Cambiar COntrasena Menu -->
<?php if($_SESSION['idTipoUsuario']==1){ ?>
  <!-- Configuracion de Pagos Start -->

    <button class="panel-heading catalogo" data-parent="#accordion" data-toggle="collapse" href="#collapse22["href"=>'perfilConfiguracionPagos',

         <i class="fa fa-wrench"></i> </div>
        ', "text"=>' CONFIGURACI&Oacute;N DE PAGOS </div>
      </div>
    </button>
    2Two">

        <div class="list-group">
          <!--<a href="./administracionCartasCobroGenerar.php">
            <button type="button" class="list-group-item">
              <div class="textaction"> GENERAR CARTA DE COBRO </div>
            </button>
          </a>--></div>
      </div>
    </div>
  </div>
  <!-- End Configuracion de Pagos Menu -->
<?php } ?>
  <!-- Cambiar COntrasena Start -->
  <!--
    <button class="panel-heading catalogo" data-parent="#accordion" data-toggle="collapse" href="#collapse11["href"=>'perfilCambiarContrasena',

         <i class="fa fa-cog"></i> </div>
        ', "text"=>' CAMBIAR CONTRASE&Ntilde;A </div>
      </div>
    </button>
    1One">

        <div class="list-group">-->
          <!--<a href="./administracionCartasCobroGenerar.php">
            <button type="button" class="list-group-item">
              <div class="textaction"> GENERAR CARTA DE COBRO </div>
            </button>
          </a>--><!--</div>
      </div>
    </div>
  </div>-->
  <!-- End Cambiar COntrasena Menu -->
</div>
<!-- Accordion End -->
