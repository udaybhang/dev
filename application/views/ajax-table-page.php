<!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | Show JSON Data in Jquery Datatables</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
           <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>  
           <script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  

           <div class="container">  
            <button type="button" id="test">Hello</button>
                <h1 align="center">Show JSON Data in Jquery Datatables</h3><br />  
                <h3 align="center">Employee Database</h3><br />  
                <table id="data-table" class="table table-bordered">  
                     <thead>  
                          <tr>  
                               <th>Name</th>  
                               <th>Salary</th>  
                               
                          </tr>  
                     </thead>  
                </table>  
           </div>  
      </body>  
 </html>  
 <script>  

 $(document).ready(function(){  
      
      $('#test').on('click', function()
      {
$('#data-table').DataTable({

           "ajax"     :   {  
            "url": "<?php echo base_url().'ajax-display' ?>", 
            "dataSrc" : ""
        },
           "columns"     :     [
                {     "data"     :     "name"     },  
                {     "data"     :     "salary"}  
               
           ]  
      }); 
       }) 
 });  
 </script>  