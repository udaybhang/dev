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

<?php

if(isset($sqdata)){

?>

		<div class="col-md-12">

			<div class="col-md-1"></div>

			<div class="col-md-10">

			<section class="invoice show">

				<!-- title row -->

				<div class="row" style="background-color: #587EA3">

					<div class="col-md-12">

					<h2 class="lel">Sequence Question</h2> </div>

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

									<h3 class="box-title">Sequence Question</h3>

								</div>

								<!-- /.box-header -->

								<div class="box-body">

									<div class="row">

										<div class="col-md-12">

											<div class="form-group">

												<div><h3>Question</h3><?php echo $sqdata['fib_question'] ?></div>

											</div>

										<!-- /.form-group -->

										</div>

										<div class="col-md-12" style="margin-bottom: 10px;">

											<div class="form-group">

												<h3>Options</h3>

												<ul>

													<?php

														$options = explode('comma', $sqdata['fib_answer']);

														foreach ($options as $option) {

															if($option != ''){

													?>

														<li><?php echo $option; ?></li>

													<?php

															}

														}

													?>

												</ul>

											</div>

										</div>

										<div class="col-md-12">

											<div class="form-group">

												<h3>Topic</h3>

												<?php 

												$topicid = $sqdata['topic'];

												$where = "t_id='$topicid'";

												$rval = $this->Crud_modal->fetch_single_data('t_name','master_topic',$where); ?>

												<p><?php echo $rval['t_name'] ?></p>

											</div>

										</div>

										<div class="col-md-12">

											<div class="form-group">

												<h3>Type</h3>

												<?php 

												$typeid = $sqdata['type'];

												$where = "type_id='$typeid'";

												$rval = $this->Crud_modal->fetch_single_data('type_name','master_type',$where); ?>

												<p><?php echo $rval['type_name'] ?></p>

											</div>

										</div>

										<div class="col-md-12">

											<div class="form-group">

												<h3>Skills Test</h3>

												<?php 

												$skillid = $sqdata['skill_tested'];

												$where = "skills_id='$skillid'";

												$rval = $this->Crud_modal->fetch_single_data('skills_name','master_skills_test',$where); ?>

												<p><?php echo $rval['skills_name'] ?></p>

											</div>

										</div>

										<div class="col-md-12">

											<div class="form-group">

												<h3>Case Study</h3>

												<?php 

												$caseid = $sqdata['case_id'];

												$where = "case_id='$caseid'";

												$rval = $this->Crud_modal->fetch_single_data('content','case_study',$where);

												echo $rval['content'] ?></p>

											</div>

										</div>

										<div class="col-md-12">

											<div class="form-group">

												<h3>Difficulty Level</h3>

												<?php 

												$diffi = $sqdata['difficulty_level'];

												$where = "diffi_id='$diffi'";

												$rval = $this->Crud_modal->fetch_single_data('difficulty_level','master_difficulty_level',$where); ?>

												<p><?php echo $rval['difficulty_level'] ?></p>

											</div>

										</div>

									</div>

									<a href="<?php echo base_url()?>sequence-list" class="btn btn-primary btn-md" style="float: left; background-color:#112B4E; border-color: #112B4E; margin-top: 20px;">View All</a>

									<a href="<?php // echo base_url().'edit-sequence/'.rtrim(strtr(base64_encode($sqdata['sq_id']), '+/', '-_'), '='); ?>" class="btn btn-primary btn-md" style="float: right; background-color:#112B4E; border-color: #112B4E; margin-top: 20px;">Edit</a>

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

<?php

}else{

  ?>

  <div class="col-md-12">

      <div class="col-md-10 col-md-offset-1">

        <div class="col-md-12">

          <div class="danger"><strong>Sorry!</strong> Page Not Found</div>

        </div>

      </div>

    </div>

    <?php

  }

  ?>

	</div>

	<!-- /.content -->

	<div class="clearfix"></div>

</div>

<script type="text/javascript">

	$(document).ready(function(){

		$(".canswer").click(function(){

			if ($(this).is(':checked')){

				$(this).val($(this).next().val());

				$(this).attr('checked','checked');

			}else{

				$(this).val('');

				$(this).removeAttr('checked');

			}

		});

	});

</script>