<?php

/**
 * Description of classFilesCounting
 *
 * @author Andres
 * @version 1.0
 * @return int 
 * @param string $file ruta de donde esta alojado el archivo
 * @author Carlos andres ruales <carlos.ruales@syslab.so>
 * 2015-01-23
 */
class classFilesCounting {

    public function __construct($file, $extension) {
        $result = $this->getCountFiles($file, $extension);
        return $result;
    }

    public function getCountFiles($filename, $extension) {
        try {
            $striped_content = '';
            $content = '';

            if (!$filename || !file_exists($filename))
                return false;

            $zip = zip_open($filename);

            if (!$zip || is_numeric($zip))
                return false;


            while ($zip_entry = zip_read($zip)) {
                
                if (zip_entry_open($zip, $zip_entry) == FALSE)
                    continue;

                if (zip_entry_name($zip_entry) != "word/header2.xml")
                    continue;

                $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

                zip_entry_close($zip_entry);
            }

            zip_close($zip);	

            $content = str_replace('</w:r></w:p></w:tc><w:tc>', "", $content);
            $content = str_replace('</w:r></w:p>', "", $content);
            $striped_content = strip_tags($content);

            return $striped_content;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    private function getXmlNotation($extension, $page, $boolHeader = null) {
        try {
            if (is_null($extension) || empty($extension)) {
                return false;
            }
            
            // devuelve los xml de power point
            if ($extension == 'ppt' || $extension == 'pptx') {
                $arrExtension = array(
                    "body" => $extension . "/slides/slide" . $page . ".xml"
                );

                if (!is_null($boolHeader)) {
                    $arrExtension['header'] = $extension . "/notesSlides/notesSlide" . $page . ".xml";
                }

                return $arrExtension;
            }

            // devuelve los xml de los word

            if ($extension == 'doc' || $extension == 'docx') {
                $arrExtension = array(
                    "body" => "word/document.xml"
                );

                if (!is_null($boolHeader)) {
                    $arrExtension['header'] = "word/header2.xml";
                }

                return $arrExtension;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
