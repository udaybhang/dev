<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<?php
if($this->session->flashdata('message'))
{

	echo $this->session->flashdata('message');
}
 ?>
	<h2>delete row status zero by check dependency using ajx jquery.</h2>
	<div class="row">

		<div class="col-md-6 col-md-offset-3">
			<div class="form-group">
				<label class="control-label">Find Employer Company</label>
				<select class="form-control" id="companylist">
					<option>--Select Company--</option>
					<?php
					foreach($com as $company)
					{
?>
<option value="<?php echo $company['employer_id']; ?>"><?php echo $company['employer_company']; ?></option>
<?php
					}
					?>
				</select>
			</div>
			<table  class="table table-bordered table-stripped">
				<thead>
					<tr>
						<th>Serial Number</th>
						<th>Job Title</th>
						<th>Company Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="list">
					
				</tbody>
			</table>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#companylist').change(function(){
			var indus_id= $(this).val();
			if(indus_id != ''){
				$.ajax({
					url:"<?php echo base_url().'admindashboard/A_deletecheckajax/fetchjobbycompanyajax'  ?>",
					method:"post",
					data:{indus_id:indus_id},
					success:function(data){
                     $('#list').html(data);
					}
				})
			}
		})
	})
</script>
<script>
	
		function doconfirm()
{
    job=confirm("Are you sure to delete permanently?");
    if(job!=true)
    {
        return false;
    }
}

</script>
</body>
</html>