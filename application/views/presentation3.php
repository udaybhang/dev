<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    .btn-default{
      width: 22%;
      background-color:lightgray;
      margin-bottom: 4px;

    }
  .fb
  {
    background-color: #190424;
 color: white;
 padding: 4px;
 width: 80px;
 outline: none;
border-radius: 4px;
box-sizing: border-box;
  }
  .c{
     background-color: #190424;
     color:white;
  }
  option{
    border:1px solid green;
    width:100px;
    text-align: center;
    padding: 8px;
  }
  </style>
</head>
<body>
<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
       <!-- Modal content-->
      <div class="modal-content" style="background-color: #A9E2F3;">
        <!-- <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <h4 class="modal-title text-center" style="margin-top: 30px;">Preferred jobs</h4>
        <!-- </div> -->
        <div class="modal-body" >
             <input type="text" name="search_text" id="search_text" placeholder="Search Here" class="form-control" autocomplete="off" value="" />

              <span id="result" class="a"></span>
             <br>
          <div class="row">
            <div class="col-md-2 col-lg-2">
              </div>
            <div class="col-md-10 col-lg-10">
        
          <?php 
foreach($user as $row)
{
  ?>
   <button class="btn btn-default a" data-value="<?php echo $row->majorcities;  ?>"><?php echo $row->majorcities;  ?></button>
  <?php
}
          ?>
         
            </div>
          </div>
          <div class="row">
  <p style=" margin-left:  65%;"><button class="fb" data-toggle="tooltip" title="Click here" data-placement="bottom">Save</button><a href="#" style="padding: 10px;" data-toggle="tooltip" data-placement="bottom" title="Ok here">Skip</a></p>
        </div>
          </div>
      <!--  <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
      </div>
    </div>
  </div>
 </div>
<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>Presentation/presentation3",
   method:"POST",
   data:{query:query},
   success:function(data){
     $('#result').html(data);
   }
  })
 }

 $('#search_text').keyup(function(){
  var search = $(this).val();

  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>
<script>
  $(document).ready(function(){
     $('.a').on('click', function() {

    var $target = $('#search_text'),

      text = $('#search_text').val(),
      buttonVal = $(this).data('value');
      $target.val(`${text}${buttonVal}`);
      $( "input[value]" ).css( "fontSize", "20px" );
      // $( "input" ).width( "60px" );
      $( "input[value]" ).height( "20px");
      // $('input').css({"background-color":"red"});
     
     });

     })

</script>
</body>
</html>
