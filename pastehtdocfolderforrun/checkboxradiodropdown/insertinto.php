
<h2>hello sir</h2>

<?php
include 'db.php';

$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];

$country=$_POST['dropdown'];
$state=$_POST['dropdown1'];
$gender=  $_POST['gender'];
$courses=$_POST['courses'];	// it return array because it recieve array from checkbox name value
$b=implode(",", $courses);



$imgnm=$_FILES['uploadfile']['name'];
$fold="user/".$imgnm;

$tempimg=$_FILES['uploadfile']['tmp_name'];

move_uploaded_file($tempimg, $fold);

$query="insert into user(name, email, password, country, state, gender, courses, image) values('$name', '$email', '$password', '$country', '$state', '$gender', '$b', '$fold')"; 
if(mysqli_query($conn, $query))
{
echo "Records inserted successfully.";	
//header("location: login.php");

} else{
echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
}



?>
