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
              <h2 class="lel">Interactive Case Study
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
                           // print_r($permission);
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
                    <h3 class="box-title">Interactive Case Study
                    </h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <form autocomplete="off" method="post" action="<?php echo base_url() ?>insert-interactive-case-study" id="subjectform">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Question Context</label>
                            <textarea id="editor" name="question_context" placeholder="Question" class="form-control"></textarea>
                          </div>
                        </div>
                        <div class="col-md-12">											
                          <div class="form-group">
                          	<label>Question</label>
                          	<div class="form-control" contenteditable="true" id="ans" style="height: 200px;"></div>
                            <input type="hidden" name="ans" />
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <select name="mastr_type" class="form-control" required="required">
                              <option value="">Select Tool Type
                              </option>
                              <?php
foreach ($tool_types as $tool_typ) {
?>
                              <option value="<?php echo $tool_typ['id']?>">
                                <?php echo $tool_typ['name']?>
                              </option>
                              <?php
}
?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <select name="master_topic" class="form-control">
                              <option value="">Select Topics
                              </option>
                              <?php
foreach ($master_topics as $master_topic) {
?>
                              <option value="<?php echo $master_topic['t_id']?>">
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
?>
                              <option value="<?php echo $master_type['type_id']?>">
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
?>
                              <option value="<?php echo $master_skills_test['skills_id']?>">
                                <?php echo $master_skills_test['skills_name']?>
                              </option>
                              <?php
}
?>
                            </select>
                          </div>
                        </div>
                        
                       
                      </div>
                     <?php if(in_array("Create", $permission)){?>
                      <input type="button" value="Submit" id="formsub" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;" />
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
