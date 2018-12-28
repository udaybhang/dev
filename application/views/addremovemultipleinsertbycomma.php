<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"
			  ></script>
		
	
	<script>
	$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
   
    var x = 1; //initlal text box count
	
	
   $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
	
		     //text box increment
            $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
            x++; 
	  }
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
       
		e.preventDefault(); 
		$(this).parent('div').remove(); 
		x--;
    })
});
	
	</script>
</head>
<body>
	<form action="<?php echo base_url().'A_addremovefield/commacheckbox' ?>" method="post">
	<div class="form-group">
    <label class="col-sm-4 control-label">Type</label>
    <div class="col-sm-4">
        <div class="checkbox">
        <?php echo form_checkbox('type[]', 'type1'); ?>Type 1
        </div>
        <div class="checkbox">
        <?php echo form_checkbox('type[]', 'type2'); ?>Type 2
        </div>
        <div class="checkbox">
        <?php echo form_checkbox('type[]', 'type3'); ?>Type 3
        </div>
    </div>
    <div class="input_fields_wrap">
    <button class="add_field_button">Add More Fields</button>
    
    <div><input type="text" name="mytext[]"></div>
  
	
     </div>
    <input type="submit" name="submit" value="submit">
</div>
</form>
</body>
</html>