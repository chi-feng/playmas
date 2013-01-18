<?php
  if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }
?>
<div id="content" class="clearfix">
<div id="registration">
<?php
$errors = '';
if (isset($this->data['errors'])) {
  $errors .= '<div class="errors">';
  if (isset($this->data['errors']) && count($this->data['errors'])) {
    $errors .=  '<ul>';
    foreach ($this->data['errors'] as $error) {
      $errors .= sprintf("<li>%s</li>\n", $error);
    }
    $errors .=  '</ul>';
  }
  $errors .=  '</div>';
}
?>

<h1>Get Started with a Free Account</h1>
<h3>Sign up in 30 seconds. No credit card required.</h3>
<form action="<?=route('users/new');?>" id="registration-form" method="post" name="tryit">
  <div class="field clearfix active">
  <label for="email" class="active">Email</label>
    <div class="field-wrap">
      <input class="required" id="email" name="email" type="email" value="" autofocus />
      <div class="field-help">Please enter your email address.</div>
    </div>
  </div>
  <div class="field clearfix">
  <label for="username">Username</label>
    <div class="field-wrap">
      <input class="required" id="username" name="username" type="text" value="" />
      <div class="field-help">Choose a username that contains only letters and numbers.</div>
    </div>
  </div>
  <div class="field clearfix">
  <label for="password">Password</label>
    <div class="field-wrap">
      <input class="required" id="password" name="password" type="password" autocomplete="off" />
      <div class="field-help">Choose a password that's at least six characters, including a number or special character.</div>
    </div>
  </div>
  <div class="field clearfix" id="verify" style="display:none">
  <label for="password_verify">Verify</label>
    <div class="field-wrap">
      <input class="required" id="password_verify" name="password_verify" type="password" autocomplete="off" />
      <div class="field-help">Enter your password again to verify.</div>
    </div>
  </div>
  <div class="field clearfix">
  <label for="location">Location</label>
    <div class="field-wrap">
      <input class="required" id="location" name="location" type="text" autocomplete="off" />
      <div class="field-help">Choose a location.</div>
    </div>
  </div>

  <input class="submit disabled" type="submit" id="submit-button" value="Register" disabled="true" />
  <?=$errors;?>
</form>

<script>
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
</script>

<script>
$(function() {
	$("input[name='location']").autocomplete({
    source: function(req, add) {
      var suggestions = [];
      $.ajax({
        type: "POST",
        url: "<?=route('autocomplete/location');?>",
        data: { query: req.term },
        success: function(data) {
          suggestions = data;
          add(suggestions);
        },
        dataType: "json"
      });
    }
  });
});
</script>

<script> 

function validateForm() {
  if ($('input[name="password"]').val().length > 0 && $('input[name="password"]').val() ==  $('input[name="password_verify"]').val()) {
    $('#submit-button').removeAttr('disabled');
    $('#submit-button').removeClass('disabled');
  } else {
    $('#submit-button').attr('disabled', true);
    $('#submit-button').addClass('disabled');
  }
}

$(document).ready(function() {
  
  $('input[name="password"]').keypress(function() {
    $('#verify').fadeIn(200);
    validateForm(); 
  });

  $('input[name="password_verify"]').keyup(function() {
    validateForm(); 
  });
});


</script>
</div>