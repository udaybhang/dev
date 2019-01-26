<html>
<head>
</head>
<body>
	
	<?php include 'db.php'; ?>
<?php 
session_start();
	$uname=$_POST['uname'];
	$pass=$_POST['password'];
	$query="select * from user where name='$uname' && password='$pass' ";
	$result=mysqli_query($conn, $query);
	$row=mysqli_num_rows($result);
	if($row>0){
		$_SESSION['user_name']=$uname;
		//echo "you have sucesssfully loged in";
				}
		else{
			echo "enter you user name and password";
				}
				if($_SESSION['user_name'])
			{
				header('location: recordset.php');
		}
				
	
	 ?>
	 <center>
		 
<div style="background-color: blue; " >
	
<h2 style="color:red;">Login Here</h2>

<table border="2px" style="padding:20px;" >
<form action="" method="post">
	<tr>
<td style="font-size:20px;">User Name:</td><td><input type="text" name="uname" value="" style="padding:10px; background-color:yellow; font-size:25px;"></td></tr>
<tr><td style="font-size:20px; ">Password:</td><td><input type="password" name="password" value="" style="padding:10px; background-color:yellow;font-size:25px;"></td></tr>
<tr><td></td><td align="center" ><input type="submit" value="submit" name="submit" style="padding:15px;"></td</tr>
<button style="padding:15px;"><a href="register.php" style="text-decoration:none;">register</a></button>	
</table>

</form>

</center>
</div>	
</body>
</html>
