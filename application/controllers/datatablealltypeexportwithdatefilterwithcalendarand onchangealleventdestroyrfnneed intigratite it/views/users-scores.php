
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
							<h2 class="lel">Completed Level User</h2> </div>
					</div>
					<div class="clearfix" style="margin-top: 20px;"></div>
					<div class="">
						<div class="col-md-12">
							<?php 
                        $permission_array=$this->session->userdata('permission_array');
                        //print_r($permission_array);
                            for($i=0;$i<sizeof($permission_array);$i++){
                              $p =$this->Crud_modal->fetch_single_data('permission_description','master_permission',"permission_id='$permission_array[$i]'");
                              
                              $permission[] = $p["permission_description"];
                              
                            }
                            // print_r($permission);               

                        ?>
							</div>
					</div>
					<!-- /.box-header -->
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12">
							
							 <section class="content">
							 	      <div class="box box-col">
        <div class="box-header with-border">
	        <div class="col-md-6">
	        	<?php if(in_array("Export", $permission)){ ?>
	        	<input type="button" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E; margin-left: 3px;" onclick="tableToExcel('testtable2', 'user score data');" value="Export to Excel" />
	        	<?php } ?>
	      	</div>
			 <div class="col-md-6" >
        <div class="dataTables_length"  style="margin-top: 10px!important;float: right;">
          <form action="<?php echo base_url() ?>user-scores" method="post" id="formsub">
            <?php if($assign_id==20){$select1="selected"; } else{
              $select2="selected";
            } ?>
          <label>Show <select name="testtable2_length" aria-controls="testtable2" id="select_box" class="form-control input-sm dataaction1"><option <?php echo $select1; ?> value="20">20</option><option <?php echo $select2; ?> value="<?php echo $this->Crud_modal->check_numrow("completed_level","status=1"); ?>">All</option></select> entries</label>
          </form>
        </div>
      </div>
        </div>
      </div>
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-col">
        <div class="box-header with-border">

        	<div class="col-md-6">
          

        </div>
      </div>
      <!-- /.box -->

	          	<div class="col-md-12" style="padding-top: 10px;">
	          	<table class="table table-striped table-responsive" id="testtable2">
								<thead>
					<tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Assignment Name</th>
                  <th>Level Name</th>
                  <th>Avg Score</th>
				  <th>Completed Date</th>
					</tr>
								</thead>
								<tbody id="alldatas">
				<?php
					$a=1;
					foreach ($user_score as $user_score1) {
					?>
				<tr>
					<td><?php echo $a;?>.</td>
					<td><?php 
							echo ucwords(strtolower($user_score1['mm_user_full_name']));
					 	?></td>
					<td><?php 
							echo $user_score1['mm_user_email'];
					 	?></td>
					<td><?php echo $user_score1['assignment_name'] ?></td>
					<td><?php echo $user_score1['lvl_name'] ?></td>
					<td><?php echo round($user_score1['score'],2); ?></td>
					<td><?php echo date('d-m-Y',strtotime($user_score1['end_time'])); ?></td>
				</tr>

				<?php
				$a++;
				}
				?>
					</tbody>
				</table>
		<style type="text/css">
  .pagination>li>p>a {
    background: #fafafa;
    color: #666;
}
.pagination>li>p>a{
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #337ab7;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
}
.pagination>li>p>strong {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #fff;
    text-decoration: none;
    background-color: #337ab7;;
    border: 1px solid #ddd;
}
a {
    color: #3c8dbc;
}
a {
    color: #337ab7;
    text-decoration: none;
}
</style>

              <div class="col-sm-7" style="float: right;">
                <div class="" >
                  <ul class="pagination">
                    <li class=""><p><?php echo $links; ?></p></li>
                  </ul>
                </div>
              </div>
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
  $("#select_box").change(function(){
    $("#formsub").submit();
  });
// $('#usertype,#userorder').change(function(){
// 	$('#filtercheck').submit();
// });
	

	


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