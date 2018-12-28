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
            body > div > div.row > div > div > div:nth-child(2) > div > form > input{
            position: relative;
            top: -2px;
  }
 
  </style>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
            <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
            <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

<div class="row" style="margin: 6% 0 5% 0;">
            <div class="col-md-10 col-md-offset-2">
            <div class="container" style="border: 1px solid lightgray; padding: 0px;"> 
                <div style="height: 40px; background-color: #587EA3; position: relative; top: -22px;">
                <h2 style="text-align: center; color: white; line-height: 40px;" id="info">Cash-Back Details</h2>
                </div>
            <div class="row">
                    <div class="col-md-6">
                    <form action="<?php echo base_url().'user-cashback-date-report'?>" name="form1" autocomplete="off" method="post" class="form-inline" style="margin-left: 10px;">
                    <div class="form-group" style="margin-bottom: 5px;">
                    <label for="">From</label>
                    <input type="text" name="from_date" id="from_date" class="form-control" value="<?php echo $from; ?>">
      <!-- <?php //echo date('m/d/Y', strtotime($abhi))?> -->
                  
                    </div>
                    <div class="form-group" style="margin-bottom: 5px;">
                    <label for="">to</label>
                    <input type="text" name="to_date" id="to_date" class="form-control" value="<?php echo $to; ?>">
                  </div>
                  <input type="submit" name="search" value="Search"  class="btn btn-info">
                    </form>
                    <div class="danger" style="text-align: left; color:red;"><?php echo $message; ?></div>
                    </div> 
                    <div class="col-md-6">
                      <form action="" name="form2" autocomplete="off" method="post" class="form-inline" style="margin-left: 10px;">
                    <div class="form-group" style="margin-bottom: 5px;">
                    <!-- <label for="">Find User</label> -->
                    <!-- <input type="select" name="search_text" id="search_text" class="form-control" > -->
                    <!-- <input list="search" id="search_text" class="form-control" name="hj"> -->
  <!-- <datalist id="search">
  <option value=" " ng-selected="<?php //echo $userselect; ?>"></option>
  </datalist> -->
                    </div>
                  <!-- <input type="submit" name="search" value="Search"  class="btn btn-info"> -->
                    </form>
                    </div>
                   
                      
                  
                    
</div>

 		<div class="row">
 			<div class="col-md-12">
 		 			</div>
 		</div>
 		<div class="row" style="margin-top: 10px;">
                <div class="col-md-12" id="result">
                              <table id="example" class="display nowrap" style="width:100%" >
                              <thead>
                              <tr>
                              <th>S.No</th>
                              <th>Date</th>
                              <th>Particular</th>
                              <th>Debit</th>
                              <th>Ballance</th>
                              <tr>
                              <td colspan="5" style="text-align: right; "><font style="color:green;">Opening Ballance</font>&nbsp;&nbsp; | &nbsp;&nbsp; <?php echo $cashback1[0]['amount']; ?></td>
                              </tr>

                              </tr>
                              </thead>
                              <tbody>
                              <?php
                              $a=1;
                              $total = $cashback1[0]['amount']; 
                              foreach ($all_cashback as $master_filetype_list) {
                              ?> 
                              <tr>
                              <td><?php echo $a; ?></td>
                              <td><?php echo date('m/d/Y', strtotime($master_filetype_list['get_date'])) ?></td>
                              <td><label for=""><?php echo $master_filetype_list['lvl_name']; ?></label><br><?php echo '('.$master_filetype_list['mm_user_full_name'].'&nbsp;/&nbsp;'.$master_filetype_list['mm_user_email']. ')' ?></td>
                              <td><?php echo $master_filetype_list['amount'] ?></td>
                              <td><?php 
                             // echo $total+$master_filetype_list['amount'];
                              echo $total=$total+$master_filetype_list['amount'];
                              ?>
                              </td>
                              </tr>
                              <?php
                              $a++;
                              }
                              ?>
                              </tbody>
                              <tr>
                  <td colspan="5" style="text-align: right; "><font style="color:green;">Closing Ballance</font>&nbsp;&nbsp;|&nbsp;&nbsp; <?php echo $total; ?></td>
                  </tr>
                              </table>	
                </div>
 		</div>
	</div>
</div>
</div>
</div>

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

});
</script>
<script>

	$(document).ready(function() {
		var j = $.noConflict();
    // load_data();

 function load_data(query)
 {

  console.log(query);
  $.ajax({
   url:"<?php echo base_url().'user-cashback-detail-ajax'  ?>",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    // var data_array = jQuery.parseJSON(data);
    // //console.log(data.result);
    // var appenddata;
    //      $.each(data_array, function (key, value) {
    //       alert(value.mm_user_full_name);
    //          appenddata += "<option value = '" + value.mm_user_full_name + " '>";                        
    //      });
        // console.log(appenddata);
        $('#search').html(data);
        // alert(appenddata);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  // else
  // {
  //  load_data();
  // }
 });
		$('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
         {extend: 'excel', orientation: 'landscape',  text:'Excel', title:'MM_Cash-Back-Details'},
         {extend: 'pdf', orientation: 'landscape', text:'PDF', title:'MM_Cash-Back-Details'},
         {extend: 'csv', orientation: 'landscape', text:'CSV', title:'MM_Cash-Back-Details'},
         {extend: 'print', orientation: 'landscape', text:'Print', title:'MM_Cash-Back-Details'},
        ]
    });

});
</script>
