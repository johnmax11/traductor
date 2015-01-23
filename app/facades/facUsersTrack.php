<?php
/**
 * Description of facUsersTrack
 *
 * @author programador1
 */
class facUsersTrack {
    //put your code here
    
    /**
     * inserta en la tabla users track
     * 
     * @author john jairo cortes garcia <john.cortes@syslab.so>
     * @date 21-01-2015
     * @param type $arrParametros
     * @return boolean
     */
    public function setInsertUsersTrack($arrParametros = array()){
        try{
            $objUsersTrack = new UsersTrack();
            $objUsersTrack->url_track = $arrParametros->url_track;
            $objUsersTrack->ip_address = $arrParametros->ip_address;
            $objUsersTrack->created_by = Auth::user()->id;
            $objUsersTrack->updated_at = null;
            
            $objUsersTrack->save();
            return $objUsersTrack->id;
        } catch (Exception $ex) {
            return false;
        }
    }
}
