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
<div id="login">
<form id="login-form" action="<?=route('login');?>" method="post">
  <label for="username">Username</label>
  <input class="textbox" type="text" name="username" /><br />
  <label for="password">Password</label>
  <input class="textbox" type="password" name="password" /><br />
  <input class="submitbutton clean-gray" type="submit" value="Login" />
</form>
</div>