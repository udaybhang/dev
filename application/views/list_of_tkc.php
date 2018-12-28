
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .con{
        margin-left: 15%;
    }
</style>
   
</head>
<body>
 <div class="col-md-12">
         <input type="button" class="btn btn-primary btn-md" style="float: right;background-color:#112B4E; border-color: #112B4E;" onclick="tableToExcel('testtable2', 'Excel Report');" value="Export to Excel" />
                                    </div>
<div class="con">
<div class="container" style="margin-top:20px;">
<h1><?= $title;  ?></h1>
<div class="table-responsive">
    <table class="table table-bordered table-responsivet table-striped" id="testtable2">
        <thead>
            <tr>
                <th class="header">S.no</th>
                <th class="header">mm_uid</th>                           
                <th class="header">user_type_id</th>                      
                <th class="header">mm_user_full_name</th>
                <th class="header">mm_last_name</th>
                <th class="header">mm_user_email</th>
                <th class="header">mm_age</th>
                <th class="header">mm_higest_qualification</th>
                <th class="header">user_status</th>
                <th class="header">mm_auth_key</th>
                <th class="header">reg_date</th>
                <th class="header">user_password</th>
                <th class="header">eamil_auth_status</th>
                <th class="header">deheaderice_id</th>
                <th class="header">email_otp</th>
                <th class="header">signup</th>
                <th class="header">refferal</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            $ctr=0;
            foreach($feedbackInfo as $row)
                {
                    $ctr++;
                    ?>
                    <tr>
                     <td><?php echo $ctr; ?></td>
                        <td><?php echo $row->mm_uid; ?></td>   
                        <td><?php echo $row->user_type_id; ?></td> 
                        <td><?php echo $row->mm_user_full_name; ?></td>                       
                        <td><?php echo $row->mm_last_name; ?></td>                       
                        <td><?php echo $row->mm_user_email; ?></td>                       
                        <td><?php echo $row->mm_age; ?></td>                       
                        <td><?php echo $row->mm_higest_qualification; ?></td>                       
                        <td><?php echo $row->user_status; ?></td>                       
                        <td><?php echo $row->mm_auth_key; ?></td>                       
                        <td><?php echo $row->reg_date; ?></td>                       
                        <td><?php echo $row->user_password; ?></td>                       
                        <td><?php echo $row->eamil_auth_status; ?></td>                       
                        <td><?php echo $row->device_id; ?></td>                       
                        <td><?php echo $row->email_otp; ?></td>                       
                        <td><?php echo $row->signup; ?></td>                       
                        <td><?php echo $row->refferal; ?></td>                       
                                            
                        
                    </tr>
                  
            <?php } ?>

        </tbody>
    </table>
  
   </div>

   <script>
       var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})();
   </script>


</body>
</html>

