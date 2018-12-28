<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php echo isset($error)? $error : ''; ?>
<?php echo form_open('Login/process'); ?>
<pre>
	username:<input type="text" name="username" >
	password:<input type="password" name="password">
	        <input type="submit" name="" value="login">
    
</pre>
</body>
</html>