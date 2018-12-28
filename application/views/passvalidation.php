<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="wrapper" style="margin: 50px;">
  <form method="post" action="<?php echo base_url().'submit-pass-validation'  ?>" id="forget-form" name="frm">
  <div class="form-group">
    <label>New Password</label>
    <input type="password" name="pass" class="form-control" id="pass">
  </div>
  <span class="passmsg" style="color: red;"></span>
  <div class="form-group">
    <label>Confirm Password</label>
    <input type="password" name="cpass" class="form-control" id="cpass">
  </div>
  <span class="cpassmsg" style="color: red;"></span>
  <br>
  <input type="submit" name="submit" value="submit" id="recover_submit">
</form>
</div>
</body>
</html>
<script type="text/javascript">

$('#recover_submit').click(function(){
  

 if(frm.pass.value == "")
{
  // alert("Enter the Password.");
  $(".passmsg").html("Enter the password");
  $(".passmsg").css("display","block");
  $(".cpassmsg").css("display","none");
  frm.pass.focus(); 
  return false;
}
if((frm.pass.value).length < 8)
{
  // alert("Password should be minimum 8 characters.");
  $(".passmsg").html("Password should be minimum 8 characters.");
  $(".passmsg").css("display","block");
  $(".cpassmsg").css("display","none");
  frm.pass.focus();
  return false;
}
if((frm.pass.value).length > 18)
{
  // alert("Password should be minimum 8 characters.");
  $(".passmsg").html("Password should be less than 18 characters.");
  $(".passmsg").css("display","block");
  $(".cpassmsg").css("display","none");
  frm.pass.focus();
  return false;
}



if(frm.cpass.value == "")
{
  // alert("Enter the Confirmation Password.");
   $(".cpassmsg").html("Enter the Confirmation Password.");
   $(".passmsg").css("display","none");
  $(".cpassmsg").css("display","block");
  
  return false;
}
if(frm.cpass.value != frm.pass.value)
{
  // alert("Password confirmation does not match.");
  $(".cpassmsg").html("Password confirmation does not match.");
  $(".cpassmsg").css("display","block");
  $(".passmsg").css("display","none");
  return false;
}

return true;
 })
$(document).on("input", function()
{
  $(".cpassmsg").html("");
  $(".passmsg").html("");
})
</script>