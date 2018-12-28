
<head><link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css' ?>">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
        $("#btn_update").click(function(){
     
    var bookId = $("#bookId").val();
      var book_name = $("#bookName").val();
           var price = $("#bookPrice").val();
 
        $.ajax({
                url: "<?php echo base_url(); ?>" + "Book/update/",
                type: 'post',
                data: { "bookId": bookId, "bookName": book_name, "bookPrice" : price},
                success: function(response) 
                { 
          window.location.href = "<?php echo base_url('Book/profile'); ?>"; // comment kar dege to bhi update hoga ye line hame yahi likhkar redirect karvaaana hai
                }
 
});
            }); 
    
           });

        </script>
</head>

<div class="container">
	<h3>Edit Book</h3>
<a href="<?php  echo base_url().'Book/index' ?>" class="btn btn-primary">BACK</a>
	
                <input type="hidden" name="hidden_id" value="<?php  ?>">
		<div class="form-group">
		<label class="col-lg-4 text-right">bookid</label>
        </div>
        <div class="col-lg-8">
        	<input type="number" id="bookId" name="bid" class="form-control" value="<?php echo $book->bookId; ?>">
        </div>
        <div class="form-group">
                <label class="col-lg-4 text-right">book name</label>
        </div>
        <div class="col-lg-8">
                <input type="text" id="bookName"    name="bname" class="form-control" value="<?php echo $book->bookName; ?>">
        </div>
        <div class="form-group">
        	<label class="col-lg-4 text-right">book price</label>
        </div>
        <div class="col-lg-8">
        	<input type="number" id="bookPrice"    name="bprice" class="form-control" value="<?php  echo $book->price; ?>">
        </div>
        <div class="form-group">
        	<label class="col-lg-4 text-right"></label>
        </div>
        <div class="col-lg-8">
        	<input type="button" id="btn_update" value="Update"/>
        </div>
	
</div>