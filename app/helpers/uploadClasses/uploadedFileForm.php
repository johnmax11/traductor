<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of uploadedFileForm
 *
 * @author Andres
 */
class uploadedFileForm {

    /**

     * Save the file to the specified path

     * @return boolean TRUE on success

     */
    function save($path) {

        if (!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)) {

            return false;
        }

        return true;
    }

    function getName() {

        return $_FILES['qqfile']['name'];
    }

    function getSize() {

        return $_FILES['qqfile']['size'];
    }

}
