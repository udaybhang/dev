
<script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
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
   #file_upload_css .fa, #add_file,#add_more_select,.fa-minus{
    cursor: pointer;
   }
   /* Sohrab 1st May 2017 */
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
			<div class="col-md-10 col-md-offset-1">
        <div class="col-md-12">
          <?php
          if($this->session->flashdata('task_insert_message')){
            echo $this->session->flashdata('task_insert_message');
          }
          ?>
        </div>
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="background-color: #587EA3">
						<div class="col-md-12">
							<h2 class="lel">Create Task</h2> </div>
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
          <h3 class="box-title">Create Task</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
            <form action="<?php echo base_url()?>insert-task" method="post" enctype="multipart/form-data" autocomplete="off">
              <div class="form-group">
                <label>Select Assignment</label>
                <select id="assignlist_select" name="ma_id" class="form-control select2" style="width: 100%;" required="required">
                  <option value="" selected="selected">Select Assignment</option>
                  <?php
                    foreach ($assignlist as $assignlists) {
                      $sdate = date('d-m-Y',strtotime($assignlists->start_date));
                      $todaydate = date('d-m-Y');
                      if($sdate > $todaydate){
                  ?>
                  <option value="<?php echo $assignlists->maid; ?>"><?php echo $assignlists->assignment_name; ?></option>
                 <?php
                  }
                }
                 ?>
                </select>
              </div>
               <!-- /.form-group -->
              <div class="form-group" id="level_val">
                <input type="hidden" name="ml_id" value="">
              </div>
               <!-- /.form-group -->
              <div class="form-group">
                  <label>Task Detail</label>
                  <textarea name="task_name" class="form-control" style="height: 300px;" rows="3" placeholder="Enter ..."></textarea>
              </div>
              <!--<div class="form-group">
                <label>Start Date:</label>

                <div class="input-group date" id="startdate">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control disabl" required="required" disabled="disabled" name="start_date" id="start_date" placeholder="DD/MM/YYYY" type="text" />
                </div>
              </div>
              <div class="form-group">
                <label>End Date:</label>

                <div class="input-group date" id="enddate">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control disabl" required="required" disabled="disabled" name="end_date" id="end_date" placeholder="DD/MM/YYYY" type="text"/>
                </div>
              </div>-->
              <div class="form-group" id="file_upload_css">
                <div class="col-md-12" style="padding: 0px;">
                  <div class="col-md-6" style="padding: 0px;">
                    <label for="exampleInputFile">Upload Sample</label>
                  </div>
                  <div class="col-md-6 text-right" style="padding: 0px;"><span id="add_file">Add More <i class="fa fa-plus" aria-hidden="true"></i></span></div>
                </div>
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-sm-5">Sample data </div>
                    <div class="col-sm-6"><input type="file" name="userFiles[]" disabled="disabled" class="disabl"></div>
                  </div>
                </div>
              </div>

              <div class="form-group" id="submission_file_type">
                <div class="col-md-12" style="padding: 0px;">
                    <label>Submission File Type</label>
                </div>
                <div class="container-fluid" id="appendelem">
                  <div class="row copyelem" id="copyelem">
                    <div class="col-sm-5">Accept File Type</div>
                    <div class="col-sm-6">
                    <select name="filetype[]" class="form-control" required="">
                      <option value="">Select File Type</option>
                      <?php
                        foreach ($filetypelist as $filetypelists) {
                      ?>
                        <option value="<?php echo $filetypelists['ft_id'] ?>"><?php echo $filetypelists['ft_name'] ?></option>
                      <?php
                        }
                      ?>
                    </select>
                    </div>
                    <div class="col-md-1 removeelem" style="height: 34px; line-height: 34px; text-align: right; font-size: 20px; padding: 0px; cursor: pointer; display: none;"><i class="fa fa-minus"></i></div>
                  </div>
                </div>
                <div class="col-md-12 text-right" style="padding: 0px;"><span id="add_more_select">Add More <i class="fa fa-plus" aria-hidden="true"></i></span></div>
              </div>
              <div class="form-group">
                <label>Select Widget</label>
                <select id="widget_select" name="w_id" class="form-control select2 disabl" disabled="disabled" style="width: 100%;" required="required">
                  <option value="" selected="selected">Select Widget</option>
                  <option value="0">No Widget</option>
                  <?php
                    foreach ($widgetlist as $widgetlists) {
                  ?>
                  <option value="<?php echo $widgetlists->w_id; ?>"><?php echo $widgetlists->w_name; ?></option>
                 <?php
                }
                 ?>
                </select>
                <div class="col-md-12" style="margin-top: 20px;" id="clist">
                </div>
              </div>

              <div class="form-group">
                  <label>Instruction *</label>
                  <textarea name="instruction" style="height: 300px;" class="form-control" rows="3" placeholder="Enter ..."></textarea>
              </div>
			   <div class="form-group">
				<input type="submit" value="Submit" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E" />
			   </div>
			  <!-- /.form-group -->
            
          </form>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- bootstrap color picker -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $( "#start_date" ).datepicker({ minDate: 0, dateFormat: 'dd-mm-yy' });
    $( "#end_date" ).datepicker({ minDate: 0, dateFormat: 'dd-mm-yy' });
  });
</script>
<script>

$(document).ready(function(){

  $("#assignlist_select").change(function(){
      if($(this).val() != ""){
        $.ajax({
          method: "POST",
          data: {'assignid': $(this).val()},
          url: "<?php echo base_url() ?>get-levels",
          success: function(result){
            if(result != ""){
              $("#level_val").html(result);
              $(".disabl").removeAttr("disabled");
              $("#instructionbox").attr('contenteditable','true');
              $("#instructionbox").css('background-color','#ffffff');
            }else{
              $("#level_val").html('<input type="hidden" name="ml_id" value="">');
              $(".disabl").attr('disabled', 'disabled');
            }
          }
        });
      }else{
        $("#level_val").html('<input type="hidden" name="ml_id" value="">');
        $(".disabl").attr('disabled', 'disabled');
      }
    });
    var fileid = 4;
  	$("#add_file").click(function(){
      $("#file_upload_css").append('<div class="container-fluid" id="file_'+fileid+'"><div class="row"><div class="col-sm-5">Sample data </div><div class="col-sm-6"><input type="file" name="userFiles[]" /></div><div class="col-sm-1"><i class="fa fa-minus" aria-hidden="true" id="'+fileid+'"></i></div></div></div>');
      fileid++;
    $(".fa-minus").click(function(){
      $("#file_"+$(this).attr("id")).remove();
    });
    });
    $(".fa-minus").click(function(){
      $("#file_"+$(this).attr("id")).remove();
    });

    // Widget Select
    $("#widget_select").change(function(){
      if($(this).val() != ""&&$(this).val() != "0"){
        $.ajax({
          method: "POST",
          data: {'wid': $(this).val()},
          url: "<?php echo base_url() ?>get-widget",
          success: function(result){
            $("#clist").html(result);
          }
        });
      }else{
        $("#clist").html("");
      }
    });
    var copyelemleng =0;
    $('#add_more_select').click(function(){
      copyelemleng = $('.copyelem').length;
      $('.removeelem').css('display','block');
      if(copyelemleng<5){
        $('#appendelem').append($('#copyelem').clone());
      }else{
        alert('You can not add more.');
      }

      $('.removeelem').click(function(){
        copyelemleng = $('.copyelem').length;
        if(copyelemleng>1){
          $(this).parent().remove();
        }
      });
    });

  });
</script>