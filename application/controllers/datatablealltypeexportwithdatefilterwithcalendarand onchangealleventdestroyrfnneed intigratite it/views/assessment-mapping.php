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
	 select[multiple="multiple"]{
	 	height: 200px;
	 }

</style>
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
							<h2 class="lel">Assessment Mapping</h2> </div>
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
          <h3 class="box-title">Assessment Mapping</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
            <form action="<?php echo base_url() ?>assesment-mapped" method="post">
             <!-- /.form-group -->
              <div class="form-group">
                <label>Select Assignment</label>
                <select id="assignlist_select" name="assign_select" required="required" class="form-control select2" style="width: 100%;">
                	<option value="">Select Assignment</option>
                  <?php
                  	foreach ($assignlist as $assignlists) {
                  		$allassignm = $assignlists->maid;
                  		$aresult = $this->Admindashboard_modal->mapping_assigment($allassignm);
					for($ar=0;$ar<sizeof($aresult);$ar++){
                  		if($aresult[$ar]->p_id == ''){
	                ?>
	                <option value="<?php echo $assignlists->maid; ?>"><?php echo $assignlists->assignment_name; ?></option>
	                <?php
	                break;
	            		}
                  	}
	             	}
	                ?>
                </select>
              </div>
               <!-- /.form-group -->
              <div class="form-group" id="level_val">
                <input type="hidden" name="ml_id" value="">
              </div>
              <div class="form-group" id="parameters" style="display: none;">
                <label>Select Parameters</label>
                <select name="assesment_select[]" multiple="multiple" class="form-control select2" style="width: 100%;">
                  <?php
                  	foreach ($assesmentlist as $assesmentlists) {
                  ?>
                  <option value="<?php echo $assesmentlists->p_id; ?>"><?php echo $assesmentlists->name.' ('.$assesmentlists->method.') '; ?></option>
                 <?php
             		}
                 ?>
                </select>
              </div>
               <?php 
            	$permission_array=$this->session->userdata('permission_array');
					for($i=0;$i<sizeof($permission_array);$i++){
					    $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
					    if($p["permission_description"]=="Create"){
			   ?>
				<input type="submit" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E" value="Submit" />
			   <?php }} ?>
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
          url: "<?php echo base_url() ?>get-assesment-levels",
          success: function(result){
            if(result != ""){
              $("#level_val").html(result);
              $("#parameters").fadeIn();
            }else{
              $("#parameters").fadeOut();
              $("#level_val").html('<input type="hidden" name="ml_id" value=""><label>No Label Found</label>');
            }
          }
        });
      }else{
        $("#parameters").fadeOut();
        $("#level_val").html('<input type="hidden" name="ml_id" value="">');
      }
    });
</script>