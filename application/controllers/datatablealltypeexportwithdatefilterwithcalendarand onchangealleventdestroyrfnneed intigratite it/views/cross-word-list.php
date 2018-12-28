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
			<div class="col-md-10">
				<?php
				if($this->session->flashdata('cross_word_message')){
					echo $this->session->flashdata('cross_word_message');
				}
				?>
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="background-color: #587EA3">
						<div class="col-md-12">
							<h2 class="lel">Cross word List</h2> </div>
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
					            <div class="col-md-12">
					            	<?php 
				                            $permission_array=$this->session->userdata('permission_array');
				                                for($i=0;$i<sizeof($permission_array);$i++){
				                                  $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
				                                  if($p["permission_description"]=="Export"){

				                    ?>
									<input type="button" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E; margin-left: 3px;" onclick="tableToExcel('testtable2', 'W3C Example Table');" value="Export to Excel" />
									<?php }} ?>
							<form action="<?php echo base_url()?>cross-word-list" method="post" id="filtercheck">
				        	<div class="col-md-3">
				        	
				        		<select class="form-control" name="assignorder" id="assignorder">
				        			<option value="">Select Topic</option>
				        			<?php
				        				foreach ($topic_list as $list) {
				        					$allasid = $list['t_id'];
				        					if($allasid==$asid){
				        						echo $sel;
				        						$sel = 'selected="selected"';
				        					}else{
				        						$sel = '';
				        					}
				    				?>
				    				<option value="<?php echo $list['t_id']; ?>" <?php echo $sel; ?>><?php echo $list['t_name']; ?></option>
				    				<?php
				        				}
				        			?>
				        		</select>
				        	</div>
        				</form>
        				<?php 
                                for($i=0;$i<sizeof($permission_array);$i++){
                                  $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
                                  if($p["permission_description"]=="Create"){

                    	?>
						<a href="<?php echo base_url()?>crossword-create">
						<button type="button" class="btn btn-primary btn-md" style="float: right; background-color:#112B4E; border-color: #112B4E; margin-left: 3px; ">Create Cross Word</button></a>
						<?php }} ?>

					</div>
              
              

             
            </div>
            </div>
							<table class="table table-striped table-responsive" id="testtable2">
								<thead>
					<tr>
                  <th>S.No</th>
                    <th>Question</th>
				    <th>Hint</th>
					<th>Topic</th>
					<th>Type</th>
					<th>Skills</th>
					<th>Case</th>
					<th>Created Date</th>
					<th>Action</th>
					</tr>
								</thead>
								<tbody>
				<?php
					$a=1;
					foreach ($cross_word_list as $crossword_list) {
				?>
				<tr>
					<td><?php echo $a ?>.</td>
					<td><?php echo $crossword_list['crossword_question'] ?></td>
					<td><?php 
					$s=1;
						 $worddetective_hint = explode('||', $crossword_list['crossword_hint']);
						 foreach ($worddetective_hint as $value) {
						 	echo $s.". ".$value."<br/>";
						 	$s++;
						 }
						 
						 ?></td>
					
					<td><?php 
						$topicid = $crossword_list['topic'];
						$where = "t_id='$topicid'";
						$rval = $this->Crud_modal->fetch_single_data('t_name','master_topic',$where);
						echo $rval['t_name'] ?></td>
					<td><?php
						$typeid = $crossword_list['type'];
						$where = "type_id='$typeid'";
						$rval = $this->Crud_modal->fetch_single_data('type_name','master_type',$where);
						echo $rval['type_name']; ?></td>
					<td><?php 
						$skillid = $crossword_list['skill_tested'];
						$where = "skills_id='$skillid'";
						$rval = $this->Crud_modal->fetch_single_data('skills_name','master_skills_test',$where);
						echo $rval['skills_name'] ?></td>
					<td><?php 
						$caseid = $crossword_list['case_id'];
						$where = "case_id='$caseid'";
						$rval = $this->Crud_modal->fetch_single_data('case_name','case_study',$where);
						echo $rval['case_name'] ?></td>
					<td><?php echo  date('d-m-Y',strtotime($crossword_list['created_date'])) ?></td>
					<td>
						<?php 
                             for($i=0;$i<sizeof($permission_array);$i++){
                               $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
                               if($p["permission_description"]=="View"){
                    	?>
						<a href="<?php echo base_url().'cross-word-view/'.rtrim(strtr(base64_encode($crossword_list['crossword_id']), '+/', '-_'), '='); ?>">&nbsp;View&nbsp;</a>
						<?php }if($p["permission_description"]=="Edit"){ ?>
						<a href="<?php echo base_url().'cross-word-edit/'.rtrim(strtr(base64_encode($crossword_list['crossword_id']), '+/', '-_'), '='); ?>">&nbsp;Edit&nbsp;</a>
						<?php }if($p["permission_description"]=="Delete"){ ?>
						<a href="<?php echo base_url().'cross-word-delete/'.rtrim(strtr(base64_encode($crossword_list['crossword_id']), '+/', '-_'), '='); ?>">&nbsp;Delete&nbsp;</a>
						<?php }} ?>
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