<?php
  namespace traductor;
  class HomeController extends \BaseController {
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function index()
    {
      if (!\Auth::check()){
        return \View::make("/");
      }
        
      /**verificamos si es primera vez*/
      if(\Auth::user()->password == \Auth::user()->password_old){
        /**user primera vez*/
        return \View::make("traductor/home");
      }
        
      return \View::make("traductor/settings");
    }
  }