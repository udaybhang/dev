<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        body > div > div.row{
            margin:0;
        }
    </style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!--date range picker -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!--date range picker end-->

  <!-- data table css then jquery cdn-->
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
<!-- data table css then jquery cdn-->

	
    <script type="text/javascript">
         $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
    </script>
   
</head>
<body>
    <div class="container" style="border:2px solid lightgray;
     padding: 0px;">
        <div style="height: 40px; background-color: green; position: relative; top: -20px;  ">
            <h2 style="text-align: center; color: white; line-height: 40px;">Serch data by Date Range</h2>
        </div>
        <div class="row">
            <div class="col-md-6">
       <form class="form-group form-inline" id="formextension">
                    <label for="">Date Filter:&nbsp;</label>
                    <input type="text" name="daterange" id="daterange" value="" class="form-control" />
                    <input type="button" name="search" value="Search" id="search" class="btn btn-info">
                </form>
                    </div>         
            
            <div class="col-md-6">
                    <select id="subscriber" class="form-control">
               <option>Select subscription</option>
               <option value="<?php
echo $plan;
 ?>">All</option>
               <option value="1">Premium</option>
               <option value="2">platinum</option>
               <option value="3">Classical</option>
               <option value="4">Free</option>
           </select>
       
            </div>
        </div>
       <div style="clear: both;"></div>
       
        <div class="row">
         <table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                    <th>S.No</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Invoice No</th>
                    <th>Amount</th>
                    <th>Transaction Id</th>
                </tr>
        </thead>
        <tbody id="subscriberdata">
         
        </tbody>
        
    </table>   
        </div>
    </div>

    <!-- on chang -->
    <script type="text/javascript">
       
        
        $('#subscriber').change(function(){  
           var subs_id = $(this).val();  
           $.ajax({  
                url:"<?php //echo base_url() ?>subscription-type",  
                method:"POST",  
                data:{subs_id:subs_id},  
                success:function(data){  
                     $('#subscriberdata').html(data);  
                }  
           });  
      });  
  
    </script>
    <!-- on chang end -->
    <script type="text/javascript">
        //date picker start 
  $(function() {
    var j = $.noConflict();
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>
<!-- date picker end -->
<!-- date range click-->
<script>
$('#search').click(function()
{
// alert();
var from_date=$("#daterange").val();
// alert(from_date);
var res= from_date.split("-");
// alert(res);
var a=res[0];
var b=res[1];
alert(a);
if(a!='' && b!='')
        {
            $.ajax({
                url:"<?php echo base_url().'date-filter'  ?>",
                method:"POST",
                data:{from_date:a, to_date:b},
                // dataType:"text",
                success:function(data)
                {
                 $("#subscriberdata").html(data);
                }
            });
        }
        else{
            alert("please select date");
        }
});

// //date range end
      $('#subscriber').change(function(){  
           var subs_id = $(this).val();  
           $.ajax({  
                url:"<?php //echo base_url() ?>subscriber-type-data",  
                method:"POST",  
                data:{subs_id:subs_id},  
                success:function(data){  
                     $('#subscriberdata').html(data);  
                }  
           });  
      });  
  // });
 
</script>
<!-- date range end -->
    </script>
</body>
</html>