    <style type="text/css">
      .limitedNumbChosen, .limitedNumbSelect2{
  width: 400px;
}
    </style>

<script src="<?php echo base_url() ?>admin_assets/editor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>admin_assets/editor/samples/js/sample.js"></script>
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
          <h2 class="lel">Process Create</h2> </div>
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
                  <h3 class="box-title">Process Create</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form autocomplete="off" method="post" action="<?php echo base_url() ?>process-insert">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <textarea name="process_question" id="editor" placeholder="Question" class="form-control mcq_question ckeditor" required="required"></textarea>
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
                      <div class="col-md-5">
                        <div class="form-group">
                            <input type="text"  id="row_value" placeholder="m" class="form-control" required="required">
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" id="column_value" placeholder="n" class="form-control" required="required">
                        </div>
                      </div>
                      <div class="col-md-2">
                         <div class="form-group">
                            <input type="button" name="btn-click" value="create" id="btn-click" placeholder="n" class="form-control" required="required">
                        </div>
                      </div>
                      </div>
                      <h3>Process Create values</h3>
                      <div class="main-container"></div>
                      <h3>Process Create Answer</h3>
                      <div class="main-answer"></div>
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
initSample();
var product='';
var position='';
$("#btn-click").click(function(){
  var row=$("#row_value").val();
  var column=$("#column_value").val();
  product1='<table><tbody>';
  product+='<table><tbody>';
  for(var i=0;i<row;i++){
    product+='<tr  id="'+i+'">';
    product+='<tr  id="'+i+'">';
    for(var j=0;j<column;j++){
      product+='<td id="'+j+'"><input name="word[]" type="text" class="form-control" required="required"></td>';
      product1+='<td id="'+j+'"><input name="answer_word[]" type="text" class="form-control" required="required"></td>';
    }
    product+='</tr>';
    product1+='</tr>';
  }
  product+='</tbody></table>';
  product1+='</tbody></table>';
  product+='<input value="'+column+'" name="count_row" type="hidden" class="form-control" required="required">';
  product+='<input value="'+row+'" name="count_value" type="hidden" class="form-control" required="required">';
  $(".main-container").append(product);
  $(".main-answer").append(product1);
});
</script>