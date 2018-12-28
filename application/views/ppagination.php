
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<table border="1" style="margin-left: 300px;">
	
	<tr>
		<th>Serial No</th>
		<th>state_id</th>
		<th>City name</th>
	</tr>
<?php 


foreach($list as $row)
{
?>
<tr>
	<td><?php  echo $row['city_id'] ?></td>
	<td><?php  echo $row['state_id'] ?></td>
	<td><?php echo $row['city_name'] ?></td>
</tr>

<?php

}

?>
</table>

<?php

for($a=1; $a<=$pag; $a++)
{
	?>
	

		<a href="<?php echo base_url().'perpage/'.$a;  ?>" style="text-decoration: none; margin:5px; " ><?php echo $a." "; ?></a>

	
	
	
	<?php
}



?>


</body>
</html>

