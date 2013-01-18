
$(document).ready(function() {
  
  function removeActive() {
    $('form label').removeClass('active');
    $('form .field').removeClass('active');
  }
  
  $('form input').focus(function() {
    removeActive();
    $("label[for='"+$(this).attr('name')+"']").addClass('active');
    $(this).closest('.field').addClass('active');
  });
  
  $('form input').blur(function() {
    removeActive();
  });
  
});