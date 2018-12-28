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
   .danger{
	background-color: #f2dede;
    border-color: #ebccd1;
    color: #a94442;
	text-align: center;
	margin:auto;
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
	margin-top: 30px;
	padding: 10px;
	width: 80%;
	box-shadow: 0px 0px 10px #d6e9c6;
}
</style><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="row main">
		<div class="col-md-12">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<?php
				if($this->session->flashdata('data_message')){
					echo $this->session->flashdata('data_message');
				}
				?>
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="background-color: #587EA3">
						<div class="col-md-12">
							<h2 class="lel">state list</h2> </div>
					</div>
					<div class="clearfix" style="margin-top: 20px;"></div>
					<div class="">
						<div class="col-md-12">
							
							</div>
					</div>
					<!-- /.box-header -->
					<?php 
							$permission_array=$this->session->userdata('permission_array');
							for($i=0;$i<sizeof($permission_array);$i++){
								 $p =$this->Crud_modal->fetch_single_data('permission_description','master_permission',"permission_id='$permission_array[$i]'");
								 $permission[] = $p["permission_description"];
							}
					  ?>
					  <?php if(in_array("Create", $permission)){ ?>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12">
							<div class="box box-col">
							<div class="box-header">
					            <div class="col-md-12">
							<form action="<?php echo base_url()?>add-country" method="post" id="formids">
				        	<div class="col-md-3">
				        <input type="text" name="country" placeholder="Add-country" id="country" style="width: 500px;" class="form-control" required>
				        	</div>
        				
						
						<input type="submit" class="btn btn-primary btn-md" style="float: right;background-color:#112B4E; border-color: #112B4E; margin-left: 3px;" value="Add country"></div>
              </form>
              

             
            </div>
            </div>
            <?php } ?>
							<table class="table table-striped table-responsive" id="testtable2">
								<thead>
					<tr>
                  <th>S.No</th>
                  <th>Country name</th>
					<th>Action</th>
					</tr>
								</thead>
								<tbody>
				<?php
					$a=1;
					foreach ($country as $university) {
				?>
				<tr>
					<td><?php echo $a ?>.</td>
					<td><?php echo $university['name'] ?></td>
					<td>
						<?php if(in_array("Edit", $permission)){ ?>
						<a class="edit" value="<?php echo $university['name'] ?>" id="<?php echo $university['cid']?>">Edit</a>
						<?php } ?>
					</td>
				</tr>

				<?php
				$a++;
				}
				?>
            	
				
								</tbody>
							</table>
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


<script>
  $('#assignorder').change(function(){

  	$('#filtercheck').submit();

  });

$(".tasklink").click(function(){
	var assignid = $(this).attr("data-id");
	$(".deletetask").attr("id",assignid);
});
$(".deletetask").click(function(){
	$.ajax({
	  method: "POST",
	  data: {'taskid': $(this).attr("id")},
	  url: "<?php echo base_url() ?>delete-task",
	  dataType: "JSON",
	  success: function(result){
		location.reload();
	  }
	});
});

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
    <script>
    	$('.edit').click(function(){
    		var countryid=$(this).attr('id');
    		$("#country").val($(this).attr('value'));
    		$("#cleal").remove();
    		$("#formids").append('<input type="hidden" name="countryid" value="'+countryid+'" id="cleal"/>');
    		$("#formids").attr("action","<?php echo base_url()?>update-country");
    		$("#formids input[type=submit]").val("Edit Value");

    	})
    	$('.edit').hover(function(){
    		$('a').css("cursor","pointer");

    	});
    </script>