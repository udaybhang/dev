<div id="wrapper">
	<div class="container">
		<section>
			<!-- <?php  echo validation_errors(); ?> -->
			<h2 style="text-align: center; text-transform: capitalize;"><u>Registeration</u></h2>
			<form method="post" enctype="multipart/form-data"  action="<?php echo base_url().'A_crudexport/validate'; ?>" >
				<fieldset>
					<legend>User Information Form</legend>
					<div class="row">
						<div class="col-lg-offset-2 col-lg-6">
							<div class="form-group">
						<label for="name">Name:</label>
                      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                      </div>
						</div>
						<div class="col-lg-4">
							<span><?php echo form_error('name'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-offset-2 col-lg-6 ">
							<div class="form-group">
							<label for="email">Email:</label>
                      <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
						</div>
						</div>
						<div class="col-lg-4">
							<span><?php echo form_error('email'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-offset-2 col-lg-6">
							<div class="form-group">
							<label for="phone">Phone:</label>
                      <input type="text" class="form-control" id="phone" placeholder="Enter phone number" name="phone">
						</div>
						</div>
						<div class="col-lg-4">
							<span><?php echo form_error('phone'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-offset-2 col-lg-6">
							<div class="form-group">
							<label for="msg">Message:</label>
                      <textarea cols="12" rows="8" class="form-control" placeholder="write your mind" id="msg" name="message"></textarea>
                      </div>
						
						</div>
						<div class="col-lg-4">
							<span><?php echo form_error('message'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-offset-2 col-lg-6">
							<label for="img">Select image:</label>
                      <input type="file"   name="image" >
						
						</div>
						<div class="col-lg-6">
							<span><!-- <?php //echo form_error('image'); ?> --></span>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-offset-2 col-lg-6">
							<p>&nbsp;</p>
							<input type="submit" name="submit" value="Register" class="btn btn-success">
						</div>
						<div class="col-lg-6">
							
						</div>
					</div>
					<div class="row">
						<div class="col-lg-offset-2 col-lg-6">
							 <?php
							echo '<img src="'.base_url().'uploads/" width="300" height="225" class="img-thumbnail" />';  ?>
						</div>
					</div>
				</fieldset>
			</form>
			<script>
			CKEDITOR.replace( 'message' );
		</script>
		</section>
	</div>
</div>