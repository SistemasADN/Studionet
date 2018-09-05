
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <!-- Ver Cartas de Cobro Start -->
<?php
  $currentPage = str_replace(".php","",basename($_SERVER['PHP_SELF']));

    $menus['administracion'] = [
      [
        "href"=>'administracionRecibosCobroVer',
        "icon"=>'ticket',
        "text"=>'CARTAS DE COBRO',
        "list"=>[
          ["href"=>'administracionRecibosCobroConceptosGenerar', "text"=>'GENERAR CARTA DE COBRO']
        ]
      ],
      [
        "href"=>'administracionIngresosVer',
        "icon"=>'plus',
        "text"=>'INGRESOS',
        "list"=>[
          ["href"=>'administracionIngresosCapturar', "text"=>'CAPTURAR INGRESO']
        ]
      ],
      [
        "href"=>'administracionEgresosVer',
        "icon"=>'minus',
        "text"=>'EGRESOS',
        "list"=>[
          ["href"=>'administracionEgresos', "text"=>'CAPTURAR EGRESO']
        ]
      ],
      [
        "href"=>'administracionCuentasCobrar',
        "icon"=>'user',
        "text"=>'CUENTAS POR COBRAR',
        "list"=>[]
      ],
      [
        "href"=>'administracionEstadoCuentaCliente',
        "icon"=>'list-ol',
        "text"=>'ESTADO DE CUENTA CLIENTE',
        "list"=>[]
      ],
      [
        "href"=>'administracionEstadoCuentaEmpresa',
        "icon"=>'list-ol',
        "text"=>'ESTADO DE CUENTA EMPRESA',
        "list"=>[]
      ],
      [
        "icon"=>'credit-card',
        "text"=>'REPORTES',
        "list"=>[
            ["href"=>'administracionReportesFacturacion', "text"=>'FACTURACIÓN'],
            ["href"=>'administracionReportesFinanzas', "text"=>'FINANZAS'],
            ["href"=>'administracionReportesVentas', "text"=>'VENTAS']
        ]
      ],
      [
        "href"=>'administracionCuentasVer',
        "icon"=>'credit-card',
        "text"=>'CUENTAS',
        "list"=>[
            ["href"=>'administracionCuentasAgregar', "text"=>'AGREGAR CUENTA']
        ]
      ],
      [
        "href"=>'administracionEstadoCuentaSede',
        "icon"=>'list-ol',
        "text"=>'ESTADO DE CUENTA SEDE',
        "list"=>[]
      ]
    ];







    $collapse = "";
    foreach($menus as $mainPage =>$menu){
      if($mainPage!="administracion"){
        $continue;
      }
      for($i=0;$i<count($menu);$i++){
          echo '<div class="panel panel-default catalogo"><button class="panel-heading catalogo" data-parent="#accordion" data-toggle="collapse" href="#collapse'.$i.'" aria-controls="collapse'.$i.'" type="button" data-toggle="collapse" aria-expanded="false"';
          if(isset($menu[$i]['href'])){
            if($menu[$i]['href']==$currentPage){
              $collapse = $i;
            }
            echo 'onclick="location.href = \''.$menu[$i]['href'].'.php\';"';
          }
          echo '><div class="container-fluid panel-title"><div class="container-fluid col-sm-3 col-md-4 col-lg-4 icon-heading"> <i class="fa fa-'.$menu[$i]['icon'].'"></i></div>';
          echo '<div class="container-fluid col-sm-9 col-md-8 col-lg-7 text-heading">'.$menu[$i]['text'].'</div></div></button>';
          echo '<div id="collapse'.$i.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$i.'"><div class="panel-body">';
          if(isset($menu[$i]['list'])){
            for($j=0;$j<count($menu[$i]['list']);$j++){
              if($menu[$i]['list'][$j]['href']==$currentPage){
                $collapse = $i.",".$j;
              }
              echo '<div class="list-group"><a href="./'.$menu[$i]['list'][$j]['href'].'.php">';
              echo '<button type="button" class="list-group-item"><div class="textaction"> '.$menu[$i]['list'][$j]['text'].'</div></button></a></div>';
            }
          }
          echo '</div></div></div>';
      }
   }
?>
</div>
<script>
$(document).ready(function (){
  <?php if($collapse>=0)echo "Csser.collapse(".$collapse.");"; ?>
});
</script>
