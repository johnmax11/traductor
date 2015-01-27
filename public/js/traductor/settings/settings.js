/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//CLASS
//
function settings() {
  
  this.doRequest = function(route, dataSend, typeRequest) {
    $.ajaxFrm({
      url: public_path + route,
      success: function(params, msg) {
        if(msg.error){
          location.reload();
          return;
        }

        var obj = msg.rows[0];

        $('#first_name').val(obj.first_name_account);
        $('#first_middle_name').val(obj.first_middle_name_account);
        $('#last_name').val(obj.last_name_account);
        $('#last_middle_name').val(obj.last_middle_name_account);
        $('#email_notf_1').val(obj.email_notification_1_account);
        $('#email_notf_2').val(obj.email_notification_2_account);
        $('#phone_number_1').val(obj.phone_number_1_account);
        $('#phone_number_2').val(obj.phone_number_2_account);
        $('#phone_number_mobile_1').val(obj.phone_number_1_account);
        $('#phone_number_mobile_2').val(obj.phone_number_2_account);
      }
    });
  }
}

//CLASS
function dataSettings() {
  this.getData = function() {
    var route = 'traductor/settings/account';

    var data = new settings();
    data = data.doRequest(route, {}, 'POST');
  }
}

//Clase usada para la funcionalidad de jquerySteps in Translate Profiler 
function stepsTranslateProfiler(containerSteps) {
  //
  function defaultOptionsSteps() {
    var optionsSteps = {
      headerTag: "h3",
      bodyTag: "section",
      transitionEffect: "slideLeft",
      stepsOrientation: "vertical"
    };

    return optionsSteps;
  }

  function optionsvalidate() {
    var optValidate = {
      errorPlacement: function errorPlacement(error, element) {
        element.before(error);
      },
      rules: {
        confirm: {
          equalTo: "#confirmPasswordTranslator"
        }
      }
    };

    return optValidate;
  }
  //
  function optionsStepsProcess() {
    var optionsEvent = {
      onFinishing: function(event, currentIndex) {
        var finishing = eventOnFinishing(event, currentIndex);
        return finishing;
      },
      onFinished: function(event, currentIndex) {
        var finished = eventOnFinished(event, currentIndex);
        return finished;
      },
      onStepChanging: function(event, currentIndex, newIndex) {
        var stepChanging = eventOnStepChanging(event, currentIndex, newIndex);
        return stepChanging;
      }
    };

    return optionsEvent;
  }

  //
  function eventOnStepChanging(event, currentIndex, newIndex) {
    var form = $('#formTranslatorAccount');

    switch (currentIndex) {
      case 0:
        return validationAccountStep(form);
        break;
      case 1:
        return validationSkillsStep(form);
        break;
      case 2:
        return validationExperienseStep(form);
        break;
      case 3:
        return validationCVCertificatesStep(form);
        break;
    }
    containerSteps.validate().settings.ignore = ":disabled,:hidden";

    return containerSteps.valid();
  }

  function validationAccountStep(form) {
    var password = form.find('input[name=password]');
    var confirm = form.find('input[name=confirm]');

    if (!password.val()) {
      alert('Introduzca una contraseña');
      return false;
    }

    var regularExpression = /^[a-zA-Z][0-9]$/;
    var valid = regularExpression.test(password.val());

    if (valid || (password.val().length < 6)) {
      alert('No es una cntraseña valida');
      return false;
    }

    if (!confirm.val()) {
      alert('Introduzca una contraseña de confirmacion');
      return false;
    }

    if (password.val() != confirm.val()) {
      alert('las contraseñas deben ser iguales');
      return false;
    }

    return true;
  }

  function validationSkillsStep(form) {
    form.find('#sourceLanguaje');
    form.find('#sourceLanguaje');
    form.find('#sourceLanguaje');
    form.find('#sourceLanguaje');
    return true;
  }

  function validationExperienseStep(form) {
    return true;
  }

  function validationCVCertificatesStep(form) {
    return true;
  }

  //
  function eventOnFinishing(event, currentIndex) {
    containerSteps.validate().settings.ignore = ":disabled";
    return containerSteps.valid();
  }

  //
  function eventOnFinished(event, currentIndex) {
    alert("Submitted!");
  }

  //
  function finalOptionsSteps() {
    var defaultSteps = defaultOptionsSteps();
    var processSteps = optionsStepsProcess();

    defaultSteps.onFinishing = processSteps.onFinishing;
    defaultSteps.onFinished = processSteps.onFinished;
    defaultSteps.onStepChanging = processSteps.onStepChanging;
    defaultSteps.onStepChanged = processSteps.onStepChanged;

    return defaultSteps;
  }

  //
  this.createStepsTranslator = function() {
    var optStep = finalOptionsSteps();
    var optValidate = optionsvalidate();
    var skillsSection = new StepSkills();
    var expertiseSection = new expertise();
    var boxContainer = containerSteps.children("div");

    //containerSteps.validate(optValidate);
    boxContainer.steps(optStep);
    skillsSection.translationSection(boxContainer);
    skillsSection.proofreadingSection(boxContainer);
    expertiseSection.expertisegSection(boxContainer);
  }
}

//CLASS
function StepSkills() {
  //
  this.translationSection = function(containerSteps) {
    var addButton = containerSteps.find('#addSourceAndTranslation');
    addButton.click(addTranslationSection);
  }

  function addTranslationSection() {
    var sourceLanguaje = $('#sourceLanguaje').find('option:selected');
    var targetLanguaje = $('#targetLanguaje').find('option:selected');

    if (sourceLanguaje.val() === '' || targetLanguaje.val() === '')
      return false;

    if (sourceLanguaje.val() === targetLanguaje.val())
      return false;

    var table = $('#translationTable');
    var tr = table.find('tr').length;

    for (var i = 0; i < tr; i++) {
      var dataLanguajes = table.find('tr:eq(' + i + ') > input[type=hidden]').val();

      if (dataLanguajes === (sourceLanguaje.val() + '-' + targetLanguaje.val()))
        return false;
    }

    var record = '<tr>' +
      '<td>' + sourceLanguaje.text() + '</td>' +
      '<td>' + targetLanguaje.text() + '</td>' +
      '<td><span>Pending</span></td>' +
      '<td><a href="#">Remove</a></td>' +
      '<input type="hidden" value="' + sourceLanguaje.val() + '-' + targetLanguaje.val() + '"/>'
    '</tr>';
    table.children('tbody').append(record);

    var lastRecordInserted = table.find('tr').last();
    var valueSelected = lastRecordInserted.find('input[type=hidden]');

    valueSelected.click(removeRecordTable);

    return false;
  }

  this.proofreadingSection = function(containerSteps) {
    var addButton = containerSteps.find('#addProofreadingLenguaje');
    addButton.click(addProofreadingSection);
  }

  function addProofreadingSection() {
    var proofreadingLanguaje = $('#proofreadingLanguaje').find('option:selected');

    if (!proofreadingLanguaje.val())
      return false;

    var table = $('#proofreadingTable');
    var tr = table.find('tr').length;


    for (var i = 0; i < tr; i++) {
      var languaje = table.find('tr:eq(' + i + ') > input[type=hidden]').val();

      if (proofreadingLanguaje.val() === languaje)
        return false;
    }

    var record = '<tr>' +
      '<td>' + proofreadingLanguaje.text() + '</td>' +
      '<td><span>Pending</span></td>' +
      '<td><a href="#" class="removeProofreading">Remove</span></td>' +
      '<input type="hidden" value="' + proofreadingLanguaje.val() + '"/>'
    '</tr>';
    table.children('tbody').append(record);
    $('.removeProofreading').click(removeRecordTable);

    return false;
  }

  function removeRecordTable() {
    $(this).parent().parent().remove();
    return false;
  }
}

//class
function expertise() {
  this.expertisegSection = function(containerSteps) {
    var addButton = containerSteps.find('#addExpertiseLenguaje');
    addButton.click(addExpertiseSection);
  }

  function addExpertiseSection() {
    var expertiseLanguaje = $('#expertiseCombobox').find('option:selected');

    if (!expertiseLanguaje.val())
      return false;

    var table = $('#expertiseTable');
    var tr = table.find('tr').length;

    for (var i = 0; i < tr; i++) {
      var languaje = table.find('tr:eq(' + i + ') > input[type=hidden]').val();

      if (expertiseLanguaje.val() === languaje)
        return false;
    }

    var record = '<tr>' +
      '<td>' + expertiseLanguaje.text() + '</td>' +
      '<td><span>Pending</span></td>' +
      '<td><a href="#" class="removeExpertise">Remove</span></td>' +
      '<input type="hidden" value="' + expertiseLanguaje.val() + '"/>'
    '</tr>';
    table.children('tbody').append(record);

    $('.removeExpertise').click(removeRecordTable);

    return false;
  }

  function removeRecordTable() {
    $(this).parent().parent().remove();
    return false;
  }
}

//Ejecucion del codigo js cuando cargue el DOM
$(function() {
  var dataDB = new dataSettings();
  dataDB.getData();

  var stepsTranslate = new stepsTranslateProfiler($('#formTranslatorAccount'));
  stepsTranslate.createStepsTranslator();

});