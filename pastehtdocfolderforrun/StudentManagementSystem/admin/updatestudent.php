<?php
session_start();
if(isset($_SESSION['uid']))
{
// echo $_SESSION['uid'];
}
else{
header('location: ../login.php');
}
?>
<?php
include 'header.php';
include 'titlehead.php';

?>
<head><style>td, th{text-transform: capitalize; font-size: 20px; padding: 8px;}</style></head>
<table align="center">
<form method="post" >
<tr><td>Enter Standered</td><td><input type="number" name="standered" required=""></td><td>Enter Student Name</td><td><input type="text" name="stuname" required=""></td><td><input type="submit" name="submit" value="Search"></td></tr>
</form>
</table>
<table border="1" align="center" width="80%">
    <tr style="background-color: moccasin; color: white;"><th>no</th>
<th>image</th>
<th>name</th>
<th>rollno</th>
<th>edit</th>
</tr>
<?php

if(isset($_POST['submit']))
{
include '../dbcon.php';
$standered=$_POST['standered'];
$name=$_POST['stuname'];
$sql="SELECT * FROM `student` WHERE standerd='$standered' AND name LIKE '%$name%'";

$run=mysqli_query($con, $sql);
if(mysqli_num_rows($run)<1) {
echo "<tr><td colspan='5' align='center'>no record found</td></tr>";
}
else{

$count=0;
while ($data= mysqli_fetch_assoc($run)){
$count++;
?>
<tr><td><?php echo $count; ?></td>
    <td align="center"><img src="../dataimg/<?php echo $data['image']; ?>" style="max-width: 100px;"/></td>
<td align="center"><?php echo $data['name']; ?></td>
<td align="center"><?php echo $data['rollno']; ?></td>
<td><a href="updateform.php?sid=<?php echo $data['id']; ?>">edit</a></td>
</tr>
<?php
}
}
}
?>
</table>
