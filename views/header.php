<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <link href="<?=route('css/screen.css');?>" rel="stylesheet" type="text/css" media="screen" />
  <link rel="icon" href="<?=route('favicon.png');?>" sizes="16x16" type="image/png" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="<?=route('js/jquery.autocomplete.min.js');?>"></script>
  <script src="<?=route('js/jquery.ui.autocomplete.js');?>"></script>
</head>
<body>
  <div id="header" class="clearfix">
    <div id="header-bar" class="clearfix">
      <div id="header-links">
        <ul class="clearfix">
          <li><a href="<?=route('faq');?>">FAQ</a></li>
          <li><a href="<?=route('aww');?>">AWW</a></li>
          <li><a href="<?=route('yiss');?>">YISS</a></li>
        </ul>
      </div>
      <div id="header-util">
        <span id="greet-username">
          <?php
          $greeting = '';
          if (isset($_SESSION['username'])) {
            $greeting = sprintf('Hello <a href="%s">%s</a>!', 
              route('users/'.$_SESSION['username']), 
              htmlspecialchars($_SESSION['display_name']));
          }
          echo $greeting;
          ?>
        </span>
        <?php
        if (isset($_SESSION['username'])) {
          echo '<a id="logout-button" class="util-button" href="'.route('logout').'">Logout</a>';
        } else {
          echo '<a id="login-button" class="util-button" href="'.route('login').'">Login</a>';
          echo '<a id="register-button" class="util-button" href="'.route('users/new').'">Register</a>';
        }
        ?>
      </div>
    </div>
  </div>
<div id="content">
    <h1><a href="<?=route('home');?>">Play MAS</a></h1>
