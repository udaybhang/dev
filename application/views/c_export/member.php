<style>
	input{
		margin: 15px;
	}
</style>
<div class="container">
<form action="<?php echo base_url().'export';  ?>" method="post">
	<input type="submit" name="export" class="btn btn-success" value="Export">
</form>	
	<table class="table table-stripped table-bordered">
		<thead>
			<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Message</th>
			<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
            $count=1;
			foreach ($user as $row) {
				?>
				<tr>
				<td><?php echo $count;  ?></td>
				<td><?php echo $row['name'];  ?></td>
				<td><?php echo $row['email'];  ?></td>
				<td><?php echo $row['mobile'];  ?></td>
				<td><?php echo $row['message'];  ?></td>
				<td style="width:18%;"><a href="" class="btn btn-info">Update</a><a href="" class="btn btn-danger">Delete</a></td>
			</tr>
			<?php
			$count++;
			} 

			?>
			

				
			
		</tbody>
		
	</table>
</div>