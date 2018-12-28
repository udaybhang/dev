<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<select class="form-control" name="package">
													<option value="">Select Package</option>
													<?php
														foreach ($com as $allass_list) {
													?>
														<option value="<?php echo $allass_list['id'];?>"><?php echo $allass_list['employer_comany'];?></option>
													<?php
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group" id="validity">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group" id="hrs">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group" id="assignemnt_list">
											</div>
										</div>
									</div>


  <script>
	$(document).ready(function(){
		$('select[name="package"]').change(function(){
			 alert("dnfinn");
			if($(this).val()!=''){
				$.ajax({
		          method: "POST",
		          data: {'packid': $(this).val()},
		          url: "<?php echo base_url() ?>view-data-package",
		            dataType: "Json",
		          success: function(result){
		          	 alert(JSON.stringify(result));
		          	$('#validity').html('<h5 class="form-control">'+result.emp_name+' Days</h5>');
		          	// $('#hrs').html('<h5 class="form-control">'+result.total_marks+' Marks</h5>');
		          	var output = '<ul>';
		          	for(var i=0;i<result.asval.length;i++){
		          	output += '<li>'+result.asvl[i].job_name+'</li>';
		          	}
		          	output += '</ul>';
		          	$('#assignemnt_list').html(output);
		          }
		      });
			}else{
				$('#validity').text('');
				$('#assignemnt_list').html('');
			}
		});
	});
</script>

</body>
</html>

