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
