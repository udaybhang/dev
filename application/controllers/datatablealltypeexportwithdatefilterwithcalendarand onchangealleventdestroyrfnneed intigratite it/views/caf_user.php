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
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	
	<div class="row main">
		<div class="col-md-12">
			<div class="col-md-1"></div>
			
				<?php
				if($this->session->flashdata('data_message')){
					echo $this->session->flashdata('data_message');
				}
				?>
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="background-color: #587EA3">
						<div class="col-md-12">
							<h2 class="lel">Users CAF</h2> </div>
					</div>
					<div class="clearfix" style="margin-top: 20px;"></div>
					<div class="">
						<div class="col-md-12">
							<?php // print_r($match_lists); die(); ?>
							</div>
					</div>
					<!-- /.box-header -->
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12">
							<div class="box box-col">
							<div class="box-header">
<form action="<?php echo base_url() ?>caf-user" method="post" id="reg_user_search_form">
                  <div class="col-md-9">
                    <div class="col-md-4">
                       <label style="float:left; margin-top: 6px">Start Date : </label>
                       <div class="col-md-7">
                       <input type="text" class="form-control datecalender" name="fromdate" value="<?php if($f_date !=''){ echo $f_date;}?>"/>
                       </div>
                    </div>
                    <div class="col-md-4">
                     <label style="float: left; margin-top: 6px">End Date : </label>
                     <div class="col-md-7">
                       <input type="text" class="form-control datecalender" name="todate" value="<?php if($t_date !=''){ echo $t_date;}?>"/>
                     </div>
                    </div>
                    <div class="col-md-3">
                       <input type="button" class="btn btn-primary btn-md"  id="search_button" value="Search">
                    </div>
                   </div>
                </form>
					            <div class="col-md-3" style="float:right;">
					    <?php 
			                $permission_array=$this->session->userdata('permission_array');
			                for($i=0;$i<sizeof($permission_array);$i++){
			                    $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
			                    if($p["permission_description"]=="Export"){

			            ?>
						<input type="button" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E; margin-left: 3px;" onclick="tableToExcel('example1', 'W3C Example Table');" value="Export to Excel" />
						<?php }} ?>
						
              

             
            </div>
            </div><div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
               <thead>
               <tr>
                 <th>Sr.no</th>
                 <th>Name</th>
                 <th>Fathe Name</th>
                 <th>Dob</th>
                 <th>Present Address</th>
                 <th>Contact Number</th>
                  <th>State & City</th>
                  <th></th>
               </tr>
               </thead>
               <tbody>
                 <?php $sr=0;foreach($totaluser as $mmprofile){ $sr++;
                      $uid=$mmprofile['mm_uid'];
                      $where="`uid`='$uid'";
                     $name=$this->Crud_modal->all_data_select('*','user_data',$where,'uid asc');
                     $all_state=$this->Userdashboard_modal->state_name_withid($name[0]['state']);
                     $all_city=$this->Userdashboard_modal->cityname_with_cityid($name[0]['city']);
                                             
                       if($name[0]['dob']=='0000-00-00'){
                             $dob='NA';
                           }
                           else{
                   $dob= date('F j,Y',strtotime($name[0]['dob']));
                 }
                 if($all_state['name']=='' || $all_state['name']==null)
                 {
                    $state='NA';
                 }
                 else{
                      $state=$all_state['name']. ' & ';
                 }?>
                 
               <tr>
                 <td><?php echo $sr?></td>
                 <td><?php echo $mmprofile['mm_user_full_name']?></td>
                 <td><?php echo ucfirst($name[0]['father_name'])?></td>
                 <td><?php echo $dob?></td>
                 <td><?php echo $name[0]['present_addr']?></td>
                 <td><?php echo $name[0]['contact_number']?></td>
                  <td><?php echo $state.$all_city['name']?></td>
                  <td><a href="<?php echo base_url()?>preview-data/<?php echo $qurstr=rtrim(strtr(base64_encode($uid), '+/', '-_'), '=');?>">View</a></td>
               </tr>
               <?php }?>
             
               </tfoot>
             </table>
</div>
						</div>
					</div>
				</section>
			
			<div class="col-md-1"></div>
		</div>
	</div>
	<!-- /.content -->
	<div class="clearfix"></div>
</div>


<script>
  $(function () {
    $("#example1").DataTable();
  
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
$(document).ready(function() {
     $(".datecalender").click(function (){
         $(this).datepicker("show").on('change', function () {
           $('.datepicker').hide();
       });
     });
  });
 $(document).ready(function (){
 $("#search_button").click(function() {
   $("#reg_user_search_form").submit();
 });
});
</script>