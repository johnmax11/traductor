<?php
/**
 * Description of utilidades
 *
 * @author vanessa
 */
class utilidades {
    //put your code here
    
    /**
     * crea string con metodos where
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @date 22-01-2015
     * @param type $arrWhere
     * @return type
     * @throws Exception
     */
    static function concatMethodWhere($arrWhere){
        try{
            $strQry = "";
            for($i=0;$i<count($arrWhere);$i++){
                $strExp = explode("||",$arrWhere[$i]);
                $strQry .= "->where('".$strExp[0]."','".$strExp[1]."','".$strExp[2]."')";
            }
            return ($strQry);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    /**
     * concatena las clausulas order by
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @date 21-01-2015
     * @param type $arrORderBy
     * @return type
     * @throws Exception
     */
    static function concatMethodOrderBy($arrORderBy){
        try{
            $strQry = "";
            for($i=0;$i<count($arrORderBy);$i++){
                $strExp = explode("||",$arrORderBy[$i]);
                $strQry .= "->orderBy('".$strExp[0]."','".$strExp[1]."')";
            }
            return ($strQry);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    static function verifySessionRol($namespace){
        try{
            $namespace = explode('\\',$namespace);
            $namespace = $namespace[0];
            /**verificamos si esta en session*/
            if (!\Auth::check()){
                return \View::make("/");
            }
            $numRol = Auth::user()->security_roles_id;
            switch($numRol){
                case 1;
                    if($namespace!="root"){
                       return Redirect::to('root/home');
                    }
                    break;
                case 2;
                    if($namespace!="admin"){
                       return Redirect::to("admin/home");
                    }
                    break;
                case 3;
                    if($namespace!="traductor"){
                       return Redirect::to("traductor/home");
                    }
                    break;
                case 4;
                    if($namespace!="cliente"){
                       return Redirect::to("cliente/home");
                    }
                    break;
            }
            return null;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    /*put your code here*/    
    static function RandomString($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE){        
        $source = 'abcdefghijklmnopqrstuvwxyz';        
        if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';        
        if($n==1) $source .= '1234567890';        
        if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';        
        if($length>0){            
            $rstr = "";            
            $source = str_split($source,1);            
            for($i=1; $i<=$length; $i++){                
                //echo $rstr;
                mt_srand((double)microtime() * 1000000);                
                $num = mt_rand(1,count($source));
                $rstr .= $source[$num-1];            
            }        
        }        
        return $rstr;
    }
}
