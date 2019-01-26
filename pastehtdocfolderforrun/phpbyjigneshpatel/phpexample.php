<style>
     td
    {
        font-size: 40px;
        background: yellow;
        padding: 15px;
    }
    input{
        padding: 10px;
    }
    th{
         font-size: 40px;
        background: green;
        padding: 15px;
    }
</style>
<?php
$link= mysqli_connect('localhost', 'root', '', 'example');
$query="select * from user";
$result=mysqli_query($link, $query);
$rowcount=mysqli_num_rows($result);

?>
<center>
    <h2>User information fetch from database</h2>
<table border='1'>
    <tr><th>id</th>
    <th>username</th>
    <th>password</th>
    <th>address</th>
    <th>gender</th>
    <th>country</th>
    <th>education</th>
    <th>file</th>
    <?php for($i=1; $i<=$rowcount; $i++)
    {
     $rows=mysqli_fetch_array($result);
    ?>
    </tr>
    <tr><td><?php echo $rows['id'] ?></td>
    <td><?php echo $rows['username'] ?></td>
    
    <td><?php echo $rows['password'] ?></td>
    <td><?php echo $rows['address'] ?></td>
    <td><?php echo $rows['gender'] ?></td>
    <td><?php echo $rows['country'] ?></td>
    <td><?php echo $rows['education'] ?></td>
    <td><img src="<?php echo $rows['file'] ?>" alt="image" height="100px" width="100px"></td></tr>
    
    <?php } ?>
</table>
</center>