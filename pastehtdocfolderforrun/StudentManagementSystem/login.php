<?php session_start(); 
if(isset($_SESSION['uid']))// yadi ye pahle se set ho tabhi yeese admin dash par bhejo
    {
    header('location:admin/admindash.php');// use to if seesion created then if you type login.php then also load dashboard because session is created
}
?>
<title>Admin Login</title>
<head><style>td{text-transform: capitalize; font-size: 20px; padding: 8px; max-width: 60px; text-align: center;}
    input{ padding: 6px; font-size: 18px; }</style></head>
<body>
    <h1 align="center">Admin Login</h1>
    <form method="post">
        <table align="center" border="1" width="40%">
            <tr><td>User Name</td>
                <td><input type="text" name="uname" required=""></td>
            </tr>
             <tr><td>Password</td>
                 <td><input type="password" name="pass" required=""></td>
            </tr>
            <tr><td colspan="2" align="center"><input type="submit" name="login" value="Login"></td>
               
            </tr>
        </table>
        
        
    </form> 
</body>
<?php
include 'dbcon.php';
if(isset($_POST['login'])){
    $username= $_POST['uname'];
    $password= $_POST['pass'];
    $qry="select * from admin where username='$username' AND password='$password'";
    $run=mysqli_query($con, $qry);
    $row=mysqli_num_rows($run);
    if($row<1){
        ?>
<script>alert('username or password not match');</script>
<?php
        
    }
    else{
        $data=mysqli_fetch_assoc($run);
        $id=$data['id'];
        //echo $id;
        $_SESSION['uid']=$id;
        header('location: admin/admindash.php');
    }
}
?>
