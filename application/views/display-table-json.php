
<!DOCTYPE html>
<html>
 <head>
  <title>How to return JSON Data from PHP Script using Ajax Jquery</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  
 
  </style>
 </head>
 <body>
  <br /><br />
  <div class="container" style="width:900px;">
   <h2 align="center">How to return JSON Data from PHP Script using Ajax Jquery</h2>
   <h3 align="center">Search Employee Data</h3><br />   
   <div class="row">
    <div class="col-md-4">
    
    </div>
    <div class="col-md-4">
     <button type="button" name="search" id="search" class="btn btn-info">Click to display json data</button>
    </div>
   </div>
   <br />
   <div class="table-responsive" id="employee_details" style="display:none">
   <table class="table table-bordered" id="employee_table">
    
      <tr>
        <th>Name</th>
        <th>Addres</th>
        <th>Gender</th>
        <th>Age</th>
      </tr>
    
    
    
   </table>
   </div>
   
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 $('#search').click(function(){
  $("#employee_details").show();
   $.ajax({
    url:"<?php echo base_url().'table-display-json'  ?>",
    method:"POST",dataType:"JSON",
    success:function(data)
    {
var employee_data='';
$.each(data, function(key, value){ 
                
                    employee_data+='<tr>';
                     employee_data+='<td>'+value.name+'</td>';
                     employee_data+='<td>'+value.address+'</td>';
                     employee_data+='<td>'+value.gender+'</td>';
                     employee_data+='<td>'+value.age+'</td>';
                     employee_data+='</tr>';
                     
                });  
                
                $("#employee_table").append(employee_data);
    }
   })
 
 });
});
</script>