<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
</head>
<body>
	<select name="fnd" id="fnd" class="form-control">
		<option value="1">Good</option>
		<option value="2">Better</option>
		<option value="3">Best</option>
	</select>
	<button type="button" id="btn1">Search</button>
    <div id='loadingmessage' style='display:none'>
  <img src="<?=base_url('spinner.gif');?>"/>
</div>
	<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Brand name</th>
                <th>Brand id</th>
             
                
            </tr>
        </thead>
        <tbody id="tblbody">
          <?php foreach($user as $row)
          {
               ?>
               <tr>
                   <td><?php  echo $row['brand_name']  ?></td>
                   <td><?php  echo $row['brand_id']  ?></td>
               </tr>
               <?php
          }   

          ?>
        </tbody>
        <tfoot>
        	 <tr>
                <th>Name</th>
                <th>Position</th>
               
               
            </tr>
        </tfoot>
    </table>
</body>
</html>
<script>
	$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
<script>
	$(document).ready(function()
	{
		$("#btn1").on('click', function()
		{
			 var searchid =$("#fnd").val();
	        $.ajax({
	        	method:"post",
	        	url:"<?php echo base_url().'search-ajax-datatable'    ?>",
	        	dataType:"json",
	        	data:{searchid:searchid},
                beforeSend: function(){
                                                   $('#loadingmessage').show();
                                                 },
                                                 complete: function(){
                                                  $('#loadingmessage').hide();
                                                 },
	        	success:function(res)
	        	{
	        		 $('#example').dataTable().fnDestroy();
                   $("#tblbody").html(res);
$('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           
            { extend: 'excel', text:'Excel',title:'ytt'},
             { extend: 'pdf', text:'PDF',title:'jyj'},
              { extend:  'csv', text:'CSV',title:'jtytjtj'},
               { extend: 'print', text:'Print',title:'jyt'},
                
        ]
        
    });
	        	}
	        })
		})
	})
</script>