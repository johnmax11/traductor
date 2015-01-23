<?php
/**
 * Description of facUsersIncome
 *
 * @author programador1
 */
class facUsersIncome {
    //put your code here
    
    public function getUsersIncome($arrParametros = null,$arrGroupBy=null,$arrOrderBy=null,$arrLimit=null){
        try{
            $objModel = new UsersIncome();
            
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
     * inserta en la tabla users income
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @date 21-01-2015
     * @param type $arrParametros
     * @return boolean
     */
    public function setInsertUsersIncome($arrParametros = array()){
        try{
            $objUsersIncome = new UsersIncome();
            if(isset($arrParametros->timestamp_exit)){
                $objUsersIncome->timestamp_exit = $arrParametros->timestamp_exit;
            }
            $objUsersIncome->created_by = Auth::user()->id;
            $objUsersIncome->updated_at = null;
            
            $objUsersIncome->save();
            return $objUsersIncome->id;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    /**
     * actualiza la tabla users income
     * 
     * @param type $arrParametros
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @date 21-01-2015
     * @return boolean
     * @throws Exception
     */
    public function setUpdateUsersIncome($arrParametros = array()){
        try{
            $objUsersIncome = new UsersIncome();
            $objUsersIncome = $objUsersIncome::findOrCreate(isset($arrParametros->custom_c)?$arrParametros->custom_c:'id',isset($arrParametros->coustom_v)?$arrParametros->custom_c:$arrParametros->id);
            if(isset($arrParametros->timestamp_exit)){
                $objUsersIncome->timestamp_exit = $arrParametros->timestamp_exit;
            }
            $objUsersIncome->updated_by = Auth::user()->id;
            
            $objUsersIncome->save();
            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
