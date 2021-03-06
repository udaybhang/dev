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
</style>
</head>
<body></body>
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
									<form name="create_assign" autocomplete="off" method="post" action="<?php echo base_url() ?>validation/Validation/php_validate_key_event_form_submit" enctype="multipart/form-data">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="exampleInputEmail1">Assignment Name</label>
													<input type="text" class="form-control" maxlength="40" id="assignment_name" name="assignment_name" placeholder="Assignment Name" required="">
													<span class="message_error alphabets_alw" style="display:none; color:red;">Only character  allowed.</span>
                                                    <span style="color:red;" class="msgphp" ><?php 

                                                    echo form_error('assignment_name'); ?></span> 
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
														<option value="15">15</option>
														<option value="16">16</option>
														<option value="17">17</option>
														<option value="18">18</option>
														<option value="19">19</option>
														<option value="20">20</option>
													</select>
												</div>
											<!-- /.form-group -->
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="exampleInputEmail1">Start Date</label>
													<input type="text" class="form-control" id="start_date" name="start_date" placeholder="Start Date" required="">	
													<span style="color:red; display:block;"><?php echo  $this->session->flashdata('date_msg'); ?></span>
													<span class="message_error date_valid_start" style="display:none; color:red;">start date must lesser.</span>
												</div>
											<!-- /.form-group -->
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="exampleInputEmail1">End Date</label>
													<input type="text" class="form-control" id="end_date" name="end_date" placeholder="End Date" required="">
										        <span class="message_error date_valid" style="display:none; color:red;">End date must bigger.</span>
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
										</div>
											
                                            
                                            <!-- my Code-->
                                            <div class="row">
                                            <div class="col-md-4">
                                            	<div class="form-group">
													<label for="exampleInputEmail1">Wallet Point</label>
													<input type="text" class="form-control" id="wallet_point" name="wallet_point" placeholder="Wallet Point" required="">
													<span class="message_error number_alw" style="display:none; color:red;">Only number allowed.</span>
													 <span style="color:red;" class="wallet_point"><?php echo form_error('wallet_point'); ?></span> 
													
												</div>
                                            </div>
                                            <div class="col-md-4">
                                            	<div class="form-group">
													<label for="exampleInputEmail1">Lumens</label>
													<input type="text" class="form-control" id="lumens" name="lumens" placeholder="Lumens" required="">
													<span class="message_error lumens" style="display:none; color:red;">Only number allowed.</span>
												  <span style="color:red;"><?php echo form_error('lumens'); ?></span>	
												</div>
                                            </div>
                                            <div class="col-md-4">
                                            	<div class="form-group">
													<label for="exampleInputEmail1">Time Limits</label>
													<input type="text" class="form-control" id="time_limit" name="time_limit" placeholder="Time Limits (In minutes 00.00)"   required="">
												<span style="display: block; color:red;"><?php echo $this->session->flashdata('time_limit');  ?></span>	
												<span class="message_error time_limit" style="display:none; color:red;">Invalid time format. The valid format is hh:mm.</span>
												 <span style="color:red;"><?php echo form_error('time_limit'); ?></span> 
												</div>
                                            </div>
                                        </div>
                                            <!-- my Code end -->
											<div class="col-md-6">
												<div class="form-group">
													<label for="exampleInputEmail1">Assignment Image</label>
													<input type="file" name="image" id="img"  required="" />
													<span class="frontimg" style="color:red;display:none;">incorrect file extention.</span>
												<span class="img" style="display:block;"><?php echo $this->session->userdata('assign_message');  ?></span>	
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
</html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js">
</script>
<script>
	$(document).ready(function()
	{
		$("#assignment_name").keypress(function (event) {
    var key = window.event ? event.keyCode : event.which;
   	if (key==32) {
        return true;
     }
    else if ( key < 65 || key > 127 || key == 126 || key == 96 || key == 91 || key == 92 || key == 93 || key == 94 || key == 124 || key == 123 || key == 125) {
      $(".alphabets_alw").css('display','block');
        return false;
    }
    else {
		    $(".alphabets_alw").css('display','none');
           
        return true;  
    }
    });	
		$("#wallet_point").keypress(function(event) {
			var key= window.event ? event.keyCode  :  event.which;
			if(key == 48 || key == 49 || key == 50 || key == 51 || key == 52 || key == 53 || key == 54 || key == 55 || key == 56 || key == 57)
			{
				$(".number_alw").css('display','none');
            $("#wallet_point").css('border-bottom-color','1ab39 !important');

              return true;  		
			}
			else
			{
				 $(".number_alw").css('display','block');
        return false;
			}
		});
		$("#lumens").keypress(function(event) {
			var key= window.event ? event.keyCode  :  event.which;
			if(key == 48 || key == 49 || key == 50 || key == 51 || key == 52 || key == 53 || key == 54 || key == 55 || key == 56 || key == 57)
			{
				$(".lumens").css('display','none');
            $("#wallet_point").css('border-bottom-color','1ab39 !important');

        return true;  		
			}
			else
			{
				 $(".lumens").css('display','block');
        return false;
			}
		});
		
	})
</script>
<script>
	
$(document).ready(function() {
 $("#img").button().change(function(){
 var ext = $('#img').val().split('.').pop().toLowerCase();
if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
   $(".frontimg").css("display", "block");
      document.getElementById('img').value = '';
      return false;
}
else{
   $(".frontimg").css("display", "none");
}
 });  
 }); 

</script>

<script>
	$(document).ready(function()
	{
		$(document).on('input', function()
		{
			$(".alphabets_alw").css('display','none');
			$(".number_alw").css('display','none');
			 $(".lumens").css('display','none');
			 $(".wallet_point").css('display','none');
			 $(".time_limit").css('display','none');
			 $('.msgphp').css('display', 'none');
			 
		})
		
		 $("#time_limit").on('blur', function()
		 {
		
		 	ab();
		 })

 function ab()
	{
		var mtch=$("#time_limit").val();
			
			var y=mtch.match(/^([[0-5][0-9]):[0-5][0-9]$/);
			if(y!=null)
			{
				$(".time_limit").css("display", "none");
				 return true;
}
			else{
				$(".time_limit").css("display", "block");
				return false;
			}
	}

		});
	
</script>
<script>
	$(document).ready(function()
	{
	
    $("#end_date, #start_date").on('change', function()
    {
    	 var ldt=$("#end_date").val();
    	 var fdt=$("#start_date").val();
    	 var date1 = new Date(fdt);
    	 var date2 = new Date(ldt);
		 var timeDiff = Math.abs(date2.getTime() - date1.getTime());
		 var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 

		//alert(diffDays);
		if(ldt!='' && fdt!=''){
		if(fdt<ldt){
			$(".date_valid").css("display", "none");
			$(".date_valid_start").css("display", "none");
		}else{
		
			$(this).next().css("display", "block");

		}
	}

  
  })
	})
</script>
<script type="text/javascript">
  $(document).ready(function(){
  	 // $('.timeformatExample1').timepicker({ 'timeFormat': 'H:i:s' });
    $( "#start_date" ).datepicker({ minDate: 0, dateFormat: 'dd-mm-yy' });
    $( "#end_date" ).datepicker({ minDate: 0, dateFormat: 'dd-mm-yy' });

    
  });
</script>