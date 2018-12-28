<!DOCTYPE html>
<html>
<head>
	<title>view dislay query</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
	if(isset($value))
	{
		$where="state_id=$value";
		$df=$this->Crud_modal->fetch_all_data('*','mm_master_job',$where);
		echo $this->db->last_query();
		print_r($df);
	}
	?>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-7">
		<form method="post" action="<?php echo site_url('Passvalidation/dispinview');   ?>">
			<div class="form-group">
				<select name="abc" id="abc" class="form-control">
					<option value="">select</option>
					<option value="0">pending</option>
					<option value="1" selected="selected">published</option>
					<option value="2">unpublished</option>
					<option value="3">ALL</option>
					
				</select>
				<input type="submit" name="submit" value="search" class="btn btn-info">
			</div>

		</form>
	</div>
	<div class="col-md-1"></div>
	<div class="row">
		<div class="col-md-7 col-md-offset-4">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
					<th>name</th>
					<th>course</th>
					
					</tr>
				</thead>
				<tbody>
					<?php foreach($df as $v) {

?>
<tr>
						
						<td><?php echo $v['name'] ?></td>
						<td><?php echo $v['course'] ?></td>
						
					</tr>
<?php
					}  ?>
					
				</tbody>
			</table>
		</div>
	</div>
</div>
</body>
</html>