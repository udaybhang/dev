<style>
.pagination-dive li {
    list-style: none;
    display: inline-block;
}
.pagination-dive a:hover, .pagination-dive .active a {
    background: #040404;
}

.pagination-dive a {
    display: inline-block;
    height: initial;
    background: #939890;
    padding: 10px 15px;
    border: 1px solid #fff;
    color: #fff;
}
</style>

<div class="container">

<?php 

if($this->session->flashdata('msg'))
{

 echo $this->session->flashdata('msg');

}

if($this->session->userdata('name'))
{
echo "helo M.r".$this->session->userdata('name');
echo "helo M.r".$this->session->userdata('email');
?>
<section>
<form method="post" action="<?php  echo base_url().'A_crudexport/export' ?>">
	<input type="submit" name="submit" value="Export" class="btn btn-info">
</form>
<table class="table table-reponsive table-stripped">
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Message</th>
			
			<th>status</th>
			<th>image</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		// print_r($perpagerecord);
		$count=$this->uri->segment(4); // it print all id value always in seq
		foreach($perpagerecord as $row)
		{
				?>
		<tr>
			<td><?php echo ++$count; ?></td>
			<td><?php echo $row->name; ?></td>
			<td><?php echo $row->email; ?></td>
			<td><?php echo $row->phone; ?></td>
			<td><?php echo $row->message; ?></td>
			<td><?php echo $row->status; ?></td>
			<td><?php echo $row->image; ?></td>
			
			<td><a class="btn btn-success" href="<?php echo base_url().'update/'.$row->id;  ?>">Update</a>
				<a class="btn btn-danger"  href="<?php echo base_url().'delete/'.$row->id; ?>">Delete</a>
			</td>
		</tr>
		<?php
	
		}
		?>
	</tbody>
	<!-- <?php //echo $this->pagination->create_links(); ?> -->
</table>

  <div class="pagination-dive" >
<?php echo $nav; ?>
</div>
</section>
<?php

} 
else
{
	redirect('register');
}


?>
</div>
