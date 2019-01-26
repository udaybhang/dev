<?php
include 'class/users.php';
$register=new users;
extract($_POST);
$image_name=$_FILES['upload']['name'];
$tmp_name=$_FILES['upload']['tmp_name'];
move_uploaded_file($tmp_name, "img/".$image_name);
$query="INSERT INTO `signup`(`id`, `name`, `email`, `password`, `image`) VALUES ('', '$name', '$email', '$password', '$image_name')";
print_r($query); 
if($register->signup($query)){
    $register->url("index.php?run=sucess");
}
?>
