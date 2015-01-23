<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
    return View::make('publico/home');
});

// Nos mostrará el formulario de login.
Route::get('login', 'AuthController@showLogin');
// Validamos los datos de inicio de sesión.
Route::post('login', 'AuthController@postLogin');
/******************************************************************************/
/**rutas del publico***********************************************************/

/**************************************************************************/
// Nos indica que las rutas que están dentro de él sólo serán mostradas si antes el usuario se ha autenticado.
Route::group(array('before' => 'auth'), function()
{
    /**insert track***/
    $objFacUsersTrack = new facUsersTrack();
    $objFacUsersTrack->setInsertUsersTrack((object)array(
        'url_track'=>Request::url(),
        'ip_address'=>Request::getClientIp()
    ));
        
    // Esta será nuestra ruta de bienvenida.
    Route::get('root/home',"root\HomeController@index");
    // Esta será nuestra ruta de bienvenida.
    Route::get('admin/home',"admin\HomeController@index");
    // Esta será nuestra ruta de bienvenida.
    Route::get('traductor/home',"traductor\HomeController@index");
    // Esta será nuestra ruta de bienvenida.
    Route::get('cliente/home',"cliente\HomeController@index");

    // Esta ruta nos servirá para cerrar sesión.
    Route::get('logout', 'AuthController@logOut');
    // ruta para actualiza periodicamente el ssession
    Route::post('Auth/index','AuthController@updateSession');
    
    /**************************************************************************/
    /**rutas del root**********************************************************/
    
    /**************************************************************************/
    
    /***************************************************************************/
    /**rutas del admin**********************************************************/
    Route::get('admin/settings/index',function(){
        return View::make("admin/settings/index");
    });
    Route::get('admin/settings/account',"admin\AccountController@index");
    /**************************************************************************/
    
    /**************************************************************************/
    /**rutas del cliente********************************************************/
    
    /**************************************************************************/
    
    /***************************************************************************/
    /**rutas del traductor******************************************************/
    
    /**************************************************************************/
});