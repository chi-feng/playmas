<div id="registration">
<form id="registration-form" action="<?=route('users/new');?>" method="post">
  <label for="username">Username</label>
  <input class="textbox" type="text" name="username" /><br />
  <label for="email">Email</label>
  <input class="textbox" type="text" name="email" /><br />
  <label for="password">Password</label>
  <input class="textbox" type="password" name="password" /><br />
  <label for="passwordVerify">Verify Password</label>
  <input class="textbox" type="password" name="passwordVerify" /><br />
  <input class="submitbutton clean-gray" type="submit" />
</form>
</div>