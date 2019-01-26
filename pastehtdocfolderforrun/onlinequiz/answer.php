<?php include 'class/users.php';
//$email=$_SESSION['email'];
$ans=new users;
$ans->answer($_POST);
//print_r($profile->data);
?>
