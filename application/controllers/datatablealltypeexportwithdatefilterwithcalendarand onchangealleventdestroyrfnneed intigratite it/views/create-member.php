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
.mcq_question{
	height: 300px !important;
}
.frmSearch {border: 1px solid #a8d4b1;background-color: #c6f7d0;margin: 2px 0px;padding:40px;border-radius:4px;}
#country-list{float:left;z-index:11110;list-style:none;margin-top:-3px;padding:0;width:950px;position: absolute;}
#country-list li{padding: 10px;z-index:11110; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover{background:#ece3d2;z-index:11110;cursor: pointer;}
.uiToken {
    background: #e9ebee!important;
    border: 1px solid #9cb4d8!important;
    border-radius: 2px!important;
    color: #162643!important;
    cursor: default!important;
    display: block!important;
    float: left!important;
    margin: 0 4px 4px 0!important;
    padding: 0 3px!important;
    position: relative!important;
    white-space: nowrap!important;
}
#facebook ._-kb span {
    font-family: inherit;
}
.uiInlineTokenizer .uiToken {
    top: 2px;
}
.uiToken .remove {
    left: 1px;
    margin: 0;
    outline: none;
    position: relative;
    padding-left: 2px!important;
    top: 0px;
}
.uiCloseButtonSmall {
    height: 11px;
    margin-top: 1px;
    width: 11px;
}
a {
    color: #3c8dbc;
}

.uiTokenText{
	font-size: 12px!important;
}
.o-ms-fk {
    -webkit-box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    -webkit-transition: opacity .13s linear;
    transition: opacity .13s linear;
    color: #8e8e8e;
    font-size: 12px;
    position: absolute;
    z-index: 2201;
}
.o-ms-fk {
    -webkit-border-radius: 3px;
    border-radius: 3px;
    -webkit-box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    -webkit-transition: opacity .13s linear;
    transition: opacity .13s linear;
    position: absolute;
    z-index: 2201;
}
.p4a {
    background-color: #fff;
    border: 1px solid #ccc;
    border-bottom-color: #bbb;
    overflow: hidden;
    padding: 15px;
    position: relative;
    width: 318px;
}
.cE {
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    border-bottom-color: #bbb;
    border-top: 0;
    overflow: hidden;
    position: relative;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.ebc {
    color: #333;
    font-size: 16px;
    line-height: 20px;
    margin-bottom: 11px;
    margin-top: -4px;
    padding-left: 2px;
    word-wrap: break-word;
}
.gbc {
    float: right;
    width: 100px;
    margin-left: 15px;
    margin-top: -27px;
    position: relative;
}
.abc {
    color: #222;
    margin: -8px 0 0 2px;
    min-height: 53px;
}
</style>
<script src="<?php echo base_url() ?>admin_assets/editor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>admin_assets/editor/samples/js/sample.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="row main">
		<div class="col-md-12">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<?php
				if($this->session->flashdata('data_message')){
					echo $this->session->flashdata('data_message');
				}
				?>
			<section class="invoice show">
				<!-- title row -->
				<div class="row" style="background-color: #587EA3">
					<div class="col-md-12">
					<h2 class="lel">Create Members</h2> </div>
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
									
									<h3 class="box-title">Create Members</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<form autocomplete="off" method="post" action="<?php echo base_url() ?>member-insert">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<input type="text" id="search-box"  name="group_leader" placeholder="Add Members" class="form-control"  />
													<div id="suggesstion-box"></div>
												</div>
													<div class="tokenarea hidden_elem" style="height: 40px!important;width:950px;border:1px solid #aeaeae;" id="u_2u_f">
													</div>
												<div class="tid">
													
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<select name="group" class="form-control" required="required">
														<option value="">Group List</option>
														<?php
															foreach ($group as $group) {
														?>
														<option value="<?php echo $group['group_id']?>"><?php echo $group['group_name']?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
														<select name="member_status" class="form-control" required="required">
														<option value="">Member Status</option>
														<?php
														$status=array('Inactive','Active');
															for($i=0;$i<sizeof($status);$i++) {
														?>
														<option value="<?php echo $i;?>"><?php echo $status[$i];?></option>
														<?php
														}
														?>
													</select>
												</div>
											</div>
										<!-- /.col -->
										</div>
										<input type="submit" value="Submit" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;" />
										<!-- /.row -->
									</form>
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

	$("#search-box").keyup(function(e){
		var val2=$('.tokenarea').find('input[name="text_members[]"]').map(function(){
               return $(this).val();
 			}).get();
		if(val2){
			var data_val={'keyword':$(this).val(),'val2':val2};
		}else{
			var data_val={'keyword':$(this).val()};
		}
		$.ajax({
		type: "POST",
		url: "<?php echo base_url()?>search-member",
		data:data_val,
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
			$(".members_col").click(function(){
				$(".tokenarea").append('<span class="removable uiToken" id="'+$(this).attr('data-val')+'"><span class="uiTokenText">'+$(this).attr('id')+'</span><input type="hidden" value="'+$(this).attr('id')+'" name="members[]" autocomplete="off"><input type="hidden" value="'+$(this).attr('data-id')+'" name="text_members[]" autocomplete="off"><a href="#" aria-label="Remove Danish Ali" class="remove uiCloseButton uiCloseButtonSmall">x</a></span>');
				$(".tokenarea span").mouseenter(function(){
						var ts=$(this).attr('id');	
				       	$( ".tid" ).text(ts);
				   }).mouseleave(function () {
				         	$( ".tid" ).text('');
				    });

				$(".uiCloseButtonSmall").click(function(){
						$(this).parent().remove();
					});
				$("#suggesstion-box").hide();
				$("#search-box").val(val);
			});
		}
		});
	});

// $(".tokenarea span").on({
// 				    mouseenter: function () {
// 				    	alert();
// 				        $( "#log" ).append( "<div>Handler for .mouseover() called.</div>" );
// 				    },
// 				    mouseleave: function () {
// 				         $( "#log" ).remove();
// 				    }
// 				});

 });
</script>