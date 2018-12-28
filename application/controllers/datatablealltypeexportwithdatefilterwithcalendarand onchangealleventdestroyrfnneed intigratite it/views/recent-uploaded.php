
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
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	
	<div class="row main">
		<div class="col-md-12">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="background-color: #587EA3">
						<div class="col-md-12">
							<h2 class="lel">Recent Uploaded Assignment</h2> </div>
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
							<div class="box box-col">
							<div class="box-header">
              <h3 class="box-title">Recent Uploaded Assignment</h3>
              

             
            </div>
            </div>
							<table class="table table-striped table-responsive" id="01">
								<thead>
					<tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Assignment</th>
				    <th>Level</th>
					<th>Date</th>
				   <th>Status</th>
					</tr>
								</thead>
								<tbody>
				<tr>
						<td>1.</td>
                  <td>Bhumika Srivastava</td>
                   <td>Crossword</td>
				   <td>1</td>
                 <td>01/01/2017</td>
				 <td>Compeleted</td>
									</tr>
				<tr>
						<td>1.</td>
                  <td>Richa Mishra</td>
				   <td>Crossword</td>
                  <td>2</td>
                  <td>01/01/2017</td>
				  <td>Ongoing</td>
				</tr>
					<tr>
						<td>1.</td>
                  <td>Krishna Ram Mishra</td>
                   <td>Country Comparision</td>
				   <td>1</td>
                 <td>01/01/2017</td>
				 <td>Compeleted</td>
									</tr>
				<tr>
						<td>1.</td>
                  <td>John</td>
				   <td>Crossword</td>
                  <td>2</td>
                  <td>01/01/2017</td>
				  <td>Ongoing</td>
				</tr>
            	
				
								</tbody>
							</table>
						</div>
					</div>
				</section>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
	<!-- /.content -->
	<div class="clearfix"></div>
</div>

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
</script>