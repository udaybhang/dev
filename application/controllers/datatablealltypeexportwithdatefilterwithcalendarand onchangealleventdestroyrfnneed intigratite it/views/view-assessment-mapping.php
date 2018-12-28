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
	    option[disabled="disabled"]{
	    	color: #ff0000;
	    }
	.editparameter{
		padding: 0px; text-align:right;height: 34px; line-height:34px;cursor: pointer;
	}

</style>
 <?php 
	 $permission_array=$this->session->userdata('permission_array');
	  for($i=0;$i<sizeof($permission_array);$i++){
		 $p =$this->Crud_modal->fetch_single_data('permission_description','master_permission',"permission_id='$permission_array[$i]'");
		 $permission[] = $p["permission_description"];
	  }
?> 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	
	<div class="row main">
		<div class="col-md-12">
			<div class="col-md-8 col-md-offset-2">
				<div class="col-md-12">
	              <?php
	              if($this->session->flashdata('assesment_insert_message')){
	              	echo $this->session->flashdata('assesment_insert_message');
	              }
	              ?>
				</div>
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="background-color: #587EA3">
						<div class="col-md-12">
							<h2 class="lel">View Assessment Mapping</h2> </div>
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
          <h3 class="box-title">View Assessment Mapping</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
            <form action="<?php echo base_url() ?>update-parameters" method="post">
             <!-- /.form-group -->
              <div class="form-group">
                <label>Select Assignment</label>
                <select id="assignlist_select" name="assign_select" required="required" class="form-control select2" style="width: 100%;">
                  <option value="" selected="selected">Select Assignment</option>
                  <?php
                  	foreach ($assignlist as $assignlists) {
                  		//$sdate = date('d-m-Y',strtotime($assignlists->start_date));
					 	//$todaydate = date('d-m-Y');
					 	//if($sdate >= $todaydate){
                  ?>
                  <option value="<?php echo $assignlists->maid; ?>"><?php echo $assignlists->assignment_name; ?></option>
                 <?php
             			//}
             		}
                 ?>
                </select>
              </div>
               <!-- /.form-group -->
              <div class="form-group" id="level_val" style="display: none;">
              	<label>Select Level</label>
		        <select id="levelselect" name="ml_id" class="form-control select2" style="width: 100%;"></select>
              </div>
              <div class="form-group" id="p-para-list">
              	<div class="col-md-6" style="padding-left: 0px;"><label>Parameters Name</label></div><div class="col-md-6" style="padding-left: 0px;"><label>Method</label></div>
              	<div id="para-list"></div>
              </div>
              <div class="form-group" id="add-para-list" style="display: none;">
              </div>
              <?php if(in_array("Create", $permission)){ ?>
              <div class="form-group" id="addbutton" style="display: none;">
              <input type="button" name="insertpara" class="btn btn-warning btn-default pull-right" style="background-color: #112B4E; border-color: #112b4e; color: #fff; margin-top: 25px;" value="Add More" />
              </div>
              <?php } ?>
          	</form>
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        
      </div>
      <!-- /.box -->

   

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

<script type="text/javascript">
	 // Select Assignment
 	$("#assignlist_select").change(function(){
      if($(this).val() != ""){
        $.ajax({
          method: "POST",
          data: {'assignid': $(this).val()},
          url: "<?php echo base_url() ?>view-assesment-levels",
          success: function(result){
            if(result != ""){
		        var out = '<option value="">Select Level</option>';
		        out += result;
	            $("#levelselect").html(out);
	            $("#level_val").fadeIn();
   				$("#para-list").html('');
				$("#levelselect").change(function(){
					if($(this).val() != ''){
					    $.ajax({
					      method: "POST",
					      data: {'assignids': $("#assignlist_select").val(),'levelid': $(this).val()},
					      url: "<?php echo base_url() ?>view-assesment-parameters",
					      success: function(result){
					      	var p_outv = result;
						    $("#para-list").html(p_outv);
					      	if(p_outv != '<p>No Parameters Found</p>'){
						      	$("#para-list").html(p_outv);
						      	$("#addbutton").fadeIn();
						      	// Delete parameters
						      	$(".editparameter").click(function(){
								 	var editid = $(this).attr("id");
									$.ajax({
									  method: "POST",
									  data: {"mlid": $("#levelselect").val(),"p_id":editid},
									  url: "<?php echo base_url() ?>update-parameters",
									  dataType: "JSON",
									  success: function(results){
									  	alert(results.val);
									  	location.reload();
									  }
									});
								});
								// Add parameters list and bottun change to submit
								$("#addbutton").click(function(){
									$.ajax({
									  method: "POST",
									  data: {"mlid": $("#levelselect").val()},
									  url: "<?php echo base_url() ?>getallparamerts",
									  dataType: "JSON",
									  success: function(resultp){
									  	if(resultp!=''){
											var r = '<select name="addparameter" class="form-control">';
											for(var p=0;p<resultp.length;p++){
												r += '<option value="'+resultp[p].p_id+'">'+resultp[p].name+'</option>';
											}
											$("#add-para-list").html(r);
											$("#add-para-list").fadeIn();
											$("#addbutton input").removeAttr("type");
											$("#addbutton input").attr("type","submit");
											$("#addbutton input").val("Insert");
										}else{
											$("#addbutton").fadeOut();
											$("#add-para-list").html('<strong>No More Parameters</strong>');
											$("#add-para-list").fadeIn();
										}
									  }
									});
								});
							}else{
								$("#add-para-list").fadeOut();
		          				$("#addbutton").fadeOut();
							}
					      }
					    });
					}else{
						$("#para-list").html('');
						$("#add-para-list").fadeOut();
          				$("#addbutton").fadeOut();
						$("#addbutton input").removeAttr("type");
						$("#addbutton input").attr("type","button");
						$("#addbutton input").val("Add More");
					}
				});
            }else{
				$("#level_val").fadeOut();
				$("#para-list").html('');
				$("#add-para-list").fadeOut();
				$("#addbutton").fadeOut();
				$("#addbutton input").removeAttr("type");
				$("#addbutton input").attr("type","button");
				$("#addbutton input").val("Add More");
            }
          }
        });
      }else{
        $("#level_val").fadeOut();
        $("#para-list").html('');
        $("#add-para-list").fadeOut();
        $("#addbutton").fadeOut();
        $("#p-para-list").fadeOut();
      }
      if($("#addbutton input").val()=='Insert'){
		$("#addbutton input").removeAttr("type");
		$("#addbutton input").attr("type","button");
		$("#addbutton input").val("Add More");
      }
    });
</script>