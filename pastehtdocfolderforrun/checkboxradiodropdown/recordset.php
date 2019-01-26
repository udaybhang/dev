<html>
<head><style>th,td{ padding: 10px;
	border:2px solid orange;
	text-align: center;
	}</style></head>
<body>
	<center>
<?php
include 'db.php';
session_start();
if(isset($_SESSION['user_name'])){ 
echo "hello".$_SESSION['user_name'];
?>
<table  style="border: 1px solid green;">
    <tr>
		<th>id</th>
		<th>name</th>
    <th>email</th>
    <th>password</th>
    <th>country</th>
    <th>state</th>  
    <th>gender</th>
     <th>courses</th>
     <th>images</th>
    <th colspan="2">operations</th></tr>
    <?php 
$query="select * from user";
$run= mysqli_query($conn, $query); //  it return true or false

$total=mysqli_num_rows($run);
if($total!=0)
{
	while ($result=mysqli_fetch_assoc($run))
	{
   echo "<tr>
   <td>  ".$result['id']."  </td>
   <td>   ".$result['name']."  </td>
   <td>   ".$result['email']."   </td>
   <td>   ".$result['password']."   </td>
   <td>  ".$result['country']."   </td>
   <td>   ".$result['state']."   </td>
   <td>   ".$result['gender']."  </td>
   <td>   ".$result['courses']."   </td>
    <td>    ".$result['image']."    </td>
<td><a href='update.php?id=$result[id]'>edit/update</a></td>
<td><a href='delete.php?id=$result[id]'>delete</a></td>                    
                </tr>";              
	}
}
?>
    </table>
            <button style="padding:12px; background-color:green"><a href="logout.php" style="text-decoration:none;">logout</a></button>
<?php
}

 else{ 
	header('location: login.php');
  } 
  ?>
</center>


