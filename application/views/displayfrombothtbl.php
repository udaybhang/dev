<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<table>
	<tr>
		<th>job name</th>
		<th>job description</th>
		<th>employer name</th>
		<th>employer company</th>
		
	</tr>

	<?php foreach($user as $row) 
{
	?>
<tr>
	<td><?php echo $row['job_name'] ?></td>
	<td><?php echo $row['job_description'] ?></td>
	<td><?php echo $row['employer_name'] ?></td>
	<td><?php echo $row['employer_comany'] ?></td>
</tr>
<?php
}

	?>
	
</table>
</body>
</html>