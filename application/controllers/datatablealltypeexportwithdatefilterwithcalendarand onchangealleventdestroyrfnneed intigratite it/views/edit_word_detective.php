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
.mcq_question{
	height: 300px !important;
}
</style>
<script src="<?php echo base_url() ?>admin_assets/editor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>admin_assets/editor/samples/js/sample.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="row main">
		<div class="col-md-12">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<?php
				if($this->session->flashdata('data_message')){
					echo $this->session->flashdata('data_message');
				}
				?>
			<section class="invoice show">
				<!-- title row -->
				<div class="row" style="background-color: #587EA3">
					<div class="col-md-12">
					<h2 class="lel">Update Word Detective</h2> </div>
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
						<section class="content">
							<!-- SELECT2 EXAMPLE -->
							<div class="box box-col">
								<div class="box-header with-border">
									<h3 class="box-title">Update Word Detective</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<form autocomplete="off" method="post" action="<?php echo base_url() ?>update-word-detective">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<textarea name="question" id="editor" placeholder="Question" class="form-control mcq_question"><?php echo $word_detective_data['word_detective_question']; ?></textarea>
												</div>
											<!-- /.form-group -->
											</div>
											<div class="col-md-12" >
												<div class="form-group">													
													<input type="text" maxlength="12" required="required" name="word" placeholder="Answer" class="form-control" value="<?php echo $word_detective_data['word_detective_answer']; ?>"/>
												</div>
											</div>
											<div id="add_div">
												<?php 
                                                  $hints_type= explode(',',$word_detective_data['hint_type']);
                                                  $hints= explode('|',$word_detective_data['word_detective_hint']);
                                                  $count= count($hints);
                                                  for($i=0; $i<$count; $i++)
                                                  {  ?>

                                                
												<div class="col-md-3" >
													<div class="form-group">													
														<select required  name="hint_type[]"  class="form-control" >
															<option value="">Select Hint Type</option>
															<option value="1" <?php if($hints_type[$i]==1){echo 'selected';}  ?>>Message Box</option>
															<option value="2" <?php if($hints_type[$i]==2){echo 'selected';}  ?>>Hint Fill</option>															
														</select>														
													</div>
												</div>

												<div class="col-md-8" >
													<div class="form-group">													
														<input type="text" maxlength="150" required="required" name="hint[]" placeholder="Hint" class="form-control" value="<?php echo $hints[$i]; ?>"/>
														
													</div>
												</div><?php   }
												?>
												<div class="col-md-1" >
													<div class="form-group">													
														<!-- <input type="button" value="+"  id="add" class="btn"> -->
													</div>
												</div>
											</div>
																					
											<div class="col-md-12">
												<div class="form-group">
													<select name="master_topic" class="form-control" required="required">
														<option value="">Select Topics</option>
														<?php
															foreach ($master_topics as $master_topic) {
																if($master_topic['t_id'] == $word_detective_data['topic']){
																	$tsel = ' selected="selected"';
																}else{
																	$tsel = '';
																}
														?>
														<option value="<?php echo $master_topic['t_id']?>" <?php echo $tsel; ?>><?php echo $master_topic['t_name']?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<select name="master_type" class="form-control">
														<option value="">Select Type</option>
														<?php
															foreach ($master_types as $master_type) {
																if($master_type['type_id'] == $word_detective_data['type']){
																	$typesel = ' selected="selected"';
																}else{
																	$typesel = '';
																}
														?>
														<option value="<?php echo $master_type['type_id']?>" <?php echo $typesel; ?>><?php echo $master_type['type_name']?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<select name="master_skills_test" class="form-control">
														<option value="">Select Skills</option>
														<?php
															foreach ($master_skills_tests as $master_skills_test) {
																if($master_skills_test['skills_id'] == $word_detective_data['skill_tested']){
																	$skillsel = ' selected="selected"';
																}else{
																	$skillsel = '';
																}
														?>
														<option value="<?php echo $master_skills_test['skills_id']?>" <?php echo $skillsel; ?>><?php echo $master_skills_test['skills_name']?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<select name="master_case" class="form-control" required="required">
														<option value="">Select Case</option>
														<option value="0">No Case</option>
														<?php
															foreach ($master_case as $master_cases) {
																if($master_cases['case_id'] == $word_detective_data['case_id']){
																	$casesel = ' selected="selected"';
																}else{
																	$casesel = '';
																}
														?>
														<option value="<?php echo $master_cases['case_id']?>" <?php echo $casesel; ?>><?php echo $master_cases['case_name']?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<select name="master_difficulty_level" class="form-control" required="required">
														<option value="">Select difficulty level</option>
														<?php
															foreach ($master_difficulty as $master_difficulty_level) {
																if($master_difficulty_level['diffi_id'] == $word_detective_data['difficulty_level']){
																	$skillsel = ' selected="selected"';
																}else{
																	$skillsel = '';
																}
														?>
														<option value="<?php echo $master_difficulty_level['diffi_id']?>" <?php echo $skillsel; ?> ><?php echo $master_difficulty_level['difficulty_level']?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>										
										<!-- /.col -->
										</div>
										<input type="hidden" name="updateid" value="<?php echo $word_detective_data['word_detective_id']; ?>">
										<input type="submit" value="Update" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;" />
										<!-- /.row -->
									</form>
								</div>
								<!-- /.box-body -->
							</div>
							<!-- /.box -->
						</section>
				
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
initSample();
	$(document).ready(function(){
		
			$("#add").click(function (){
				len=$(".remove").length;
				if(len<4){
					
					$("#add_div").append('<div class="col-md-3" ><div class="form-group"><select required  name="hint_type[]"  class="form-control" ><option value="">Select Hint Type</option><option value="1">Message Box</option><option value="2">Hint Fill</option></select></div></div><div class="col-md-8" ><div class="form-group"><input type="text" maxlength="150" required="required" name="hint[]" placeholder="Hint" class="form-control" /></div></div><div class="col-md-1" ><div class="form-group"><input type="button" value="-"  class="btn remove"></div></div>');
					
				}else{
					alert("Only 5 are allow.");
				}				
				$(".remove").click(function (){
					$(this).parent().parent().prev().prev().remove();
					$(this).parent().parent().prev().remove();
					$(this).parent().parent().remove();
					
					
				})
			});
		
		
	});
</script>