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

			

				<?php

				if($this->session->flashdata('data_message')){

					echo $this->session->flashdata('data_message');

				}
				?>

				<section class="invoice show">

					<!-- title row -->

					<div class="row" style="background-color: #587EA3">

						<div class="col-md-12">

							<h2 class="lel">Interactive Case Study List</h2> </div>

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
                           // print_r($permission);
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


                        <?php if(in_array("Export", $permission)){?>
						<input type="button" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E; margin-left: 3px;" onclick="tableToExcel('testtable2', 'W3C Example Table');" value="Export to Excel" />
						<?php } ?>
						<!-- <form action="<?php echo base_url()?>subjective-list" method="post" id="filtercheck">
				        	<div class="col-md-3">
				        	
				        		<select class="form-control" name="assignorder" id="assignorder">
				        			<option value="">Select Topic</option>
				        			<?php
				        				foreach ($topic_list as $list) {
				        					$allasid = $list['t_id'];
				        					if($allasid==$asid){
				        						echo $sel;
				        						$sel = 'selected="selected"';
				        					}else{
				        						$sel = '';
				        					}
				    				?>
				    				<option value="<?php echo $list['t_id']; ?>" <?php echo $sel; ?>><?php echo $list['t_name']; ?></option>
				    				<?php
				        				}
				        			?>
				        		</select>
				        	</div>
        				</form> -->
        				<?php if(in_array("Create", $permission)){?>
						<a href="<?php echo base_url()?>create-interactive-case">
						  <button type="button" class="btn btn-primary btn-md" style="float: right;background-color:#112B4E; border-color: #112B4E; margin-left: 3px; ">Create Interective Case Study</button></a>
						  <?php } ?>
						</div>
            </div>
            </div>
						<table class="table table-striped table-responsive" id="testtable2">

								<thead>
									<tr>
					                  <th>S.No</th>
					                  <th>Question Context</th>
					                  <th>Question</th>
					                  <th>Topic</th>
					                  <th>Type</th>
					                  <th>Skills</th>
									  <th>Created Date</th>
									  <th>Action</th>
									</tr>
								</thead>
								<tbody>

										<?php
                                           //print_r($questions_data);
											$a=0;

											foreach ($questions_data as $question) {	

										?>

										<tr>

											<td><?php echo ++$a ?>.</td>

											<td><?php echo $question['question_context'] ?></td>
											<td><?php echo $question['question'] ?></td>

											<td><?php 

												$topicid = $question['topic'];

												$where = "t_id='$topicid'";

												$rval = $this->Crud_modal->fetch_single_data('t_name','master_topic',$where);

												echo $rval['t_name'] ?></td>

											<td><?php

												$typeid = $question['type'];

												$where = "type_id='$typeid'";

												$rval = $this->Crud_modal->fetch_single_data('type_name','master_type',$where);

												echo $rval['type_name']; ?></td>

											<td><?php 

												$skillid = $question['skill_tested'];

												$where = "skills_id='$skillid'";

												$rval = $this->Crud_modal->fetch_single_data('skills_name','master_skills_test',$where);

												echo $rval['skills_name'] ?></td>

											<td><?php echo  date('d-m-Y H:i:s',strtotime($question['created_date'])) ?></td>
											<td><?php if(in_array("Edit", $permission)){?> <!-- <a href="<?php echo base_url().'view-subjective/'.rtrim(strtr(base64_encode($question['subjective_id']), '+/', '-_'), '='); ?>">View</a> / --><?php } ?><?php if(in_array("Edit", $permission)){?> <a href="<?php echo base_url().'edit-interactive-case-study/'.rtrim(strtr(base64_encode($question['ques_id']), '+/', '-_'), '='); ?>">Edit</a> <?php } ?></td>

										</tr>
										<?php
										}
										?>  	
								</tbody>
							</table>
						</div>
					</div>
				</section>

			

			<div class="col-md-1"></div>

		</div>

	</div>

	<!-- /.content -->

	<div class="clearfix"></div>

</div>





<script>

$('#assignorder').change(function(){

  	$('#filtercheck').submit();

  });


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