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
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	
	<div class="row main">
		<div class="col-md-12">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="background-color: #587EA3">
						<div class="col-md-12">
							<h2 class="lel">Candidate Report</h2> </div>
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
              <h3 class="box-title"><?php echo $list_of_candidate_assignment[0]->mm_user_full_name.'('.$list_of_candidate_assignment[0]->mm_uid.')';?></h3>
              

             
            </div>
                        
                    	</div>
                     
							<table class="table  table-responsive table-striped " id="01">
								<thead>
                          
									<tr>
                              
										<th>S.No</th>
										
                           				<th>Assignment Name</th>
                           				
										<th>Status</th>	
										<th></th>
									</tr>
								</thead>
								<tbody>
								<?php $i=1; foreach($list_of_candidate_assignment as $data) { ?>
									<tr>
										<td><?php echo $i;?></td>
										
										<td ><?php echo $data->assignment_name?></td>
										
	                             			<td>
					<?php 
						if($data->status==0 && $data->start_time!='0000-00-00 00:00:00'){
							echo "Ongoing";
							$ids=$data->maid.'_'.$data->uid.'_'.$pkgid;
						$qurstr=rtrim(strtr(base64_encode($ids), '+/', '-_'), '=');
					?>
						</td><td><a href="<?php echo base_url();?>level-score/<?php echo $qurstr  ?>">view more</a></td>
					<?php	} else if($data->status==1 && $data->end_time!='0000-00-00 00:00:00'){
						echo "Complete";
						$ids=$data->maid.'_'.$data->uid.'_'.$pkgid;
						$qurstr=rtrim(strtr(base64_encode($ids), '+/', '-_'), '=');

					?>
						</td><td><a href="<?php echo base_url();?>level-score/<?php echo $qurstr  ?>">view more</a></td>
					<?php }?>
					</tr>
	                <?php $i++; }?>		
									
								</tbody>
							</table>
						</div>
					
					</div>
						
				</section>
			
			</div>
			<div class="col-md-2"></div>
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