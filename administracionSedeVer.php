<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-cog"></i> </div>
    <div class="text-container"> SEDES ADMINISTRADOR </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-container">
    <div class="col-xs-12 col-sm-12 col-md-8 form-container">
      <fieldset>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="jumbotron jumbotron-container">
            <div class="jumbotron-text"> EDITAR SEDES DE ADMINISTRADOR </div>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container" id="sedesContainer">
          <table class="table table-hover table-responsive form-input"
          data-keys = 'idAdmin,sedes' data-unique = 'idAdmin' id="adminSedes">
            <thead>
              <tr class="table-header">
                <th class="table-column-title">ADMINISTRADOR</th>
                <th class="table-column-title">TIPO</th>
                <th class="table-column-title">SEDE</th>
              </tr>
            </thead>
            <tfoot>
              <tr class="table-header">
                <th class="table-column-title">ADMINISTRADOR</th>
                <th class="table-column-title">TIPO</th>
                <th class="table-column-title">SEDE</th>
              </tr>
            </tfoot>
            <tbody> </tbody>
          </table>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 input-container">
          <button type="button" class="btn btn-save" data-form="form-input"
            data-script="administradorSede" data-function = "loadTable" data-clear="true" id="guardarSedes">
            GUARDAR CAMBIOS
          </button>
        </div>

      </fieldset>
    </div>
  </div>
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function () {
        FormEngine.setFormEngine('guardarSedes');
        Utilizer.getResponse('sedeSelect', {}, loadSelect);
      });
      function loadSelect(data){
          tableUtilities.createTable('adminSedes', ['nombreAdmin', 'nombreTipo', {
              key:'sedes',
              options:data,
              type:'checkbox'
           }
         ]);
        loadTable();
      }
      function loadTable(){
         tableUtilities.loadScript('adminSedes', 'getAdministradorSedes', {}, agregarSede);
      }
      function agregarSede(data){
        console.log(data);
        return data;
      }

    </script>
