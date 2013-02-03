<?php
  if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }
?>
<div id="content">
<form action="<?=route('gigs/new');?>" method="post">
  
  <div class="field clearfix">
    <label for="name">Gig Name</label>
    <div class="field-wrap">
      <input class="required" id="name" name="name" type="text" value="" />
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
      <input class="required" class="datepicker" id="begin-date" name="begin_date" type="text" value="" />
    </div>
    <div class="field-wrap">
      <input class="required" class="timepicker" id="begin-time" name="begin_time" type="text" value="" />
    </div>
  </div>

  <div class="field clearfix">
    <label for="end">End Time/Date</label>
    <div class="field-wrap">
      <input class="required" class="datepicker" id="end-date" name="end_date" type="text" value="" />
    </div>
    <div class="field-wrap">
      <input class="required" class="timepicker" id="end-time" name="end_time" type="text" value="" />
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
  
  // add autocomplete to username field
	$("input[name='location']").autocomplete({
    source: function(req, add) {
      $.post("<?=route('autocomplete/location');?>", {query: req.term}, 
        function(data) { add(data); }, 'json');
    }
  });
  

  $(".datepicker").datepicker();
  $(".timepicker").timepicker();
  
});
</script>
