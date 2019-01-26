<?php include("db.php"); ?>
<?php
$countryid=$_GET['country'];
if($countryid!=""){
$query= "select *from states where country_id=$countryid";
$result=mysqli_query($conn, $query);
echo $data= mysqli_num_rows($result);
if($data==0){
    echo "<option>----select---</option>";
    }
 else {
while($row= mysqli_fetch_array($result)){
    echo "<option>";    echo $row["state"]; echo "</option>";   
}

 }
}
?>
