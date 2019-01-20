<!DOCTYPE html>
<html>
<head>
	<title>helper</title>
</head>
<body>
<?php echo print_r($user); ?>
<table border="2">
	<tr>
		<td><?php echo $user->id;  ?></td>
		<td><?php echo $user->mm_user_full_name;  ?></td>
		<td><?php echo $user->mm_user_email;  ?></td>
	</tr>
</table>
</body>
</html>