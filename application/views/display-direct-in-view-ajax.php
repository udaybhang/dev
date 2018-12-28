<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-7">
    <form method="post" name="frm" action="<?php echo site_url('Passvalidation/display_direct_in_view_ajax');   ?>">
      <div class="form-group">
        <select name="abc" id="abc" class="form-control">
          <option value="">select</option>
          <option value="0">pending</option>
          <option value="1" selected="selected">published</option>
          <option value="2">unpublished</option>
          <option value="3">ALL</option>
          
        </select>
        <input type="submit" name="submit" value="search" class="btn btn-info" id="search">
      </div>

    </form>
  </div>
  <div class="col-md-1"></div>
</body>
</html>
<script type="text/javascript">

$('#search').click(function(){
  
   var one=frm.abc.value;
   
$.ajax({
  type:"post",
  url:"<?php echo base_url().'ajax-view-query';   ?>",
  dataType:"json",
  data:{one:"one"},
  success: function(e)
  {

  }
})
 
 })
</script>