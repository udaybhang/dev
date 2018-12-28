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
		border-bottom: 1px solid #ecf0f5;
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
	.box-col {
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
	.dd-mar {
		margin-left: -27px;
	}
	.btn-col {
		background-color: #112B4E;
		border-color: #ecf0f5;
	}
	.myselectid {
		width: 100%;
		height: 105px !important;
		margin-top: 0px !important;
	}
	.mycountry {
		width: 100%;
		height: 105px !important;
	}
	#mycountryId2{
		width: 100%;
		height: 225px !important;
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
<div class="col-md-2"></div>
<div class="col-md-8">
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
	<h2 class="lel">Package Map</h2> </div>
</div>
<div class="clearfix" style="margin-top: 20px;"></div>
<div class="">
	<div class="col-md-12"> </div>
</div>
<!-- /.box-header -->
<div class="clearfix"></div>
<div class="row">
<div class="col-md-12">
<section class="content">
<!-- SELECT2 EXAMPLE -->
<div class="box box-col">

<!-- /.box-header -->
<div class="box-body" style="margin-top:20px;">
	<div class="row">
		<div class="col-md-12">
		<form action="<?php echo base_url() ?>mapped-package" method="post">
			<div class="col-md-4" style="padding:0px !important;">
			<select multiple id="allpackage" style="height: 250px; width: 100%;">
			<?php
			foreach ($package_lists as $package_list) {
			?>
			<option value="<?php echo $package_list['package_id'] ?>"><?php echo $package_list['package_name'] ?></option>
			<?php
			}
			?>
			</select>
			<label>Total Packages <span id="tval"></span> / <?php echo sizeof($package_lists); ?></label>
			</div>
			<div class="col-md-4" style="text-align: center;">
				<div class="col-md-12">
					<select class="form-control" name="user_type_id" id="blockchange">
						<option value="" selected="selected">Select User Type</option>
						<?php
							foreach ($u_types as $u_type) {
						?>
						<option value="<?php echo $u_type['user_type_id']?>"><?php echo $u_type['type_name']?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="col-md-12" style="margin-top: 10px;">
				<button id="add" type="button" class="btn btn-warning btn-default" style="background-color: #112B4E; border-color: #112b4e; color: #fff;">&gt; &gt;</button>
				</div>
				<div class="col-md-12" style="margin-bottom: 10px;">
				<button id="remove" type="button" class="btn btn-warning btn-default" style="background-color: #112B4E; border-color: #112b4e; color: #fff;margin-top: 5px;">&lt; &lt;</button>
				</div>
			</div>
			<div class="col-md-4" style="padding:0px !important;">
			<select multiple id="selpackage" style="height: 250px; width: 100%;" name="selpackage[]"></select>
			<label> <span id="c1val1">0</span> / <?php echo sizeof($package_lists); ?></label>
			</div>
			<!-- /.form group -->
			<?php 
                   $permission_array=$this->session->userdata('permission_array');
                   for($i=0;$i<sizeof($permission_array);$i++){
                        $p =$this->Crud_modal->fetch_single_data('permission_description','master_permission',"permission_id='$permission_array[$i]'");
                        $permission[] = $p["permission_description"];
                   }
            ?>
            <?php if(in_array("Map", $permission)){ ?>
								
			<input type="submit" class="btn btn-warning btn-default pull-right" style="background-color: #112B4E; border-color: #112b4e; color: #fff;margin-top: 25px;" value="Map" />
			<?php } ?>
		</form>
		</div>
		<!-- /.box-body -->

</div>
</div>
<!-- /.box -->
</div>
</section>
</div>
<!-- /.content -->
</div>
</section>
</div>

<!-- /.content -->
<div class="clearfix"></div>
</div>
</div>
</div>
	<!--  jQuery -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script>

		$("#add").click(function(){
			if($('#allpackage').val()!=null){
				if($('#blockchange').val()!=''){
					$("#allpackage option:selected").remove().appendTo($("#selpackage"));

					$("#tval").text($("#allpackage option").length);
					$("#c1val1").text($("#selpackage option").length);
				}else{
					alert('You must select User Type');
				}
			}else{
				alert('You must select package');
			}
		});
		$("#remove").click(function(){
			if($('#selpackage').val()!=null){
				if($('#blockchange').val()!=''){
					$("#selpackage option:selected").remove().appendTo($("#allpackage"));

					$("#c1val1").text($("#selpackage option").length);
					$("#tval").text($("#allpackage option").length);
				}else{
					alert('You must select User Type');
				}
			}else{
				alert('You must select package');
			}
		});

		$("#tval").text($("#allpackage option").length);

		$('#blockchange').change(function(){
			$.ajax({
				method: "POST",
				data: {'user_type_id': $(this).val()},
				url: "<?php echo base_url() ?>package-load",
				dataType: "Json",
				success: function(result){

					if(result.pack_ids!=''){
						var pkgids;
						for (var i = 0; i < result.pack_ids.length; i++) {
							pkgids += '<option value="'+result.pack_ids[i].package_id+'" selected="selected">'+result.pack_ids[i].package_name+'</option>';
						}
						$('#selpackage').html(pkgids);
						$("#c1val1").text($("#selpackage option").length);
					}else{
						$('#selpackage').html('');
						$("#c1val1").text($("#selpackage option").length);
					}

					if(result.all_pack_ids!=''){
						var allpkg;
						for (var i = 0; i < result.all_pack_ids.length; i++) {
							allpkg += '<option value="'+result.all_pack_ids[i].package_id+'">'+result.all_pack_ids[i].package_name+'</option>';
						}
						$('#allpackage').html(allpkg);
						$("#tval").text($("#allpackage option").length);
					}else{
						$('#allpackage').html('');
						$("#tval").text($("#allpackage option").length);
					}

				}
			});
		});

	</script>