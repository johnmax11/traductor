/* 
 Created on : 20/01/2015, 11:21:01 AM
 Author     : Andres
 */
$(document).ready(function () {

    function setStepsMain() {  //clase      
        this.setStepsBasic = function (idStep) { //metodo publico
            var stepsObject;
            stepsObject = $("#" + idStep).steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "slideLeft",
                autoFocus: true,
                stepsOrientation: "vertical",
            });

            return stepsObject;
        };
    }

    function setParamsDropzone() {
        this.setOptions = function () {
            Dropzone.options.dropzone = {
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                addRemoveLinks: true,
                accept: function (file, done) {
                    if (file.name == "Koala.jpg") {
                        done("Naha, you don't.");
                    }
                    else {
                        done();
                    }
                },
                acceptedFiles: ".pdf,.doc,.docx,.ppt,.pptx,.xls,.txt,.jpg",
                init: function () {
                    this.on("addedfile", function (file) {
                        console.log("evento");
                    });
                    this.on("success", function (file, response) {
                        console.log("exito ");
                    });
                }
            };
        };
    }

    var steps = new setStepsMain();
    steps.setStepsBasic("divSteps");
    /*
     var zoneDrop = new setParamsDropzone();
     zoneDrop.setOptions();
     */

    function createUpload() {
        this.setParams = function (idDiv, url) {
            new qq.FileUploader({
                element: document.getElementById(idDiv),
                action: url,
                debug: true,
                onChange: function (input) {
                    console.log("en cambio "+input);
                },
                onProgress: function (id, fileName, loaded, total) {
                    console.log("esta en progreso");
                }
            });
        }
    }

    var upload = new createUpload();
    upload.setParams("file-uploader-demo1", "public/upload");
});



