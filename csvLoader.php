<?php include "templates/top.php"; ?>
  <div class="container outside">
    <div class="contianer mar-bot-xl">
      <div class="row">
        <div class="titleSectionMain">
          <div class="iconTitleSectionMain"> <i class="fa fa-upload fa-2x"></i> </div>
          <div class="textTitleSectionMain">
            <h3><span id = 'l_tituloCentroCarga'></span></h3> </div>
        </div>
      </div>
    </div>
    <div class="container mar-bot-xl">
      <fieldset>
        <legend class="modal-legend"><span id='l_legDescargarCSVImportacion'></span></legend>
        <div class="row mar-left">
          <div class="row mar-bot no-leftp col-xs-12 col-sm-12 col-md-12">
            <form action="queries/descargaFormatoCsv.php" method="post">
              <div class="col-xs-6 col-sm-6 col-md-2" style="text-align:center;">
                <button type="submit" name="csv" value="clientes" class="btn btn-success"><i class="fa fa-user fa-2x"></i><span id='l_botonClientes'></span></button>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-2" style="text-align:center;">
                <button type="submit" name="csv" value="pacientes" class="btn btn-success"><i class="fa fa-stethoscope fa-2x"></i><span id='l_botonPacientes'></span></button>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-2" style="text-align:center;">
                <button type="submit" name="csv" value="hipicos" class="btn btn-success"><i class="fa fa-home fa-2x"></i><span id='l_botonCentroEcuestres'></span></button>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-2" style="text-align:center;">
                <button type="submit" name="csv" value="servicios" class="btn btn-success"><i class="fa fa-heart-o fa-2x"></i><span id='l_botonServicios'></span></button>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-2" style="text-align:center;">
                <button type="submit" name="csv" value="materiales" class="btn btn-success"><i class="fa fa-inbox fa-2x"></i><span id='l_botonMateriales'></span></button>
              </div>

            </form>
          </div>
        </div>
      </fieldset>
    </div>
    <div class="container mar-bot-xl">
      <legend class="modal-legend"><span id='l_legDetalleCentro'></span></legend>
      <fieldset> </fieldset>
    </div>
    <div class="contianer mar-bot-xl">
      <div class="row">
        <input type="file" id='csvUpload' /> </div>
      <br>
      <div id="answer"> </div>
    </div>
  </div>
  <script>
    $(document).ready(function () {
      Csser.collapse(4);
      $("#csvUpload").fileinput({
        'maxFileCount': 4
        , 'uploadUrl': 'uploader/csv.php'
        , 'language': 'es'
      });
      $('#csvUpload').on('fileloaded', function (event, file, previewId, index, reader) {
        /*
        console.log();
        console.log("fileloaded");
        console.log(event);
        console.log(file);
        console.log(previewId);
        console.log(index);
        console.log(reader);
        */
      });
      $('#csvUpload').on('fileuploaded', function (event, data, previewId, index) {
        var response = data.response;
        console.log(response);
        //Checar nuevos
        var str1 = Languagizer.languagePack['l_legSeHaIdentificado'];
        var str = str1 + "[" + response['csvName'] + "]<br><br>"; //Header
        var current;
        var continuar = true;
        current = response['validacion'];
        if (current !== undefined && Object.keys(current).length > 0) { //Datos invalidos
          str = Languagizer.languagePack['l_legErrorValidacion'];
          str += "<br>" + Languagizer.languagePack['l_legListaColumnasInvalidas'] + "<br>";
        }
        for (var key in current) {
          str += Languagizer.languagePack['l_legLinea'] + key + ": " + current[key] + "<br>";
        }
        if (current !== undefined && Object.keys(current).length > 0) {
          str += "<br>";
          continuar = false;
        }
        if (response['noRepetir'] !== undefined) { //Se repiten datos en el csv
          if (response['noRepetir']['csv'] !== undefined) {
            current = response['noRepetir']['csv'];
            for (var key in current) {
              //console.log(key, response['new'][key]);
              str += Languagizer.languagePack['l_legCSVRepite'] + " [<b>" + key + "</b>]: <br>";
              for (var k in current[key]) {
                str += "Linea " + k + ": " + current[key][k] + "<br>";
              }
              str += "<br>";
            }
            continuar = false;
          }
        }
        if (response['noExiste'] !== undefined) {
          current = response['noExiste'];
          for (var key in current) {
            //console.log(key, response['new'][key]);
            str += Languagizer.languagePack['l_legErrorBaseDatos'] + "[<b>" + key + "</b>]" + Languagizer.languagePack['l_legNoExistenRegistros'] + "<br>";
            for (var k in current[key]) {
              str += "Linea " + k + ": " + current[key][k] + "<br>";
            }
            str += "<br>";
          }
          continuar = false;
        }
        if (continuar) { //Continuar significa que no hay errores fatales
          current = response['new'];
          for (var key in current) {
            //console.log(key, response['new'][key]);
            str += "[<b>" + key + "</b>] se crearan los siguientes registros: <br>";
            for (var k in current[key]) {
              str += "Linea " + k + ": " + current[key][k] + "<br>";
            }
            str += "<br>";
          }
          if (response['noRepetir'] !== undefined) {
            if (response['noRepetir']['db'] !== undefined) {
              current = response['noRepetir']['db'];
              for (var key in current) {
                //console.log(key, response['new'][key]);
                str += Languagizer.languagePack['l_legBaseDatosEn'] + " [<b>" + key + "</b>] " + Languagizer.languagePack['l_legYaExistenRegistros'] + "<br>";
                for (var k in current[key]) {
                  str += Languagizer.languagePack['l_legLinea'] + k + ": " + current[key][k] + "<br>";
                }
                str += "<br>";
              }
            }
          }
          current = response['warning'];
          for (var key in current) {
            //console.log(key, response['new'][key]);
            str += Languagizer.languagePack['l_legBaseDatosAdvertencia'] + " [<b>" + key + "</b>] " + Languagizer.languagePack['l_legExistenRegitrosInfo'] + " <br>";
            for (var k in current[key]) {
              str += "Linea " + k + ": " + current[key][k] + "<br>";
            }
            str += "<br>";
          }
        }
        else {
          str += Languagizer.languagePack['l_legPorFavorCorrija'] + ".<br><br>";
        }
        $("#answer").html(str);
        if (response['fileName'] !== "" && continuar) {
          $("#answer").append("<button type = 'button' class = 'btn btn-success' id = 'deploy'>" + Languagizer.languagePack['l_botonCargar'] + response['csvName'] + "</button>");
          $("#deploy").click(subirArchivo);
          $("#deploy").data('file', response.fileName);
        }
      });

      function subirArchivo() {
        console.log("subirArchivo");
        Utilizer.getResponse('csvContinue', {
          'fileName': $("#deploy").data('file')
        }, afterSubir);
      }

      function afterSubir(data) {
        var response = data;
        //Checar nuevos
        var str = "Carga completada";
        $("#answer").html(str);
        /**/
      }
    });
  </script>
  <?php include "templates/bottom.php"; ?>
