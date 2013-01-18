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
  
  <input class="submit" type="submit" value="Login" />
  
</form>
</div>

<script>
$(document).ready(function() {
  
	$("input[name='username']").autocomplete({
    source: function(req, add) {
      var suggestions = [];
      $.ajax({
        type: "POST",
        url: "<?=route('autocomplete/username');?>",
        data: { query: req.term },
        success: function(returned_data) {
          suggestions = returned_data;
          add(suggestions);
        },
        dataType: "json"
      });
    }
  });
  
  function removeActive() {
    $('form label').removeClass('active');
    $('form .field').removeClass('active');
  }
  
  $('form input').focus(function() {
    removeActive();
    $("label[for='"+$(this).attr('name')+"']").addClass('active');
    $(this).closest('.field').addClass('active');
  });
  
  $('form input').blur(function() {
    removeActive();
  });
  
});
</script>