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
</ul>
</div>
</nav>
<p><br></p>
<p><br></p>
<p><br></p>
<div class="container-fluid">
<div class="row">
<div class="col-md-2" ></div>
<div class="col-md-8" id="signup_msg"></div>
<div class="col-md-2" ></div>
</div>
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<div class="panel panel-primary">
<div class="panel-heading">Customer SignUp Form</div>
<div class="panel-body">

<form method="post" >
<div class="row">
<div class="col-md-6">
<label for="f_name">First Name</label>
<input type="text" id="f_name" name="f_name" class="form-control">                                
</div>
<div class="col-md-6">
<label for="l_name">Last Name</label>
<input type="text" id="l_name" name="l_name" class="form-control">
</div>
</div>
<div class="row">
<div class="col-md-12">
<label for="email">Email</label>
<input type="text" id="email" name="email" class="form-control">                                
</div>
</div>
<div class="row">
<div class="col-md-6">
<label for="password">Password</label>
<input type="password" id="password" name="password" class="form-control">
</div>
<div class="col-md-6">
<label for="repassword">Re enter Password</label>
<input type="password" id="repassword" name="repassword" class="form-control">
</div>
</div>
<div class="row">
<div class="col-md-12">
<label for="mobile">Mobile</label>
<input type="text" id="mobile" name="mobile" class="form-control">                                
</div>
</div>
<div class="row">
<div class="col-md-12">
<label for="address1">Address Line 1</label>
<input type="text" id="address1" name="address1" class="form-control">                                
</div>
</div>
<div class="row">
<div class="col-md-12">
<label for="address2">Address Line 2</label>
<input type="text" id="address2" name="address2" class="form-control">                                
</div>
</div>
<p><br></p>
<div class="row">
<div class="col-md-12">

<input value="SignUp" style="float: right; " type="button" id="signup" class="btn btn-sucess" name="signup_button" >                                
</div>
</div>
</form>
<div class="panel-footer">sf</div>
</div>
</div>
<div class="col-md-2"></div>
</div>
</div>
</div>
</body>

</html>