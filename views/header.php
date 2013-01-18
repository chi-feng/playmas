<?php
if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <link href="<?=route('css/screen.css');?>" rel="stylesheet" type="text/css" media="screen" />
  <link rel="icon" href="<?=route('favicon.png');?>" sizes="16x16" type="image/png" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="<?=route('js/jquery.ui.autocomplete.js');?>"></script>
</head>
<body>
<div id="wrap">
<div id="header" class="clearfix">
  <div id="login">
  <?php if ($logged_in) { ?>
    <a href="<?=route('logout');?>">Log Out</a>
  <?php } else { ?>
    <a href="<?=route('login');?>">Log In</a>
  <?php } ?>
  </div>
  <div class="header-bar clearfix">
  <h1 id="logo" class="clearfix">
    <a href="<?=route('home');?>">PlayMAS</a>
  </h1>
  <div id="nav">
    <ul id="menu">
    <?php if ($logged_in) { ?>
      <li><a href="<?=route('dashboard');?>">Dashboard</a></li>
      <li><a href="<?=route('inbox');?>">Inbox</a></li>
      <li><a href="<?=route('support');?>">Support</a></li>
      <li><a href="<?=route('account');?>">Account</a></li>
    <?php } else { ?>
      <li><a href="<?=route('pricing');?>">Lorem</a></li>
      <li><a href="<?=route('features');?>">Ipsum</a></li>
      <li><a href="<?=route('support');?>">Dolor</a></li>
      <li><a href="<?=route('blog');?>">Sit Amet</a></li>
    <?php } ?>
    </ul>
  </div>
  </div>
</div>
