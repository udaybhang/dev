<?php
include 'db.php';
$id=$_REQUEST['id'];
$query="delete from user where id='$id'";
$data=mysqli_query($conn, $query);
if($data)
{
    echo "<font color='green'>record deleted sucessfully"; 
    ?>
<meta http-equiv="refresh" content="0; url=recordset.php">
<?php
}
else{
    echo "<font color='red'>deletion failed"; 
}
?>
