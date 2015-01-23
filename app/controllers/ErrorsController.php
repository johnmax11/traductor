<?php
class ErrorsController extends BaseController {

    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function index()
    {
        return Redirect::to('errors');
    }

}
