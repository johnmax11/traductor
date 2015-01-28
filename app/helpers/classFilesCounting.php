<?php

use \DetectLanguage\DetectLanguage;

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

    public function __construct($file) {

        $this->extension = strrchr($file, ".");
        $this->filename = $file;
        $this->characters = array(
            "ª",
            "º",
            "!",
            "|",
            "@",
            ".",
            "#",
            "$",
            "~",
            "%",
            "€",
            "&",
            "¬",
            "/",
            "(",
            ")",
            "=",
            "?",
            "¿",
            "¡",
            "*",
            "-",
            "+",
            '\\',
            "\n",
            
        );
    }

    /**
     * Se encarga de contar las palabras de documentos word y power point
     * Cuenta: cabeceras word, cuerpo word, pie words, notas ppt, diapositivas ppt
     * @author Andres
     * @version 1.0
     * @return string
     * @param filename, extension
     * @author Carlos andres ruales <carlos.ruales@syslab.so>
     * 26-01-2015
     */
    public function getCountFiles() {
        try {

            if ($this->extension == '.doc') {
                $text = $this->getDocfile();
                return $text;
            }
            if ($this->extension == '.ppt') {
                $text = $this->getPptFile();
                return $text;
            }
            if ($this->extension == '.pptx' || $this->extension == '.docx') {
                $text = $this->getContentFile();
                return $text;
            }

            if ($this->extension == '.pdf') {
                $pdfClass = new pdfSearch();
                $pdfClass->setFilename($this->filename);
                $pdfClass->decodePDF();
                $text = utf8_encode($pdfClass->output());

                return $text;
            }

            if ($this->extension == '.xls') {
                $text = $this->getXlsFile();
                return $text;
            }

            if ($this->extension == '.xlsx') {
                $text = $this->getXlsxFile();
                return $text;
            }

            if ($this->extension == '.txt') {
                $text = $this->getTxtFile();
                return $text;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage() . " linea " . $exc->getLine();
        }
    }

    private function getContentFile() {
        try {
            $striped_content = '';
            $content = '';

            if (!$this->filename || !file_exists($this->filename)) {

                return false;
            }
            $zip = zip_open($this->filename);

            if (!$zip || is_numeric($zip)) {
                return false;
            }

            $countHeader = 1;

            while ($zip_entry = zip_read($zip)) {

                if (zip_entry_open($zip, $zip_entry) == FALSE) {
                    continue;
                }

                if ($this->extension == '.docx') {
                    if (zip_entry_name($zip_entry) == "word/document.xml") {
                        $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
                    }


                    if (zip_entry_name($zip_entry) == "word/header" . $countHeader . ".xml") {
                        $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
                        $countHeader++;
                    }

                    $currentFooter = strstr(zip_entry_name($zip_entry), 'word/footer');

                    if (zip_entry_name($zip_entry) == $currentFooter) {
                        $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
                    }
                }

                if ($this->extension == '.pptx') {

                    $currentSlide = strstr(zip_entry_name($zip_entry), 'ppt/slides/slide');

                    if (zip_entry_name($zip_entry) == $currentSlide) {
                        $content .=zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
                    }

                    $currentSlideNotes = strstr(zip_entry_name($zip_entry), 'ppt/notesSlides');

                    if (zip_entry_name($zip_entry) == $currentSlideNotes) {

                        $content .=zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
                    }
                }

                zip_entry_close($zip_entry);
            }
            zip_close($zip);

            if ($this->extension == '.pptx') {
                $striped_content = strip_tags($content, "<a:t></a:t>");
                $striped_content = str_replace(array("<a:t>", "</a:t>"), "/", $striped_content);
            }
            if ($this->extension == '.docx') {
                $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
                $content = str_replace('</w:r></w:p>', "/", $content);

                $striped_content = strip_tags($content, "<w:t xml:space = \"preserve\"></w:t><w:t></w:t>");
                $striped_content = str_replace(array("<w:t xml:space=\"preserve\">", "</w:t>", "<w:t>"), "/", $striped_content);
            }
            return $striped_content;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    private function getDocfile() {
        if (file_exists($this->filename)) {
            if (($fh = fopen($this->filename, 'r')) !== false) {
                $headers = fread($fh, 0xA00);


                // 1 = (ord(n)*1) ; Document has from 0 to 255 characters
                $n1 = ( ord($headers[0x21C]) - 1 );


                // 1 = ((ord(n)-8)*256) ; Document has from 256 to 63743 characters
                $n2 = ( ( ord($headers[0x21D]) - 8 ) * 256 );

                // 1 = ((ord(n)*256)*256) ; Document has from 63744 to 16775423 characters
                $n3 = ( ( ord($headers[0x21E]) * 256 ) * 256 );

                // 1 = (((ord(n)*256)*256)*256) ; Document has from 16775424 to 4294965504 characters
                $n4 = ( ( ( ord($headers[0x21F]) * 256 ) * 256 ) * 256 );

                // Total length of text in the document
                $textLength = ($n1 + $n2 + $n3 + $n4);

                $extracted_plaintext = fread($fh, $textLength);

                // simple print character stream without new lines
                //echo $extracted_plaintext;
                // if you want to see your paragraphs in a new line, do this
                return $extracted_plaintext;
                // need more spacing after each paragraph use another nl2br
            }
        }
    }

    private function getPptFile() {
        // This approach uses detection of the string "chr(0f).
        // Hex_value.chr(0x00).chr(0x00).chr(0x00)" to find text strings,
        // which are then terminated by another NUL chr(0x00). 
        // [1] Get text between delimiters [2] 
        $fileHandle = fopen($this->filename, "r");
        $line = @fread($fileHandle, filesize($this->filename));
        $lines = explode(chr(0x0f), $line);
        $outtext = '';

        foreach ($lines as $thisline) {
            $esto = strpos($thisline, chr(0x00) . chr(0x00) . chr(0x00));
            if (strpos($thisline, chr(0x00) . chr(0x00) . chr(0x00)) == 1) { //chr(0x00) . chr(0x00) . chr(0x00)
                $text_line = substr($thisline, 4);
                $end_pos = strpos($text_line, chr(0x00));
                $text_line = substr($text_line, 0, $end_pos);
                $text_line = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/", "", $text_line);
                if (strlen($text_line) > 1) {
                    $outtext.= substr($text_line, 0, $end_pos) . "\n";
                }
            }
        }
        $arrHeaderToErase = array("Haga clic para modificar el estilo de texto del patrn",
            "Haga clic para modificar el estilo de ttulo del patrn",
            "Segundo nivel",
            "Tercer nivel",
            "Cuarto nivel",
            "Quinto nivel");

        $outtext = str_replace($arrHeaderToErase, "", $outtext);
        $outtext = ltrim($outtext);
        $outtext = str_replace("\n", "/", $outtext);

        return $outtext;
    }

    private function getXlsFile() {
        try {
            $content = '';

            $data = new excelReader($this->filename);

            $sheets = count($data->sheets);
            for ($i = 0; $i < $sheets; $i++) {
                for ($z = 1; $z <= $data->sheets[$i]['numRows']; $z++) {
                    foreach ($data->sheets[$i]['cells'][$z] as $value) {
                        $content.="/" . $value . "/";
                    }
                }
            }

            return $content;
        } catch (Exception $exc) {
            echo $exc->getMessage() . " linea " . $exc->getLine();
        }
    }

    private function getXlsxFile() {
        try {
            $content = '';
            $xlsx = new SimpleXLSX($this->filename);
            $sheets = $xlsx->sheetsCount();
            for ($i = 1; $i <= $sheets; $i++) {
                foreach ($xlsx->rows($i) as $array) {
                    foreach ($array as $value) {
                        $content.="/" . $value . "/";
                    }
                }
            }

            return $content;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    private function getTxtFile() {
        try {
            //DetectLanguage::setApiKey("5608bbc863a582966f04004d1c0b2bca");
            $myfile = fopen($this->filename, "r") or die("Unable to open file!");
            $content = fread($myfile, filesize($this->filename));
            //$textDetectLanguague = substr($content, 0, 50);
            //$textDetectLanguague = ltrim(str_replace($this->characters, "", $textDetectLanguague));
            //echo $textDetectLanguague;
            fclose($myfile);

            //$languageCode = DetectLanguage::detect($textDetectLanguague);
            //echo " lenguaje origen " . print_r($languageCode,true);

            $content = str_replace("\n", "/", $content);


            return utf8_encode($content);
        } catch (Exception $exc) {
            echo $exc->getMessage() . " linea " . $exc->getLine();
            //echo $exc->getTraceAsString();
        }
    }

}
