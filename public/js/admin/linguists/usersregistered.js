/**
* valida que los datos este llenos del formulario
* 
* @author john jairo cortes garcia <john.cortes@syslab.so>
* @returns {account_L1.valFunctionsDocument}
*/
function valFunctionsDocument(){
   
}

/**
 * funcioens basicas del archivo
 * 
 * @author john jairo cortes garcia <john.cortes@syslab.so>
 * @returns {genFuntionsVarias}
 */
function genFuntionsVarias(){
    
    /**
     * llama a l grilla coirrespondiente enviando el parametros type
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @date 26-01-2015
     * @param {type} typeUser
     * @returns {undefined}
     */
    this.getDataUsers = function(typeUser){
        /**enviamos el documento*/
        switch(typeUser){
            case 2:
                setGridUserType("Administradores","admin",2);
                break;
            case 3:
                setGridUserType("Traductores","trans",3);
                break;
            case 4:
                setGridUserType("Clientes","clien",4);
                break;
        }
    }
    
    /**
     * se encarga  ellenar la grilla
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @date 26-01-2015
     * @param {type} title
     * @param {type} postfx
     * @returns {undefined}
     */
    function setGridUserType(title,postfx,type){
        jQuery("#griddatoscx_"+postfx).jqGrid({ 
            url:public_path+"admin/linguists/usersregistered/loadusersbytype",
            datatype: "json", 
            mtype: 'POST',
            postData:{typeUser:type},
            colNames:['id','EMAIL',],
            colModel:[ 
                 {name:'id',index:'id',editable:false,hidden:true},
                 {name:'email',index:'email', align:"center",editable:false},
            ],
            loadError:function(xhr,status,error){
                var msg = eval(xhr.responseText);
                alert('Error: En el response de la grilla ---> ');
            },
            onSelectRow: function(id){
                if(id!=null){
                    gblIdRow = id;
                }
            },
            rowNum:50, 
            rowList:[50,100,200,300,500],
            pager: '#pagerdatoscx_'+postfx, 
            sortname: 'id',
            width:800,
            height:300,
            viewrecords: true,  
            rownumbers: true,
            sortorder: "asc",
            caption:title
         }); 
         //$.fn.config_grilla(jQuery("#griddatoscx"));
         //$.fn.add_crud_grilla(jQuery("#griddatoscx"),true,true,true);
    }
    
}

/**
* carga eventos iniciales
* 
* @returns {account_L1.index}
*/
function index(){
    var objGenFuntionsVarias = new genFuntionsVarias();
    /**
     * 
     * @returns {undefined}
     */
    this.__contruct = function(){
       /****/
       $('#divTabs').tabs();
       /**cargamos los usuarios en las grillas*/
       /**admin**/
       objGenFuntionsVarias.getDataUsers(2);
       /**traductores**/
       objGenFuntionsVarias.getDataUsers(3);
       /**cliente**/
       objGenFuntionsVarias.getDataUsers(4);
    }
}

$(document).ready(function(){
    var objIndex = new index();
    objIndex.__contruct();
});
