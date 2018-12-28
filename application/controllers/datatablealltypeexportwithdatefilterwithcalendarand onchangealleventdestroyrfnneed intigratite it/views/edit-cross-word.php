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
        if($this->session->flashdata('cross_word_message')){
          echo $this->session->flashdata('cross_word_message');
        }
        ?>
      <section class="invoice show">
        <!-- title row -->
        <div class="row" style="background-color: #587EA3">
          <div class="col-md-12">
          <h2 class="lel">Crossword Edit</h2> </div>
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
                  <h3 class="box-title">Crossword Edit</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form autocomplete="off" method="post" action="<?php echo base_url() ?>crossword-update">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <textarea name="crossword_question" id="editor" placeholder="Question" class="form-control mcq_question" required="required"><?php echo $cross_word_data['crossword_question']; ?></textarea>
                        </div>
                      <!-- /.form-group -->
                      </div>
                     <div class="col-md-12">
                        <div class="form-group">
                          <select name="master_topic" class="form-control" required="required">
                            <option value="">Select Topics</option>
                            <?php
                              foreach ($master_topics as $master_topic) {
                                if($master_topic['t_id'] == $cross_word_data['topic']){
                                  $tsel = ' selected="selected"';
                                }else{
                                  $tsel = '';
                                }
                            ?>
                            <option value="<?php echo $master_topic['t_id']?>" <?php echo $tsel; ?>><?php echo $master_topic['t_name']?></option>
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
                                if($master_type['type_id'] == $cross_word_data['type']){
                                  $typesel = ' selected="selected"';
                                }else{
                                  $typesel = '';
                                }
                            ?>
                            <option value="<?php echo $master_type['type_id']?>" <?php echo $typesel; ?>><?php echo $master_type['type_name']?></option>
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
                                if($master_skills_test['skills_id'] == $cross_word_data['skill_tested']){
                                  $skillsel = ' selected="selected"';
                                }else{
                                  $skillsel = '';
                                }
                            ?>
                            <option value="<?php echo $master_skills_test['skills_id']?>" <?php echo $skillsel; ?>><?php echo $master_skills_test['skills_name']?></option>
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
                                if($master_cases['case_id'] == $cross_word_data['case_id']){
                                  $casesel = ' selected="selected"';
                                }else{
                                  $casesel = '';
                                }
                            ?>
                            <option value="<?php echo $master_cases['case_id']?>" <?php echo $casesel; ?>><?php echo $master_cases['case_name']?></option>
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
                                if($master_difficulty_level['diffi_id'] == $cross_word_data['difficulty_level']){
                                  $skillsel = ' selected="selected"';
                                }else{
                                  $skillsel = '';
                                }
                            ?>
                            <option value="<?php echo $master_difficulty_level['diffi_id']?>" <?php echo $skillsel; ?> ><?php echo $master_difficulty_level['difficulty_level']?></option>
                            <?php
                              }
                            ?>
                        </select>
                        </div>
                      </div>
                      <h3>Crossword values</h3>
                      <div class="main-container"></div>
                      <!-- start here  -->
                      <div class="main-container">
                          <?php 
                             $nrow=$cross_word_data['row_count'];
                             $ncol=$cross_word_data['column_count'];
                             $crossarray = explode(',', $cross_word_data['crossword_array']);
                             $twodcrossarray = array_chunk($crossarray, $ncol);
                             for($i=0; $i<$nrow; $i++)
                             {  ?>
                                <div class="row" id="<?php echo $i; ?>">
                              <?php 
                                  for($j=0; $j<$ncol; $j++)
                                 {  ?>
                                   <div class="col-md-<?php echo 12/$ncol; ?>" id="<?php echo $j; ?>">
                                     <input name="word[]" type="text" class="form-control" required="required" value="<?php echo $twodcrossarray[$i][$j]; ?>">
                                   </div>
                        <?php    }
                           echo '</div>'; 
                             }
                          ?>
                          <div class="main-container">
                            <input value="<?php echo $cross_word_data['row_count']; ?>" name="count_row" type="hidden" class="form-control" required="required">
                            <input value="<?php echo $cross_word_data['column_count']; ?>" name="count_value" type="hidden" class="form-control" required="required">
                          </div>
                        
                       
                      <div class="main-position col-md-12"><br/>
                        <?php 
                           $cpos=explode('$$',$cross_word_data['crossword_position']);
                           $question=explode('||',$cross_word_data['crossword_hint']);
                           $nword=count($cpos);
                           for($i=0; $i<$nword; $i++)
                           {
                              
                              $newdata = explode('|',$cpos[$i]);
                              
                            echo '<div class="row" id="'.$i.'">';
                              ?>
                                 
                                      <div class="col-md-4" id="<?php echo $i; ?>1">
                                        <input type="text" class="form-control" name="first_coordinate[]" required="required" value="<?php echo $newdata[0]; ?>">
                                      </div>
                                      <div class="col-md-4" id="<?php echo $i; ?>2">
                                        <input type="text" name="second_coordinate[]" class="form-control" required="required" value="<?php echo $newdata[2]; ?>">
                                      </div>
                                      <div class="col-md-4" id="<?php echo $i; ?>3">
                                        <input type="text" name="question[]" class="form-control" required="required" value="<?php echo $question[$i]; ?>">
                                      </div>
                                
                   <?php         
                             echo '</div>';
                           }
                         

                        ?>
                       </div>
                      <div class="main-position col-md-12"></div>
                    <!-- /.col -->
                    </div>
                    <input type="hidden" name="updateid" value="<?php echo $cross_word_data['crossword_id']; ?>">
                    <input type="submit" value="Update" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;" />
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
  initSample();
var product='';
var position='';
$("#btn-click").click(function(){
  var row=$("#row_value").val();
  var column=$("#column_value").val();
  var div_column=(12/$("#column_value").val());
  for(var i=0;i<row;i++){
    product+='<div class="row" id="'+i+'">';
    for(var j=0;j<column;j++){
       product+='<div class="col-md-'+div_column+'" id="'+j+'"><input name="word[]" type="text" class="form-control" required="required"></div>';
    }
    product+='</div>';
    product+='<input value="'+column+'" name="count_row" type="hidden" class="form-control" required="required">';
    product+='<input value="'+row+'" name="count_value" type="hidden" class="form-control" required="required">';
  }
  $(".main-container").append(product);

});

$("#position-click").click(function(){
  data_value=$("#position_value").val();
  alert(data_value);
  for(var k=0;k<data_value;k++){
    position+='<div class="row" id="'+k+'">';
    position+='<div class="col-md-4" id="'+k+'1"><input type="text" class="form-control" name="first_coordinate[]" required="required"></div><div class="col-md-4" id="'+k+'2"><input type="text" name="second_coordinate[]" class="form-control" required="required"></div><div class="col-md-4" id="'+k+'3"><input type="text" name="question[]" class="form-control" required="required"></div></div>';
  }
  $(".main-position").append(position);
  });
</script>
