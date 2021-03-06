<?php 
error_reporting(0);

session_start();
if(!isset($_SESSION['uid'])){
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Gupta Store</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="main.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container-fluid">
<div class="navbar-header">
<a class="navbar-brand" href="#">Gupta Store</a>
</div>
<ul class="nav navbar-nav">
<li class="active"><a href="#" ><span class="glyphicon glyphicon-home"></span>Home</a></li>
<li class="dropdown"><a class="dropdown-toggle  data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-modal-window"></span>Product<span class="caret"></span></a>

</li>
<li><a href="#">Page 2</a></li>
<li class="nav-item" style="width: 300px;  margin-left:  10px; margin-top: 10px;" >
<input type="text" class="form-control" id="search">
</li>
<li class="nav-item"  style=" margin-left:  20px; margin-top:10px;">
    <button  class="btn btn-primary" id="search_btn">search </button>>
</li>
</ul>
<ul class="nav navbar-nav navbar-right">
    <li class="dropdown"><a class="dropdown-toggle" id="cart_container" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart<span class="badge" id="c_item">0</span></a>
<div class="dropdown-menu" style="width:400px;">
<div class="panel-sucess">
<div class="panel-heading">
<div class="row">
<div class="col-md-3">SerialNo</div>
<div class="col-md-3">Product_img</div>
<div class="col-md-3">Product_name</div>
<div class="col-md-3">Prise</div>
</div>
</div>
<div class="panel-body">
    <div id="cart_product">
<!--<div class="row">
<div class="col-md-3">SerialNo</div>
<div class="col-md-3">Product_img</div>
<div class="col-md-3">Product_name</div>
<div class="col-md-3">Prise</div>
</div> -->
 </div>
</div>
<div class="panel-footer" id="e_msg">

</div>  
</div>
</li>
<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span><?php  echo "Hi ".$_SESSION['name']; ?></a>
<ul class="dropdown-menu">
    <li><a href="cart.php" class="glyphicon glyphicon-shopping-cart">Cart</a></li>
    <li class="divider"></li> <!--use for horizental line and padding between-->
    <li><a href="#" class="">Change password</a></li>
     <li class="divider"></li>
    <li><a href="logout.php" class="">Logout</a></li>
</ul>
</li>

</ul>
</div>
</nav>

<p><br></p>
<p><br></p>
<p><br></p>
<div class="container-fluid">
<div class="row">
<div class="col-md-1" style="background-color:pink;"></div>
<div class="col-md-2" style="background-color:yellow;">
<div id="get_category"></div>

<div id="get_brand"></div>

</div>
<div class="col-md-8" style="background-color:green;">
    <div class="row">
        <div class="col-md-12" id="product_msg"></div>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">Product
            <div class="panel-body">
               
                <div id="get_product"></div>

            </div>
        </div>
    </div>
</div>
<div class="col-md-1" style="background-color:red;"></div>
</div>
</div>

</body>
</html>

