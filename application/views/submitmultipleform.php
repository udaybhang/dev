


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<form id="form_1" action="<?php echo base_url().'Submitmultipleform/multiple_form'   ?>" method="post">
        <input type="submit" name="submit_a" value="Submit" />
    </form>

   <form id="form_2" action="<?php echo base_url().'Submitmultipleform/multiple_form'  ?>" method="post">
        <input type="submit" name="submit_2" value="Submit" />
    </form>
	<form action="<?php echo base_url().'Submitmultipleform/complex_function' ?>" class="form-inline" method="post">
		<div class="col-md-6">
			<div class="form-group">
	   <label for="">Date:</label>
	   <input type="date" class="form-control" name="newdate">
        </div>
        <div class="form-group">
	   <label for="">findName:</label>
	   <input type="text" class="form-control" name="xx">
        </div>
        <input type="submit" class="form-control" value="Submit" name="secondsubmit">
		</div>
	
	</form>
</body>
</html>