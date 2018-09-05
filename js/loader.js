var loaderUtilities = {};
var loaderList = {};

$(document).ready(function(){
  loaderUtilities.newLoader = function (id, loadedFunction) {
    console.log("NEW LOADER "+id);
      loaderList[id] = $("#"+id).fileinput({
        'maxFileCount': 4
        , 'uploadUrl': 'uploader/csv.php'
        , 'language': 'es'
      });
  $("#"+id).on('fileloaded', function (event, file, previewId, index, reader) {
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
  $("#"+id).on('fileuploaded', function (event, data, previewId, index) {
    var response = data.response;
    console.log(response);
    //Checar nuevos
    var str1 = "Se ha identificado el CSV como";
    var str = str1 + "[" + response['csvName'] + "]<br><br>"; //Header
    var current;
    var continuar = true;
    current = response['validacion'];
    if (current !== undefined && Object.keys(current).length > 0) { //Datos invalidos
      str = "Error de Validación";
      str += "<br>Lista de Columnas Invalidas<br>";
    }
    for (var key in current) {
      str +="Linea " + key + ": " + current[key] + "<br>";
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
          str += "En el CSV se repite la siguiente información que debe ser unica para [<b>" + key + "</b>]: <br>";
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
        str += "Error de Base de datos en: [<b>" + key + "</b>]no existen los siguiente registros:<br>";
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
            str += "Base de datos en la tabla: [<b>" + key + "</b>] ya existen los siguientes registros que deben ser únicos:<br>";
            for (var k in current[key]) {
              str += "Linea " + k + ": " + current[key][k] + "<br>";
              continuar = false;
            }
            str += "<br>";
          }
        }
      }
      current = response['warning'];
      for (var key in current) {
        //console.log(key, response['new'][key]);
        str += "Base de datos: Advertencia, en la tabla [<b>" + key + "</b>] existen registros con la siguiente información, pero serán creados de todas formas:  <br>";
        for (var k in current[key]) {
          str += "Linea " + k + ": " + current[key][k] + "<br>";
        }
        str += "<br>";
      }
    }
    else {
      str += "Por favor corrija los errores en el CSV para poder subir el archivo, de lo contrario no se continuará.<br><br>";
    }

    $("#answer"+id).html(str);

    if (response['fileName'] !== "" && continuar) {
      $("#answer"+id).append("<button type = 'button' class = 'btn btn-success' id = 'deploy"+id+"'>Cargar" + response['csvName'] + "</button>");
      $("#deploy"+id).click(function (){
        Utilizer.getResponse('csvContinue', {
          'fileName': $("#deploy"+id).data('file')
        }, function (data){
          var response = data;
          //Checar nuevos
          var str = "Carga completada";
          $("#answer"+id).html(str);
          if(loadedFunction!==undefined){
            loadedFunction(id);
          }
          /**/
        });
      });
      $("#deploy"+id).data('file', response.fileName);
    }else{
      console.log(response);
    }
  });

  }
});
