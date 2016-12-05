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

    // formatXml function found from https://gist.github.com/sente/1083506
    // Copyright info found in credits.js
    function formatXml(xml) {
      var formatted = '';
      var reg = /(>)(<)(\/*)/g;
      xml = xml.replace(reg, '$1\r\n$2$3');
      var pad = 0;
      jQuery.each(xml.split('\r\n'), function(index, node) {
          var indent = 0;
          if (node.match( /.+<\/\w[^>]*>$/ )) {
              indent = 0;
          } else if (node.match( /^<\/\w/ )) {
              if (pad != 0) {
                  pad -= 1;
              }
          } else if (node.match( /^<\w[^>]*[^\/]>.*$/ )) {
              indent = 1;
          } else {
              indent = 0;
          }

          var padding = '';
          for (var i = 0; i < pad; i++) {
              padding += '  ';
          }

          formatted += padding + node + '\r\n';
          pad += indent;
      });

      return formatted;
    }

});


// Hiding and showing forms based on what action is chosen
$('#post').click(function() {
  $('#postform').show();
  $('#putform').hide();
  $('#deleteform').hide();
});
$('#put').click(function() {
  $('#postform').hide();
  $('#putform').show();
  $('#deleteform').hide();
});
$('#delete').click(function() {
  $('#postform').hide();
  $('#putform').hide();
  $('#deleteform').show();
});
if ($('#post').is(':checked')) {
  $('#postform').show();
  $('#putform').hide();
  $('#deleteform').hide();
}
