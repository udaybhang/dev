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

	/* The Modal (background) */
   .modal {
   display: none; /* Hidden by default */
   position: fixed; /* Stay in place */
   z-index: 1; /* Sit on top */
   padding-top: 100px; /* Location of the box */
   left: 0;
   top: 0;
   width: 100%; /* Full width */
   height: 100%; /* Full height */
   overflow: auto; /* Enable scroll if needed */
   background-color: rgb(0,0,0); /* Fallback color */
   background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
   z-index:999px;
   }
   /* Modal Content */
   .modal-content {
   background-color: #fefefe;
   margin: auto;
   padding: 10px;
   border: 1px solid #888;
   width: 60%;
   z-index:999px;
  }
   /* The Close Button */
   .close {
   color: #aaaaaa;
   float: right;
   font-size: 28px;
   font-weight: bold;
   }
   .close:hover,
   .close:focus {
   color: #000;
   text-decoration: none;
   cursor: pointer;
   }

.tip{
    /*display: inline;*/
    position: relative;
    background: none;
    width:250px;
}

.tip:hover:after{
    background: #333;
    background: rgba(0,0,0,.8);
    border-radius: 5px;
    bottom: 26px;
    color: #fff;
    content: attr(tip-title);
    right: 10%;
    padding: 5px 15px;
    position: absolute;
    z-index: 999;
    width: 250px;
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
							<h2 class="lel">Employer's Job List</h2> </div>
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
					            <div class="col-md-13">

									<!-- <input type="button" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E; margin-left: 0px;" onclick="tableToExcel('testtable2', 'Employer Jobs Record Table');" value="Export to Excel" /> -->
									<form action="<?php echo base_url()?>employer-job-lists" method="post" id="filtercheck">
							        	<div class="col-md-3">
							        		<select class="form-control industry" name="industry_id" id="industry_id">
							        			<option value="">Select Industry</option>
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
							    				<option value="<?php echo $list['industry_id']; ?>" ><?php echo $list['industry_name']; ?></option>
							    				<?php
							        				}
							        			?>
							        		</select>
							        	</div>
							        	<div class="col-md-3">
							        		<select class="form-control functional" name="functional_id" id="functional_id">
							        			<option value="">Select Functional Areas</option>
							        		</select>
							        	</div>
							        	<div class="col-md-3">
							        		<select class="form-control company" name="company" id="company">
							        			<option value="">Select Company</option>
							        			<?php
							        				foreach ($company_list as $list) {
							        					$allasid = $list['employer_id'];
							        					$siv=$selected_company_value;
							        					if($allasid==$siv){
							        						$sel = 'selected="selected"';
							        					}else{
							        						$sel = '';
							        					}
							    				?>
							    				<option value="<?php echo $list['employer_id']; ?>"><?php echo $list['employer_company']; ?></option>
							    				<?php
							        				}
							        			?>
							        		</select>
							        	</div>
							        	<div class="col-sm-0">
							        		<button type="button" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E; margin-left:0px;" id="search">
							        		Search</button>
							        	</div>
							        	<div class="col-sm-0">
							        		<a href="<?php echo base_url()?>employer-job-lists">
											<button type="button" class="btn btn-primary btn-md" style="float: right;background-color:#112B4E; border-color: #112B4E; margin-left:0px; ">Show All</button></a>
							        	</div>
			        				</form>
									
								</div>
								<div class="col-md-13">
									<form action="<?php echo base_url()?>employer-job-lists" method="post" id="formsub">
										
									<div class="col-md-11">
										
										<div class="col-sm-2">
											<div style="padding-top:15px;margin-left:-15px;"><span style="font-weight:bold;">Date Range:</span></div>
										</div>
										<div class="col-md-4">
											<div id="datepicker" class="input-daterange input-group" style="margin-top: 10px; margin-left:0px; z-index:1">
												<input type="text" class="input-sm form-control" name="start"/>
												<span class="input-group-addon">To</span>
												<input type="text" class="input-sm form-control" name="end"/>
											</div>
										</div>
										<div class="col-sm-0">
											<button type="button" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E; margin-top: 10px; margin-left:0px;" id="formsubbtn">
							        		Search</button>
							        	 </div>
							        	
							        </div>
							        </form>
									<div class="col-md-1">
									<?php 
							            $permission_array=$this->session->userdata('permission_array');
							            for($i=0;$i<sizeof($permission_array);$i++){
							            	$p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
							            	if($p["permission_description"]=="Export"){

					    			?>
									<input type="button" class="btn btn-primary btn-md btn-right" style="background-color:#112B4E; border-color: #112B4E; margin-right: -15px; margin-top: 10px;float:right;" onclick="tableToExcel('testtable2', 'Employer Jobs Record Table');" value="Export to Excel" />
									<?php }}?>
									</div>
								</div>
						</div>
					</div>
					
							<div class="table-responsive"> 
							<table class="table table-striped" id="testtable2">
								<thead>
									<tr>
					                  <th>S.No</th>
					                  <th>Industry</th>
									  <th>Company</th><th>Designation</th><th>CTC</th><th>MM Neurons</th><th>Job Title</th><th>Func.Area</th>
									  <th>Post.Date</th><th>PublishDate</th><th>Status</th><th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$a=1;
										foreach ($employer_jobs as $elist) {
									?>
				 					<tr>
										<td><?php echo $a; ?>.</td>
										<td>
                                              <?php 
                                                      $iid=$elist['industry_id']; 
                                                      $inm=$this->Crud_modal->fetch_single_data("industry_name","mm_master_industry_topic","industry_id=$iid");
                                                      echo $inm["industry_name"];
                                              ?>
                                          </td>
									  	<td><?php echo $elist['employer_company']; ?></td>
					                 	<td><?php echo $elist['designation']; ?></td>
					                 	<td><?php if($elist['ctc_from']!=0){echo $elist['ctc_from']."-".$elist['ctc_to']." Lac/Year";}else{echo "N/A"; } ?></td>
					                 	<td><?php echo $elist['required_system_neurons']; ?></td>
					                 	<td>
					                 		<a style="cursor: default; text-decoration: none;" class="show_desc" data-id="<?php echo $elist['job_id']; ?>" title="View Description">
					                 			<?php echo $elist['job_title']; ?>
					                 		</a>
					                 	</td>
					                 	<td><?php echo $elist['functional_name']; ?></td>
					                 	<td><?php if($elist['created_date']!="0000-00-00 00:00:00"){echo date("d/m/Y g:i A", strtotime($elist['created_date']));}else{echo "Not Available";} ?></td>
		                             	<td><?php if($elist['publish_date']!="0000-00-00 00:00:00"){echo date("d/m/Y g:i A", strtotime($elist['publish_date']));}else{echo "Not Available";} ?></td>
					                 	<td><?php 
					                 			$st = $elist['status']; 
					                 			if($st==0){
					                 				echo 'Pending';
					                 			}elseif($st==1){
					                 				echo 'Published';
					                 			}elseif($st==2){
					                 				echo 'Rejected';
					                 			}elseif($st==3){
					                 				echo 'Unpublished';
					                 			}
					                 		?>
					                 	  <a class="tip" tip-title="<?php if($elist['remarks']!=''){echo $elist['remarks'];}else{echo 'N/A';} ?>" style="cursor:default;text-decoration: none; color:skyblue">
			                                 <small><i class="fa fa-info-circle" aria-hidden="true"></i></small>
			                              </a>
					                 	</td>
					                 	<td>
										 	<?php $jid=$elist['job_id']; $encoded_id=rtrim(strtr(base64_encode($jid), '+/', '-_'), '='); ?>
										 	<input type="hidden" id="encoded_id" value="<?php echo $encoded_id; ?>" >
										 	<?php
										 		if($elist['status']==0 || $elist['status']==2 || $elist['status']==3){
										 			for($i=0;$i<sizeof($permission_array);$i++){
							            				$p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
							            				if($p["permission_description"]=="Approve"){

					    					?>
										 	<a href="<?php echo base_url()?>change-job-status/<?php echo $encoded_id.'/1'; ?>" onclick="return confirm('Are you sure, you want to Approve it?')" title="Approve">
										 		&nbsp;Approve&nbsp;
										 	</a>
										 	<?php }} if($elist['status']==0){
										 			for($i=0;$i<sizeof($permission_array);$i++){
							            				$p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
							            				if($p["permission_description"]=="Reject"){

					    					?>
										 		<a title="Disapprove" class="show_reason_popup" data-val="2" style="cursor: default; text-decoration: none;">&nbsp;Reject&nbsp;</a> 
										 	<?php }} 
										 		 } } 
										 		if($elist['status']==1){
										 			for($i=0;$i<sizeof($permission_array);$i++){
							            				$p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
							            				if($p["permission_description"]=="Reject"){

					    					?>
										 	<a title="Disapprove" class="show_reason_popup" data-val="2" style="cursor: default; text-decoration: none;">
										 		&nbsp;Reject&nbsp;
										 	</a> 
										 	<?php }if($p["permission_description"]=="Unpublish"){

					    					 ?>
										 	<a title="Unpublish Job" class="show_reason_popup" data-val="3" style="cursor: default; text-decoration: none;">
										 		&nbsp;Unpublish&nbsp;
										 	</a> 
										 	<?php }}
										 	 } ?>
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
	<!-- Modal -->
	<div id="myModal" class="modal" style="display: none;">
	   <div class="modal-content">
	      <div class="modal-header">
	         <button type="button" class="close" data-dismiss="modal">&times;</button>
	         <h4 class="modal-title">Job Title</h4>
	      </div>
	      <div class="modal-body" id="infotable" style="padding-top:0px !important ">
	      </div>
	      <div class="modal-footer">
	      </div>
	   </div>
	 </div>

<!-- /.content -->
	<div class="clearfix"></div>
	
<!-- Modal -->
<div id="myModal_reason" class="modal" style="display: none;">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close_reason" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter Reason</h4>
      </div>
      <div class="modal-body">
        <!-- 	<textarea class="form-control" style="margin: 0px -2px 0px 0px; min-height: 116px; max-width: 311px;min-width: 311px;" id="reason"></textarea> -->
        <select class="form-control" style="margin: 0px -2px 0px 0px; min-height: 30px; max-width: 311px;min-width: 311px;" id="reason" size="1"  tabindex="1">
        	<option value="Reason1">Reason1</option>
        	<option value="Reason2">Reason2</option>
        	<option value="Reason3">Reason3</option>
        </select>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" id="submit_reason">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="close_reason">Close</button>
      </div>
    </div>

  </div>
</div>

</div>


<script type="text/javascript">
// code of user neurons details 
$("#formsubbtn").click(function(){
	$("#formsub").submit();
});
// date function 
$(function() {
    $("input[name=start],input[name=end]").datepicker();
});

$(document).on('click', '.show_desc', function() {

	$.ajax({
           type:"Post",
           url:'<?php echo base_url()?>more-info-job',
           data:{"job_id":$(this).attr("data-id")},
           dataType:"Json",
           success:function(data){
               $(".modal-title").text(data.job_title);
               var desc='';
               desc=data.job_description;
               var ele='';
               ele+='<table>';
               ele+='<tr><td><b>Functional Area:</b></td><td>'+data.functional_name+'<td><b>No Of Position:</b></td><td>'+data.no_of_position+'</td></tr>';
               ele+='<tr><td><b>CTC:</b></td><td>'+data.ctc+'<td><b>Experience:</b></td><td>'+data.experience+'</td></tr>';
               ele+='<tr><td><b>Location:</b></td><td>'+data.city+'<td><b>Neurons Eligibility:</b></td><td>'+data.required_system_neurons+'</td></tr>';
               ele+='<tr><td><b>Status:</b></td><td>'+data.status+'<td><b>Created Date & Time:</b></td><td>'+data.created_date+'</td></tr>';
               ele+='<tr><td><b>Modified Date & Time:</b></td><td>'+data.modified_date+'<td><b>Publish Date & Time:</b></td><td>'+data.publish_date+'</td></tr>';
               ele+='<tr><td colspan=4 ><b>Job Description:</b></td></tr>';
               ele+='<tr><td colspan=4 >'+desc+'</td></tr>';
               ele+='</table>';
               if(data.check_skill_ids!=''){
			   		ele+= '<table class="table table-striped" style="margin-left:15px;width:90%"><tr><th>Sr No.</th><th>Package Name</th>';
			   			  for(var skils_head=0;skils_head<data.snames.length;skils_head++){
		                	ele+='<th>'+data.snames[skils_head]+'</th>';
		                    ele+='<th class="hide tab_skills_id">'+data.sids[skils_head]+'</th>';
		                    ele+='<th class="hide tab_skills_per">'+data.sper[skils_head]+'</th>';
		                  }
			   	    ele+='<th>Total Neurons</th><th>Min Neurons</th>';
	                ele+= '</tr>';
	                for(var table_data=0;table_data<data.pack_data.length;table_data++){
	                    ele+='<tr><td>'+(table_data+1)+'</td><td class="hide tab_pack_id">'+data.pack_data[table_data].package_id+'</td><td>'+data.pack_data[table_data].package_name+'</td>';
	                    	for(var skills_data=0;skills_data<data.pack_data[table_data].skills_ids.length;skills_data++){
		                       if(data.pack_data[table_data].skills_ids[skills_data]!="null"){
		                        ele+='<td>'+data.pack_data[table_data].skills_ids[skills_data]+'</td>';
		                       }
		                        else{
		                             ele+='<td>-</td>';
		                        }            
		                    }
	                    
	                    ele+='<td>'+data.pack_data[table_data].total_marks+'</td><td class="tab_pack_min_neurons">'+data.pack_data[table_data].min_neurons+'</td>';
	                    ele+='</tr>';
	                }
	                ele+='</table>';
			   }else if(data.check_pack_id!=''){
			   		ele+= '<table class="table table-striped" style="margin-left:15px;width:90%"><tr><th>Sr No.</th><th>Package Name</th>';
			   		ele+='<th>Total Neurons</th><th>Min Neurons</th>';
	                ele+= '</tr>';
	                for(var table_data=0;table_data<data.pack_data.length;table_data++){
	                	ele+='<tr>';
	                	ele+='<td>'+(table_data+1)+'</td><td class="tab_pack_min_neurons">'+data.pack_data[table_data].package_name+'</td>';
	                	ele+='<td>'+data.pack_data[table_data].total_marks+'</td><td class="tab_pack_min_neurons">'+data.pack_data[table_data].min_neurons+'</td>';
	                	ele+='</tr>';
	                }
	                ele+='</table>';
	            }
	            $("#myModal").css("display","block");
                $('#infotable').html(ele);  
           },
           error:function(){
               alert("Somethings went wrong.");
           }
       })
   });
   $(".close").click(function (){
       $("#myModal").css("display","none");
   });
   var status_val=0;
   $(document).on('click', '.show_reason_popup', function() {
   	   $("#myModal_reason").css("display","block");
   	   status_val=$(this).attr("data-val");
   });
   $("#close_reason").click(function (){
       $("#myModal_reason").css("display","none");
   });
   $(".close_reason").click(function (){
       $("#myModal_reason").css("display","none");
   });
   $(document).on('click', '#submit_reason', function() {
   	var res=$('#reason').val(); 
   	encoded_id=$('#encoded_id').val(); 
   	if(res!=""){
   		$.ajax({
           type:"Post",
           url:'<?php echo base_url()?>change-job-status/'+encoded_id+'/'+status_val+'',
           data:{"reason":res},
          // dataType:"Json",
           success:function(data){
           	  $("#myModal_reason").css("display","none");
           	  if(status_val=='2')
              alert('Successfully Disapproved/Rejected'); 
              if(status_val=='3') 
              alert('Successfully Closed/Unpublished'); 
          	 location.reload();
           },
           error:function(){
               alert("Somethings went wrong.");
           }
       });
   	}else{
   		alert('Please Enter a Reason.');
   	}
   });
</script>
<script>
  $(".industry").change(function(){
			var paren = $(this).parent().parent().next();
			$.post("<?php echo base_url()?>get-industry-functional",{topicid:$(this).val()},function(data,status){
				if(status=="success"){
					$('.functional').html(data);
				}else{
					alert("Something went wrong.");
				}
			});
 });
  $("#search").click(function(){
  	$('#filtercheck').submit();
  });
  $(function () {
   
    $('#testtable2').DataTable({
      "paging": true,
      "lengthMenu": [[10, 20, 40, 60,80,100, -1], [10, 20, 40, 60,80,100, "All"]],
      "pageLength": 20,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
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

<script src="http://webapplayers.com/inspinia_admin/js/jquery-1.10.2.js"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript">
	$('input[name="daterange"]').daterangepicker(
{
    locale: {
      format: 'YYYY-MM-DD'
    },
    startDate: '2013-01-01',
    endDate: '2013-12-31'
}, 
function(start, end, label) {
    alert("A new date range was chosen: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
});
</script>