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
					<h2 class="lel">Master Assignment</h2> </div>
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
									<h3 class="box-title">Master Assignment</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<form name="create_assign" autocomplete="off" method="post" action="<?php echo base_url() ?>create-assign" enctype="multipart/form-data">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="exampleInputEmail1">Assignment Name</label>
													<input type="text" class="form-control" maxlength="40" id="assignment_name" name="assignment_name" placeholder="Assignment Name" required="">
												</div>
											<!-- /.form-group -->
											</div>
											<!-- /.col -->
											<div class="col-md-6">
												<!-- /.form-group -->
												<div class="form-group">
													<label>No of levels</label>
													<select name="assign_lvl" class="form-control select2" style="width: 100%;">
														<option value="1" selected="selected">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
														<option value="6">6</option>
														<option value="7">7</option>
														<option value="8">8</option>
														<option value="9">9</option>
														<option value="10">10</option>
														<option value="11">11</option>
														<option value="12">12</option>
														<option value="13">13</option>
														<option value="14">14</option>
														<option value="15">15</option1>
														<option value="16">16</option1>
														<option value="17">17</option1>
														<option value="18">18</option1>
														<option value="19">19</option1>
														<option value="20">20</option1>
													</select>
												</div>
											<!-- /.form-group -->
											</div>
										</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="exampleInputEmail1">Start Date</label>
													<input type="text" class="form-control" id="start_date" name="start_date" placeholder="Start Date" required="">
												</div>
											<!-- /.form-group -->
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="exampleInputEmail1">End Date</label>
													<input type="text" class="form-control" id="end_date" name="end_date" placeholder="End Date" required="">
												</div>
											<!-- /.form-group -->
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="exampleInputEmail1">Select Type</label>
													<select name="ass_type" class="form-control">
														<option value="Manual">Manual</option>
														<option value="Automatic">Automatic</option>
													</select>
												</div>
											<!-- /.form-group -->
											</div>
                                            
                                            <!-- my Code-->
                                            <div class="col-md-4">
                                            	<div class="form-group">
													<label for="exampleInputEmail1">Wallet Point</label>
													<input type="text" class="form-control" id="wallet_point" name="wallet_point" placeholder="Wallet Point" required="">
												</div>
                                            </div>
                                            <div class="col-md-4">
                                            	<div class="form-group">
													<label for="exampleInputEmail1">Lumens</label>
													<input type="text" class="form-control" id="lumens" name="lumens" placeholder="Lumens" required="">
												</div>
                                            </div>
                                            <div class="col-md-4">
                                            	<div class="form-group">
													<label for="exampleInputEmail1">Time Limits</label>
													<input type="text" class="form-control" id="time_limit" name="time_limit" placeholder="Time Limits" required="">
												</div>
                                            </div>
                                            <!-- my Code end -->
											
											
											
											<div class="col-md-6">
												<div class="form-group">
													<label for="exampleInputEmail1">Assignment Image</label>
													<input type="file" name="image" required="" />
												</div>
											<!-- /.form-group -->
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label for="exampleInputEmail1">Assignment Description</label>
													<textarea name="assignment_description" placeholder="Assignment Description" class="form-control" style="height: 100px;"></textarea>
												</div>
											<!-- /.form-group -->
											</div>
										<!-- /.col -->
										</div>
										<button data-toggle="modal" data-target="#myModal" type="button " class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E">Submit</button>
										<!-- /.row -->
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
  	$('.timeformatExample1').timepicker({ 'timeFormat': 'H:i:s' });
    $( "#start_date" ).datepicker({ minDate: 0, dateFormat: 'dd-mm-yy' });
    $( "#end_date" ).datepicker({ minDate: 0, dateFormat: 'dd-mm-yy' });

    $('#validity').change(function(){
    	if(isNaN($(this).val()))
    	{
    		alert('Please enter only number');
    		$(this).val('');
    	}
    	
    });
  });
</script>