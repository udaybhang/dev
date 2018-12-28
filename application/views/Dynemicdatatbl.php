<!DOCTYPE html>
<html>
<head>
	<title></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>




<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">





	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

</head>
<body>
	<div class="row">
		<div class="col-md-6"></div>
		<div class="col-md-4">
			<select class="form-control" id="findplan">
				<option>----select-----</option>
				<option value="1">premium</option>
				<option value="2">platinum</option>
				<option value="3">Classical</option>
				
							</select>
		</div>
	</div>
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Amount</th>
                <th>Invoice No</th>
                <th>Plan Id</th>
                
            </tr>
        </thead><div class="foo">
        	<tbody >
        	
            </tbody>
        </div>
        <tbody id="allrecord">
        	
        	<?php foreach($history as $row)

{
	?>
<tr>
	<td><?php echo $row['amount']; ?></td>
	<td><?php echo $row['invoice_no']; ?></td>
	<td><?php echo  $row['plan_id']; ?></td>
</tr>
            <?php
}
        	?>
            </tbody>
            
    </table>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    $("#findplan").on("change", function(){
         	var planid=$(this).val();
         	//alert(planid);
         	$.ajax({
                  method:"post",
                  url:"<?php echo base_url().'findplan'   ?>",
                  data:{id:planid},
                  datatype:"json",
                  success: function(result)
                  {
                       // Console.log(result);
                        // alert(result.byid);
         	              $(".foo").html(result.$table_data);
         	              $("#allrecord").html(result.$table_data);

                  }

         	});
         });
} );

</script>
<script type="text/javascript">
	$(function(){
         
	});
</script>