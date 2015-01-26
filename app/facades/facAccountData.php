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
    
}
