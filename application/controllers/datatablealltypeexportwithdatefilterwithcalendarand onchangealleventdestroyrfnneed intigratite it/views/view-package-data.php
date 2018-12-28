<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
	@media print{    
      .print_pdf{
        display: none !important;
      }
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="row main">
		<div class="col-md-12">
			<div class="col-md-10 col-md-offset-1">
				<div class="col-md-12">
	              <?php
	              if($this->session->flashdata('topic_insert_message')){
	              	echo $this->session->flashdata('topic_insert_message');
	              }
	              ?>
				</div>
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="text-align: center">
						<h3 class="lel">View Package Data</h3>
					</div>
					<div class="clearfix" style="margin-top: 20px;"></div>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-12">
								<input type="button" class="btn btn-primary btn-md print_pdf" style="float: right;background-color:#112B4E;border-color:#112B4E;" value="Print PDF" />
							</div>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="clearfix"></div>
					<div class="row print_content">
						<div class="col-md-12">
							<section class="content">
						      <!-- /.box -->
						      <div class="ibox-content1">
					          	<div class="col-md-12" style="padding-top: 10px;">
					          		<div class="col-md-4">
                    					<h5><b>Package Name : </b><?php echo $package_name; ?></h5>
                    					<h5><b>Package Type : </b><?php echo $package_type; ?></h5>
                    				</div>
                    				<div class="col-md-4">
                    					<h5><b>Total Marks : </b><?php echo $total_marks; ?></h5>
                    					<h5><b>Total Time : </b><?php echo $total_time.' Min.'; ?></h5>
                    				</div>
                    				<!--djfbgdkuighodfi;igjodfigjodfigjofidguod;fgiodfgjodfigjufdoigjiofd-->
									<style>ul li{list-style: none}</style>
               						<?php  for($i=0;$i<sizeof($assignment_list);$i++){ ?>
                    				<div class="row">
                    					<div class="col-lg-12">
                    						<div class="ibox product-detail">
                    							<div class="ibox-content" style="padding:0px!important">
                    								<div class="row">
                    									<div class="col-md-4">
                    									<div class="ibox float-e-margins">
                    										<div class="mailbox-content">
                    											<div class="file-manager">
                    												<a class="btn btn-block btn-primary compose-mail" href="javascript:void(0)" style="cursor:default"><?php echo $assignment_list[$i]["assignment_name"]; ?></a>
                    												<h5 class="tag-title" style="font-weight:bold">Skills</h5>
                    												<ul class="tag-list" style="padding: 0">
                    													<?php for($skills=0; $skills<sizeof($assignment_list[$i]["unique_skills"]);$skills++){ ?>
                        												<li><a href="javascript:void(0)" style="cursor:default"><i class="fa fa-tag">
                        													</i>&nbsp;<?php echo $assignment_list[$i]["unique_skills"][$skills]; ?></a>
                        												</li>
                    													<?php } ?>
                    												</ul>
                    												<div class="clearfix"></div>
                    												<h5 class="tag-title"  style="font-weight:bold">Key Compentency Assessed</h5>
                    												<ul class="category-list" style="padding: 0">
                    													<?php for($key=0; $key<sizeof($assignment_list[$i]["unique_key_com"]);$key++){ ?>
                        												<li><a href="javascript:void(0)" style="cursor:default"> 
                        													<i class="fa fa-circle" style="font-size:11px;color:#3c8dbc;"></i>&nbsp;
                        													<?php echo $assignment_list[$i]["unique_key_com"][$key]; ?></a>
                        												</li>
                    													<?php } ?>
                    												</ul>
                    												<div class="clearfix"></div>
                    											</div>
                    										</div>
                    									</div>
                    									</div>
                    									<div class="col-md-8" style="padding-top:20px">
                    										<?php echo $assignment_list[$i]["assignment_description"]; ?>
                    									<div style="margin-top:2px" >
                    										<table id="example1" class="table table-striped table-responsive table-bordered" cellspacing="0" width="100%">
                    											<thead>
                    												<tr>
                    													<th>S.No.</th><th>Level</th><th>Description</th><th>Skill</th><th>Duration</th>
                    												</tr>
                    											</thead>
                    											<tbody>
                    												  <?php  for($y=0;$y<sizeof($assignment_list[$i]["level_list"]);$y++){ ?>
													                        <tr>
													                       		<td><?php echo $y+1; ?></td>
													                       		<td><?php echo $assignment_list[$i]["level_list"][$y]["level_name"]; ?></td>
													                       		<td><?php echo $assignment_list[$i]["level_list"][$y]["description"]; ?></td>
													                       		<td><?php echo $assignment_list[$i]["level_list"][$y]["skills_name"]; ?></td>
													                       		<td><?php echo $assignment_list[$i]["level_list"][$y]["time_limit"]; ?></td>
													                       	</tr>
													                  <?php  } ?>
                    											</tbody>
                    										</table>
                    									</div>
                    								</div>
                    							</div>
                    						</div>
                    					</div>
                    				</div>
                    			</div>
                    			<div class="clearfix"></div>
                				<?php }  ?>    
               					<!--dfjhglidfhgodfigjoidfsjgo;dfijgo;idfgjodfijgodifjgoidfgujoidfugoidf-->
								</div>
								</div>
    						</section>
    						<!-- /.content -->
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
<script type="text/javascript">
	$(".print_pdf").click(function(){
		print($(".print_pdf"));
	});
</script>