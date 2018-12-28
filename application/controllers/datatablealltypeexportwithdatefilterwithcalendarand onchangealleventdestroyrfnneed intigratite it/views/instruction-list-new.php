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
          background-color: #112B4E;0
    border-color: #ecf0f5;
   }
   .ul-mar{
	margin-top: 35px; width: 
   }

   /* Sohrab 29 apr 2017 */
   .danger{
		background-color: #f2dede;
	    border-color: #ebccd1;
	    color: #a94442;
		text-align: center;
		margin:auto;
		margin-bottom: 15px;
		margin-top: 30px;
		padding: 10px;
		width: 50%;
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
		width: 50%;
		box-shadow: 0px 0px 10px #d6e9c6;
	    }

	.assignlink, .editassignlink{
		color: #3c8dbc;
		cursor: pointer;
	}
	.assignlink:hover,.assignlink:active,.assignlink:focus, .editassignlink:hover, .editassignlink:active, .editassignlink:focus {
		outline:none;
		text-decoration:none;
		color:#72afd2
	}
</style>
<style type="text/css">
  a[data-ci-pagination-page]{
    padding: 5px 10px 5px 10px;
    width: 25px;
    height:20px;
    background: #ddd;
    margin:1px;
    color:#000;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="row main">
		<div class="col-md-12">
			<div class="col-md-10 col-md-offset-1">
	            <div class="col-md-12">
						<?php echo $this->session->flashdata('item');  ?>
				</div>
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="background-color: #587EA3">
						<div class="col-md-12">
							<h2 class="lel">Instruction List</h2> 
						</div>
					</div>
					<div class="clearfix" style="margin-top: 20px;"></div>
					<div class="">
						<div class="col-md-12"></div>
					</div>
					<!-- /.box-header -->
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12">
							<div class="box box-col">
							<div class="box-header">
								<div class="col-md-6">
					              <form action="<?php echo base_url() ?>instruction-list-new" method="post" id="sssss">
									<div class="col-md-3">
				                        <select name="nor" id="nor" class="form-control">
				                            <option value="10" <?php if($tsearch==10){ echo "selected='selected'"; }?>>10</option>
				                            <option value="20" <?php if($tsearch==20){ echo "selected='selected'"; }?>>20</option>
				                            <option value="30" <?php if($tsearch==30){ echo "selected='selected'";}?>>30</option>
				                            <option value="50" <?php if($tsearch==50){ echo "selected='selected'";}?>>50</option>
				                        </select>records
		                          		<input type="hidden" name="pageh" id="pageh">
		                     		</div>
		                     	  </form>
		                     		<div class="col-md-2">
		                        		<input type="button" class="btn btn-primary btn-md"  id="submit" value="Search">
		                    		</div>
					            </div>
					            <?php 
					            $permission_array=$this->session->userdata('permission_array');
					            			for($i=0;$i<sizeof($permission_array);$i++){
					            				$p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
					            				//echo $p["permission_description"];
					            				if($p["permission_description"]=="Create"){

					            	?>
					            	<div class="col-md-6">
					            		<a href="<?php echo base_url() ?>add-instruction">
										  <button type="button " class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E; margin-left: 3px; ">Create Instruction</button>
										</a>
									</div>
					            	<?php
					            				}else{
					            				}
					            			}
					            	?>

					        </div>
				            </div>
							<table class="table table-striped table-responsive" id="testtable2">
								<thead>
					<tr>
                  <th>S.No</th>
				  <th>Instruction Name</th>
	          
					<th></th>
					</tr>
								</thead>
								<tbody>

				<?php
					$a=$row+1;	
					foreach ($result as $list) {
				?>
				 
				<tr>
					<td><?php echo $a; ?>.</td>
					<td><?php echo $list['instruction_name']; ?></td>
					<td>
					 	<?php 
						    for($i=0;$i<sizeof($permission_array);$i++){
						       $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
						       if($p["permission_description"]=="Edit"){

						?>
						    <a class="editassignlink" href="<?php echo base_url().'update-instruction/'.rtrim(strtr(base64_encode($list["instruction_id"]), '+/', '-_'), '='); ?>">&nbsp;Edit&nbsp;</a>
						<?php
						       }
						       if($p["permission_description"]=="Delete"){
							 	 	$k=0; foreach ($select_inst as $value){
							 		   if($value['inst_id']==$list["instruction_id"]){$k++;}
							    	}
							 		if($k==0){ 
						?>
							<a class="editassignlink" href="<?php echo base_url().'delete-instruction/'.rtrim(strtr(base64_encode($list["instruction_id"]), '+/', '-_'), '='); ?>">&nbsp;Delete&nbsp;</a>
						<?php		}
						       }
						       if($p["permission_description"]=="View"){
						?>
							<a class="editassignlink" href="<?php echo base_url().'instruction-one/'.rtrim(strtr(base64_encode($list["instruction_id"]), '+/', '-_'), '='); ?>">&nbsp;View&nbsp;</a>
						<?php
						       }
						    }
						?>
				    </td>
				</tr>
				<?php
					$a++;
				}
				?>
            	
				
								</tbody>
							</table>
							<p style="margin-top:10px"><?= $pagination; ?></p>
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
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="top: 20%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Are you sure want to delete?</h4>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default deletassign" id="">Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="container">
	<!-- Modal -->
	<div class="modal fade" id="editModal" role="dialog">
		<div class="modal-dialog" style="top: 10%;">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Edit Assignment</h4>
				</div>
				<div class="box box-primary">
					<div class="box-header with-border">
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<form role="form" action="<?php echo base_url() ?>assign-update" method="post" enctype="multipart/form-data">
						<div class="box-body">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="exampleInputname">Assignment Number<span  class="required-sp">*</span></label>
										<input type="text" class="form-control" name="assignment_number" id="assignment_number" value=""  placeholder="Assignment Number" maxlength="30" readonly="">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="exampleInputname">Created Date<span  class="required-sp">*</span></label>
										<input type="text" class="form-control" name="assignment_date" id="assignment_date" value=""  placeholder="Assignment Date" maxlength="30" readonly="">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="exampleInputname">Assignment Name<span  class="required-sp">*</span></label>
										<input type="text" class="form-control" id="assignment_name" name="assignment_name" value=""  placeholder="Assignment Name" maxlength="30" required="">
									</div>
								</div>
								<!-- /.col -->
								<div class="col-md-6">
									<!-- /.form-group -->
									<div class="form-group">
										<label>No of levels</label>
										<select name="assign_lvl" id="assign_lvl" class="form-control select2" style="width: 100%;"></select>
									</div>
									<!-- /.form-group -->
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="exampleInputEmail1">Assignment Description</label>
										<textarea name="assignment_description" id="assignment_description" class="form-control" style="height: 100px;"></textarea>
									</div>
								<!-- /.form-group -->
								</div>
							</div>
							<!-- /.col-lg-6 -->
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button style="float:right" type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
					<!-- form END -->
					<!-- /.box -->
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(".assignlink").click(function(){
		var assignid = $(this).attr("data-id");
		$(".deletassign").attr("id",assignid);
	});
	$(".editassignlink").click(function(){
		$.ajax({
		  method: "POST",
		  data: {'assignid': $(this).attr("data-id")},
		  url: "<?php echo base_url() ?>edit-assign-form",
		  dataType: "JSON",
		  success: function(result){
		  	$("#assignment_number").val(result.mas_id);
		  	$("#assignment_date").val(result.created_date);
		  	$("#assignment_name").val(result.assignment_name);
		  	$("#assignment_description").val(result.assignment_description);
		   	var opt;
		  	var nlv = result.number_of_level;
		  	var slv = result.sizelevel;

	  		if(slv==nlv){
	  			$("#assign_lvl").attr('readonly','readonly');
	  		}

		  	for(var asi=1;asi<20;asi++){
		  		opt += '<option value="'+asi+'"';
		  		if(asi == result.number_of_level){
		  			opt += " selected=selected";
		  		}
		  		opt += '>'+asi+'</option>';
			}
		  	$("#assign_lvl").html(opt);
		  }
		});
	});
	$(".deletassign").click(function(){
		$.ajax({
		  method: "POST",
		  data: {'assignid': $(this).attr("id")},
		  url: "<?php echo base_url() ?>delete-assignment",
		  dataType: "JSON",
		  success: function(result){
			location.reload();
		  }
		});
	});
</script>
<script>
  $(function () {
    $('#testtable2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $("a[data-ci-pagination-page]").click(function(e){
      
      e.preventDefault();
        var aval = $(this).attr('href');
        var s = aval.split('/'); 
        var w = parseInt(s[s.length-1]);
        
        if($.isNumeric(w)){
            var page = w;
            $('#pageh').val(page);
            $(this).attr("href", "");
            $('#sssss').submit();
        }else{
            $('#pageh').val(1);
            $('#sssss').submit();
        }
    });
    });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','#submit',function(){
           $('#sssss').submit();  
    });
  }); 
</script>