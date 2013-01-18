<?php
  if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }
?>
<div id="content">
<div id="loginpage">
<form id="login-form" action="<?=route('login');?>" method="post">
  <div class="field clearfix active">
  <label for="username" class="active">Username</label>
    <div class="field-wrap">
      <input class="required" id="username" name="username" type="text" value="" autofocus />
    </div>
  </div>
  <div class="field clearfix">
  <label for="password">Password</label>
    <div class="field-wrap">
      <input class="required" id="password" name="password" type="password" autocomplete="off" />
    </div>
  </div>
  <input class="submit" type="submit" value="Login" />
  <?php
  if (isset($viewOptions)) {
    echo '<div class="errors">';
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
</form>
</div>

</div>

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