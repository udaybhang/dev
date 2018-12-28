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
    margin-top: 35px;
    width: 
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
  #file_upload_css .fa,#add_file{
    cursor: pointer;
  }
  .quest_limit{
    margin-top: 10px;
  }
</style>
<script src="<?php echo base_url() ?>admin_assets/editor/ckeditor.js">
</script>
<script src="<?php echo base_url() ?>admin_assets/editor/samples/js/sample.js">
</script>
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
              <h2 class="lel">
                <?php if($case_value['case_id']==''){ echo 'Create'; }else{ echo 'Update'; } ?> Case
              </h2> 
            </div>
          </div>
          <!-- /.box-header -->
          <div class="clearfix">
          </div>
          <div class="row">
            <div class="col-md-12">
              <section class="content">
                <!-- SELECT2 EXAMPLE -->
                <div class="box box-col">
                  <div class="box-header with-border">
                    <h3 class="box-title">Case Details
                    </h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <form name="instruction-form" autocomplete="off" method="post" action="<?php echo base_url(); if($case_value['case_id']==''){ echo 'insert-case'; }else{ echo 'update-case'; } ?>"  enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Case Name
                            </label>
                            <input type="text" class="form-control" maxlength="80" style="text-transform:capitalize;" id="case_name" name="case_name" placeholder="Case Name" value="<?php echo $case_value['case_name'] ?>" required="">
                          </div>
                          <!-- /.form-group -->
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Case Content
                            </label>
                            <textarea id="editor" name="case_content" class="form-control" style="height: 300px;" placeholder="Enter ..." required=""><?php echo $case_value['content'] ?></textarea>
                          </div>
                          <!-- /.form-group -->
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                          	<div class="col-md-4" style="padding: 0px;">
	                            <label>Upload Audio(Only mp3)</label>
  	                        </div>
  	                        <div class="col-md-3">
                              	<input type="file" accept="audio/mp3" name="audiofile" />
                            </div>
  	                        <div class="col-md-5">
                              	<?php  $audfile =explode('/', $case_value['audiofile']); echo $audfile[2]; ?>
                            </div>
                          </div>
                          <!-- /.form-group -->
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                          	<div class="col-md-4" style="padding: 0px;">
	                            <label>Upload Video</label>
  	                        </div>
  	                        <div class="col-md-3">
                            	<input type="file" accept="video/mp4" name="videofile" />
                            </div>
                            <div class="col-md-5">
                                <?php  $vidfile =explode('/', $case_value['videofile']); echo $vidfile[2]; ?>
                            </div>
                          </div>
                        </div>
                        <?php
if($case_value['sample_file']!=''){
?>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>File List
                            </label>
                            <div>
                              <?php $filesize = explode(',',$case_value['sample_file']);
for($f=0;$f<sizeof($filesize);$f++){
$ran = rand(111111,999999);
$filename = explode('/',$filesize[$f]);
echo '<div class="row" id="'.$ran.'">';
echo '<div class="col-sm-11">';
echo '<p>'.$filename[1].'<p>';
echo '<input type="hidden" name="caseoldFiles[]" value="'.$filename[1].'" />';
echo '</div>';
echo '<div class="col-sm-1"><i class="fa fa-minus fileremove" aria-hidden="true" data-id="'.$ran.'" style="cursor:pointer;"></i></div>';
echo '</div>';
}
?>
                            </div>
                          </div>
                        </div>
                        <?php
}
?>
                        <div class="col-md-12">
                          <div class="form-group" id="file_upload_css">
                            <div class="col-md-12" style="padding: 0px;">
                              <div class="col-md-6" style="padding: 0px;">
                                <label for="exampleInputFile">Upload Sample
                                </label>
                              </div>
                              <div class="col-md-6 text-right" style="padding: 0px;">
                                <span id="add_file">Add More 
                                  <i class="fa fa-plus" aria-hidden="true">
                                  </i>
                                </span>
                              </div>
                            </div>
                            <div class="col-md-12" style="padding: 0px;">
                              <div class="col-sm-4" style="padding: 0px;">Sample data 
                              </div>
                              <div class="col-sm-5">
                                <input type="file" name="caseFiles[]" />
                              </div>
                              <div class="col-sm-3">
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
if($case_value['maid']==''){
$disp = ' style="display: none;"';
$disbl = '';
}else{
$disp ='';
$disbl = ' disabled="disabled"';
}
?>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Select Assignment
                            </label>
                            <select name="case_assignment" class="form-control" required="" 
                                    <?php echo $disbl; ?>>
                            <option value="">Select Assignment
                            </option>
                            <?php
foreach ($assnames as $assname) {
?>
                            <option value="<?php echo $assname['maid'];?>" 
                                    <?php if($assname['maid']==$case_value['maid']){ echo 'selected="selected"';}?>>
                            <?php echo $assname['assignment_name'];?>
                            </option>
                          <?php
}
?>
                          </select>
                      </div>
                      </div>
                    <div class="col-md-12" id="levellist"
                         <?php echo $disp?>>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Select Level
                      </label>
                      <select name="case_level" class="form-control" required="" 
                              <?php echo $disbl; ?>>
                      <?php
if($case_value['level_id']!==''){
$lvlid = $case_value['level_id'];
$lvlval=$this->Crud_modal->fetch_single_data("lvl_name,ml_id","master_level","ml_id='$lvlid'");
?>
                      <option value="<?php echo $lvlval['ml_id']; ?>">
                        <?php echo $lvlval['lvl_name']; ?>
                      </option>
                      <?php
}
?>
                      </select>
                  </div>
                </div>
                <div class="col-md-12" style="border: 1px solid #cccccc; margin-top: 20px; padding: 15px;">
                  <label for="exampleInputEmail1">Question Orders
                  </label>
                  <input type="button" class="pull-right" id="resetform" value="Reset" />
                  <div class="col-md-12">
                    <div class="col-md-3">
                      <span>MCQ
                      </span>
                      <input type="checkbox" value="1" class="qt_check" />
                    </div>
                    <div class="col-md-3">
                      <span>Sequence
                      </span>
                      <input type="checkbox" value="2" class="qt_check" />
                    </div>
                    <!-- <div class="col-md-3">
<span>Match the Following</span>
<input type="checkbox" value="3" class="qt_check" />
</div> -->
                    <div class="col-md-3">
                      <span>Fill in the Blank
                      </span>
                      <input type="checkbox" value="5" class="qt_check" />
                    </div>
                    <div class="col-md-3">
                      <span>Subjective
                      </span>
                      <input type="checkbox" value="6" class="qt_check" />
                    </div>
                  </div>
                  <div class="col-md-12" style="margin-top: 10px;">
                    <div class="col-md-3" id="sel1" style="display: none;">
                      <select class="form-control selecd" name="arrng_case[]">
                        <option value="">Arrange Case
                        </option>
                      </select>
                      <input type="text" name="quest_limit[]" class="form-control quest_limit" placeholder="Question Limit" />
                    </div>
                    <div class="col-md-3" id="sel2" style="display: none;">
                      <select class="form-control selecd" name="arrng_case[]">
                        <option value="">Arrange Case
                        </option>
                      </select>
                      <input type="text" name="quest_limit[]" class="form-control quest_limit" placeholder="Question Limit" />
                    </div>
                    <!-- <div class="col-md-3" id="sel3" style="display: none;">
<select class="form-control selecd" name="arrng_case[]">
<option value="">Arrange Case</option>
</select>
<input type="text" name="quest_limit[]" class="form-control quest_limit" placeholder="Question Limit" />
</div> -->
                    <div class="col-md-3" id="sel5" style="display: none;">
                      <select class="form-control selecd" name="arrng_case[]">
                        <option value="">Arrange Case
                        </option>
                      </select>
                      <input type="text" name="quest_limit[]" class="form-control quest_limit" placeholder="Question Limit" />
                    </div>
                    <div class="col-md-3" id="sel6" style="display: none;">
                      <select class="form-control selecd" name="arrng_case[]">
                        <option value="">Arrange Case
                        </option>
                      </select>
                      <input type="text" name="quest_limit[]" class="form-control quest_limit" placeholder="Question Limit" />
                    </div>
                  </div>
                </div>
                <?php if($case_value['case_id']!=''){ ?>
                <input type="hidden" name="case_id" value="<?php echo rtrim(strtr(base64_encode($case_value['case_id']), '+/', '-_'), '='); ?>">
                <?php } ?>
                <!-- /.col -->
                </div>
              <a href="<?php echo base_url() ?>case-list" class="btn btn-primary btn-md" style="float: left;margin-top:20px;background-color:#112B4E; border-color: #112B4E">Back
              </a>
              <input type="button" class="btn btn-primary btn-md disabled" style="float: right; margin-top:20px;background-color:#112B4E; border-color: #112B4E" value="<?php if($case_value['case_id']==''){echo 'Submit';}else{ echo 'Update';} ?>" id="subbutton" />
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
<div class="col-md-1">
</div>
</div>
</div>
<!-- /.content -->
<div class="clearfix">
</div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    var fileid = 1;
    $("#add_file").click(function(){
      $("#file_upload_css").append('<div class="col-md-12 file_'+fileid+'" style="padding: 0px;"><div class="col-sm-4" style="padding: 0px;">Sample data </div><div class="col-sm-5"><input type="file" name="caseFiles[]" required="required" /></div><div class="col-sm-3"><i class="fa fa-minus" aria-hidden="true" id="'+fileid+'"></i></div></div>');
      fileid++;
      $(".fa-minus").click(function(){
        $(".file_"+$(this).attr("id")).remove();
      }
                          );
    }
                        );
    $(".fa-minus").click(function(){
      $("#file_"+$(this).attr("id")).remove();
    }
                        );
    $(".fileremove").click(function(){
      $("#"+$(this).attr("data-id")).remove();
    }
                          );
    $('.qt_check').click(function(){
      if($(this).is(':checked')){
        $(this).attr('disabled','disabled');
        $('#sel'+$(this).val()).fadeIn();
        var addel = '<option value="'+$(this).val()+'">'+$(this).prev('span').text()+'</option>';
        $('.selecd').append(addel);
        $('#sel'+$(this).val()).find('.selecd').attr('required','required');
        $('#sel'+$(this).val()).find('.quest_limit').attr('required','required');
      }
      else{
        $('.selecd').find('option[value="'+$(this).val()+'"]').remove();
        $('#sel'+$(this).val()).find('.selecd').removeAttr('required');
        $('#sel'+$(this).val()).find('.quest_limit').removeAttr('required');
        $('#sel'+$(this).val()).fadeOut();
      }
      if($('.qt_check:checked').length>0){
        $('#subbutton').removeClass('disabled');
        $('#subbutton').removeAttr('type');
        $('#subbutton').attr('type','submit');
      }
      else{
        $('#subbutton').addClass('disabled');
        $('#subbutton').removeAttr('type');
        $('#subbutton').attr('type','button');
      }
    }
                        );
    var checklist = '<?php echo $case_value['case_sequence'] ?>';
    var quest_limit = '<?php echo $case_value['quest_limit'] ?>';
    var res = checklist.split(',');
    var q_limit = quest_limit.split(',');
    for(var i=0;i<res.length;i++){
      $('.qt_check[value="'+res[i]+'"]').attr('checked','checked');
    }
    if($('.qt_check').is(':checked')){
      $('.qt_check:checked').each(function(){
        $(this).attr('disabled','disabled');
        var values = $(this).val();
        $('#sel'+values).fadeIn();
        var addel = '<option value="'+values+'">'+$(this).prev('span').text()+'</option>';
        $('#sel'+$(this).val()).find('.selecd').html(addel);
        $('#sel'+$(this).val()).find('.selecd').attr('required','required');
        $('#sel'+$(this).val()).find('.quest_limit').attr('required','required');
      }
                                 );
      for(var j=0;j<res.length;j++){
        $('#sel'+res[j]).find('.quest_limit').val(q_limit[j]);
      }
      $('#subbutton').removeClass('disabled');
      $('#subbutton').removeAttr('type');
      $('#subbutton').attr('type','submit');
    }
    $('.quest_limit').blur(function(){
      if(isNaN($(this).val())){
        $(this).val('');
        alert('Enter Number Only');
      }
      else if($(this).val()>50){
        $(this).val('');
        alert('Enter Less Than 50');
      }
    }
                          );
    $('.selecd').change(function(){
      $(this).parent().nextAll().find('option[value="'+$(this).val()+'"]').remove();
      $(this).find('option[value="'+$(this).val()+'"]').nextAll().remove();
      $(this).parent().prevAll().find('option[value="'+$(this).val()+'"]').remove();
      $(this).find('option[value="'+$(this).val()+'"]').prevAll().remove();
    }
                       );
    $('#resetform').click(function(){
      $('.qt_check').removeAttr('disabled');
      $('.qt_check').attr('checked',false);
      $('.selecd').each(function(){
        $(this).html('');
        $(this).html('<option value="">Arrange Case</option>');
        $(this).parent().fadeOut();
      }
                       );
      $('.quest_limit').val('');
      $('#subbutton').addClass('disabled');
      $('#subbutton').removeAttr('type');
      $('#subbutton').attr('type','button');
      $('.selecd').removeAttr('required');
      $('.quest_limit').removeAttr('required');
    }
                         );
    $('select[name="case_assignment"]').change(function(){
      var assname = $(this).val();
      var lvlselect=$('select[name="case_level"]');
      if($(this).val() != ""){
        $.ajax({
          method: "POST",
          data: {
            'assignid': assname}
          ,
          url: "<?php echo base_url() ?>getcaselevel",
          dataType:'JSON',
          success: function(result){
            if(result.ml_id==0){
              var out='<option value="">No Level</option>';
              lvlselect.html(out);
              $('#levellist').fadeIn();
            }
            else{
              var out = '';
              for(var i=0;i<result.length;i++){
                out+='<option value="'+result[i].ml_id+'">'+result[i].lvl_name+'</option>';
              }
              lvlselect.html(out);
              $('#levellist').fadeIn();
            }
          }
        }
              );
      }
      else{
        lvlselect.html('');
        $('#levellist').fadeOut();
      }
    });
    initSample();
  });
</script>
