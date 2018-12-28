
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
		text-align: center;
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
                       
                        
                    
                     
							<table class="table table-striped table-responsive" >
								<thead>
                           <tr>
                              <th class="text-center" colspan="12"><h3><?php echo $score[0]['mm_user_full_name'];?></h3>
                              <h3>id:<?php echo $score[0]['mm_uid']?></h3></th>
                           </tr>
									<tr>
                              <th>Sn no.</th>
										 <th>Name</th>
                  <th>Assignment</th>
                   <th>Level</th>
                  <th>Score</th>
									</tr>
								</thead>
								<tbody>
                        <?php $a=0; foreach ($score as $sc) {
                          $a++;?>
                       
                  <tr>
                   <td><?php echo $a;?></td>
                  <td><?php echo $sc['mm_user_full_name'];?></td>
                  <td><?php echo $sc['assignment_name'];?></td>
                    <td><?php echo $sc['lvl_name'];?></td>
                  <td><?php echo $sc['total_score'];?></td>
                
                </tr>  
                <?php }?> 
                 </tbody>
							</table>
						</div>
						<!-- <button data-toggle="modal" data-target="#myModal" type="button " class="btn btn-primary btn-md " style="float: right;background-color:
													#112B4E; border-color: #112B4E;
													margin-left: 3px; ">Continue</button> -->
					</div>
						
				</section>
			
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
	<!-- /.content -->
	<div class="clearfix"></div>
</div>
