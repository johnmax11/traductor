<?php
namespace traductor\settings;
class SettingsController extends \BaseController {

  public function getDataTraductor(){

    try{
      /**verificamos session*/
      if(\utilidades::verifySessionRol(__NAMESPACE__) != null){
        return \utilidades::verifySessionRol(__NAMESPACE__);
      }
            
      $arrResponse = new \stdClass();
            
      /**consultamos la tabla users*/
      $objFacUsers = new \facUsers();
      $arrDUSers = $objFacUsers->getUsers(array(
        'id||=||'.\Auth::user()->id
      ));
      if(count($arrDUSers)==0){
        throw new \Exception("no existen los datos del usuario --> ".\Auth::user()->id);
      }
            
      /**consultamos la tabla account data***/
      $objFacAccountData = new \facAccountData();
      $arrDAccountData = $objFacAccountData->getAccountData(array(
        'users_id||=||'.$arrDUSers[0]->id
      ));
      
      if(count($arrDAccountData)==0){
        throw new \Exception("no existen los datos del usuario en account data --> ".\Auth::user()->id);
      }
            
      /**consultamos la tabla account data communications**/
      $arrDAccDatComm = $objFacAccountData->getAccountDataCommunications(array(
        'account_data_id||=||'.$arrDAccountData[0]->id
      ));
      if(count($arrDAccDatComm)==0){
        throw new \Exception(
          "no existen los datos del usuario en account data communications --> ".\Auth::user()->id
        );
      }

      /**consultamos la tabla languajes*/
      $objFacLanguaje = new \facLanguajeData();
      $arrLanguajes = $objFacLanguaje->getLanguajeData();

      if(count($arrLanguajes)==0){
        throw new \Exception("no existen lenguajes");
      }

      /**consultamos la tabla countries*/
      $objFacLocationTZ = new \facLocationTZ();
      $arrCountries = $objFacLocationTZ->getCountriesData();
      if(count($arrCountries)==0){
        throw new \Exception("no existen paises");
      }

      /**consultamos la tabla cities*/
      $arrCities = $objFacLocationTZ->getCitiesData();
      if(count($arrCities)==0){
        throw new \Exception("no existen ciudades");
      }

      /**consultamos la tabla timezone*/
      $arrTimeZone = $objFacLocationTZ->getTimeZoneData();
      if(count($arrTimeZone)==0){
        throw new \Exception("no existen time zone");
      }

      /** consultamos el pais del usuario en sesion */
      $arrLanguajeUser = $objFacLanguaje->getLanguajeData(array(
        'id||=||'.$arrDAccountData[0]->params_languajes
      ));
      
      if(count($arrLanguajeUser)==0){
        throw new \Exception(
          "no existen los datos del usuario en params languajes --> ".\Auth::user()->id
        );
      }

      /** consultamos el pais del usuario en sesion */
      $arrCountryUser = $objFacLocationTZ->getCountriesData(array(
        'code||=||'.$arrDAccountData[0]->params_countries
      ));

      if(count($arrCountryUser)==0){
        throw new \Exception(
          "no existen los datos del usuario en params countries --> ".\Auth::user()->id
        );
      }

      /** consultamos la ciudad del usuario en sesion */
      $arrCityUser = $objFacLocationTZ->getCitiesData(array(
        'code_country||=||'.$arrCountryUser[0]->code
      ));

      if(count($arrCityUser)==0){
        throw new \Exception(
          "no existen los datos del usuario en params cities --> ".\Auth::user()->id
        );
      }

      /** consultamos el time zone del usuario en sesion */
      /*
      $arrTimeZoneUser = $objFacLocationTZ->getTimeZoneData(array(
        'account_data_id||=||'.$arrDAccountData[0]->id
      ));
         
      if(count($arrTimeZoneUser)==0){
        throw new \Exception(
          "no existen los datos del usuario en params time zone --> ".\Auth::user()->id
        );
      }

      */

      $arrResponse->rows[0] = new \stdClass();

      $arrResponse->rows[0]->email_account = $arrDUSers[0]->email;
      $arrResponse->rows[0]->active = $arrDUSers[0]->active;
            
      $arrResponse->rows[0]->first_name_account = $arrDAccountData[0]->first_name;
      $arrResponse->rows[0]->first_middle_name_account = $arrDAccountData[0]->middle_name;
      $arrResponse->rows[0]->last_name_account = $arrDAccountData[0]->last_first_name;
      $arrResponse->rows[0]->last_middle_name_account = $arrDAccountData[0]->last_middle_name;
            
      $arrResponse->rows[0]->email_notification_1_account = $arrDAccDatComm[0]->email_notification_1;
      $arrResponse->rows[0]->email_notification_2_account = $arrDAccDatComm[0]->email_notification_2;
      $arrResponse->rows[0]->phone_number_1_account = $arrDAccDatComm[0]->phone_number_1;
      $arrResponse->rows[0]->phone_number_2_account = $arrDAccDatComm[0]->phone_number_2;
      $arrResponse->rows[0]->phone_number_mobile_1_account = $arrDAccDatComm[0]->phone_number_mobile_1;
      $arrResponse->rows[0]->phone_number_mobile_2_account = $arrDAccDatComm[0]->phone_number_mobile_2;

      $arrResponse->rows[0]->languajes = $arrLanguajes;
      $arrResponse->rows[0]->countries = $arrCountries;
      $arrResponse->rows[0]->cities = $arrCities;
      $arrResponse->rows[0]->time_zones = $arrTimeZone;

      $arrResponse->rows[0]->trad_languaje = $arrLanguajeUser;
      $arrResponse->rows[0]->trad_country = $arrCountryUser;
      $arrResponse->rows[0]->trad_city = $arrCityUser;

      $arrResponse->rows[0]->trad_photo = $arrDUSers[0]->photo_profile;
      //$arrResponse->rows[0]->trad_time_zone = $arrTimeZone;

      $arrResponse->error = false;
      
      return \Response::json($arrResponse);
    } catch (\Exception $ex) {
      echo $ex;
      throw $ex;
    }
  }
}