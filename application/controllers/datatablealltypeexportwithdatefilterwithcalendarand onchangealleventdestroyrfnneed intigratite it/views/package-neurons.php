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
    margin-top: 35px;
    width: 
  }
  .tasklink, .edittasklink{
    color: #3c8dbc;
    cursor: pointer;
  }
  .tasklink:hover,.tasklink:active,.tasklink:focus, .edittasklink:hover, .edittasklink:active, .edittasklink:focus {
    outline:none;
    text-decoration:none;
    color:#72afd2
  }
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
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="row main">
    <div class="col-md-12">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
        <div class="col-md-12">
        </div>
        <section class="invoice show">
          <!-- title row -->
          <div class="row" style="background-color: #587EA3">
            <div class="col-md-12">
              <h2 class="lel">package wise marks and Neurons
              </h2> 
            </div>
          </div>
          <div class="clearfix" style="margin-top: 20px;">
          </div>
          <div class="">
            <div class="col-md-12 " >
			 <?php 
							  $permission_array=$this->session->userdata('permission_array');
							  for($i=0;$i<sizeof($permission_array);$i++){
								$p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
								if($p["permission_description"]=="Export"){

						?>
						<input type="button" class="btn btn-primary btn-md" style="float: right;background-color:#112B4E; border-color: #112B4E; margin-left: 3px;" onclick="tableToExcel('testtable2', 'W3C Example Table');" value="Export to Excel" />
						<?php }} ?>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="clearfix">
          </div>
          <div class="row">
            <div class="col-md-12">
              <table class="table table-striped table-responsive" id="testtable2">
                <thead>
                  <tr>
                    <th>S.No
                    </th>
                    <th>Email id
                    </th>
                    <th>Package Name
                    </th>
                    <th>Package Marks
                    </th>
					<th>Get Marks
                    </th>
					<th>Get Neurons
                    </th>
                    <th>Time taken
                    </th> 
					<th>Total Time
                    </th>
					<th>Total Neurons
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
$a=1;
foreach ($user_list as $user) { 
	$uid=$user['mm_uid'];
	$package_details=$this->Crud_modal->fetch_single_data("*","mm_packages","package_id='36'");
	$count_val=$this->Crud_modal->check_numrow('score',"package_id='36' and u_id='$uid'");
	
	if($count_val==3){
	$package_neurons=$this->Crud_modal->all_data_select("sum(marks) as marks,sum(neurons) as neurons,SEC_TO_TIME( SUM( TIME_TO_SEC( `time_taken` ) ) ) AS timeSum","score","package_id='36' and u_id='$uid' ","score_id asc");
	if(sizeof($package_neurons[0]['neurons'])!=''){
?>
                  <tr>
                    <td>
                      <?php echo $a; ?>
                    </td>
					<td>
                      <?php echo $user['mm_user_email']; ?>.
                    </td> 
                    <td>
                      <?php echo $package_details['package_name']; ?>.
                    </td>
                    <td>
                      <?php echo $package_details['total_marks']; ?>
                    </td>
					<td>
                      <?php echo $package_neurons[0]['marks']; ?>
                    </td>
					<td>
                      <?php echo $package_neurons[0]['neurons']; ?>
                    </td>
					<td>
                      <?php echo $package_neurons[0]['timeSum']; ?>
                    </td>
					<td>
                      <?php echo "00:50:00"; ?>
                    </td>
					<td>
                      <?php echo $package_details['total_marks']; ?>
                    </td>
                  </tr>
                  <?php
$a++;
}
}
}
?>
                </tbody>
              </table>
            </div>
          </div>
        </section>
      </div>
      <div class="col-md-1">
      </div>
    </div>
  </div>
  <!-- /.content -->
  <div class="clearfix">
  </div>
</div>
<!-- Modal -->

<!--// Delete// -->
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
