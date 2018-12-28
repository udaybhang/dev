
<style>
	.invoice {
		position: relative;
		background: #fff;
		border: 1px solid #f4f4f4;
		padding: 0px 16px;
		margin: 114px 25px;
		padding-bottom: 20px;
	}
	
	
	.show {
		-webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
		-moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
	}
	
	.box-col {
		border-top: 3px solid #112B4E;
	}
	.lel {
		color: #fff;
		text-align: center;
		margin-bottom: 7px;
		margin-top: 7px;
	}
	
	.dd-mar {
		margin-left: -27px;
	}
	.btn-col {
		background-color: #112B4E;
		border-color: #ecf0f5;
	}
	.ul-mar {
		margin-top: 35px;
	}
	.thead
	{
		align-content: center;
		}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="row main">
		<div class="col-md-12">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="background-color: #587EA3">
						<div class="col-md-12">
							<h2 class="lel">User Detail Report</h2> </div>
					</div>
					<div class="clearfix" style="margin-top: 30px;"></div>
					
					<!-- /.box-header -->
					
					<div class="row">
						<div class="col-md-12">
								
							
							
							
							<div class="">
								
								<ul class="nav nav-tabs">
									<li class="active"><a data-toggle="tab" href="#home">CAF Profile</a></li>
								</ul>
								<div class="tab-content">
									<div id="home" class="tab-pane fade in active">
										
										<div class="col-md-12">
	<input type="button" onclick="tableToExcel('testTable', 'W3C Example Table')" value="Export to Excel"
		 style=" margin-left: 0px;margin-top: 14px;float: right;margin-bottom: 16px;">
								</div>
										<div class="col-md-12">
			<table class="table table-bordered table-hover" id="testTable" >
												<thead>
													<tr>
														<th>S.No</th>
														<th>Name</th>
														<th>User Email</th>
														<th>Contact No</th>
														<th>Source</th>
														<th>Registration date</th>
														
													</tr>
												</thead>
												<tbody>
												<?php $s=0; foreach($user_data as $user){$s++;?>
													<tr>
														<td><?php echo $s;?></td>
														<td><?php echo $user['mm_user_full_name'];?></td>
														<td><?php echo $user['mm_user_email'];?></td>
														<td><?php echo $user['contact_number'];?></td>
														<td><?php echo $user['source_name'];?></td>
														<td><?php echo $user['reg_date'];?></td>
														
													</tr>
													<?php } ?>
												
												</tbody>
											</table>
											
										</div>
								
										
									</div>
									
									</div>
							</div>
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


 
    <script type="text/javascript">
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
  $(function () {
    $("#testTable").DataTable();
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
</script>
