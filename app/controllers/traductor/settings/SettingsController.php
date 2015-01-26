<?php

namespace traductor;
class SettingsController extends \BaseController {

  public function getDataTraductor(){

    try{
      if(\utilidades::verifySessionRol(__NAMESPACE__) != null){
        return \utilidades::verifySessionRol(__NAMESPACE__);
      }
              
      $arrResponse = new \stdClass();
              
      /**consultamos la tabla users*/
      $objFacUsers = new \facUsers();
      
      return \Response::json($arrResponse);
    } catch (\Exception $ex) {
      throw $ex;
    }
  }
}