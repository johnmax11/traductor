/**
* valida que los datos este llenos del formulario
* 
* @author john jairo cortes garcia <john.cortes@syslab.so>
* @returns {account_L1.valFunctionsDocument}
*/
function valFunctionsDocument(){
   this.validateFormPreSend = function(){
       if(!$.fn.validateForm("frmAccount",true)){
           return false;
       }
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
     * carga los datos del account
     * 
     * @returns {undefined}
     */
    this.cargarInfoAccount = function(){
        $.ajaxFrm({
            url: "../../admin/settings/account/loaddataaccout",
            success: function(params,msg){
                $.alertDialog({mensaje:""});
            }
        });
    }
}

/**
* caraga eventos iniciales
* 
* @returns {account_L1.index}
*/
function index(){
   this.__contruct = function(){
       $('#bttnSubmit').click(function(){
           var objValFunctionsDocument = new valFunctionsDocument();
           if(!objValFunctionsDocument.validateFormPreSend()){
               console.log('aotreoo');
               return;
           }else{
               console.log('aca');
               /**enviamos el documento*/
           }
       });
   }
}

$(document).ready(function(){
    var objIndex = new index();
    objIndex.__contruct();
    
    /**caragamos los datos del admin**/
    var objGenFuntionsVarias = new genFuntionsVarias();
    objGenFuntionsVarias.cargarInfoAccount();
});
