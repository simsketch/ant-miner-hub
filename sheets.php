<?php echo "" ?>
<html>
<body>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.serialize-object.js"></script>
<script>
$( document ).ready(function() {
	var $form = $('form#test-form'),
	    url = 'https://script.google.com/macros/s/AKfycbym06mKtxYc3IadjTF3kqbb--SsOUVi28qkqKnc1a6cRIJbvBM/exec'

	$('#submit-form').on('click', function(e) {
	  e.preventDefault();
	  var jqxhr = $.ajax({
	    url: url,
	    method: "GET",
	    dataType: "json",
	    data: $form.serializeObject()
	  }).success(
	  );
	})
});
</script>
<form id="test-form">
  
  <div>
    <label>Field 1</label>
    <input type="text" name="form_field_1" placeholder="Field 1"/>
  </div>

  <div>
    <label>Field 2</label>
    <input type="text" name="form_field_2" placeholder="Field 2"/>
  </div>
  
  <div>
    <label>Field 3</label>
    <input type="text" name="form_field_3" placeholder="Field 3"/>
  </div>
  
  <div>
    <label>Field 4</label>
    <input type="text" name="form_field_4" placeholder="Field 4"/>
  </div>

  <div>
    <button type="submit" id="submit-form">Submit</button>
  </div>

</form>
</body>
</html>