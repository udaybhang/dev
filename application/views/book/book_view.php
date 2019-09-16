<html>

<head><link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css' ?>">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
	
	//insert book 
  $("#btn_insert").click(function(){
     
    var bookId = $("#bookId").val();
      var book_name = $("#bookName").val();
	   var price = $("#bookPrice").val();
 
        $.ajax({
		url: "<?php echo base_url(); ?>" + "Book/insert_book/",
		type: 'post',
		data: { "bookId": bookId, "bookName": book_name, "bookPrice" : price},
		success: function(response) 
		{ 
           window.location.href = "<?php echo base_url('Book/profile'); ?>";		
		}
 
});
	   });
	   });

	</script>
</head>


<body>
<table style="width:400px;" border="0" cellspacing="3" cellpadding="3" >
<tr>
<td>Enter BookID:</td>
<td> <input type="text"  id="bookId" style="width:100%;"/></td>
</tr>
<tr>
<td>Book Name:</td>
<td> <input type="text"  id="bookName"  style="width:100%;"/></td>
</tr>
<tr>
<td>Book Price:</td>
<td> <input type="text"  id="bookPrice"  style="width:100%;"/></td>
</tr>	
	
<tr>
<td></td>
<td> 
	<input type="button" id="btn_insert"  value="Insert"/>
		<!-- <input type="button" id="btn_update" value="Update"/>
		<input type="button" id="btn_delete" value="Delete"/>
		<input type="button" id="btn_show" value="Show All"/> -->
	</td>
</tr>	
</table>
  
    <!-- <div id="divresult"></div> -->
</body>
</html>