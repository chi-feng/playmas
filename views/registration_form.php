<div id="registration">
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
  <input id="submit-button" class="submit-button clean-gray" type="submit" disabled />
</form>
</div>

<script> 

function validateForm() {
  if ($('input[name="password"]').val() ==  $('input[name="passwordVerify"]').val()) {
    $('#submit-button').removeAttr('disabled');
  } else {
    $('#submit-button').attr('disabled', true);
  }
}

$(document).ready(function() {
  $('input[name="password"]').keypress(function() {
    $('#password-verify').slideDown(200);
  });

  $('input[name="passwordVerify"]').keyup(function() {
    validateForm(); 
  });
});
</script>