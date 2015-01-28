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
    public function readFiles($file, $ruta, $lastIdTmpCotizador) {
        try {
            $acumWords = 0;
            $objCounting = new \classFilesCounting($ruta . $file);
            $contenido = $objCounting->getCountFiles();
            $resultados = explode("/", $contenido);

            //print_r($resultados);

            foreach ($resultados as $string) {
                if (!empty($string)) {
                    $arrString = explode(" ", $string);

                    //print_r($arrString);
                    foreach ($arrString as $string) {
                        $string=ltrim($string);
                        if (empty($string) || is_null($arrString)) {
                            continue;
                        } else {
                            $acumWords ++;
                        }
                    }
                }
            }
            $objUpdCotizador = new \facTmpCotizador();
            $objUpdCotizador->setUpdateTmpCotizador((object) array(
                        "id" => $lastIdTmpCotizador,
                        "words" => $acumWords
            ));



            return $acumWords;
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
            $result = $obj->handleUpload($ruta, true);

            return $result;
        } catch (\Exception $e) {
            return \Response::make($e->getMessage(), 400);
        }
    }

    public function setFilesMain() {
        try {
            //guardamos en un array todo lo viene de los input
            $files = \Input::all();
            
            //si no se envio o esta vacio lanzamos un error
            if ($files['qqfile'] == null || $files['qqfile'] == "") {
                throw new \Exception("Has ocurred a problem: the file not exits or It's empty");
            }

            //ruta donde se guardara el documento
            $ruta = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/traductor/public/files/';
            
            // extensiones de documentos permitidos
            $extensiones = $arrExtensions = array("doc", "docx", "ppt", "pptx", "pdf", "txt","xlsx","xls");

            $result = $this->setFiles($ruta, $extensiones);

            //identificamos que se guardo el documento y realizamos el conteo
            if (isset($result['success'])) {
                //Guardamos en base de datos si el archivo se cargo bien
                $laravelSession = \Cookie::get('laravel_session');
                $objFacTmpCotizador = new \facTmpCotizador();
                $lastIdTmpCotizador = $objFacTmpCotizador->setInsertTmpCotizador((object) array(
                            "laravel_session_id" => $laravelSession,
                            "archivo" => $result['file']
                ));
                //Una vez guardado el archivo en BD, se lee la cantidad de palabras
                $sentences = $this->readFiles($result['file'], $ruta, $lastIdTmpCotizador);
                $result['sentences'] = $sentences;
            }

            //respuesta del proceso 
            echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        } catch (\Exception $e) {
            return \Response::make($e->getMessage(), 400);
        }
    }

}
