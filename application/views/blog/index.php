<div class="navbar navbar-default">
	<div class="container">
		<h2><span class="glyphicon glyphicon-home"></span>&nbsp;Welcome to my blog</h2>
	</div>
</div>
<?php 
if($this->session->flashdata('msg'))
{
?>
<div class="alert alert-success"><?php echo $this->session->flashdata('msg'); ?></div>
<?php
}

?>
<?php 
if($this->session->flashdata('error'))
{
?>
<div class="alert alert-success"><?php echo $this->session->flashdata('error'); ?></div>
<?php
}

?>
<div class="container"><h3>Blog list</h3>
<a href="<?php echo base_url().'Blog/add'; ?>" class="btn btn-primary">Add User</a>
<table class="table table-bordered table-responsive">
	<thead>
		<tr>
			<th>id</th>
			<th>title</th>
			<th>description</th>
			<th>created at</th>
			<th colspan="2">action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($blog as $row){
		?>
		<tr>
		<td><?php echo $row->id;  ?></td> <!-- yese hi access hoga yaha -->
		<td><?php echo $row->title;  ?></td>
		<td><?php echo $row->description;  ?></td>
		<td><?php echo $row->created_at;  ?></td>
		<td><a href="<?php echo base_url().'Blog/edit/'.$row->id; ?>" class="btn btn-info">edit</a></td>
		<td><a href="<?php echo base_url().'Blog/delete/'.$row->id; ?>" class="btn btn-danger">delete</a></td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>
</div>
