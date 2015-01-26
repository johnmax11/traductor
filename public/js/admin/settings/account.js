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
     * carga los datos del account
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @param {null}
     * @returns {undefined}
     */
    this.cargarInfoAccount = function(){
        $.ajaxFrm({
            url: public_path+"admin/settings/account/loaddataaccout",
            success: function(params,msg){
                /**set datos en pantalla**/
                $('#txtEmail').val(msg.rows[0].email_account);
                
                $('#txtFirst_name').val(msg.rows[0].first_name_account);
                $('#txtMiddle_name').val(msg.rows[0].first_middle_name_account);
                $('#txtLast_name').val(msg.rows[0].last_name_account);
                $('#txtLast_middle_name').val(msg.rows[0].last_middle_name_account);
                $('#txtStatus_user').val(msg.rows[0].active);
                
                /****/
                $('#txtEmail_1').val(msg.rows[0].email_notification_1_account);
                $('#txtEmail_2').val(msg.rows[0].email_notification_2_account);
                
                $('#txtPhone_1').val(msg.rows[0].phone_number_1_account);
                $('#txtPhone_2').val(msg.rows[0].phone_number_2_account);
                
                $('#txtPhoneMobile_1').val(msg.rows[0].phone_number_mobile_1_account);
                $('#txtPhoneMobile_2').val(msg.rows[0].phone_number_mobile_2_account);
            }
        });
    }    
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
            url: public_path+"admin/settings/account/save",
            data:$('#frmAccount').serialize(),
            success: function(params,msg){
                $.alertDialog({mensaje:msg.msj});
            }
        });
    }
    
    /**
     * resetea el password del usuario en session
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @date 25-01-2015
     * @param null
     * @returns {undefined}
     */
    this.sendResetPassword = function(){
        /**enviamos el documento*/
        $.ajaxFrm({
            url: public_path+"admin/settings/account/resetpassword",
            success: function(params,msg){
                $.alertDialog({mensaje:msg.msj});
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
               /**se envian los datos*/
               var objGenFuntionsVarias = new genFuntionsVarias();
               objGenFuntionsVarias.sendDataSave();
           }
       });
       $('#chkResetPassword').click(function(){
           if($(this).is(':checked')){
               $.confirmDialog({
                   msj:"Really reset password?<br/><br/>- This process send email with new data<br/>- This page close actual session, re-login new data",
                   Yes:function(){
                       var objGenFuntionsVarias = new genFuntionsVarias();
                       objGenFuntionsVarias.sendResetPassword();
                   },
                   No:function(){
                       $('#chkResetPassword').prop('checked',false);
                   }
               });
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
