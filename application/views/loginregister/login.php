<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php echo isset($error)? $error : '';

	 ?>
<?php echo form_open('Login/process');
//<form action="http://localhost/dev/index.php/Login/process" method="post" accept-charset="utf-8">
 ?>
<pre>
	username:<input type="text" name="username" >
	password:<input type="password" name="password">
	        <input type="submit" name="" value="login">
    
</pre>
</body>
</html>