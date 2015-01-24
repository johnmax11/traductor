$(document).ready(function(){
    /**
     * funciones para iniciar desde el cargue de la pagina
     */
    function ajaxIndexTrigger(){
        this.setInsertUpdateIniSession = function(){
            
            /***/
            setInterval(
                function(){
                    var arrSl = window.location.pathname.split("/");
                    if(arrSl.length>=5){
                        $.ajaxFrm({
                            url: public_path+"/Auth/index",
                            preload:false,
                            success: function(params,msg){
                                //$.alertDialog({mensaje:msg.msj});
                            }
                        });
                    }
                },
                300000
            );
        }
    }
    
    
    /**
     * funciones para menejo de strings
     */
    function strFunctions(){
        this.setUcWordsAll = function(){
            $('.ucwords').keyup(function(){
                this.value = $.fn.ucwords(this.value.toLowerCase());
            });
        }
        
        this.ucwords = function(str){
            return (str + '').replace(/^([a-z])|\s+([a-z\u00E0-\u00FC])/g, function($1) {
                return $1.toUpperCase();
            });
        }
    }
    
    /**
     * funciones para validar
     */
    function valFunctions(){
        /**
        * validar error en reponse ajax y limpiar preload y animations after
        **/
        this.validateResponse = function(msg, id_div_pre, ind_anim) {
           /** validamos si existe session cerrada */
           if (msg.code != null) {
               alert(msg.msj);
               eval(msg.code);
               return;
           }

           if (id_div_pre != undefined) {
               $('#' + id_div_pre).html('');
           } else {
               id_div_pre = 'divDialogPreloadFullScreen';
               $('#' + id_div_pre).dialog('close');
               $('#' + id_div_pre).remove();
           }

           ind_anim = (ind_anim == undefined ? '' : ind_anim);
           $('#img_animt-' + ind_anim).remove();
           if (msg.error != null && msg.error == true) {
               alert((msg.msj == null ? 'Error: en response del request' : msg.msj));
               return false;
           } else {
               if (msg == null || msg.error == null) {
                   alert('Error: Ocurrio un error en el response del request');
                   return false;
               }
           }
           return true;
        },
                
        /***
        valida el posible error de resposne de ajax
        */
       this.validate_error = function(ObjErr) {
           // show mensaje error //
           alert('Ocurrio un problema en el proceso, se realizaron las siguientes acciones\n\n' +
                   '*Se han bloqueado los botones por seguridad, para realizar de nuevo el proceso debera actualizar la pagina\n' +
                   '*Se ha enviado un email al administrador del sistema con la informacion del error\n' +
                   '*Por favor verificar si realizo los cambios que deseaba hacer o si por el contrario no realizo ningun cambio'
                   );
           $('#divPreload-ui').remove();
           $("#divDialogPreloadFullScreen").dialog('destroy');
           $("#divDialogPreloadFullScreen").remove();
       }
    }
    var valFunctions = new valFunctions();
    /****/
    jQuery.extend({
        ajaxFrm : function(args){
            
            args = jQuery.extend({
                preload:true,
                type : 'POST',
                dataType : 'json',
                beforeSend:function(){(args.preload?$.preload('Guardando Cambios...',true):false)},
                error:function(jqXHR){valFunctions.validate_error(jqXHR)},
                success:function(){},
                params:{}
            }, args);
            /***/
            $.ajax({
                url: args.url,
                type:args.type,
                data: args.data,
                dataType:args.dataType,
                beforeSend:args.beforeSend,
                error:args.error,
                success: function(msg){
                    if(valFunctions.validateResponse(msg,null)){
                        eval('var as_f = ('+args.success+')');
                        as_f(args.params,msg);
                    }else{

                    }
                }
            });
        }
    });
    
    jQuery.extend({
        alertDialog : function(args){
            args = jQuery.extend({
                'id': 'dialog_info',
                'id_dialog': 'divDialog_add_dialog',
                'titulo':'Informacion...',
                'idicono':'ui-icon-info',
                'mensaje':'&nbsp;',
                'buttons': {
                    "Ok":function(){
                       $(this).dialog("close");
                       $('#' + args.id).remove();
                    }
                },
                'width':400,
                'autoopen':true
            }, args);
            
            $('#' + args.id).remove();
            var strhtml = "<div id='div_" + args.id + "' title='"+args.titulo+"'>";
            strhtml += "<table>";
            strhtml += "    <tr>";
            strhtml += "        <th>";
            strhtml += "            <img src='"+public_path+"/images/dialog-information.png'/>";
            strhtml += "        </th>";
            strhtml += "        <td style='font-family:verdana;'>";
            strhtml += "            <span class='ui-icon "+args.idicono+"' style='float: left; margin-right: .3em;'>hola</span>";
            strhtml +=              args.mensaje;
            strhtml += "        </td>";
            strhtml += "    </tr>";
            strhtml += "</table>";
            strhtml += "</div>";
            //$("body").html(strhtml);
            $(strhtml).appendTo("body");
            $("#div_" + args.id).dialog({
                autoOpen: (args.autoopen!=undefined?args.autoopen:false),
                modal: true,
                width: args.width,
                heigth: args.heigth,
                buttons: args.buttons,
                show: {effect: 'bounce', duration: 1250},
                hide: {effect: 'scale', duration: 500}
            }).parent('.ui-dialog').find('.ui-dialog-titlebar-close').remove();
        },
        
        /***/
        confirmDialog : function(args) {
            // delete obj //
            $('#divDialogUtilidades').remove();

            var html = "<div id='divDialogUtilidades' title='Confirmar...' class=''>";
            html += "		<div id='divPreloadReferenciaOtros' style='font-family:verdana;color:red;' align='center'></div>";
            html += "		<div style='color:blue;font-size:small;font-style:verdana;' class='ui-corner-all'>";
            if (args.msj != undefined && args.msj != null) {
                html += "		<p><table style='width:100%;'><tr><th><img src='"+public_path+"/images/dialog-help.png'/></th><td>" + args.msj + "</td></tr></table></p>";
            } else {
                html += "		<p>Realmente desea confirmar los datos?</p>";
            }
            html += "		</div>";

            html += "	</div>";
            // append body //
            $('body').append(html);

            $('#divDialogUtilidades').dialog({
                autoOpen: true,
                modal: true,
                buttons: {
                    "Si": function() {
                        if (args.si != undefined && args.si != null) {
                            eval(args.si());
                        }
                        $(this).dialog('close');
                        $('#divDialogUtilidades').remove();
                        return true;
                    },
                    "No": function() {
                        $(this).dialog('close');
                        if (args.no != undefined && args.no != null) {
                            eval(args.no());
                        }
                        return false;
                    }
                },
                show: {effect: 'size', duration: 500}
            });
        },
    
        /***/
        preload : function() {
            $("#divDialogPreloadFullScreen").remove();
            var strhtml = "<div id='divDialogPreloadFullScreen' title='Procesando...'>";
            strhtml += "</div>";
            $('body').append(strhtml);
            $("#divDialogPreloadFullScreen").dialog({
                autoOpen: true,
                modal: true,
                draggable: false,
                resizable: false,
                height: 120,
                width: 'auto',
                close: function() {
                    //$('#divDialogPreloadFullScreen').remove();
                }
            }).parent('.ui-dialog').find('.ui-dialog-titlebar-close').remove();
            // set html //
            $("#divDialogPreloadFullScreen").dialog('widget').
                    find(".ui-dialog-titlebar").css({
                        "float": "right",
                        border: 0,
                        padding: 0
                    })
                    .find(".ui-dialog-title").css({
                        display: "none"
                    }).end()
                    .find(".ui-dialog-titlebar-close").css({
                        top: 0,
                        right: 0,
                        margin: 0,
                        "z-index": 999
                    });
            $("#divDialogPreloadFullScreen").dialog('open');
            $("#divDialogPreloadFullScreen").html('<center><img src="'+public_path+'/images/preload.gif"></center>');
            //console.log($("#divDialogPreloadFullScreen").html());
        }
    });
    
    $.fn.validateForm = function(form, tipo, paint_e) {
        tipo = (tipo == undefined ? 'alert' : 'msj');

        $.fn.removerClassValidate(form);
        var bolvalidate = true;
        var arrStr = [];
        $("#" + form).find('.validate').each(function() {
            var elemento = this;
            $('#img_rsp_' + elemento.id).remove();
            // separamos las palabras //
            arrStr = $.fn.separarPalabras(elemento.id.substring(3));
            // validamos que el campo no este vacio //
            if (jQuery.trim(elemento.value) == '') {
                bolvalidate = false;

                $(this).addClass("ui-state-error");
                if(paint_e!=false){
                    if (tipo == 'alert') {
                        alert("Campo Requerido: (" + arrStr.toUpperCase() + ")");
                    } else {
                        $.fn.remove_lbl_error($(this));
                        $(this).after('<br id="b' + elemento.id + '"/><span id="s' + elemento.id + '" style="color:red;">Campo Obligatorio</span><br id="ulb' + elemento.id + '"/>');
                    }
                }
                $.fn.reset_campo($(this));
                //return false;
            }
            // validamos la longitud del campo //
            if ($(this).attr('pattern')) {
                var arr_m_m = $.fn.get_min_max_length(this);
                if (!$.fn.check_length($(this), arrStr.toUpperCase(), arr_m_m, tipo, paint_e)) {
                    bolvalidate = false;
                    $.fn.reset_campo($(this));
                    //return false;
                }
            }
            // verificamos si es el usuario //
            if (elemento.id == 'txtUsuario_usuario') {
                if ($.fn.test_rex($(this), $.fn.validate_word_unique()) == false) {
                    bolvalidate = false;
                    $(this).addClass("ui-state-error");
                    if(paint_e!=false){
                        var strmsj = "En el campo : (" + arrStr.toUpperCase() + ") unicamente se permite una palabra con solo letras y numeros sin espacios a-z, 0-9, comenzando con una letra";
                        if (tipo == 'alert') {
                            alert(strmsj);
                        } else {
                            $.fn.remove_lbl_error($(this));
                            $(this).after('<br id="b' + elemento.id + '"/><span id="s' + elemento.id + '" style="color:red;">' + strmsj + '</span><br id="ulb' + elemento.id + '"/>');
                        }
                    }
                    $.fn.reset_campo($(this));
                  //  return false;
                }
            }
            // validamos los tipo email //
            if ($(this).attr('type') == 'email' && $.fn.test_rex($(this), $.fn.rexp_validate_email()) == false) {
                bolvalidate = false;
                $(this).addClass("ui-state-error");
                if(paint_e!=false){
                    var strmsj = "En el campo : (" + arrStr.toUpperCase() + ") el email esta incorrecto, ej. example@correo.com";
                    if (tipo == 'alert') {
                        alert(strmsj);
                    } else {
                        $.fn.remove_lbl_error($(this));
                        $(this).after('<br id="b' + elemento.id + '"/><span id="s' + elemento.id + '" style="color:red;">' + strmsj + '</span><br id="ulb' + elemento.id + '"/>');
                    }
                }
                $.fn.reset_campo($(this));
                //return false;
            }
            /***/
            if ($(this).attr('type') == 'number' && $.fn.test_rex($(this), $.fn.rex_validate_numeros_positivos_enteros()) == false) {
                bolvalidate = false;
                $(this).addClass("ui-state-error");
                if(paint_e!=false){
                    var strmsj = "El campo : (" + arrStr.toUpperCase() + ") solo recibe numero(s) entero(s)";
                    if (tipo == 'alert') {
                        alert(strmsj);
                    } else {
                        $.fn.remove_lbl_error($(this));
                        $(this).after('<br id="b' + elemento.id + '"/><span id="s' + elemento.id + '" style="color:red;">Campo Numerico Positivo</span><br id="ulb' + elemento.id + '"/>');
                    }
                }
                $.fn.reset_campo($(this));
                //return false;
            }
        });
        if (bolvalidate == false) {
            return false;
        } else {
            return true;
        }
    }

    /***/
    $.fn.remove_lbl_error = function(obj) {
        $('#b' + obj.attr('id')).remove();
        $('#ulb' + obj.attr('id')).remove();
        $('#s' + obj.attr('id')).remove();
    }

    /***/
    $.fn.reset_campo = function(obj) {
        obj.val('');
        obj.focus();
    }

    /**
     * retorna el minimi y maximo de un campo input
     **/
    $.fn.get_min_max_length = function(obj) {
        var strpat = $(obj).attr('pattern');
        strpat = (strpat.substring(strpat.indexOf('{') + 1, (strpat.lastIndexOf('}') - strpat.indexOf('{')) + 1));

        return(eval('[' + strpat + ']'));
    }

    /**
     * valida un campo de tamaño min y maximo
     **/
    $.fn.check_length = function(o, n, min_max, tipo_alert, tips, paint_e) {
        min_max[1] = (min_max[1] == null ? 999 : min_max[1])
        if (o.val().length < min_max[0] || o.val().length > min_max[1]) {
            var strmsj = '';
            if (min_max[1] != 999) {
                strmsj = "La cantidad de caracteres del campo (" + n + ") debe estar entre " + min_max[0] + " y " + min_max[1];
            } else {
                strmsj = "La cantidad de caracteres del campo (" + n + ") debe ser mayor a " + min_max[0];
            }
            o.addClass("ui-state-error");
            if(paint_e!=false){
                if (tipo_alert == 'alert') {
                    alert(strmsj);
                } else {
                    if (tipo_alert == 'msj') {
                        $.fn.remove_lbl_error(o);
                        o.after('<br id="b' + o.attr('id') + '"/><span id="s' + o.attr('id') + '" style="color:red;">' + strmsj + '</span>');
                    } else {
                        if (tipo_alert == 'div_up') {
                            $.fn.update_tips(strmsj, tips);
                        }
                    }
                }
            }
            return false;
        } else {
            return true;
        }
    }

    /**
     * valida email
     **/
    $.fn.rexp_validate_email = function() {
        return /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i
    }

    /**
     * valida solo caracteres alfanumerico
     **/
    $.fn.rex_validate_alfanumericos = function() {
        return /^([0-9a-zA-Z])+$/
    }
    
    /*
     * valdiate numeros 1-9
     * **/
    $.fn.rex_validate_numeros_positivos_enteros = function() {
        return /[0-9]+/
    }

    /**
     * valida palabra unica
     **/
    $.fn.validate_word_unique = function() {
        return /^[a-z]([0-9a-z_])+$/i
    }

    $.fn.update_tips = function(t, tips) {
        tips.html('<img src="'+public_path+'/images/info_peque.png"/>' + t).addClass("ui-state-highlight");
        /*setTimeout(function() {
         tips.removeClass( "ui-state-highlight", 1500 );
         }, 500 );*/
    }

    /**
     * evalua reg exp
     **/
    $.fn.test_rex = function(o, regexp) {
        if (!(regexp.test(o.val()))) {
            return false;
        } else {
            return true;
        }
    }

    /***/
    $.fn.removerClassValidate = function(form) {
        $("#" + form).find('.validate').each(function() {
            $(this).removeClass("ui-state-error");
            $('#s' + this.id).remove();
            $('#b' + this.id).remove();
            $('#ulb' + this.id).remove();
        });
    }

    /***/
    $.fn.separarPalabras = function(str) {
        var arrStr = str.split("_");
        var strEnd = "";
        for (var i = 0; i < arrStr.length; i++) {
            strEnd += arrStr[i] + " ";
        }
        return strEnd.substring(0, strEnd.length - 1);
    }

    /**
     * valida que 2 campos sean iguales
     **/
    $.fn.fnValidaCamposDesIguales = function(obj, obj2, tipo) {
        tipo = (tipo == undefined ? 'alert' : 'msj');
        if ($(obj).val().trim() != '' && $(obj2).val().trim() != '' && $(obj).val().trim() != $(obj2).val().trim()) {
            obj.addClass("ui-state-error");
            obj2.addClass("ui-state-error");

            var strmsj = "El valor de estos 2 campos no coinciden ";

            if (tipo == 'alert') {
                alert(strmsj);
            } else {
                $.fn.remove_lbl_error(obj);
                $.fn.remove_lbl_error(obj2);
                obj.after('<br id="b' + obj.attr('id') + '"/><span id="s' + obj.attr('id') + '" style="color:red;">' + strmsj + '</span>');
                obj2.after('<br id="b' + obj2.attr('id') + '"/><span id="s' + obj2.attr('id') + '" style="color:red;">' + strmsj + '</span>');
            }
            $(obj2).val("");
            $(obj).val("");
            $(obj).focus();
            return false;
        } else {
            return true;
        }
    }
    
    /**************************************************************************/
    /**trigger actions*********************************************************/
    var ajaxIndexTrigger = new ajaxIndexTrigger();
    /***iniciamos la actualizacion de fecha de cierre de session*/
    ajaxIndexTrigger.setInsertUpdateIniSession();
});

