<?php
include '../dbcon.php';
if(isset($_POST['submit']))
{
    $rollno=$_POST['rollno'];
    $name=$_POST['name'];
    $city=$_POST['city'];
    $pcon=$_POST['pcon'];
    $stu=$_POST['stu'];
     $id=$_POST['sid'];
    $imagename=$_FILES['simg']['name'];
    $tempname=$_FILES['simg']['tmp_name'];
    move_uploaded_file($tempname, "../dataimg/$imagename");
    $qry="UPDATE `student` SET `rollno` = '$rollno', `name` = '$name', `city` = '$city', `pcont` = '$pcon', `standerd` = '$stu', `image` = '$imagename' WHERE `student`.`id` = $id";
    $run=mysqli_query($con, $qry);
    if($run){
        ?>
<script>alert('data updated sucessfully');
    
window.open('updateform.php?sid=<?php echo $id; ?>');
</script>

<?php
    }
}
?>

