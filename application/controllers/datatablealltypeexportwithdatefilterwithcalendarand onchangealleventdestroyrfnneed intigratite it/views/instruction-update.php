<script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
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
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="row main">
		
		<div class="col-md-12">
			<div class="col-md-1"></div>
			<div class="col-md-10">
			<section class="invoice show">
				<!-- title row -->
				<div class="row" style="background-color: #587EA3">
					<div class="col-md-12">
					<h2 class="lel">Assignment Instruction</h2> </div>
				</div>
				<div class="clearfix" style="margin-top: 20px;"></div>
				<div class="">
					
				</div>
				<!-- /.box-header -->
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12">
						<section class="content">
							<!-- SELECT2 EXAMPLE -->
							<div class="box box-col">
								<div class="box-header with-border">
									<h3 class="box-title">Update Instruction</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<form name="instruction-form" autocomplete="off" method="post" action="<?php echo base_url() ?>update-instruction-data">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="exampleInputEmail1">Instruction Name</label>
													<input type="text" class="form-control" maxlength="40" id="instruction_name" name="instruction_name" placeholder="Instruction Name" required="" value="<?php echo $lists['instruction_name']; ?>">
												</div>
											<!-- /.form-group -->
											</div>
											<div class="col-md-12">
												<div class="form-group">
									                  <label>Instruction Description</label>
									                  <textarea name="instruction_description" class="form-control" style="height: 300px;" rows="3" placeholder="Enter ..." required="" ><?php echo $lists['instruction_description']; ?></textarea>
									                  <script>
            											CKEDITOR.replace( 'instruction_description');
        											  </script>
             									</div>
             									<input type="hidden" value="<?php echo $lists['instruction_id']?>" name="instruction-id" >
											</div>
										<!-- /.col -->
										</div>
										<button data-toggle="modal" data-target="#myModal" type="button " class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E">Update</button>
										<!-- /.row -->
									</form>
									<a href="<?php echo base_url()?>view-instruction" class="btn btn-primary btn-md" style="float: left; background-color:#112B4E; border-color: #112B4E">Cancel</a>
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
