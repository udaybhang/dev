
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
	    .uerdate{
	    	text-decoration: underline;
	    	color: #3c8dbc;
	    	cursor: pointer;
	    }

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	
	<div class="row main">
		<div class="col-md-12">
			<div class="col-md-10 col-md-offset-1">
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
							<h2 class="lel">Pending Submission Detail</h2> </div>
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
        	<div class="col-md-12">
          	<input type="button" class="btn btn-primary btn-md" style="float: right;background-color:#112B4E; border-color: #112B4E;" onclick="tableToExcel('testtable2', 'Excel Report');" value="Export to Excel" />
          	</div>

        </div>
      </div>
      <!-- /.box -->

	          	<div class="col-md-12" style="padding-top: 10px;">
	          		<?php //print_r($case_unched); ?>
	          	<table class="table table-striped table-responsive" id="testtable2">
								<thead>
					<tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Package</th>
                  <th>Assignment</th>
                  <th>Level</th>
                  <th>Click</th>
					</tr>
								</thead>
								<tbody>
				<?php
					$a=1;
					//print_r($case_unched);
					foreach ($case_unched as $all_date) {
						$user_id=$all_date['u_id'];
						$caseid=$all_date['case_id'];
						$as_id=$all_date['maid'];
						$level_id=$all_date['ml_id'];

						$data['user_info']=$this->Crud_modal->all_data_select("mm_user_full_name, mm_last_name, mm_user_email","user","mm_uid='$user_id'","mm_uid ASC");
						//print_r($data['user_info']);
						$data['package_info'] = $this->Crud_modal->all_data_select("package_id, package_name","mm_packages","FIND_IN_SET('$as_id', 	ma_id)","package_id ASC");
						$data['assigninfo_info']=$this->Crud_modal->all_data_select("assignment_name","master_assignment","maid='$as_id'","maid ASC");
						$data['level_info']=$this->Crud_modal->all_data_select("lvl_name","master_level","ml_id='$level_id' and maid='$as_id'","ml_id ASC");

					
						
				?>
				<tr>
					<td><?php echo $a; ?>.</td>
					<td><?php echo $data['user_info'][0]['mm_user_full_name']." ".$all_date['user_info'][0]['mm_last_name']; ?></td>
					<td><?php echo $data['user_info'][0]['mm_user_email']; ?></td>
					<td><?php echo $data['package_info'][0]['package_name']; ?></td>
					<td><?php echo $data['assigninfo_info'][0]['assignment_name']; ?></td>
					<td><?php echo $data['level_info'][0]['lvl_name']; ?></td>
					<td>
						<?php 
                    $pck_id = $data['package_info'][0]['package_id'];
					$qurstr1=rtrim(strtr(base64_encode($user_id), '+/', '-_'), '=');//User Id
					$qurstr2=rtrim(strtr(base64_encode($caseid), '+/', '-_'), '=');//Case Id
					$qurstr3=rtrim(strtr(base64_encode($as_id), '+/', '-_'), '=');//Assignment Id
                    $qurstr5=rtrim(strtr(base64_encode($level_id), '+/', '-_'), '=');//Level Id
					$qurstr6=rtrim(strtr(base64_encode($pck_id), '+/', '-_'), '=');//Package Id

					?>
				<a href="<?php echo base_url();?>subjective-user-score/<?php echo $qurstr1.'-'.$qurstr2.'-'.$qurstr3.'-'.$qurstr5.'-'.$qurstr6 ?>">view more
                    </a>
					</td>
					
				</tr>

				<?php
				$a++;
				}
				?>
					</tbody>
				</table>
				<a href="<?php echo base_url()?>admin-home" type="button" class="btn btn-primary btn-md pull-left" style="float: right;background-color:#112B4E; border-color: #112B4E;">Back</a>
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