<div id="registration" style="display:none">
<?php
if (isset($viewOptions)) {
  echo '<div id="errors">';
  if (isset($viewOptions['errors']) && count($viewOptions['errors'])) {
    echo '<ul>';
    foreach ($viewOptions['errors'] as $error) {
      printf("<li>%s</li>\n", $error);
    }
    echo '</ul>';
  }
  echo '</div>';
}
?>
<form id="registration-form" action="<?=route('users/new');?>" method="post">
  <label for="username">Username</label>
  <input class="textbox" type="text" name="username" autofocus /><br />
  <label for="email">Email</label>
  <input class="textbox" type="text" name="email" /><br />
  <label for="password">Password</label>
  <input class="textbox" type="password" name="password" /><br />
  <div id="password-verify" style="display:none;">
  <label for="passwordVerify">Verify Password</label>
  <input class="textbox" type="password" name="passwordVerify" /><br />
  </div>
  <input id="submit-button" class="submit-button clean-gray" type="submit" disabled style="display:none" />
</form>
</div>

<script> 

function validateForm() {
  if ($('input[name="password"]').val().length > 0 && $('input[name="password"]').val() ==  $('input[name="passwordVerify"]').val()) {
    $('#submit-button').removeAttr('disabled').fadeIn(200);
  } else {
    $('#submit-button').attr('disabled', true).fadeOut(200);
  }
}

$(document).ready(function() {
  $('#registration').delay(100).fadeIn(400);
  $('input[name="password"]').keypress(function() {
    $('#password-verify').fadeIn(200);
    validateForm(); 
  });

  $('input[name="passwordVerify"]').keyup(function() {
    validateForm(); 
  });
});
</script>