<!DOCTYPE html>
<html>
<head>
	<title>modal</title>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  	$(document).ready(function(){
  	$(document).on('submit', '#user_form', function(event)
  	{
  		event.preventDefault();
  		// alert karaoge to dikhega
  		var name=$('#name').val();
  		var email=$('#email').val();
  		var phone=$('#phone').val();
  		if(name!='' && email!='' && phone!='')
  		{
  			$.ajax({
  				url:"<?php echo base_url().'C_popupcrud/add' ?>",
  				method:"post",
  				data:{'name':name, 'email':email, 'phone':phone},
  				success: function(data)
  				{
  					$('#user_form')['0'].reset();
  					$('#addmodal').modal('hide');
  				}
  			})
  		}
 
  	})
  	$(".updet").click(function(){
  		 // alert('ghgh'); work well
 	var id=$(this).attr("id");
 //alert(id); // work well
$.ajax({
	url: "<?php echo base_url().'C_popupcrud/fetch_single'; ?>",
	method:"POST",
	data:{id:id},
		success:function(data)
	{   
		
  			$('#resut').html(data);		
  		}
})
})


$(document).on('click', ".update", function(){
  		
  		var id=$(this).attr('id');
  		//alert(id); // work well
  		var name=$("#name1").val();
  		var email=$("#email1").val();
  		var phone=$("#phone1").val();
  		// alert(name);	// work well
   // variable write  bethought inverted comma
$.ajax({
	url: "<?php echo base_url().'C_popupcrud/update'; ?>",
	method:"POST",
	data:{'id':id, 'name':name, 'email':email, 'phone':phone},
	 // dataType:"json",
	success:function(data)
	{   
		//alert(data);
		$('#msg').html(data);
		$('#updatemodal').modal('hide');    // agar jquery se response aa rha hai to controller se set_flashdata nahi lakar show kara sakte isko jquery ke function me $('#msg').html(data); se dikhaye  data me jo echo karaye hoge controller me vo dikhega
		// $('#msg').text('data updated sucessfully'); // ya yevall directly likh ke bhi dikha sakte haii
  	}
})
})

//delete code
$(".delete").click(function()
{
var id = $(this).attr('id');
//alert(id); // work well
$.ajax({
	url: "<?php echo base_url().'C_popupcrud/delete'; ?>",
	type: 'POST',
	data: {'id': id},
	success:function(data)
	{
$('#msg').html(data);
	}
})
})
})
 </script>
</head>
<body>
<div class="container">
<div id="msg"></div>
	<h2>Modal example</h2>
	<!-- button not written in anchor tag -->
	<button class="btn btn-primary" data-toggle="modal" data-target="#addmodal">Add User</button>
<!-- modal -->
<div  id="addmodal" class="modal modal-fade">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">ADD User</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form method="post" id="user_form">
					<div class="input-group">
						<label>Name:</label>
						<input type="text" name="name" class="form-control" id="name">
					</div>
					<div class="input-group">
						<label>Email:</label>
						<input type="text" name="email" class="form-control" id="email">
					</div>
					<div class="input-group">
						<label>Phone:</label>
						<input type="number" name="Phone" class="form-control" id="phone">
					</div>
					<input type="hidden" name="hidden_id">
					<input type="submit" name="submit" value="Add" id="insert">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- display record table -->
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>name</th>
			<th>email</th>
			<th>phone</th>
			<th width="20%">action</th>
		</tr>
	</thead>
	<tbody>
		 <?php  
			foreach($user as $row)
			{
?>
<tr>
			<td><?php  echo $row['name']; ?></td>
			<td> <?php  echo $row['email']; ?></td>
			<td> <?php  echo $row['phone']; ?></td>
			<td><button type="button"  data-toggle="modal" data-target="#updatemodal" id="<?php echo $row['id']; ?> " class="btn btn-primary updet" >Update</button>
			<button type="button"  id="<?php echo $row['id']; ?> " class="btn btn-primary delete" >delete</button>
			</td>
		</tr>
<?php
}
		?>
	</tbody>
</table>
</div>

<div  id="updatemodal" class="modal modal-fade">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Update User</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			

<div class="modal-body" id='resut'>
				<!-- <form method="post" id="update_form">
					<div class="input-group">
						<label>Name:</label>
		<input type="text" name="name" class="form-control" id="name1" value="">
		</div>
		<div class="input-group">
		<label>Email</label>
		<input type="text" name="email" class="form-control" id="email1" value="">
		</div>
		<div class="input-group">
		<label>Phone</label>
		<input type="number" name="Phone" class="form-control" id="phone1" value="">
		</div>
		<button type="button" name="update"  id="update" class="btn btn-success">Update</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		
	</form> -->

			</div>

			
		</div>
	</div>
</div>
</body>
</html>