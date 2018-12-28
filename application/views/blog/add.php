
<div class="container">
	<h3>Add Blog</h3>
<a href="<?php  echo base_url().'Blog/index' ?>" class="btn btn-primary">BACK</a>
	<form method="post" action="<?php echo base_url().'Blog/submit' ?>">
		<div class="form-group">
		<label class="col-lg-4 text-right">Title</label>
        </div>
        <div class="col-lg-8">
        	<input type="text" name="txt_title" class="form-control">
        </div>
        <div class="form-group">
        	<label class="col-lg-4 text-right">Description</label>
        </div>
        <div class="col-lg-8">
        	<textarea name="txt_description" class="form-control"></textarea>
        </div><div class="form-group">
        	<label class="col-lg-4 text-right"></label>
        </div>
        <div class="col-lg-8">
        	<input type="submit" name="btnSave" class="btn btn-primary" value="Save">
        </div>
	</form>
</div>