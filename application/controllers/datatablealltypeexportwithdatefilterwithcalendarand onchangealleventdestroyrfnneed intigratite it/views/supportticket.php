<!-- DataTables -->
<style>
	.image-preview-input {
		position: relative;
		overflow: hidden;
		margin: 0px;
		color: #333;
		background-color: #fff;
		border-color: #ccc;
	}
	.image-preview-input input[type=file] {
		position: absolute;
		top: 0;
		right: 0;
		margin: 0;
		padding: 0;
		font-size: 20px;
		cursor: pointer;
		opacity: 0;
		filter: alpha(opacity=0);
	}
	.image-preview-input-title {
		margin-left: 2px;
	}
	.button {
		border: none;
		outline: 0;
		padding: 10px 25px;
		vertical-align: middle;
		overflow: hidden;
		text-decoration: none;
		color: #fff;
		background-color: #112B4E;
		text-align: center;
		cursor: pointer;
		font-size: 16px; 
		outline: none;
	}
	.assignMnt .assignMntH {
		font-size: 30px;
		color: #00376F;
		font-weight: 600;
		padding: 0 0 40px 0;
		font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
	}

	.assignMntIn .assignMntH2 {
		float: left;
		width: 100%;
		border-bottom: 1px solid #ddd;
		padding: 0 0 15px 0;
		color: #112b4e;
		font-weight: 400;
		font-size: 18px;
		font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
	}
	a.list-group-item:focus,
	a.list-group-item:hover {
		background: #112B4E;
		color: #fff;
	}
	.panel-heading+.list-group .list-group-item:first-child {
		color: #6a7483;
	}
	.panel-default>.panel-heading {
		color: #fff;
		background-color: #112b4e;
		border-color: #ddd;
	}
	.list-group-item {
		position: relative;
		display: block;
		padding: 2px 19px;
		margin-bottom: -1px;
		background-color: #fff;
		border: 1px solid #ddd;
	}
		.ticket-panel-heading {
    background: #112b4e; !important;
}
.ticket-panel-title {
    padding: 11px;
    margin-top: 0;
    margin-bottom: 0;
    font-size: 16px;
    color: #fff;
}

#example123 tr {
 /* display: none;*/
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:#fff;">
	<!-- Content Header (Page header) -->
	<section class="content-header" style="padding: 14px 15px 0 24px;">
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a>				</li>
			<li class="active">Dashboard</li>
			<li class="active">Support Ticket</li>
		</ol> 
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- /.box-header -->
		<!-- /1 .row started -->
    <?php 
                        $permission_array=$this->session->userdata('permission_array');
                        //print_r($permission_array);
                            for($i=0;$i<sizeof($permission_array);$i++){
                              $p =$this->Crud_modal->fetch_single_data('permission_description','master_permission',"permission_id='$permission_array[$i]'");
                              
                              $permission[] = $p["permission_description"];
                              
                            }
                            // print_r($permission);               

                        ?>
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<div class="assignMnt lev1">
						<div class="assignMntH"><i class="fa fa-ticket" aria-hidden="true"
							style="margin-right:1%"></i>View All Ticket</div>

					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-12">
						<div class="assignMntIn" >
						<div class="assignMntH2" style="padding: 0 0 9px 0; border-bottom: 1px solid #000; float: left">Recent Ticket </div>
						<div class="col-md-3" style="margin-top: 1%;">
							 <input type="text" name="fdate" id="fdate"  class="form-control datecalender" placeholder="From Date" />
						</div>
						<div class="col-md-3" style="margin-top: 1%;">
							<input type="text" name="tdate" id="tdate" class="form-control datecalender"  placeholder="To Date" />
						</div>
						<div class="col-md-3" style="margin-top: 1%;">
							<input type="button" name="search" id="search" value="SEARCH" class="btn btn-md"/>
						</div>
            <div class="col-md-2" style="margin-top: 1%;">
            <select class="tkt_st form-control">
                <option value="">All</option>
                <option value="1" selected="selected">Open</option>
                <option value="0">Close</option>
              </select>
            </div>
            <div class="col-md-1" style="margin-top: 1%;">
              <input type="button" name="search" id="search" value="SEARCH" class="btn btn-md ravi"/>
            </div>
						</div>
						
						<div class="box-body" >
							<table class="table table-bordered table-striped"  id="example123" style="margin-top: 10%;width:100%">
							</table>
						</div>

						<!-- /.box-body -->
					</div>
					<!-- /.box -->
					<div class="col-md-3 col-sm-3 col-lg-3"
					style="margin-top: 30px;">
						<div class="row">
							<div class="col-md-12 pull-md-right sidebar" style="margin-left: 27px;">
                <?php if(in_array("View", $permission)){ ?>
								<!-- <div menuitemname="Support" class="panel panel-default">
									<div class="ticket-panel-heading">
										<h3 class="ticket-panel-title">
                <i class="fa fa-filter"></i>&nbsp; View
                            </h3> </div>
									<div class="list-group">
										
											<a href="#" class="list-group-item">
											<div class="radio">
												<label>
													<input type="radio" name="optradio" data-id="" class="ravi">All</label><span class="badge pull-right"></span>												</div>
										</a>
										<a href="#" class="list-group-item">
											<div class="radio">
												<label>
													<input type="radio" name="optradio" data-id="1" class="ravi">Open</label> <span class="badge pull-right open"></span>												</div>
										</a>
										<a href="#" class="list-group-item">
											<div class="radio">
												<label>
													<input type="radio" name="optradio" data-id="0" class="ravi">Closed</label><span class="badge pull-right"></span>												</div>
										</a>
									</div>
								</div> -->
                <?php } ?>

							</div>
						</div> 
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<!-- /.box-header -->
  
<script src="<?php echo base_url()?>admin_assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url()?>admin_assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>admin_assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>admin_assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
// Total number of rows visible at a time
var myTable="";
    function BindItemTable() {
        // myTable = $("#example123").DataTable({
        //     "deferRender": true,
        //     "paging": true,
        //     "lengthChange": false,
        //     "searching": false,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     "sDom": 'lfrtip',
        //     "processing": true,
        //     "serverSide": true,
        //     "ajax": "<?php echo base_url()?>ticketview",
        //      "deferLoading": 57
        // });
  }
 	$(window).load(function() { 
      BindItemTable();
      $.ajax({
        type:"POST",
        url:"<?php echo base_url()?>ticketview",
        dataType:"json",
        async:true,
        success:function(message)
        {
          var k;
          var data_json=message;
          var  product='<thead><tr><th>Name</th><th>Ticket sequence no.</th><th>Email</th><th>Contact</th><th>Subject</th><th>Status</th><th>Last Updated</th><?php if(in_array("Download", $permission)){ ?><th>Download</th><?php } ?><th>Reply</th><?php if(in_array("Delete", $permission)){ ?><th>Delete</th><?php } ?></tr></thead><tbody>';
          var result="";
          var color="";
          var disable="";
          var statustext="";
          for(var i=0; i<data_json.length; i++)
          { 
          	var status=data_json[i].status;
          	if(status==1){
          		 result='Open'; 
          		 color='red;font-weight:bold';
          		 disable='display:block';
          		 statustext='Reply';
          	}	
          	else{
          		result='Closed';
          		color='green;font-weight:bold';
          		disable='display:none';
          		disable='display:block';
          		statustext='View';
          	}
            var temp=data_json[i].ticket_sequence_no;
          product+='<tr><td>'+data_json[i].name+'</td><td>'+data_json[i].ticket_sequence_no+'</td><td>'+data_json[i].email_id+'</td><td>'+'0</td><td>'+data_json[i].subject+'</td><td class="open"  style=color:'+color+'>'+result+'</td><td>'+data_json[i].created_date+'</td>';
          if(data_json[i].attachment!=''){
          	product+='<?php if(in_array("Download", $permission)){ ?><td><a href="<?php echo base_url()?>upload/'+data_json[i].attachment+'" download id="download" data-id="'+data_json[i].attachment+'">Download File</a></td><?php } ?>';
          }else{
          	product+='<?php if(in_array("Download", $permission)){ ?><td>No File</td><?php } ?>';
          }
          if(statustext=='View'){
             product+='</td><td><?php if(in_array("View", $permission)){ ?><a href="<?php echo base_url()?>reply/'+data_json[i].ticket_id+'">'+statustext+'</a><?php } ?></td><td><?php if(in_array("Delete", $permission)){ ?><a  href="#" class="delete" data-index="'+data_json[i].ticket_id+'">Delete</a><?php } ?></td></tr>';
          }
          if(statustext=='Reply'){
             product+='</td><td><?php if(in_array("Reply", $permission)){ ?><a href="<?php echo base_url()?>reply/'+data_json[i].ticket_id+'">'+statustext+'</a><?php } ?></td><td><?php if(in_array("Delete", $permission)){ ?><a  href="#" class="delete" data-index="'+data_json[i].ticket_id+'">Delete</a><?php } ?></td></tr>';
          }
          
          }
          product+='</tbody>';
          $("#example123").html(product); 
         
        }
      });
  });
		

 </script>
 <script>
	$(".ravi").click(function(){
		//alert('fgh');
      $.ajax({
        type:"POST", 
        data:{"score_id":$('.tkt_st').val()}, 
        url:"<?php echo base_url()?>view-ticket",
        dataType:"json",
        async:true,
        success:function(message)
        {
        	// alert(message);
          var k;
          var data_json=message;
            var  product='<thead><tr><th>Name</th><th>Ticket sequence no.</th><th>Email</th><th>Contact</th><th>Subject</th><th>Status</th><th>Last Updated</th><?php if(in_array("Download", $permission)){ ?><th>Download</th><?php } ?><th>Reply</th><th>Delete</th></tr></thead><tbody>';
          for(var i=0; i<data_json.length; i++)
          { 
          	var status=data_json[i].status;
          var statustext="";
          	if(status==1){
          		 result='Open';
          		 color='red;font-weight:bold';
          		  disable='display:block';
          		 statustext='Reply';
          	}
          	else{
          		result='Closed';
          		color='green;font-weight:bold';
          		disable='display:none';
          		 statustext='View';
          	}
          product+='<tr><td>'+data_json[i].name+'</td><td>'+data_json[i].ticket_sequence_no+'</td><td>'+data_json[i].email_id+'</td><td>'+'0</td><td>'+data_json[i].subject+'</td><td class="open" style=color:'+color+'>'+result+'</td><td>'+data_json[i].created_date+'</td>';
          if(data_json[i].attachment!=''){
          	product+='<?php if(in_array("Download", $permission)){ ?><td><a href="<?php echo base_url()?>upload/'+data_json[i].attachment+'" download id="download" data-id="'+data_json[i].attachment+'">Download File</a></td><?php } ?>';
          }else{
          	product+='<?php if(in_array("Download", $permission)){ ?><td>No File</td><?php } ?>';
          }
          	product+='</td><td><a href="<?php echo base_url()?>reply/'+data_json[i].ticket_id+'">'+statustext+'</a></td><td><a  href="#" class="delete" data-index="'+data_json[i].ticket_id+'">Delete</a></td></tr>';
          }
          product+='</tbody>';
           $("#example123").html(product);
        
        }
      });
  });

</script>
<script>
  $( function() {

      $("#fdate").datepicker();  
      $("#tdate").datepicker();  

  });
  </script>
  <script>
     $('#search').click(function(){  
    
     	  var fdate = $('#fdate').val(); 
     	  var tdate= $('#tdate').val();
     	    $.ajax({ 
     	    type:"POST", 
              url:"<?php echo base_url()?>date-search", 
              data:{"fdate":fdate,"tdate":tdate},
              dataType:"json",
              async:true,  
              success:function(message) 

              {
               var k;
          var data_json=message;
            var  product='<thead><tr><th>Name</th><th>Ticket sequence no.</th><th>Email</th><th>Subject</th><th>Status</th><th>Last Updated</th><?php if(in_array("Download", $permission)){ ?><th>Download</th><?php } ?><th>Reply</th><th>Delete</th></tr></thead><tbody>';
          for(var i=0; i<data_json.length; i++)
          { 
          	var status=data_json[i].status;
          var statustext="";
          	if(status==1){
          		 result='Open';
          		 color='red;font-weight:bold';
          		  disable='display:block';
          		 statustext='Reply';
          	}
          	else{
          		result='Closed';
          		color='green;font-weight:bold';
          		disable='display:none';
          		 statustext='View';
          	}
          product+='<tr><td>'+data_json[i].name+'</td><td>'+data_json[i].ticket_sequence_no+'</td><td>'+data_json[i].email_id+'</td><td>'+data_json[i].subject+'</td><td style=color:'+color+'>'+result+'</td><td>'+data_json[i].created_date+'</td><td>';
          if(data_json[i].attachment!=''){
          	product+='<?php if(in_array("Download", $permission)){ ?><a href="<?php echo base_url()?>upload/'+data_json[i].attachment+'" download id="download" data-id="'+data_json[i].attachment+'">Download File</a><?php } ?>';
          }else{
          	product+='<?php if(in_array("Download", $permission)){ ?>No File<?php } ?>';
          }
          	product+='</td><td><a href="<?php echo base_url()?>reply/'+data_json[i].ticket_id+'">'+statustext+'</a></td><td><a  href="#" class="delete" data-index="'+data_json[i].ticket_id+'">Delete</a></td></tr>';
          }
          product+='</tbody>';
           $("#example123").html(product);

              }
      
   }); 
      
   }); 
   
$(document).ready(function() {
 $(".datecalender").click(function (){
  // alert("hai");
     $(this).datepicker("show").on('change', function () {
       $('.datepicker').hide();
   });
 });
});
$(document).ready(function(){
          $(document).on('click',".delete",function(){
              var res = confirm("Are you sure you want delete it");
              if(res==true){
                 var a = $(this).attr("data-index"); 
                  $.ajax({
                      type: 'GET',
                      url: "<?php echo base_url().'ticket-delete/'?>"+a,
                      success:function(data){
                         window.location.href="<?php echo base_url() ?>ticket-view";
                      }
                  });
              }else{
                return false;
              }
          });
      });

  </script>