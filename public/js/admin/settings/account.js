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
            url: public_path+"/admin/settings/account/loaddataaccout",
            success: function(params,msg){
                /**set datos en pantalla**/
                $('#txtEmail').val(msg.rows[0].email_account);
                
                $('#txtFirst_name').val(msg.rows[0].first_name_account);
                $('#txtMiddle_name').val(msg.rows[0].first_middle_name_account);
                $('#txtLast_name').val(msg.rows[0].last_name_account);
                $('#txtLast_middle_name').val(msg.rows[0].last_middle_name_account);
                
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
