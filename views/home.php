<a class="homepage-button" href="<?=route('test');?>">Test</a>
<a class="homepage-button" href="<?=route('users/new');?>">Register</a>
<a class="homepage-button" href="<?=route('login');?>">Login</a>


<input type="text" name="city" id="autocomplete" />



<script>

$(function() {
	$("#autocomplete").autocomplete({
    source: function(req, add) {
      console.log(req);
      var suggestions = [];
      $.ajax({
        type: "POST",
        url: "<?=route('autocomplete/location');?>",
        data: { query: req.term },
        success: function(data) {
          suggestions = data;
      console.log(suggestions);
          add(suggestions);
        },
        dataType: "json"
      });
    }
  });
});
/*
$('#autocomplete').autocomplete({
    serviceUrl: "<?=route('autocomplete/location');?>",
    onSelect: function (suggestion) {
        alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
    }
});
*/
</script>