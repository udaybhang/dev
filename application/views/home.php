<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title></title>
</head>
<body>

</body>
</html>
<?php 

if($this->session->userdata('email'))

{
?>
<center><h3>welcome to my page</h3></center>
<?php echo "hello ".$this->session->userdata('email');  ?>
<p align="center"><a href="<?php echo base_url().'Session_expire_loader/logout'  ?>">Log out</a></p>
<?php

}
else{
	redirect('login');
} 

?>
<div class="modal fade" id="loginModal" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
		<div class="modal-header">
			<div class="modal-title">
				<h2>Sign Up</h2>
			</div>
		</div>
		<div class="modal-body">
			<form id="login_form" method="post">
		<div class="form-group">
			<label>Email:</label>
			<input type="text" name="email" class="form-control" id="email">
		</div>
		<div class="form-group">
			<label>Password:</label>
			<input type="password" name="password" class="form-control" id="password">
		</div>
			<input type="submit" name="submit" value="Login" id="submit" class="btn btn-info">
	</form>
		</div>
	</div>
	</div>
</div>
<script>  
$(document).ready(function(){
 
 var is_session_expired = 'no';
    function check_session()
    {
        $.ajax({
            url:"<?php echo base_url().'Session_expire_loader/check_session'  ?>",
            method:"POST",
            success:function(data)
            {
    if(data == '1')
    {
     $('#loginModal').modal({
      backdrop: 'static',
      keyboard: false,
     });
     is_session_expired = 'yes';
    }
   }
        })
    }
 
 var count_interval = setInterval(function(){
        check_session();
  if(is_session_expired == 'yes')
  {
   clearInterval(count_interval);
  }
    }, 10000);

 $('#login_form').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"<?php echo base_url().'check-login';  ?>",
   method:"POST",
   data:$(this).serialize(),
   success:function(data){
    if(data != '')
    {
     $('#error_message').html(data);
    }
    else
    {
     window.location='<?php echo base_url().'home'   ?>';
    }
   }
  });
 });

});  
</script>