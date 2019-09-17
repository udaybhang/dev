<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css' ?>">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <style type="text/css">

  </style>
</head>
<body>
<div class="container">
	<?php  
if($this->session->flashdata('msg'))
{
?>
<div><?php echo $this->session->flashdata('msg'); ?></div>
<?php
}


if($this->session->flashdata('error'))
{
?>
<div> <?php echo $this->session->flashdata('error'); ?></div>
<?php
}

?>
	<h1>login</h1>
	<?php
	echo form_open('M_login/login_validation');
	// <form action="http://localhost/dev/index.php/M_login/login_validation" method="post" accept-charset="utf-8">
 echo validation_errors(); // for this use you can show message for validationn autometically whose applied on Main controller
	// echo "<p>Email";
	  // echo form_input('email' );//, $this->input->post('email')

	// echo "</p>";
	// echo "<p>password";
	// echo form_password('password');
	// echo "</p>";
	 ?>
	 <fieldset>
    <legend>Login Form</legend>
    <div class="form-group">
      <label for="em" class="col-lg-2 col-lg-offset-4 control-label" align="right">Email:</label>
      <div class="col-lg-4">
        <input type="text" class="form-control" id="em" placeholder="Enter your email" name="email">
      </div>
    </div>
    <div class="form-group">
      <label for="ps" class="col-lg-2 col-lg-offset-4 control-label" align="right">Password</label>
      <div class="col-lg-4">
        <input type="password" id="ps" name="password" class="form-control"  placeholder="Enter your password">
    </div>
</div>
</fieldset>
<p>&nbsp;</p> <!-- &nbsp; apply more space than simple <p> -->
<div class="form-group">
      <div class="col-lg-2 col-lg-offset-6">
        
        <input type="submit"  name="login_submit"  class="btn btn-primary" value="Login">
        <a href="<?php echo base_url().'M_login/signup';  ?>" class="btn btn-info">Sign Up</a>	
      </div>
    </div>
<?php
	// echo "<p>";
	// echo form_submit('login_submit', 'Login');
	// echo "</p>";
	// echo form_close();
	?> 

</div>
</body>
</html>