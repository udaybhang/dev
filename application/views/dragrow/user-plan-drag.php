<style>
	
</style>
    <title>Dynamic Drag and Drop table rows in PHP Mysql- ItSolutionStuff.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- <div class="wrapper" > -->
    <div class="content-wrapper">
    	<div class="row">
    		<div class="col-md-12">
    			<div class="container" style="border:1px solid lightgray; background-color: #fff; margin-top: 8%; padding-right: 0px; padding-left: 0px;">
    	
    		    <div style="height:50px; background-color: #587EA3; position:relative; top:-19px;"><h3 class="text-center" style="line-height:50px; color:white;">Create User Plan Packages Feature</h3></div>
        <table class="table table-bordered display nowrap" id="example">
            <tr>
                
                <th>Short Descryption</th>
                <th>Feature Description</th>
                <th>Date created</th>
                <th>Action</th>
            </tr>
            <tbody class="row_position">
            <?php
            // $sql = "SELECT * FROM sorting_items ORDER BY position_order";
            // $users = $mysqli->query($sql);
            foreach($feature_data as $user){


            ?>
                <tr id="<?php echo $user['feature_id'] ?>">
                    <td><?php echo $user['short_desc'] ?></td>
                    <td><?php echo $user['feature_description'] ?></td>
                    <td><?php echo $user['modification_date'] ?></td>
                     <td style="cursor: pointer;"><a href="<?php echo base_url().'edit-plan-feature/'.rtrim(strtr(base64_encode($user['feature_id']), '+/', '-_'), '='); ?>" style="color: blue !important;">Edit</a>&nbsp;/&nbsp;<span class="plan-val" style="color: blue !important;"	 data-id="<?php echo rtrim(strtr(base64_encode($user['feature_id']), '+/', '-_'), '='); ?>">Delete</span></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>	
 <?php if (isset($links)) { ?>
                <br>
                
                <?php echo $links ?>
            <?php } ?>
    		</div>
    	</div>
    
    </div> <!-- container / end -->

    </div>
<!-- </div> -->

           

<script type="text/javascript">
    $( ".row_position" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });
    function updateOrder(data) {
        $.ajax({
            url:"<?php echo base_url().'update-drag-row'   ?>",
            type:'post',
            data:{position:data},
            success:function(){
                alert('your change successfully saved');
            }
        })
    }
</script>
<script type="text/javascript">
	  $(".plan-val").click(function(){
	  		 var x = confirm("Are you sure you want to delete?");
			 if (x){
			     $.ajax({
		              type:"POST",
		              url:"<?php echo base_url() ?>delete-user-plan-feature",
		              data:{"hidden_data":$(this).attr("data-id")},
		              async:true,
		              success:function(result)
		              {
		               alert("You have successfully deleted the plan");
		               location.reload();
		              }
            		});
			 }
			 else{
			 	return false;
			 }
			    
	  });
</script>
<script>
	$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend:'copy', attr: { id: 'allan' } }, 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
