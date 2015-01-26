<?php
namespace admin\settings;
class CadminsController extends \BaseController {

    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function index()
    {
        /**verificamos session*/
        if(\utilidades::verifySessionRol(__NAMESPACE__) != null){
            return \utilidades::verifySessionRol(__NAMESPACE__);
        }
        
        return \View::make("admin/settings/cadmins");
    }
    
    /**
     * guarda los datos de un account en las tablas basicas en create account
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @date 25-01-2015
     * @param null
     * @return json
     * @throws \admin\settings\Exception
     */
    public function GuardarDatosCadmins(){
        try{
            /**verificamos session*/
            if(\utilidades::verifySessionRol(__NAMESPACE__) != null){
                return \utilidades::verifySessionRol(__NAMESPACE__);
            }
            
            $reglas = array(
                'txtEmail'=>'required|Email',
                'txtStatus_user'=>'required',
                'txtFirst_name'=>'required|Min:3|Max:255',
                'txtMiddle_name'=>'Min:3|Max:255',
                'txtLast_name'=>'required|Min:3|Max:255',
                'txtLast_middle_name'=>'Min:3|Max:255',
                'txtEmail_1'=>'required|Email',
                'txtEmail_2'=>'Email',
                'txtPhone_1'=>'Max:255',
                'txtPhone_2'=>'Max:255',
                'txtPhoneMobile_1'=>'Max:255',
                'txtPhoneMobile_2'=>'Max:255',
            );
            
            $validar = \Validator::make(\Input::all(), $reglas);
            if ($validar->fails()) {
                return \Response::json([
                    'error' => true,
                    'msj'=>"Errors in form",
                    'mensajeError' => $validar->getMessageBag()->toArray()
                ]);
            }
            
            /*validamos que el email principal no este registrdo**/
            $bolValido = $this->valVerificarEmail(\Input::get('txtEmail'));
            if($bolValido == false){
                return \Response::json([
                    'error' => true,
                    'msj'=>"Errors in form",
                    'mensajeError' => array('txtEmail'=>'Email already exist')
                ]);
            }
            
            /********************************************/
            \DB::connection()->getPdo()->beginTransaction();
                /**creamos el registro en latabla users*/
                $strAl = \utilidades::RandomString(10);
                $strAl = \Hash::make($strAl);
                $objFacUsers = new \facUsers();
                $lastIdUs = $objFacUsers->setInsertUsers((object)array(
                    'security_roles_id'=>2,
                    'email'=>\Input::get('txtEmail'),
                    'password'=>$strAl,
                    'password_old'=>$strAl,
                    'active'=>\Input::get('txtStatus_user')
                ));
            
                /**inseertmos la tabla account data y account data communications*/
                $objFacAccountData = new \facAccountData();
                if(!$objFacAccountData->processCreateAccountData((object)array(
                    'users_id'=>$lastIdUs,
                    'first_name'=>\Input::get('txtFirst_name'),
                    'middle_name'=>\Input::get('txtMiddle_name'),
                    'last_first_name'=>\Input::get('txtLast_name'),
                    'last_middle_name'=>\Input::get('txtLast_middle_name'),
                    'active'=>\Input::get('txtStatus_user'),
                    'email_notification_1'=>\Input::get('txtEmail_1'),
                    'email_notification_2'=>\Input::get('txtEmail_2'),
                    'phone_number_1'=>\Input::get('txtPhone_1'),
                    'phone_number_2'=>\Input::get('txtPhone_2'),
                    'phone_number_mobile_1'=>\Input::get('txtPhoneMobile_1'),
                    'phone_number_mobile_2'=>\Input::get('txtPhoneMobile_2'),
                ))){
                    throw new \Exception("Error creando la new account_data");
                }
                
                /**send email a usuario con new password*/
                /*\Mail::send('emails.auth.newusuario', array('firstName'=>\Input::get('txtFirst_name'),'emailUser'=>\Input::get('txtEmail_1'),'newPassword'=>$strAl), function($message){
                    $message->to(\Auth::user()->email,$arrDAccData[0]->first_name)
                            ->subject('Welcome Trustlations');
                });*/
                
            \DB::connection()->getPdo()->commit();
            
            return \Response::json(array("msj"=>"Proceso terminado correctamente","error"=>false));
        } catch (\Exception $ex) {
            \DB::connection()->getPdo()->rollBack();
            throw $ex;
        }
    }
    
    /**
     * valida el email q no se encuentra registrado
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @date 26-01-2015
     * @return json
     * @param null
     * @throws \admin\settings\Exception
     */
    public function ValidateEmail(){
        try{
            /**consultamos si existe el email en la bd**/
            $bolValido = $this->valVerificarEmail(\Input::get('email'));
            
            if($bolValido == true){
                return \Response::json(array("valido"=>true,"msj"=>"Email valido","error"=>false));
            }else{
                return \Response::json(array("valido"=>false,"msj"=>"Email already exist","error"=>false));
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
    
    /**
     * valida que el email no existe en la base de datos
     * 
     * @param type $strEmail
     * @return boolean
     * @throws \Exception
     */
    private function valVerificarEmail($strEmail){
        try{
            /**consultamos si existe el email en la bd**/
            $objFacUSers = new \facUsers();
            $arrDUs = $objFacUSers->getUsers(array(
                "email||=||".$strEmail,
                "active||=||Y"
            ));
            
            if(count($arrDUs)==0){
                return true;
            }else{
                return false;
            }
        } catch (\Exception $ex) {
            throw $ex;  
        }
    }
}
