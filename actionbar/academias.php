<script>
  $(document).ready(function () {
    $("#barClientesAlumnos").addClass('is-selected');
  });
</script>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <?php
    $menu['academias'] = [
      [
        "href"=>'academiasVerClientes',
        "icon"=>'user',
        "text"=>'CLIENTES'
        "list"=>[
          ["text"=>"AGREGAR CLIENTE", "href"=>"academiasAgregarClientes"]
        ]
      ],
      [
        "href"=>'academiasVerAlumnos',
        "icon"=>'users',
        "text"=>'ALUMNOS'
        "list"=>[
          ["text"=>"AGREGAR ALUMNO", "href"=>"academiasAgregarAlumno"]
        ]
      ],
      [
        "href"=>'academiasEquiposVer',
        "icon"=>'sitemap',
        "text"=>'EQUIPOS'
        "list"=>[
          ["text"=>"AGREGAR EQUIPO", "href"=>"academiasEquiposAgregar"]
        ]
      ],
      [
        "href"=>'academiasGruposVer',
        "icon"=>'users',
        "text"=>'GRUPOS'
        "list"=>[
          ["text"=>"AGREGAR GRUPO", "href"=>"academiasGruposAgregar"]
        ]
      ],
      [
        "href"=>'academiasInscribirEquipoGrupo',
        "icon"=>'plus-circle',
        "text"=>'INSCRIBIR EQUIPO A GRUPO'
        "list"=>[]
      ],
      [
        "href"=>'academiasVerGrupo',
        "icon"=>'user-circle',
        "text"=>'GESTIONAR GRUPOS'
        "list"=>[]
      ],
      [
        "href"=>'academiasVerEquipo',
        "icon"=>'sitemap',
        "text"=>'GESTIONAR EQUIPOS'
        "list"=>[]
      ]];
  ?>
</div>
