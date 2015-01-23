$(document).ready(function(){
    
    /**
     * funciones para iniciar desde el cargue de la pagina
     */
    function ajaxIndexTrigger(){
        this.setInsertUpdateIniSession = function(){
            
            /***/
            setInterval(
                function(){
                    var arrSl = window.location.pathname.split("/")
                    if(arrSl.length>=5){
                        $.ajaxFrm({
                            url: "../Auth/index",
                            preload:false,
                            success: function(params,msg){
                                $.alertDialog({mensaje:msg.msj});
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
                        var as_f = eval('('+args.success+')');
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
            strhtml += "            <img src='images/dialog-information.png'/>";
            strhtml += "        </th>";
            strhtml += "        <td style='font-family:verdana;'>";
            strhtml += "            <span class='ui-icon "+args.idicono+"' style='float: left; margin-right: .3em;'>hola</span>";
            strhtml +=              args.mensaje;
            strhtml += "        </td>";
            strhtml += "    </tr>";
            strhtml += "</table>";
            strhtml += "</div>";
            //$("body").html(strhtml);
            $(strhtml).appendTo("#divBody");
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
                html += "		<p><table style='width:100%;'><tr><th><img src='images/dialog-help.png'/></th><td>" + args.msj + "</td></tr></table></p>";
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
                height: 130,
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
            $("#divDialogPreloadFullScreen").html('<center><img src="../images/preload.gif"></center>');
            //console.log($("#divDialogPreloadFullScreen").html());
        }
    });
    
    /**************************************************************************/
    /**trigger actions*********************************************************/
    var ajaxIndexTrigger = new ajaxIndexTrigger();
    /***iniciamos la actualizacion de fecha de cierre de session*/
    ajaxIndexTrigger.setInsertUpdateIniSession();
});

