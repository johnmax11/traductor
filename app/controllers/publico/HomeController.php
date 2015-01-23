<?php

namespace publico;

class HomeController extends \BaseController {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index() {
        return \View::make("public/home");
    }

    /**
     * Metodo encargado de leer los documentos subidos, cuenta las palabras 
     * del cuerpo del documento, encabezados, pies de pagina
     * @return Json
     * @param string $file ruta de donde esta alojado el archivo
     * @author Carlos andres ruales <carlos.ruales@syslab.so>
     * 
     */
    public function readFiles($file,$ruta) {
        try {
            //print_r($file);
            //$objClassFiles= new \classFilesCounting($file, $extension);
            $laravelSession= \Cookie::get('laravel_session');
            $objFacTmpCotizador= new \facTmpCotizador();
            $objFacTmpCotizador->setInsertTmpCotizador((object)array(
                "laravel_session_id"=>$laravelSession,
                "archivo"=>$file
            ));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * Metodo encargado de validar las extensiones, si se envio y no esta vacia la variable 
     * y de guardar en la ruta que se especifique
     * @return Json
     * @param string $file ruta de donde esta alojado el archivo
     * @author Carlos andres ruales <carlos.ruales@syslab.so>
     * 
     */
    public function setFiles($ruta, $extensiones) {
        try {
            // Clase encargada de validar y de hacer el proceso del documento
            $obj = new \fileUploader($extensiones);

            //ruta donde se guardara el documento
            $result = $obj->handleUpload($ruta,true);

            return $result;
        } catch (\Exception $e) {
            return \Response::make($e->getMessage(), 400);
        }
    }

    public function setFilesMain() {
        try {
            //guardamos en un array todo lo viene de los input
            $files = \Input::all();
           
            
           //print_r($_SERVER);
           
           $navegador= get_browser(filter_input(INPUT_SERVER, 'HTTP_USER_AGENT'), true);//filter_input(INPUT_SERVER, 'HTTP_USER_AGENT');
           //print_r($navegador);
           
 

            //si no se envio o esta vacio lanzamos un error
            if ($files['qqfile'] == null || $files['qqfile'] == "") {
                throw new \Exception("Has ocurred a problem: the file not exits or It's empty");
            }
            
            //ruta donde se guardara el documento
            
            
            $ruta = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/traductor/public/files/';
            // extensiones de documentos permitidos
            $extensiones = $arrExtensions = array("doc", "docx", "ppt", "pptx", "pdf", "csv", "txt");

            $result= $this->setFiles($ruta, $extensiones);

            //identificamos que se guardo el documento y realizamos el conteo
            if (isset($result['success'])) {
                $this->readFiles($result['file'],$ruta);
            }
            //respuesta del proceso 
            echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        } catch (\Exception $e) {
            return \Response::make($e->getMessage(), 400);
        }
    }
    
    

}
