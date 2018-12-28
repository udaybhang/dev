<!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title></title>
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
           <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 
 </head>
 <body>
 	<div style="margin-top: 100px;">
 	<div class="container" style="border: 1px solid red; padding: 0px;"> 
 		<div style="height: 40px; background-color: green; position: relative; top: -20px;  ">
 			<h2 style="text-align: center; color: white; line-height: 40px;">Serch data by Date Range</h2>
 		</div>
    <div class="row">

    	<div class="col-md-8 col-md-offset-2">
    		<div class="col-md-3">
    			<div class="form-group">
    			<label for="">Select&nbsp;Date&nbsp;From</label>
    			<input type="text" name="from_date" id="from_date" class="form-control">
    		</div>
    		</div>
    		<div class="col-md-3">
    			<div class="form-group">
    			<label for="">Select&nbsp;Date&nbsp;To</label>
    			<input type="text" name="to_date" id="to_date"  class="form-control">
    		</div>
    		</div>
    		<div class="col-md-2" style="padding-left: 0px;">
    		
    				<input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" style="margin-top: 25px;">
    		
    			
    		</div>
    	</div>
    	<div class="col-md-2"></div>
    </div>
    <!-- row End -->
    <div class="row">
    	<div class="col-md-10 col-md-offset-2">
    		<table class="table table-responsive table-bordered table-striped" >
    			<thead>
    				<tr>
    					<th width="30%">name</th>
    					
    					<th width="60%">date to</th>
    					<th width="10%">status</th>
    				</tr>
    			</thead>
    			<tbody id="order_table">
    			<?php foreach($user as  $row) 
    			{
    				?>
    				<tr>
    					<td><?php echo $row['name']; ?></td>
    					
    					<td><?php echo $row['date_to']; ?></td>
    					<td><?php echo $row['status']; ?></td>
    				</tr>
    				<?php
    			}
    				?>
    				
    			</tbody>
    		</table>
    	</div>
    </div>
 	</div>
 	</div>
 	<script>
$(document).ready(function()
{
	//alert();
	$.datepicker.setDefaults({
		dateFormat: 'yy-mm-dd'
	});
	$(function()
	{
		$("#from_date").datepicker();
		$("#to_date").datepicker();
	});
	$('#filter').click(function()
	{
		var from_date=$("#from_date").val();
		var to_date=$("#to_date").val();
		// alert(from_date);
		if(from_date!='' && to_date!='')
		{
			$.ajax({
				url:"<?php echo base_url().'A_showpassword/fetch_date_range'  ?>",
				method:"POST",
				data:{from_date:from_date, to_date:to_date},
				// dataType:"text",
				success:function(data)
				{
                 $("#order_table").html(data);
				}
			});
		}
		else{
			alert("please select date");
		}
	});
});
 	</script>
 </body>
 </html>