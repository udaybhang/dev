<!DOCTYPE html>
<html>
<head>
	<title>LikeUnlike example</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <style type="text/css">
  .fa-thumbs-down, .fa-thumbs-o-down {
  transform:rotateY(180deg);
}
  	.post-wrapper{
  		border:1px solid orange;
  		width:50%;
  		margin:20px auto;
  	}
  	.post{

  		
  		width:90%;
  		margin:20px auto;
  		padding: 10px 5px 0px 5px;
  		border: 1px solid green;
  	}
  	.post-info{
  		margin:10px auto 0px;
  		padding: 5px;
  	}
  	.fa{
  		font-size:1.2em;
  	}
  	i{
  		color:red;
  	}
  </style>
</head>
<body>
<?php  

function user_liked($pid)
{
	$ci =& get_instance();
	$where="user_id=3 and post_id='$pid' and rating_action='like'";
	$queryi="SELECT * FROM rating_info WHERE user_id = 3 and post_id = '".$pid."' and rating_action = 'like'";
		$query= $ci->db->query($queryi);
		
		return $query->num_rows();
} 
function user_disliked($pid)
{
	$ci =& get_instance();
$where="user_id=3 and post_id='$pid' and rating_action='like'";
	$queryi="SELECT * FROM rating_info WHERE user_id = 3 and post_id = '".$pid."' and rating_action = 'dislike'";
		$query= $ci->db->query($queryi);
		
		return $query->num_rows();
}
function getlikes($pid)
{
 $ci =& get_instance();

  		$where="post_id='$pid' and rating_action='like'"  ;
  		  
 echo $ci->db->where($where)->count_all_results('rating_info');
     
}
function getdislikes($pid)
{
 $ci =& get_instance();

  		$where="post_id='$pid' and rating_action='dislike'"  ;
  		  
 echo $ci->db->where($where)->count_all_results('rating_info');
     
}
 ?>
<div class="post-wrapper">
		<?php foreach($post as $rw) 
			{
				?>
		<div class="post">
			<?php	echo $rw['text'];   ?>
				<div class="post-info">
				<i     
				<?php if(user_liked($rw['id']))
				{
					?>
				class=" fa fa-thumbs-up like-btn"	
					<?php
				}   
else{
	?>
class=" fa fa-thumbs-o-up like-btn"	
	<?php 
	
}
				?>

				 data-id="<?php  echo $rw['id']  ?>"></i>
				<span class="likes"><?php echo getlikes($rw['id']); 
					
				 ?></span>
				
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<i
				<?php if(user_disliked($rw['id']))
				{
?>class="fa fa-thumbs-down dislike-btn" <?php
				}  
else
{
	?>
class="fa fa-thumbs-o-down dislike-btn"
	<?php 
}
				?>
				 data-id="<?php echo $rw['id']   ?>"></i>
				<span class="dislikes"><?php echo getdislikes($rw['id']); ?></span>
				
			</div>
			
			
		</div>
		<?php
			}   ?>
			
	</div>

</body>
</html>
<script type="text/javascript">
	$('.like-btn').on('click', function()
	{
		var pid=$(this).data('id');
		$clickedbtn=$(this);
		var action='';
		if($clickedbtn.hasClass('fa-thumbs-up'))
		{
			action="like";
		}
		else if($clickedbtn.hasClass('fa-thumbs-o-down'))
		{
			action="dislike";
		}
		$.ajax({
			url:  "<?php echo base_url().'Demo_like/crud_like_dislike'  ?>",
			method:  "post",
			dataType: "json",
			data: {action:action, pid:pid},
			success: function(res)
			{
				if(action=='like')
				{
					$clickedbtn.removeClass('fa-thumbs-o-up');
					$clickedbtn.addClass('fa-thumbs-up');
				}
				else if(action=='dislike')
				{
					$clickedbtn.removeClass('fa-thumbs-up');
					$clickedbtn.addClass('fa-thumbs-o-up');
				}
				$clickedbtn.siblings('span.likes').text(res.likes.ttl);
			
				$clickedbtn.siblings('span.dislikes').text(res.dislikes.ttl);
				$clickedbtn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
			}

		});
		$('.dislike-btn').on('click', function(){
  var post_id = $(this).data('id');
  $clicked_btn = $(this);
  if ($clicked_btn.hasClass('fa-thumbs-o-down')) {
  	action = 'dislike';
  } else if($clicked_btn.hasClass('fa-thumbs-down')){
  	action = 'undislike';
  }
  $.ajax({
  	url: "<?php echo base_url().'Demo_like/crud_like_dislike'  ?>",
  	type: 'post',
  	data: {
  		'action': action,
  		'post_id': post_id
  	},
  	success: function(data){
  		res = JSON.parse(data);
  		if (action == "dislike") {
  			$clicked_btn.removeClass('fa-thumbs-o-down');
  			$clicked_btn.addClass('fa-thumbs-down');
  		} else if(action == "undislike") {
  			$clicked_btn.removeClass('fa-thumbs-down');
  			$clicked_btn.addClass('fa-thumbs-o-down');
  		}
  		// display the number of likes and dislikes
  		$clicked_btn.siblings('span.likes').text(res.likes.ttl);
  		$clicked_btn.siblings('span.dislikes').text(res.dislikes.ttl);
  		
  		// change button styling of the other button if user is reacting the second time to post
  		$clicked_btn.siblings('i.fa-thumbs-up').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
  	}
  });	

});

	})
</script>