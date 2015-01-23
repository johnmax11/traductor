<?php

class AuthController extends BaseController {
    /*
    |--------------------------------------------------------------------------
    | Controlador de la autenticación de usuarios
    |--------------------------------------------------------------------------
    */
	
	/**
     * Muestra el formulario para login.
     */
    public function showLogin()
    {
        // Verificamos que el usuario no esté autenticado
        if (Auth::check())
        {
            // Si está autenticado lo mandamos a la raíz donde estara el mensaje de bienvenida.
            return Redirect::to('/')->with('bolFirstSession',$bolFS);
        }
        // Mostramos la vista login.blade.php (Recordemos que .blade.php se omite.)
        return View::make('publico/home');
    }
	
	/**
     * Valida los datos del usuario.
     */
    public function postLogin()
    {
        // Guardamos en un arreglo los datos del usuario.
        $userdata = array(
            'email' => Input::get('email'),
            'password'=> Input::get('password'),
            'active'=>"Y"
        );
        // Validamos los datos y además mandamos como un segundo parámetro la opción de recordar el usuario.
        if(Auth::attempt($userdata, Input::get('remember-me', 0)))
        {
            /**verificamos el rol del usuario**/
            /**root sistema**/
            if(Auth::user()->security_roles_id == 1){
                // De ser datos válidos nos mandara a la bienvenida
                return Redirect::to('root/home');
            }else{
                /**admin del sistema**/
                if(Auth::user()->security_roles_id == 2){
                    // De ser datos válidos nos mandara a la bienvenida
                    return Redirect::to('admin/home');
                }else{
                    /**traductor sistema**/
                    if(Auth::user()->security_roles_id == 3){
                        /**verificamos si es primera vez*/
                        $bolFS = false;
                        if(Auth::user()->password == Auth::user()->password_old){
                            /**user primera vez*/
                            $bolFS = true;
                        }
                        // De ser datos válidos nos mandara a la bienvenida
                        return Redirect::to('traductor/home')->with('bolFirstSession',$bolFS);
                    }else{
                        /**cliente del sistema**/
                        if(Auth::user()->security_roles_id == 4){
                            // De ser datos válidos nos mandara a la bienvenida
                            return Redirect::to('cliente/home');
                        }
                    }
                }
            }
            
        }
        // En caso de que la autenticación haya fallado manda un mensaje al formulario de login y también regresamos los valores enviados con withInput().
        return Redirect::to('/')
                    ->with('mensaje_error', 'Tus datos son incorrectos')
                    ->withInput();
    }
	
	/**
     * Muestra el formulario de login mostrando un mensaje de que cerró sesión.
     */
    public function logOut()
    {
        Auth::logout();
        return Redirect::to('/')
                    ->with('mensaje_error', 'Tu sesión ha sido cerrada.');
    }
}