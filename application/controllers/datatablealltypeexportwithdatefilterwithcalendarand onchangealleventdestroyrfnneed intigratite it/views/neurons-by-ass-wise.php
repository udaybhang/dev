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

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	
	<div class="row main">
		<div class="col-md-12">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<?php
				if($this->session->flashdata('job_message')){
					echo $this->session->flashdata('job_message');
				}
				?>
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="background-color: #587EA3">
						<div class="col-md-12">
							<h2 class="lel"><?php $user_details=$this->Crud_modal->fetch_single_data("mm_user_full_name,mm_user_email","user","mm_uid='$mm_uid'");echo "$user_details[mm_user_full_name] ($user_details[mm_user_email]) ($mm_uid)"?></h2> </div>
					</div>
					<div class="clearfix" style="margin-top: 20px;"></div>
					<div class="">
						<div class="col-md-12">
							 <?php 
                        $permission_array=$this->session->userdata('permission_array');
                        //print_r($permission_array);
                            for($i=0;$i<sizeof($permission_array);$i++){
                              $p =$this->Crud_modal->fetch_single_data('permission_description','master_permission',"permission_id='$permission_array[$i]'");
                              
                              $permission[] = $p["permission_description"];
                              
                            }
                             //print_r($permission);               

                        ?>
							</div>
					</div>
					<!-- /.box-header -->
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12">
							<div class="box box-col">
								<div class="box-header">
									<div class="col-md-12">
									<?php if(in_array("Export", $permission)){ ?>
									<input type="button" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E; margin-left: 3px;" onclick="tableToExcel('testtable2', 'W3C Example Table');" value="Export to Excel" />
									<?php } ?>
									</div>
								</div>
							</div>
							<table class="table table-striped table-responsive" id="testtable2">
								<thead>
									<tr>
										<th>S.No</th>
										<th>Package Name</th> 
										<th>Assignment</th> 
										<th>Level</th>
										<th>Neurons</th>
									</tr>
								</thead>
								<tbody>
									<?php for($i=0;$i<sizeof($package_id);$i++){
									$package_details=$this->Crud_modal->Crud_modal->fetch_single_data('package_name,ma_id',"mm_packages","package_id='$package_id[$i]'");
									$check_user =$this->Crud_modal->check_numrow('completed_assignment',"maid in($package_details[ma_id]) and uid='$mm_uid'");	
									if($check_user > 0){	
									?>				
									<tr>
										<td><?php echo ($i+1)?></td>
										<td><?php echo $package_details['package_name']?></td>										
										<?php 
											$maid_size=explode(",",$package_details['ma_id']); 
											$completed_assignment = $this->Crud_modal->check_numrow('completed_assignment',"maid in($package_details[ma_id]) and status='1' and uid='$mm_uid'"); 
										?>
										<td><?php echo $completed_assignment.'/'.sizeof($maid_size)?></td>
										<td>
											<?php if(in_array("View", $permission)){ ?>
									<a href="<?php echo base_url()?>level-user-neurons/<?php echo rtrim(strtr(base64_encode($package_id[$i]), '+/', '-_'), '=').'-'.rtrim(strtr(base64_encode($mm_uid), '+/', '-_'), '=').'-'.$this->uri->segment(2)?>">
												<?php echo $data_level_comp=$this->Crud_modal->check_numrow('completed_level',"maid in($package_details[ma_id]) and status='1' and uid='$mm_uid'"),"/"; 
												echo $data_level=$this->Crud_modal->check_numrow('master_level',"maid in($package_details[ma_id]) and ml_status='1'"); ?>
											</a>

										<?php }else{?>
                                           <?php echo $data_level_comp=$this->Crud_modal->check_numrow('completed_level',"maid in($package_details[ma_id]) and status='1' and uid='$mm_uid'"),"/"; 
												echo $data_level=$this->Crud_modal->check_numrow('master_level',"maid in($package_details[ma_id]) and ml_status='1'"); ?>
										<?php }?>

												
										</td>	
										<td ><?php $data_val_neurons=$this->Crud_modal->fetch_single_data('sum(neurons) as neurons','score',"status='1' and package_id='$package_id[$i]' and u_id='$mm_uid'"); echo $data_val_neurons['neurons']; ?>											
										</td>						
									</tr>
									<?php } }?>				
								</tbody>
							</table>
							<a href="<?php echo base_url()?>neurons-per-day-user-details" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E; margin-left: 3px;">Back</a>
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

// table code   
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

  // code of export to excel
      var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
    </script>