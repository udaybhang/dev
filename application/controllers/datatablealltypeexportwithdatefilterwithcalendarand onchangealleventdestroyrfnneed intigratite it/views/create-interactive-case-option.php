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
              <h2 class="lel">Interactive Case Option Mapping
              </h2> 
            </div>
          </div>
          <div class="clearfix" style="margin-top: 20px;">
          </div>
          <div class="">
            <div class="col-md-12">
                       <?php 
                              $permission_array=$this->session->userdata('permission_array');
                        //print_r($permission_array);
                            for($i=0;$i<sizeof($permission_array);$i++){
                              $p =$this->Crud_modal->fetch_single_data('permission_description','master_permission',"permission_id='$permission_array[$i]'");
                              
                                 $permission[] = $p["permission_description"]; 
                            }
                            //print_r($permission);
                        ?>
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
                    <h3 class="box-title">Interactive Case Option Mapping
                    </h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <form autocomplete="off" method="post" action="<?php echo base_url() ?>insert-interactive-case-option" id="subjectform">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Option</label>
                            <input type="text" class="form-control" name="option" required>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Current Question</label>
                            <select name="curr_ques" class="form-control" required="required">
                              <option value="">Select Current Question
                              </option>
                              <?php
                                foreach ($interactive_question as $int_quest) {
                              ?>
                              <option value="<?php echo $int_quest['ques_id']?>">
                                <?php echo $int_quest['question']?>
                              </option>
                              <?php
                                }
                               ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Next Question</label>
                            <select name="next_ques" class="form-control" required="required">
                              <option value="0">Select Next Question</option>
                              <?php
                                foreach ($interactive_question as $int_quest) {
                              ?>
                              <option value="<?php echo $int_quest['ques_id']?>">
                                <?php echo $int_quest['question']?>
                              </option>
                              <?php
                                }
                               ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Difficulty Level</label>
                            <select name="difficulty" class="form-control" required="required">
                              <option value=""> Select Difficulty Level
                              </option>
							  <option value="0"> D0
                              </option>
                              <?php
                                     foreach ($master_difficulty as $diff) {
                              ?>
                              <option value="<?php echo $diff['diffi_id']?>">
                                <?php echo $diff['difficulty_level']?>
                              </option>
                              <?php
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                           <select class="form-control" name="case_map" id="case_map_id">
                             <option>select case Map</option>
                             <?php foreach($interactive_case_map as $interact){?>
                                  <option value="<?php echo $interact['case_interactive_id']; ?>" ><?php echo $interact['case_question']; ?></option>
                             <?php } ?>
                           </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <input type="text" name="skills" id="skills" class="form-control" value="" readonly="readonly">
                          </div>
                        </div>
                         <div class="col-md-12">
                          <div class="form-group">
                            <input type="text" name="skills_marks" class="form-control" placeholder="Enter marks corressponding skill (1,0,3) put 0 corressponding if you donot want give.">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <input type="text" name="hint" class="form-control" placeholder="Enter Hint">
                          </div>
                        </div> 
                      </div>
                      <?php if(in_array("Create", $permission)){?>
                      <input type="submit" value="Submit" id="formsub" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;" />
                      <?php } ?>
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
<script type="text/javascript">
  $(document).ready(function(){
      $("#case_map_id").change(function(){
          var map = $("#case_map_id").val();
         //alert(map);
         $.ajax({
         url: "<?php echo base_url().'get-case-map-skill' ?>",
         type: "POST",
         data: {'case_map_id': map},
         success: function (data) {
          //alert(data);
          $('#skills').val(data);
           //$('#function_area'+tt_count_data).html(data);
          },
        });
      });    
  });
</script>
