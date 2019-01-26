<?php
session_start();
if(isset($_SESSION['uid']))
{
    //echo $_SESSION['uid'];
}
else{
    header('location: ../login.php');
}

?>
<?php
include 'header.php';
include 'titlehead.php';
?>
<table border="1" align="center">
    <form method="post" enctype="multipart/form-data" >
        <tr><td>Roll No</td><td><input type="text" name="rollno" required=""></td></tr>
         <tr><td>Full Name</td><td><input type="text" name="name" required=""></td></tr>
         <tr><td>City</td><td><input type="text" name="city" required=""></td></tr>
           <tr><td>Parant contact No</td><td><input type="text" name="pcon" required=""></td></tr>
           <tr><td>Standered</td><td><input type="number" name="stu" required=""></td></tr>
           <tr><td>image</td><td><input type="file" name="simg" required=""></td></tr>
           <tr><td colspan="2" align="center"><input type="submit" name="submit" value="submit"></td></tr>
    </form>
</table>
<?php
include '../dbcon.php';
if(isset($_POST['submit'])){
    $rollno=$_POST['rollno'];
    $name=$_POST['name'];
    $city=$_POST['city'];
    $pcon=$_POST['pcon'];
    $stu=$_POST['stu'];
    $imagename=$_FILES['simg']['name'];
    $tempname=$_FILES['simg']['tmp_name'];
    move_uploaded_file($tempname, "../dataimg/$imagename");
    $qry="INSERT INTO `student`(`rollno`, `name`, `city`, `pcont`, `standerd`, `image`) VALUES ('$rollno','$name','$city','$pcon','$stu', '$imagename')";
    $run=mysqli_query($con, $qry);
    if($run==TRUE){
        ?>
<script>alert('data inserted sucessfully');</script>
<?php
    }
}
?>