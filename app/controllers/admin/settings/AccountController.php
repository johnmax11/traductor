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
    
    public function GuardarDatosAccount(){
        try{
            
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function CargarDatosById(){
        try{
            $arrResponse = new \stdClass();
            
            /**consultamos la tabla users*/
            $objFacUsers = new \facUsers();
            $arrDUSers = $objFacUsers->getUsers(array(
                'id||=||'.\Auth::user()->id
            ));
            
            /**consultamos la tabla account data***/
            $objFacAccountData = new \facAccountData();
            $arrDAccountData = $objFacAccountData->getAccountData((object)array(
                'users_id||=||'.$arrDUSers[0]->id
            ));
            
            /**consultamos la tabla account data communications**/
            $arrDAccDatComm = $objFacAccountData->getAccountDataCommunications((object)array(
                'account_data_id||=||'.$arrDAccountData[0]->id
            ));
            
            $arrResponse->rows[0] = new \stdClass();
            $arrResponse->rows[0]->email_account = $arrDUSers[0]->email;
            $arrResponse->rows[0]->status = $arrDUSers[0]->status;
            
            $arrResponse->rows[0]->first_name_account = $arrDAccountData[0]->first_name;
            $arrResponse->rows[0]->first_middle_name_account = $arrDAccountData[0]->first_middle_name;
            $arrResponse->rows[0]->last_name_account = $arrDAccountData[0]->last_name;
            $arrResponse->rows[0]->last_middle_name_account = $arrDAccountData[0]->last_middle_name;
            
            $arrResponse->rows[0]->email_notification_1_account = $arrDAccDatComm[0]->email_notification_1;
            $arrResponse->rows[0]->email_notification_2_account = $arrDAccDatComm[0]->email_notification_2;
            $arrResponse->rows[0]->phone_number_1_account = $arrDAccDatComm[0]->phone_number_1;
            $arrResponse->rows[0]->phone_number_2_account = $arrDAccDatComm[0]->phone_number_2;
            $arrResponse->rows[0]->phone_number_mobile_1_account = $arrDAccDatComm[0]->phone_number_mobile_1;
            $arrResponse->rows[0]->phone_number_mobile_2_account = $arrDAccDatComm[0]->phone_number_mobile_2;
            
            Response::json(array($arrResponse,'error'=>false));
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
