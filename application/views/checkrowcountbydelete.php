<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="row">
	<div class="col-md-offset-3 col-md-6">
		<?php 
if($this->session->flashdata('skills_test_insert_message'))
{
	echo $this->session->flashdata('skills_test_insert_message');
}
		?>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Serial No</th>
					<th>state Name</th>
					<th>State Id</th>
					<th>status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$count=1;
				foreach($state as $s)
				{
					
					?>
<tr>
					<td><?php echo $count; ?></td>
					<td><?php echo $s['state']; ?></td>
					<td><?php echo $s['id']; ?></td>
					<td><?php echo $s['status']; ?></td>
					<td><a href="<?php echo base_url().'bycheckrowdelete/'.rtrim(strtr(base64_encode($s['id']), '+/', '-_'), '='); ?>" onclick="return confirm('Are you sure you want to delete??');">Delete</a></td>
				</tr>

					<?php
$count++;
				}
				?>
				
			</tbody>
			<tfoot>
				<tr>
					if state id not belong to stateid of city then deleted else not.
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-3"></div>
</div>
<td><!--  -->

</td>
</body>
</html>


