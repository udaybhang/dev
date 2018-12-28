<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<pre>
	<form method="POST" action="">
	Name:<input type="text" name="name" value=""> <br>
  Course:<select name="course">
  	<option value="">select course</option>
  	<?php?>
  </select><br>
  State Id:<select name="State" id="st">
  	<option value="">select state</option>
  	<?php

  	foreach($state as $row)
  	{
  		?>
  	 <option value="<?php echo $row['id'] ?>"><?php echo $row['state'] ?></option>
  	 <?php
  	}
  	?>
  </select><br>
City:<select name="cty" id=cty>
  	
  	
  </select><br>
  Status:<input type="number" name="Status" value="">
	<input type="submit" name="submit" value="submit">
	</form>
</pre>
</body>
</html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	$('#st').change(function(){

  var state_id = $('#st').val();
  
  if(state_id != '')
  {
  	 
   $.ajax({
    url:"<?php echo base_url().'A_mm_master/fetch_city'; ?>",
    method:"POST",

    data:{state_id:state_id},
    success:function(data)
    {
    $('#cty').html(data);
    }
   });
   
  }
})
})



</script>





