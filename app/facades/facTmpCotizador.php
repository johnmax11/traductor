<?php

/**
 * Description of facTmpCotizador
 * @author Andres
 * @version 1.0
 * @return int 
 * @param string $file ruta de donde esta alojado el archivo
 * @author Carlos andres ruales <carlos.ruales@syslab.so>
 * 2015-01-23
 */
class facTmpCotizador {

    public function setInsertTmpCotizador($arrParametros = array()) {
        try {
            $objUsersTrack = new TmpCotizador();
            $objUsersTrack->laravel_session_id = $arrParametros->laravel_session_id;
            $objUsersTrack->archivo = $arrParametros->archivo;

            $objUsersTrack->save();
            
            return $objUsersTrack->id;
        } catch (Exception $ex) {
            return false;
        }
    }

}
