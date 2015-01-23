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
     * Metodo encargado de leer los documentos a subir, cuenta las palabras 
     * del cuerpo del documento, encabezados, pies de pÃ¡gina
     * @return Json
     * @param string $file ruta de donde esta alojado el archivo
     * @author Carlos andres ruales <carlos.ruales@syslab.so>
     * 
     */
    public function readFiles() {
        return "hola";
    }

    public function setFiles() {
        try {
            $files = array("qqfile" => \Input::all());

            if ($files['qqfile'] == null || $files['qqfile'] == "") {
                throw new \Exception("Has ocurred a problem: the file not exits or it's empty");
            }

            $arrExtensions = array("doc", "docx", "ppt", "pptx", "pdf", "csv", "txt");
            $obj = new \fileUploader($arrExtensions);


            $result = $obj->handleUpload(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/proyecto/traductor/public/files/');
            echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        } catch (\Exception $e) {
            return \Response::make($e->getMessage(), 400);
        }
    }

    private function uploadFiles() {
        
    }

}
