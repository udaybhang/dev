
<script src="<?php echo base_url() ?>admin_assets/editor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>admin_assets/editor/samples/js/sample.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <style type="text/css">
      .limitedNumbChosen, .limitedNumbSelect2{
  width: 400px;
}
    </style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="row main">
    <div class="col-md-12">
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <?php
        if($this->session->flashdata('mcq_message')){
          echo $this->session->flashdata('mcq_message');
        }
        ?>
      <section class="invoice show">
        <!-- title row -->
        <div class="row" style="background-color: #587EA3">
          <div class="col-md-12">
          <h2 class="lel">Bucket Tool</h2> </div>
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
                <div class="col-md-12">

              <?php

              if($this->session->flashdata('data_message')){

                echo $this->session->flashdata('data_message');

              }

              ?>

              </div>
                <div class="box-header with-border">
                  <h3 class="box-title">Bucket Tool</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form autocomplete="off" method="post" action="<?php echo base_url() ?>insert-bucket">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <textarea name="bucket_question" id="editor" placeholder="Question" class="form-control mcq_question" required="required"></textarea>
                        </div>
                      <!-- /.form-group -->
                      </div>
                     <div class="col-md-12">
                        <div class="form-group">
                          <select name="master_topic" class="form-control" required="required">
                            <option value="">Select Topics</option>
                            <?php
                              foreach ($master_topics as $master_topic) {
                            ?>
                            <option value="<?php echo $master_topic['t_id']?>"><?php echo $master_topic['t_name']?></option>
                            <?php
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <select name="master_type" class="form-control" >
                            <option value="">Select Type</option>
                            <?php
                              foreach ($master_types as $master_type) {
                            ?>
                            <option value="<?php echo $master_type['type_id']?>"><?php echo $master_type['type_name']?></option>
                            <?php
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <select name="master_skills_test" class="form-control" required="required">
                            <option value="">Select Skills</option>
                            <?php
                              foreach ($master_skills_tests as $master_skills_test) {
                            ?>
                            <option value="<?php echo $master_skills_test['skills_id']?>"><?php echo $master_skills_test['skills_name']?></option>
                            <?php
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <select name="master_case" class="form-control" required="required">
                            <option value="">Select Case</option>
                            <option value="0">No Case</option>
                            <?php
                              foreach ($master_case as $master_cases) {
                            ?>
                            <option value="<?php echo $master_cases['case_id']?>"><?php echo $master_cases['case_name']?></option>
                            <?php
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <select name="master_difficulty_level" class="form-control" required="required">
                            <option value="">Select difficulty level</option>
                            <?php
                              foreach ($master_difficulty as $master_difficulty_level) {
                            ?>
                            <option value="<?php echo $master_difficulty_level['diffi_id']?>"><?php echo $master_difficulty_level['difficulty_level']?></option>
                            <?php
                              }
                            ?>
                        </select>
                        </div>
                      </div>
                         <!-- <div class="col-md-12">
                        <div class="form-group">
                            <select class="limitedNumbSelect2" multiple="true">
                                    <option value="1">Monday</option>
                                    <option value="2">Tuesday</option>
                                    <option value="3">Wednesday</option>
                                    <option value="4">Thursday</option>
                                    <option value="5">Friday</option>
                                    <option value="6">Saturday</option>
                                    <option value="6">Sunday</option>
                            </select>        
                        </div>
                      </div> -->
                      <div class="col-md-12">
                          <div class="form-group" id="submission_file_type">
                          <div class="col-md-12" style="padding: 0px;">
                              <label>Answers  <span>* Enter the answer values in pipe seprated (shift+above the enter key).<img src="<?php echo base_url() ?>upload/pipe-icon.png" style="width: 34px!important;"></span></label>
                          </div>
                          <div class="container-fluid" id="appendelem">
                            <div class="row copyelem" id="copyelem">
                              <div class="col-sm-1">Answer Level</div>
                              <div class="col-sm-5">
                              <input type="text" name="order_level[]" placeholder="Choose Tier-1" class="form-control">
                              </div>
                               <div class="col-sm-5">
                                <input type="text" name="order_value[]" placeholder="IIT|BITS|NIT" class="form-control">
                              </div>
                              <div class="col-md-1 removeelem" style="height: 34px; line-height: 34px; text-align: right; font-size: 20px; padding: 0px; cursor: pointer; display: none;"><i class="fa fa-minus"></i></div>
                            </div>
                          </div>
                          <div class="col-md-12 text-right" style="padding: 0px;"><span id="add_more_select">Add More <i class="fa fa-plus" aria-hidden="true"></i></span></div>
                      </div>
                      </div>
                          <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="left_order" placeholder="other options except answers" class="form-control" required="required">
                        </div>
                      </div>
                    <!-- /.col -->
                    </div>
                    <?php 
                            $permission_array=$this->session->userdata('permission_array');
                                for($i=0;$i<sizeof($permission_array);$i++){
                                  $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
                                  if($p["permission_description"]=="Create"){

                    ?>
                    <input type="submit" value="Submit" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;" />
                    <?php }} ?>
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url()?>admin_assets/chosen.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>admin_assets/select2.min.js"></script>
<script type="text/javascript">
var $j = $.noConflict(true);
$j(function () {
     $j(".limitedNumbChosen").chosen({
        max_selected_options: 2,
    placeholder_text_multiple: "Which are two of most productive days of your week"
    })
    .bind("chosen:maxselected", function (){
        window.alert("You reached your limited number of selections which is 2 selections!");
    })
  //Select2
  $j(".limitedNumbSelect2").select2({
        maximumSelectionLength: 2,
    placeholder: "Which are two of most productive days of your week"
    })

    });
</script>
<script type="text/javascript">
initSample();

    var copyelemleng =0;
    $j('#add_more_select').click(function(){
      copyelemleng = $j('.copyelem').length;
      $j('.removeelem').css('display','block');
      if(copyelemleng<5){
        $j('#appendelem').append($j('#copyelem').clone());
      }else{
        alert('You can not add more.');
      }

      $j('.removeelem').click(function(){
        copyelemleng = $j('.copyelem').length;
        if(copyelemleng>1){
          $j(this).parent().remove();
        }
      });
    });
</script>
