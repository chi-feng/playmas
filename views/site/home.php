<?php
  if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }
?>
<div id="homepage" class="clearfix">
  <div class="blurb-wide">
    <h2>Your digital booth assistant</h2>
    <h4>Fueled by science<br />Works like magic</h4>
    <p>PlayMAS is . </p> 
    <div class="registration">
      <a class="button registration-button" href="<?=route('users/new');?>">Sign Up Free</a>
    </div>
  </div>
  
  <a class="button registration-button" href="<?=route('users');?>">View Users</a>
  <a class="button registration-button" href="<?=route('numbers');?>">View Numbers</a>
  <a class="button registration-button" href="<?=route('numbers/new');?>">New Number</a>
  <a class="button registration-button" href="<?=route('requests/new');?>">New Request</a>
  
</div>



