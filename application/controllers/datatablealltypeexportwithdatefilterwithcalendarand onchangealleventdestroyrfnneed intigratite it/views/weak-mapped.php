
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
	              if($this->session->flashdata('data_message')){
	              	echo $this->session->flashdata('data_message');
	              }
	              ?>
				</div>
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="background-color: #587EA3">
						<div class="col-md-12">
							<h2 class="lel">Week Mapping</h2> </div>
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
          <h3 class="box-title">Week Mapping</h3>
          <a href="<?php echo base_url()?>week-map" class="btn btn-primary btn-md" style="float: right;background-color:#112B4E; border-color: #112B4E">Map Days</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
            <form action="<?php echo base_url() ?>week-mapped" id='mapsub' method="post">
             <!-- /.form-group -->
             <div class="form-group">
                <label>Select Week </label>
                <select name="weak_select" class="form-control select2" style="width: 100%;">
                	<option value="">Select Week </option>
                  	<?php
	                	foreach ($weakslist as $value) {
	                		if($weak_select==$value['weak_id']){
	                			$sel = ' selected="selected"';
	                		}else{
	                			$sel = '';
	                		}
	                ?>
	                	<option value="<?php echo $value['weak_id']; ?>" <?php echo $sel; ?>><?php echo $value['weak_name']; ?></option>
	                <?php
	             		}
	                ?>
                </select>
              </div>
              <div class="form-group" id="morelist">
                <label>Days List</label>
				<ul>
					<?php
					
						foreach ($as_lists as $asvalue1) {
						
							$rday = $this->Crud_modal->fetch_single_data('day','days_assignment',"d_id='$asvalue1'");
					?>
					<li><?php echo $rday['day'];?></li>
					<?php
						}
					?>
				</ul>
              </div>
              <div class="form-group morelist" style="display: none;">
                <label>Selected Days</label>
				<select name="days_list[]" class="form-control" multiple="multiple" required="">
					<?php
						foreach ($as_lists as $asvalue) {
							$rday = $this->Crud_modal->fetch_single_data('d_id,day','days_assignment',"d_id='$asvalue'");
					?>
						<option value="<?php echo $rday['d_id'] ?>" selected="selected"><?php echo $rday['day'] ?></option>
					<?php
						}
					?>
				</select>
              </div>
              <div class="form-group morelist" style="display: none;">
                <label>Select More Days</label>
				<select name="days_list[]" class="form-control" multiple="multiple" required="">
					<?php
						$i=0;
						foreach ($dayslist as $ridday) {
							if($ridays[$i]!=$ridday['d_id']){
					?>
						<option value="<?php echo $ridday['d_id'] ?>"><?php echo $ridday['day'] ?></option>
					<?php
							}else{
								$i++;
							}
						}
					?>
				</select>
              </div>
              <?php
              if($as_lists!=''){
              ?>
              <input type="button" class="btn btn-primary btn-md" id="addmore" style="float: right;background-color:#112B4E; border-color: #112B4E;" value="Add More Days" />
              <?php
				}
              ?>
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
	$(document).ready(function(){
		$('.select2').change(function(){
			if($('#mapsub').attr('action')!='week-map-update'){
				$('#mapsub').submit();
			}else{
				$('#mapsub').removeAttr('action');
				$('#mapsub').attr('action','week-mapped');
				$('#mapsub').submit();
			}
		});
		$('#addmore').click(function(){
			$('#morelist').fadeOut();
			$('.morelist').slideDown();
			$(this).val('Update');
			$('#mapsub').removeAttr('action');
			$('#mapsub').attr('action','week-map-update');
			$(this).removeAttr('type');
			$(this).attr('type','submit');
		});
	});
</script>