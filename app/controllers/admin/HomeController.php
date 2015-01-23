<?php
namespace admin;
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
        
        return \View::make("admin/home");
    }

}
