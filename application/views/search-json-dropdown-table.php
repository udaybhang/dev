<!DOCTYPE html>
<html>
<head>
	<title>search json  table</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div style="margin:50px 150px;">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="form-group">
			<label>User Type</label>
			<select class="form-control" id="vselect">
				<option value="1">platinum</option>
				<option value="2">debit card</option>
				<option value="3">Credit Card</option>
			</select>
		</div>
		<input type="button" name="" class="btn btn-primary" value="search" id="search">
		<div>
			<table class="table table-bordered table-striped">
				<tr>
					<th>user name</th>
					<th>plan name</th>
					<th>amount</th>
					
				</tr>

			</table>
		</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function()
	{
		$("#search").click(function()
		{
			var vs=$("#vselect").val();
			
			$.ajax({
			method:"post",
			url:"<?php echo base_url().'table-json-onchange'   ?>",
			data:{vs:vs},
			success:function()
			{
		

			}
		})
		})
	})






</script>