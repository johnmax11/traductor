<?php
namespace publico;
class HomeController extends \BaseController {

    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function index()
    {
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
            echo "new";
            $obj= new \nuevaclase();
            //$uploader = new \hola\qqFileUploader($allowedExtensions, $sizeLimit);
            //$obj= new \uploadFiles\qqFileUploader($uno,$dos);
            //$obj->handleUpload($uploadDirectory);
            //echo $uploader;
            //echo "holaa" . \Input::all();
            /*
              if (\Input::hasFile('qqfile')) {
              //
              }else{
              echo "no es nada";
              }
              $file = \Input::file('qqfile');
              print_r($file);

             *
             * 
             */
            //$files = array("file" => \Request::post("qqfile"));



            if ($file['qqfile'] == null || $file['qqfile'] == "") {
                throw new \Exception("Has ocurred a problem: the file not exits or it's empty");
            }

            $rules = array(
                'file' => 'mimes:pdf,doc,docx,ppt,pptx,xls,txt',
                'size' => '1024000'
            );


            $validation = \Validator::make($file, $rules);



            if ($validation->fails()) {
                throw new \Exception($validation->errors()->first());
            } else {
                return \Response::make('success', 200);
            }


            //print_r($files);
        } catch (\Exception $e) {
            // echo $e;
            return \Response::make($e->getMessage(), 400);
        }
    }

    private function uploadFiles() {
        
    }

}
