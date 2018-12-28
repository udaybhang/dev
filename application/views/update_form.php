<div class="container">
	
	
	<form method="post" action="<?php echo base_url().'Main/update_form_data'; ?>">
	
	<div class="row">
		<div class="col-lg-6 col-lg-offset-4 form-group">
			<label for="nm">Name:</label>
			<input type="text" name="name" class="form-control" id="name" value="<?php  echo $user_data['name']  ; ?>">
		</div>
		<div class="col-lg-6 col-lg-offset-4 form-group">
			<label for="eml">Email:</label>
			<input type="text" name="email" class="form-control" id="email" value="<?php  echo $user_data['email']  ; ?>">
		</div>
		<div class="col-lg-6 col-lg-offset-4 form-group">
			<label for="ps">Password:</label>
			<input type="password" name="password" class="form-control" id="password" value="<?php  echo $user_data['password']  ; ?>">
		</div>
		<input type="hidden" name="hidden_id" value="<?php echo $user_data['id']; ?>">
		<div class="col-lg-6 col-lg-offset-4">
			<input type="submit" name="submit" value="Update">
		</div>
	</div>
	</form>
</div>