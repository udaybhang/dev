<style>
	#example_wrapper > div.dt-buttons{
		margin-left: 10px!important;
	}
	
	#search{
		background-color: #112B4E!important;
    border-color: #112B4E!important;
	}
	body > div > div.row > div > div > div:nth-child(1)
	{
		border-radius: 7px 6px 6px!important;
	}
</style>
<!--date range picker -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 
		<!--date range picker end-->
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<div class="row" style="margin: 12% 0 5% 0;">
	<div class="col-md-10 col-md-offset-2">
		<div class="container" style="border: 1px solid lightgray; padding: 0px;"> 
 		<div style="height: 40px; background-color: #587EA3; position: relative; top: -22px;">
 			<h2 style="text-align: center; color: white; line-height: 40px;" id="info">Cash-Back Details</h2>
 		</div>

 		<div class="row">
 			<div class="col-md-8">
        <form action="<?php echo base_url().'user-cashback-report'?>" autocomplete="off" method="post" class="form-inline" style="margin-left: 10px;">
    			<div class="form-group" style="margin-bottom: 5px;">
    			<label for="">Select Date</label>
    			<input type="text" name="from_date" id="from_date" class="form-control" value="<?php echo date('m/d/Y', strtotime('-2 days'))?>">
    		</div>

    			<input type="submit" name="search" value="Search"  class="btn btn-info">
          </form>
        </div> 
    	
    		<span style="color:red"><?php if($this->session->flashdata('error_message') !=''){ echo $this->session->flashdata('error_message'); }?></span>
    		  

</div>

 		<div class="row">
 			<div class="col-md-12">
 			
  			</div>
 		</div>
 		<div class="row" style="margin-top: 10px;">
 			<div class="col-md-12" id="gen_table">
 			<table id="example" class="display nowrap" style="width:100%" >
        <thead>
            <tr>
					<th>S.No</th>
					<th>Particular</th>
					<th>Debit</th>
					<th>Ballance</th>
				
				
				</tr>
        </thead>

       <tbody id="subscriberdata">
					<?php
						$a=1;
                         $total = $cashback1[0]['amount']; 
						foreach ($all_cashback as $master_filetype_list) {
					?> 
					<tr>
            <td><?php echo $a; ?></td>
						<td><label for=""><?php echo $master_filetype_list['lvl_name']; ?></label><br><?php echo '('.$master_filetype_list['mm_user_full_name'].'/'.$master_filetype_list['mm_user_email']. ')' ?></td>
            <td><?php echo $master_filetype_list['amount'] ?></td>
						<td><?php
            echo $total+$master_filetype_list['amount'];
                  $total=$total+$master_filetype_list['amount'];
                // echo $cashback1;
             ?></td>
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

	$.datepicker.setDefaults({
		dateFormat: 'yy-mm-dd'
	});
	$(function()
	{
		$("#from_date").datepicker();
		$("#to_date").datepicker();
	});

});
</script>
<script>

	$(document).ready(function() {
		// var j = $.noConflict();
		var fdate=$("#from_date").val();
		var ldate=$("#to_date").val();
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
         {extend: 'excel', orientation: 'landscape',  text:'Excel', title:'MM_from_'+fdate+'_to_'+ldate},
         {extend: 'pdf', orientation: 'landscape', text:'PDF', title:'MM_from_'+fdate+'_to_'+ldate},
         {extend: 'csv', orientation: 'landscape', text:'CSV', title:'MM_from_'+fdate+'_to_'+ldate},
         {extend: 'print', orientation: 'landscape', text:'Print', title:'MM_from_'+fdate+'_to_'+ldate},
        ]
    } );

} );

</script>
