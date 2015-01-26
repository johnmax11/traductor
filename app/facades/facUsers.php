<?php
/**
 * Description of facUsers
 *
 * @author programador1
 */
class facUsers {
    //put your code here
    
    /**
     * consulta la table users
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @param type $arrParametros
     * @param type $arrGroupBy
     * @param type $arrOrderBy
     * @param type $arrLimit
     * @return type
     * @throws Exception
     */
    public function getUsers($arrParametros = null,$arrGroupBy=null,$arrOrderBy=null,$arrLimit=null){
        try{
            $objModel = new User();
            
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
     * inserta en la tabla users
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @date 25-01-2015
     * @param type $arrParametros
     * @return boolean
     */
    public function setInsertUsers($arrParametros = array()){
        try{
            $objUsers = new User();
            
            $objUsers->security_roles_id = $arrParametros->security_roles_id;
            $objUsers->email = $arrParametros->email;
            $objUsers->password = $arrParametros->password;
            $objUsers->password_old = $arrParametros->password_old;
            $objUsers->active = $arrParametros->active;
            
            $objUsers->created_by = Auth::user()->id;
            $objUsers->created_at = @date('Y-m-d h:i:s');
            
            $objUsers->save();
            return $objUsers->id;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    /**
     * update en la tabla users
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @date 25-01-2015
     * @param type $arrParametros
     * @return boolean
     */
    public function setUpdateUsers($arrParametros = array()){
        try{
            $objFacUsers = new User();
            $objFacUsers = $objFacUsers::findOrCreate((isset($arrParametros->custom_c)?$arrParametros->custom_c:'id'),(isset($arrParametros->custom_v)?$arrParametros->custom_v:$arrParametros->id));
            
            if(isset($arrParametros->security_roles_id)){
                $objFacUsers->security_roles_id = $arrParametros->security_roles_id;
            }
            if(isset($arrParametros->email)){
                $objFacUsers->email = $arrParametros->email;
            }
            if(isset($arrParametros->password)){
                $objFacUsers->password = $arrParametros->password;
            }
            if(isset($arrParametros->password_old)){
                $objFacUsers->password_old = $arrParametros->password_old;
            }
            if(isset($arrParametros->active)){
                $objFacUsers->active = $arrParametros->active;
            }
            
            $objFacUsers->updated_by = Auth::user()->id;
            $objFacUsers->updated_at = @date('Y-m-d h:i:s');
            
            $objFacUsers->save();
            return $objFacUsers->id;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
}
