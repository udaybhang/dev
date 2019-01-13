<!DOCTYPE html>
<html>
<head>
	<title>join</title>
</head>
<body>
<div style="margin-top: 10%; margin-left: 25%; border:1px solid pink;">

	<table border="1">
		<tr>
			<th>Serl.No</th>
			<th>Dept name</th>
			<th>user name</th>
		</tr>
		<?php  
		$tbl='';
			$i=0;
			foreach($user as $row)
			{
		$tbl.='<tr>';
			
				 $tbl.='<td>'.$i.'</td><td>';
				 if(!empty($row['deptname']))
				 {
				 	$tbl.=''.$row['deptname'];
				 }
				 else{
				 	$tbl.='-';
				 }
				$tbl.='<td>';
				if(!empty($row['name']))
				{
						$tbl.=''.$row['name'];
				}
				else{
					$tbl.='-';
				}
				$tbl.='</td></tr>';
				
				
				$i++;
			}
			echo $tbl;

			?>
		
	</table>
</div>
</body>
</html>