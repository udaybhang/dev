
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
          <h2 class="lel">Auto Submit Tool</h2> </div>
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
                  <h3 class="box-title">Auto Submit Tool</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form autocomplete="off" method="post" action="<?php echo base_url() ?>admin-insert-auto-submit">
                    <div class="row">
                      <div class="col-md-12">
                        <label>Question Context</label>
                        <div class="form-group">
                          <textarea name="question" id="editor" placeholder="Enter Question Context" class="form-control mcq_question" required="required"></textarea>
                        </div>
                      <!-- /.form-group -->
                      </div>
                      <div class="col-md-12">
                        <label>Case Title</label>
                        <div class="form-group">
                           <input type="text" name="case_title" class="form-control" placeholder="Enter case title">
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
                      <div class="col-md-12">
                         <label>Question Heading</label>
                        <div class="form-group">
                              <div class="col-sm-3">
                                <input type="text" name="heading[]" class="form-control">
                              </div>
                              <div class="col-sm-3">
                                 <input type="text" name="heading[]" class="form-control">
                              </div>
                              <div class="col-sm-3">
                                 <input type="text" name="heading[]" class="form-control">
                              </div>
                              <div class="col-sm-3">
                                 <input type="text" name="heading[]" class="form-control">
                              </div>
                        </div>
                      </div>
                       <div class="col-md-12"  id="appendelem" style="margin-top: 20px">
                        <div class="col-md-4"><label>How many row you want to add</label></div><div class="col-md-8"><input type="text" name="count" id="count" placeholder="Enter count" class="form-control"/></div>
                        <div class="user-details"></div>

                       
                        
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
<script type="text/javascript">
  $(document).ready(function(){
    $('#count').on('blur', function(){
         var count = $(this).val();
         $('.delete-user').remove();
         for(var i=1; i<=count; i++){
            $('<div class="user_data delete-user" style="margin-top: 40px"><div class="form-group"  style="margin-bottom: 40px; margin-top: 40px"><div class="remove"><div class="col-md-4"><div class="col-sm-12"><input type="text" name="area'+i+'" class="form-control"></div></div><div class="col-md-8" id="appendelem'+i+'"><div class="row copyelem'+i+'" id="copyelem'+i+'" ><div class="col-sm-4"><input type="text" name="description'+i+'[]" class="form-control"></div><div class="col-sm-3"><select class="form-control" name="investment'+i+'[]"><option value="">select</option><option value="High">High</option><option value="Medium">Medium</option><option value="Low">Low</option><option value="None">None</option></select></div><div class="col-sm-3"><select class="form-control" name="feasibilty'+i+'[]"><option value="">select</option><option value="High">High</option><option value="Medium">Medium</option><option value="Low">Low</option><option value="None">None</option></select></div><div class="user'+i+'"></div> <div class="col-sm-1 form-group" id="buttonshow" style="margin-left: 32px; float: right"><input value="+ Add More" class="add_details btn btn-primary" id="sbutton'+i+'" autocomplete="false" type="button" style="float: right" ></div></div></div></div></div></div>').appendTo(".user-details");
            $('#sbutton'+i).click(function(){
                     var click = $(this).attr('id');
                     var idint = click.substr(click.length-1);
                    $('<div class="user_data1" style="margin-top: 40px"><div><div class="col-sm-4"><input type="text" name="description'+(idint)+'[]" class="form-control"></div><div class="col-sm-3"><select class="form-control" name="investment'+(idint)+'[]"><option value="">select</option><option value="High">High</option><option value="Medium">Medium</option><option value="Low">Low</option><option value="None">None</option></select></div><div class="col-sm-3"><select class="form-control" name="feasibilty'+(idint)+'[]"><option value="">select</option><option value="High">High</option><option value="Medium">Medium</option><option value="Low">Low</option><option value="None">None</option></select></div><div class="remove_column"><i class="fa fa-minus"></i></div></div>').appendTo(".user"+idint);

                    $('.remove_column').click(function(){
                        $(this).parent().remove();
                     });
                 
            });

           

         }

    });
  });
</script>
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
    $j(document).on('click', '#add_more_select', function(){
      copyelemleng = $j('.copyelem').length;
      $j('.removeelem').css('display','block');
      if(copyelemleng<10){
        $j('#appendelem').append($j('#copyelem').clone());
      }else{
        alert('You can not add more.');
      }

      $j('.removeelem').click(function(){
        copyelemleng = $j('.copyelem').length;
        alert(copyelemleng);
        if(copyelemleng>1){
          $j(this).parent().parent().parent().remove();
        }
      });
    });
</script>
<script type="text/javascript">
    var copyelemleng1 =0;
    $j(document).on('click', '#add_more_select1', function(){
     copyelemleng1 = $j('.copyelem1').length;
      $j('.removeelem1').css('display','block');
      if(copyelemleng1<10){
        $j('#appendelem1').append($j('#copyelem1').clone());
      }else{
        alert('You can not add more.');
      }

      $j('.removeelem1').click(function(){
        copyelemleng = $j('.copyelem1').length;
        alert(copyelemleng1);
        if(copyelemleng1>1){
          $j(this).parent().parent().parent().remove();
        }
      });
    });
</script>
