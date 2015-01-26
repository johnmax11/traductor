<?php
namespace admin\settings;
class AccountController extends \BaseController {

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
        
        return \View::make("admin/settings/account");
    }
    
    /**
     * guarda los datos de un account en las tablas basicas
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @date 24-01-2015
     * @param null
     * @return json
     * @throws \admin\settings\Exception
     */
    public function GuardarDatosAccount(){
        try{
            /**verificamos session*/
            if(\utilidades::verifySessionRol(__NAMESPACE__) != null){
                return \utilidades::verifySessionRol(__NAMESPACE__);
            }
            
            $reglas = array(
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
            
            \DB::connection()->getPdo()->beginTransaction();
                /**actualizamos la tabla account data y communications*/
                $objFacAccountData = new \facAccountData();
                if(!$objFacAccountData->processUpdateAccountData((object)array(
                    'users_id'=>\Auth::user()->id,
                    'first_name'=>\Input::get('txtFirst_name'),
                    'middle_name'=>\Input::get('txtMiddle_name'),
                    'last_first_name'=>\Input::get('txtLast_name'),
                    'last_middle_name'=>\Input::get('txtLast_middle_name'),
                    'email_notification_1'=>\Input::get('txtEmail_1'),
                    'email_notification_2'=>\Input::get('txtEmail_2'),
                    'phone_number_1'=>\Input::get('txtPhone_1'),
                    'phone_number_2'=>\Input::get('txtPhone_2'),
                    'phone_number_mobile_1'=>\Input::get('txtPhoneMobile_1'),
                    'phone_number_mobile_2'=>\Input::get('txtPhoneMobile_2'),
                ))){
                    throw new Exception("Error actualizando el account");
                }
                
            \DB::connection()->getPdo()->commit();
            
            return \Response::json(array("msj"=>"Proceso terminado correctamente","error"=>false));
        } catch (\Exception $ex) {
            \DB::connection()->getPdo()->rollBack();
            throw $ex;
        }
    }
    
    /**
     * cargar los datos de un account por el id del account
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @date 23-01-2015
     * @param null
     * @return json
     * @throws \admin\settings\Exception
     */
    public function CargarDatosById(){
        try{
            /**verificamos session*/
            if(\utilidades::verifySessionRol(__NAMESPACE__) != null){
                return \utilidades::verifySessionRol(__NAMESPACE__);
            }
            
            $arrResponse = new \stdClass();
            
            /**consultamos la tabla users*/
            $objFacUsers = new \facUsers();
            $arrDUSers = $objFacUsers->getUsers(array(
                'id||=||'.\Auth::user()->id
            ));
            if(count($arrDUSers)==0){
                throw new \Exception("no existen los datos del usuario --> ".\Auth::user()->id);
            }
            
            /**consultamos la tabla account data***/
            $objFacAccountData = new \facAccountData();
            $arrDAccountData = $objFacAccountData->getAccountData(array(
                'users_id||=||'.$arrDUSers[0]->id
            ));
            if(count($arrDAccountData)==0){
                throw new \Exception("no existen los datos del usuario en account data --> ".\Auth::user()->id);
            }
            
            /**consultamos la tabla account data communications**/
            $arrDAccDatComm = $objFacAccountData->getAccountDataCommunications(array(
                'account_data_id||=||'.$arrDAccountData[0]->id
            ));
            if(count($arrDAccDatComm)==0){
                throw new \Exception("no existen los datos del usuario en account data communications --> ".\Auth::user()->id);
            }
            
            $arrResponse->rows[0] = new \stdClass();
            
            $arrResponse->rows[0]->email_account = $arrDUSers[0]->email;
            $arrResponse->rows[0]->active = $arrDUSers[0]->active;
            
            $arrResponse->rows[0]->first_name_account = $arrDAccountData[0]->first_name;
            $arrResponse->rows[0]->first_middle_name_account = $arrDAccountData[0]->middle_name;
            $arrResponse->rows[0]->last_name_account = $arrDAccountData[0]->last_first_name;
            $arrResponse->rows[0]->last_middle_name_account = $arrDAccountData[0]->last_middle_name;
            
            $arrResponse->rows[0]->email_notification_1_account = $arrDAccDatComm[0]->email_notification_1;
            $arrResponse->rows[0]->email_notification_2_account = $arrDAccDatComm[0]->email_notification_2;
            $arrResponse->rows[0]->phone_number_1_account = $arrDAccDatComm[0]->phone_number_1;
            $arrResponse->rows[0]->phone_number_2_account = $arrDAccDatComm[0]->phone_number_2;
            $arrResponse->rows[0]->phone_number_mobile_1_account = $arrDAccDatComm[0]->phone_number_mobile_1;
            $arrResponse->rows[0]->phone_number_mobile_2_account = $arrDAccDatComm[0]->phone_number_mobile_2;
            $arrResponse->error = false;
            return \Response::json($arrResponse);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
    
    /**
     * se encargar d resetear el password del usuario en session
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @date 25-01-2015
     * @param null
     * @return type
     * @throws \Exception
     */
    public function ResetPassword(){
        try{
            /**verificamos session*/
            if(\utilidades::verifySessionRol(__NAMESPACE__) != null){
                return \utilidades::verifySessionRol(__NAMESPACE__);
            }
            
            \DB::connection()->getPdo()->beginTransaction();
                $strH = \Hash::make(\utilidades::RandomString(10));

                $objFacUsers = new \facUsers();
                $objFacUsers->setUpdateUsers((object)array(
                    'id'=>\Auth::user()->id,
                    'password'=>$strH,
                    'password_old'=>$strH
                ));

                /**consultamos los datos del usuario*/
                $objFacAccountData = new \facAccountData();
                $arrDAccData = $objFacAccountData->getAccountData(array(
                    "id||=||".\Auth::user()->id
                ));

                /**send email a usuario con new password*/
                /*\Mail::send('emails.auth.resetpassword', array('firstName'=>$arrDAccData[0]->first_name,'emailUser'=>\Auth::user()->email,'newPassword'=>$strH), function($message){
                    $message->to(\Auth::user()->email,$arrDAccData[0]->first_name)->subject('Reset Passrword Trustlations');
                });*/
                /**close session actual*/
                \Auth::logout();
                \Session::flush();
            
            \DB::connection()->getPdo()->commit();
            
            return \Response::json(array('msj'=>'Proceso terminado correctamente','code'=>'location.reload()'));
        } catch (\Exception $ex) {
            \DB::connection()->getPdo()->rollBack();
            throw $ex;
        }
    }

}
