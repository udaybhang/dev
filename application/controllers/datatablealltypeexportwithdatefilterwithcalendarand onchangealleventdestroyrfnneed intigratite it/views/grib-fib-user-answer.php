<style>
	.invoice {
		position: relative;
		background: #fff;
		border: 1px solid #f4f4f4;
		padding: 0px 16px;
		margin: 114px 25px;
		padding-bottom: 20px;
	}
	table>thead>tr>th {
		border-bottom:1px solid #ecf0f5;
	}
	.show {
		-webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
		-moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
	}
	.table>thead>tr>th,
	.table>tbody>tr>th,
	.table>tfoot>tr>th,
	.table>thead>tr>td,
	.table>tbody>tr>td,
	.table>tfoot>tr>td {
		border: 1px solid #ecf0f5;
	}
	.box-col
{
	border-top: 3px solid #112B4E;
}
	.lel {
		color: #fff;
		text-align: center;
		margin-bottom: 7px;
		margin-top: 7px;
	}
	.table > caption + thead > tr:first-child > td,
	.table > caption + thead > tr:first-child > th,
	.table > colgroup + thead > tr:first-child > td,
	.table > colgroup + thead > tr:first-child > th,
	.table > thead:first-child > tr:first-child > td,
	.table > thead:first-child > tr:first-child > th {
		border: 1px solid #fafafa;
	}
   .dd-mar{
          margin-left: -27px;
   }
   .btn-col
   {
          background-color: #112B4E;
    border-color: #ecf0f5;
   }
   .ul-mar{
	margin-top: 35px; width: 
   }
   /* Sohrab 30 apr 2017 */
   .danger{
		background-color: #f2dede;
	    border-color: #ebccd1;
	    color: #a94442;
		text-align: center;
		margin:auto;
		margin-bottom: 15px;
		margin-top: 30px;
		padding: 10px;
		width: 80%;
		box-shadow: 0px 0px 10px #ebccd1;
		}
	.success{
		background-color: #dff0d8;
		border-color: #d6e9c6;
		color: #3c763d;
		text-align: center;
		margin:auto;
		margin-bottom: 15px;
		margin-top: 30px;
		padding: 10px;
		width: 80%;
		box-shadow: 0px 0px 10px #d6e9c6;
	    }
	    #levellist>div{
	    	height: 34px;
	    	line-height: 34px;
	    	margin-bottom: 5px;
	    	padding:0px;
	    }
	    #levellist>div.col-md-3{
	    	font-weight: 700;
	    }

</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admin_assets/bootstrap-chosen.css">
<!-- Content Wrapper. Contains page content -->

<style type="text/css">


.limitedNumbChosen, .limitedNumbSelect2{
  width: 400px;
}
.uiTokenText{
  font-size: 12px!important;
      margin: 0 2px 0 2px;
}
.uiToken .remove {
    left: 1px;
    margin: 0;
    outline: none;
    position: relative;
    padding-left: 2px!important;
    top: 0px;
}
.uiCloseButtonSmall {
    height: 11px;
    margin-top: 1px;
    width: 11px;
    color: #999;
    cursor: pointer;
    display: inline-block;
    font-weight: 700;
    margin-right: 2px;
        margin-left: 3px;
    font-size: 17px;
}
.select2-selection__choice {
    background-color: #e4e4e4;
    border: 1px solid #aaa;
    border-radius: 4px;
    cursor: default;
    padding: 2px 2px;
   
}
.model-new {
    margin: 0 auto;
}

}

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="row main">
		<div class="col-md-12">
			<div class="col-md-12">
				<div class="col-md-12">
	              <?php
	              if($this->session->flashdata('topic_insert_message')){
	              	echo $this->session->flashdata('topic_insert_message');
	              }
	              ?>
				</div>
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="background-color: #587EA3">
						<div class="col-md-12">
							<h2 class="lel">Grib Fib Users Answer Report</h2> </div>
					</div>
					<div class="clearfix" style="margin-top: 20px;"></div>
					<div class="">
						<div class="col-md-12">
							
							</div>
					</div>
					<!-- /.box-header -->
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12">
							
							 <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-col">
        <div class="box-header with-border">
        	<div class="col-md-2">
        	   <input type="button" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E; margin-left: 3px;" onclick="tableToExcel('testtable2', 'W3C Example Table');" value="Export to Excel" />	
        	</div>
        	<div class="col-md-2">
        		<form method="post"  id="word_detective_ans_form" name="word_detective_ans_form">
	        	<select name="user_name" id="user_name" data-placeholder="Choose Users Name..." class="chosen-select"  tabindex="2">
	                <option value="">Select User Name</option>
	                <?php 
	             
                        echo $user_ans_data['u_id'];
	                  foreach ($user_lists as $user) {?>
	                  	 <option value="<?php echo $user["mm_uid"] ?>" <?php if($user["mm_uid"] == $user_ans_data['u_id']){ echo 'selected';} echo $select ?> ><?php echo $user["mm_user_full_name"]." ".$user["mm_last_name"]." (".$user["mm_user_email"].")"; ?></option>;
	             <?php     }       
	                ?>							    			
				</select>	
        	</div>
        	<div class="col-md-2">	
        		<select class="form-control" name="package" id="package">
	                <option value="">Select Package</option>
					 <?php 
	                  foreach ($package_lists as $package) {
	                  	 echo '<option value="'.$package["package_id"].'">'.$package["package_name"].'</option>';
	                  }       
	                ?>								    			
				</select>	
        	</div>
        	<div class="col-md-2">
        		<select class="form-control" name="asignment" id="asignment">
	                					    			
				</select>	
        	</div>
        	<div class="col-md-2">	
        		<select class="form-control" name="level" id="level">
	                
											    			
				</select>	
        	</div>
        	<div class="col-md-2">	
        		<input type="button" name="user_serch" id="user_serch" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E" value="Submit">
        	</form>
        	</div>
        </div>
      </div>
      <!-- /.box -->

	          	<div class="col-md-12" style="padding-top: 10px;">
	          	<table class="table table-striped table-responsive" id="testtable2">
				 <thead>
					<tr>
	                  <th>S.No</th>
	                  <th>Question</th>
					  <th>User Answer</th>
					  <th>Correct Answer</th>
					</tr>
				</thead>
				<tbody id="result">
				</tbody>
				</table>
	          	</div>
   

    </section>
    <!-- /.content -->
						</div>
					</div>
				</section>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
	<!-- /.content -->
	<div class="clearfix"></div>
</div>
<script src="<?php echo base_url(); ?>admin_assets/chosen.jquery.js"></script>
<script src="<?php echo base_url(); ?>admin_assets/jasny-bootstrap.min.js"></script>
<script type="text/javascript">
        $('.chosen-select').chosen({width: "100%"});
</script>
<script>
	
  $(function () {
   
	 $("#01").DataTable();
	$("#testtable2").DataTable();
    $('#').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });

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
})()
</script>
<script type="text/javascript">
$("#package").change(function() {
    var packageid= $(this).val();
    datastr={Package_id:packageid,  m_type: 7};
      $.ajax({
               url: '<?php echo base_url()?>get-assignment-data',
               type: 'post',
               data: datastr,
               success: function(response)
               {
                $("#asignment").html(response);
               }
             });
});
$("#asignment").change(function() {
    var assignid= $(this).val();
    datastr={Assign_id:assignid,  m_type: 7};
      $.ajax({
               url: '<?php echo base_url()?>get-level-data',
               type: 'post',
               data: datastr,
               success: function(response)
               {
                $("#level").html(response);
               }
             });
});
$("#user_serch").on('click', function(){
    $.ajax({
           type: "POST",
           url: '<?php echo base_url()?>get-grib-fib-user-ans-list',
           data: $("#word_detective_ans_form").serialize(), // serializes the form's elements.
           success: function(data)
           {
               $("#result").html(data);
           }
         });
     e.preventDefault();
});
</script>