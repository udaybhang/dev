<html>
<head><style>td{
border: 2px dotted green;
padding:10px;
font-size:20px;
}
input{background-color:yellow;
padding:10px;
font-size:20px;}
</style></head>
<body>
<center>
<script src="ajax.js" type="text/javascript"></script>
<?php
include 'db.php';

$id=$_GET['id'];

$query1="SELECT * FROM user where id=$id";

$run=mysqli_query($conn, $query1);

$result=mysqli_fetch_array($run);

?>
<form method="get" action="" enctype="multipart/form-data">
<table style="border: 2px solid orange; padding:10px;">
<tr><td>Enter Your Name:</td><td><input type="text" name="name" value="<?php echo $result['name'] ?>"  ></td></tr>
<tr><td>Enter Your Email:</td><td><input type="text" name="email" value="<?php echo $result['email'] ?>"></td></tr>
<tr><td>Enter Your Password:</td><td><input type="text" name="password" value="<?php echo $result['password'] ?>"></td></tr>

<tr><td>Country :</td><td><select name="dropdown" id="country" onchange="change_country()" >

<option  value="<?php echo $result['country']; ?>"><?php echo $result['country'];  ?></option></td></tr>	

</select>

<tr><td>State :</td><td><select name="dropdown1" id="state" style=""><option>------- Select --------</option></select></td></tr>
<tr><td>Select Any One</td><td><input type="radio" name="gender" value="<?php echo $result['gender'] ?>" >Male<input type="radio" name="gender" value="<?php echo $result['gender'] ?>">Female </td></tr>
<tr><td>Select courses</td><td><input type="checkbox" name="courses" value="<?php echo $result['courses'] ?>" >MCA<input type="checkbox" name="courses" value="<?php echo $result['courses'] ?>" >BCA <input type="checkbox" name="courses" value="<?php echo $result['courses'] ?>" >MBA </td></tr>
<tr><td>Upload Image</td><td><input type="file" name="uploadfile" value="<?php echo $result['image'] ?>" ></td></tr>
</table>
<button >    <input type="submit" name="submit" value="update"></button>
</form>
</center>
</body>
</html>
