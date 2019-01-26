<?php include 'class/users.php';
$email=$_SESSION['email'];
$profile=new users;
$profile->users_profile($email);
//print_r($profile->data);
?>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
<h2>Online Quiz in php</h2>
<ul class="nav nav-tabs">
<li class="active"><a data-toggle="tab" href="#home">Home</a></li>
<li><a data-toggle="tab" href="#menu1">Profile</a></li>
<li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
<li  style="float: right;"><a data-toggle="tab" href="#menu3">LogOut</a></li>
</ul>

<div class="tab-content">
<div id="home" class="tab-pane fade in active">
<h3>HOME</h3>

<center><button data-toggle="tab" href="#select" type="button" class="btn btn-primary">Start quiz</button></center>

<div class="col-sm-4"></div>
<div class="col-sm-4">
<div id="select" class="tab-pane fade">
<form method="post" action="qus_show.php">
<select class="form-control" name="cat">
<option >select category</option>        
<?php $profile->cat_show();
foreach($profile->cat as $category){
?>

<option value="<?php  echo $category['id']; ?>"><?php echo $category['cat_name']; ?></option> 

<?php
}
?> 

</select> 
<input type="submit" value="submit" class="btn btn-info">
</form>           
</div>
<div class="col-sm-4"></div>
</div>
</div>
<div id="menu1" class="tab-pane fade">
<h3>Showing profile</h3>
<table class="table">
<thead><tr>
<th>id</th>
<th>name</th>
<th>email</th>
<th>image</th>
</tr></thead>
<tbody>
<?php foreach ($profile->data as $prof){
?> <tr>
<td><?php echo $prof['id']; ?></td>
<td><?php echo $prof['name']; ?> </td>
<td><?php echo $prof['email']; ?> </td>
<td><img src="img/<?php echo $prof['image']; ?>" alt="show" width="200" height="70"> </td>
</tr></tbody>   <?php    
}
?>

</table>
</div>
<div id="menu2" class="tab-pane fade">
<h3>Menu 2</h3>
<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
</div>
<div id="menu3" class="tab-pane fade">
<h3>Menu 3</h3>
<p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
</div>
</div>
</div>

</body>
