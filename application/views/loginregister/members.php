				<!DOCTYPE html>
				<html>
				<head>
				<title> </title>
				<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css' ?>">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
				</head>
				<body>

				<div class="container">
				<nav class="navbar navbar-default">
				<div class="container-fluid">
				<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Brand</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
				<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
				<li><a href="#">Link</a></li>
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
				<li><a href="#">Action</a></li>
				<li><a href="#">Another action</a></li>
				<li><a href="#">Something else here</a></li>
				<li class="divider"></li>
				<li><a href="#">Separated link</a></li>
				<li class="divider"></li>
				<li><a href="#">One more separated link</a></li>
				</ul>
				</li>
				<li><a href="<?php  ?>">Contact Us</a></li>
				</ul>
				<form class="navbar-form navbar-left" role="search">
				<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
				</form>
				<ul class="nav navbar-nav navbar-right">
				<li><a href="#">Link</a></li>
				</ul>
				</div>
				</div>
				</nav>
				<h1>member page</h1>
				<form method="post">
				<fieldset>
				<legend>Contact Us</legend>
				<div class="form-group">
				<label for="nm" class="col-lg-2 control-label" align="right">Name:</label>
				<div class="col-lg-10">
				<input type="text" class="form-control" id="nm" placeholder="Enter your name">
				</div>
				</div>
				<div class="form-group">
				<label for="phn" class="col-lg-2 control-label" align="right">Phone:</label>
				<div class="col-lg-10">
				<input type="number" id="phn" class="form-control"  placeholder="Enter your number">
				</div>
				</div>
				<div class="form-group">
				<label for="textArea" class="col-lg-2 control-label" align="right">Message:</label>
				<div class="col-lg-10">
				<textarea class="form-control" rows="3" id="textArea"></textarea>
				</div>
				</div>
				<p>&nbsp;</p>
				<div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
				<button type="submit" class="btn btn-primary">Contact Us</button>
				<a href="<?php echo base_url().'M_login/logout'  ?>" class="btn btn-success">Logout</a>	  
				</div>
				</div>
				</fieldset>
				</form>
				<?php 
				// echo "<pre>";
				// print_r($this->session->all_userdata());
				// echo "</pre>";
				?>
				<div style="margin-left: 180px; margin-top: 30px;">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3596.092939264013!2d83.72602811460581!3d25.668213683679355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399205a84e760763%3A0xc0af04ffc2e7d01!2sHanuman+Mandir+Pradhan+ki+Bareji!5e0!3m2!1sen!2sin!4v1534088279151"  width="80%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				</div>
				<footer style="background-color: brown; height: 100px; margin-top: 20px;"></footer>
				</body>
				</html>