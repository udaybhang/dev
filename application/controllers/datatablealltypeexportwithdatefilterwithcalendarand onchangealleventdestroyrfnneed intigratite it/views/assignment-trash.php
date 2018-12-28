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
              
            </div>
            </div>
							<table class="table table-striped table-responsive" id="01">
								<thead>
					<tr>
                  <th>S.No</th>
				  <th style="width: 33.0114px;">A-Id</th>
				  <th>Assignment Name</th>
                  <th>Level</th>
					<th>Created Date</th>
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
				 <td><?php echo date('d-m-Y H:m:s',strtotime($list->created_date)) ?></td>
				 <td><!--<span data-toggle="modal" data-target="#myModal" class="assignlink" data-id="<?php echo $list->maid ?>">Restore</span>--></td>
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
      <button type="button" class="btn btn-default deletassign" id="">Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
	$(".assignlink").click(function(){
		var assignid = $(this).attr("data-id");
		$(".deletassign").attr("id",assignid);
	});
	
	$(".deletassign").click(function(){
		$.ajax({
		  method: "POST",
		  data: {'assignid': $(this).attr("id")},
		  url: "<?php echo base_url() ?>restore-assignment",
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