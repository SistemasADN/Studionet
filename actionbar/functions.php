<?php

$listaUrls = ['home','administracionMain','administracionRecibosCobroVer','administracionRecibosCobroConceptosGenerar',
              'administracionIngresosVer','administracionIngresosCapturar','administracionEgresosVer','administracionCuentasCobrar',
              'administracionEstadoCuentaCliente','administracionEstadoCuentaEmpresa','administracionReportesFacturacion','administracionReportesFinanzas',
              'administracionReportesUtilidadesGrupo','administracionReportesVentas','administracionCuentasVer','administracionCuentasAgregar',
              'administracionEstadoCuentaSede','agendaMain','agendaVer','agendaEventoAgregar',
              'asistenciaMain','grupoListaAsistencia','grupoListaAsistenciaVer','grupoAlumnoListaAsistenciaVer',
              'catalogoMain','catalogoSedeVer','catalogoSedesAgregar','catalogoPersonalVer',
              'catalogoPersonalAgregar','catalogoDisciplinasVer','catalogoDisciplinasAgregar','catalogoAsignaturaVer',
              'catalogoAsignaturasAgregar','catalogoNivelesVer','catalogoNivelesAgregar','catalogoSalonesVer',
              'catalogoSalonesAgregar','catalogoClasesVer','catalogoClasesAgregar','catalogoEquiposVer',
              'catalogoEquiposAgregar','catalogoUsuariosVer','catalogoUsuariosAgregar','catalogoColegiosVer',
              'catalogoColegiosAgregar','catalogoGradosVer','catalogoGradosAgregar','catalogoConceptosVer',
              'catalogoConceptosAgregar','catalogoGruposVer','catalogoGruposAgregar','clientesAlumnosMain',
              'clientesAlumnosVerAlumnos','clientesAlumnosAgregarAlumno','clientesAlumnosVerClientes','clientesAlumnosAgregarClientes',
              'gestionMain','gestionAsignarHorario','inscribirEquipoGrupo','gestionVerHorarioSalon',
              'gestionVerHorarioProfesor','gestionVerHorarioAlumno','gestionVerGrupo','gestionVerEquipo',
              'perfilMain','perfilCambiarContrasena','perfilConfiguracionPagos','administracionSedeVer'];


/*
$tN = 0;
foreach($menus as $menuList){
  foreach($menuList as $menu){
    if(isset($menu['href'])){
      if(substr_count($text, $menu['href'])==0){
        $text .= "'".$menu['href']."',";
        $tN++;
        if($tN%4==0){
          $text .= "<br>";
        }
      }
    }

    if(isset($menu['list'])){
      foreach($menu['list'] as $miniMenu){
        if(substr_count($text, $miniMenu['href'])==0){
          $text .= "'".$miniMenu['href']."',";
          $tN++;
          if($tN%4==0){
            $text .= "<br>";
          }
        }
      }
    }
  }
}
/**/

$clearUsuario2 = array();
$clearSede2 = array();

foreach($clearUsuario as $idTipoUsuario =>$headerTable){
  $borrarArray = array();
  foreach($navBar as $k=>$nav){
    if($nav['id']=="salir"){
      continue;
    }//var_dump($headerTable);
      if(in_array($nav['id'], $headerTable)){ //echo "Proceder a insertar ".$nav['id']."<br>";//var_dump($menus[$nav['id']]);
      foreach($menus[$nav['id']] as $menu){ //echo "MENU";var_dump($menu);
          if(isset($menu['href'])){ //var_dump($menu['href']);
            if(!in_array($menu['href'], $borrarArray)){
              $borrarArray[] = $menu['href'];
            }
          }

          if(isset($menu['list'])){
            foreach($menu['list'] as $miniMenu){
              if(!in_array($miniMenu['href'], $borrarArray)){
                $borrarArray[] = $miniMenu['href'];
              }
            }
          }
        }
      }
    } //echo "BORRAR ARRAY DE ".$idTipoUsuario;var_dump($borrarArray);
    $clearUsuario2[$idTipoUsuario] = array_diff($listaUrls, $borrarArray);
}
foreach($clearSede as $sede =>$headerTable){
  $borrarArray = array();
  foreach($navBar as $k=>$nav){
    if($nav['id']=="salir"){
      continue;
    }//var_dump($headerTable);
      if(in_array($nav['id'], $headerTable)){ //echo "Proceder a insertar ".$nav['id']."<br>";//var_dump($menus[$nav['id']]);
      foreach($menus[$nav['id']] as $menu){ //echo "MENU";var_dump($menu);
          if(isset($menu['href'])){ //var_dump($menu['href']);
            if(!in_array($menu['href'], $borrarArray)){
              $borrarArray[] = $menu['href'];
            }
          }

          if(isset($menu['list'])){
            foreach($menu['list'] as $miniMenu){
              if(!in_array($miniMenu['href'], $borrarArray)){
                $borrarArray[] = $miniMenu['href'];
              }
            }
          }
        }
      }
    } //echo "BORRAR ARRAY DE ".$idTipoUsuario;var_dump($borrarArray);
    $clearSede2[$sede] = array_diff($listaUrls, $borrarArray);
}
//var_dump($clearUsuario2);
/**/

foreach($clearUsuario2 as $idTipoUsuario =>$perms){
  $text .= '<br>$clearUsuario['.$idTipoUsuario.'] = [';
  $nT = 0;
  foreach($perms as $k=>$v){
      $text.= "'".$v."',";
      $nT++;
      if($nT%4==0){
        $text.="<br>";
      }
  }
  $text.="];<br>";
}

foreach($clearSede2 as $tipoSede =>$perms){
  $text .= '<br>$clearSede['.$tipoSede.'] = [';
  $nT = 0;
    foreach($perms as $k=>$v){
      $text.= "'".$v."',";
      $nT++;
      if($nT%4==0){
        $text.="<br>";
      }
  }
  $text.="];<br>";
}
/**/
//var_dump($newPermisosUsuario);
//var_dump($newPermisosSede);
//var_dump($listaUrls);
?>
