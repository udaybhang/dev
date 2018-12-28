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
.frmSearch {border: 1px solid #a8d4b1;background-color: #c6f7d0;margin: 2px 0px;padding:40px;border-radius:4px;}
#country-list{float:left;z-index:11110;list-style:none;margin-top:-3px;padding:0;width:950px;position: absolute;}
#country-list li{padding: 10px;z-index:11110; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover{background:#ece3d2;z-index:11110;cursor: pointer;}
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
					<h2 class="lel">Create Group</h2> </div>
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
									<h3 class="box-title">Create Group</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<form autocomplete="off" method="post" action="<?php echo base_url() ?>insert-group" enctype="multipart/form-data">
										<div class="row">
											
											<div class="col-md-12">
												<div class="form-group">
													<input type="text"  name="group_name" placeholder="Group Name" class="form-control" required="required" />
												</div>
											</div>
<div class="col-md-12">
												<div class="form-group">
													<input type="text"  name="group_prefix" placeholder="Group prefix" class="form-control" required="required" />
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<input type="text"  name="group_description" placeholder="Group Description" class="form-control" required="required" />
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<input type="file"  name="image" placeholder="Group Image" class="form-control" required="required" />
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<input type="text" id="search-box"  name="group_leader" placeholder="Group Leader" class="form-control" required="required" />
													<input type="hidden" value="" name="text_members" class="form-control" id="members" autocomplete="off">
													<div id="suggesstion-box"></div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<select name="group_type" class="form-control" required="required">
														<option value="">Group Type</option>
														<?php
															foreach ($group_type as $group) {
														?>
														<option value="<?php echo $group['group_type_id']?>"><?php echo $group['group_type_name']?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
														<select name="group_status" class="form-control" required="required">
														<option value="">Group Status</option>
														<?php
														$status=array('Inactive','Active');
															for($i=0;$i<sizeof($status);$i++) {
														?>
														<option value="<?php echo $i;?>"><?php echo $status[$i];?></option>
														<?php
														}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<select name="privacy" class="form-control" required="required">
														<option value="">Group Privacy type</option>
														<?php
															foreach ($privacy as $pri) {
														?>
														<option value="<?php echo $pri['group_privacy_id']?>"><?php echo $pri['group_privacy_name']?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
										<!-- /.col -->
										</div>
										<?php 
									                 $permission_array=$this->session->userdata('permission_array');
									                  for($i=0;$i<sizeof($permission_array);$i++){
									                    $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
									                    if($p["permission_description"]=="Create"){

									     ?>
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
<script src="<?php echo base_url()?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "<?php echo base_url()?>search-member",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
				$("#suggesstion-box").html(data);
				$("#search-box").css("background","#FFF");

			$(".members_col").click(function(){
				$("#members").val($(this).attr('id'));
				$('input[name="text_members"]').prop('type', 'text');
				$("#search-box").val($(this).attr('data-id'));
				$("#search-box").css("display","none");
				$("#suggesstion-box").hide();
			});
		}
		});
	});
});
</script>