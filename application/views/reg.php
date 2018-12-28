
<div class="container">
	<center><p>If already registered click on <a href="<?php echo base_url().'login-form'; ?>">Login</a></p></center>
	
	<form method="post" action="<?php echo base_url().'user-register' ?>">
	<div class="row">
		<div class="col-lg-6 col-lg-offset-4 form-group">
			<label for="nm">Name:</label>
			<input type="text" name="name" class="form-control" id="name">
		</div>
		<div class="col-lg-6 col-lg-offset-4 form-group">
			<label for="eml">Email:</label>
			<input type="text" name="email" class="form-control" id="email">
		</div>
		<div class="col-lg-6 col-lg-offset-4 form-group">
			<label for="ps">Password:</label>
			<input type="password" name="password" class="form-control" id="password">
		</div>
		<div class="col-lg-6 col-lg-offset-4">
			<input type="submit" name="submit" value="register">
		</div>
	</div>
	</form>
</div>
