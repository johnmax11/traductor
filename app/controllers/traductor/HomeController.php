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
        //echo \Auth::check();exit;
        if (!\Auth::check()){
            return \View::make("/");
        }
        
        /**verificamos si es primera vez*/
        $bolFS = false;
        if(\Auth::user()->password == \Auth::user()->password_old){
            /**user primera vez*/
            $bolFS = true;
        }
        return \View::make("traductor/home")->with('bolFirstSession',$bolFS);
    }

}
