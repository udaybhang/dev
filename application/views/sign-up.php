<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title></title>
	<style type="text/css">
		.content_wrapper{
			margin:10%;
		}
	</style>
</head>
<body>
<div class="content_wrapper">
	<span class="error_message"></span>
	<form id="login_form" method="post">
		<div class="form-group">
			<label>Email:</label>
			<input type="text" name="email" class="form-control" id="email">
		</div>
		<div class="form-group">
			<label>Password:</label>
			<input type="password" name="password" class="form-control" id="password">
		</div>
			<input type="submit" name="submit" value="Login" id="submit" class="btn btn-info">
	</form>
</div>
</body>
</html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{
		
		$("#login_form") .on('submit', function(event)
		{
			
			event.preventDefault();
			$.ajax({
				method: "POST",
				datatype:"text",
				url:"<?php echo base_url().'check-login';  ?>",
				data:$(this).serialize(),
				success:function(data)
				{
					console.log(data);
					
					if(data!=''){
					
                  $('.error_message').html(data);
                  }
                  else{

                  	window.location='<?php echo base_url().'home'   ?>';
                  }
				}
			})
		})
	})
</script>