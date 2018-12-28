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
	    
	    .editlevellink{
	    	text-align: right;
	    	cursor: pointer;
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
	              if($this->session->flashdata('level_insert_message')){
	              	echo $this->session->flashdata('level_insert_message');
	              }
	              ?>
				</div>
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="background-color: #587EA3">
						<div class="col-md-12">
							<h2 class="lel">Master Level</h2> </div>
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
          <h3 class="box-title">Master Level</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
            <form action="<?php echo base_url() ?>insert-level" method="post" autocomplete="off">
             <!-- /.form-group -->
              <div class="form-group">
                <label>Select Assignment</label>
                <select id="assignlist_select" name="assign_select" required="required" class="form-control select2" style="width: 100%;">
                  <option value="" selected="selected">Select Assignment</option>
                  <?php
                  	foreach ($assignlist as $assignlists) {
                  ?>
                  <option value="<?php echo $assignlists->maid; ?>"><?php echo $assignlists->assignment_name."(".$assignlists->maid.")"; ?></option>
                 <?php
             		}
                 ?>
                </select>
              </div>
              <div class="form-group" id="levellist">
              </div>
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
 
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">

$("#assignlist_select").change(function(){
if($(this).val() != ""){
$.ajax({
method: "POST",
data: {'assignid': $(this).val()},
url: "<?php echo base_url() ?>get-assignment-level",
success: function(result){
$("#levellist").html(result);
$('.timeformatExample1').timepicker({ 'timeFormat': 'H:i:s' });
$(".start_date").datepicker();
$(".editlevellink").click(function(){
var editid = $(this).attr("id"); // level id of icom
var new_id= $(this).attr("new_id");
if($("#name_"+editid).attr("disabled")){
$("#name_"+editid).removeAttr("disabled");
$("#wallet_"+editid).removeAttr("disabled");
$("#lumens_"+editid).removeAttr("disabled");
$("#inst_"+editid).removeAttr("disabled");
$("#time_"+editid).removeAttr("disabled");
$("#lvltype_"+editid).removeAttr("disabled");
$("#startdate_"+editid).removeAttr("disabled");
$("#starttime_"+editid).removeAttr("disabled");
$("#dlevel_"+editid).removeAttr("disabled");
$("#qlimit_"+editid).removeAttr("disabled");
$("#skills_"+editid).removeAttr("disabled");
$("#mlvltype_"+editid).removeAttr("disabled");
$("#key_competency_"+editid).removeAttr("disabled");
$("#dicription_"+editid).removeAttr("disabled");
$(this).html('<i class="fa fa-check" aria-hidden="true"></i>');
}
else{
if($("#name_"+editid).val()!='' && $("#wallet_"+editid).val()!=''  && $("#lumens_"+editid).val()!='' && $("#inst_"+editid).val()!='' && $("#time_"+editid).val()!='' && $("#lvltype_"+editid).val()!='' && $("#startdate_"+editid).val()!='' && $("#starttime_"+editid).val()!='' && $("#mlvltype_"+editid).val()!='' && $("#dlevel_"+editid).val()!='' && $("#skills_"+editid).val()!='' && $("#qlimit_"+editid).val()!='' && $("#dicription_"+editid).val()!='' && $("#key_competency_"+editid).val()!=''){
$.ajax({
method: "POST",
data: {'assignid':editid,'lvlname':$("#name_"+editid).val(), 'walletpoint':$("#wallet_"+editid).val(), 'lumens':$("#lumens_"+editid).val(), 'inst_id':$("#inst_"+editid).val(),'time_id':$("#time_"+editid).val(),'lvltype':$("#lvltype_"+editid).val(),'startdate':$("#startdate_"+editid).val(),'starttime':$("#starttime_"+editid).val(),'mlvltype':$("#mlvltype_"+editid).val(),'dlevel':$("#dlevel_"+editid).val(),'skills':$("#skills_"+editid).val(),'q_limit':$("#qlimit_"+editid).val(),'disc':$("#dicription_"+editid).val(),'key':$("#key_competency_"+editid).val()},
url: "<?php echo base_url() ?>update-level",
//dataType: "JSON",
success: function(results){
if(results == true){
$("#name_"+editid).attr("disabled","disabled");
$("#time_"+editid).removeAttr("disabled","disabled");
$("#wallet_"+editid).attr("disabled","disabled");
$("#lumens_"+editid).attr("disabled","disabled");
$("#inst_"+editid).attr("disabled","disabled");

$("#time_"+editid).attr("disabled","disabled");
$("#lvltype_"+editid).attr("disabled","disabled");
$("#startdate_"+editid).attr("disabled","disabled");
$("#starttime_"+editid).attr("disabled","disabled");
$("#dlevel_"+editid).attr("disabled","disabled");
$("#skills_"+editid).attr("disabled","disabled");
$("#mlvltype_"+editid).attr("disabled","disabled");
$("#qlimit_"+editid).attr("disabled","disabled");
$("#dicription_"+editid).attr("disabled","disabled");
$("#key_competency_"+editid).attr("disabled","disabled");
$("#"+editid).html('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>');
}else{
$("#name_"+editid).attr("disabled","disabled");
$("#time_"+editid).removeAttr("disabled","disabled");
$("#inst_"+editid).attr("disabled","disabled");
$("#wallet_"+editid).attr("disabled","disabled");
$("#lumens_"+editid).attr("disabled","disabled");
$("#time_"+editid).attr("disabled","disabled");
$("#lvltype_"+editid).attr("disabled","disabled");
$("#startdate_"+editid).attr("disabled","disabled");
$("#starttime_"+editid).attr("disabled","disabled");
$("#dlevel_"+editid).attr("disabled","disabled");
$("#skills_"+editid).attr("disabled","disabled");
$("#mlvltype_"+editid).attr("disabled","disabled");
$("#qlimit_"+editid).attr("disabled","disabled");
$("#dicription_"+editid).attr("disabled","disabled");
$("#key_competency_"+editid).attr("disabled","disabled");
$("#"+editid).html('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>');
}
},
error: function(results)
{
alert(results);
}

});
}else{
alert("Please enter the fields");
}
}
});
}
});
}else{
$("#levellist").html("");
}
});
</script>