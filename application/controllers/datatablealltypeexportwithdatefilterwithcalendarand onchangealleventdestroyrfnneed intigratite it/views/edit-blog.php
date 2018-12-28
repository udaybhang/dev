<style>
.invoice {
position: relative;
background: #fff;
border: 1px solid #f4f4f4;
padding: 0px 16px;
margin: 114px 25px;
padding-bottom: 20px;
}
table>thead>tr>th {
border-bottom:1px solid #ecf0f5;
}
.show {
-webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
-moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}
.table>thead>tr>th,
.table>tbody>tr>th,
.table>tfoot>tr>th,
.table>thead>tr>td,
.table>tbody>tr>td,
.table>tfoot>tr>td {
border: 1px solid #ecf0f5;
}
.box-col
{
border-top: 3px solid #112B4E;
}
.lel {
color: #fff;
text-align: center;
margin-bottom: 7px;
margin-top: 7px;
}
.table > caption + thead > tr:first-child > td,
.table > caption + thead > tr:first-child > th,
.table > colgroup + thead > tr:first-child > td,
.table > colgroup + thead > tr:first-child > th,
.table > thead:first-child > tr:first-child > td,
.table > thead:first-child > tr:first-child > th {
border: 1px solid #fafafa;
}
.dd-mar{
margin-left: -27px;
}
.btn-col
{
background-color: #112B4E;
border-color: #ecf0f5;
}
.ul-mar{
margin-top: 35px; width: 
}
.danger{
	background-color: #f2dede;
    border-color: #ebccd1;
    color: #a94442;
	text-align: center;
	margin:auto;
	margin-top: 30px;
	padding: 10px;
	width: 80%;
	box-shadow: 0px 0px 10px #ebccd1;
}
.success{
	background-color: #dff0d8;
	border-color: #d6e9c6;
	color: #3c763d;
	text-align: center;
	margin:auto;
	margin-top: 30px;
	padding: 10px;
	width: 80%;
	box-shadow: 0px 0px 10px #d6e9c6;
}
.mcq_question{
	height: 300px !important;
}
</style>
<script src="<?php echo base_url() ?>admin_assets/editor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>admin_assets/editor/samples/js/sample.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="row main">
		<div class="col-md-12">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<?php
				if($this->session->flashdata('data_message')){
					echo $this->session->flashdata('data_message');
				}
				?>
			<section class="invoice show">
				<!-- title row -->
				<div class="row" style="background-color: #587EA3">
					<div class="col-md-12">
					<h2 class="lel">Blog</h2> </div>
				</div>
				<div class="clearfix" style="margin-top: 20px;"></div>
				<div class="">
					<div class="col-md-12">
					</div>
				</div>
				<!-- /.box-header -->
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12">
						<section class="content">
							<!-- SELECT2 EXAMPLE -->
							<div class="box box-col">
								<div class="box-header with-border">
									<h3 class="box-title">Edit Blog</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<form autocomplete="off" method="post" action="<?php echo base_url() ?>update-blog" enctype="multipart/form-data" >
										<div class="row">
											<div class="col-md-12">
												<label>Select Category:</label>
												<div class="form-group">
													<input type="hidden" name="blog_id" value="<?php echo $blog['blog_id']; ?>"/>
													<select name="category" required="required" class="form-control">
														<option value="">Select Category</option>
														<?php for($i=0;$i<sizeof($blog_category_list);$i++){ 
															  if($blog_category_list[$i]['blog_cat_id']==$blog['blog_cat_id']){
															  	$sel="selected";
															  }else{$sel="";}
														?>
														<option value="<?php echo $blog_category_list[$i]['blog_cat_id']; ?>" <?php echo $sel; ?>>
															<?php echo $blog_category_list[$i]['blog_category_name']; ?>
														</option>
														<?php } ?>
													</select> 
												</div>
											</div>
											<div class="col-md-12">
												<label>Writer Name:</label>
												<div class="form-group">
													<input name="writer" placeholder="Writer Name" required="required" class="form-control" value="<?php echo $blog['blog_writer_name']; ?>"/>
												</div>
											</div>
											<div class="col-md-12">
												<label>Show Writer Name:</label>
												<div class="form-group">
													<input type="radio" name="show_writer_name" required="required" value="1" <?php if($blog['blog_writer_name_status']==1){echo "checked";} ?>/>Yes
													&nbsp;<input type="radio" name="show_writer_name" required="required" value="0" <?php if($blog['blog_writer_name_status']==0){echo "checked";} ?> />No
												</div>
											</div>
											<div class="col-md-12">
												<label>Blog Title:</label>
												<div class="form-group">
													<input name="title" placeholder="Blog Title" required="required" class="form-control" value="<?php echo $blog['blog_title']; ?>"/>
												</div>
											</div>
											<div class="col-md-12">
												<label>Blog Highlighter:</label>
												<div class="form-group">
												<textarea name="highlighter_text" id="editor1" placeholder="Highlighter" class="form-control">
													<?php echo $blog['blog_highlighter_desc']; ?>
												</textarea>
												</div>
											</div>
											<div class="col-md-12">
												<label>Show Highlighter:</label>
												<div class="form-group">
													<input type="radio" name="show_highlighter" required="required" value="1" <?php if($blog['blog_highlighter_status']==1){echo "checked";} ?> />Yes
													&nbsp;<input type="radio" name="show_highlighter" required="required" value="0" <?php if($blog['blog_highlighter_status']==0){echo "checked";} ?>/>No
												</div>
											</div>
											<div class="col-md-12">
												<label>Blog Content:</label>
												<div class="form-group">
												<textarea name="blog_content" id="editor2" placeholder="Blog Content" class="form-control">
													<?php echo $blog['blog_content']; ?>
												</textarea>
												</div>
											</div>
											<div class="col-md-12">
												<div class="col-md-6">
													<label>Blog thumb image:</label>
													<div class="form-group">
													<input type="file" name="thumb_image" class="form-control" onchange="readURL(this,1);">
													<span>For thumb image, size must be 254*173 pixel</span>
													</div>
												</div>
												<div class="col-md-6">
													<img src="<?php echo base_url().'upload/blog/'.$blog['blog_thumb_image']; ?>" class="img-responsive" style="height:173px; width:254px; margin:3px;" id="blah1"/>
												</div>
											</div>	
											<div class="col-md-12">
												<div class="col-md-6">
													<label>Blog banner image:</label>
													<div class="form-group">
													<input type="file" name="banner_image" class="form-control" onchange="readURL(this,2);">
													</div>
												</div>
												<div class="col-md-6">
													<img src="<?php echo base_url().'upload/blog/'.$blog['blog_banner_image']; ?>" class="img-responsive" style="height:254px; width:450px; margin:3px;" id="blah2"/>
												</div>
											</div>
											<div class="col-md-12">
												<label>Blog Publish Status:</label>
												<div class="form-group">
													<input type="radio" name="publish_status" required="required" value="0" <?php if($blog['blog_publish_status']==0){echo "checked";} ?> />Pending
													&nbsp;<input type="radio" name="publish_status" required="required" value="1" <?php if($blog['blog_publish_status']==1){echo "checked";} ?>/>Published
													&nbsp;<input type="radio" name="publish_status" required="required" value="2" <?php if($blog['blog_publish_status']==2){echo "checked";} ?>/>Unpublished
													&nbsp;<input type="radio" name="publish_status" required="required" value="3" <?php if($blog['blog_publish_status']==3){echo "checked";} ?>/>Rejected
												</div>
											</div>

										</div>
										<?php 
							            	$permission_array=$this->session->userdata('permission_array');
							            	for($i=0;$i<sizeof($permission_array);$i++){
							        $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
							            	
							            	if($p["permission_description"]=="Create"){

							            ?>
										<a href="<?php echo base_url()?>view-blog-list" class="btn btn-primary btn-md " style="float: left;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;">Back</a>
										<input type="submit" value="Submit" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;" />
										<?php }} ?>
										<!-- /.row -->
									</form>
								</div>
								<!-- /.box-body -->
							</div>
							
							<!-- /.box -->
						</section>
						<!-- /.content -->
						</div>
					</div>
				</section>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
	<!-- /.content -->
	<div class="clearfix"></div>
</div>
<script type="text/javascript">
	CKEDITOR.replace(document.getElementById('editor1'));
	CKEDITOR.replace(document.getElementById('editor2'));

	function readURL(input, type) {
	 	if(type==1){
	 		if (input.files && input.files[0]) {
		        var reader = new FileReader();
				reader.onload = function (e) {
		        $('#blah1')
		          .attr('src', e.target.result)
		          .width(254)
		          .height(173);
		        };
				reader.readAsDataURL(input.files[0]);
	    	}
	 	}
 		if(type==2){
	 		if (input.files && input.files[0]) {
		        var reader = new FileReader();
				reader.onload = function (e) {
		        $('#blah2')
		          .attr('src', e.target.result)
		          .width(450)
		          .height(245);
		        };
				reader.readAsDataURL(input.files[0]);
	    	}
	 	}
    }
</script>