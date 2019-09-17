<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Export MySQL data to CSV file in CodeIgniter</title>

	
</head>
<body>

	<!-- Export Data -->
	<a href='<?= base_url() ?>Downloadcsv/exportCSV'>Export</a><br><br>

	<!-- User Records -->
	<table border='1' style='border-collapse: collapse; width: 100%'>
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Photo</th>
			</tr>
		</thead>
		<tbody>
			<?php
        foreach($usersData as $key=>$val){
				echo "<tr>";
				
				echo "<td>".$val['name']."</td>";
				echo "<td>".$val['email']."</td>";
				echo "<td>".$val['photo']."</td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>

</body>
</html>