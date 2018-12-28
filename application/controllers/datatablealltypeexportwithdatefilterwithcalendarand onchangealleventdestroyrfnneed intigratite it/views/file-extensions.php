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
   /* Sohrab 30 apr 2017 */
   .danger{
		background-color: #f2dede;
	    border-color: #ebccd1;
	    color: #a94442;
		text-align: center;
		margin:auto;
		margin-bottom: 15px;
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
		margin-bottom: 15px;
		margin-top: 30px;
		padding: 10px;
		width: 80%;
		box-shadow: 0px 0px 10px #d6e9c6;
	    }
	    #levellist>div{
	    	height: 34px;
	    	line-height: 34px;
	    	margin-bottom: 5px;
	    	padding:0px;
	    }
	    #levellist>div.col-md-3{
	    	font-weight: 700;
	    }

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	
	<div class="row main">
		<div class="col-md-12">
			<div class="col-md-10 col-md-offset-1">
				<div class="col-md-12">
	              <?php
	              if($this->session->flashdata('data_message')){
	              	echo $this->session->flashdata('data_message');
	              }
	              ?>
				</div>
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="background-color: #587EA3">
						<div class="col-md-12">
							<h2 class="lel">File Extensions Type</h2> </div>
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
          <h3 class="box-title">File Extensions Type</h3>
        </div>
         <?php 
            	$permission_array=$this->session->userdata('permission_array');
					for($i=0;$i<sizeof($permission_array);$i++){
					    $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
					    if($p["permission_description"]=="Create"){
		?>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
	            <form action="<?php echo base_url()?>extension-create" autocomplete="off" method="post">
	             <!-- /.form-group -->
	              <div class="form-group" id="formextension">
	              	<input type="text" class="form-control" placeholder="File Type Name" name="file_typename" required="required" style="margin-bottom: 5px;" />
	              	<input type="text" class="form-control" placeholder="Enter Accept Extension (eg. xlsx)" name="file_extensions[]" required="required" style="margin-bottom: 5px;" />
	              </div>
	              	<input type="button" class="btn btn-primary btn-md " style="float: left: ;background-color:#112B4E; border-color: #112B4E;" value="Add Extension Field" id="addbutton" />
					<input type="submit" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E;" value="Insert" />
	          	</form>
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <?php }} ?>
      </div>
      <!-- /.box -->

	          	<div class="col-md-12" style="padding-top: 10px;">
	          	<table class="table table-striped table-responsive" id="01">
				<thead>
				<tr>
					<th>S.No</th>
					<th>File Name</th>
					<th>File Extensions</th>
					<th>Created Date</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
					<?php
						$a=1;
						foreach ($master_filetype_lists as $master_filetype_list) {
					?>
					<tr>
						<td><?php echo $a; ?></td>
						<td><?php echo $master_filetype_list['ft_name'] ?></td>
						<td><?php echo $master_filetype_list['ft_extensions'] ?></td>
						<td><?php echo $master_filetype_list['created_date'] ?></td>
						<td>
							  <?php 
						            	$permission_array=$this->session->userdata('permission_array');
											for($i=0;$i<sizeof($permission_array);$i++){
											    $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
											    if($p["permission_description"]=="Delete"){
							  ?>
							<a href="<?php echo base_url().'delete-filetype/'.rtrim(strtr(base64_encode($master_filetype_list['ft_id']), '+/', '-_'), '='); ?>">Delete</a>
							  <?php }} ?>
						</td>
					</tr>

					<?php
						$a++;
						}
					?>
				</tbody>
				</table>
	          	</div>
   

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
<script>
	
  $(function () {
   
	 $("#01").DataTable();
	$("#testtable2").DataTable();
    $('#').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });

  $("#addbutton").click(function(){
  	var gen ='<input type="text" class="form-control" placeholder="Enter Accept Extension (eg. xls,xlsx,doc,docx)" name="file_extensions[]" required="required" style="margin-bottom: 5px; width:95%; float:left;" /><i style="width:5%; float:left; text-align:right; padding:5px 0px; font-size:24px; cursor:pointer;" class="fa fa-minus removethis"></i>';
  	$("#formextension").append(gen);
  	$('.removethis').click(function(){
  		$(this).prev().remove();
  		$(this).remove();
  	});
  });
</script>