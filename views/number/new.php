<?php
  if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }
?>
<div id="content">
<form action="<?=route('numbers/new');?>" method="post">
  
  <div class="field clearfix">
    <label for="number">Number</label>
    <div class="field-wrap">
      <input class="required" id="number" name="number" type="text" value="" />
    </div>
  </div>
  
  <div class="field clearfix">
    <label for="username">Username</label>
    <div class="field-wrap">
      <input class="required" id="username" name="username" type="text" value="" />
    </div>
  </div>
  
  <input class="submit" type="submit" value="Add Number" />
  
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