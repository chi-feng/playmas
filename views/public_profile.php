<?php
$user = $viewOptions['user'];
?>
<div id="public-profile">
  <div id="social">
    <div id="profile-picture">
      <?php
      if ($user->get['has_picture'] == 1) {
        $src = route('resources/profiles/') . $user->get['id'] . '.png';
      } else {
        $src = route('resources/profiles/default.png');
      }
      ?>
      <img src="<?=$src;?>" width="300px" height="300px" />
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
    <div id="profile-name">
      <h2><?=$user->get['display_name'];?></h2>
    </div>
    <div id="profile-description">
      <p><?=$user->get['description'];?></p>
    </div>
    <div id="profile-location">
      <span>
      <?php
      if (empty($user->get['city'])) {
        echo $user->get['country'];
      } else {
        echo  $user->get['city'], $user->get['country'];
      }
      ?>
      </span>
    </div>
  </div>
</div>