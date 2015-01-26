/**
* valida que los datos este llenos del formulario
* 
* @author john jairo cortes garcia <john.cortes@syslab.so>
* @returns {account_L1.valFunctionsDocument}
*/
function valFunctionsDocument(){
   this.validateFormPreSend = function(){
       if(!$.fn.validateForm("frmAccount",true,false)){
           return false;
       }
       /**validamos email iguales*/
       if(!$.fn.fnValidaCamposDesIguales($('#txtEmail'),$('#txtEmailR'),'msj')){
           $('#txtEmail_1').val('');
           return false;
       }
       
       return true;
   }
}

/**
 * funcioens basicas del archivo
 * 
 * @author john jairo cortes garcia <john.cortes@syslab.so>
 * @returns {genFuntionsVarias}
 */
function genFuntionsVarias(){
    
    /**
     * enviar datos al server mediante ajax
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @data 24-01-2015
     * @param {null}
     * @returns {undefined}
     */
    this.sendDataSave = function(){
        /**enviamos el documento*/
        $.ajaxFrm({
            url: public_path+"admin/settings/cadmins/save",
            data:$('#frmAccount').serialize(),
            success: function(params,msg){
                $.alertDialog({mensaje:msg.msj,buttons:{Ok:function(){location.reload();}}});
            }
        });
    }
}

/**
* carga eventos iniciales
* 
* @returns {account_L1.index}
*/
function index(){
   this.__contruct = function(){
       $('#bttnSubmit').click(function(){
           var objValFunctionsDocument = new valFunctionsDocument();
           /**validamos datos antes de enviarlos*/
           if(!objValFunctionsDocument.validateFormPreSend()){
               return false;
           }else{
               var objGenFuntionsVarias = new genFuntionsVarias();
               /**se envian los datos*/
               $.confirmDialog({
                   msj:"Really create administrator?",
                   Yes:function(){objGenFuntionsVarias.sendDataSave();}
               });
               
           }
       });
       
       /**set onkeyup*/
       $('#txtEmail').keyup(function(){
           $('#txtEmail_1').val($(this).val());
       });
   }
}

$(document).ready(function(){
    var objIndex = new index();
    objIndex.__contruct();
});
