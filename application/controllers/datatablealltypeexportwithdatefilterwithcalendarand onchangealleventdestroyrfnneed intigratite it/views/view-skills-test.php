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

   /* Sohrab 29 apr 2017 */
   .danger{
		background-color: #f2dede;
	    border-color: #ebccd1;
	    color: #a94442;
		text-align: center;
		margin:auto;
		margin-bottom: 15px;
		margin-top: 30px;
		padding: 10px;
		width: 50%;
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
		width: 50%;
		box-shadow: 0px 0px 10px #d6e9c6;
	    }

	.assignlink, .editassignlink{
		color: #3c8dbc;
		cursor: pointer;
	}
	.assignlink:hover,.assignlink:active,.assignlink:focus, .editassignlink:hover, .editassignlink:active, .editassignlink:focus {
		outline:none;
		text-decoration:none;
		color:#72afd2
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	
	<div class="row main">
		<div class="col-md-12">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="col-md-12">
	              <?php
	              if($this->session->flashdata('assign_update_message')){
	              	echo $this->session->flashdata('assign_update_message');
	              }else if($this->session->flashdata('assign_message')){
	              	echo $this->session->flashdata('assign_message');
	              }
	              ?>
				</div>
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="background-color: #587EA3">
						<div class="col-md-12">
							<h2 class="lel">Skill</h2> </div>
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
							<div class="box box-col">
							<div class="box-header">
								<div class="col-md-6">
					              <h3 class="box-title">Skill</h3>
					            </div>
					            	<?php 
					            	$permission_array=$this->session->userdata('permission_array');
					            			for($i=0;$i<sizeof($permission_array);$i++){
					            				$p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
					            				//echo $p["permission_description"];
					            				if($p["permission_description"]=="Create"){

					            	?>
					            	<div class="col-md-6">
					            		<a href="<?php echo base_url() ?>create-skill-test">
					            			<button class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E; margin-left: 3px; ">Create</button>
					            		</a>
					            	</div>
					            	<?php
					            				}else{
					            				}
					            			}
					            	?>
					           
					        </div>
					        </div>
							<table class="table table-striped table-responsive" id="01">
								<thead>
									<tr>
					                  	<th>S.No</th>
										<th>Skills Id</th>
						                <th>Name</th>
										<th>Order</th>
										<th>Skill Ability</th>
										<th>Description</th>
										<th>Created Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

															<?php

									$a=1;

									foreach ($skills_test_lists as $skills_test_list) {

								?>

								<tr>

									<td><?php echo $a; ?></td>
									<td><?php echo $skills_test_list['skills_id'] ?></td>
									<td><?php echo $skills_test_list['skills_name'] ?></td>
									<td><?php echo $skills_test_list['order_id'] ?></td>
									<td><?php echo $skills_test_list['skills_ab'] ?></td>
									<td><?php echo $skills_test_list['skills_desc'] ?></td>
									<td><?php echo $skills_test_list['created_date'] ?></td>
									<td><a href="<?php echo base_url().'master-skilltest-edit/'.rtrim(strtr(base64_encode($skills_test_list['skills_id']), '+/', '-_'), '='); ?>">Edit</a>
				                     <!-- <a href="<?php echo base_url().'skills-test-delete/'.rtrim(strtr(base64_encode($skills_test_list['skills_id']), '+/', '-_'), '='); ?>">Edit</a> -->
									</td>
								</tr>



								<?php

								$a++;

								}

								?>

				
								</tbody>
							</table>
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
</script>