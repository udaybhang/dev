<!-- <?php 
//print_r($user); //correct
?> -->
<div class="container">
	
	
	<section>
		<?php  
if($this->session->flashdata('msg'))
{
?>
<div><?php echo $this->session->flashdata('msg'); ?></div>
<?php
}
?>
			<!-- <?php // echo validation_errors(); ?> -->
			<h2 style="text-align: center; text-transform: capitalize;"><u>Please Check your detail</u></h2>
			<form method="post" enctype="multipart/form-data"  action="<?php echo base_url().'A_crudexport/submitupdate'; ?>" >
				<fieldset>
					<legend>User update Form</legend>
					<input type="hidden" name="hidden_id" value="<?php echo $user->id; ?>">
					<div class="row">
						<div class="col-lg-offset-2 col-lg-6">
							<div class="form-group">
						<label for="name">Name:</label>
                      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="<?php echo $user->name; ?>">
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
                      <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $user->email; ?>">
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
                      <input type="text" class="form-control" id="phone" placeholder="Enter phone number" name="phone"  value="<?php echo $user->phone; ?>">
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
                      <textarea cols="12" rows="8" class="form-control" placeholder="write your mind" id="msg" name="message"  value="<?php echo $user->message; ?>"></textarea>
                      </div>
						
						</div>
						<div class="col-lg-4">
							<span><?php echo form_error('message'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-offset-2 col-lg-6">
							<label for="img">Select image:</label>
                      <input type="file"  id="img"  name="image">
						
						</div>
						<div class="col-lg-6">
							<span></span>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-offset-2 col-lg-6">
							<p>&nbsp;</p>
							<input type="submit" name="submit" value="Update" class="btn btn-success">
						</div>
						<div class="col-lg-6">
							
						</div>
					</div>
				</fieldset>
			</form>
		</section>
	</div>

</div>