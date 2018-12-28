<div class="container">
	<center><p>If not registered click on <a href="<?php echo base_url().'Main/index';  ?>">register</a></p></center>
	<form method="post" action="<?php echo base_url(). 'user-login'; ?>">
	<div class="row">
		<div class="col-lg-6 col-lg-offset-4 form-group">
			<label for="nm">Name:</label>
			<input type="text" name="name" class="form-control" id="name">
		</div>
		
		<div class="col-lg-6 col-lg-offset-4 form-group">
			<label for="ps">Password:</label>
			<input type="password" name="password" class="form-control" id="password">
		</div>
		<div class="col-lg-6 col-lg-offset-4">
			<input type="submit" name="submit" value="Login">
		</div>
	</div>
	</form>
</div>