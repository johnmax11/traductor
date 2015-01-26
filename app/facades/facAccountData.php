<?php
/**
 * Description of facAccountData
 *
 * @author programador1
 */
class facAccountData {
    //put your code here
    
    /**
     * consulta la table account data
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @param type $arrParametros
     * @param type $arrGroupBy
     * @param type $arrOrderBy
     * @param type $arrLimit
     * @return type
     * @throws Exception
     */
    public function getAccountData($arrParametros = null,$arrGroupBy=null,$arrOrderBy=null,$arrLimit=null){
        try{
            $objModel = new AccountData();
            
            $strExQy = "";
            /**verificamos clausulas where*/
            if($arrParametros!=null){
                $strExQy = utilidades::concatMethodWhere($arrParametros);
            }
            
            /**veriificamos group by*/
            if($arrGroupBy!=null){
                $strExQy .= "->group_by(".$arrGroupBy.")";
            }
            
            /**verificamos order by*/
            if($arrOrderBy!=null){
                $strExQy .= utilidades::concatMethodOrderBy($arrOrderBy);
            }
            
            /**verificamos limites**/
            if($arrLimit!=null){
                $strExQy .= "->skip(".$arrLimit[0].")->take(".$arrLimit[1].")";
            }
            eval('$arrResult = $objModel'.$strExQy.'->get();');
            return $arrResult;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    /**
     * consulta la table account data communications
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @param type $arrParametros
     * @param type $arrGroupBy
     * @param type $arrOrderBy
     * @param type $arrLimit
     * @return type
     * @throws Exception
     */
    public function getAccountDataCommunications($arrParametros = null,$arrGroupBy=null,$arrOrderBy=null,$arrLimit=null){
        try{
            $objModel = new AccountDataCommunications();
            
            $strExQy = "";
            /**verificamos clausulas where*/
            if($arrParametros!=null){
                $strExQy = utilidades::concatMethodWhere($arrParametros);
            }
            
            /**veriificamos group by*/
            if($arrGroupBy!=null){
                $strExQy .= "->group_by(".$arrGroupBy.")";
            }
            
            /**verificamos order by*/
            if($arrOrderBy!=null){
                $strExQy .= utilidades::concatMethodOrderBy($arrOrderBy);
            }
            
            /**verificamos limites**/
            if($arrLimit!=null){
                $strExQy .= "->skip(".$arrLimit[0].")->take(".$arrLimit[1].")";
            }
            eval('$arrResult = $objModel'.$strExQy.'->get();');
            return $arrResult;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    /**
     * actualiza la tabla account data
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @date 24-01-2015
     * @param type $arrParametros
     * @return boolean
     * @throws Exception
     */
    public function setUpdateAccountData($arrParametros = array()){
        try{
            $objAccountData = new AccountData();
            $objAccountData = $objAccountData::findOrCreate((isset($arrParametros->custom_c)?$arrParametros->custom_c:'id'),(isset($arrParametros->custom_v)?$arrParametros->custom_v:$arrParametros->id));
            if(isset($arrParametros->first_name)){
                $objAccountData->first_name = $arrParametros->first_name;
            }
            if(isset($arrParametros->middle_name)){
                $objAccountData->middle_name = $arrParametros->middle_name;
            }
            if(isset($arrParametros->last_first_name)){
                $objAccountData->last_first_name = $arrParametros->last_first_name;
            }
            if(isset($arrParametros->last_middle_name)){
                $objAccountData->last_middle_name = $arrParametros->last_middle_name;
            }
            if(isset($arrParametros->active)){
                $objAccountData->active = $arrParametros->active;
            }
            $objAccountData->updated_by = Auth::user()->id;
            $objAccountData->updated_at = @date('Y-m-d h:i:s');
            
            $objAccountData->save();
            return $objAccountData->id;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    /**
     * inserta la tabla account data
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @date 25-01-2015
     * @param type $arrParametros
     * @return boolean
     * @throws Exception
     */
    public function setInsertAccountData($arrParametros = array()){
        try{
            $objAccountData = new AccountData();
            $objAccountData->users_id = $arrParametros->users_id;
            $objAccountData->first_name = $arrParametros->first_name;
            if(isset($arrParametros->middle_name)){
                $objAccountData->middle_name = $arrParametros->middle_name;
            }
            $objAccountData->last_first_name = $arrParametros->last_first_name;
            if(isset($arrParametros->last_middle_name)){
                $objAccountData->last_middle_name = $arrParametros->last_middle_name;
            }
            if(isset($arrParametros->active)){
                $objAccountData->active = $arrParametros->active;
            }
            $objAccountData->created_by = Auth::user()->id;
            $objAccountData->created_at = @date('Y-m-d h:i:s');
            
            $objAccountData->save();
            return $objAccountData->id;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    /**
     * actualiza la tabla account data communications
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @date 24-01-2015
     * @param type $arrParametros
     * @return boolean
     * @throws Exception
     */
    public function setUpdateAccountDataCommunications($arrParametros = array()){
        try{
            $objAccountDataCommunications = new AccountDataCommunications();
            $objAccountDataCommunications = $objAccountDataCommunications::findOrCreate((isset($arrParametros->custom_c)?$arrParametros->custom_c:'id'),(isset($arrParametros->custom_v)?$arrParametros->custom_v:$arrParametros->id));
            if(isset($arrParametros->email_notification_1)){
                $objAccountDataCommunications->email_notification_1 = $arrParametros->email_notification_1;
            }
            if(isset($arrParametros->email_notification_2)){
                $objAccountDataCommunications->email_notification_2 = $arrParametros->email_notification_2;
            }
            if(isset($arrParametros->phone_number_1)){
                $objAccountDataCommunications->phone_number_1 = $arrParametros->phone_number_1;
            }
            if(isset($arrParametros->phone_number_2)){
                $objAccountDataCommunications->phone_number_2 = $arrParametros->phone_number_2;
            }
            if(isset($arrParametros->phone_number_mobile_1)){
                $objAccountDataCommunications->phone_number_mobile_1 = $arrParametros->phone_number_mobile_1;
            }
            if(isset($arrParametros->phone_number_mobile_2)){
                $objAccountDataCommunications->phone_number_mobile_2 = $arrParametros->phone_number_mobile_2;
            }
            $objAccountDataCommunications->updated_by = Auth::user()->id;
            $objAccountDataCommunications->updated_at = @date('Y-m-d h:i:s');
            
            $objAccountDataCommunications->save();
            return $objAccountDataCommunications->id;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    /**
     * inserta la tabla account data communications
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @date 25-01-2015
     * @param type $arrParametros
     * @return boolean
     * @throws Exception
     */
    public function setInsertAccountDataCommunications($arrParametros = array()){
        try{
            $objAccountDataCommunications = new AccountDataCommunications();
            $objAccountDataCommunications->account_data_id = $arrParametros->account_data_id;
            $objAccountDataCommunications->email_notification_1 = $arrParametros->email_notification_1;
            if(isset($arrParametros->email_notification_2)){
                $objAccountDataCommunications->email_notification_2 = $arrParametros->email_notification_2;
            }
            if(isset($arrParametros->phone_number_1)){
                $objAccountDataCommunications->phone_number_1 = $arrParametros->phone_number_1;
            }
            if(isset($arrParametros->phone_number_2)){
                $objAccountDataCommunications->phone_number_2 = $arrParametros->phone_number_2;
            }
            if(isset($arrParametros->phone_number_mobile_1)){
                $objAccountDataCommunications->phone_number_mobile_1 = $arrParametros->phone_number_mobile_1;
            }
            if(isset($arrParametros->phone_number_mobile_2)){
                $objAccountDataCommunications->phone_number_mobile_2 = $arrParametros->phone_number_mobile_2;
            }
            $objAccountDataCommunications->created_by = Auth::user()->id;
            $objAccountDataCommunications->created_at = @date('Y-m-d h:i:s');
            
            $objAccountDataCommunications->save();
            return $objAccountDataCommunications->id;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    /**
     * create un account data y account communications
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @date 25-01-2015
     * @return boolean
     * @param type $arrParametros
     * @throws Exception
     */
    public function processCreateAccountData($arrParametros = array()){
        try{
            /**actualizamos la tabla account data*/
            $lasIdAccDat = $this->setInsertAccountData((object)array(
                'users_id'=>$arrParametros->users_id,
                'first_name'=>$arrParametros->first_name,
                'middle_name'=>$arrParametros->middle_name,
                'last_first_name'=>$arrParametros->last_first_name,
                'last_middle_name'=>$arrParametros->last_middle_name,
                'active'=>$arrParametros->active
            ));

            /**actualizamos la tabla account data communications**/
            $this->setInsertAccountDataCommunications((object)array(
                'account_data_id'=>$lasIdAccDat,
                'email_notification_1'=>$arrParametros->email_notification_1,
                'email_notification_2'=>$arrParametros->email_notification_2,
                'phone_number_1'=>$arrParametros->phone_number_1,
                'phone_number_2'=>$arrParametros->phone_number_2,
                'phone_number_mobile_1'=>$arrParametros->phone_number_mobile_1,
                'phone_number_mobile_2'=>$arrParametros->phone_number_mobile_2,
            ));
            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function processUpdateAccountData($arrParametros = array()){
        try{
            /**actualizamos la tabla account data*/
            $lasIdAccDat = $this->setUpdateAccountData((object)array(
                'custom_c'=>'users_id',
                'custom_v'=>$arrParametros->users_id,
                'first_name'=>$arrParametros->first_name,
                'middle_name'=>$arrParametros->middle_name,
                'last_first_name'=>$arrParametros->last_first_name,
                'last_middle_name'=>$arrParametros->last_middle_name
            ));

            /**actualizamos la tabla account data communications**/
            $this->setUpdateAccountDataCommunications((object)array(
                'custom_c'=>'account_data_id',
                'custom_v'=>$lasIdAccDat,
                'email_notification_1'=>$arrParametros->email_notification_1,
                'email_notification_2'=>$arrParametros->email_notification_2,
                'phone_number_1'=>$arrParametros->phone_number_1,
                'phone_number_2'=>$arrParametros->phone_number_2,
                'phone_number_mobile_1'=>$arrParametros->phone_number_mobile_1,
                'phone_number_mobile_2'=>$arrParametros->phone_number_mobile_2,
            ));
            
            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
