<?php include_once( 'header.php'); include_once(
'side_bar.php'); ?>
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
							<h2 class="lel">Candidate Assignment </h2> </div>
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
              <form action="<?php echo base_url()?>checked-user-list" method="post">
 
  <select name="maid">
      <option value="">Select Assignment Name</option>

   	<?php foreach($list_of_assignment as $result) {

   		$come_maid=$list_condidate_done[0][0]->maid;
   		$back_maid=$result->maid;
   		$sle='';

   		if($come_maid==$back_maid)
   		{
   			$sle='selected="selected"';
   		}

   	?>


    <option value="<?php echo $result->maid ?>" <?php echo $sle;?>><?php echo $result->assignment_name ?></option>
    
    <?php }?>
  </select>
  <input type="submit">
   <?php  $bac= $list_condidate_done[0][0]->assignment_name;if(!empty($bac)) {echo "<span style='float:right;font-weight:600;font-size:16px'>Assignment $bac</span>";}?>
</form>
              

             
            </div>
							
            </div>
            
							<table class="table table-striped table-responsive" id="01">
								<thead>
					<tr>
                  <th>S.No</th>

                  <th>Name</th>
                  <th>Email</th>
				  <th>Assignment Name</th>
					<!--<th>Status</th-->
					<th></th>
					</tr>
								</thead>
								<tbody>
								<?php 
            			
            		 $Y=1; $i=0; foreach($list_condidate_done as $data){ //echo "<pre>"; echo $data[0]->assignment_name; ?>	
            		
					<tr>
					<td><?php echo $Y;?></td>
					<td><?php echo $data[0]->mm_user_full_name ?></td>
	                <td><?php echo $data[0]->mm_user_email?></td>
	                <td><?php echo $data[0]->assignment_name?></td>
	              <?php  $ids=$data[0]->uid.'_'.$data[0]->maid;; 
	              		
						$qurstr=rtrim(strtr(base64_encode($ids), '+/', '-_'), '='); ?>
						<td><a href="<?php echo base_url();?>list-of-candidate-assignment/<?php echo $qurstr ?>">view more</a></td>
					<!--<td><?php if($data->status==0 && $data->start_time!='0000-00-00 00:00:00'){

					 echo "Ongoing"; 

						$ids=$data->uid;
						$qurstr=rtrim(strtr(base64_encode($ids), '+/', '-_'), '=');


						 ?>
						<td><a href="<?php echo base_url();?>list-of-candidate-assignment/<?php echo $qurstr ?>">view more</a></td>
				<?php	} else if($data->status==1 && $data->end_time!='0000-00-00 00:00:00'){

						echo "Complete"; 

						$ids=$data->uid;
						$qurstr=rtrim(strtr(base64_encode($ids), '+/', '-_'), '=');


						 ?>
						<td><a href="<?php echo base_url();?>list-of-candidate-assignment/<?php echo $qurstr ?>">view more</a></td>
				<?php	}

					?></td-->
					
				</tr>
			
				<?php $Y++; $i++;} ?>
            			
            		
            
				
            	
				
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