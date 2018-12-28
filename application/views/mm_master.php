<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<table border="1">
	<tr>
		<th>name</th>
		<th>course</th>
		<th>state_id</th>
		<th>status</th>
		<th>Action</th>
	</tr>
	<?php
	foreach($detail as $row)
{
	?>
	<tr>
		<td><?php echo $row['name'] ?></td>
		<td><?php echo $row['course'] ?></td>
		<td><?php echo $row['state_id'] ?></td>
		<td><?php  echo $row['status']==1 ? 'active': 'inactive' ?></td>
		<td><a href="<?php echo base_url().'edit-mm-master/'.$row['id']; ?>">Edit</a></td>

	</tr>
	<?php
	}
	?>
</table>
</body>
</html>