<?php
include 'db.php';
$fname=$_POST['f_name'];
$lname=$_POST['l_name'];
$email=$_POST['email'];
//$password=md5($_POST['password']); // work 100%
//$repassword=md5($_POST['repassword']); // work 100%
$password=$_POST['password'];
$repassword=$_POST['repassword'];
$mobile=$_POST['mobile'];
$address1=$_POST['address1'];
$address2=$_POST['address2'];
$name="/^[A-Z][a-zA-Z]+$/";
$emailvalidation="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
$mnumber="/^[0-9]+$/"; // it accept onlry any digit  from 0 to 9;
if(empty($fname) || empty($lname) || empty($email) ||empty($password) || empty($repassword) || empty($mobile) || empty($address1) || empty($address2)){
    echo "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>please fill out fiels ..!</b>"; //&times reprisent cross sign
}
 else {
  if(!preg_match($name, $fname)){
   // echo $fname.' is not valid';
      echo "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>$fname is not valid</b>";
    exit();
}
if(!preg_match($name, $lname)){
    //echo $lname.' is not valid';
    echo "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>$lname is not valid</b>";
    exit();
}
if(!preg_match($emailvalidation, $email)){
    //echo $email.' is not valid';
    echo "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>$email is not valid</b>";
    exit();
}
if(strlen($password)<8){
    echo "password is weak";
    exit();
}
if(strlen($repassword)<8){
    echo "password is weak";
    exit();
}
if($password!=$repassword){
    echo "password is not match";
    exit();
}
if(!preg_match($mnumber, $mobile)){
    echo $mobile.' is not valid';
    exit();
}  
$check_query="select * from user_info where email='$email'";
$result=mysqli_query($con, $check_query);
$count=mysqli_num_rows($result);
if($count>0){
    echo "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>$email is already available</b>";  
    exit();
}
else{
    $passmd5=md5($password);
    $sql="INSERT INTO `user_info` (`first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`) VALUES ('$fname', '$lname', '$email', '$passmd5', '$mobile', '$address1', '$address2')";
    $run_query=mysqli_query($con, $sql);
    if($run_query){
        echo 'registered sucessfully';
    }
}
}

?>
