<?php
$user = $viewOptions['user'];
?>
<div id="public-profile">
  <div id="social">
    <div id="profile-picture">
      <img src="<?=route('resources/profiles');?>/default.png" width="300px" height="300px" />
    </div>
    <div id="social-networks">
      <h3>Connect</h3>
      <ul>
        <li><a href="http://twitter.com/<?=$user->get['twitter'];?>">Twitter</a></li>
        <li><a href="http://twitter.com/<?=$user->get['twitter'];?>">Twitter</a></li>
      </ul>
    </div>
  </div>
  <div id="profile-info">
    <div id="profile-username"><h2><?=$user->get['username'];?></h2></div>
    <div id="profile-description"><p><?=$user->get['description'];?></p></div>
    <div id="profile-location"><span><?=$user->get['location'];?></p></div>
  </div>
</div>