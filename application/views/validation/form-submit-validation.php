<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
</head>
<body>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="row main">
		<div class="col-md-6 col-md-offset-3">
			
		<section class="invoice show">
			<!-- title row -->
			<div class="row" style="background-color: #587EA3">
				<div class="col-md-12">
				<h2 class="lel">Package</h2> </div>
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
								<h3 class="box-title">Package</h3>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<form autocomplete="off" method="post"  action="<?php echo base_url()?>edit-package" enctype="multipart/form-data" id="pform">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<select class="form-control" name="package_name">
													<option value="">Select Package</option>
													
														<option value="" >onchange form submit</option>
																										
												</select>
											</div>
										</div>
										
										<div class="col-md-12">
											<div class="form-group">
												<label for="">Validity</label>
												<input type="text" name="validity" placeholder="Validity" id="validity"  class="form-control"  />
												<span class="validity text-danger"></span>
												<span class="php_validity text-danger"></span>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="">Total marks</label>
												<input type="text" name="total_marks" id="total_marks" placeholder="Total Marks" value="" class="form-control"  />
												<span class="total_marks text-danger"></span>
												<span class="php_total_marks text-danger"></span>
											</div>
										</div>
										<!--mycode-->
							<div class="col-md-12">
                                            	<div class="form-group">
													<label for="exampleInputEmail1">Wallet Point</label>
													<input type="text" class="form-control" id="wallet_point" name="wallet_point" placeholder="Wallet Point" value="" >
													<span class="wallet_point text-danger"></span>
												    <span class="php_wallet_point text-danger"></span>
												</div>
                                            </div>
                                            <div class="col-md-12">
                                            	<div class="form-group">
													<label for="exampleInputEmail1">Lumens</label>
													<input type="text" class="form-control" id="lumens" name="lumens" placeholder="Lumens" value="" >
													<span class="lumens text-danger"></span>
												    <span class="php_lumens text-danger"></span>
												</div>
                                            </div>
                                            <div class="col-md-12">
                                            	<div class="form-group">
													<label for="exampleInputEmail1">Time Limits</label>
													<input type="text" class="form-control" id="time_limit" name="time_limit" placeholder="Time Limits (In minutes 00.00)" value="" >
													<span class="time_limit text-danger"></span>
												    <span class="php_time_limit text-danger"></span>
												</div>
                                            </div>
							<!--mycode-->
								
										<div class="col-md-12">
											<div class="form-group">
												<input type="hidden" name="previous_image">
												<input type="file" name="image" id="image" />
												<span class="image_conflict text-danger"></span>
												    <span class="php_image text-danger"></span>
											</div>
										</div>
											<!-- Start code by shubham  -->
										<div class="col-md-12">
											<div class="form-group">
												<img src="<?php echo base_url(); ?>upload/package/<?php ?> " class="img-responsive" width="80px">
											</div>
										</div>
							<!-- End code by shubham  -->
										<div class="col-md-12">
											<div class="form-group">
												<textarea class="form-control" required="" maxlength="165" placeholder="Description" name="description"></textarea>
											</div>
										</div>
										
									
									    <button type="button" id="update"  value="Update" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E; margin-top: 20px; margin-right: 20px;" />Submit</button>
										
									</div>
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
	</div>
	<!-- /.content -->
	<div class="clearfix"></div>
</div>
</body>
</html>

<script>
	
function check_validation()
{

		var validity=$("#validity").val();
		var total_marks= $("#total_marks").val();
		var wallet_point = $("#wallet_point").val();
		var lumens = $("#lumens").val();
		var time_limit= $("#time_limit").val();
		var image=$('#image').val();


		var time_limit_regular=time_limit.match(/^([[0-5][0-9]):[0-5][0-9]$/);
		if(validity=='')
		{
			$(".validity").html("please enter validity");
			return false;
		}
		if(isNaN(validity))
		{
			$(".validity").html("only numbered allowed.");
			return false;
		}
		if(total_marks=='')
		{
			$(".total_marks").html("please enter total_marks");
			return false;
		}
		if(isNaN(total_marks))
		{
			$(".total_marks").html("only numbered allowed.");
			return false;
		}
		if(wallet_point=='')
		{
			$(".wallet_point").html("please enter wallet point.");
			return false;
		}
		if(isNaN(wallet_point))
		{
			$(".wallet_point").html("only numbered allowed.");
			return false;
		}
		if(lumens=='')
		{
			$(".lumens").html("please enter lumens");
			return false;
		}
		if(isNaN(lumens))
		{
			$(".lumens").html("only numbered allowed.");
			return false;
		}
		if (time_limit=='')
		{
            $(".time_limit").html("Please enter time limit.");
            return false;
        }
	
		 if(time_limit_regular==null)
			{
				$(".time_limit").html("time limit in the form of hh:mm.");
				 return false;
}
if(image=='')
{
	$(".image_conflict").html("please select file.");
				 return false;
}
 
 var ext = $('#image').val().split('.').pop().toLowerCase();
 
if($.inArray(ext, ['gif','png','jpg','jpeg', 'exe']) == -1) {
   $(".image_conflict").html("wrong file extention.");
      document.getElementById('image').value = '';
      return false;
}



return true;
	
}
 $("input[type='file']").on("change", function () {
     if(this.files[0].size > 2000000) {
      $(".image_conflict").html("file size should be lessthan 2mb.");
        $(this).val('');
       return false;
     }
    });
$(document).on('input', function()
{
	$(".validity").html("");
	$(".total_marks").html("");
	$(".wallet_point").html("");
	$(".lumens").html("");
	$(".time_limit").html("");
	$(".image_conflict").html("");
})

</script>
<script type="text/javascript">


$('select[name="package_name"]').change(function(){
	$('#pform').submit();
});

$('#update').click(function(){
	
	if($('#pkg_status').val()!=''){
		var formaction ='<?php echo base_url()?>package-update';
		var pform = $('#pform');
		pform.removeAttr('action');
		pform.attr('action',formaction);
		if(pform.attr('action')==formaction){
			if(check_validation() == true){
		$('#pform').submit();
	}
		}else{
			alert('Something went Wrong')
		}
	}else{
		alert('Please Select Package Status');
	}
	
});
$('.fa-times').click(function(){
	$(this).parent().remove();
});
	
</script>