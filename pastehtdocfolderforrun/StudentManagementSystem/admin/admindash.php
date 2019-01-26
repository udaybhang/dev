<?php
session_start();
if(isset($_SESSION['uid']))
{
    //echo $_SESSION['uid'];
}
else{
    header('location: ../login.php');
}

?>
<?php
include 'header.php';
?>
<head><style>td{ padding: 8px; text-transform: capitalize; font-size: 20px; text-align: center;
        }</style></head>
<body bgcolor="yellow">
<div>
   
    <h1 class="admintitle" align="center" style="position:relative;">Wlcome To Admin DashBoard</h1>
    <h4><a href="logout.php"  style="position:relative; margin-top: -100px; margin-right: 20px; float: right; color: white; font-size: 20px;">logout</a></h4>
</div>
     <h2 align="center">Manage Student Information</h2>
<div class="dashboard">
   
    <table border="1" align="center" width="50%">
        
        <tr><td>1.</td><td><a href="addstudent.php">add student detail</a></td></tr>
        <tr><td>2.</td><td><a href="updatestudent.php">update student detail</a></td></tr>
        <tr><td>3.</td><td><a href="deletestudent.php">delete student detail</a></td></tr>
    </table>
    
</div>
</body>


