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
							<h2 class="lel">Master Assignment</h2> </div>
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
					              <h3 class="box-title">Master Assignment</h3>
					            </div>
					            	<?php 
					            	$permission_array=$this->session->userdata('permission_array');
					            			for($i=0;$i<sizeof($permission_array);$i++){
					            				$p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
					            				//echo $p["permission_description"];
					            				if($p["permission_description"]=="Create"){

					            	?>
					            	<div class="col-md-6">
					            		<a href="<?php echo base_url() ?>create-assignment">
					            			<button class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E; margin-left: 3px; ">Create Assignment</button>
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
				  <th style="width: 33.0114px;">A-Id</th>
				  <th>Assignment Name</th>
                  <th>Level</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th></th>
					</tr>
								</thead>
								<tbody>

				<?php
					$a=1;
					foreach ($lists as $list) {
				?>
				 
				<tr>
				<td><?php echo $a; ?>.</td>
				  <td><?php echo $list->mas_id ?></td>
                  <td><?php echo $list->assignment_name ?></td>
                 <td><?php echo $list->number_of_level ?></td>
				 <td><?php echo date('d-m-Y',strtotime($list->start_date)) ?></td>
				 <td><?php echo date('d-m-Y',strtotime($list->end_date)) ?></td>
				 <td>
				 <?php
				 	$sdate = date('Y-m-d',strtotime($list->start_date));
				 	$todaydate = date('Y-m-d');
				 	//if($sdate > $todaydate){
				 ?>
				 	<?php 
					    for($i=0;$i<sizeof($permission_array);$i++){
					       $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
					       if($p["permission_description"]=="Edit"){

					?>
					     <span class="editassignlink" data-toggle="modal" data-target="#editModal" data-id="<?php echo $list->maid ?>">&nbsp;Edit&nbsp;</span> 
					<?php
					       }
					       if($p["permission_description"]=="Delete"){
					?>
						<span data-toggle="modal" data-target="#myModal" class="assignlink" data-id="<?php echo $list->maid ?>">&nbsp;Delete&nbsp;</span>
					<?php
					       }
					    }
					?>
				 
				 <?php
				//}
				?>
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
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="top: 20%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Are you sure want to delete?</h4>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default deletassign" id="">Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div class="container">
	<!-- Modal -->
	<div class="modal fade" id="editModal" role="dialog">
		<div class="modal-dialog" style="top: 10%;">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Edit Assignment</h4>
				</div>
				<div class="box box-primary">
					<div class="box-header with-border">
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<form role="form" action="<?php echo base_url() ?>assign-update" method="post" enctype="multipart/form-data">
						<div class="box-body">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="exampleInputname">Assignment Number<span  class="required-sp">*</span></label>
										<input type="text" class="form-control" name="assignment_number" id="assignment_number" value=""  placeholder="Assignment Number" maxlength="30" readonly="">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="exampleInputname">Assignment Type<span  class="required-sp">*</span></label>
										<select name="assignment_type" id="assignment_type" class="form-control"></select>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="exampleInputname">Assignment Name<span  class="required-sp">*</span></label>
										<input type="text" class="form-control" id="assignment_name" name="assignment_name" value=""  placeholder="Assignment Name" maxlength="80" required="">
									</div>
								</div>
								<!-- /.col -->
								<div class="col-md-6">
									<!-- /.form-group -->
									<div class="form-group">
										<label>No of levels</label>
										<select name="assign_lvl" id="assign_lvl" class="form-control select2" style="width: 100%;"></select>
									</div>
									<!-- /.form-group -->
								</div>
							
								
								<div class="col-lg-6">
									<div class="form-group">
										<label for="exampleInputname">Start Date<span  class="required-sp">*</span></label>
										<input type="text" class="form-control start_date" name="start_date" id="startdate_11" value="" placeholder="Start Date" >
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="exampleInputname">Assignment Image</label>
										<input type="file" class="form-control " name="image"  >
										<input type="hidden" class="form-control " name="previous_image"  id="previous_image" value="">
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="form-group">
										<label for="exampleInputEmail1">Assignment Description</label>
										<textarea name="assignment_description" id="assignment_description" class="form-control" style="height: 100px;"></textarea>
									</div>
								<!-- /.form-group -->
								</div>
							</div>
							<!-- /.col-lg-6 -->
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button style="float:right" type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
					<!-- form END -->
					<!-- /.box -->
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(".assignlink").click(function(){
		var assignid = $(this).attr("data-id");
		$(".deletassign").attr("id",assignid);
	});
	 $('#validity').change(function(){
    	if(isNaN($(this).val()))
    	{
    		alert('Please enter only number');
    		$(this).val('');
    	}
    	
    });
	$(".editassignlink").click(function(){
	$(".start_date").datepicker();
		$('.timeformatExample1').timepicker({ 'timeFormat': 'H:i:s' });
		$.ajax({
		  method: "POST",
		  data: {'assignid': $(this).attr("data-id")},
		  url: "<?php echo base_url() ?>edit-assign-form",
		  dataType: "JSON",
		  success: function(result){
		  	$("#assignment_number").val(result.mas_id);
		  	$("#assignment_name").val(result.assignment_name);
		  	$("#assignment_description").val(result.assignment_description);
		  	$("#startdate_11").val(result.start_date);
		  	$("#previous_image").val(result.previous_image);
		  
		  	
		   	var opt;
		   	var opttype;
		   	var optnew;
		  	var nlv = result.number_of_level;
		  	var slv = result.sizelevel;

		  	var typearr = new Array("Automatic","Manual");
		  

		  	

		  	for(var ast=0;ast<typearr.length;ast++){
		  		opttype += '<option value="'+typearr[ast]+'"';
		  		if(typearr[ast] == result.type){
		  			opttype += " selected=selected";
		  		}
		  		opttype += '>'+typearr[ast]+'</option>';
			}
		  	$("#assignment_type").html(opttype);

	  		if(slv==nlv){
	  			$("#assign_lvl").attr('readonly','readonly');
	  		}

		  	for(var asi=1;asi<20;asi++){
		  		opt += '<option value="'+asi+'"';
		  		if(asi == result.number_of_level){
		  			opt += " selected=selected";
		  		}
		  		opt += '>'+asi+'</option>';
			}
		  	$("#assign_lvl").html(opt);
		  }
		});
	});
	$(".deletassign").click(function(){
		$.ajax({
		  method: "POST",
		  data: {'assignid': $(this).attr("id")},
		  url: "<?php echo base_url() ?>delete-assignment",
		  dataType: "JSON",
		  success: function(result){
			location.reload();
		  }
		});
	});
</script>
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