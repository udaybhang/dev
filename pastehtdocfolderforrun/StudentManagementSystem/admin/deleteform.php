
<?php
include '../dbcon.php';

    $id=$_GET['sid'];
    $qry="DELETE FROM `student` WHERE `id`='$id'";
    $run=mysqli_query($con, $qry);
    if($run){
        ?>
<script>alert('data deleted sucessfully');
    window.open('deletestudent.php', '_self');
    </script>

<?php
          
    }

?>

