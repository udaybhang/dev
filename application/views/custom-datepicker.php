<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?php echo base_url().'jquery-ui/jquery-ui.min.css'  ?>">

	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="<?php echo base_url().'jquery-ui/jquery-ui.min.js'  ?>"></script>
	
</head>
<body>
	select date<input type="text" size="30" class="form-control" id="datepicker">
</body>
</html>
<script>
	$(document).ready(function()
	{
		$('#datepicker').datepicker({
			dateFormat: "mm-dd-yy",
			changeMonth:true,
			changeYear:true
		})
	})
</script>