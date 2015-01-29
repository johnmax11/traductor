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
        if (msg.error) {
          location.reload();
          return;
        }

        var response = msg.rows[0];
        //console.log(response);

        $('#first_name').val(response.first_name_account);
        $('#first_middle_name').val(response.first_middle_name_account);
        $('#last_name').val(response.last_name_account);
        $('#last_middle_name').val(response.last_middle_name_account);
        $('#email_notf_1').val(response.email_notification_1_account);
        $('#email_notf_2').val(response.email_notification_2_account);
        $('#phone_number_1').val(response.phone_number_1_account);
        $('#phone_number_2').val(response.phone_number_2_account);
        $('#phone_number_mobile_1').val(response.phone_number_1_account);
        $('#phone_number_mobile_2').val(response.phone_number_2_account);

        var languajes = '';
        console.log(response.trad_languaje);
        for (var i = 0; i < response.languajes.length; i++) {
          languajes += '<option value="' + response.languajes[i].id + '" ';

          if (response.trad_languaje[0].id == response.languajes[i].id)
            languajes += ' selected ';

          languajes += '>' + response.languajes[i].name + '</options>';
        }
        $('#nativeLanguaje').append(languajes);

        var languajes = '';
        for (var i = 0; i < response.languajes.length; i++) {
          languajes += '<option value="' + response.languajes[i].id + '">' + response.languajes[i].name +
            '</options>';
        }
        
        $('#sourceLanguaje').append(languajes);
        $('#targetLanguaje').append(languajes);
        $('#expertiseCombobox').append(languajes);
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
          equalTo: "#password"
        }
      }
    };

    return optValidate;
  }

  //
  function optionsStepsProcess() {
    var optionsEvent = {
      onFinished: function(event, currentIndex) {
        var finished = eventOnFinished(event, currentIndex);
        return finished;
      },
      onStepChanging: function(event, currentIndex, newIndex) {
        var stepChanging = eventOnStepChanging(event, currentIndex, newIndex);
        return stepChanging;
      },
      eventOnFinishing: function(event, currentIndex) {
        var stepFinishing = eventOnFinishing(event, currentIndex);
        return stepFinishing;
      }
    };

    return optionsEvent;
  }

  //
  function eventOnStepChanging(event, currentIndex, newIndex) {
    containerSteps.validate().settings.ignore = ":disabled,:hidden";
    return containerSteps.valid();
  }

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
    var boxContainer = $('#formTranslatorAccount').children("div");

    containerSteps.validate(optValidate);
    boxContainer.steps(optStep);
    skillsSection.translationSection(boxContainer);
    skillsSection.proofreadingSection(boxContainer);
    expertiseSection.expertiseSection(boxContainer);
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
      '<td><a href="#">Remove</a></td>' +
      '<input type="hidden" value="' + sourceLanguaje.val() + '-' + targetLanguaje.val() + '"/>'
    '</tr>';

    table.children('tbody').append(record);

    var lastRecordInserted = table.find('tr').last();
    var valueSelected = lastRecordInserted.find('input[type=hidden]');
    valueSelected = valueSelected.parent();

    addLanguajeProofreading(sourceLanguaje, targetLanguaje);
    valueSelected.children('td').children('a').click(removeOfComboboxAndTable);

    return false;
  }

  function addLanguajeProofreading(sourceLanguaje, targetLanguaje) {
    var options = $('#proofreadingLanguaje option');
    var bool = false;

    options.each(function(index, value) {
      if ($(this).val() == targetLanguaje.val())
        bool = true;
    });

    if (!bool) {
      var combxProofreading = '<option value="' + targetLanguaje.val() + '">' + targetLanguaje.text() +
        '</option>';
      $('#proofreadingLanguaje').append(combxProofreading);
    }
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
      '<td><a href="#" class="removeProofreading">Remove</span></td>' +
      '<input type="hidden" value="' + proofreadingLanguaje.val() + '"/>'
    '</tr>';

    table.children('tbody').append(record);

    var lastRecordInserted = table.find('tr').last();
    var valueSelected = lastRecordInserted.find('input[type=hidden]');

    valueSelected.parent().click(removeRecordTable);
    return false;
  }

  function removeOfComboboxAndTable() {
    //verificar nuestra tabla si hay registros con ese lenguaje
    var table = $('#translationTable');
    var tr = table.find('tr').length;

    var thisElement = $(this).parent().parent().find('input[type=hidden]').val();
    var thisValue = thisElement.split('-');
    $(this).parent().parent().remove(); //remove this element whit your record

    for (var i = 0; i < tr.length; i++) {
      var records = table.find('tr:eq(' + i + ') > input[type=hidden]').val();
      var targetValue = records.split('-');

      if (targetValue[1] == thisValue[1])
        return;
    }

    var options = $('#proofreadingLanguaje option');
    options.each(function(index, value) {
      if ($(this).val() == thisValue[1]) {
        $(this).remove();
      }
    });

    var table = $('#proofreadingTable');
    var tr = table.find('tr').length;

    for (var i = 0; i <= tr; i++) {
      var records = table.find('tr:eq(' + i + ') > input[type=hidden]');

      if (records.val() == thisValue[1])
        records.parent().remove();
    }
    return false;
  }

  function removeRecordTable() {
    $(this).remove();
    return false;
  }
}

//class
function expertise() {
  this.expertiseSection = function(containerSteps) {
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