<?php include 'templates/top.php'; ?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-container">
    <div class="logo-container"> <i class="fa fa-user"></i> </div>
    <div class="text-container"> VER TABLAS </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
    <table class="table table-hover table-responsive" id="tablasVer">
      <thead>
        <tr class="table-header">
          <th >TABLA</th>
          <th >ESTADO</th>
          <th >ACCIONES</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="table-header">
          <th >TABLA</th>
          <th >ESTADO</th>
          <th >ACCIONES</th>
        </tr>
      </tfoot>
      <tbody> </tbody>
    </table>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="modalAgregar">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-user-circle"></i> </div>
            <div class="text-container"> AGREGAR TABLA </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <legend><b><div id = 'nombreTabla'>nombreTabla</div></b></legend>
                  <div id = 'scriptAgregar'>scriptAgregar</div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" id="agregarTabla">AGREGAR TABLA</button>
              </div>
            </fieldset>
          </div>
        </div>
        <div class="modal-footer"> </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="modalAgregar">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-user-circle"></i> </div>
            <div class="text-container"> AGREGAR TABLA </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <legend><b><div id = 'nombreTabla'>nombreTabla</div></b></legend>
                  <div id = 'scriptAgregar'>scriptAgregar</div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                <button type="button" class="btn btn-save" id="agregarTabla">AGREGAR TABLA</button>
              </div>
            </fieldset>
          </div>
        </div>
        <div class="modal-footer"> </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  <div class="modal fade" tabindex="-1" role="dialog" id="modalModificar">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-user-circle"></i> </div>
            <div class="text-container"> MODIFICAR TABLA </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <legend><b><div id = 'nombreTablaMod'>nombreTabla</div></b></legend>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
                <table class="table table-hover table-responsive" id="tablaDetallesVer">
                  <thead>
                    <tr class="table-header">
                      <th>COLUMNA</th>
                      <th>ESTADO</th>
                      <th >SCRIPT</th>
                      <th >ACCIONES</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr class="table-header">
                      <th >COLUMNA</th>
                      <th >ESTADO</th>
                      <th >SCRIPT</th>
                      <th >ACCIONES</th>
                    </tr>
                  </tfoot>
                  <tbody> </tbody>
                </table>
              </div>
            </fieldset>
          </div>
        </div>
        <div class="modal-footer"> </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  <div class="modal fade" tabindex="-1" role="dialog" id="modalData">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        </div>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-title-container">
            <div class="logo-container"> <i class="fa fa-user-circle"></i> </div>
            <div class="text-container"> DATOS DE TABLA </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 modal-content-container">
            <fieldset>
              <div class="col-xs-12 col-sm-12 col-md-12 input-container">
                  <legend><b><div id = 'nombreTablaDatos'>nombreTabla</div></b></legend>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-container">
                <table class="table table-hover table-responsive" id="tablaDatosVer">
                  <thead>
                    <tr class="table-header">
                      <th>PRIMARY</th>
                      <th>DATA</th>
                      <th>EXISTE ORIGEN</th>
                      <th>EXISTE COMPARE</th>
                      <th>ACCIONES</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr class="table-header">
                      <th>PRIMARY</th>
                      <th>DATA</th>
                      <th>EXISTE ORIGEN</th>
                      <th>EXISTE COMPARE</th>
                      <th>ACCIONES</th>
                    </tr>
                  </tfoot>
                  <tbody> </tbody>
                </table>
              </div>
            </fieldset>
          </div>
        </div>
        <div class="modal-footer"> </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  <!-- /.modal -->
  <?php include 'templates/bottom.php'; ?>
    <script>
      $(document).ready(function (){
          tableUtilities.createTable('tablasVer', ['table', 'cambiar', 'acciones'], ['cambiar']);
          tableUtilities.createTable('tablaDetallesVer', ['column', 'estado', 'script', 'acciones']);
          tableUtilities.createTable('tablaDatosVer', ['primary', 'data', 'existeOrigen', 'existeCompare', 'acciones']);
          tableUtilities.loadScript('tablasVer', 'compareDatabases', {}, loadScript);
      });



      function loadScript(data){
        data.buttons = [];
        if(data.data.existe){
          var modificar = 0, keys = Object.keys(data.data.columns);
          for(var i = 0;i<keys.length;i++){
              if(data.data.columns[keys[i]].modifyScript!==false){
                modificar++;
              }
          }
          if(modificar>0){
            data.cambiar = "Modificar";
            data.buttons.push(['Ver scripts', 'btn-mod', modalModificaciones]);
            data.buttons.push(['Ver datos', 'btn-edit', modalDatos]);
          }else{
            data.cambiar = "SIN CAMBIOS";
            data.buttons.push(['Ver datos', 'btn-edit', modalDatos]);
          }
        }else{
          data.cambiar = "AGREGAR";
          data.buttons.push(['Ver script', 'btn-mod', modalAgregar]);
        }
        return data;
      }

      function modalModificaciones(data){
        if(data.type===undefined){
          var keys = Object.keys(data);
          for(var i = 0;i<keys.length;i++){
            //console.log(data[keys[i]]);
            if(data[keys[i]].table==$("#nombreTablaMod").text()){
              data = data[keys[i]];
              break;
            }
          }
        }else{
          data = tableUtilities.getDataFromEvent(data);
        }
        var keys = Object.keys(data.data.columns);
        $("#nombreTablaMod").text(data.table);
        tableUtilities.clearTable('tablaDetallesVer');
        var cols = 0;
        for(var i = 0;i<keys.length;i++){
          var actual = {};
          //console.log(data.data.columns[keys[i]]);
          actual.column = keys[i];
          if(data.data.columns[keys[i]].modifyScript){
              actual.estado = "<span style = 'color:red;'>DESACTUALIZADO</span>";
              actual.script = data.data.columns[keys[i]].modifyScript;
              tableUtilities.addRow('tablaDetallesVer', actual, [['Actualizar', 'btn-edit', modificarScript]]);
          }else{
            cols++;
              actual.estado = "<span style = 'color:green;'>ACTUALIZADO</span>";
              actual.script = "N/A";
              tableUtilities.addRow('tablaDetallesVer', actual, []);
          }
        }
        if(cols!=keys.length){
          tableUtilities.draw('tablaDetallesVer');
          $("#modalModificar").modal('show');
        }else{
          $("#modalModificar").modal('hide');
              tableUtilities.loadScript('tablasVer', 'compareDatabases', {}, loadScript);
        }
      }

      function modificarScript(data){
          data = tableUtilities.getDataFromEvent(data);
          var send = {};
          send.nombreTabla = $("#nombreTablaMod").text();
          send.nombreColumna = data.column;
          Utilizer.sendData('updateDatabases', send, afterModify);
      }

      function modalAgregar(data){
        data = tableUtilities.getDataFromEvent(data);
        $("#nombreTabla").text(data.table);
        $("#scriptAgregar").text(data.data.create);
        $("#modalAgregar").modal('show');
      }

      function modalDatos(data){
          data = tableUtilities.getDataFromEvent(data);
            $("#nombreTablaDatos").text(data.table);
          Utilizer.getResponse('dataDatabases', {nombreTabla:data.table}, loadDatos);
      }

      function loadDatos(data){
        tableUtilities.clearTable('tablaDatosVer');
        var dataOrigen =data.dataOrigen.data, dataComparar = data.dataComparar.data, rows = [], enCompare;
        for(var i = 0;i<dataOrigen.length;i++){
          enCompare = false;
          for(var j = 0;j<dataComparar.length;j++){
              if(_.isEqual(dataOrigen[i],dataComparar[j])){
                enCompare = true;
                rows.push({
                    primary:data.dataOrigen.primary,
                    data: JSON.stringify(dataOrigen[i]),
                    existeOrigen:'<span style = "color:green">SI</span>',
                    existeCompare:'<span style = "color:green">SI</span>',
                    acciones: 0
                });
              }
          }
          //['primary', 'data', 'existeOrigen', 'existeCompare', 'acciones']
          if(!enCompare){
            rows.push({
                primary:data.dataOrigen.primary,
                data: JSON.stringify(dataOrigen[i]),
                existeOrigen:'<span style = "color:green">SI</span>',
                existeCompare:'<span style = "color:red">NO</span>',
                acciones: 1
            });
          }
        }

          for(var j = 0;j<dataComparar.length;j++){
              enOrigen = false;
              for(var i = 0;i<dataOrigen.length;i++){
                  if(_.isEqual(dataOrigen[i],dataComparar[j])){
                    enOrigen = true;
                    break;
                  }
                }
          //['primary', 'data', 'existeOrigen', 'existeCompare', 'acciones']
          if(!enOrigen){
            rows.push({
                primary:data.dataOrigen.primary,
                data: JSON.stringify(dataComparar[j]),
                existeOrigen:'<span style = "color:red">NO</span>',
                existeCompare:'<span style = "color:green">SI</span>',
                acciones: 2
            });
          }
        }
        for(var i = 0;i<rows.length;i++){
          buttons = [];
          rows[i].data = rows[i].data.replace(/,"/g, ',<br>"');
          switch(rows[i].acciones){
            case 0:

            break;
            case 1:
              buttons.push(['Agregar', 'btn-save agregar', agregarDato]);
            break;
            case 2:
              buttons.push(['Borrar', 'btn-danger borrar', borrarDato]);
            break;
          }
            tableUtilities.addRow('tablaDatosVer', rows[i], buttons);
        }
        tableUtilities.draw('tablaDatosVer');
        //console.log(rows);
        $("#modalData").modal('show');
      }

      function agregarDato(){

      }
      function borrarDato(){

      }


        $("#agregarTabla").click(function (){
            var data = {};
            data.nombreTabla = $("#nombreTabla").text();
            data.nombreColumna = "";
            Utilizer.sendData('updateDatabases', data, reload);
          });


          function afterModify(){
            Utilizer.getResponse('compareDatabases', {}, modalModificaciones);
          }

          function reload(){
            $(".modal.in").modal('hide');
            tableUtilities.loadScript('tablasVer', 'compareDatabases', {}, loadScript);
          }
      </script>
