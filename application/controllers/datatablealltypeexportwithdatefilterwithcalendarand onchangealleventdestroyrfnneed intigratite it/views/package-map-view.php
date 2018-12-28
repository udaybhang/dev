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
   .danger{
	background-color: #f2dede;
    border-color: #ebccd1;
    color: #a94442;
	text-align: center;
	margin:auto;
	margin-top: 30px;
	padding: 10px;
	width: 80%;
	box-shadow: 0px 0px 10px #ebccd1;
}
.success{
	background-color: #dff0d8;
	border-color: #d6e9c6;
	color: #3c763d;
	text-align: center;
	margin:auto;
	margin-top: 30px;
	padding: 10px;
	width: 80%;
	box-shadow: 0px 0px 10px #d6e9c6;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	
	<div class="row main">
		<div class="col-md-12">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<?php
				if($this->session->flashdata('mcq_message')){
					echo $this->session->flashdata('mcq_message');
				}
				?>
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="background-color: #587EA3">
						<div class="col-md-12">
							<h2 class="lel">Package Mapping List</h2> </div>
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

						
							<form action="<?php echo base_url()?>package-mapping-detail" method="post" id="filtercheck">
				        	<div class="col-md-6">
				        		<select class="form-control" name="package" id="assignorder">
				        			<option value="">Select Package</option>
				        			<?php
				        				foreach ($package as $list) {
				        					$allasid = $list['package_id'];
				        					if($allasid==$asid){
				        						
				        						$sel = 'selected="selected"';
				        					}else{
				        						$sel = '';
				        					}
				    				?>
				    				<option value="<?php echo $list['package_id']; ?>" <?php echo $sel; ?>><?php echo $list['package_name']; 
				    				 echo " (".$list['package_id'].")";
				    				if($list['status']==0){
				    					echo " -Deleted";
				    				}else if($list['status']==1){
				    					echo " -Active";
				    				}else if($list['status']==2	){
				    					echo " -Coming Soon";
				    				}else if($list['status']==3	){
				    					echo " -Not Show";
				    				}?>
				    				
				    				</option>
				    				<?php	} ?>
				        		</select>
				        	</div>
        				</form>
						</div>
						
              			<?php $ass_list=explode(",", $assignment_list['ma_id']);               				
              				for($i=0;$i<sizeof($ass_list);$i++){?>
              				<ul style="list-style:none;"> 
              					<li><strong>
              						<?php $assignment_name= $this->Crud_modal->fetch_single_data('assignment_name',"master_assignment","maid='$ass_list[$i]'");
              								 if($assignment_name['assignment_name']!=''){echo $assignment_name['assignment_name']."  ($ass_list[$i])";}
              								
              						?></strong>
              						<ul>
              							<?php
              								$levelname=$this->Crud_modal->all_data_select("lvl_name,ml_id","master_level","maid='$ass_list[$i]'","created_date Desc");
              								foreach ($levelname as $key => $value) {
												$level_id_for=$value['ml_id'];
												
              							?>
              								<li><?php echo $value['lvl_name']." ($level_id_for)"?>     User Attemped: <?php echo $this->Crud_modal->check_numrow("completed_level","level_id='$level_id_for'"); ?></li>
              							<?php	}?>
              							
              						</ul>
              					</li>
              				</ul>
              			<?php }?>
              			
             
            </div>
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


<script>
  $('#assignorder').change(function(){

  	$('#filtercheck').submit();

  });



 
    </script>