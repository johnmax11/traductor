<?php
namespace cliente;
class HomeController extends \BaseController {

    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function index()
    {
        /**verificamos session*/
        if(\utilidades::verifySessionRol(__NAMESPACE__) != null){
            return \utilidades::verifySessionRol(__NAMESPACE__);
        }
        
        return \View::make("cliente/home");
    }

}
