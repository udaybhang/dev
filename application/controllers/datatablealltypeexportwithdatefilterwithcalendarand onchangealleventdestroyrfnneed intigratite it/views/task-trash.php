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
   .tasklink, .edittasklink{
		color: #3c8dbc;
		cursor: pointer;
	}
	.tasklink:hover,.tasklink:active,.tasklink:focus, .edittasklink:hover, .edittasklink:active, .edittasklink:focus {
		outline:none;
		text-decoration:none;
		color:#72afd2
	}
	#file_upload_css .fa{
    	cursor: pointer;
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
							<h2 class="lel">Master Task</h2> </div>
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
					              <h3 class="box-title">Master Task</h3>
					            </div>
              
              

             
            </div>
            </div>
							<table class="table table-striped table-responsive" id="01">
								<thead>
					<tr>
                  <th>S.No</th>
                  <th style="width: 160px;">Task Name</th>
                  <th>Assignment Name</th>
				  <th>Level Name</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>File Count</th>
					<th></th>
					</tr>
								</thead>
								<tbody>
				<?php
					$a=1;
					foreach ($task_lists as $task_list) {
				?>
				<tr>
					<td><?php echo $a; ?>.</td>
					<td style="width: 160px;"><?php echo $task_list->task_name ?></td>
					<td><?php echo $task_list->assignment_name ?></td>
					<td><?php echo $task_list->lvl_name ?></td>
					<td><?php echo date('d-m-Y',strtotime($task_list->start_date)) ?></td>
					<td><?php echo date('d-m-Y',strtotime($task_list->end_date)) ?></td>
					<td><?php echo sizeof(explode(',',$task_list->sample_files)) ?></td>
					<td><!--<span data-toggle="modal" data-target="#myModal" class="tasklink" data-aid="<?php echo $task_list->ma_id ?>" data-id="<?php echo $task_list->tid ?>">Restore</span>--></td>
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
        <h4 class="modal-title">Are you sure want to restore?</h4>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default deletetask" id="">Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--// Delete// -->

<script>
var maid;
$(".tasklink").click(function(){
	var assignid = $(this).attr("data-id");
	$(".deletetask").attr("id",assignid);
	maid = $(this).attr("data-aid");
});
$(".deletetask").click(function(){
	$.ajax({
	  method: "POST",
	  data: {'maid': maid,'taskid': $(this).attr("id")},
	  url: "<?php echo base_url() ?>restore-task",
	  dataType: "JSON",
	  success: function(result){
	  	alert(result.msg);
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
</script>