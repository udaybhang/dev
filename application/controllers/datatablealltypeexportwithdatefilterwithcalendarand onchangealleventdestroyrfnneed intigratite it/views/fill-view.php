<script src="<?php echo base_url(); ?>admin_assets/editor/ckeditor.js"></script>
<div class="content-wrapper">

	<!-- Content Header (Page header) -->

	

	<div class="row main">

		<div class="col-md-12">

			<div class="col-md-10 col-md-offset-1">
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="background-color: #587EA3">
			          <div class="col-md-12">
			          <h2 class="lel">FIB Create</h2> </div>
			        </div>
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
					<div class="box-header with-border">
                  		<h3 class="box-title">FIB Create</h3>
                	</div>
					<!-- /.box-header -->

					<div class="clearfix"></div>

					<div class="row">

						<div class="col-md-12">

							

							 <section class="content">

								<div class="adjoined-bottom">

									<div class="grid-container">

										<div class="grid-width-100">

										<form method="post" action="<?php echo base_url()?>create-fill-in-blank">

													<div class="main-div">
														<div class="col-md-12" style="margin-top: 20px;">

															<div class="form-group" style="">
																<textarea name="fib_question" class="form-control ckeditor" placeholder="Question"></textarea>
															</div>
														</div>

														<div class="col-md-12">

															<div class="form-group" style="">

																<input name="answer1" placeholder="Answer" class="form-control mcq_question"/>

															</div>

														</div>

														<div class="col-md-12">

															<div class="form-group">

																<select name="master_topic" class="form-control" required="required">

																	<option value="">Select Topics</option>

																	<?php

																		foreach ($master_topics as $master_topic) {

																	?>

																	<option value="<?php echo $master_topic['t_id']?>"><?php echo $master_topic['t_name']?></option>

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

																	?>

																	<option value="<?php echo $master_type['type_id']?>"><?php echo $master_type['type_name']?></option>

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

																	?>

																	<option value="<?php echo $master_skills_test['skills_id']?>"><?php echo $master_skills_test['skills_name']?></option>

																	<?php

																		}

																	?>

																</select>

															</div>

														</div>

														<div class="col-md-12">

															<div class="form-group">

																<select name="master_difficulty_level" class="form-control">

																	<option value="">Select difficulty level</option>

																	<?php

																		foreach ($master_difficulty as $master_difficulty_level) {

																	?>

																	<option value="<?php echo $master_difficulty_level['diffi_id']?>"><?php echo $master_difficulty_level['difficulty_level']?></option>

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

																	?>

																	<option value="<?php echo $master_cases['case_id']?>"><?php echo $master_cases['case_name']?></option>

																	<?php

																		}

																	?>

																</select>

															</div>

														</div>

												</div>

									<?php 
									 $permission_array=$this->session->userdata('permission_array');
				                			for($i=0;$i<sizeof($permission_array);$i++){
				                    			$p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
				                    			if($p["permission_description"]=="Create"){

				        			?>
											<input type="submit" value="Submit" class="btn btn-primary btn-md" style="float:right;background-color:#112B4E;border-color:#112B4E;margin-top:20px;margin-right:10px;"/>
								    <?php }} ?>
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
