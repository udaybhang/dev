<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Download PDF</title>
	<style type="text/css">
		.wrap{
			margin:20px 0;
		}
	</style>
</head>
<body>
<div class="wrap">
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<table class="table table-striped table-bordered table-responsive">
					<thead>
						<tr>
							<th>serial No</th>
							<th>Username</th>
							<th>Email</th>
							<th>plan_name</th>
							<th>Invoive Id</th>
							</tr>
							</thead>
							<tbody>
							<?php
								$i=1;  
							foreach($all_info as $row)
							{
							?>
							<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $row['mm_user_full_name'] ?></td>
							<td><?php echo $row['mm_user_email'] ?></td>
							<td><?php echo $row['plan_name'] ?></td>
	<td><a href="<?php echo base_url().'download-invoice/'.$row['user_id'].'-'.$row['plan_id'];  ?>"><?php echo $row['invoice_id'] ?></a></td>

						</tr>
							<?php
							     $i++;
							           }
							      
														?>
						
					</tbody>
				</table>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</div>
</body>
</html>