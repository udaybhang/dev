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
  #add_more_select,.fa-minus{
    cursor: pointer;
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
      <div class="col-md-1">
      </div>
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
              <h2 class="lel">Subjective Question
              </h2> 
            </div>
          </div>
          <div class="clearfix" style="margin-top: 20px;">
          </div>
          <div class="">
            <div class="col-md-12">
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
                    <h3 class="box-title">Subjective Question
                    </h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <form autocomplete="off" method="post" action="<?php echo base_url() ?>update-subjective">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <textarea id="editor" name="question" placeholder="Question" class="form-control"><?php echo $subjective['question']; ?> </textarea>
                          </div>
                        </div>
                         <div class="col-md-12">
                          <div class="form-group">
                            	<!--<textarea id="editor1" name="ans" placeholder="Answer" class="form-control"><?php echo $subjective['answer']; ?> </textarea>-->
	                  	<div class="form-control" contenteditable="true" id="ans" style="height: auto;"><?php echo $subjective['answer']; ?></div>
	                    	<input type="hidden" name="ans" value="<?php echo $subjective['answer']; ?>" />
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <select name="master_topic" class="form-control" required="required">
                              <option value="">Select Topics
                              </option>
                              <?php
foreach ($master_topics as $master_topic) {
	if($master_topic['t_id']==$subjective['topic']){
		$topic_sel=' selected="selected"';
	}else{
		$topic_sel='';
	}
?>
                              <option value="<?php echo $master_topic['t_id']?>"<?php echo $topic_sel?>>
                                <?php echo $master_topic['t_name']?>
                              </option>
                              <?php
}
?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <select name="master_type" class="form-control">
                              <option value="">Select Type
                              </option>
                              <?php
foreach ($master_types as $master_type) {
	if($master_type['type_id']==$subjective['type']){
		$type_sel=' selected="selected"';
	}else{
		$type_sel='';
	}
?>
                              <option value="<?php echo $master_type['type_id']?>"<?php echo $type_sel?>>
                                <?php echo $master_type['type_name']?>
                              </option>
                              <?php
}
?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <select name="master_skills_test" class="form-control">
                              <option value="">Select Skills
                              </option>
                              <?php
foreach ($master_skills_tests as $master_skills_test) {
	if($master_skills_test['skills_id']==$subjective['skill_tested']){
		$skill_sel=' selected="selected"';
	}else{
		$skill_sel='';
	}
?>
                              <option value="<?php echo $master_skills_test['skills_id']?>"<?php echo $skill_sel?>>
                                <?php echo $master_skills_test['skills_name']?>
                              </option>
                              <?php
}
?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <select name="master_case" class="form-control" required="required">
                              <option value="">Select Case
                              </option>
                              <?php
foreach ($master_case as $master_cases) {
	if($master_cases['case_id']==$subjective['case_id']){
		$case_sel=' selected="selected"';
	}else{
		$case_sel='';
	}
?>
                              <option value="<?php echo $master_cases['case_id']?>"<?php echo $case_sel?>>
                                <?php echo $master_cases['case_name']?>
                              </option>
                              <?php
}
?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group" id="submission_file_type">
                          <div class="col-md-12">
                            <label>Submission File Type
                            </label>
                          </div>
                          <div class="container-fluid">
                            <div class="row">
                              <div class="col-sm-6">Accept File Type
                              </div>
                              <div class="col-sm-6">
                                <select name="filetype" class="form-control" required="">
                                  <option value="">Select File Type
                                  </option>
                                  <?php
foreach ($filetypelist as $filetypelists) {
	if($filetypelists['ft_extensions']==$subjective['filetype']){
		$file_sel=' selected="selected"';
	}else{
		$file_sel='';
	}
?>
                                  <option value="<?php echo $filetypelists['ft_extensions'] ?>"<?php echo $file_sel?>>
                                    <?php echo $filetypelists['ft_name'] ?>
                                  </option>
                                  <?php
}
?>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <input type="hidden" name="subjective_id" value="<?php echo $subjective['subjective_id']; ?>" />
                      <input type="submit" value="Update" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;" />
                      <!-- /.row -->
                    </form>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </section>
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
  initSample();
  $('#ans').keyup(function(){
  	$('input[name="ans"]').val($('#ans').html());
    $('#formsub').attr('type','submit');
  });
</script>
