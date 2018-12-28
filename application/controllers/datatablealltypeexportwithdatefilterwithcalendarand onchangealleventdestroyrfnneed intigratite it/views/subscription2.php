<style>
/*	#example_wrapper > div.dt-buttons{
		margin-left: 10px!important;
	}
	#example_filter > label{
		display:none!important;
	}
	/*.intro{
		display:none!important;
	}*/
/*	#example_paginate > ul{
		display:none;
	}*/
</style>


<!--date range picker -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
           <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 
<!--date range picker end-->
<!--m-->

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<div class="row" style="margin: 12% 0 5% 0;">
	<div class="col-md-10 col-md-offset-2">
		<div class="container" style="border: 1px solid lightgray; padding: 0px;"> 
 		<div style="height: 40px; background-color: green; position: relative; top: -22px;">
 			<h2 style="text-align: center; color: white; line-height: 40px;">Invoice Detail</h2>
 		</div>
 		<div class="row">
 			<div class="col-md-6">	
	<!-- <form action="" autocomplete="off" method="post" class="form-inline" style="margin-left: 10px;"> -->
		<!-- <?php //echo base_url()?>date-filter ?> -->
	             <!-- /.form-group -->
	             <!--  <div class="form-group" id="formextension">
	              	<label for="">Date Filter:&nbsp;</label>
	              	<input type="text" name="daterange" id="daterange" value="" class="form-control" />
	              	<input type="button" name="search" value="Search" id="search" class="btn btn-info">
	              	</div>
	          </form> -->
	         <form action="" autocomplete="off" method="post" class="form-inline" style="margin-left: 10px;">
    			<div class="form-group" style="margin-bottom: 5px;">
    			<label for="">Date From</label>
    			<input type="text" name="from_date" id="from_date" class="form-control" value="<?php echo date('Y-m-d', strtotime('-7 days'));  ?>">
    		</div>
    		<div class="form-group">
    			<label for="">Date To&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    			<input type="text" name="to_date" id="to_date"  class="form-control" value="<?php echo date('Y-m-d'); ?>">
    			<input type="button" name="search" value="Search" id="search" class="btn btn-info">
    		</div>
    		  </form>
</div>
<div class="col-md-6">
	<form action="#" class="form-inline" method="post" autocomplete="off">
            		<div class="form-group">
    <label for="exampleFormControlSelect1">Type of subscription:</label>
    <select class="form-control" id="subscriber">
      <option>------select subscription------</option>
      <option value="<?php echo $plan;  ?>">all subscription</option>
      <?php 

foreach($member_type as $mtype )
{
echo "<option value='" . $mtype['plan_id'] . "' >" . $mtype['plan_name']."</option>";

}
 ?>
    </select>
  </div>
            	</form>
</div>
 		</div>
 		<div class="row" style="margin-top: 10px;">
 			<div class="col-md-12">
 			<table id="example" class="display nowrap" style="width:100%" >
        <thead>
            <tr>
					<th>S.No</th>
					<th>Date</th>
					<th>Name</th>
					<th>Email</th>
					<th>Plan Id</th>
					<th>Invoice No</th>
					<th>Amount</th>
					<th>Transaction Id</th>
				</tr>
        </thead>
       <tbody id="subscriberdata">
					<?php
						$a=1;
						foreach ($all_subscriber as $master_filetype_list) {
					?>
					<tr>
						<td><?php echo $a; ?></td>
						<td><?php echo $master_filetype_list['created_date'] ?></td>
						<td><?php echo $master_filetype_list['mm_user_full_name'] ?></td>
						<td><?php echo $master_filetype_list['mm_user_email'] ?></td>
						<td><?php echo $master_filetype_list['plan_id'] ?></td>
						<td>0</td>
						<td><?php echo $master_filetype_list['amount'] ?>
						</td>
						<td><?php echo $master_filetype_list['txnid'] ?></td>
					</tr>

					<?php
						$a++;
						}
					?>
				</tbody>
    </table>	
 			</div>
 		</div>
	</div>
</div>
</div>


		

<!--m-->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js
"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script>
	$(document).ready(function()
{
	$("#example_info").addClass("intro");
	//alert();
	$.datepicker.setDefaults({
		dateFormat: 'yy-mm-dd'
	});
	$(function()
	{
		$("#from_date").datepicker();
		$("#to_date").datepicker();
	});
	$('#search').click(function()
	{
		
		var from_date=$("#from_date").val();
		var to_date=$("#to_date").val();
		// alert(from_date);
		var res= from_date.split("/");

var monthh=res[0];
var datee=res[1];

 var yearr=res[2];
var ress= to_date.split("/");
 var monthh1=ress[0];
var datee2=ress[1];

 var yearr3=ress[2];
 if(from_date!='' && to_date!='')
		{
			$.ajax({
				url:"<?php echo base_url().'date-filter'  ?>",
				method:"POST",
				data:{from_date:from_date, to_date:to_date},
				// dataType:"text",
				success:function(data)
				{
                 // $("#subscriberdata").html(data);

                     
                       //$('#example').DataTable();
                      $('#example').dataTable().fnDestroy();
                      $('#subscriberdata').html(data);
                      $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );  
              
				}
			});
		}
		else{
			alert("please select date");
		}

		
	});
});
</script>
<!-- search subscriber type start-->

<script>

	$(document).ready(function() {
		var j = $.noConflict();
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );

	      $('#subscriber').on('change', function(){  
           var subs_id = $(this).val();  
           $.ajax({  
                url:"<?php echo base_url() ?>subscriber-type-data",  
                method:"POST",  
                data:{subs_id:subs_id},  
                success:function(data){  
                //$('#example').DataTable();
                      $('#example').dataTable().fnDestroy();
                      $('#subscriberdata').html(data);
                      $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );  
                      
                }  
           });  
      });  
</script>