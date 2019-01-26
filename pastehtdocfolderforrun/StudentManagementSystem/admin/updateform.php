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
include '../dbcon.php';
$sid=$_GET['sid'];
$sql="SELECT * FROM `student` WHERE `id`='$sid'";
$run=mysqli_query($con, $sql);
$data=mysqli_fetch_assoc($run);
?>
<table border="1" align="center">
    <form method="post" enctype="multipart/form-data" action="updatedata.php" >
        <tr><td>Roll No</td><td><input type="text" name="rollno" value="<?php echo $data['rollno']; ?>" required=""></td></tr>
         <tr><td>Full Name</td><td><input type="text" name="name" value="<?php echo $data['name']; ?>" required=""></td></tr>
         <tr><td>City</td><td><input type="text" name="city" value="<?php echo $data['city']; ?>" required=""></td></tr>
           <tr><td>Parant contact No</td><td><input type="text" name="pcon" value="<?php echo $data['pcont']; ?>" required=""></td></tr>
           <tr><td>Standered</td><td><input type="number" name="stu" value="<?php echo $data['standerd']; ?>" required=""></td></tr>
           <tr><td>image</td><td><input type="file" name="simg" required=""></td></tr>
           <tr><td colspan="2" align="center"><input type="hidden" name="sid" value="<?php echo $data['id']; ?>">
                   <input type="submit" name="submit" value="Update"></td></tr>
    </form>
</table>
