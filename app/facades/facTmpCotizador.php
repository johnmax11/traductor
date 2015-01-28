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

    public function setUpdateTmpCotizador($arrParametros = array()) {
        try {
            $objTmpCotizador = new TmpCotizador();
            $objTmpCotizador = $objTmpCotizador::findOrCreate("id",$arrParametros->id);
            if (isset($arrParametros->words)) {
                $objTmpCotizador->words = $arrParametros->words;
            }
            $objTmpCotizador->save();
            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function getTmpCotizador($arrParametros = array()) {
        try {
            $objTmpCotizador = new TmpCotizador();
            $objTmpCotizador = $objTmpCotizador::findOrCreate("id",$arrParametros->id);
            if (isset($arrParametros->words)) {
                $objTmpCotizador->words = $arrParametros->words;
            }
            $objTmpCotizador->save();
            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
