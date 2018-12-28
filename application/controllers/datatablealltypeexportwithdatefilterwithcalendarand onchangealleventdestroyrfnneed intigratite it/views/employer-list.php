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
		<div class="col-md-13">
			 <?php
	              if($this->session->flashdata('data_message')){
	              	echo $this->session->flashdata('data_message');
	              }else if($this->session->flashdata('data_message')){
	              	echo $this->session->flashdata('data_message');
	              }
	         ?>
			<div class="col-md-1">
				
			</div>
			<div class="col-md-16">
				<div class="col-md-10">
	             
				</div>
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="background-color: #587EA3">
						<div class="col-md-12">
							<h2 class="lel">Registered Employer List</h2> </div>
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
					            <div class="col-md-12">
					            	<?php 
							            	$permission_array=$this->session->userdata('permission_array');
							            			for($i=0;$i<sizeof($permission_array);$i++){
							            				$p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
							            				if($p["permission_description"]=="Export"){

					    			?>
									<input type="button" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E; margin-left: 3px;" onclick="tableToExcel('testtable2', 'Employer Record Table');" value="Export to Excel" />
									<?php }} ?>
										<form action="<?php echo base_url()?>employer-lists" method="post" id="filtercheck">
							        	<div class="col-md-3">
							        	
							        		<select class="form-control" name="assignorder" id="assignorder">
							        			<option value="">Select Industry</option>
							        			<option value="*">All</option>
							        			<?php
							        				foreach ($industry_list as $list) {
							        					$allasid = $list['industry_id'];
							        					$siv=$selected_industry_value;
							        					if($allasid==$siv){
							        						$sel = 'selected="selected"';
							        					}else{
							        						$sel = '';
							        					}
							    				?>
							    				<option value="<?php echo $list['industry_id']; ?>" <?php echo $sel; ?>><?php echo $list['industry_name']; ?></option>
							    				<?php
							        				}
							        			?>
							        		</select>
							        	</div>
			        				</form>
									<a href="<?php echo base_url()?>employer-lists">
									<button type="button" class="btn btn-primary btn-md" style="float: right;background-color:#112B4E; border-color: #112B4E; margin-left: 3px; ">Show All</button></a>
								</div>
						</div>
					</div>
					
							<div class="table-responsive"> 
							<table class="table table-striped" id="testtable2">
								<thead>
									<tr>
					                  <th>S.No</th><?php if($industry_selected=='1'){ ?>
									  	<th>Industry</th>
									  	<?php } ?>
									  <th>Company</th><th>Location</th><th>Email</th><th>Mobile</th><th>Phone</th>
									  <th>ConcernPerson</th><th>Website</th><th>Reg.Date</th><th>Status</th><th>IsApproved</th><th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$a=1;
										foreach ($employers as $elist) {
									?>
				 					<tr>
										<td><?php echo $a; ?>.</td>
									  	<?php if($industry_selected=='1'){ ?>
									  	<td>
									  	<?php 
										  $in_id=$elist['employer_industry_id'];
										  $in_name = $this->Crud_modal->fetch_single_data('industry_name','mm_master_industry_topic',"industry_id=$in_id");
										  echo $in_name['industry_name']; 
										 ?></td>
									  	<?php } ?>
					                 	<td><?php echo $elist['employer_company'] ?></td>
					                 	<?php 
	                                        $cityId=$elist['employer_city_id'];
	                                        $getCity=$this->Admindashboard_modal->get_city_name($cityId);
                                       
                                    	?>
                                    	<td><?php echo $getCity['name']; ?></td>
					                 	<td><?php echo $elist['employer_email'] ?></td>
									 	<td><?php echo $elist['employer_mobile'] ?></td>
									 	<td><?php echo $elist['employer_phone'] ?></td>
									 	<td><?php echo $elist['employer_contact_person_name'] ?></td>
									 	<td><?php if($elist['web_link']!=''){echo '<a href="'.$elist['web_link'].'" target="_blank" >'.$elist['web_link'].'</a>'; } ?></td>
										<td><?php  if($elist['employer_reg_date']!="0000-00-00 00:00:00"){echo date("d/m/Y g:i A", strtotime($elist['employer_reg_date']));}else{echo "Not Available";} ?>
									 	<td><?php if($elist['eamil_auth_status']==1){echo "Verified";}
									 	else{ echo "<span style='color:red' >Not Verified </span>";} ?></td>
									 	<td><?php if($elist['employer_status']==1){echo "Yes";}
									 	else{ echo "<span style='color:red' >No </span>";} ?></td>
									 	<td>
									 		<?php $eid=$elist['employer_id']; $encoded_id=rtrim(strtr(base64_encode($eid), '+/', '-_'), '='); ?>
									 		<?php 
							            		$permission_array=$this->session->userdata('permission_array');
							            			for($i=0;$i<sizeof($permission_array);$i++){
							            				$p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
							            				if($p["permission_description"]=="View"){

					    					?>
										 	<a href="<?php echo base_url()?>employer-preview-data/<?php echo $encoded_id ;?>" title="View">
										 		<!-- <span class="glyphicon glyphicon-eye-open" style="color:#00BFFF"></span> -->
										 		&nbsp;View&nbsp;
										 	</a>
										 	<?php }if($p["permission_description"]=="Approve"){?>
										 	<?php
										 		if($elist['employer_status']==0){
										 	?>
										 	<a href="<?php echo base_url()?>approve-employer-account/<?php echo $encoded_id.'/1'; ?>" onclick="return confirm('Are you sure, you want to Approve it?')" title="Approve">
										 		<!-- <span class="glyphicon glyphicon-thumbs-up" style="color:#3CB371;font-weight: bold;"></span> -->
										 		&nbsp;Approve&nbsp;
										 	</a>
										 	<?php }}if($p["permission_description"]=="Disapprove"){?>
										 	<?php
										 		if($elist['employer_status']!=0){
										 	?>
										 	<a href="<?php echo base_url()?>approve-employer-account/<?php echo $encoded_id.'/0'; ?>" onclick="return confirm('Are you sure, you want to Disapprove it?')" title="Disapprove">
										 		<!-- <span class="glyphicon glyphicon-thumbs-down" style="color:#FF8C00;font-weight: bold;"></span> -->
										 		&nbsp;Disapprove&nbsp;
										 	</a> 
										 	<?php }}} ?>
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
   $('#assignorder').change(function(){

  	$('#filtercheck').submit();

  });

$(".tasklink").click(function(){
	var assignid = $(this).attr("data-id");
	$(".deletetask").attr("id",assignid);
});
$(".deletetask").click(function(){
	$.ajax({
	  method: "POST",
	  data: {'taskid': $(this).attr("id")},
	  url: "<?php echo base_url() ?>delete-task",
	  dataType: "JSON",
	  success: function(result){
		location.reload();
	  }
	});
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