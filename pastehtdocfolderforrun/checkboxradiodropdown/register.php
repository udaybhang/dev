
<html>
<head>
<style>
td{
	padding:12px;
	border:2px solid green;
	font-size:20px;
}
input{
	background-color: yellow;
	padding:10px;
	font-size:20px;
}
</style>
<script type="text/javascript" src="ajax.js"></script>
</head>
<body>
    
<?php include("db.php");?>
    <h2 style="text-align:center;">Registration Form</h2>
<table align="center" style="border:1px solid red;">
    <form method="post" action="insertinto.php" enctype="multipart/form-data" >
      
    <tr><td>Enter Your Name:</td><td><input type="text" name="name" ></td></tr>
    <tr><td>Enter Your Email:</td><td><input type="text" name="email" ></td></tr>
 <tr><td>Enter Your Password:</td><td><input type="text" name="password" ></td></tr>

<tr><td>Country :</td>
    <td><select name="dropdown" id="country" onchange="change_country()">
<option value=''>------- Select --------</option>
<?php 
$sql = "select * from `countries`";
$res = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($res)) {
?>
<option  value="<?php echo $row['id']; ?>"><?php echo $row['country']; ?></option>
<?php
}


?>
</select></td></tr>

<tr><td>State :</td>
<td><select name="dropdown1" id="state"><option>------- Select --------</option></select></td></tr>


    
    <tr><td>Select Any One</td><td><input type="radio" name="gender" value="Male">Male<input type="radio" name="gender" value="Female">Female </td></tr>
    <tr><td>Select Corses</td><td><input type="checkbox" name="courses[]" value="MCA">MCA<input type="checkbox" name="courses[]" value="BCA">BCA<input type="checkbox" name="courses" value="MBA">MBA</td></tr>
    <tr><td>Upload File</td><td><input type="file" name="uploadfile" value=""></td></tr>
    <tr><td></td><td><input type="submit" name="submit" value="submit"></td></tr>

</form>   
        </table>
</body>

</html>