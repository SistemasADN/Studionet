var Utilizer = {};

$(document).ready(function() {
    Utilizer.horaInicio = 12;
    Utilizer.horaFinal = 47;

    $.fn.exists = function() {
            return this.length !== 0;
        }
        /** Function count the occurrences of substring in a string;
         * @param {String} string   Required. The string;
         * @param {String} subString    Required. The string to search for;
         * @param {Boolean} allowOverlapping    Optional. Default: false;
         */
    Utilizer.parseTextFechaToDbDate = function(date) {
        var arr = date.split("/");
        var num = Utilizer.shortMonths.indexOf(arr[0]) + 1;
        if (num < 10) {
            num = "0" + num;
        }
        return arr[1] + "-" + num + "-01";
    }

    Utilizer.generateTextoCalculoPagos = function(grupos, config) {
        //console.log("INICIO generateTextoCalculoPagos");console.log(grupos);console.log(config);
        var data = {},
            extras = {},
            extrasArr = [];
        data.txt = "";
        data.total = 0;
        for (var i = 0; i < grupos.length; i++) {
            data.txt += grupos[i].nombreGrupo;
            //console.log(config.calculo.idCalculoPagos);
            switch (config.calculo.idCalculoPagos) {
                case 1: //Cuota Fija Mensual Por Disciplina
                    data.txt += " (" + grupos[i].nombreDisciplina + ")";
                    if (extras[grupos[i].idDisciplina] === undefined) {
                        for (var j = 0; j < config.detalles.length; j++) {
                            if (config.detalles[j].idDisciplina == grupos[i].idDisciplina) {
                                extras[grupos[i].idDisciplina] = { cuota: config.detalles[j].cuota, nombre: grupos[i].nombreDisciplina };
                            }
                        }
                    }
                    break;

                case 3: //Cuota Por Días Por Disciplina
                    data.txt += " (" + grupos[i].nombreDisciplina + ")";
                    data.txt += " (";
                    for (var j = 0; j < grupos[i].dias.length; j++) {
                        data.txt += Utilizer.shortDays[grupos[i].dias[j]] + ",";
                        if (j == grupos[i].dias.length - 1) {
                            data.txt = data.txt.slice(0, -1);
                        }
                        if (extras[grupos[i].idDisciplina] === undefined) {
                            extras[grupos[i].idDisciplina] = { nombre: grupos[i].nombreDisciplina, dias: [] };
                        }
                        if (_.indexOf(extras[grupos[i].idDisciplina]['dias'], grupos[i].dias[j]) == -1) {
                            extras[grupos[i].idDisciplina]['dias'].push(grupos[i].dias[j]);
                        }
                    }
                    data.txt += ") ";
                    data.txt += grupos[i].dias.length + " día" + (grupos[i].dias.length == 1 ? '' : 's');
                    break;
                case 4: //Cuota Por Veces A La Semana Por Disciplina
                    data.txt += " (" + grupos[i].nombreDisciplina + ")";
                    data.txt += " " + grupos[i].horario.length + " ve" + (grupos[i].horario.length == 1 ? 'z' : 'ces');
                    if (extras[grupos[i].idDisciplina] === undefined) {
                        extras[grupos[i].idDisciplina] = {};
                        extras[grupos[i].idDisciplina]['veces'] = [];
                        extras[grupos[i].idDisciplina]['nombre'] = grupos[i].nombreDisciplina;
                    }
                    extras[grupos[i].idDisciplina]['veces'].push(grupos[i].horario.length);
                    break;

                case 5: //Cuota Por Total de Horas Semanales Por Disciplina
                    data.txt += " (" + grupos[i].nombreDisciplina + ")";
                    var totalHoras = 0;
                    for (var j = 0; j < grupos[i].horario.length; j++) {
                        totalHoras += Number(grupos[i].horario[j].duracion);
                    }
                    data.txt += " " + Utilizer.transFormNumberToHours(totalHoras) + " hora" + (totalHoras / 2 == 1 ? '' : 's');
                    if (extras[grupos[i].idDisciplina] === undefined) {
                        extras[grupos[i].idDisciplina] = {};
                        extras[grupos[i].idDisciplina]['horas'] = [];
                        extras[grupos[i].idDisciplina]['nombre'] = grupos[i].nombreDisciplina;
                    }
                    extras[grupos[i].idDisciplina]['horas'].push(totalHoras);
                    break;
            }
            data.txt += "<br>";
        } // for de grupos
        //Disciplinas y/o cosas extra
        switch (config.calculo.idCalculoPagos) {
            case 1: //Cuota Fija Mensual Por Disciplina
                var keys = Object.keys(extras);
                for (var i = 0; i < keys.length; i++) {
                    data.txt += "Cuota mensual (" + extras[keys[i]].nombre + ") " + Utilizer.numberToCoin(extras[keys[i]].cuota) + "<br>";
                    data.total += Number(extras[keys[i]].cuota);
                }
                break;
            case 2: //Cuota Mensual Por Clase

                break;

            case 3: //Cuota Por Días Por Disciplina
                //console.log("EXTRAS");console.log(extras);console.log("EXTRAS");
                var keys = Object.keys(extras);
                for (var i = 0; i < keys.length; i++) {
                    data.txt += extras[keys[i]].nombre;
                    data.txt += " (";
                    for (var j = 0; j < extras[keys[i]]['dias'].length; j++) {
                        data.txt += Utilizer.shortDays[extras[keys[i]]['dias'][j]] + ",";
                        if (j == extras[keys[i]]['dias'].length - 1) {
                            data.txt = data.txt.slice(0, -1);
                        }
                    }

                    data.txt += ") ";
                    data.txt += extras[keys[i]]['dias'].length + " día" + (extras[keys[i]]['dias'].length == 1 ? '' : 's');
                    data.txt += ": ";
                    for (var j = 0; j < config['detalles'].length; j++) {
                        if (config['detalles'][j].idDisciplina == keys[i] && extras[keys[i]]['dias'].length == config['detalles'][j].veceshorasdias) {
                            data.txt += Utilizer.numberToCoin(config['detalles'][j].cuota);
                            data.total += Number(config['detalles'][j].cuota);
                        }
                    }
                    data.txt += "<br>";
                    //data.txt += Utilizer.numberToCoin(extras[keys[i]].cuota)+"<br>";
                    //data.total += extras[keys[i]].cuota;
                }
                break;

            case 4: //Cuota Por Veces A La Semana Por Disciplina
                var keys = Object.keys(extras);
                for (var j = 0; j < keys.length; j++) {
                    var totalVeces = 0;
                    for (var i = 0; i < extras[keys[j]]['veces'].length; i++) {
                        totalVeces += Number(extras[keys[j]]['veces'][i]);
                    }
                    data.txt += "Total " + extras[keys[j]]['nombre'] + ": " + totalVeces + " ve" + (totalVeces == 1 ? 'z' : 'ces');
                    var max = { veces: 0, cuota: 0 };
                    for (var i = 0; i < config['detalles'].length; i++) {
                        if (config['detalles'][i].idDisciplina != keys[j]) {
                            continue;
                        }
                        if (config['detalles'][i].veceshorasdias > max.veces) {
                            max.veces = config['detalles'][i].veceshorasdias;
                            max.cuota = config['detalles'][i].cuota;
                        }
                        if (totalVeces == config['detalles'][i].veceshorasdias) {
                            break;
                        }
                    }
                    if (totalVeces > 0) {
                        data.txt += " " + Utilizer.numberToCoin(max.cuota);
                        data.total += Number(max.cuota);
                    } else {
                        data.txt += " " + Utilizer.numberToCoin(0);
                    }
                    data.txt += "<br>";
                }
                break;

            case 5: //Cuota Por Total de Horas Semanales Por Disciplina
                var keys = Object.keys(extras);
                for (var j = 0; j < keys.length; j++) {
                    var totalHoras = 0;
                    for (var i = 0; i < extras[keys[j]]['horas'].length; i++) {
                        totalHoras += Number(extras[keys[j]]['horas'][i]);
                    }
                    data.txt += "Total " + extras[keys[j]]['nombre'] + ": " + Utilizer.transFormNumberToHours(totalHoras) + " hora" + (totalHoras / 2 == 1 ? '' : 's');
                    totalHoras = totalHoras / 2;
                    var max = { veces: 0, cuota: 0 };
                    for (var i = 0; i < config['detalles'].length; i++) {
                        if (config['detalles'][i].idDisciplina != keys[j]) {
                            continue;
                        }
                        if (config['detalles'][i].veceshorasdias > max.veces) {
                            max.veces = config['detalles'][i].veceshorasdias;
                            max.cuota = config['detalles'][i].cuota;
                        }
                        if (Math.ceil(totalHoras) == config['detalles'][i].veceshorasdias) {
                            break;
                        }
                    }
                    if (totalHoras > 0) {
                        data.txt += " " + Utilizer.numberToCoin(max.cuota);
                        data.total += Number(max.cuota);
                    } else {
                        data.txt += " " + Utilizer.numberToCoin(0);
                    }
                    data.txt += "<br>";
                }
                break;
        }
        //console.log("Data generateTextoCalculoPagos");console.log(data);console.log("FIN generateTextoCalculoPagos");
        return data;
    }

    Utilizer.generateTextoPagos = function(opciones, config) {
        //console.log("generateTextoPagos");console.log(opciones);console.log(config);
        var txt = "";
        switch (config) {
            case 1:
                break;
            case 2:
                return Utilizer.numberToCoin(opciones[0].cuota);
                break;

            case 3:
                for (var i = 0; i < opciones.length; i++) {
                    txt += opciones[i].veceshorasdias + " día" + (opciones[i].veceshorasdias == 1 ? '' : 's') + ": " + Utilizer.numberToCoin(opciones[i].cuota) + "<br>";
                }
                return txt;
                break;

            case 4:
                for (var i = 0; i < opciones.length; i++) {
                    txt += opciones[i].veceshorasdias + " ve" + (opciones[i].veceshorasdias == 1 ? 'z' : 'ces') + ": " + Utilizer.numberToCoin(opciones[i].cuota) + "<br>";
                }
                return txt;
                break;

            case 5:
                for (var i = 0; i < opciones.length; i++) {
                    txt += opciones[i].veceshorasdias + " hora" + (opciones[i].veceshorasdias == 1 ? '' : 's') + ": " + Utilizer.numberToCoin(opciones[i].cuota) + "<br>";
                }
                return txt;
                break;
        }
    }

    Utilizer.testForm = function(id) {
        var clas = $("#" + id).data('form');
        $("." + clas + ":text").each(function() {
            if ($(this).hasClass('timepicker')) {
                $(this).val("7:00");
            } else if ($(this).parent().hasClass('date')) {
                $(this).val("11/11/11");
            } else {
                $(this).val("@");
            }
        });
        $("." + clas).each(function() {
            if ($(this).is(':text')) {
                $(this).val("@");
            }
            $(this).val(1.5);
        });
        $("#" + id).trigger('click');
    }

    Utilizer.days = ["LUNES", "MARTES", "MIERCOLES", "JUEVES", "VIERNES", "SABADO", "DOMINGO"];
    Utilizer.shortDays = ["LU", "MA", "MI", "JU", "VI", "SA", "DO"];

    /** Funcion que toma un pdf dentro de pdfedit/pdf y lo descarga en la computadora del usuario
     * @param {String} type   Required. Primer parte del nombre del archivo (Usado en pdfEngine.php;
     * @param {String} type   Required. Segunda parte del nombre del archivo (Usado en pdfEngine.php;
     */
    Utilizer.savePdfToDisk = function(type, params) {
        Utilizer.SaveToDisk('pdfedit/pdf/' + type + params + ".pdf", type + params + ".pdf");
    }

    /** Funcion que toma un csv dentro de csv/ y lo descarga en la computadora del usuario
     * @param {String} type   Required. Primer parte del nombre del archivo (Usado en csvEngine.php;
     * @param {String} type   Required. Segunda parte del nombre del archivo (Usado en csvEngine.php;
     */
    Utilizer.saveCsvToDisk = function(params) {
        Utilizer.SaveToDisk('csv/' + params + ".csv", params + ".csv");
    }

    /** Funcion que toma un csv dentro de csv/ y lo descarga en la computadora del usuario
     * @param {String} listaHorario   Required. Primer parte del nombre del archivo (Usado en csvEngine.php;
     */

    Utilizer.createTextFromHorario = function(listaHorario) {
        var txt = "",
            curday, actual, first = true;
        for (var i = 0; i < listaHorario.length; i++) {
            actual = listaHorario[i];

            if (curday != actual.dia) {
                if (curday != undefined) {
                    txt += "<br>";
                }
                txt += "<b> " + Utilizer.days[actual.dia] + "</b><br>";
                curday = actual.dia;
            } else {
                txt += ", ";
            }
            txt += " " + Utilizer.createHourRangeText(actual.horaInicio, actual.duracion);
        }
        return txt;
    }

    Utilizer.createHourRangeText = function(horaInicio, duracion) {
        return Utilizer.transFormNumberToHours(horaInicio) + " - " + Utilizer.transFormNumberToHours(horaInicio + Number(duracion));
    }

    Utilizer.pauseEvent = function(e) {
        if (e.stopPropagation) e.stopPropagation();
        if (e.preventDefault) e.preventDefault();
        e.cancelBubble = true;
        e.returnValue = false;
        return false;
    }

    Utilizer.transFormNumberToHours = function(number, half = true) {
        if (half) {
            number = Number(number / 2);
            var whole = Math.floor(number);
            var dec = number - whole;
            return (dec == 0) ? whole + ":00" : whole + ":30";
        } else {
            return number + ":00";
        }
    }

    Utilizer.transFormNumberToHoursText = function(number, half = true) {
        if (half) {
            number = Number(number / 2);
            var whole = Math.floor(number);
            var dec = number - whole;
            return (dec == 0) ? whole + "<span style = 'text-transform:capitalize'>hrs</span>" : whole + " <span style = 'text-transform:capitalize'>hrs</span> 30 <span style = 'text-transform:capitalize'>Mins</span>";
        } else {
            return number + ":00";
        }
    }

    Utilizer.numberAndPer = function(number, total) {
        if (total == 0) {
            return number + " (0.00%)"
        } else {
            return number + " (" + Number(100 * number / total).toFixed(2) + "%)"
        }
    }

    Utilizer.makeLetter = function(number) {
        if (number > 25) { //A (65) + 25 = Z(90)
            return Utilizer.makeLetter(Math.round(number / 26) - 1) + Utilizer.makeLetter(number % 26);
        } else {
            return String.fromCharCode(65 + number); //A
        }
    }

    Utilizer.makeDatepickerRange = function(idInicial, idFinal, funcion) {
        var firstDate = Utilizer.getFirstDateMonth();
        var lastDate = Utilizer.getLastDateMonth();
        Utilizer.makeDatepicker(idInicial, firstDate);
        Utilizer.makeDatepicker(idFinal, lastDate);
        $('#' + idInicial).on('change', funcion);
        $('#' + idFinal).on('change', funcion);
        1
    }

    Utilizer.getDatepickerRange = function(idInicial, idFinal, data) {
        data.fechaInicial = Utilizer.fechaParseToDbDate($('#' + idInicial + 'Text').val());
        data.fechaFinal = Utilizer.fechaParseToDbDate($('#' + idFinal + 'Text').val());
        return data;
    }

    Utilizer.compareTiempos = function(data, act) {
        return data.dia == act.dia && data.duracion == act.duracion && data.horaInicio == act.horaInicio && data.idSalonGrupo == act.idSalonGrupo;
    }

    Utilizer.calculateLetter = function(letterString) {
        var sum = 0,
            n = 0;
        for (var i = letterString.length - 1; i >= 0; i--) {
            if (letterString.length - 1 == i) {
                sum += letterString.charCodeAt(i) - 65;
            } else {
                sum += (n * 26) * (letterString.charCodeAt(i) - 64);
            }
            n++;
        }
        return sum;
    }

    Utilizer.saldo = function(number) {
        number = Utilizer.coinToNumber(number);
        if (number > 0) {
            color = 'green';
        } else if (number < 0) {
            color = 'red';
        } else {
            color = 'black';
        }
        return '<div style="color:' + color + '">' + Utilizer.numberToCoin(number) + "</div>";
    }

    Utilizer.getNumberIntAndDec = function(number) {
        var whole = Math.floor(number);
        var dec = number - whole;
        return { 'int': whole, 'dec': dec };
    }

    Utilizer.subStringNumInString = function(string, subString, allowOverlapping) {
        string += "";
        subString += "";
        if (subString.length <= 0) return (string.length + 1);
        var n = 0,
            pos = 0,
            step = allowOverlapping ? 1 : subString.length;
        while (true) {
            pos = string.indexOf(subString, pos);
            if (pos >= 0) {
                ++n;
                pos += step;
            } else break;
        }
        return n;
    }

    Utilizer.levDist = function(s, t) {
        var d = []; //2d matrix

        // Step 1
        var n = s.length;
        var m = t.length;

        if (n == 0) return m;
        if (m == 0) return n;

        //Create an array of arrays in javascript (a descending loop is quicker)
        for (var i = n; i >= 0; i--) d[i] = [];

        // Step 2
        for (var i = n; i >= 0; i--) d[i][0] = i;
        for (var j = m; j >= 0; j--) d[0][j] = j;

        // Step 3
        for (var i = 1; i <= n; i++) {
            var s_i = s.charAt(i - 1);

            // Step 4
            for (var j = 1; j <= m; j++) {

                //Check the jagged ld total so far
                if (i == j && d[i][j] > 4) return n;

                var t_j = t.charAt(j - 1);
                var cost = (s_i == t_j) ? 0 : 1; // Step 5

                //Calculate the minimum
                var mi = d[i - 1][j] + 1;
                var b = d[i][j - 1] + 1;
                var c = d[i - 1][j - 1] + cost;

                if (b < mi) mi = b;
                if (c < mi) mi = c;

                d[i][j] = mi; // Step 6

                //Damerau transposition
                if (i > 1 && j > 1 && s_i == t.charAt(j - 2) && s.charAt(i - 2) == t_j) {
                    d[i][j] = Math.min(d[i][j], d[i - 2][j - 2] + cost);
                }
            }
        }

        // Step 7
        return d[n][m];
    }

    Utilizer.getAllOptionsText = function(id) {
        var d = Array();
        $('#' + id).find('option').each(function() {
            d.push({ id: $(this).val(), value: $(this).text() });
        });
        return d;
    }

    Utilizer.getOptionByText = function(id, value) {
            var d = {};
            $('#' + id).find('option').each(function() {
                //console.log($(this).text()+"="+value);
                if ($(this).text() == value) {
                    d = $(this);
                }
            });
            //console.log(d);
            return d;
        }
        //
    Utilizer.setValuesWithObject = function(obj) {
        obj = tableUtilities.formatDataToPaint(obj);
        var keys = Object.keys(obj),
            actual, i;
        for (i = 0; i < keys.length; i++) {
            actual = keys[i];

            if ($("#" + actual).length > 0) {
                $("#" + actual).val(obj[actual]);
            }
        }

    }
    Utilizer.reset = function(id) {
        var ob = $("#" + id);
        if (ob.data('default') !== undefined) {
            ob.val(ob.data('default'));
        } else {
            if ($(id).is('table')) {
                tableUtilities.clearTable(id);
            } else if ($(id).hasClass('selectpicker')) {
                Utilizer.setPicker(id, '');
                Utilizer.setPicker(id, '');
            } else {
                ob.val('');
            }
        }
    }

    //Calcula un subtotal
    Utilizer.calcularSubtotal = function(precio, cantidad, descuento) {
        if (precio == "") {
            precio = 0;
        }
        if (cantidad == "") {
            cantidad = 0;
        }
        if (descuento == "") {
            descuento = 0;
        }
        //console.log("CALCULAR SUBTOTAL");console.log(descuento);
        if (descuento) {
            if (typeof descuento === 'string') {
                descuento = Number(descuento.replace("%", ""));
            }
            var total = precio * cantidad * (1 - (descuento / 100));
        } else {
            var total = precio * cantidad;
        }
        return Number(total.toFixed(2));
    }

    Utilizer.calcularTotal = function(sub, desc) {
        return sub * (1 - (desc / 100));
    }

    //Quita la clase is-selected de todos los elementos que sean element ej. element = ".clase", element = "#id", element = "htmltag"
    Utilizer.deselectElements = function(element) {
            $(element).find('.is-selected').removeClass('is-selected');
        }
        //Agrega o quita la clase is-selected a un elemento dependiendo si ya la tiene o no
    Utilizer.toggleSelected = function(but) {
            if ($(but).hasClass('is-selected')) {
                $(but).removeClass('is-selected');
            } else {
                $(but).addClass('is-selected');
            }
            $(but).blur();
        }
        //Agrega la clase is-selected a todos los elementos que sean del tipo selectable dento del elemento element, ej. element = "#grid", selectable = ".grid-item"
    Utilizer.selectAllInElement = function(element, selectable) {
            $(element).find(selectable).addClass('is-selected');
        }
        //Agrega la clase is-selected a un elemento y quita is-selected de todos los elementos selectable dento de element
    Utilizer.toggleOneButton = function(but, element) {
            if (!$(but).hasClass('is-selected')) {
                $(element).find('.is-selected').removeClass('is-selected')
                $(but).addClass('is-selected');
            }
            $(but).blur();
        }
        //Carga el select desde un php, el php debe regresar un arreglo con id,value y tal vez data-subtext para que funcione correctamente
    Utilizer.loadSelect = function(id, php, def, param, func, funcParam, todos, extras) {
        $('#' + id).empty();
        $('#' + id).append("<option disabled hidden> Cargando " + def + "s...</option>");
        $.ajax({
            type: 'post',
            url: "queries/" + php + ".php",
            //contentType:"application/json; charset=utf-8",
            //dataType:"json",
            data: param,
            success: function(data) {
                //console.log(data);
                $('#' + id).empty();
                //$('#'+id).append("<option disabled hidden selected value = '0' >"+def+"</option>");
                if ($('#' + id).prop('required')) {
                    def += " (Obligatorio)";
                }
                $('#' + id).append("<option disabled hidden selected value = '' >" + def + "</option>");
                //console.log(todos);
                if (todos) {
                    $('#' + id).append("<option value = '-1' >Todos</option>");
                }
                //console.log(extras);
                if (extras) {
                    //console.log(extras);
                    for (var i = 0; i < extras.length; i++) {
                        $('#' + id).append("<option value = '" + extras[i].val + "' >" + extras[i].texto + "</option>");
                    }
                }
                var txt = "";
                //console.log("Respuesta php de "+php+" ["+data+"] Respuesta php de "+php);
                var datos = {};
                var k;
                $.each(data, function(i, item) {
                    datos = {};
                    //console.log(data[i]);
                    txt = '<option value="' + data[i].id + '" ';
                    $.each(data[i], function(key, value) {
                        if (key != "id" && key != "value" && key.slice(0, 5) == "data-") {
                            k = key.replace(key.slice(0, 5), "");
                            datos[k] = value;
                        }
                    });
                    txt += '>' + data[i].value + '</option>';
                    $('#' + id).append(txt);
                    $('#' + id + ' option:last-child').data(datos);
                });
                $('#' + id).selectpicker('refresh');
                if (window.innerWidth <= 766) {
                    $('#' + id).selectpicker('mobile');
                }
                if (func) {
                    if (funcParam) {
                        func(funcParam);
                    } else {
                        func();
                    }

                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("[ERROR: ");
                console.log(jqXHR.status);
                console.log(textStatus);
                console.log(errorThrown);
                console.log("]");
                Messager.addAlertText('loadSelect', 'Error en php [' + php + "]", 'e')
                    //console.log("ERROR Utilizer.loadSelect("+id+", "+php+","+def+")");
            }
        });
    }

    Utilizer.selectPickerEnable = function(id) {
        $('#' + id).removeAttr('disabled');
        $("#" + id).selectpicker('refresh');
    }

    Utilizer.selectPickerDisable = function(id) {
            $('#' + id).attr('disabled', true);
            $("#" + id).selectpicker('refresh');
        }
        //Regresa true si un string comienza con otro string
    Utilizer.stringStartsWith = function(string, prefix) {
            return string.slice(0, prefix.length) == prefix;
        }
        //Remueve un string del inicio de otro sí y solo sí comienza con ese
    Utilizer.removeStringFromStart = function(string, removed) {
        if (Utilizer.stringStartsWith(string, removed)) {
            return string.slice(removed.length);
        } else {
            return string;
        }
    }
    Utilizer.formatDate = function(date) {
        var day = date.getDate();
        var month = Number(date.getMonth()) + 1;
        var year = date.getFullYear();
        if (day < 10) {
            day = "0" + day;
        }
        if (month < 10) {
            month = "0" + month;
        }
        return day + "/" + month + "/" + year;
    }


    Utilizer.setTimePicker = function(id, time) {
        var opts = {},
            obj = $("#" + id),
            original = obj.data('original');
        //console.log("setTimePicker");console.log(obj);console.log(original);console.log(obj.data());
        if (!original.includes('timepicker') || !original.startsWith('<input type="text"')) {
            Messager.addAlertText('makeTimePicker', 'El timepicker [' + id + "] debe estar contenido dentro de un div sólo.", 'e');
            return;
        }
        if (obj.data('title')) {
            opts.title = obj.data('title');
        } else {
            opts.title = "Seleccione una hora";
        }
        opts.now = time;
        if (obj.data('minStep')) {
            opts.minutesInterval = obj.data('minStep');
        } else {
            opts.minutesInterval = 15;
        }
        //opts.clearable = true;
        obj.parent().empty().html(original);
        obj.data('original', original);

        $("#" + id).wickedpicker(opts);
        $("#" + id).data('original', original);
    }
    Utilizer.makeValidTimeFromString = function(string) {
        var temp = string.split(":");
        temp[0] = Number(temp[0]);
        if (temp[0] <= 12) {
            temp[2] = "AM";
        } else {
            temp[0] -= 12;
            temp[2] = "PM";
        }
        return temp[0] + " : " + temp[1] + " " + temp[2];

    }

    Utilizer.makeTimePicker = function(id) {
        console.log(id);
        var opts = {},
            obj = $("#" + id),
            original = obj.parent().html().trim();
        if (!original.includes('timepicker') && !original.startsWith('<input type="text"')) {
            Messager.addAlertText('makeTimePicker', 'El timepicker [' + id + "] debe estar contenido dentro de un div sólo.", 'e');
            return;
        }
        obj.data('original', original);
        if (obj.data('title')) {
            opts.title = obj.data('title');
        } else {
            opts.title = "Seleccione una hora";
        }
        if (obj.data('default')) {
            opts.now = obj.data('default');
        } else {
            opts.now = "7:00";
        }
        if (obj.data('minStep')) {
            opts.minutesInterval = obj.data('minStep');
        } else {
            opts.minutesInterval = 15;
        }
        opts.twentyFour = false;
        //opts.clearable = true;
        console.log(opts);
        console.log(obj.wickedpicker(opts));
    }

    //Crea un datepicker con el elemento id
    Utilizer.makeDatepicker = function(id, setDate, mode) {
        var obj = id;
        if (typeof id == 'string') {
            obj = $("#" + id);
        }
        if (!$(obj).hasClass('date')) {
            $(obj).addClass('date');
        }
        if ($(obj).find('.inputFecha').length == 0) {
            $(obj).html("");
            $(obj).append('<div class="input-group date-container date inputFecha"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input type="text" class="form-control" id="' + id + 'Text"/></div>');
        }
        //Para seleccionar fechas
        var dat = Utilizer.formatDate(new Date());
        var options = {
            todayBtn: "linked",
            todayHighlight: true,
            language: 'es',
            format: 'dd/mm/yyyy',
            clearBtn: false,
            autoclose: true,
            weekStart: 1
        };

        if (mode == "past") {
            options.startDate = '01/01/1900';
            options.endDate = dat;
        } else if (mode == "future") {
            options.startDate = dat;
        } else {
            options.startDate = '01/01/1900';
        }

        $(obj).datepicker(options);

        if (setDate === undefined) {
            $(obj).datepicker('setDate', dat);
        } else {
            if (setDate) {
                $(obj).datepicker('setDate', setDate);
            }
        }
        if ($(obj).hasClass('month') || $(obj).hasClass('fortnight') || $(obj).hasClass('week')) {
            $(obj).bind('change', Utilizer.setDatePair);
        }
    };

    Utilizer.bindSetDatePair = function(id) {
        $("#" + id).unbind('change', Utilizer.setDatePair);
        $("#" + id).bind('change', Utilizer.setDatePair);
    }

    Utilizer.clearDatePairClasses = function(id) {
        $("#" + id).removeClass('fortnight').removeClass('month').removeClass('week');
    }
    Utilizer.setDatePair = function(id) {
        var cur;

        if (id.type !== undefined) {
            cur = id.currentTarget;
        } else if (id !== undefined) {
            cur = $("#" + id);
        } else {
            cur = event.currentTarget;
        }
        //console.log('setDatePair');
        //console.log(cur);
        var paired = $(cur).data('paired'),
            dateInicial = Utilizer.fechaParseToDate($("#" + $(cur).attr('id') + "Text").val()),
            dateFinal = Utilizer.fechaParseToDate($("#" + $(cur).attr('id') + "Text").val()),
            disable = false;
        if ($(cur).hasClass('fortnight')) {
            disable = true;
            if (dateInicial.getDate() > 15) {
                dateInicial.setDate(16);
                dateFinal = new Date(dateInicial.getFullYear(), dateInicial.getMonth() + 1, 0);
            } else {
                dateInicial.setDate(1);
                dateFinal.setDate(15);
            }
        } else if ($(cur).hasClass('month')) {
            disable = true;
            dateInicial.setDate(1);
            dateFinal = new Date(dateInicial.getFullYear(), dateInicial.getMonth() + 1, 0);
        } else if ($(cur).hasClass('week')) {
            disable = true;
            var day = dateInicial.getDay(),
                diff = dateInicial.getDate() - day + (day == 0 ? -6 : 1);
            dateInicial.setDate(diff);
            dateFinal.setDate(diff);
            while (dateFinal.getDay() != 0) {
                dateFinal.setDate(dateFinal.getDate() + 1);
            }
        }

        $("#" + $(cur).attr('id')).unbind("change", Utilizer.setDatePair);
        $("#" + $(cur).attr('id')).datepicker('setDate', Utilizer.dateParseToFecha(dateInicial));
        $("#" + paired).datepicker('setDate', Utilizer.dateParseToFecha(dateFinal));
        $("#" + paired + "Text").prop("disabled", disable);
        $("#" + $(cur).attr('id')).bind("change", Utilizer.setDatePair);
    }

    Utilizer.objectHasNullUndefined = function(obj) {
            var keys = Object.keys(obj);
            for (var i = 0; i < keys.length; i++) {
                if (obj[keys[i]] === null || obj[keys[i]] === undefined) {
                    return true;
                }
            }
            return false;
        }
        //Hace un AJAX request y ejecuta una función que recibe los datos que ese php sacó
    Utilizer.getResponse = function(php, post, func, extra) {
            if (func && typeof(func) === "function") {
                //console.log("Enviando: ");console.log(post);
                //console.log("Utilizer response: PHP:"+php); //console.log("Utilizer response: Func:"+func); //console.log("Utilizer response: POST:"); //console.log(post); //console.log("Utilizer response: POST:");
                $.ajax({
                    type: 'post',
                    url: 'queries/' + php + '.php',
                    data: post,

                    success: function(data) {
                        if (extra !== undefined) {
                            func(data, extra);
                        } else if (data[0] == "<") {
                            console.log("Respuesta php desde " + php + ":[" + data + "]:Respuesta php");
                            $("#respuestaPhp").html("<div>" + data + "</div>");
                            Messager.addAlertText("Ejecucion del codigo",
                                "Ha habido un problema con la ejecucion del codigo. Vea la consola para mas informacion.",
                                "e");
                        } else {
                            func(data);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var data = new Array();
                        data[0] = "e";
                        data[1] = "Codigo";
                        data[2] = "Ha habido un problema con el codigo. No se ejecutó [" + php + "]. ";
                        console.log("[ERROR: ");
                        console.log(jqXHR.status);
                        console.log(textStatus);
                        console.log(errorThrown);
                        console.log("]");
                        Messager.addAlertText(data[1], data[2], data[0]);

                    }
                });
            } else {
                if (func) {
                    if (typeof(func) !== "function") {
                        console.log("getResponse ERROR: El 3er parametro debe de ser una funcion (Regresa data si todo salió bien y -1 si hubo un error).")
                    }
                } else {
                    console.log("getResponse ERROR: No se pasó algo 3er parametro.")
                }
            }
        }
        /**Funcion que manda datos a un php, muestra un mensaje y ejecuta una funcion de success, error y les pasa un parametro extra. En caso de que el ajax mande un error se alerta.
         * @param {String} php			Requerido. El php a ejecutar.
         * @param {Object} post			Requerido. Los datos que se mandan al php.
         * @param {function} succ		Opcional. La funcion a ejecutarse si el codigo es exitoso.
         * @param {Object|String} extra	Opcional si err no existe. Requerido si err existe. Informacion que pasar a las funciones succ y err. Puede ser {} o '' (Y pueden estar vacios.)
         * @param {function} err			Opcional. La funcion a ejecutarse si el codigo no es exitoso.
         * @author Plokasu
         */
    Utilizer.randomNumber = function(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    }

    Utilizer.random = function(seed) {
        var x = Math.sin(seed++) * 10000;
        return x - Math.floor(x);
    }


    //console.log("YES");
    Utilizer.colors = [
        [
            [176, 23, 31], //R
            [205, 96, 144], //R
            [205, 16, 118], //R
            [208, 32, 144], //R
            [186, 85, 211] //R
        ], //REDS
        [
            [0, 205, 102], //G
            [67, 205, 128], //G
            [0, 201, 87], //G
            [50, 205, 50], //G
            [0, 205, 0] //G
        ], //GREENS
        [
            [65, 105, 225], //B
            [58, 95, 205], //B
            [39, 64, 139], //B
            [100, 149, 237], //B
            [159, 182, 205] //B
        ], //BLUES
        [
            [205, 205, 0], //Y
            [255, 215, 0], //Y
            [227, 207, 87], //Y
            [255, 165, 0], //Y
            [255, 153, 18] //Y
        ] // YELLOWS
    ];

    Utilizer.randomColor = function(num, min, max) {
        if (min === undefined) {
            min = 0;
        }
        if (max === undefined) {
            max = 255;
        }

        var color = {};
        color.r = Utilizer.colors[num % Utilizer.colors.length][Math.floor(num / Utilizer.colors.length)][0];
        color.g = Utilizer.colors[num % Utilizer.colors.length][Math.floor(num / Utilizer.colors.length)][1];
        color.b = Utilizer.colors[num % Utilizer.colors.length][Math.floor(num / Utilizer.colors.length)][2];
        //console.log("COLOR");console.log(color);
        return color;
    }

    Utilizer.detectLeftButton = function(evt) {
        evt = evt || window.event;
        if ("buttons" in evt) {
            return evt.buttons == 1;
        }
        var button = evt.which || evt.button;
        return button == 1;
    }

    Utilizer.colorLumin = function(color, lum) { //console.log("Color before");console.log(color);
        color.r = Math.ceil(color.r * lum);
        color.g = Math.ceil(color.g * lum);
        color.b = Math.ceil(color.b * lum);
        if (color.r < 0) {
            color.r = 0;
        } else if (color.r > 255) {
            color.r = 255;
        }
        if (color.g < 0) {
            color.g = 0;
        } else if (color.g > 255) {
            color.g = 255;
        }
        if (color.g < 0) {
            color.g = 0;
        } else if (color.r > 255) {
            color.g = 255;
        } //console.log("Color after");console.log(color);
        return color;
    }

    Utilizer.colorRGB = function(color) {
        return "rgb(" + color.r + "," + color.g + "," + color.b + ")";
    }

    Utilizer.SaveToDisk = function(fileURL, fileName) {
        // for non-IE
        if (!window.ActiveXObject) {
            var save = document.createElement('a');
            save.href = fileURL;
            save.target = '_blank';
            save.download = fileName || 'unknown';

            var evt = new MouseEvent('click', {
                'view': window,
                'bubbles': true,
                'cancelable': false
            });
            save.dispatchEvent(evt);

            (window.URL || window.webkitURL).revokeObjectURL(save.href);
        }
    }

    Utilizer.makePdf = function(post, func, extra) {
        var originalButton = "";
        /*
        if(event.srcElement!=document){
        	originalButton = Utilizer.searchButtonInParent(event.srcElement);
        	$(originalButton).prop('disabled', true);
        }
        /**/
        if (func && typeof(func) === "function") {
            //console.log("Utilizer response: Func:"+func);
            console.log("Utilizer response: POST:");
            console.log(post);
            console.log("Utilizer response: POST:");

            $.ajax({
                type: 'post',
                url: 'pdfedit/pdfEngine.php',
                data: post,
                success: function(data) {
                    console.log(data);
                    if (extra !== undefined) {
                        func(data, extra);
                    } else {
                        func(data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var data = new Array();
                    data[0] = "e";
                    data[1] = "Codigo";
                    data[2] = "Ha habido un problema con el codigo para crear el PDF.";
                    console.log("[ERROR: ");
                    console.log(jqXHR.status);
                    console.log(textStatus);
                    console.log(errorThrown);
                    console.log("]");
                    Messager.addAlertText(data[1], data[2], data[0]);
                },
                complete: function() {
                    /*
                    	if(originalButton!=""){
                    		$(originalButton).prop('disabled', false);
                    	}
                    	/**/
                }
            });
        } else {
            if (func) {
                if (typeof(func) !== "function") {
                    console.log("makePdf ERROR: El 2o parametro debe de ser una funcion (Regresa data si todo salió bien y -1 si hubo un error).")
                }
            } else {
                console.log("makePdf ERROR: No se pasó algo 2o parametro.")
            }
        }
    }

    Utilizer.makeCsv = function(post, func, extra) {
        var originalButton = "";
        /*
        if(event.srcElement!=document){
        	originalButton = Utilizer.searchButtonInParent(event.srcElement);
        	$(originalButton).prop('disabled', true);
        }
        /**/
        if (func && typeof(func) === "function") {
            //console.log("Utilizer response: Func:"+func);
            console.log("Utilizer response: POST:");
            console.log(post);
            console.log("Utilizer response: POST:");

            $.ajax({
                type: 'post',
                url: 'csv/csvEngine.php',
                data: post,
                success: function(data) {
                    console.log(data);
                    if (extra !== undefined) {
                        func(data, extra);
                    } else {
                        func(data);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var data = new Array();
                    data[0] = "e";
                    data[1] = "Codigo";
                    data[2] = "Ha habido un problema con el codigo para crear el PDF.";
                    console.log("[ERROR: ");
                    console.log(jqXHR.status);
                    console.log(textStatus);
                    console.log(errorThrown);
                    console.log("]");
                    Messager.addAlertText(data[1], data[2], data[0]);
                },
                complete: function() {
                    /*
                    	if(originalButton!=""){
                    		$(originalButton).prop('disabled', false);
                    	}
                    	/**/
                }
            });
        } else {
            if (func) {
                if (typeof(func) !== "function") {
                    console.log("makePdf ERROR: El 2o parametro debe de ser una funcion (Regresa data si todo salió bien y -1 si hubo un error).")
                }
            } else {
                console.log("makePdf ERROR: No se pasó algo 2o parametro.")
            }
        }
    }

    Utilizer.sendData = function(php, post, succ, extra, err) {

        $.ajax({
            type: 'post',
            url: 'queries/' + php + '.php',
            data: post,
            success: function(data) {
                data = data.split('|');
                switch (data[0]) {
                    case 's':
                        if (succ) {
                            //console.log(data);
                            if (extra) {
                                succ(data, extra);
                            } else {
                                succ(data);
                            }
                        }
                        break;

                    case 'e':
                        if (err) {
                            err(extra);
                        }
                        break;
                    default:
                        //console.log(data);
                        console.log("Respuesta php desde " + php + ":[" + data + "]:Respuesta php");
                        $("#respuestaPhp").html("<div>" + data + "</div>");
                        data[0] = "e";
                        data[1] = "Ejecucion del codigo";
                        data[2] = "Ha habido un problema con la ejecucion del codigo. Vea la consola para mas informacion.";

                        break;
                }
                Messager.addAlertText(data[1], data[2], data[0]);
            },
            error: function() {
                data[0] = "e";
                data[1] = "Codigo";
                data[2] = "Ha habido un problema con el codigo. No se ejecutó [" + php + "].";
                Messager.addAlertText(data[1], data[2], data[0]);
            }
        });
    }
    Utilizer.shortMonths = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
    //Toma una fecha de la base de datos, ej 2015-01-01 9:00:00 y la convierte a 01/01/2015 sin el tiempo
    Utilizer.fechaDbParseToFecha = function(fecha, month) {
        fecha = fecha.split(/[- :]/);
        if (month) {
            return Utilizer.shortMonths[Number(fecha[1]) - 1] + "/" + fecha[0];
        } else {
            return fecha[2] + "/" + fecha[1] + "/" + fecha[0];
        }
    }


    Utilizer.fechaDbParseToFechaTiempo = function(fecha, ampm) {
            fecha = fecha.split(/[- :]/);
            var hora = fecha[3] * 1;
            var extra = "";
            if (ampm) {
                if (hora > 12) {
                    hora -= 12;
                    extra = " PM";
                } else {
                    if (hora == 12) {
                        extra = " PM";
                    } else {
                        extra = " AM";
                    }
                }
            }
            return { "fecha": fecha[2] + "/" + fecha[1] + "/" + fecha[0], "hora": hora + ":" + fecha[4] + extra };
        }
        //Toma una fecha de database y la transforma en date
    Utilizer.fechaDbParseToDate = function(fecha) {
            return Utilizer.fechaParseToDate(Utilizer.fechaDbParseToFecha(fecha));
        }
        //Toma una fecha con formato 01/01/2015 y la transforma al objecto Date
    Utilizer.fechaParseToDate = function(fecha) {
        fecha = fecha.split('/');
        if (fecha.length == 3) {
            return new Date(fecha[2], (fecha[1] - 1), fecha[0]);
        } else {
            return "";
        }
    }

    Utilizer.getSelected = function(id) {
        return $('#' + id).find('option:selected');
    }

    Utilizer.getSelectedObject = function(id, idName, valueName, subTextKey = '') {
        var sel = Utilizer.getSelected(id);
        var obj = {};
        //console.log("getSelectedObject");console.log($("#"+id).data());console.log(idName);console.log(valueName);console.log(subTextKey);
        if (idName) {
            obj[idName] = sel.val();
        } else {
            obj[id] = sel.val();
        }
        if (valueName) {
            obj[valueName] = sel.text();
        } else {
            obj[id + "value"] = sel.text();
        }
        for (var key in sel.data()) {
            obj[id + key] = sel.data(key);
        }
        //console.log("OBJ");console.log(obj);
        return obj;
    }

    Utilizer.getOptionByValue = function(id, value) {
        return $('#' + id).find('option[value="' + value + '"]');
    }

    //Toma una fecha con formato 01/01/2015 y la transforma a una fecha para la base de datos ej, 2015-01-01
    Utilizer.fechaParseToDbDate = function(fecha) {
        //console.log("Fecha to DB");console.log(fecha);
        if (fecha.match('^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$')) {
            return fecha;
        }
        fecha = fecha.split("/");
        //console.log(fecha[2]+"-"+fecha[1]+"-"+fecha[0]);
        return fecha[2] + "-" + fecha[1] + "-" + fecha[0];
    }

    //Hace set a un selectpicker y lo muestra
    Utilizer.setPicker = function(id, v) {
        //console.log("setPicker "+id+","+v);
        $('#' + id).val(v);
        //console.log(id+": "+$("#"+id).val());
        $('#' + id).val(v);
        //console.log(id+": "+$("#"+id).val());
        $('#' + id).selectpicker('refresh');
    }

    Utilizer.setPickerTrigger = function(id, v) {
        Utilizer.setPicker(id, v);
        $('#' + id).trigger('change');
    }

    Utilizer.clearPicker = function(id) {
        $('#' + id).empty();
        $('#' + id).selectpicker('refresh');
    }

    Utilizer.dateParseToDbDate = function(date) {
        var day = date.getDate() * 1;
        if (day < 10) {
            day = "0" + day;
        }
        var month = 1 + (date.getMonth() * 1);
        if (month < 10) {
            month = "0" + month;
        }
        var year = date.getFullYear();
        return year + "-" + month + "-" + day;
    }

    Utilizer.dateParseToFecha = function(date) {
        var day = date.getDate() * 1;
        if (day < 10) {
            day = "0" + day;
        }
        var month = 1 + (date.getMonth() * 1);
        if (month < 10) {
            month = "0" + month;
        }
        var year = date.getFullYear();
        return day + "/" + month + "/" + year;
    }

    Utilizer.disableSelectOption = function(id, val) {
        $('#' + id + ' option[value="' + val + '"]').prop('disabled', true);
        $('#' + id).selectpicker('refresh');
    }

    Utilizer.enableSelectOption = function(id, val) {
        $('#' + id + ' option[value="' + val + '"]').prop('disabled', false);
        $('#' + id).selectpicker('refresh');
    }

    //Inicializa un check toggle con texto inactivo - activo.
    Utilizer.setToggler = function(id, activo, inactivo) {
        $('#' + id).data("off-text", inactivo);
        $('#' + id).data("on-text", activo);
        $('#' + id).bootstrapSwitch();
    }

    Utilizer.getTogglerTextValue = function(id, text) {
        if (text == $("#" + id).data("off-text")) {
            return false;
        } else if (text == $("#" + id).data("on-text")) {
            return true;
        } else {
            return -1;
        }
    }

    Utilizer.getTogglerText = function(id) {
        var clas = "";
        if (Utilizer.getTogglerValue(id)) {
            clas = 'bootstrap-switch-handle-on';
        } else {
            clas = 'bootstrap-switch-handle-off';
        }
        //console.log($('#'+id).parent());
        return $('#' + id).parent().find('.' + clas).text();
    }

    //Set el valor de un check box con el valor indicado.
    Utilizer.setTogglerValue = function(id, value) {
        var wasDisabled = $('#' + id).bootstrapSwitch('disabled');
        if (wasDisabled) {
            $('#' + id).bootstrapSwitch('disabled', false);
        }
        if ($('#' + id).data('on-text') == value) {
            $('#' + id).bootstrapSwitch('state', true);
        } else if ($('#' + id).data('off-text') == value) {
            $('#' + id).bootstrapSwitch('state', false);
        } else {
            $('#' + id).bootstrapSwitch('state', value);
        }
        if (wasDisabled) {
            $('#' + id).bootstrapSwitch('disabled', true);
        }
    }

    Utilizer.getTogglerValue = function(id) {
        return $('#' + id).bootstrapSwitch('state');
    }
    $('[data-toggle="tooltip"]').tooltip();

    Utilizer.isInArray = function(value, array) {
        return array.indexOf(value) > -1;
    }

    Utilizer.loadManualDireccion = function(idEnd, idColonia) {
        var cp = $('#postalcode' + idEnd);
        //console.log(cp.val());
        if (cp.val().length > 0) {
            Utilizer.getResponse('getDireccion', { cp: $(cp).val() }, Utilizer.putDireccionManual, { end: idEnd, idC: idColonia });
        }
    }

    Utilizer.putDireccionManual = function(data, extra) {
        var pais = $('#country' + extra.end);
        var estado = $('#state' + extra.end);
        var ciudad = $('#city' + extra.end);
        if (data != -1) {
            Utilizer.manualLoadSelect('area' + extra.end, 'Colonia', data.colonia);
            //console.log("Esto? (Es lo de arriba");
            estado.val(data.estado);
            ciudad.val(data.ciudad);
            pais.val(data.pais);
            Utilizer.setPicker('area' + extra.end, extra.idC);
        }
    }

    Utilizer.loadDireccion = function(event) {
        //console.log("Yay");
        var cp = event.target;
        var idEnd = $(cp).attr('id');
        idEnd = idEnd.replace('postalcode', '');
        if ($(cp).val() == '') {
            var pais = $('#country' + idEnd);
            var estado = $('#state' + idEnd);
            var ciudad = $('#city' + idEnd);
            $('#area' + idEnd).empty();
            $('#area' + idEnd).append("<option disabled hidden selected value = '' >Colonia</option>");
            $('#area' + idEnd).selectpicker('refresh');
            estado.val('');
            ciudad.val('');
            pais.val('');
        } else {
            Utilizer.getResponse('getDireccion', { cp: $(cp).val() }, Utilizer.putDireccion, idEnd);
        }
    }

    Utilizer.putDireccion = function(data, idEnd) {
        var pais = $('#country' + idEnd);
        var estado = $('#state' + idEnd);
        var ciudad = $('#city' + idEnd);
        if (data != -1) {
            Utilizer.manualLoadSelect('area' + idEnd, 'Colonia', data.colonia);
            estado.val(data.estado);
            ciudad.val(data.ciudad);
            pais.val(data.pais);
        }
    }

    Utilizer.manualLoadSelect = function(id, def, data, func, funcParam) {
        $('#' + id).empty();
        $('#' + id).append("<option disabled hidden selected value = '' >" + def + "</option>");
        var txt = "";
        var datos = {};
        //console.log("VALORES DE "+id);
        $.each(data, function(i, item) {
            //console.log("Value: "+data[i].id+", Text:"+data[i].value);
            txt = '<option value="' + data[i].id + '" ';
            $.each(data[i], function(key, value) {
                if (key != "id" && key != "value" && key.slice(0, 5) == "data-") {
                    k = key.replace(key.slice(0, 5), "");
                    datos[k] = value;
                    //console.log(k+" , "+value);
                }
            });
            txt += '>' + data[i].value + '</option>';
            $('#' + id).append(txt);
        });
        $('#' + id).selectpicker('refresh');
        if (window.innerWidth <= 766) {
            $('#' + id).selectpicker('mobile');
        }
        $('#' + id + ' option:last-child').data(datos);
        if (func) {
            if (funcParam) {
                func(funcParam);
            } else {
                func();
            }

        }
    }

    Utilizer.exists = function(object, key) {
        if (object[key] !== undefined && object[key] != null && object[key] != "") {
            return true;
        }
        return false;
    }
    Utilizer.concatenateDireccion = function(data, extra) {
        var object = {};
        var end = '';

        for (var key in data) {
            if (key.substring(0, 10) == 'postalcode') {
                end = key.replace('postalcode', '');
            }
        }

        for (var key in data) {
            object[key] = data[key];
        }

        for (var key in extra) {
            object[key] = extra[key];
        }

        var dir = "";
        if (Utilizer.exists(object, 'calle')) {
            dir += object.calle;
        } else if (Utilizer.exists(object, 'street')) {
            dir += object.street;
        }
        if (Utilizer.exists(object, 'numExt')) {
            dir += " #" + object.numExt;
        } else if (Utilizer.exists(object, 'numExterior')) {
            dir += " #" + object.numExterior;
        }
        if (Utilizer.exists(object, 'numInt')) {
            dir += " [" + object.numInt + "]";
        } else if (Utilizer.exists(object, 'numInterior')) {
            dir += " [" + object.numInterior + "]";
        }
        //console.log(object);
        if (Utilizer.exists(object, 'colonia')) {
            dir += " Col. " + object['colonia'];
        } else if (Utilizer.exists(object, 'area' + end)) {
            dir += " Col. " + object['area' + end];
        }

        if (Utilizer.exists(object, 'dirCorta')) {
            dir += " " + object['dirCorta']
        } else {
            if (Utilizer.exists(object, 'postalcode' + end)) {
                dir += " C.P. " + object['postalcode' + end];
            } else if (Utilizer.exists(object, 'cp')) {
                dir += " C.P. " + object['cp'];
            }
            if (Utilizer.exists(object, 'city' + end)) {
                dir += ", " + object['city' + end];
            }
            if (Utilizer.exists(object, 'state' + end)) {
                dir += ", " + object['state' + end];
            }
        }
        return dir;
    }

    Utilizer.concatenateDireccionLarga = function(calle, numeroext, numeroint, colonia, ciudad, estado, pais) {
        return Utilizer.concatenateDireccion(calle, numeroext, numeroint, colonia, ciudad) + ', ' + estado + ', ' + pais;
    }

    Utilizer.getFirstDateMonth = function() {
        var date = new Date();
        var y = date.getFullYear();
        var m = date.getMonth();
        firstDay = new Date(y, m, 1);
        return firstDay;
    }

    Utilizer.getLastDateMonth = function() {
        var date = new Date();
        var y = date.getFullYear();
        var m = date.getMonth();
        firstDay = new Date(y, m + 1, 0);
        return firstDay;
    }

    Utilizer.addToDate = function(dateObject, Time) {
        var datn = Time.split(',');;
        switch (datn[1]) {
            case "D":
                dateObject.setDate(Number(dateObject.getDate()) + Number(datn[0]));
                break;
            case "M":
                var m = Number(dateObject.getMonth()) + Number(datn[0]);
                dateObject = new Date(dateObject.setMonth(m));
                break;
            default:

                break;
        }
        return dateObject;
    }

    Utilizer.makeHourSelect = function(id, selected) {
        //POLLO YAY FUCK IT
        var h;
        var txt = '<select class="selectpicker" id="hourselect' + id + '">';
        for (var i = 0; i < 24; i++) {
            if (i < 10) {
                h = '0' + i;
            } else {
                h = i;
            }
            if (selected !== undefined) {
                if (i == selected) {
                    txt += '<option selected value="' + h + ':00">' + h + ':00</option>';
                } else {
                    txt += '<option value="' + h + ':00">' + h + ':00</option>';
                }
            } else {
                txt += '<option value="' + h + ':00">' + h + ':00</option>';
            }
            txt += '<option value="' + h + ':30">' + h + ':30</option>';
        }
        return txt + '</select>';
    }

    Utilizer.makeMonthSelect = function(id, selected, upTo = 11) {
        var h;
        var txt = '<select class="selectpicker" id="monthSelect' + id + '">';
        var month = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        for (var i = 0; i < month.length; i++) {
            if (i == upTo) {
                break;
            }
            if (selected !== undefined) {
                if (i == selected) {
                    txt += '<option selected value="' + i + '">' + month[i] + '</option>';
                } else {
                    txt += '<option value="' + i + '">' + month[i] + '</option>';
                }
            } else {
                txt += '<option value="' + i + '">' + month[i] + '</option>';
            }
        }
        return txt + '</select>';
    }

    Utilizer.makeYearSelect = function(id, options, selected) {
        var d = new Date();
        if (selected == "" || selected === undefined) {
            selected = d.getFullYear();
        }
        var txt = '<select class="selectpicker" id="yearSelect' + id + '">';
        if (options !== undefined) {
            if (options.min === undefined && options.max === undefined) { //Los dos no definidos
                min = selected - options.years;
                max = selected + options.years;
            } else if (options.min !== undefined && options.max === undefined) { //Min existe
                min = options.min;
                max = min + options.years;
            } else if (options.min === undefined && options.max !== undefined) { //Max existe
                max = options.max;
                min = max - options.years;
            } else if (options.min !== undefined && options.max !== undefined) { //Los dos existen
                min = options.min;
                max = options.max;
            }
        } else {
            min = selected - 5;
            max = selected + 5;
        }

        for (var i = min; i <= max; i++) {
            if (i == selected) {
                txt += '<option selected value="' + i + '">' + i + '</option>';
            } else {
                txt += '<option value="' + i + '">' + i + '</option>';
            }
        }
        return txt + '</select>';
    }

    Utilizer.setCapitalize = function() {
        $('form input[type="text"]').each(function() {
            if ($(this).is('#rfc')) {
                $(this).addClass('upper');
            } else {
                $(this).addClass('capitalize');
            }
        });

        $('form input[type="alpha"]').each(function() {
            $(this).addClass('capitalize');
        });

        $('form input[type="text"]').each(function() {
            if ($(this).attr('placeholder') == "Nombre del Paciente") {
                $(this).removeClass('capitalize');
                $(this).addClass('upper');
            }
        });
    }

    Utilizer.makeAddress = function(object) {
        var dir = "";
        if (object.calle !== undefined && object.calle != null && object.calle != "") {
            dir += object.calle;
        }
        if (object.numExt !== undefined && object.numExt != null && object.numExt != "") {
            dir += " #" + object.numExt;
        }
        if (object.numInt !== undefined && object.numInt != null && object.numInt != "") {
            dir += " [" + object.numInt + "]";
        }
        if (object.colonia !== undefined && object.colonia != null && object.colonia != "") {
            dir += " Col. " + object.colonia;
        }
        if (object.dirCorta !== undefined && object.dirCorta != null && object.dirCorta != "") {
            dir += " " + object.dirCorta;
        }
        return dir;
    }

    Utilizer.coinToNumber = function(coin) {
        if (typeof coin == "string") {
            coin = Number(coin.replace('$', '').replace(/,/g, ''));
            return Number(coin.toFixed(2));
        }
        return coin;
    }

    Utilizer.numberToCoin = function(numb) {
        var p = toString(numb);
        var tSeparator = ",",
            dSeparator = ".",
            money = "$";
        //console.log(numb);
        //console.log(p.indexOf('$'));
        if (toString(numb).indexOf(money) == -1) {
            numb = Number(numb);
            numb = numb.toFixed(2);
            numb = numb.split('.');
            numb[0] = numb[0].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1" + tSeparator);
            return money + numb[0] + dSeparator + numb[1];
        }
        return numb;
    }

    Utilizer.percentageToNumber = function(perc) {
        return Number(perc.replace('%', ''));
    }

    Utilizer.numberToPercentage = function(numb) {
        //console.log(numb);
        //console.log(toString(numb).indexOf('%'));
        if (toString(numb).indexOf('%') == -1) {
            numb = Number(numb);
            return numb + '%';
        }
        return numb;
    }

    Utilizer.weekCount = function(year, month_number) {
        month_number++;
        var firstOfMonth = new Date(year, month_number - 1, 1);
        var lastOfMonth = new Date(year, month_number, 0);

        var used = firstOfMonth.getDay() + lastOfMonth.getDate();

        return Math.ceil(used / 7);
    }

    Utilizer.fillForm = function(data) {
        var keys = Object.keys(data);
        //console.log(data);
        for (var i = 0; i < keys.length; i++) {
            //console.log($("#"+keys[i]));
            if ($("#" + keys[i]).hasClass('selectpicker')) {
                Utilizer.setPicker(keys[i], data[keys[i]]);
                Utilizer.setPicker(keys[i], data[keys[i]]);
            } else if ($("#" + keys[i]).hasClass('switcher')) {
                Utilizer.setTogglerValue(keys[i], data[keys[i]]);
            } else if ($("#" + keys[i]).is('div')) {
                $("#" + keys[i]).html(data[keys[i]]);
            } else {
                $("#" + keys[i]).val(data[keys[i]]);
            }
        }
    }

    Utilizer.setDireccion = function(id) {
        $('#' + id).on('change', Utilizer.loadDireccion);
    }

});