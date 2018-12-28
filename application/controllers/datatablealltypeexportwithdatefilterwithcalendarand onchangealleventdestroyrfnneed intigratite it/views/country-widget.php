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
if($this->session->flashdata('widget_insert_message')){
	echo $this->session->flashdata('widget_insert_message');
}
?>
</div>
<section class="invoice show">
<!-- title row -->
<div class="row" style="background-color: #587EA3">
	<div class="col-md-12">
	<h2 class="lel">Country Widget</h2> </div>
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
		<form action="<?php echo base_url() ?>create-widget" method="post">
			<div class="form-group">
				<label>Widget Name</label>
				<input type="text" class="form-control" name="w_name" required="required" placeholder="Widget Name" />
			</div>
			<!-- /.form-group -->
			<div class="col-md-4" style="padding:0px !important;">
			<select multiple id="countryId" style="height: 250px; width: 200px;">
			<?php
			foreach ($countrylist as $value) {
			?>
			<option value="<?php echo $value->cid ?>"><?php echo $value->name ?></option>
			<?php
			}
			?>
			</select>
			<label>Total Countries <span id="tval"></span> / <?php echo sizeof($countrylist); ?></label>
			</div>
			<div class="col-md-4" style="text-align: center;">
				<div class="col-md-12">
					<select class="form-control" id="blockchange">
						<option value="" selected="selected">Select Block</option>
						<option value="1">One Block</option>
						<option value="2">Two Block</option>
					</select>
				</div>
				<div class="col-md-12" id="radio1" style="margin-top: 20px; display: none;">
				<input type="radio" name="optradio" value="radio1"> <span><strong> Country 1</strong></span>
				</div>
				<div class="col-md-12" style="margin-top: 10px;">
				<button id="add" type="button" class="btn btn-warning btn-default" style="background-color: #112B4E; border-color: #112b4e; color: #fff;">&gt; &gt;</button>
				</div>
				<div class="col-md-12" style="margin-bottom: 10px;">
				<button id="remove" type="button" class="btn btn-warning btn-default" style="background-color: #112B4E; border-color: #112b4e; color: #fff;margin-top: 5px;">&lt; &lt;</button>
				</div>
				<div class="col-md-12" id="radio2" style="display: none;">
				<input type="radio" name="optradio" value="radio2"> <span><strong> Country 2</strong></span>
				</div>
			</div>
			<div class="col-md-4" style=" height: 275px;">
			<div class="col-md-12" id="block2" style="padding:0px !important; display: none;">
			<label>Country 1 - <span id="c1val">0</span></label>
			<select multiple id="mycountryId" class="mycountry" name="country1[]"></select>
			<select multiple id="myselectcountryId" class="myselectid" name="country2[]"> </select>
			<label>Country 2 - <span id="c2val">0</span></label>
			</div>

			<div class="col-md-12" id="block1" style="padding:0px !important; display: none;">
			<label>Selected - <span id="c1val1">0</span></label>
			<select multiple id="mycountryId2" name="country3[]"></select>
			</div>
			</div>
			<!-- /.form group -->
			<input type="submit" class="btn btn-warning btn-default pull-right" style="background-color: #112B4E; border-color: #112b4e; color: #fff;margin-top: 25px;" value="Submit" />
		</form>
		</div>
		<!-- /.box-body -->

</div>
<div class="col-md-12" style="dispaly:none"></div>
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
		var changeval = 0;
		$("#blockchange").change(function(){
			changeval = $(this).val();
			if(changeval == 1){
				$("#block2").hide("fast");
				$("#radio1").hide("fast");
				$("#radio2").fadeOut("fast");
				$("#block1").show(1000);
			}else if(changeval == 2){
				$("#block1").hide("fast");
				$("#radio1").fadeIn(700);
				$("#radio2").fadeIn(700);
				$("#block2").show(1000);

			}else{
				location.reload();
			}
		});


//	add country to other bolock
		$("#add").click(function(){
			if(changeval == 1){
				var c1lnght = parseInt($("#c1val1").text());
				var c1lenght = $("#countryId option:selected").length + c1lnght;
				if(c1lenght>10){
					alert("You can select only 10 value");
				}else{
					$("#countryId option:selected").remove().appendTo($("#mycountryId2"));
				}

				$("#tval").text($("#countryId option").length);
				$("#c1val1").text($("#mycountryId2 option").length);


			}else if(changeval == 2){
				if ($('input[name="optradio"]:checked').val() == "radio1"){
					var c1lnght = parseInt($("#c1val").text());
					var c1lenght = $("#countryId option:selected").length + c1lnght;
					if(c1lenght>10){
						alert("You can select only 10 value");
					}else{
						$("#countryId option:selected").remove().appendTo($("#mycountryId"));
						$("#tval").text($("#countryId option").length);
						$("#c1val").text($("#mycountryId option").length);
					}
				}else if ($('input[name="optradio"]:checked').val() == "radio2"){
					var c2lnght = parseInt($("#c2val").text());
					var c2lenght = $("#countryId option:selected").length + c2lnght;
					if(c2lenght>20){
						alert("You can select only 20 value");
					}else{
						$("#countryId option:selected").remove().appendTo($("#myselectcountryId"));
						$("#tval").text($("#countryId option").length);
						$("#c2val").text($("#myselectcountryId option").length);
					}
				}else{
					$("#warning").fadeIn();
				}
			}else{
				alert("Choose Block");
			}
		});
// remove country from other block
	$("#remove").click(function(){
		if(changeval == 1){
			var c1lnght = parseInt($("#c1val1").text());
			var c1lenght = $("#countryId option:selected").length + c1lnght;
			if(c1lenght>10){
				alert("You can select only 10 value");
			}else{
				$("#mycountryId2 option:selected").remove().appendTo($("#countryId"));
			}

			$("#tval").text($("#countryId option").length);
			$("#c1val1").text($("#mycountryId2 option").length);


		}else if(changeval == 2){
			if ($('input[name="optradio"]:checked').val() == "radio1"){
				var c1lnght = parseInt($("#c1val").text());
				var c1lenght = $("#countryId option:selected").length + c1lnght;
				if(c1lenght>10){
					alert("You can select only 10 value");
				}else{
					$("#mycountryId option:selected").remove().appendTo($("#countryId"));
					$("#tval").text($("#countryId option").length);
					$("#c1val").text($("#mycountryId option").length);
				}
			}else if ($('input[name="optradio"]:checked').val() == "radio2"){
				var c2lnght = parseInt($("#c2val").text());
				var c2lenght = $("#countryId option:selected").length + c2lnght;
				if(c2lenght>20){
					alert("You can select only 20 value");
				}else{
					$("#myselectcountryId option:selected").remove().appendTo($("#countryId"));
					$("#tval").text($("#countryId option").length);
					$("#c2val").text($("#myselectcountryId option").length);
				}
			}else{
				$("#warning").fadeIn();
			}
		}else{
			alert("Choose Block");
		}

	});


		$("#tval").text($("#countryId option").length);
		$("#c1val").text($("#mycountryId option").length);
		$("#c2val").text($("#myselectcountryId option").length);

	</script>