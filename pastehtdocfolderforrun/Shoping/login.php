
<?php
include 'db.php';
session_start(); 
if(isset($_POST['userLogin'])){
    $email=mysqli_real_escape_string($con, $_POST['userEmail']);
    //$pass= md5($_POST['userPassword']);
    $pass= $_POST['userPassword'];
    $sql="select * from user_info where email='$email' AND password='$pass'";
    $run_qry=mysqli_query($con, $sql);
    $count=mysqli_num_rows($run_qry);
    if($count==1){
        $data= mysqli_fetch_assoc($run_qry);
        $_SESSION['uid']= $data['user_id'];
        $_SESSION['name']= $data['first_name'];
        echo "hello";
       
    }
}
?>