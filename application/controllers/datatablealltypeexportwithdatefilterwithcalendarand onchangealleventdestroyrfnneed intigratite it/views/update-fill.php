<script src="<?php echo base_url(); ?>admin_assets/editor/ckeditor.js"></script>
<div class="content-wrapper">

	<!-- Content Header (Page header) -->

	

	<div class="row main" style="margin-top:100px;">

		<div class="col-md-12">

			<div class="col-md-10 col-md-offset-1">

				

				<section class="invoice show">

					<!-- title row -->

					

					<div class="clearfix" style="margin-top: 20px;"></div>

					<div class="">

						<div class="col-md-12">

							<?php

							if($this->session->flashdata('data_message')){

								echo $this->session->flashdata('data_message');

							}

							?>

							</div>

					</div>

					<!-- /.box-header -->

					<div class="clearfix"></div>

					<div class="row">

						<div class="col-md-12">

							

							 <section class="content">

								<div class="adjoined-bottom">

									<div class="grid-container">

										<div class="grid-width-100">
										
										<form method="post" action="<?php echo base_url()?>edit-fib">

													<div class="main-div">
														<div class="col-md-12" style="margin-top: 20px;">

															<div class="form-group">
																<textarea name="fib_question" class="form-control ckeditor" placeholder="Question" ><?php echo str_replace('<a href="" class="fibeditable"></a>', 'inllif', $filldata['fib_question']); ?></textarea>
															</div>
														</div>

														<div class="col-md-12" style="margin-top: 20px;">

															<div class="form-group" style="">

																<input name="answer1" placeholder="Answer" value="<?php echo $filldata['fib_answer']; ?>" class="form-control mcq_question"/>

															</div>

														</div>

														<div class="col-md-12">

															<div class="form-group">
													<select name="master_topic" class="form-control">
														<option value="">Select Topics</option>
														<?php
															foreach ($master_topics as $master_topic) {
																if($master_topic['t_id'] == $filldata['topic']){
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
																if($master_type['type_id'] == $filldata['type']){
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
																if($master_skills_test['skills_id'] == $filldata['skill_tested']){
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
																if($master_difficulty_level['diffi_id'] == $filldata['difficulty_level']){
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
																if($master_cases['case_id'] == $filldata['case_id']){
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

												<input type="hidden" name="fib_id" value="<?php echo $filldata['fib_id']; ?>">
												<input type="submit" value="Submit" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;margin-right: 10px;" />

											</form>

										

										</div>

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

<div class="container">

	<div class="row">

		<div class="col-md-12">

			

		</div>

	</div>

</div>