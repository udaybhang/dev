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

	.widgetlink, .editassignlink{
		color: #3c8dbc;
		cursor: pointer;
	}
	.widgetlink:hover,.widgetlink:active,.widgetlink:focus, .editassignlink:hover, .editassignlink:active, .editassignlink:focus {
		outline:none;
		text-decoration:none;
		color:#72afd2
	}
	#namedisplay{
 		height: auto; padding: 10px; color: #ffffff; width: 250px; background: #252322; z-index: 4; right: 15%; position: fixed; top: 200px; margin: auto; display: none;
	}
	.get_c_name{
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
							<h2 class="lel">Widget Master</h2> </div>
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
					              <h3 class="box-title">Widget Master</h3>
					            </div>
					             <?php 
						            	$permission_array=$this->session->userdata('permission_array');
											for($i=0;$i<sizeof($permission_array);$i++){
											    $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
											    if($p["permission_description"]=="Create"){
							     ?>
					            <div class="col-md-6"><a href="<?php echo base_url() ?>country-widget">
						<button type="button " class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E; margin-left: 3px; ">Create Widget</button></a></div>
						<?php }} ?>
              
            </div>
            </div>
							<table class="table table-striped table-responsive" id="01">
								<thead>
					<tr>
                  <th>S.No</th>
				  <th>Widget Name</th>
                  <th>Country 1</th>
                  <th>Country 2</th>
					<th>Created Date</th>
					<th></th>
					</tr>
								</thead>
								<tbody>

				<?php
					$a=1;
					foreach ($widgetlist as $list) {
				?>
				 
				<tr>
				<td><?php echo $a; ?>.</td>
                 <td><?php echo $list->w_name ?></td>
                 <td class="get_c_name" data-id="<?php echo $list->c1_id ?>"><?php echo sizeof(explode(',', $list->c1_id)) ?></td>
                 <?php $c2=$list->c2_id; ?>
                 <td class="get_c_name" data-id="<?php if($c2 != ''){ echo $list->c2_id; } ?>"><?php if($c2 != ''){ echo sizeof(explode(',',$list->c2_id)); } ?></td>
				 <td><?php echo date('d-m-Y',strtotime($list->create_date)) ?></td>
				 <td>
				 	 <?php 
						    $permission_array=$this->session->userdata('permission_array');
							for($i=0;$i<sizeof($permission_array);$i++){
								$p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
								if($p["permission_description"]=="Edit"){
					?>
				 	<a href="<?php echo base_url().'edit-country-widget/'.rtrim(strtr(base64_encode($list->w_id), '+/', '-_'), '='); ?>"><span class="edittasklink">&nbsp;Edit&nbsp;</span></a>
				 	<?php       } if($p["permission_description"]=="Delete"){ ?>
				 	<span data-toggle="modal" data-target="#myModal" class="widgetlink" data-id="<?php echo $list->w_id ?>">&nbsp;Delete&nbsp;</span></td>
				 	<?php }} ?>
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
				<div id="namedisplay"></div>
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
      <button type="button" class="btn btn-default deletewidget" id="">Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
	$(".widgetlink").click(function(){
		var assignid = $(this).attr("data-id");
		$(".deletewidget").attr("id",assignid);
	});
	$(".deletewidget").click(function(){
		$.ajax({
		  method: "POST",
		  data: {'widgetid': $(this).attr("id")},
		  url: "<?php echo base_url() ?>delete-widget",
		  dataType: "JSON",
		  success: function(result){
			location.reload();
		  }
		});
	});

	$(".get_c_name")
	.mouseenter(function(){
		if($(this).attr("data-id")!=''){
			$.ajax({
				method: "POST",
				data: {'countryid': $(this).attr("data-id")},
				url: "<?php echo base_url() ?>get-country-name",
				success: function(result){
					$("#namedisplay").html(result);
					$("#namedisplay").fadeIn("1000");
				}
			});
		}else{
			$("#namedisplay").fadeOut("700");
		}
	})
	.mouseleave(function() {
		$("#namedisplay").fadeOut("700");
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