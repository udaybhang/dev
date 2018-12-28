<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  	*{
  		margin: 0px;
  		padding: 0px;
  	}
  	div{margin: 0px 30%;}
  	ul{
  		list-style-type: none;	
  		
  		
  	}
  	ul li{
  		float: left;
  		border:1px solid yellow;
  		width: 60px;
  		height: 35px;
  		line-height: 35px;
  		text-align: center;
  	}
  	ul ul{
  		display: none;
  		position: relative;
  	}
  	

  	ul li :hover>ul{display: block;}
  	ul ul ul{margin: 60px;
  		position: absolute;
  		margin-top: -40px;}
  </style>
</head>
<body>
	<div>
		<ul>
			<li><a href="">A</a></li>
			<li><a href="">A</a></li>
			<li><a href="">A</a></li>
			<li><a href="">A</a></li>
			<li><a href="">A</a>
				<i class="fa pull-right fa-angle-right" style="position: relative;top: 10px;right: 2px;"></i>
<ul>
	<li><a href="">B</a></li>
	<li><a href="">B</a></li>
	<li><a href="">B</a></li>
	<li><a href="">B</a></li>
	<li><a href="">B</a></li>
</ul>
			</li>
			<li><a href="">A</a></li>
			<li><a href="">A</a></li>
			<li><a href="">A</a>
				<i class="fa pull-right fa-angle-right" style="position: relative;top: 10px;right: 2px;"></i>
<ul>
	<li><a href="">C</a></li>
	<li><a href="">C</a></li>
	<li><a href="">C</a>
			<i class="fa pull-right fa-angle-right" style="position: relative;top: 10px;right: 2px;"></i>
<ul>
	<li><a href="">D</a></li>
	<li><a href="">D</a></li>
	<li><a href="">D</a></li>
	<li><a href="">D</a></li>
</ul>
	</li>
	<li><a href="">C</a></li>
	<li><a href="">C</a></li>
</ul>
			</li>
			<li><a href="">A</a></li>
		</ul>
	</div><br>
	<section>
		<div class="container">  
                 
                     <select name="brand" id="brand">  
                          <option value="">---select Brand----</option>  
                          <?php 
                          
                          foreach($brand as $row)
                          {
                          	?>
                            <option value="<?php echo $row['brand_id'] ?>"><?php echo $row['brand_name'] ?></option>
                          	<?php
                          }
                           ?>  
                     </select>  
                     <br /><br />  
                    
                      <table id="p" border="1">


                      </table>
                    
                    
           </div>  
	</section>

</body>
</html>




<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
  $('#brand').change(function(){

  var brand_id = $(this).val();
  
  if(brand_id != '')
  {
     
   $.ajax({
    url:"<?php echo base_url().'A_turnangleoncliksidebar/load_data'; ?>",
    method:"POST",

    data:{brand_id:brand_id},
    success:function(data)
    {
    $('#p').html(data);
    }
   });
   
  }
})
})



</script>





