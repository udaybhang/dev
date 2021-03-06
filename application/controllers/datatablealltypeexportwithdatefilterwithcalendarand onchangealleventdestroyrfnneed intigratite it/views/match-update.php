
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
					<h2 class="lel">Update Match the following</h2> </div>
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
									<h3 class="box-title">Update Match the following</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<form autocomplete="off" method="post" action="<?php echo base_url() ?>update-match">
										<div class="row">
											<div class="col-md-12">
													<div class="form-group">
														<textarea id="editor" name="question" val placeholder="Question" required="required" class="form-control mcq_question"><?php echo $matchdata['question_heading']; ?></textarea>
													</div>
													<div class="form-group" style="margin-left:14px;margin-right:14px;">
														<input type="text" name="question_topic" class="form-control mcq_question" value="<?php echo $matchdata['question_topic']; ?>" placeholder="Question Topic">
													</div>
													<div class="form-group" style="margin-left:14px;margin-right:14px;">
														<input type="text" name="answer_topic" class="form-control mcq_question" value="<?php echo $matchdata['answer_topic']; ?>" placeholder="Answer Topic">
													</div>
														<div class="col-md-12">
												<div class="form-group">
													<select name="master_topic" class="form-control">
														<option value="">Select Topics</option>
														<?php
															foreach ($master_topics as $master_topic) {
																if($master_topic['t_id'] == $matchdata['topic']){
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
																if($master_type['type_id'] == $matchdata['type']){
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
																if($master_skills_test['skills_id'] == $matchdata['skill_tested']){
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
													<select name="master_difficulty_level" class="form-control" required="required">
														<option value="">Select difficulty level</option>
														<?php
															foreach ($master_difficulty as $master_difficulty_level) {
																if($master_difficulty_level['diffi_id'] == $matchdata['difficulty_level']){
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
												<div class="col-md-12">
												<div class="form-group">
													<select name="master_case" class="form-control" required="required">
														<option value="0" selected="selected">No Case</option>
														<?php
															foreach ($master_case as $master_cases) {
																if($master_cases['case_id'] == $matchdata['case_id']){
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

												</div>
												<div class="main-div">
												<?php $options = explode('comma', $matchdata['match_question']); 
 														$options1 = explode('comma', $matchdata['match_answer']); 
 														$i=1; 
													for ($k=0;$k<sizeof($options);$k++) {
												 ?>

													
														<div class="col-md-5">
															<div class="form-group" style="margin-left: 15px;">
																<input placeholder="Question" required="required" value="<?php echo $options[$k]; ?>" name="options<?php echo $i ?>" class="form-control mcq_question" />
																
															</div>
														</div>
														<div class="col-md-5">
															<div class="form-group" style="margin-left: -14px;padding-right: 16px;">
																<input placeholder="Question" required="required" value="<?php echo $options1[$k]; ?>" name="answer<?php echo $i ?>" class="form-control mcq_question" />
															</div>
														</div>
														<?php if(sizeof($options)==$i){?>
														<div class="col-md-1 col-md-offset-1"><input type="button" value="+" id="btn1" class="btn btn-primary" required style="background: #112B4E; margin-bottom: 10px;margin-left: 20px;" /> </div>
                                                      <?php } ?>
													<script type="text/javascript">
													var y='<?php echo $i; ?>';
														
													</script>
														<?php ++$i; } ?>
												
												</div>
											
										<!-- /.col -->
										</div>
										<input type="submit" value="Submit" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;;margin-left: 20px; margin-right: 16px;" />
										<!-- /.row -->
										<input type="hidden" name="match_id" value="<?php echo $matchdata['match_id']; ?>">
										<input type="hidden" name="editorlist" value="<?php echo sizeof($options); ?>" id="editorlist" />
									</form>
								</div>
								<!-- /.box-body -->
							</div>
							<!-- /.box -->
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
initSample();
</script>
<script type="text/javascript">
$(document).ready(function(){
	var i=1;
	  $("#btn1").click(function(){
	var i=y;
	  		i++;
	  		var product='<div class="col-md-12"><div class="col-md-5"><div class="form-group" style=""><input name="options'+i+'" placeholder="Question"  class="form-control mcq_question editors" /></div></div><div class="col-md-5"><div class="form-group" style=""><input name="answer'+i+'" placeholder="Question" class="form-control mcq_question editors" /></div></div><div class="col-md-2"><input type="button" value="-" id="btn1" class="btn btn-primary removeRow" required style="background: #112B4E; margin-bottom: 10px;margin-bottom: 10px;margin-left: 103px;"/></div></div>';
	  		$(".main-div").append(product);
	  		$("#editorlist").val(i);
	  		y++;
	  });
	  $(document).on("click",".removeRow",function(){
        $(this).parent().parent().remove();
            y--;
	  		$("#editorlist").val(i-1);
	  });
	  });
	  initSample();
</script>
