<?php
$user = $this->data['user'];
?>
<div id="content">
<div id="public-profile">
  <div id="social" class="clearfix">
    <div id="profile-picture">
      <?php
      if ($user->get('has_picture') == 1) {
        $src = route('resources/profiles/') . $user->get('id') . '.png';
      } else {
        $src = route('resources/profiles/default.png');
      }
      ?>
      <img src="<?=$src;?>" width="300px" height="300px" />
    </div>
    <div id="social-networks" class="clearfix">
      <h3>Connect</h3>
      <ul>
        <li><a class="btn" href="http://twitter.com/<?=$user->get('twitter');?>"><i class="icon-twitter"></i> Twitter</a></li>
        <li><a class="btn" href="http://twitter.com/<?=$user->get('twitter');?>"><i class="icon-facebook"></i> Facebook</a></li>
      </ul>
    </div>
  </div>
  <div id="profile-info" class="clearfix">
    <div id="profile-name">
      <?php
      if ($_SESSION['username'] == $user->get('username')) {
        printf('<a class="btn" href="%s">%s</a>',
          route('user/'.$user->get('username').'/edit'),
          '<i class="icon-edit"></i> Edit');
      }
      ?>
      <span id="display-name">
        <?=$user->get('display_name');?>
      </span>
    </div>
    <div id="profile-description">
      <p><?=$user->get('description');?></p>
    </div>
    <div id="profile-location">
      <span>
      <?php
        echo $user->get('location');
      ?>
      </span>
    </div>
  </div>
  <div class="numbers">
    <h3>Numbers</h3>
    <ul>
    <?php
    $numbers = $this->data['numbers'];
    foreach ($numbers as $number) {
      printf('<li>%s</li>', $number->get('number'));
    }
    ?>
    </ul>
  </div>
  <div class="requests">
    <table>
    <tr><th>body</th><th>from</th><th>received</th></tr>
    <h3>Requests</h3>
    <?php
    $requests = $this->data['requests'];
    foreach ($requests as $request) {
      printf('<tr><td>%s</td><td>%s</td><td>%s</td></tr>',
      $request->get('body'),$request->get('from'),date('r',$request->get('received')));
    }
    ?>
    </table>
  </div>
</div>
</div>