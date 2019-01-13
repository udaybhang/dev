<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>csrf token example</title>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<?php echo $token;   ?>
	<form action="<?php echo base_url().'Csrf_token/search'   ?>" autocomplete="off" method="post">
		Search: <input type="text" name="search"><br>
		<input type="hidden" name="token" value="<?php echo  $token;  ?>">
		<input type="submit" name="submit" value="submit">
	</form>
</body>
</html>