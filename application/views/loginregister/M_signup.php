					<!DOCTYPE html>
					<html>
					<head>
					<title></title>
					<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css' ?>">
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

					</head>

					<body>
					<div class="container">
					<center><h2>signup</h2></center>
					<?php 
					echo form_open('M_login/signup_validation');
					echo validation_errors(); // it show the error wose define in ||||
					?>
					<fieldset>
					<legend>Register</legend>
					<div class="form-group">
					<label for="nm" class="col-lg-2 col-lg-offset-3 control-label" align="right">Name:</label>
					<div class="col-lg-5">
					<input type="text" class="form-control" id="nm" placeholder="Enter your name" name="name">
					</div>
					</div>
					<div class="form-group">
					<label for="eml" class="col-lg-2 col-lg-offset-3 control-label" align="right" name="email">Email:</label>
					<div class="col-lg-5">
					<input type="text" id="eml" class="form-control"  placeholder="Enter your Email">
					</div>
					</div>
					<div class="form-group">
					<label for="psd" class="col-lg-2 col-lg-offset-3 control-label" align="right" name="password">password:</label>
					<div class="col-lg-5">
					<input type="password" id="psd" name="password" class="form-control"  placeholder="Enter your password">
					</div>
					</div><div class="form-group">
					<label for="cpsd" class="col-lg-2 col-lg-offset-3  control-label" align="right">Conferm Password:</label>
					<div class="col-lg-5">
					<input type="password" id="cpsd" class="form-control" name="cpassword" placeholder="Enter your Conferm password">
					</div>
					</div>
					<div class="form-group">
					<div class="col-lg-offset-5 col-lg-7"><p>&nbsp;</p>
					<input type="submit" class="btn btn-primary" name="signup_submit" value="SignUp">	
					<a href="<?php echo base_url().'M_login/index'  ?>" class="btn btn-success">Login</a>
					</div>
					</div>
					</fieldset>
					<?php
					// echo "<p>Name";
					// echo form_input('name';
					// echo "</p>";
					// echo "<p>Email";
					// echo form_input('email');
					// echo "</p>";
					// echo "<p>Password";
					// echo form_password('password');
					// echo "</p>";
					// echo "<p> Conferm Password";
					// echo form_password('cpassword');
					// echo "</p>";
					// echo "<p>";
					// echo form_submit('signup_submit', 'Sign up');
					// echo "</p>";
					echo form_close();
					?>
					</div>
					</body>
					</html>