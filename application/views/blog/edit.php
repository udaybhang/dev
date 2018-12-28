
<div class="container">
	<h3>Edit Blog Blog</h3>
<a href="<?php  echo base_url().'Blog/update' ?>" class="btn btn-primary">BACK</a>
	<form method="post" action="<?php echo base_url().'Blog/update'; ?>">
                <input type="hidden" name="hidden_id" value="<?php echo $blog->id; ?>">
		<div class="form-group">
		<label class="col-lg-4 text-right">Title</label>
        </div>
        <div class="col-lg-8">
        	<input type="text" name="txt_title" class="form-control" value="<?php echo $blog->title; ?>">
        </div>
        <div class="form-group">
        	<label class="col-lg-4 text-right">Description</label>
        </div>
        <div class="col-lg-8">
        	<input type="text" name="txt_description" class="form-control" value="<?php echo $blog->description; ?>">
        </div><div class="form-group">
        	<label class="col-lg-4 text-right"></label>
        </div>
        <div class="col-lg-8">
        	<input type="submit" name="btnUpdate" class="btn btn-primary" value="Update">
        </div>
	</form>
</div>