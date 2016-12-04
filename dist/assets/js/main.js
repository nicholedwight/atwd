$(document).ready(function(){
    //listen for form submission
    $('#postform').on('submit', function(e){
      //prevent form from submitting and leaving page
      e.preventDefault();
      $.ajax({
            type: "GET",
            url: "currPost.php",
            datatype: "xml",
            contentType: "text/xml; charset=\"utf-8\"",
            data: $('#postform').serialize(), //target your form's data and serialize for a POST
            success: function(response, success, xmlData) {
                // locate the div with #result and fill it with returned data from process.php
                // console.log(xmlData.responseXML);
                xmlData = xmlData.responseText.split('><').join("> \n<");
                $('#postresult').text(xmlData);
            },
            error: function() {
              alert("An error occurred while processing XML file.");
            }
        });
    });

    $('#putform').on('submit', function(e){
      //prevent form from submitting and leaving page
      e.preventDefault();
      $.ajax({
            type: "GET",
            url: "currPut.php",
            datatype: "xml",
            contentType: "text/xml; charset=\"utf-8\"",
            data: $('#putform').serialize(), //target your form's data and serialize for a POST
            success: function(response, success, xmlData) {
                // locate the div with #result and fill it with returned data from process.php
                // console.log(xmlData.responseXML);
                console.log(response);
                xmlData = xmlData.responseText.split('><').join("> \n<");
                $('#putresult').text(xmlData);
            },
            error: function() {
              alert("An error occurred while processing XML file.");
            }
        });
    });

    $('#deleteform').on('submit', function(e){
      //prevent form from submitting and leaving page
      e.preventDefault();
      $.ajax({
            type: "GET",
            url: "currDel.php",
            datatype: "xml",
            contentType: "text/xml; charset=\"utf-8\"",
            data: $('#deleteform').serialize(), //target your form's data and serialize for a POST
            success: function(response, success, xmlData) {
                // locate the div with #result and fill it with returned data from process.php
                // console.log(xmlData.responseXML);
                // console.log(response);
                xmlData = xmlData.responseText.split('><').join("> \n<");
                $('#deleteresult').text(xmlData);
            },
            error: function() {
              alert("An error occurred while processing XML file.");
            }
        });
    });

    $('#convertform').on('submit', function(e){
      //prevent form from submitting and leaving page
      e.preventDefault();
      // console.log($('#format').val('xml'));
      if ($( "#format option:selected" ).text() == 'xml') {
        $.ajax({
              type: "GET",
              url: "convert.php",
              datatype: "xml",
              contentType: "text/xml; charset=\"utf-8\"",
              data: $('#convertform').serialize(), //target your form's data and serialize for a POST
              success: function(response, success, xmlData) {
                  // locate the div with #result and fill it with returned data from process.php
                  xmlData = xmlData.responseText.split('><').join("> \n<");
                  $('#convertresult').text(xmlData);
              },
              error: function() {
                alert("An error occurred while processing XML file.");
              }
          });
      } else {

        $.ajax({
              type: "GET",
              url: "convert.php",
              datatype: "json",
              data: { amnt: $( "#convamnt" ).val(),
                      from : $( "#fromcode option:selected" ).text(),
                      to: $( "#tocode option:selected" ).text(),
                      format: "json"},
              contentType: 'application/json; charset=utf-8',
              success: function(data) {
                  $('#convertresult').text(JSON.stringify(data, null, ' '));
              },
              error: function() {
                alert("An error occurred while processing JSON file.");
              }
          });
      }

    });

});


$('#post').click(function() {
  $('#postform').show();
  $('#putform').hide();
  $('#deleteform').hide();
  $('#convertform').hide();
});
$('#put').click(function() {
  $('#postform').hide();
  $('#putform').show();
  $('#deleteform').hide();
  $('#convertform').hide();
});
$('#delete').click(function() {
  $('#postform').hide();
  $('#putform').hide();
  $('#deleteform').show();
  $('#convertform').hide();
});
$('#convert').click(function() {
  $('#postform').hide();
  $('#putform').hide();
  $('#deleteform').hide();
  $('#convertform').show();
});
if ($('#convert').is(':checked')) {
  $('#postform').hide();
  $('#putform').hide();
  $('#deleteform').hide();
  $('#convertform').show();
}
$('.amntinput').change(function(){
   this.value = parseFloat(this.value).toFixed(2);
});
