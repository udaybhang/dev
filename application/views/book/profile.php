<head><link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css' ?>">
		
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function(){
 $("#btn_delete").click(function(){
     
    var bookId = $("#bookId").val();
     
 
        $.ajax({
		url: "<?php echo base_url(); ?>" + "Book/delete/",
		type: 'post',
		data: { "bookId": bookId },
		success: function(response) 
		{ 
		
		window.location.href = "<?php echo base_url('Book/profile'); ?>";
		}
 
});
});
	});
</script>
</head>

<div class="navbar navbar-default">
	<div class="container">
		<h2><span class="glyphicon glyphicon-home"></span>&nbsp;Welcome to my Home page</h2>
	</div>
</div>

<div class="container"><h3>User data fetch list using ajax</h3>
<a href="<?php echo base_url().'Book/index'; ?>" class="btn btn-primary">Add User</a>
<table class="table table-bordered table-responsive">
	<thead>
		<tr>
			<th>bookId</th>
			<th>bookTitle</th>
			<th>bookPrice</th>
			<th>Action</th>
			
		</tr>
	</thead>
	<tbody>
		<?php foreach($book as $row){
		?>
		<tr>
		<td><?php echo $row->bookId;  ?></td> <!-- yese hi access hoga yaha -->
		<td><?php echo $row->bookName;  ?></td>
		<td><?php echo $row->price;  ?></td>
		
		<td colspan="2"><a href="<?php echo base_url().'Book/update_book/'.$row->bookId; ?>" class="btn btn-info">edit</a>
		<a href="<?php echo base_url().'Book/delete/'.$row->bookId; ?>" class="btn btn-danger"  id="btn_delete" >delete</a></td>
		 <input type="hidden" name="hidden_id" id="bookId"  value="<?php echo $row->bookId;  ?>">
		</tr>
		<?php
		}
		?>
	</tbody>
</table>
</div>
