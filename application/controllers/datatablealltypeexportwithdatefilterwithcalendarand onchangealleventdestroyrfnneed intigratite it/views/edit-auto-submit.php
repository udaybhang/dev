
<script src="<?php echo base_url() ?>admin_assets/editor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>admin_assets/editor/samples/js/sample.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <style type="text/css">


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
          <h2 class="lel">Edit Auto Submit Tool</h2> </div>
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
                //print_r($auto_submit);
              ?>
            
              </div>
                <div class="box-header with-border">
                  <h3 class="box-title"> Edit Auto Submit Tool</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form autocomplete="off" method="post" action="<?php echo base_url() ?>edit-auto-submit-save">
                    <div class="row">
                      <div class="col-md-12">
                        <label>Question Context</label>
                        <div class="form-group">
                          <textarea name="question" id="editor" placeholder="Enter Question Context" class="form-control mcq_question" required="required"><?php echo $auto_submit['question_context']; ?></textarea>
                         <script>
                                  CKEDITOR.replace( 'question');
                                </script>
						</div>
                      <!-- /.form-group -->
                      </div>
                      <div class="col-md-12">
                        <label>Case Title</label>
                        <div class="form-group">
                           <input type="text" name="case_title" class="form-control" placeholder="Enter case title" value="<?php echo $auto_submit['case_title']; ?>">
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
                            <option value="<?php echo $master_topic['t_id']?>" <?php if($master_topic['t_id']==$auto_submit['topic']){echo "selected='selected'";}?>><?php echo $master_topic['t_name']?></option>
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
                            <option value="<?php echo $master_type['type_id']?>" <?php if($master_type['type_id']==$auto_submit['type']){echo "selected='selected'";}?>><?php echo $master_type['type_name']?></option>
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
                            <option value="<?php echo $master_skills_test['skills_id']?>" <?php if($master_skills_test['skills_id']==$auto_submit['skill_tested']){echo "selected='selected'";}?>><?php echo $master_skills_test['skills_name']?></option>
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
                            <option value="<?php echo $master_cases['case_id']?>" <?php if($master_cases['case_id']==$auto_submit['case_id']){echo "selected='selected'";}?>><?php echo $master_cases['case_name']?></option>
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
                            <option value="<?php echo $master_difficulty_level['diffi_id']?>" <?php if($master_difficulty_level['diffi_id']==$auto_submit['difficulty_level']){echo "selected='selected'";}?>><?php echo $master_difficulty_level['difficulty_level']?></option>
                            <?php
                              }
                            ?>
                        </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                         <label>Question Heading</label>
                        <div class="form-group">
                               <?php $head = explode('&&', $auto_submit['question_heading']); ?>
                              <div class="col-sm-3">
                                <input type="text" name="heading[]" class="form-control" value="<?php echo $head[0]; ?>">
                              </div>
                              <div class="col-sm-3">
                                 <input type="text" name="heading[]" class="form-control" value="<?php echo $head[1]; ?>">
                              </div>
                              <div class="col-sm-3">
                                 <input type="text" name="heading[]" class="form-control" value="<?php echo $head[2]; ?>">
                              </div>
                              <div class="col-sm-3">
                                 <input type="text" name="heading[]" class="form-control" value="<?php echo $head[3]; ?>">
                              </div>
                        </div>
                      </div>
                      
                      <div class="form-group"  style="line-height: 31px;">
                        <label style="margin-left: 14px">Question Detail</label>
                        <div class="remove">
                          <?php 
                          $first_row = explode('&&', $auto_submit['question_details']); 
                              for($i=0; $i<count($first_row); $i++){
                                $second_row = explode('|', $first_row[$i]);
                          ?>
                          <div class="col-md-4">
                            <div class="col-sm-12">
                              <input type="text" name="area<?php echo $i+1; ?>" class="form-control" value="<?php echo $second_row[0]; ?>">
                            </div>
                          </div>
                          <div class="col-md-8" id="appendelem'+i+'">
                            <div class="row">
                              <?php $a1 = explode('&', $second_row[1]);
                                    $a2 = explode('&', $second_row[2]);
                                    $a3 = explode('&', $second_row[3]);
                                     $count_a = 0;
                                     for($j=0; $j<count($a1); $j++){
                                     ?>

                              <div class="col-sm-6">
                                <input type="text" name="description<?php echo $i+1; ?>[]" class="form-control" value="<?php echo $a1[$count_a]; ?>">
                              </div>
                              <div class="col-sm-3">
                                <select class="form-control" name="investment<?php echo $i+1; ?>[]">
                                  <option value="">select</option>
                                  <option value="High" <?php if($a2[$count_a]=='High'){ echo "selected='selected'"; }?>>High</option>
                                  <option value="Medium" <?php if($a2[$count_a]=='Medium'){ echo "selected='selected'"; }?>>Medium</option>
                                  <option value="Low" <?php if($a2[$count_a]=='Low'){ echo "selected='selected'"; }?>>Low</option>
                                  <option value="None" <?php if($a2[$count_a]=='None'){ echo "selected='selected'"; }?>>None</option>
                                </select>
                              </div>
                              <div class="col-sm-3">
                                <select class="form-control" name="feasibilty<?php echo $i+1; ?>[]">
                                  <option value="">select</option>
                                  <option value="High" <?php if($a3[$count_a]=='High'){ echo "selected='selected'"; }?>>High</option>
                                  <option value="Medium" <?php if($a3[$count_a]=='Medium'){ echo "selected='selected'"; }?>>Medium</option>
                                  <option value="Low" <?php if($a3[$count_a]=='Low'){ echo "selected='selected'"; }?>>Low</option>
                                  <option value="None" <?php if($a3[$count_a]=='None'){ echo "selected='selected'"; }?>>None</option>
                                </select>
                              </div>

                              <?php $count_a++; } // second looop ?>
                             </div>
                        </div>
                        <p style="color: #fff">.</p>
                        <?php } // first loop?>
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
                    <input type="hidden" value="<?php echo count($first_row); ?>" name="count">
                    <input type="hidden" value="<?php echo $auto_submit['auto_submit_id']; ?>" name="update_id">
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

