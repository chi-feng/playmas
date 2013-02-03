<?php
  if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }
?>
<div id="content">
<form action="<?=route('gig/new');?>" method="post">
  
  <div class="field clearfix">
    <label for="gig_name">Gig Name</label>
    <div class="field-wrap">
      <input class="required" id="gig_name" name="gig_name" type="text" value="" />
    </div>
  </div>

  <div class="field clearfix">
    <label for="location">Location</label>
    <div class="field-wrap">
      <input class="required" id="location" name="location" type="text" value="" />
    </div>
  </div>

  <div class="field clearfix">
    <label for="begin">Start Time/Date</label>
    <div class="field-wrap">
      <input class="required" id="begin" name="begin" type="text" value="" />
    </div>
  </div>

  <div class="field clearfix">
    <label for="end">End Time/Date</label>
    <div class="field-wrap">
      <input class="required" id="end" name="end" type="text" value="" />
    </div>
  </div>

  <div class="field clearfix">
    <label for="username">Username</label>
    <div class="field-wrap">
      <input class="required" id="username" name="username" type="text" value="" />
    </div>
  </div>
  
  <input class="submit" type="submit" value="Schedule Gig" />
  
</form>
</div>

<script src="<?=route('js/forms.js');?>"></script>

<script>
$(document).ready(function() {

  // add autocomplete to username field
	$("input[name='username']").autocomplete({
    source: function(req, add) {
      $.post("<?=route('autocomplete/username');?>", {query: req.term}, 
        function(data) { add(data); }, 'json');
    }
  });
  
});
</script>
