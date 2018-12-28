<!DOCTYPE html>
<html>
<head>
	<title>ajax crud modal</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css' ?>">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  	$(document).ready(function(){
  		$(document).on('submit', '#user_form', function(event){
  			event.preventDefault();
  			var firstName=$('#first_name').val();
  			var lastName=$('#last_name').val();
if(firstName!=''  && lastName!='')  			{
$.ajax({
	url:"<?php echo base_url().'M_main/user_action'  ?>",
	method:"post",
	data: new FormData(this),
	contentType:false,
	processData:false,
	success:function(data)
	{
		// alert(data);
		$('#user_form')[0].reset();
		$('#userModal').modal('hide');
		dataTable.ajax.reload();

	}


})
}
else
{
	alert('both field are required');
}
  		})
  		$(document).on('click', '.update', function(){
  			var user_id=$(this).attr("id");
  			$.ajax({
  				url:"<?php echo base_url().'M_update/fetch_single_user' ?>",
  				method: "post",
  				data:{user_id:user_id},
  				dataType:"json",
  				success:function(data)
  				{
  					$('#userModal').modal('show');
  					$('#first_name').val(data.first_name);
  					$('#last_name').val(data.last_name);
  					$('.modal-title').text("Edit User");
  					$('#user_id').val(user_id);
  					$('#action').val("Edit");

  				}
  			})
  		})
  	})
  </script>
</head>
<body>
<div class="container">
	<button class="btn btn-primary btn-lg" data-target="#userModal" data-toggle="modal">Add user</button>
	<table class="table table-responsive table-bordered">
		<thead>
			<tr>
				<th width="30%">first name</th>
				<th width="40%">last name</th>
				<th width="20%">edit</th>
				<th width="10%">delete</th>
			</tr>
		</thead>

	</table>

</div>
</body>
</html>
<div id="userModal" class=" modal modal-fade">
	<div class="modal-dialog">
		<form method="post" id="user_form">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal" >&times;</button>
				<h4 class="modal-title">add uaser</h4>
			</div>
			<div class="modal-body">
				
					<label>First name</label>
					<input type="text" name="first_name" id="first_name" class="form-control">
					<label>Last name</label>
					<input type="text" name="last_name" id="last_name" class="form-control">
					
				
			</div>
			<div class="modal-footer">
<input type="hidden" name="user_id" id="user_id">					
				<input type="submit" name="action" value="Add" class="btn btn-success">
				<button type="button" data-dismiss="modal" class="btn btn-primary">Close</button>
			</div>
			
		</div>
		</form>
	</div>
</div>