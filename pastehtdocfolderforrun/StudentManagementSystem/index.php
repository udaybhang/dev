<head>
<title>Stument Management</title>
<style>td, th{ text-align: center; font-size: 20px; padding: 5px; text-transform: capitalize; }</style>
</head>
<body>
    <h5 align="right"><a href="login.php">Admin Login</a></h5>
    <h1 align="center">Welcome</h1>
    <form method="post">
        <table border="1" align="center">
            <tr><td colspan="2" align="center">Student Information</td></tr>
            <tr><td>Choose Standered</td>
                        <td><select name="std">
                                <option value="9">9st</option>
                                 <option value="10">10st</option>
                                  <option value="11">11st</option>
                                   <option value="12">12st</option>
                                    <option value="13">13st</option>
                                     <option value="14">14st</option>
                    </select></td>
<!--            <tr>  <td>standered</td><td><input type="text" name="std" required=""></td>
            </tr>-->
            <tr><td>Enter Roll No</td>
                <td><input type="text" name="rollno" required=""></td></tr>
            <tr><td colspan="2" align="center"><input type="submit" name="submit" value="ShowInfo" style="padding:7px; background-color: green;"></td></tr>
        </table>
    </form>
</body>
<?php  if(isset($_POST['submit'])){
    $standerd=$_POST['std'];

    $rollno=$_POST['rollno'];
    include 'dbcon.php';
  
 
    $sql="SELECT * FROM `student` WHERE `rollno`='$rollno' AND `standerd`='$standerd'";
   
    $run=mysqli_query($con, $sql);
   
    if(mysqli_num_rows($run)>0){
        $data=mysqli_fetch_assoc($run);
        ?>
<table border="1" align="center" width="45%"><tr><th colspan="3" style="font-size: 20px; background-color: coral;">Student detail</th></tr>
    <tr>
        <td rowspan="5" align="center"><img src="dataimg/<?php echo $data['image']; ?>" style="max-height: 150px; max-width: 120px;" ></td>
        <th>Roll No</th><td><?php echo $data['rollno']; ?></td></tr>
<tr>
        <th>name</th><td><?php echo $data['name']; ?></td></tr>
<tr>
        <th>standered</th><td><?php echo $data['standerd']; ?></td></tr>
<tr>
        <th>parant contact</th><td><?php echo $data['pcont']; ?></td></tr>
<tr>
        <th>city</th><td><?php echo $data['city']; ?></td></tr>
</table>
            <?php
    }
    else{

echo"<script>alert('no data found');</script>";

    }
}

    
    
 ?>