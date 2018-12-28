
<script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script><style>
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
   #file_upload_css .fa{
    cursor: pointer;
   }
   #file_upload_css .fa, #add_file,#add_more_select{
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
  <?php
if(isset($task_value)){
?>
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
							<h2 class="lel">Update Task</h2> </div>
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
          <h3 class="box-title">Update Task</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
            <form action="<?php echo base_url()?>update-task" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>Assignment Name</label>
                
                <select name="ma_id" class="form-control select2" style="width: 100%;" required="required" disabled="disabled">
                  <?php
                    $tv = $task_value['ma_id'];
                   
                    foreach ($assignlist as $assignlists) {
                      if(($assignlists->maid)==$tv){
                        $selectval = ' selected="selected"';
                      }else{
                        $selectval = "";
                      }
                  ?>
                  <option value="<?php echo $assignlists->maid; ?>" <?php echo $selectval; ?>><?php echo $assignlists->assignment_name; ?></option>
                 <?php
                 }
                 ?>
                </select>
              </div>
              <div class="form-group">
                <label>Select Level</label>
                
                <select name="ml_id" class="form-control select2" style="width: 100%;" required="required" disabled="disabled">
                  <?php
                    $tv = $task_value['ml_id'];
                    foreach ($levels as $level) {
                      if(($level['ml_id'])==$tv){
                        $selectval = ' selected="selected"';
                      }else{
                        $selectval = "";
                      }
                  ?>
                  <option value="<?php echo $level['ml_id']; ?>" <?php echo $selectval; ?>><?php echo $level['lvl_name']; ?></option>
                 <?php
                }
                 ?>
                </select>
              </div>
              <div class="form-group">
                  <label>Task Detail</label>
                  <textarea name="task_name" class="form-control teditor" style="height: 300px;" rows="3"><?php echo $task_value['task_name']; ?></textarea>
              </div>
              <div class="form-group">
                <label>File List</label>
                <div><?php 
                if($task_value['sample_files']!=''){
                  $filesize = explode(',',$task_value['sample_files']);
                  for($f=0;$f<sizeof($filesize);$f++){
                    $ran = rand(111111,999999);
                    $filename = explode('/',$filesize[$f]);
                    echo '<div class="row" id="'.$ran.'">';
                    echo '<div class="col-sm-11">';
                    echo '<p>'.$filename[1].'<p>';
                    echo '<input type="hidden" name="filelist[]" value="'.$filename[1].'" />';
                    echo '</div>';
                    echo '<div class="col-sm-1"><i class="fa fa-minus fileremove" aria-hidden="true" data-id="'.$ran.'" style="cursor:pointer;"></i></div>';
                    echo '</div>';
                  }
                }else{
                  echo 'No Files';
                }
                ?></div>
              </div>
              <div class="form-group" id="file_upload_css">

                <div class="col-md-12" style="padding: 0px;">
                  <div class="col-md-6" style="padding: 0px;">
                    <label for="exampleInputFile"></label>
                  </div>
                  <div class="col-md-6 text-right" style="padding: 0px;"><span id="add_file">Add Files <i class="fa fa-plus" aria-hidden="true"></i></span></div>
                </div>
              </div>

              <div class="form-group" id="submission_file_type">
                <div class="col-md-12" style="padding: 0px;">
                    <label>Submission File Type</label>
                </div>
                <div class="container-fluid" id="appendelem">
                  <?php
                    $filtype = explode(',', $task_value['filetype']);
                    
                    for($if=0;$if<sizeof($filtype);$if++){
                  ?>
                  <div class="row copyelem" id="copyelem">
                    <div class="col-sm-5">Accept File Type</div>
                    <div class="col-sm-6">
                    <select name="filetype[]" class="form-control" required="">
                      <option value="">Select File Type</option>
                      <?php
                        foreach ($filetypelist as $filetypelists) {
                          if($filetypelists['ft_id']==$filtype[$if]){
                            $sel = ' selected="selected"';
                          }else{
                            $sel = '';
                          }
                      ?>
                        <option value="<?php echo $filetypelists['ft_id'] ?>"<?php echo $sel ?>><?php echo $filetypelists['ft_name'] ?></option>
                      <?php
                        }
                      ?>
                    </select>
                    </div>
                    <div class="col-md-1 removeelem" style="height: 34px; line-height: 34px; text-align: right; font-size: 20px; padding: 0px; cursor: pointer; display: none;"><i class="fa fa-minus"></i></div>
                  </div>
                  <?php
                    }
                  ?>
                </div>
                <div class="col-md-12 text-right" style="padding: 0px;"><span id="add_more_select">Add More <i class="fa fa-plus" aria-hidden="true"></i></span></div>
              </div>
          			 
              <div class="form-group">
                <label>Select Widget</label>
                <select id="widget_select" name="w_id" class="form-control select2" style="width: 100%;" required="required">
                  <option value="0" selected="selected">No Widget</option> 
                  <?php
                    foreach ($widgetlist as $widgetlists) {
                      if(($task_value['widget_id'])==($widgetlists->w_id)){
                        $wselect = ' selected="selected"';
                      }else{
                        $wselect='';
                      }
                  ?>
                  <option value="<?php echo $widgetlists->w_id; ?>" <?php echo $wselect ?>><?php echo $widgetlists->w_name; ?></option>
                 <?php
                }
                 ?>
                </select>
                <div class="col-md-12" style="margin-top: 20px;" id="clist">
                </div>
              </div>
<div class="form-group">
                  <label>Instruction *</label>
                  <textarea name="instruction" required="required" class="form-control teditor" style="height: 300px;" rows="3"><?php echo $task_value['instruction'] ?></textarea>
              </div>

			   <div class="form-group">
          <input type="hidden" value="<?php echo $task_value['tid'] ?>" name="tid" />
				<input type="Submit" value="Update" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E" />
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
    <?php
  }else{
  ?>
  <div class="col-md-12">
      <div class="col-md-10 col-md-offset-1">
        <div class="col-md-12">
          <div class="danger"><strong>Sorry!</strong> Page Not Found</div>
        </div>
      </div>
    </div>
    <?php
  }
  ?>
	</div>
	<!-- /.content -->
	<div class="clearfix"></div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $( "#start_date" ).datepicker({ minDate: 0, dateFormat: 'dd-mm-yy' });
    $( "#end_date" ).datepicker({ minDate: 0, dateFormat: 'dd-mm-yy' });
  });
</script>
<!-- bootstrap color picker -->
<script>

$(document).ready(function(){
    var fileid = 4;
  	$("#add_file").click(function(){
      $("#file_upload_css").append('<div class="container-fluid" id="file_'+fileid+'"><div class="row"><div class="col-sm-5">Sample data </div><div class="col-sm-6"><input type="file" name="userFiles[]"></div><div class="col-sm-1"><i class="fa fa-minus" aria-hidden="true" id="'+fileid+'"></i></div></div></div>');
      fileid++;
    $(".fa-minus").click(function(){
      $("#file_"+$(this).attr("id")).remove();
    });
    });
    $(".fa-minus").click(function(){
      $("#file_"+$(this).attr("id")).remove();
    });

    $(".fileremove").click(function(){
      $("#"+$(this).attr("data-id")).remove();
    });
    $("#widget_select").change(function(){
      if($(this).val() != "" && $(this).val() != "0"){
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
    if($(this).val() != ""&&$(this).val() != "0"){
      $.ajax({
        method: "POST",
        data: {'wid': $("#widget_select").val()},
        url: "<?php echo base_url() ?>get-widget",
        success: function(result){
          $("#clist").html(result);
        }
      });
    }

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